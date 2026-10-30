# Teste real de associação de pagamentos — concluído em19/10/2026

**Estado vigente: executado, verificado e limpo. Não repetir o cenário.** O usuário
autorizou a leitura de dois títulos e o teste somente no container2147000102.
Associação de adiantamento (transação12698), duplicidade409 sem efeitos adicionais,
desvinculação (transação12730), autoria admin/Administrador e imagens anteriores/
atuais foram confirmadas na API publicada. O título apósDI foi somente consultado.
Os dois títulos e todas as suas linhas de valores permaneceram intactos.

Alocação e mestre foram removidos pelas APIs; cleanup privado removeu somente os
dois movimentos próprios e pedido/item novos por PK e imagem exata. Probe real
12.2 independente confirmou15contadores zerados e nenhum vínculo/ledger global dos
dois títulos; `verify-clean` passou e confirmou GET404 do mestre. Logs preservados.
Provas: `.runtime/container-payments-20261017/{payments-physical-final,
payment-physical-final-confirmation,payments-final-cleanup-verification}.json`.
Guardas de tentativa, imagens e recibos privados devem ser preservados sem replay.
Detalhes atuais em `docs/painel-container-pagamentos.md`.

## Registro histórico da preparação e do procedimento

O texto abaixo registra a preparação e o procedimento executado. Referências a
pendências e execução futura não substituem o estado concluído acima. O launcher
efetivo e seus recibos de setup/cleanup estão em
`.runtime/container-payments-20261019-fixture/v2/`; o recibo ABL original mantém
seu guard separado do guard canônico do harness. O harness final tem10testes puros.

Atualização19/10/2026: o usuário autorizou a leitura dos dois títulos e o cenário
novo com limpeza, preservando os títulos. A fixture externa agora está preparada
em `.runtime/container-payments-20261019-fixture/README.md`: Service/Driver privados
compilados no12.2/.42 e37checks TT em cada cultura, zero bancos conectados. Setup,
cleanup e APIs reais continuam sob execução do root; este agente não os executou.
O recibo ABL original e seu guard são separados do setup canônico do harness.
As indicações abaixo de fixture/limpeza pendentes descrevem a preparação17/10;
o README novo registra o contrato físico vigente e os adaptadores necessários.

Estado: **preparado, não executado**. Nenhuma chamada HTTP, login, compilação remota,
sequência ou escrita de negócio foi feita ao preparar estes arquivos. O root revisa
e executa uma fase por vez depois da publicação oficial e da autorização do teste.

Ferramenta: `tools/construtor-local/exercise-container-payments.cjs`.
Testes locais: `exercise-container-payments.test.cjs`, somente funções puras, sem HTTP.
Diretório de recibos privado: `.runtime/container-payments-20261017/`.

## Escopo fixo e dependências

| Registro novo | Identidade |
|---|---|
| Container | 2147000102 |
| Pedido | 2147000300 |
| Item de compra | 2147000301 |
| Marker | SC_TEST_PAGTOS_20261017 |
| Código ERP sintético | ZTSC171027 |

Título EMS5 **existente emprestado exclusivamente para leitura**, ainda não escolhido.
Não criar/alterar/excluir `ems5.tit_ap`, `ems5.val_tit_ap` ou qualquer documento
financeiro. Seu `num_id_tit_ap` deve ser globalmente único; antes do teste não pode
haver vínculo em `pagtos_container`, `pagtos_proc_compra` nem movimento em
`cta_corren_fornec_imp` para esse título. Se houver qualquer referência, rejeitar o
candidato e preservar os dados. Nenhum título de exemplo foi colocado no código.

O fixture novo de mestre/pedido/item/alocação precisa ser preparado separadamente
e revisado pelo root. **Este harness não cria esses registros e não contém uma
rotina de limpeza física**. Não reexecutar a fixture de Itens de 2147000101. O
pedido/item novos devem atender fornecedor/data/empresa do candidato escolhido,
usar marker e FK exatos, ter uma alocação com base positiva e flags fiscais
explicitamente revistas. Não criar pagamentos do pedido neste cenário inicial.
Não fechar custos, gerar versão, nota, estoque, desconto ou distribuição comercial.

