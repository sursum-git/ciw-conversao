# Candidato — leitura privada de comparações sem master

Revisão local: nenhum achado bloqueante no recorte preparado. **Ainda requer revisão independente gerente/root e compilação oficial12.2.** Não foi composto lote oficial final, integrado canônico, publicado ou executado negócio. O snapshot17ac continua imutável; este companion é um delta separado.

## Arquivos de produto e ABI

1. `candidate-exact/ContainersVersionService.p`: três hunks sobre o canônico atual `beeda66f…e590`; acrescenta flag privada booleana e condiciona somente o FIND do master na leitura. Não muda assinatura, request/response JSON ou campos persistidos. A flag ausente ou true mantém a exigência anterior; false exige operação consultar e versão específica. List/write/tipo inadequado com a nova flag falham em configuração antes dos efeitos. Não é um modo de contexto/escrita e não cria pai.
2. `candidate-exact/ContainersVersionComparisonService.p`: três hunks sobre o caller congelado17ac `a5618108…e65c`; remove o precheck redundante de pai, fixa a flag no objeto privado construído pelo próprio programa e corrige orçamento/contagem. A allowlist do request não mudou: cliente não pode escolher flag, política, programa, banco ou recurso alternativo.

Seis hunks reversíveis em `byte-plan.json`; byte igualdade fora deles. Candidate central: `ee3ae5fe4fffe10a31150f35160cbaaaeff1938503e8c924a30352d31935bc0e`. Candidate comparison: `2a776af2af8e2c1fc3eae3439d21393d6041bd8892fec7473ff575015cbbe5ed`.

O serviço central mantém byte exato todo o caminho desde `VERSION_TRANSACTION_CONTEXT` até o final, incluindo geração/exclusão/commit/auditoria. `FindVersion`, `CheckReadBudget`, `ChildRows` e `CaptureSnapshot` também permanecem byte exatos. Ownership continua `versao_id AND container_id`; filhos são coletados pelo mesmo versao_id após essa prova. A coleta readonly nunca chama `GetVersionContext` ou `CollectVersionSnapshot`, que pertencem à geração sob transação/pai físico e não foram modificados.

## Dependências e composição futura

Reader físico atual12: baseline `bb4d2362…`; FinanceRead físico12: `ca3a9a4a33f25f7fcf26d670dcdee54eb38d47bf46eb72dd5ea8f211f67a3900`. Nenhum deles recebe delta de órfão. Para exercitar a comparação completa, `test-inputs` contém um Reader composto sobre12, somente com as cinco inserções de comparação já presentes no17ac, mapeadas por spans de bytes iguais. Candidate diagnóstico desse Reader: `8ecee3d853961e297598d533844da711c3f0dca058d7b4c35125fa8575b3581e`. `test-inputs-manifest.json` registra os offsets e os hashes; não aplicar esse arquivo inteiro no canônico.

O helper de labels de17ac é dependência futura já declarada (`item_join`), não implementação nova nem regra financeira copiada. Context e Runtime de versões continuam atuais/inalterados. `test-inputs` reúne o closure para reproduzir o diagnóstico sem recorrer a programas de outro workspace pelo PROPATH. A fixture `CiwMedCompanyContext.p`, necessária ao teste ERP, foi copiada do canônico depois de diagnosticada sua ausência no pacote anterior. Não publicar fixtures, testes, `.r`12.8 ou classes auxiliares.

Composição futura coerente: patch central + caller comparison deste companion, mais o delta17ac rebaseado sobre12 (Reader/Dispatcher/Query/Action/labels), APIs/projeção/materializador existentes e metadados sob os guards atuais. Este companion não fornece permissão, acesso MED novo ou opt-inHTTP. Metadados de comparação continuam sujeitos aos demais gates já registrados; este delta resolve somente a exigência indevida de master.

## Orçamento

Antes: caller lê master1; central lê master1; central conta versão1 e cada filho; materializador inicia `3+filhos`, com reserva2 e teto interno49998. Agora não há nenhum FIND master no caller, e a central o dispensa apenas no opt-in; central conta versão1+filhos e materializador inicia `1+filhos`, teto50000. Não existem resultados parciais confirmados em limite/timeout. O teste com `read_max_rows=1` recusa versão+um filho e não expõe snapshot; limite2 aceita exatamente ambos. STOP-AFTER10 do caller cobre a chamada central, joins e leitor; sua duração externa e os testes de paginação permanecem. O teste local não simula bloqueio físico ou prova tempo real do PASOE.

## RED/GREEN e fronteiras reais

* RED no serviço canônico: quatro logs UTF-8/ISO8859-1 × AMERICAN/EUROPEAN, falha no check5 `private selected-version read accepts real orphan snapshot`. Os quatro checks anteriores confirmam o comportamento404 antigo. RED reexecutado com a mesma fonte final do teste.
* GREEN diagnóstico12.8: oito compiles explícitos, zeroDB; sete suítes,28logs, **372×4=1488checks**. Novas Policy32 e ComparisonService29; regressões centrais189, History38, Aux28, ERP47, Purchase9. O harness valida saída/log; exit0 sozinho não vale como PASS.
* TT confirma pai ausente sem fabricá-lo, versão física+filho real nas tabelas TT, NULL distinto de0, ownership, inexistência, budget, não exposição de audit/commit, BRL/USD,205linhas/página200/segunda página e GET com chave opaca original. Mantém inner join atual: alocação deletada exclui a linha como na origem.
* Chamada real ao `ContainersVersionHistoryService` com órfão continua404; payload bruto com `read_require_master=false` retorna422, antes do master. Request central com a flag ou objeto `policy` também422. `ContainerProcessRequest` real, include canônica do boundary de processos, rejeita a flag em gerar antes de qualquer callback/escrita. Comparison caller também rejeita flag/policyHTTP422. Não se usou API mock para provar essa fronteira.
* Os wrappers físicos fazem conexão e buffers fixos antes do serviço; não foram executados sem banco para fingir uma provaHTTP. O diagnóstico é no boundary reutilizado real com TT; transporteHTTP/PASOE real é gate oficial posterior.

Falhas de harness corrigidas com causa comprovada: FIND-FIRST usado no próprio teste de ausência sem NO-ERROR gerava565; parser do runner esperava palavra `checks`, enquanto o log histórico termina `NUMDBS=0`; o teste ERP dependia de `CiwMedCompanyContext.p` ausente do closure copiado. Nenhum desses ajustes mudou produto para mascarar uma falha.

## Gates de liberação

Review independente, composição por hunks com o estado atual, compilação12.2/.42 com referências físicas e testesNUMDBS0, publicação coerente do closure e PASOE RO pelo root. Sem export atual ou autorização de publicação não há atualização de metadados/grants. Este snapshot só é candidato revisável, não tela/runtime entregue.
