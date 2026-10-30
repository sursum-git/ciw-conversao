# Processos de compra — continuação de22/10/2026

Estado: cadastro publicado e validado em consulta/interface. `ciw.processos-compra-med/cd0108/1.0.0`, versão Builder59, aprovação58. Disponível em CIW → Compras. O teste de gravação operacional foi explicitamente autorizado, passou e foi limpo. Nenhum registro próprio permanece no banco.

O fluxo ativo do Scriptcase é `grid_procs_compra → bl_painel_proc_compra → menu_proc_compra`. Os comandos Novo/Dados chamam `form_pub_procs_compra`; `form_proc_compra` é outra versão. Os fontes publicados estão em `root@192.168.0.170:22:/var/www/clients/client1/web2/web/ciw/`; as cópias sanitizadas de análise estão em `sources/scriptcase/purchases/`. Não executar o PHP legado.

A tela publicada `ciw.processos-compra-med`, programa `cd0108`, usa o frontend existente do construtor e metadados JSON. A origem MED aparece na tela. A API resolve a empresa pelo cadastro EMS2=5 e recusa ausência ou ambiguidade. Não foi criado seletor de bancos no navegador. Principal/Observação conservam os campos do formulário ativo; a aba Pagamentos reutiliza `ciw.proc-compra-pagamentos/op1013`. Itens e Anexos ainda não recebem links de conversão integral.

São cinco operações na fonte existente `motor_progress_ciw_cadastros`, pelo mesmo `POST /SursumPrograms/ciw-cadastros`, recurso fechado `procs_compra_med`: consulta, detalhe, inclusão, alteração e exclusão. Há14campos físicos e `row_stamp` de transporte. A chave é gerada no servidor pela sequência existente, avançando somente durante uma inclusão, sob mutex e com limite. A sequência encontrada estava em0 e o maiorID em1679; a publicação não corrige nem avança a sequência. Alterar/excluir exige a versão atual do registro; campos readonly não são encaminhados como valores editáveis.

## Reutilização e integridade

`PurchaseOrdersApi.p` adapta a rota autenticada. `PurchaseOrdersService.p` controla a transação, validação, concorrência e imagens do cadastro. `PurchaseOrderIdService.p` concentra a identidade. O leitor é o `CiwErpReadService.p` já compartilhado. O fluxo financeiro permanece em `ContainersItensRuntime.p` e `ContainersItensFinanceiroService.p`; as novas operações compõem as rotinas existentes de plano, saldo, rateio e persistência. Não há fórmulas financeiras copiadas no formulário ou no PHP.

Ao habilitar a previsão de um processo existente, o financeiro remove os movimentos próprios de tipo maior que2, recria as obrigações3, rateia os pagamentos4 e reconcilia os containers relacionados com as mesmas rotinas5/10. Ao desabilitar, remove os movimentos próprios maiores que2, conforme o legado. Esses efeitos participam da transação raiz e têm limites de duração/quantidade, sem sucesso parcial. Uma inclusão não executa a rotina de alteração financeira.

A exclusão é bloqueada enquanto existirem itens, pagamentos, despesas ou anexos. Trocar fornecedor é bloqueado enquanto houver vínculos ou movimentos dos itens. A função legada que apenas montava SQL para trocar o fornecedor dos movimentos, sem executá-lo, não foi transformada em uma migração implícita. Containers operacionais não são criados pelos testes desta etapa: o trigger de exclusão indisponível continua protegido conforme decisão do usuário.

Os parâmetros IMA continuam na include Progress `sursum-api/includes/parametros_ima.i`, consulta direta `NO-LOCK` sem cache.

## Logs

A auditoria `progress-transaction` inclui usuário autenticado, operação, registro,14campos anteriores/atuais e diferenças. Inclusão tem imagem anterior nula; exclusão tem imagem atual nula. Efeitos financeiros incluem a imagem física dos movimentos, o processo proprietário real e a referência ao processo que iniciou a operação, inclusive quando um recálculo atinge outro processo do mesmo container.

O PHP usa as classes nativas de transação/log do construtor. `RuntimeProgressAuditSchema` compartilha a validação de imagens; `RuntimePurchaseOrderAudit` valida o contrato fechado deste cadastro. A importação exige identidade do usuário e confirmação de commit. O botão Logs do registro agrega os efeitos correspondentes. Logs Exclusão mostra somente exclusões do cadastro principal; apagar movimentos durante uma alteração ou desvincular um título não aparece como processo excluído.

## Validação e retomada

