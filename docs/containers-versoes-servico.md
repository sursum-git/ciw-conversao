# Serviço reutilizável de versões e custos

Análise estática de 16/10/2026. Não implementa GUI, cálculo duplicado ou escrita; não altera o canônico. A exigência do usuário é manter regras de custos e de versões em rotinas separadas, reutilizáveis por todos os programas.

Referências abaixo relativas a `sources/scriptcase/containers/`: **B**=`bl_item_custos/index.php`; **C**=`contr_item_custos/contr_item_custos_apl.php`; **S**=`cons_itens_container_simul_calc/cons_itens_container_simul_calc_grid.class.php`; **V**=`cons_versoes_item_custo_container/cons_versoes_item_custo_container_grid.class.php`; **G**=`bl_item_custos_gravacao/index.php`; **F**=`form_versoes_item_custo_container/form_versoes_item_custo_container_apl.php`. G/F foram recebidos durante a análise e estão incorporados abaixo.

## Fluxos comprovados e distinções necessárias

| Caminho/rotina | Evidência e regra observada |
|---|---|
| Menu → Versões → Gerar | `bl_ponte_versoes_item_custo_container/index.php:2711–2718` leva o container à consulta; V`:950` lista cabeçalho. A consulta referencia `form_versoes_item_custo_container` (`index.php:528–585`). O formulário F`:4008–4022` escolhe ID por MAX+1 e, após incluir, incrementa a sequência sem usar seu valor e chama `gravarVersaoCusto` (`:4341–4343`). Esse é o evento ativo de geração, distinto do helper com NEXTVAL. |
| Inserir snapshot | B`:15565–15593`: sequência, cabeçalho e chamada `gravarVersaoCusto`. B`:15671–15707`: por padrão sincroniza impostos e despesas calculadas, grava dados do container, despesas, descontos, itens, NFs e pagamentos, completa e limpa flag desatualizada. São efeitos de negócio explícitos, nunca leitura/abertura de página. |
| Cálculo do snapshot | B`:15949–15965` chama `calcularCustoGeralItem` em real e dólar, **negociado**, `logBuscarCustoReal=true`, `logBuscarDespSemDistrCusto=false`; grava itens por ID e valores calculados (`:15980–16100`). Distribuição pode criar movimento/despesa e uma nova versão automática (`:16040–16100`). |
| Entrada do fechamento unitário | B`:5576–5598` recusa última versão já usada quando o primeiro resultado tem `item_custo_id != 0`, e recusa saldo dólar **maior que 1**. A mensagem diz menor que 1, mas a condição aceita exatamente 1. Depois abre `contr_item_custos` (`:5606`). Não é a rotina que grava o fechamento. |
| Seleção/simulação | C`:1008–1018` verifica liberação do realizado; sem liberação, encaminha diretamente com prioridade previsto=0. C`:1835` encaminha a escolha do formulário. S`:4011–4028` calcula cada linha e acumula erros; abrir a grade não prova chamada de writer. |
| Cálculo do custo unitário final | S`:13301–13504` coleta código ERP, custo anterior, versão do item, estoque IMA+MED, NF mãe/etiquetas; relata ausência de ERP/custo/versão e flag desatualizada. Prioriza previsto quando solicitado ou realizado não liberado; realizado zero recua para previsto (`:13457–13470`). Ponderação/precisão pertencem a um núcleo puro compartilhado próprio deste cálculo, sem cópia nos chamadores. |
| Gravação final | S`:5164–5171` tem botão **Gravar novo Custo Unitário**, com confirmação, para G. O writer G`:4929–4931` só bloqueia por `qt_erros` recebido da sessão; depois relê todos os IDs do container, recalcula por item e insere `item_custos` tipo2, ligando `item_container_custos.item_custo_id` (`:4935–5002`). Não verifica novamente `erros` do resultado; em ausência de cálculo usa zeros e prossegue. A nova API deve revalidar resultados de todos os itens, sem copiar essa fragilidade. |
| Remover versão | F`:3407–3420` só permite exclusão de situação1/incompleta; rotina gerada remove filhos de descontos/despesas/itens/NFs/pagamentos antes do cabeçalho. Não oferecer delete genérico de versão completa/usada. |

“Versão completa” significa `ind_sit_versao=2`; `1=Incompleto`, `2=Completo` no lookup da consulta (`cons_versoes_item_custo_container_lookup.class.php:48–59`). Isso não significa custo unitário fechado/utilizado: este vínculo é `item_container_custos.item_custo_id`. Não criar um terceiro estado físico “fechado” por suposição.

## Chaves e sequências reais encontradas

