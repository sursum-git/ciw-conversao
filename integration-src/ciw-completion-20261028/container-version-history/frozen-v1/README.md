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
- `metadata/source-patch.json` acrescenta somente duas operações por código único sobre
  snapshot oficial118/SHA256. Root deve compor com outros deltas sem substituir118.
  `metadata/parent-patch.json` propõe um link contextual em op1005 e versão1.0.1.
- `baselines.json` fica na raiz. Cinco patches compartilhados, nenhum aplicado por este
  executor: dispatcher, leitor, serviço central, transporte e verificação de contexto PHP.
  Aplicar somente após comparar SHA256 do alvo; não sobrescrever diffs canônicos.

Verificações executadas: PHP transporte RED (registro ausente)→GREEN21checks e lint
dos dois PHP propostos; metadata/schema41checks. Diagnóstico OpenEdge **12.8 local,
desenvolvimento apenas**:8fontes compiladas, TT28checks novos+189regressão central em
AMERICAN e EUROPEAN, NUMDBS0. Os `.r` estão privados e NUNCA devem ser publicados.
As falhas de compilação iniciais de nomes reservados do harness/novo adapter foram
corrigidas antes do GREEN. Não confundir isso com validação oficial12.2.

Gates restantes: revisão independente; compilação oficial12.2/.42, quatro combinações
UTF8/ISO8859-1×AMERICAN/EUROPEAN; regressão adicional Composition/Boundary central;
integração por hashes, publicação sursum-api/med/9911 e validação readonly PASOE/runtime
por root. Acesso humano não foi concedido. Nenhum teste de negócio, grant, DDL ou
sequência foi executado. Segredos não constam deste pacote.

Fila imediata no mesmo pacote: lookup atual da primeira filha e as outras seis views
de histórico, descritas na reconciliação. `op1036` permanece reservado e NÃO usado.
Não afirmar conversão das sete abas, de cons_det inteiro nem do menu de containers.
