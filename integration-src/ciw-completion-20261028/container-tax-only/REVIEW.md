# Revisão local — op1043 tax-only

Origem: `sources/scriptcase/ciw-completion-helpers-20261028/bl_calcular_impostos_container/index.php`, evento5098–5113. Cria cálculo, calcula impostos e gera despesas fiscais; redireciona ao grid de despesas. Não chama IPI ou despesas calculadas nesse evento. A própria sincronização anterior continua executando impostos+IPI e mantém sua ABI.

## Implementação

Nova operação fixa `resource=impostos,operation=calcular_impostos` na composição existente de processos. `ContainersImpostosService.p` mantém assinatura e extrai o despacho já existente para uma única rotina interna; a nova operação chama exclusivamente TaxPlan e PersistPlan centrais. Não há fórmula, coletor, persister, sequenciador ou regra de custo duplicados. A memória fiscal é criada pelo mesmo PersistPlan. O comando explícito conserva cabeçalho e versões conforme origem; invalidação do CRUD de despesas permanece separada.

O wrapper existente conserva autenticação ContainerApiLogin, bindings fixos, ContainerMaintenancePolicy e include parametros_ima.i direta/NO-LOCK/sem cache. A fronteira pública aceita somente contexto, operação/recurso fixos e request_id opcional. MED é validado antes da composição e sob EXCLUSIVE-LOCK do mestre, antes de cotação, IDs ou efeitos. A raiz recusa transação externa; o core mantém resultado pending em composição e a raiz confirma somente depois do commit.

Somente a nova operação tem coleta máxima de50mil linhas e deadline STOP-AFTER10s. STOP ou excesso desfazem a transação inteira, sem auditoria confirmada/log de sucesso. As operações anteriores não recebem requisito ou limite novo.

ProcessEngine nativo op1043 usa a entidade `container_processos_progress` existente e permissão própria `container_calcular_impostos_progress.process`. Abrir/cancelar não executam. Fonte sanitizada real recebe uma operação aditiva5→6, preservando as5anteriores e autenticação global. Não há entidade/tabela física nova, DDL, fonte alternativa, frontend paralelo ou mudança Kendo. Navegação adiciona rowLink sobre clone do builderConfig real op1003/1.0.2, preservando a memória de cálculo; rebase é obrigatório se1042já tiver publicado nova versão do pai.

O caminho process real do Runtime exige binding fixo, contexto e ator autenticado. Novo helper reutiliza esquemas físicos centrais para exigir imagens completas do mestre, cálculo e despesas, com NULL/tipos preservados. Audita apenas cálculos/despesas, ator igual ao da transação e mestre MED sem alteração. Prova inválida após commit retorna aviso de confirmação sem sugerir reexecução e sem inventar imagens. Apresentação inválida póscommit também permanece confirmada.

## Evidência local

Comando: `powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-tax-only/tests/verify-all.ps1`.

- RED TT: core anterior recusava operação tax-only. RED Runtime: resposta TT real não era reconhecida para auditoria da nova operação.
- OpenEdge12.8 local, NUM-DBS=0:9entradas compiladas; core160 + sync anterior11 + raiz tax-only16 + boundary/IMA32 =219checks em CADA combinação UTF8/ISO8859-1 × AMERICAN/EUROPEAN.
- Core real: impostos/custo não recuperável, memória, imagens, IPI anterior preservado e nenhum IPI novo, itens completos/cabeçalho/calculadas preservados; rollback após escrita parcial; cotação interna stale sem IDs; STOP injetado; coleta real acima de50mil bloqueada antes deIDs. Raiz real: MED sob lock, transação externa recusada, log póscommit falhando sem negar commit.
- PHPUnit53testes/364assertions:5testes novos/87assertions no process real com transporte injetado e resposta TT real, mais regressões de processos/auditoria/Builder. Cobriu contexto, parâmetros livres, permissões/ator, domínio da rota, resposta parcial/cruzada, effects de item indevidos, pending, committed e conflito de transporte409.
- Builder nativo real gera processo/contexto/confirmacão; ProcessEngine/Kendo real13checks, incluindo abrir/cancelar, confirmação, contexto imutável, falta de contexto, permissão e URL de navegação. Smoke de processos anterior preservado. Wiring/fonte/pai12checks.

## Limites e gates do root

Não houve banco real, negócio, autenticação PASOE, contenção real entre sessões, grant, DDL, integração ou publicação. O teste de STOP injeta STOP no callback dentro do bloco limitado; não mede o relógio real de10segundos. A API pública completa foi verificada por wiring; a composição real de serviços foi executada com TT. Isso não equivale à execução autenticada do wrapper público.

Antes de integrar: revisar/aplicar6patches com SHA baseline exato, instalar o helper PHP e testar a composição com os deltas1042/outros. Root prepara build5 em paralelo: se hashes mudarem, rebase por mudanças declaradas, sem substituir canônicos por cópias de stage. Compilar wrapper/serviços/includes/dependências no OE12.2/.42 e repetir quatro combinações. Preservar5operações e autenticação real da fonte; não substituir fonte real pelo preview sanitizado. Publicar op1043 e nova versão do pai pela governança nativa, somente sursum-api/med. Validar read/get auxiliares existentes e negativas do comando no PASOE/Runtime, sessão/permissões e Logs reais; qualquer teste comercial é outro gate do root. Não conceder acesso por este pacote.

Fiscal v2 e lote1042 permanecem congelados; op1044 está fora do escopo.
