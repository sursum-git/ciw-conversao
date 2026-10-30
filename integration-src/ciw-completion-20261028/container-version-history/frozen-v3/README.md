# Candidato incremental — histórico de itens da versão MED

Estado: **CANDIDATE_READY_FOR_REVIEW**, não integrado/publicado. `RECONCILIATION.md`
registra cobertura e limites reais; `PLAN.md` contém o recorte aprovado pelo gerente.

- `op1035/ciw.container-versao-itens-historico`, entidade `container_versoes_historico_med_progress`.
- Nova API fixa e adaptador chamam `ContainersVersionService.consultar` e o leitor
  `CiwErpReadService`. Nenhuma fórmula, nova coleta de custo ou persistência de negócio.
- `container_id` e `versao_id` obrigatórios; estabelecimento prefixo5/MED interno.
  GET usa chave completa container/versão/item_container_custo_id e alias id/record_key
  comparado estritamente pelo leitor existente. PK física não é versão+item do container.
- Trinta campos: chave de transporte, container e28campos persistidos. Os25campos da
  filha original estão todos presentes; três são provenientes do snapshot central já
  existente. IDs integer, NULL diferente de zero; desconto BRL CHARACTER preservado.
- Página até200; orçamento agregado50mil/10segundos na consulta central, com10segundos
  também cobrindo adaptação/leitor. Falha sem dados parciais. Política privada só permite
  baixar o teto nos testes, jamais é aceita na requisição pública.
- Serviço e assinatura central preservados. `itemFields` do writer/audit e corpo
  `PersistItem` permanecem byte a byte iguais; os dois campos adicionais só são lidos
  quando operation=consultar. Não usar geração ou fechamento como consulta.
- `metadata/source-patch.json` acrescenta somente dez operações por código único sobre
  snapshot oficial118/SHA256. Root deve compor com outros deltas sem substituir118.
  `metadata/parent-patch.json` propõe cinco links contextuais em op1005 e versão1.0.1.
- `baselines.json` fica na raiz. Cinco patches compartilhados, nenhum aplicado por este
  executor: dispatcher, leitor, serviço central, transporte e verificação de contexto PHP.
  Aplicar somente após comparar SHA256 do alvo; não sobrescrever diffs canônicos.

Verificações executadas: PHP transporte RED (registro ausente)→GREEN21checks e lint
dos dois PHP propostos; serviço runtime REAL via mocks de transporte,
41asserções em seis testes de readCiwErpPage e GET/map (contexto cruzado, paginação, NULL/texto bruto
e alias divergente recusado antes da rede); metadata/schema78checks.
O runtime genérico normalizava alias divergente; o patch PHP restrito à nova entidade
agora compara todos os aliases fornecidos literalmente antes da consulta.
Diagnóstico OpenEdge **12.8 local,
desenvolvimento apenas**:11fontes compiladas, TT28checks de itens+20auxiliares em CADA
UTF8/ISO8859-1×AMERICAN/EUROPEAN, NUMDBS0. A regressão central189checks passou nas
duas culturas UTF8; a adaptação do harness central ISO é coordenada pelo root.
Os `.r` estão privados e NUNCA devem ser publicados.
As falhas de compilação iniciais de nomes reservados do harness/novo adapter foram
corrigidas antes do GREEN. Não confundir isso com validação oficial12.2.

Gates restantes: revisão independente; compilação oficial12.2/.42, quatro combinações
UTF8/ISO8859-1×AMERICAN/EUROPEAN; regressão adicional Composition/Boundary central;
integração por hashes, publicação sursum-api/med/9911 e validação readonly PASOE/runtime
por root. Acesso humano não foi concedido. Nenhum teste de negócio, grant, DDL ou
sequência foi executado. Segredos não constam deste pacote.

Incremento auxiliar: `op1036` pagamentos, `op1037` NFs, `op1038` descontos e `op1039`
despesas, cada qual
com entidade e metadata nativos próprios. Um único `ContainersVersionAuxHistoryService`
projeta snapshot.payments/nfs/discounts/expenses, sem nova coleta ou fórmula. Todos os
campos físicos selecionados das quatro origens estão presentes, com record_key e os dois contextos.
NF preserva documento+série+estabelecimento+natureza+emitente+versão; o teste mantém
duas notas com mesmo documento e estabelecimentos diferentes. Pagamentos/descontos
não têm lookup na origem. NF ainda tem lookup de nome atual do emitente a reconciliar.
Despesas aplica `vl_prev` conhecido e positivo. A PK física única `(versao_id,despesa_id)`
torna cada grupo SQL legado uma linha, logo os três SUM são projeções de identidade,
inclusive para NULL; não introduzimos outro somador/fórmula de custo. Esse raciocínio
exige reconferir a PK no probe atual antes de ativar. O nome atual da despesa ainda
precisa ser ligado ao lookup existente.
O probe oficial atual dos quatro schemas auxiliares foi solicitado ao root; nesta onda
eles usam os schemas oficiais históricos já existentes, gate registrado antes de publicar.

Fila imediata no mesmo pacote: lookups atuais de item, emitente e despesa; comparações
históricas BRL/op1040 e USD/op1041. As comparações derivam quantidade implícita do
unitário persistido e precisam de extração de helper central, sem copiar cálculo nos
adapters. Divisão por zero/NULL no SQL legado ainda exige prova; não inventar fallback.
Não afirmar conversão das sete abas, de cons_det inteiro nem do menu de containers.
