# Incremento auxiliar após wave1 — somente proposta

Este pacote acrescenta somente op1036/pagamentos, op1037/NFs, op1038/descontos e
op1039/despesas históricas. Não contém o serviço principal de histórico, sua API,
seus metadados ou suas duas operações já integradas. Não contém VersionService,
fórmulas de custo, frontend ou bibliotecas Kendo. Reutiliza a operação consultar
do serviço central para obter o MESMO snapshot persistido dos cinco grupos.

Quatro patches compartilham baselines SHA256 dos canônicos **após wave1**:
dispatcher/read-service e dois PHP. Preservam os dois recursos fiscais e histórico
principal que já estão nesses arquivos. Nunca aplicar patches cumulativos v2/v3.
Nenhuma escrita canônica foi feita por este executor.

`dictionary-proof.json` confronta os quatro dicionários oficiais12.2 atuais obtidos
pelo root com os anteriores: nomes/tipos/extents/índices iguais. NF conserva PK
versão+documento+série+estabelecimento+natureza+emitente; pagamentos/descontos usam
versão+ID físico. Todos ganham contexto container/versão e record_key completo.
`NULL` não vira zero. Todas as telas são readonly/read/get, página máxima200 e
orçamento central agregado50mil/10s. Alias id/record_key deve ser literal igual.

Despesas: WHERE vl_prev conhecido>0 preservado. A PK única versão+despesa torna cada
GROUP BY versão+despesa+log_custo um singleton: SUM dos três campos é o próprio valor,
inclusive NULL. Não foi criado somador, fórmula de custo ou cálculo financeiro.
A flag NULL fica fora da chave física e continua visível como NULL.

Aprendizado do PASOE incorporado no NOVO serviço auxiliar: FIND-FIRST NO-ERROR ignora
somente565 (ausência→404); qualquer outro erro de leitura continua503. TT inclui
missing parent, erro de consulta por schema incompatível e ausência de dados parciais.

Validação local de desenvolvimento: OpenEdge12.8, seis compiles por código de página,
24checks TT em CADA UTF8/ISO8859-1×AMERICAN/EUROPEAN, NUMDBS0. PHP REAL via serviço
readCiwErpPage e GET/map:6testes/41asserções, RED no canônico sem registro auxiliar e
GREEN no staging, dois lints. Não é compilação12.2 nem validação PASOE.

São oito operações novas por append, sem repetir as duas de histórico principal.
Os quatro links do pai são aditivos, preservando o link de itens já publicado.
Antes de publicar, executar `finalize-metadata.cjs` com snapshots exatos da fonte e
de op1005 APÓS wave1: a ferramenta só gera patches/guards; não escreve na aplicação.
Não utilizar o snapshot antigo118 como baseline. Os guards foram fechados com a
fonte124 pós-publicação e op1005 publicado1.0.1; simulação local preserva todas as
124operações e o link histórico, resultando132operações/5links e pai1.0.2.
O patch do pai aponta o export como prova; criar nova versão draft nativa, sem
mutação in-place da versão published/archived. Aguarda revisão independente,
compilação12.2 e provas reais readonly pelo root.

Limites de reconciliação: descrições ATUAIS de item, emitente e despesa ficam no
FUTUREv4, ainda isolado e com gate de alias/dicionário; não as substituir por texto
histórico inventado. Comparações BRL/USD permanecem separadas, aguardando prova SQL
de divisão por zero/NULL e helper único. Não declarar o detalhe inteiro convertido.
Nenhum grant, DDL, sequência, transação fictícia ou registro de negócio foi escrito.