O cenário fechado é uma alocação, um título sem histórico e sem vínculo a pedido:
associação produz um movimento tipo5; desvinculação produz outro tipo5 de estorno.
Valores/sinais esperados são fornecidos pelo root em evidência da rotina financeira
central; o harness não calcula câmbio ou rateio. Tipo4 não é esperado sem vínculo
de pedido/histórico. Cobrir tipo4 requer outro cenário aprovado e outros guards,
não alargar silenciosamente este teste. Não usar um título de valor zero para
declarar validada uma movimentação financeira real.

## Recibos revisados antes da primeira chamada

`payments-real-plan.json` é inicialmente um **template bloqueado** com
`execution_authorized:false` e candidato/valores nulos. O root fornece os dados
do probe, hashes e valores centrais. O harness exige simultaneamente essa flag
true e argumento `--execute-reviewed-plan`; não converte o template em autorização.

`payments-candidate-probe.json`, criado por probe RO12.2 independente, deve ter:

- `success:true`, `readOnly:true`, `at`, `title_id`, `cod_estab`, `title_matches:1`;
- `title`: snapshot físico completo e tipado de `ems5.tit_ap` do título;
- `title_values`: array completo dos snapshots físicos de `ems5.val_tit_ap` ligados
  ao título, com chaves suficientes para todas as linhas/cotações;
- `container_links:[]`, `order_links:[]`, `ledger_rows:[]`, consultados **globalmente**
  pelo título, sem filtro de fornecedor/container/item que esconda referências.

`candidate_probe_sha256` do plano é SHA256 da representação canônica do objeto
completo. `imageHash` ordena propriedades recursivamente e preserva tipos e case.
Para conjuntos de linhas, `rowSetHash` permite ordem diferente sem perder
duplicidades; arrays de campos extent permanecem ordenados dentro da linha.
Não comparar snapshots pela serialização bruta de JSONB.

`payments-fixture-setup.json` deve conter `success:true`, `fixture_created_new:true`,
os cinco campos fixos de escopo, `item_container_id` novo, `order`, `purchase_item`,
`allocation` físicos completos, `order_links:[]` e `setup_guard_sha256`.
O hash é `imageHash({...SCOPE,order,purchase_item,allocation})`, copiado também para
o plano. Os IDs, marker, ERP e FKs são revalidados pelo harness antes do login.
Recibo local não substitui prova de ausência antes da criação nem validação física
sob lock na preparação/limpeza, que pertencem à fixture externa.

O plano também exige `pagamento_key` calculada pelo helper compartilhado para
CID2147000102/estabelecimento/título, `expected_payment:{valor_real,valor_dolar}`,
e `expected_ledger.create/delete`, cada qual com um objeto exato
`{cod_tipo_movto:5,cod_acao:1|3,vl_lancto:<valor>}`. Inclusão exige valor negativo
e ação1; estorno exige positivo e ação3, conforme rotina central atual. Não colocar
IDs de ledger previstos: eles serão obtidos dos logs confirmados da execução.

## Execução futura por fases

Comando base, **não executado durante a preparação**:

```powershell
& 'C:/Program Files/nodejs/node.exe' tools/construtor-local/exercise-container-payments.cjs <fase> --execute-reviewed-plan
```

1. `inspect`: somente read/logs do fixture e lista de tentativas já existentes.
2. Probe físico RO com `phase:'before-create'` → `payments-physical-before-create.json`.
   Deve provar título/valores originais intactos, nenhum vínculo/ledger global.
3. `associate`: confirma mestre marcado, pagamento ausente e opção contextual;
   envia uma inclusão pelo runtime PHP com `record.num_id_tit_ap`, sem valores
   financeiros livres. Confere read/get pelo hash no CID correto e valores esperados.
4. Probe RO `phase:'after-create'` → `payments-physical-after-create.json`.
5. `verify-associated`: exige um único vínculo físico no CID, título/valores intactos,
   evento principal create confirmado, usuário admin/Administrador, before vazio,
   after com imagem do vínculo; confere todos os ledgers da mesma transação e suas
   imagens físicas, autoria, transacao_id0, título/item/pedido sintéticos e sinais.
6. `reject-duplicate`: verifica vínculo existente e envia uma única inclusão repetida;
   exige409 `CONTAINER_PAYMENT_EXISTS`. A tentativa também tem recibo sem replay.