| Estrutura | Chave/sequência evidenciada |
|---|---|
| `espec.versoes_item_custo_container` | PK única `versao_id`; índice não único `container_id`; `seq_versao_item_container_custo.NEXTVAL` no insert B`:15576–15578`. |
| `espec.item_container_custos` | PK única `item_container_custo_id`; índices não únicos `item_container_id`, `item_custo_id`; `seq_item_container_custos.NEXTVAL`, B`:16133–16158`. `versao_id` relaciona o snapshot; não existe índice único `(versao_id,item_container_id)` no schema coletado. |
| `espec.item_container_custo_despesas` | PK composta `(versao_id,despesa_id)` no schema. B`:15879–15882` agrupa também por `calc_imp_container_id`; várias linhas da mesma despesa podem colidir na PK. Validar cardinalidade antes de persistir. |
| NFs/pagamentos/descontos da versão | Inserts em `item_container_custo_nfs` (`versao_id,documento,serie,nat_operacao,cod_emitente`), `item_container_custo_pgtos` (`versao_id,num_id_tit_ap`) e `item_container_custo_descontos` (`versao_id,desconto_importacao_id`), B`:16245`, `:16302`, `:16528`. Esses são vínculos do SQL; índices/triggers desses três filhos ainda não foram coletados. |
| `espec.item_custos` | `seq_item_custos.NEXTVAL`; helper de tipo container grava `cod_tipo_custo=2`, `cod_situacao=2` e retorna ID, S`:13509–13565`; helper de média em S`:13569`. Vínculo posterior em `item_container_custos.item_custo_id`, S`:13090–13095`. Schema completo/efeitos do writer final pendentes. |
| Tipo de versão | Cabeçalho usa `tipo_versao_id`; tabela `tipos_versao_custo` tem PK `tipo_versao_custo_id`. Validar lookup/tipo existente, sem confundir nomes ou aceitar código livre. |

Schemas válidos: `integration-src/container-panel/schema/schema-versoes_item_custo_container.json`, `schema/espec/schema-item_container_custos.json`, `schema/espec/schema-item_container_custo_despesas.json`, `schema/espec/schema-tipos_versao_custo.json`. O arquivo alternativo `schema-itens_container_custo.json` está vazio e **não** é evidência de tabela/schema. Cabeçalho usa DATETIME-TZ; vários decimais físicos são escala2, unitários dos itens escala5 e `vl_desconto_utiliz_real` do item é CHARACTER. Não usar formato visual como precisão persistida nem converter string financeira silenciosamente para zero.

Os nomes de sequência acima estão no PHP, ainda exigindo confirmação física/12.2. O helper legado consulta CURRVAL por outra conexão (`B:13541–13556`); o evento ativo do formulário usa MAX+1 e avanço separado da sequência (F`:4008–4022`, `:4341`, `:12449–12455`). A API ABL deve capturar `NEXT-VALUE` em variável na mesma rotina/transação, jamais obter ID por MAX/global ou reproduzir o avanço descartado.

## ABI proposta: cada regra em um único dono

Manter o padrão interno atual `RUN ... (INPUT JsonObject, OUTPUT JsonObject)` com contratos versionados e fechados. O adaptador HTTP só valida ação/contexto e chama o serviço; nenhuma fórmula/SQL na UI ou no wrapper.

| Rotina | Responsabilidade exclusiva |
|---|---|
| `ContainersCustoCollector` | Coletar componentes autorizados, fixar container/empresa e cardinalidade/proveniência. Extrair/reutilizar o coletor de `ContainersCustoReadService`, não criar uma coleta diferente em cada programa. Parâmetros IMA pela include oficial, NO-LOCK sem cache. |
| `ContainersCustoCalculator.p` existente | Único dono da matemática de custo do container, taxas, rateios e arredondamentos. Entrada confiável apenas do coletor; sem banco, sequência ou mutação. |
| `ContainersItemCustoCalculator` + coletor de fechamento | Núcleo puro distinto para ponderação de estoque/custo unitário final de S`:13301`; usa snapshot confirmado e componentes ERP. Simulação e fechamento consomem **o mesmo resultado** e a mesma implementação. Não introduzir essa fórmula nos programas. |
| `ContainersVersionService` | Orquestrar autorização, estado, coleta/cálculo, snapshot transacional, filhos, sequências e auditoria. `consultar` lê versão persistida; não recalcula histórico usando dados atuais. |
| `ContainersItemCustoService` | Persistir o custo unitário final/vínculos/efeitos associados, segundo o caminho ativo G`:4935–5002`. `VersionService.fechar` delega a ele. Não duplicar insert/fórmula no VersionService; validar a precisão/índices e transação completa antes de habilitar. |

