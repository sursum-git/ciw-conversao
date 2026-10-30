# Descontos de importação — consultas nativas somente leitura

op1045 é a consulta geral GLOBAL de cons_descontos_geral; não foi inventado filtro
MED, empresa, fornecedor ou container. Seu formulário cobre cons_det_desconto_geral.
O link por desconto_importacao_id abre op1046, ledger exclusivamente desse desconto.
São duas entidades nativas novas, quatro operações read/get e um rowLink novo entre
elas; permissões próprias de leitura, sem concessões por este executor.

O coletor único aplica a soma dos valores utilizados uma vez por desconto:
vl_utiliz=COALESCE(SUM,0) na lista; vl_utiliz_detalhe=SUM nullable no detalhe;
vl_saldo=autorizado USD−COALESCE(SUM,0) em ambos. Esses campos coexistem em read/get;
o mesmo nome nunca muda de significado por operação. SUM ignora NULL; vazio e
somente NULL preservam soma bruta desconhecida. Negativos não são limitados a zero.
Autorizado desconhecido mantém saldo desconhecido. O cálculo por container/crédito
em ContainersCustoReadService inclui filtros e conversão divergentes e não é esse
saldo; não foi copiado nem alterado.

Todos os campos físicos projetados são preservados. cod_usuario é DATE REAL na
cta_corren_desconto e aparece como Data original, readonly; não representa ator.
O ledger mantém PK física e contexto na chave JSON completa. O PHP verifica
identidade tipada e ownership antes de converter valores, success do upstream,
igualdade literal dos aliases GET e igualdade entre chave solicitada/retornada.

Os quatro nomes atuais estão implementados e filtráveis antes da página: código
ERP/descrição do item, nome abreviado do fornecedor e descrição do motivo. O join
item→item_compra é o mesmo da origem; fornecedor vem de EMS2CAD.emitente sem filtro
identific/empresa; motivo não tem filtro log_considerar_custo. O código ERP e a
descrição são colunas separadas e atuais; nenhum texto histórico foi inventado.
Ausências ficam NULL nas colunas atuais, preservando IDs físicos. Os textos 1Avulso
e2Vinculado ao item do Container vêm do lookup estático da origem e usam dropdown
nativo readonly. Não há concatenação/collation presumida, UPPER ou TRIM de dados.

O helper ContainersVersionHistoryLabels é reutilizado. Seu SHA compartilhado é
9bfe21dc6ff9d86105d7602d376a2adc3cc3b9fe61783a68f7d1cd03f9d100bb, o mesmo do
frozen-lookups-v2. Essa é uma única implementação a instalar uma vez. Não substituir
pelo helper antigo frozen-lookups-v1. A assinatura central não mudou. A API nova de
descontos e seu Service têm seis handles fixos coerentes; o ledger não exige os
quatro cadastros atuais/aliasEMS2CAD, pois a origem ledger não usa esses lookups.

Todo acesso físico é NO-LOCK, sem cache. Pais, ledger e lookups compartilham teto
50mil e relógio10s; o Reader existente faz filtro/ordenação/global/página até200.
Falha fechada sem parcial. Nenhuma regra de geração, exclusão, custo, cotação ou
fiscal foi alterada; nenhuma escrita de negócio, grant, DDL ou conexão SQL nova.

Validação local12.8:9compiles/cp e79checks(18coletor+44read/get+17helper) em CADA
UTF8/ISO8859-1×AMERICAN/EUROPEAN, NUMDBS0; REDs do coletor/leitor/helper preservados.
Compatibilidade adicional com consumidores históricos congelados:10compiles/cp,
79checks(13helper+38principal+28aux)×4, adaptando apenas a fixture para campo físico
codigo_erp, sem remover asserções. PHP real readCiwErpPage/get12testes/57asserções,
transportes simulados sem rede, REDs reais de alias/chave/identidade documentados.
Isso não é compilação12.2 ou publicação: root faz revisão, build oficial e PASOE.

Patches compartilhados são aditivos, com SHA dos canônicos atuais e preservação de
aux/batch. Conferir gates antes de aplicar, rebaseando se nova publicação mudar os
hashes. A fonte tem append132→136 preservando132operações e autenticação ACTUAL;
nunca enviar fonte sanitizada como replacement de autenticação. root valida
metadados nativos e permissões existentes; nenhuma autorização humana foi consumida.

Fora deste recorte: grid_descontos_importacao e grid_descontos_importacao_itens são
contextuais do item; a ponte envia item_container_id_corrente=0, não a consulta
geral. Forms e movimentos de escrita não estão convertidos por estas consultas.
Não declarar essa família inteira convertida, nem afirmar paridade universal de
collation/exportação/formatos somente a partir destes testes.