Candidatos: `integration-src/purchase-orders/`. Canônicos integrados: `D:/opencode/motor-progress/v2/sursum-api/{programs,includes}`, testes ABL correspondentes, `D:/opencode/construtor-pg/backend/{src,tests}/Runtime` e `D:/opencode/construtor-pg/integrations/ciw-purchase-orders/`. Publicar somente artefatos de produção compilados oficialmente no OpenEdge12.2 do `.42`, no compartilhamento `.137`, e validar `sursum-api/med9911`; não publicar executores ou fixtures privados nem compilados locais12.8.

Evidências privadas desta etapa ficam em `.runtime/purchase-orders-20261022/`: manifesto canônico, compilação oficial, publicação, provas de leitura PASOE, testes PHP, metadados, interface e teste operacional concluído. Não copiar credenciais, tokens ou dados comerciais para documentação.

O cenário operacional novo usa somente o marcador `SC_TEST_PROC_COMPRA_20261022`, um processo criado pela API e os itens novos2147000205/2147000206. Foi autorizado por resposta explícita do usuário neste cenário; autorizações de cenários anteriores não foram reutilizadas. Dois títulos existentes podem ser apenas lidos, com imagens privadas completas para conferência. As APIs fazem as mutações e logs; a fixture privada cria/remove apenas os dois itens sob manifesto exato. Containers5/10 são verificados em tabelas temporárias. Nenhum teste operacional pode ser declarado concluído sem comprovar os logs e a limpeza.

## Resultado desta publicação

Compilação oficial OpenEdge12.2 no `.42`:21fontes sem erro; nove suítes,267checks em cada combinação AMERICAN/EUROPEAN × UTF-8/ISO8859-1, sem bancos conectados nos testes. A suite PHP canônica passou658testes/4280asserções; vinte envelopes ABL12.2 de inclusão/alteração/exclusão/habilitar/desabilitar foram aceitos pelo parser PHP canônico. Revisões independentes e lint passaram.

Integrados33arquivos canônicos, publicados somente sete pares `.p/.r` e uma include no `.137`, hashes/backup conferidos. Recarregadas somente sessões MED ociosas da `sursum-api`; nenhuma troca de instância, rota, autenticação, schema ou PROPATH global. A fonte existente passou de54para59operações, preservando as anteriores. A Home recebeu um grupo Compras e um atalho; acessos humanos permaneceram iguais.

PASOE e runtime validaram consulta/detalhe/paginação/filtro booleano/entradas inválidas. Edge isolado conferiu50linhas por página, inteiros sem fração, PK/empresa readonly, stamp oculto preservado, defaults, Principal/Observação/Pagamentos e contexto do pedido no op1013. Logs do programa usam `deletions`; o formulário usa `getLogsConfig().mode=recordEvents`, conforme os componentes nativos. Não confundir a configuração do botão do programa com a do formulário. Nenhuma gravação foi acionada por essas verificações.

A fixture privada também foi compilada e testada oficialmente:60checks por cultura/codepage e30guardas PS5, sem banco; o helper HTTP passou10testes simulados. A preparação foi seguida da execução operacional autorizada descrita abaixo; não há registros de teste nem limpeza pendente. Não repetir fixtures encerradas.

## Teste operacional autorizado e encerrado

Processo novo1680 e itens2147000205/2147000206, marcador SC_TEST_PROC_COMPRA_20261022. Inclusão, alteração de observação, reconstrução financeira ao habilitar, remoção ao desabilitar, associação/desvinculação de dois títulos e exclusão passaram pelas APIs nativas. Três negativas409 conservaram as imagens e os vínculos: fornecedor com pagamentos, stamp obsoleto e exclusão com itens.

Foram conferidos29eventos com ator admin da sessão técnica: cinco do cadastro, quatro dos vínculos e vinte dos dez movimentos criados/removidos. Logs do formulário mostrou os14campos antes/depois; Logs Exclusão mostrou usuário e14campos anteriores após a exclusão do pai. Os registros reais e todos os valores dos títulos foram somente lidos e permaneceram idênticos aos recibos privados.

As APIs removeram os movimentos/vínculos; a fixture guardada removeu somente os dois itens com imagens exatas; o pai foi removido pela API com auditoria. Uma leitura física final no12.2 confirmou zero registros próprios e zero alocações. O container sintético não foi criado, mantendo a proteção do trigger. Recibos em .runtime/purchase-orders-20261022/qualified-pair/, revisão independente e business-final-verification.json. Duas seleções inicialmente incompatíveis foram recusadas em leitura e preservadas; nenhum CREATE ou POST confirmado foi repetido. Itens/Anexos e outras origens ainda têm conversões próprias pendentes.
