# Financeiro privado do ciclo dos itens

`ContainersItensFinanceiroService.p` participa da transação do CRUD dos itens. Não abre rota, não confirma transação, não publica auditoria e não converte moedas. A sequência e os valores dos títulos vêm exclusivamente dos callbacks privados do runtime.

## ABI

Ordem dos parâmetros INPUT: `phItems`, `phPurchaseItems`, `phPurchases`, `phLedger`, `phOrderPayments`, `phContainerPayments`, `phAllContainers`, `phRuntime`, `poPolicy`, `poContext`; OUTPUT `poResponse`.

| Buffer | Tabela e campos físicos utilizados |
|---|---|
| phItems | itens_container: item_container_id, container_id, item_proc_compra_id, qt_alocada, qt_confirm_emb |
| phPurchaseItems | itens_proc_compra: item_proc_compra_id, proc_compra_id, qt_comprada, vl_custo_dolar, vl_negociado |
| phPurchases | procs_compra: proc_compra_id, fornecedor_id, log_considerar_previsao |
| phLedger | cta_corren_fornec_imp: cta_corren_fornec_imp_id, fornecedor_id, data, historico, cod_tipo_movto, vl_lancto, cod_acao, login, data_hora, num_id_tit_ap, item_proc_compra_id, item_container_id, transacao_id |
| phOrderPayments | pagtos_proc_compra: num_id_tit_ap, proc_compra_id; PK única composta |
| phContainerPayments | pagtos_container: num_id_tit_ap, container_id |
| phAllContainers | pp-container: nr-container; fornecedor do mestre não restringe fornecedores dos pedidos |

Policy interna fechada: `{actor:{login:string}}`, login autenticado entre1e128caracteres; FORMAT do dicionário não limita armazenamento. Contexto fechado: `{operation:'create'|'update'|'delete'|'associate'|'disassociate',container_id:integer,before:object,after:object}`. O lado ausente usa `{}`; aceita também `null` para compatibilidade interna. No ciclo create/update/delete de itens, os snapshots presentes contêm ao menos item_container_id, container_id, item_proc_compra_id, qt_alocada e qt_confirm_emb. Pai e item do pedido são imutáveis na atualização. Na criação/atualização, o estado after deve corresponder ao buffer atual; na exclusão, o item já deve ter sido removido na transação chamadora.

Callbacks do procedimento persistente confiável `phRuntime`:

```abl
NextLedgerId(OUTPUT INTEGER).
CollectContainerPayments(INPUT masterBuffer AS HANDLE, OUTPUT rows AS JsonArray).
CollectOrderPayments(INPUT purchaseBuffer AS HANDLE, OUTPUT rows AS JsonArray).
```

Cada array contém exatamente uma linha `{num_id_tit_ap:integer,vl_dolar:number,vl_real:number}` por título fisicamente ligado ao dono. Ausência, duplicidade, título extra ou valor desconhecido falham antes da persistência. Os valores devem vir do helper central de pagamentos; não existe fórmula cambial neste serviço.

Retorno: `{success:true,changes:[{resource:'cta_corren_fornec_imp',operation:'create',recordId:integer,before:{},after:object}],warnings:[]}`. `after` contém os 13 campos físicos e `container_id` sintético da operação de origem. O campo sintético não é gravado no ledger. Tipo4 mantém item_container_id=0, inclusive quando rateia outro item do pedido fora do container. transacao_id permanece0, conforme default legado aprovado. O chamador compõe os eventos e só confirma auditoria após seu próprio commit. Falhas são propagadas por THROW e exigem UNDO do chamador.

## Regras portadas e evidência

Fonte principal `sources/scriptcase/containers/form_itens_container/form_itens_container_apl.php`:

