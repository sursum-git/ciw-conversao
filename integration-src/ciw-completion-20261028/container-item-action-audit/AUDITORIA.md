# Itens/container — confronto de ações, 28/10/2026

Resultado: manutenção individual e alocação em lote já têm produto e provas de negócio. Os dois blanks auditados não implementam criação nem reversão de alocação. A consulta composta do grid permanece **parcialmente reconciliável**, com diferenças de moeda, visibilidade e navegação. Nenhum writer novo se justifica por essas três origens. Esta entrega não altera inventário, produto, metadados publicados ou os freezes anteriores.

## Recorte e evidência

Fontes: `sources/scriptcase/containers/grid_itens_container/` e os dois blanks em `sources/scriptcase/ciw-completion-next19c-20261028/`. Não foram usados `grid_itens_container_old`, `bkp` ou comparação `bkp` como fonte ativa. `verification.json`, no diretório runtime homônimo, pina 42 arquivos de origem, serviços/JSON canônicos e recibos históricos por SHA256; não copia conteúdo privado desses recibos. As linhas abaixo são das cópias atuais pinadas, não dos antigos documentos de inventário.

Estado de implantação: documentos e recibos confirmam op1002/`ciw.container-itens`1.0.1, op1025/`ciw.container-alocar-itens`1.0.0 e as abas de custo já existentes. O recibo de lote registra `COMPLETED_CLEANED`, imagens físicas completas reconciliadas e logs preservados. Isso é evidência histórica, não nova atestação de rcode/runtime ou export atual do Builder. O checkpoint13 prevalece sobre os estados preparados de16/10; nenhuma compilação/publicação ou cenário foi repetido.

## Matriz origem × ação

