# Revisão op1053 — consulta MED de NFs disponíveis

Candidato funcional somente leitura. Reaproveita a rota, autenticação e os dez handles do financeiro existente; acrescenta `nfs-disponiveis` read/get. `NfKey`, `NfRow`, `AddField`, `AcceptRow`, pagamentos e o contexto empresarial antigo estão byteidênticos. O teste também compara a mesma chave opaca entre NF disponível e NF vinculada.

A origem foi rastreada pelos eventos reais: `bl_selecao_nf` usa o nome nominal `desassociar`, mas abre a grade de disponíveis e habilita **Associar NF Importação**. A consulta exige natureza iniciada em 3, fornecedor/estabelecimento diretamente do container e situação eletrônica 3. A exclusão usa somente o documento de todos os vínculos daquele container. Série, natureza, emitente e estabelecimento do vínculo não substituem essa regra pela PK6.

O novo recurso exige MED antes de criar o buffer ERP; antigos recursos continuam com suas próprias regras. Não há novo mapping obrigatório em empresas, seleção de banco pelo cliente, conexão alternativa ou cache de parâmetros IMA. O wrapper mantém suas dependências de conexão já existentes; a include IMA permanece direta/NO-LOCK. O PHP fecha fonte/binding/rota, valida contexto e aliases opacos, proíbe todos os writers e valida os 18 campos brutos antes de extração/mapeamento. O conjunto continua com filtros, ordenação e paginação locais nativos; o limite upstream não é apresentado como paginação remota.

O link parte do **cabeçalho op1000/ciw.containers**, usando `container_id`, inclusive sem NF/despesa vinculada. O delta preserva o link Painel existente e propõe versão 1.0.3 sobre o export vivo 1.0.2. A fonte financeira recebe somente duas operações aditivas (list/detail), preservando quatro operações e autenticação. Os previews sanitizados são apenas entradas locais de teste; não são payloads de substituição da fonte.

## Evidência local

- RED ABL: recurso inexistente. RED PHP real: resposta fora MED aceita. RED adicional: scalar inválido produzia 422 antes do guard; validação foi movida para antes de extrair os itens. RED de collation reproduziu exclusão case-insensitive silenciosa.
- ABL 12.8 diagnóstico: **39 checks novos + 231 financeiros, em quatro combinações UTF-8/ISO8859-1 × AMERICAN/EUROPEAN = 1.080 checks, NUMDBS0**. Inclui fronteiras 200/201 e 50.000/50.001, ausência parent565, aliases, contexto cruzado, NULL, documento apenas e collation. Wrapper real compilado com a tabela de parâmetros substituída por TT somente na fixture, nunca executado.
- PHP focado: **32 testes / 218 asserções**, incluindo handle/read/get com transporte injetado, resposta TT real, normalizer + validateExternalDraft reais e regressões API/contexto. Suite canônica completa com o Action candidato: **885 / 5.841**, sem falhas.
- Native CrudDefinitionValidator + AJV2020: definição efetiva com permissões resolvidas; negativos de shape/contexto. Kendo real em `file://`: lista/detalhe, 18 campos readonly, CID obrigatório/imexível, chave opaca, navegação do cabeçalho sem filhos, zero writers e zero requisições de rede. **19 checks**.
- Prova por bytes: aplicação e reversão exatas de três patches; nenhum EOL alterado fora dos anchors. Action baseline build8 `41d2a8ff9377b7bd7a7df9106d2dc557a58f607153149c82ed2f64adc1ccfcc7`; Builder real de testes `72c6dafbfa0e93196b443ec45cd6d7c743fddd6415719febd70a0965d1fe18ee`.

## Limites e gates

Esta é conversão **parcial** da origem: apenas leitura MED de disponíveis. Fluxo IMA e os writers de associação/desassociação ficam separados; o DELETE legado omite natureza e emitente. Nenhum inventário global foi alterado ou origem encerrada.

Limite de 50.000 linhas processadas nas consultas fixas (não mede IO interno de índices), STOP-AFTER 10s e 200 candidatos elegíveis examinados. A 201ª NF ou 50.001ª linha recusa 503 sem dados parciais. GET pode encerrar ao encontrar sua chave. Exportação nativa pode pedir take=1000, mas recebe o mesmo conjunto validado de até 200.

NULL do documento vinculado é interpolado como string SQL vazia pelo PHP legado, sem TRIM. A construção PHP foi exercitada; a lógica SQL de três valores foi modelada explicitamente. **Não houve execução SQL/ODBC nem mudança nos gates 1040/1041/1048.** Quando não há exclusão byteidêntica suficiente e existe comparação potencialmente ambígua de caixa, espaços nas extremidades ou Unicode, o recurso recusa 422 `CONTAINER_NF_COLLATION_UNPROVEN`. Não usa normalização para decidir inclusão. Ordenação nativa determinística por documento/série não é alegada como ordem literal do SQL legado sem ORDER BY comprovado.

Pendente do root: revisão independente, composição somente se os três hashes baseline ainda corresponderem, compilação oficial OpenEdge12.2/.42, publicação coerente e validação PASOE sursum-api/MED. Cadastro/publicação da metadata e eventual nova permissão de leitura dependem dos gates do root; nenhuma concessão foi preparada como executada. Não houve SSH, escrita de negócio, sequências, DDL, grants, upload ou publicação neste pacote.

## Reexecução isolada

Com entradas já preparadas/pinadas e sem regenerar metadata ou patches:

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-nf-available-readonly/tests/verify-all.ps1
```

Suite PHP canônica completa, executada e registrada separadamente:

```powershell
php D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --no-configuration --do-not-cache-result --bootstrap integration-src/ciw-completion-20261028/container-nf-available-readonly/tests/bootstrap.php --log-junit .runtime/ciw-completion-20261028/container-nf-available-readonly/php-canonical-full.xml D:/opencode/construtor-pg/backend/tests
```