- Criação dos 13 campos do ledger e supressão de valor zero:7112–7161. Sequência de produção é responsabilidade de NextLedgerId.
- Criação de alocação: estorno dos grupos tipo4 dos títulos vinculados ao container (7197–7215,7345–7393), ação1, seguido de rateio tipo5 (7898–8027). A existência de tipo4 é a evidência de pagamento do pedido usada por verifTitPedImp7180–7193.
- Tipo5: peso proforma; denominador usa soma embarcada quando diferente de zero e soma alocada caso contrário; numerador de cada item recorre à alocada quando seu valor embarcado é zero (11410–11460). `ROUND(alvo + saldo5,2)` gera lançamento negativo, ação1 se delta positivo e ação3 caso contrário. Denominador zero segue o ramo explícito de alvo zero do legado.
- UPDATE também sincroniza diferença tipo10 (11984–12060): `ROUND((confirmada-alocada)*negociado-saldo10,2)`, ação2, título0. Se confirmada zera ou iguala alocada, preserva tipo10 anterior e emite aviso. Mais de um grupo anterior é ambíguo e falha.
- DELETE: rateio5 dos remanescentes; grupos5 do item removido geram tipo6 com sinal inverso e ação3 (7292–7343); pedido habilitado re-rateia títulos elegíveis em tipo4 por quantidade comprada vezes negociado (7686–7815). Peso total zero falha antes de obter IDs.
- Título ligado a container com itens bloqueia re-rateio do pedido (9055–9067). Mais de um dono de título falha explicitamente. Fornecedor diferente do mestre é permitido, conforme ramo expresso7983–7988.

Não implementa manutenção global de pedido, previsão tipo3, fórmulas de custos, versões ou sincronização fiscal.

## Transação e consistência

Exige TRANSACTION ativo. O chamador mantém mestre/item bloqueados. O serviço obtém mestre EXCLUSIVE NOWAIT, pedidos EXCLUSIVE em ordem de PK, itens do pedido SHARE em ordem de PK e ledger relevante EXCLUSIVE em ordem de PK. Referências são descobertas NO-LOCK e os valores financeiros são relidos sob bloqueio antes do plano. Links de títulos e conjuntos de itens são lidos SHARE NOWAIT. Não libera locks antes do efeito; a transação raiz pertence ao chamador.

Todos os deltas são planejados e validados antes de chamar NextLedgerId. As linhas virtuais de planejamento têm a mesma precisão de centavos da tabela para preservar a leitura dos saldos entre fases. Ledger físico vl_lancto é DECIMALS2. Não há serialização de novos inserts externos nos conjuntos consultados; a consistência depende também de outros escritores respeitarem os mesmos bloqueios dos pedidos/itens. Os testes TT não demonstram concorrência real do ERP.

## Verificação

Runner `CompileContainersItensFinanceiroTests.p`, fixture `ContainersItensFinanceiroFixture.i`, testes `ContainersItensFinanceiroTest.p`. OpenEdge12.8 auxiliar, UTF-8, AMERICAN e EUROPEAN:82 verificações por cultura (40 regressões do ciclo dos itens e42 verificações de associação/desvinculação). Casos: tipos4/5/6/10, fornecedores diferentes, ausência de delta, ramo legado tipo10 mantido, flag de previsão, elegibilidade, ambiguidade de título, zero peso, arredondamento/sinal, callback incompleto/duplicado/null, contexto, login128 preservado/129 rejeitado, sequência colidente e rollback após primeiro lançamento. Somente TT e sequência double; nenhuma sequência ou linha de negócio real foi usada. Compilação12.2/publicação são responsabilidade do root.

## Callbacks privados de associação e desvinculação

A ABI dos sete buffers e os três callbacks permanecem iguais. `associate`/`disassociate` são operações internas do writer do vínculo, não endpoints públicos deste serviço. O contexto continua fechado nos quatro campos operation, container_id, before, after. O snapshot presente do vínculo é **exatamente** `{container_id:integer,num_id_tit_ap:integer}`, com IDs numéricos positivos int32; não passar aqui os sete campos físicos do audit público do vínculo. O lado ausente deve ser `{}` ou null.

