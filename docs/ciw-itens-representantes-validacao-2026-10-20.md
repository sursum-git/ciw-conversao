# CIW — Itens ERP e Representantes ativos

Publicados pelo Builder oficial, versão1.0.0:

| Origem Scriptcase | Tela | Programa | Regra |
|---|---|---|---|
| cons_itens | ciw.itens-erp | cd0101 | ge-codigo entre50 e60, inclusive |
| cons_representante_ativos | ciw.representantes-ativos | cd0102 | dat_desligto desconhecida; projeção DISTINCT |

Perfis reais confirmados por leitura sanitizada: `ems2med → med_pro → ems2med/.111` e `ems5 → ems5_pro → ems5/.111`. Itens expõe it-codigo/desc-item como it_codigo/descricao, sem adicionar regras da BO de saldos. Representantes expõe cdn_repres/nom_pessoa/nom_abrev. A biblioteca auxiliar ticontrole2 não é a origem dessas tabelas.

## Identidade e leitura

Serviço compartilhado `CiwReferenciasService.p`, dois recursos fixos no wrapper `CiwCadastrosCrud.p`, mesma rota POST `/SursumPrograms/ciw-cadastros`, configuração e token atuais. Somente read/get NO-LOCK; nenhum writer, SQL livre ou banco/tabela recebidos do navegador. Código de item textual tratado como literal com QUOTER, preservando apóstrofos. Alias da PK enviado pelo Builder deve representar a mesma identidade.

O diagnóstico encontrou **876 linhas ativas e 438 repetições de código** em representante. Código isolado não pode identificar cada resultado do SELECT DISTINCT. O serviço elimina duplicatas da projeção completa e gera `representante_key`, SHA256 do JSON UTF8 compacto dessa projeção; chave oculta de transporte, sem criar ID físico. Mesmo código com nomes diferentes permanece como resultados distintos. Null é preservado. O JSON OpenEdge escapa `/`; consumidores devem tratar a identidade como opaca, sem reconstruí-la a partir dos nomes. Alteração do nome muda essa identidade de consulta, sem alteração de dados pelo serviço.

Frontend oficial por metadados JSON; filtros, ordenação e paginação existentes. A consulta de origem de itens não define ordem inicial fixa. O runtime usa seu comparador nativo ao receber ordenação; códigos textuais inteiramente numéricos podem ter ordem diferente da consulta ABL. A prova de paginação compara duas páginas com uma consulta combinada usando a mesma ordenação, sem alegar igualdade entre comparadores. Não foi alterado PHP/frontend/Kendo. A API lê o subconjunto inteiro, sem truncamento silencioso.

## Evidências executadas

- OpenEdge12.2/.42: serviço, wrapper e teste compilados sem erro. **48 verificações em cada combinação de AMERICAN/EUROPEAN e UTF8/ISO8859-1**, incluindo hash esperado calculado independentemente para nome acentuado, grupos49/50/60/61, ativos/desligados, DISTINCT, mesmo código com nomes distintos, null, apóstrofo/injeção, aliases divergentes, identidade inválida, vazio e recusa de escrita. Fixtures somente em TT; diagnóstico12.8 não publicado.
- Publicação de quatro artefatos p/r no compartilhamento137 via111 com guarda de hashes, backup e rollback. Nenhuma rota/configuração alterada. Recarga oficial somente das sessões med ociosas de sursum-api.
- PASOE e runtime: **4.373 itens e438 representantes distintos**. Contagem, agregação de códigos/comprimentos e primeira projeção exata comparadas com diagnóstico NO-LOCK independente12.2. Campos, identidades únicas e hash UTF8 conferidos em todos os resultados de representantes.
- Detalhe, filtros visíveis, total filtrado, paginação consistente, alias divergente, campo SQL, operação de escrita e token ausente testados. Nenhuma escrita de negócio ou fixture operacional; não houve registros para limpar.
- Quatro cadastros anteriores, Parâmetros IMA e as duas consultas de fornecedores continuaram lendo com o wrapper final. Metadados das novas telas impedem inclusão/alteração/exclusão.
- Revisão independente sem bloqueadores. Conferência visual permanece pendente; sessão humana preservada.

Na validação do próprio verificador, duas suposições foram corrigidas após investigação: ordem ABL e ordenação nativa não são necessariamente iguais para códigos numéricos textuais; o JSON OpenEdge escapa barras, ao contrário de JSON.stringify padrão. Nenhum ajuste de regra de negócio foi necessário. O primeiro preflight ocorreu antes de terminar a recarga med e recusou o artefato; aguardado o recibo e repetido com sucesso, sem republicação desnecessária.

Observação menor da revisão: o importador com `--validate-only` registra as operações da fonte compartilhada e valida os drafts sem publicar telas. Usar essa opção ciente desse efeito; o ajuste para torná-la estritamente sem gravação foi adiado. O lote foi publicado pela execução normal.

## Registro e continuidade

Fontes em `integration-src/ciw-referencias`; canônicos em motor-progress/v2/sursum-api/programs, teste em tests/abl/ciw-referencias, metadados em construtor-pg/integrations/ciw-referencias. Sincronização condicionada ao hash anterior do wrapper, preservando os recursos já publicados. Scripts antigos de sincronização devem recusar a nova baseline.

Evidências privadas `.runtime/ciw-referencias-20261020/`: compiled122/, active-manifest.json, real-validation.json, referencias-coverage.json, canonical-manifest.json, recibos de publicação/recarga e progress.md. Credenciais não são gravadas em fontes ou documentação.

Inventário mantém as pendências de cotações, títulos/notas, logs e cadastros com origem ainda não confirmada. Permissões CIW por último; Conta corrente fornecedor permanece excluído. Sem concessões de negócio, alterações em contas humanas, schema, commit/push ou reseed.