| Origem / ação | Comportamento efetivo da origem | Produto atual / evidência | Resultado |
|---|---|---|---|
| grid / SELECT e contexto | `grid.class.php:900,1101–1123`: seis colunas físicas de `pub.itens_container`, `container_id=container_corrente`; PK `item_container_id`. | `ContainersPainelReadService.p:172–186,222–223`: mesmos seis campos, mais manutenção e lookups; API fixa pai/PK e JSON1002 exige contexto. | Coberto na leitura de alocação; não equivale aos valores calculados abaixo. |
| grid / quantidades | Alocada, confirmada, recebida físicas; `onRecord:4465–4509` acrescenta saldo calculado. |1002 mantém quantidades;1008/custo itens expõe `qt_saldo` do Calculator comum. | Reconciliável entre duas abas; não exigir embarcada≤alocada por inferência. |
| grid / previsão e realizado | `onScriptinit:559–572` chama `calcularCustoGeralItem(...,'tributado',true,false)` uma vez; `onRecord` encontra o item na lista. | `ContainersCustoReadService` coleta e chama `ContainersCustoCalculator`;1008 projeta os onze campos mapeados abaixo. | Serviços reutilizados; não cabe outro coletor/calculador. Paridade integral depende das diferenças declaradas. |
| grid / moeda | Vazia→Dolar (`grid:556–559`); botões dólar/real em `index:7415–7428` e evento seguinte, via `bl_chama_grid_itens_container`, mantendo pai na sessão. | Serviço de custos aceita somente `real`/`dolar` (`:246–253`), porém oito operações do JSON `cost-api-source.json` fixam `moeda=real`. Campo `moeda` no grid é saída. | **Lacuna nativa comprovada no JSON pinado:** falta seleção/requisição USD; não é resolvida por filtro local sobre coluna. |
| grid / liberação de realizado | `grid:560,630–645`; consulta `pp-container.log_liberar_custo_realizado` em`:20383–20399`; oculta/exibe **vl_custo_real,vl_unit,vl_merc,vl_desp**, mantendo outros campos. | `ContainersCustoReadService` não referencia essa flag;1008 exibe os campos realizados. | **Diferença de fidelidade:** condicional não preservada na projeção/metadados inspecionados. Não se conclui falha de autorização por essa comparação de UI. |
| grid / descrição | `onRecord:4467–4475`: descrição do pedido + descrição ERP via helper; pedido aparece ID+descrição. Helper ERP`:12705` faz UNION MED/IMA e escolhe retorno legado. |1002 fornece descrição do pedido/código ERP/ID do processo/código do fornecedor;1008 fornece descrição do item do pedido e IDs. | Cobertura dos identificadores; apresentação combinada/descrição ERP não comprovada. Não escolher MED ou IMA arbitrariamente. |
| grid / cabeçalho financeiro | `grid:575–622`: FOB USD, pago USD, crédito utilizado USD, desconto utilizado USD, saldo USD, dólar médio. | Resumo/Rastro reutilizam memória e totais centrais; resumo contém pagamentos USD/saldo/dólar médio e rastro total tributado. | Parcial: os seis valores não estão apresentados juntos no JSON pinado. Conferir exposição das duas deduções antes de declarar equivalência. Não reconstituir fórmula no frontend. |
| grid / editar ou excluir alocação | `grid:4571–4620` abre `form_itens_container` por PK; grid não contém evento próprio de UPDATE/DELETE de item. |1002 create/update/delete; CrudService allowlist11campos, pai/item do pedido imutáveis, lock/saldo e guards. Recibos17/10 confirmam fluxo e limpeza. | Coberto pela manutenção existente, com proteções novas explicitadas abaixo. Não criar writer a partir do grid. |
| grid / selecionar itens de pedidos | `grid:6600–6610,7140` abre `control_selec_proc_compra`; controle→grid seleção→helper de criação (fontes colaterais). |1025 seleciona1–25IDs globais, calcula saldo no servidor, reaproveita CrudService e Balance; prova26/10 inclui repetição idempotente e rollback. | Coberto como fluxo nativo consolidado; nenhuma igualdade empresa/fornecedor inventada. |
| grid / abrir item do pedido | `grid:4823–4842`: item_proc_compra_id para formulário de pedido, update permitido, insert/delete negados nesse link. | `ciw.proc-compra-itens` já existe e exige proc_compra_id;1002/1008 trazem ambos IDs, mas `rowLinks=[]` nos dois JSONs auditados. | **Lacuna de navegação direta pinada.** Novo link pode reutilizar página existente; ações da página alvo e permissões precisam preservar o significado, não copiar flags Scriptcase para relaxar acesso. |
| grid / calcular custo item | `grid:6630–6638`: navega para `bl_item_custos`, container via parâmetro, confirmação; não grava pelo grid. | Processos existentes Gerar Versão/Fechar Custos e Calculator unitário compartilhado. | Destino funcional existente; esta auditoria não alega igualdade de toda a sequência do wizard. Não criar processo paralelo. |
| grid / Versões de Custo | Botão nomeado/hint em index1156; `grid:6645` tem ação literal `;`; JS `SC_btn_1` vazio`:8332`. | Abas Versões Custo e Gerar Versão do painel existentes. | Não tratar o texto/hint do botão como chamada gravadora ou navegação executável. Produto atual já oferece acesso explícito. |
| grid / auditoria | SELECT e eventos de apresentação não emitem imagens confirmadas de write; grid contém biblioteca copiada com SQL de vários domínios. | CrudService`:268–278` só confirma na raiz; lote agrega pendingChanges e emite audit póscommit; RuntimeContainerAudit e AllocationAudit validam rota/contexto/imagens e usam logs nativos. | Cobertura de autoria/antes/depois das ações reais, comprovada por recibos. SQL presente numa função copiada não prova chamada ativa pelo grid. |
| bl_criar_itens_container / evento | `index:2706–2711`: lê `proc_compra_id_corrente`, imprime `proc.compra:` e devolve sessão; **nenhum SELECT/INSERT/UPDATE/DELETE de negócio**. Launcher apenas include index. | Fluxos1002/1025 realmente criam/alocam; não se atribui essa criação ao blank. | **Reconciliação proposta: auxiliar diagnóstico sem writer.** Não substituir eco por criação nem publicar programa novo. O framework ainda abre conexões e pode registrar acesso genérico. |
| bl_voltar_selecao_ped_importacao / evento | `index:2702–2707`: redireciona `grid_procs_compra`, target `_parent`, argumentos vazios; não lê/apaga/reverte itens. | Consulta nativa de pedidos existente; seleção atual está no processo1025/painel. | **Reconciliação proposta: retorno de navegação, sem negócio.** Retorno exato dentro de1025 não comprovado; não traduzir “voltar” como estorno/desalocação. |

## Campos derivados, sem nova fórmula