| Operação interna | Momento da chamada | before / after | Plano financeiro |
|---|---|---|---|
| associate | Depois do INSERT do vínculo, dentro da mesma transação raiz | ausente / vínculo | `ReverseOrderAllocation` para TODOS os títulos C do container, depois `AllocateContainer` para TODOS os títulos e itens. Reutiliza integralmente as fórmulas e persistência dos tipos4/5. |
| disassociate | Antes do DELETE do vínculo, dentro da mesma transação raiz | vínculo / ausente | `GroupHistory(56,...)` é seletor interno de SUM5+6 do título, GLOBAL e agrupado por fornecedor/item do pedido/item de container; `ReverseContainerPayment` acrescenta tipo5 com sinal inverso, ação3. Depois reutiliza `AllocateOrder` para TODOS os títulos do único pedido, quando a previsão estiver habilitada. Não executa AllocateContainer, tipo6 novo, tipo10 ou conversão dos pagamentos C. |

A presença física do vínculo selecionado é obrigatória nas duas fases. O serviço nunca insere/exclui esse vínculo nem modifica o mestre. Mais de um pedido do título ou mais de um container dono falha antes de IDs/persistência; a elegibilidade usual continua validando essas ambiguidades. Na desvinculação, somente o bloqueio de elegibilidade por container com itens é ignorado após a validação, reproduzindo o argumento TRUE do legado. A flag log_considerar_previsao continua obrigatória e respeitada. Sem vínculo a pedido, preserva o legado: estorna o histórico5/6, se existir, sem inventar pedido/rateio4. Peso zero de pedido habilitado falha explicitamente antes da primeira sequência.

O agrupamento GLOBAL pode produzir uma linha de estorno cujo item_container_id está fora do container atual, inclusive já excluído, e cujo fornecedor/item de pedido difere dos itens atuais. Esses campos vêm do histórico do título selecionado, nunca do cliente. `after.container_id` permanece a origem confiável da operação, não uma afirmação de afiliação física desse item histórico. O chamador/importador deve provar o título selecionado e o escopo de seus títulos de pedido; não eliminar grupos históricos por CID. A seleção interna56 não é cod_tipo_movto persistido: somente novos tipos4/5 são produzidos por estes dois callbacks.

O runtime entrega os dólares/reais pelo mesmo helper central existente. Associate coleta C uma vez; disassociate coleta O uma vez para o pedido habilitado. Todos os planos são validados antes de NextLedgerId, usam login autenticado1..128 e transacao_id0. O serviço retorna apenas changes/warnings pendentes e não libera locks, comita, publica audit nem declara committed. O writer deve manter o mutex EXCLUSIVE/NOWAIT do título EMS5 (sem alterar campos), além da transação de vínculo/mestre/fiscal. Qualquer falha posterior exige UNDO de todo o chamador.

Evidência adicional: `docs/containers-pagamentos-associacoes-inventario.md`, fontes A7612–7619/P7613–7620 para associação; D7651–7654,8669–8763 para estorno GLOBAL5/6; D9090–9112 e8960–9022 para resolução de pedido e força de TODOS os títulos antes de DELETE. A composição fiscal, stale e auditoria pública pertencem ao novo writer e não foram alteradas aqui.

TDD local: a primeira execução dos novos testes falhou em associate com ITEMS_FINANCE_CONTEXT/Operacao nao suportada; após a extensão,82checks por cultura. Novos casos incluem ALLC, sem itens, proforma zero, SUM5+6 e sinais/zero, grupo histórico global/outro fornecedor, força de outro título ligado a outro container não vazio, flag desabilitada/desconhecida, peso zero, callbacks incompletos/duplicados/null, título ambíguo por pedido/container, snapshots fechados/IDs inteiros/fase física, planos repetidos sem delta, rollback do INSERTlink e ledger após falha do participante e rollback de DELETElink/ledger após falha posterior do chamador. Fixture TT físico já tinha todos os campos necessários e foi preservado. Não houve rede, sequência ou negócio real;12.2 e publicação são do root.