**Gap do núcleo atual:** `ContainersCustoCalculator.p:169,212,234–237` usa negociado apenas em `mode=comparativos`, mas nesse modo desabilita realizado. `mode=itens` usa tributado. Portanto nenhum desses modos sozinho reproduz a chamada do snapshot. Acrescentar, por TDD, perfil interno fechado de cálculo de versão: negociado, realizado habilitado e consulta adicional de despesas sem distribuição desabilitada, mantendo uma implementação matemática. `calculationBasis=version` é proveniência, não substitui esse perfil. Não chamar comparativos e tratar seus zeros como realizado válido.

Alinhamento com o responsável pelo Calculator/Collector, ainda **somente proposta, sem edição**: policy privada `calculation_profile="version"`, `capture_input=true` seleciona math.mode privado `gerar_versao`; base negociada, realizado habilitado, ajuste do médio conforme chamada truthy e parcelas sem distribuição zeradas. Retornar `input_snapshot` clonado do input matemático coletado; repetir o mesmo Calculator com `currency="dolar"`, sem segunda coleta/leitura. A geração nova usa `calculationBasis="current"`; `"version"` atualmente significa histórico e recusa flag desatualizada, portanto não deve bloquear a criação que substitui histórico desatualizado. A ABI do coletor publicado deve permanecer compatível.

O médio mestre também exige proveniência própria: B`:15967` chama `buscarDolarMedio(container)` com default false, enquanto as chamadas de cálculo dos itens usam o ajuste truthy. Não copiar o médio ajustado dos itens para o mestre. Pode-se clonar o mesmo input coletado e chamar o Calculator no perfil `rastro` para obter o médio mestre, sem nova leitura e sem fórmula paralela.

Envelope proposto para `ContainersVersionService`, **não publicado**:

```text
v1 {operation:"consultar",container_id,versao_id?,resource:"cabecalho"|"itens"|"despesas"|"nfs"|"pagamentos"|"descontos"}
v1 {operation:"gerar",container_id,tipo_versao_id,descricao,expected_latest_version_id,request_id}
v1 {operation:"fechar",container_id,versao_id,priorizar_previsto:boolean,expected_snapshot_fingerprint,request_id}
```

Ator/permissões/correlação vêm do contexto autenticado server-side, nunca do corpo como autoridade. `container_id` é `nr-container` público validado, `versao_id` deve pertencer a ele. Operação, recurso, tipos e campos são allowlists. `gerar` chama os serviços fiscais existentes quando a política exigir os efeitos legados; não copia suas regras. `fechar` fica indisponível até implementar o writer mapeado, validar efeitos e testes; abrir/consultar/simular nunca fecha. Resultado fechado com versão/contagens/fingerprint e mensagens; erro sem sucesso parcial.

`gerar` deve reservar cabeçalho incompleto1, gravar todos os filhos e transicionar a completo2 em transação com lock por container; falha desfaz tudo. Capturar instante/usuário/inputs e saída do único Calculator. `expected_latest_version_id`/fingerprint previnem gravar sobre análise obsoleta; `request_id` evita repetição. `fechar` relê e revalida versão atual/completa/não utilizada, flag atualizada, saldo, permissões e erros de **todos** os itens antes de qualquer escrita; não confiar no `qt_erros` vindo de grade/página. A semântica exata desses gates ainda deve ser reconciliada com o writer.

## Defeitos legados a resolver explicitamente

- `inserirVersaoCusto` já insere situação2 antes de gravar filhos (B`:15578`), contrariando a noção de incompleto; `verificarVersaoCustoIncompleta` procura situação1 globalmente, atribui o retorno em `$container` e devolve `$versaoId=0` (B`:15846–15860`). Não portar a guarda inoperante.
- `getUltVersao` usa MAX global para herdar tipo na geração automática (B`:15622–15629`); consultas de última versão do container usam MAX por container (B`:16346–16360`, `:16420–16432`). Serviço novo deve tornar escopo explícito em todas as chamadas.
- Distribuição pode gerar nova versão recursiva; `$logNovaVersao` é sobrescrito a cada item (B`:16079–16098`). Definir plano de efeitos acíclico e limite de geração, sem copiar recursão.
- G`:4929–5004` confia em contagem de erros da página anterior, não recusa os novos erros do recálculo, admite fallback zero e anuncia sucesso depois do loop. O envelope novo deve recusar entrada inválida/resultado incompleto antes de escrita e só confirmar depois do commit integral.
- Permanecem pendentes schemas dos filhos restantes/item_custos, validação física de sequências, paridade do perfil central e testes de integração. O parâmetro `nat_operacao_nf_mae` está aguardando valor do usuário; cálculo realizado está bloqueado por configuração. Não inventar default nem persistir snapshot realizado incompleto como zero.

Próxima implementação deve testar reutilização entre consulta/snapshot/simulação/fechamento, concorrência de duas gerações, rollback de qualquer filho, contexto cruzado, versão obsoleta/usada, zero itens, precisão física e idempotência. Nenhuma rotina de negócio foi executada nesta análise.