| Campo legado | Saída existente do Calculator /1008 |
|---|---|
|tot_custo|vl_merc_prev|
|vl_rat_desp|vl_desp_prev|
|vl_custo_final|vl_total_prev|
|vl_unitario_previsto|vl_unit_prev|
|vl_merc|vl_merc_real|
|vl_desp|vl_desp_real|
|vl_desconto|vl_desc_item|
|vl_desc_container|vl_desc_container|
|vl_custo_real|vl_total_real|
|vl_unit|vl_unit_real|
|qt_saldo|qt_saldo|

`qt_descontos` é calculado pelo lookup do grid (`lookup.class.php:14–15`), mas a classe pinada só atribui/chama o lookup; não foi encontrada coluna/renderização que consuma esse valor. Portanto não foi inventada uma coluna pendente com esse nome.

## Diferenças preservadas e limites

* A origem zera onze campos quando a lista calculada não é array. O produto distingue ausência confirmada de custo ERP com NULL/`actual_source=confirmed_no_erp_record` (`Calculator:244–247`), em vez de transformar falha/ausência em zero. Não corrigir a auditoria repetindo o fallback inseguro.
* CrudService recusa quantidades negativas e criação inicial não positiva na escala física. A auditoria antiga não encontrou guarda equivalente no evento de manutenção. Guards de snapshots/comercial na exclusão são proteção adicionada, não paridade literal. O saldo é relido sob lock do item do pedido; a seleção legada confiava parcialmente na sessão.
* Lote usa locks determinísticos, valida todos os saldos antes de sequência, ignora par já existente e cancela atomicamente saldo esgotado. Em vez de copiar o INSERT do helper, chama a manutenção como participante. Este comportamento é publicado/documentado, não cenário novo desta entrega.
* Warnings internos de diferença embarcada tipo10 são preservados no ABL; o PHP de CRUD retorna registro/aviso de auditoria, sem apresentar os warnings de regra na tela. Já documentado em `docs/painel-container-itens.md`. Não alterar compensação financeira como correção de apresentação.
* Os JSONs locais pinados são candidatos históricos que foram usados na implantação; não substituem um export fresco das definições publicadas. Ausência de caller dos blanks nos três vizinhos consultados não prova inacessibilidade global. Esta auditoria não percorre nem altera o inventário global.

## Proposta de reconciliação e próximo delta

1. Submeter esta matriz/manifest ao gerente. Não fechar o grid completo como Convertido: relacionar as ações já cobertas a1002/1008/Resumo/Rastro/1025 e os processos existentes. Os dois blanks podem ser classificados como auxiliares de diagnóstico/navegação somente após a decisão de inventário do root.
2. Obter pelo root export sanitizado **atual** do programa/entity1008 e fonte de custos,1002 e página alvo de pedidos, preservando auth em memória. Comparar contra os hashes pinados, antes de propor mudança publicável. Não sobrescrever configuração atual por estes JSONs históricos.
3. Delta pequeno viável: links por JSON nas telas existentes (container_id+item_container_id; proc_compra_id+item_proc_compra_id), com teste real Builder/contexto/permissões. Moeda exige opção de entrada fechada/metadata que chegue ao corpo do request; não filtrar uma resposta BRL como se fosse USD. Nenhum código de programa novo reservado/consumido.
4. Visibilidade: decidir a política de apresentação do custo liberado e comprovar o mecanismo nativo existente antes do patch. Se necessário, expor a flag física na projeção central e reutilizar visibilidade nativa; não replicar o Calculator, não criar frontend/Kendo paralelo. Exportar os escalares faltantes do resumo somente da memória central comprovada.
5. Nenhum patch de produto foi preparado nesta auditoria: o gate concreto é a definição atual para autoria segura e a política de apresentação, não falta de um writer. Não bloquear o restante das conversões por esse gate.

## Verificação executada

PHP canônico real/Builder: `ContainerItemsMetadataTest.php` — **9 testes/271 asserções PASS**, PHPUnit13/PHP8.4, sem HTTP ou persistência. Verificador delimitado — **27 checks PASS**,42evidências pinadas, inclui os eventos ativos extraídos, os onze aliases, shape dos recibos e JUnit real. A primeira execução do verificador esperava booleano em `fullImages`; o recibo é contador10. Corrigida somente a leitura do recibo, sem modificar evidência ou produto. Nada foi compilado, publicado ou executado no ERP.