7. Probe RO `phase:'after-duplicate'` → `payments-physical-after-duplicate.json`.
8. `verify-duplicate`: exige resposta409 preservada, mesmo conjunto/imagens de links
   e ledgers; continua existindo apenas um create confirmado. Nenhum novo ledger.
9. `disassociate`: exige verificação da duplicidade e vínculo atual; envia um único
   delete pelo hash contextual. Read deve ficar vazio e get retornar404.
10. Probe RO `phase:'after-delete'` → `payments-physical-after-delete.json`.
11. `verify-disassociated`: título/valores intactos, zero vínculos, delete confirmado
    com before idêntico ao after da inclusão e after vazio; estorno financeiro com
    imagem física exata. Confere também o filtro nativo Logs Exclusão por tela/hash.
12. `cleanup-manifest`: repete verificações RO e prepara `payments-fixture-owned.json`
    com IDs reais e imagens completas dos ledgers. **Não executa limpeza**.

Todos os recibos físicos acima têm escopo fixo, `success:true`, `readOnly:true`,
`at`, `phase`, e os mesmos campos do probe para título/valores/chaves/conjuntos.
`ledger_rows` contém o conjunto global físico do título, não apenas SUM ou IDs.
Isso detecta nova interferência externa, que impede continuar ou limpar.

`once` grava arquivo com criação exclusiva (`wx`) **antes** da chamada mutante.
Uma resposta incerta ou falha depois do commit não libera replay. Respostas HTTP
recebidas ficam preservadas mesmo com status inesperado. Usar `inspect`, logs e
probe físico; não apagar arquivos `payments-real-attempt-*` para tentar de novo.
Não há loop de mutações, retry automático ou compensação automática em finally.
Login/logout usam credencial privada apenas em memória; headers e tokens não são
gravados nos recibos. Logout é tentado em finally, sem repetir negócio.

## Limpeza externa e prova final RO

A limpeza precisa ser uma etapa externa revisada, sob transação e locks NOWAIT,
com manifesto/setup/probe íntegros e comparação por campo/tipo. Ordem proposta:

1. Confirmar novamente zero links do título, EMS5 intacto e ledger exatamente igual
   ao manifesto. Exigir que cada movimento seja novo, tipo5, do título emprestado,
   item de compra2147000301 e alocação nova confirmada. Rejeitar IDs extras,
   históricos, ausências inesperadas, FK externa ou imagem divergente.
2. Excluir a alocação pela API auditada. Como o título já foi desvinculado e os dois
   movimentos tipo5 se compensam, não esperar estorno adicional. Confirmar read vazio
   e get404. Se surgir movimento extra, parar e revisar; não inventar propriedade.
3. Remover **somente** os ledgers listados por PK+imagem exata, e o pedido/item novos
   com markers/imagens/FKs verificados. Não usar DELETE por título, fornecedor ou CID.
   Nunca tocar EMS5. Antes de remover pedido/item, validar ausência de outros itens,
   pagamentos de pedido, comerciais, descontos, versões e custos dependentes.
4. Excluir o mestre pela API após limpeza dos filhos próprios. Despesas/cálculos
   pertencentes ao mestre seguem o cascade auditado existente, não SQL livre.
5. Produzir `payments-fixture-cleanup.json` com escopo, `success:true`,
   `exact_manifest_cleanup:true` e IDs removidos; depois probe independente RO final
   `payments-physical-final.json`, `phase:'final-clean'`, título/valores intactos,
   zero links e ledgers, e `counts` zerados para os15 nomes abaixo.
6. `verify-clean`: apenas leitura/GET404 do mestre e conferência dos recibos. Escreve
   `payments-final-cleanup-verification.json`, sem nova mutação.

Contadores obrigatórios: `parent,order,purchase_item,allocation,order_payment,
container_payment,ledger_by_purchase,ledger_by_owned_items,expense,tax_calculation,
version,item_cost_snapshot,discount,commercial,synthetic_cost`.

O harness não afirma consistência global/serialização de processos externos entre
probe e chamada. O serviço publicado relê locks/elegibilidade; qualquer alteração
externa detectada no título/valores/referências interrompe a validação. Os testes
puros validam guards/comparações, não provam publicação, negócio real ou limpeza.
