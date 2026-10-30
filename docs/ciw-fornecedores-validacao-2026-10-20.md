# CIW — consultas de fornecedores

Publicadas pelo Builder oficial, versão1.0.0:

| Origem | Tela | Programa | Regra preservada |
|---|---|---|---|
| cons_fornecedor | ciw.fornecedores | cd0099 | identific = 2 |
| cons_fornecedor_estrangeiro | ciw.fornecedores-estrangeiros | cd0100 | cod-gr-forn = 2 |

Perfil principal `comum` → DSN `comum_pro` → ems2cad/.111 confirmado pela configuração sanitizada. Biblioteca SQLticontrole2 é auxiliar. Estrangeiros não recebe o predicado identific=2. Ambas projetam código/nome abreviado/nome; estrangeiros também data de implantação ISO, preservando null.

Serviço compartilhado `CiwFornecedoresService.p`, recursos fixos no wrapper `CiwCadastrosCrud.p`, mesma rota POST `/SursumPrograms/ciw-cadastros` e autenticação técnica existente. Somente read/get, consulta NO-LOCK; nenhum SQL/tabela/banco livre vindo do cliente. ID inteiro validado, incluindo alias cod_emitente enviado pelo Builder; aliases divergentes são recusados. Nenhum writer. JSON no frontend oficial, sem alteração Kendo/PHP/frontend. Filtragem, ordenação e paginação locais pelo runtime existente; a API lê o subconjunto inteiro, sem truncamento silencioso.

## Evidências executadas

- OpenEdge12.2/.42: serviço, wrapper e teste compilados sem erro. **27 verificações em cada cultura AMERICAN/EUROPEAN**; fixtures exclusivamente em TT.
- Teste inicial RED por serviço ausente; GREEN24. Validação integrada encontrou o alias adicional enviado pelo construtor no detalhe; RED específico reproduziu a rejeição e GREEN27 comprovou igualdade obrigatória dos IDs. Recompilado e republicado o artefato final12.2. Diagnóstico12.8 não foi publicado.
- Publicação de somente quatro artefatos p/r no compartilhamento137 via111, baseline/hash, backup e rollback; nenhuma rota/configuração alterada. Recarga oficial restrita às sessões med ociosas de sursum-api.
- PASOE real e backend: **4.376 fornecedores**, **140 estrangeiros**. Contagem, soma dos códigos e primeira linha exata conferidas contra diagnóstico12.2 NO-LOCK independente em ems2cad; projeção, unicidade, ordem/dataISO conferidas em todas as linhas retornadas.
- Detalhe, filtro por código, total filtrado e segunda página validados nas duas telas. Operação de escrita/campo SQL recusados; token obrigatório. Nenhum dado de negócio criado ou alterado.
- Leituras dos quatro cadastros anteriores e Parâmetros IMA passaram com o wrapper final. Metadados das duas telas impedem inclusão/alteração/exclusão.
- Revisão independente dos fontes/metadados/publicador sem defeito concreto bloqueador. Conferência visual permanece pendente; a sessão humana não foi substituída.

Evidências privadas: `.runtime/ciw-fornecedores-20261020/` — `compiled122/`, `active-manifest.json` (final), `active-manifest-v1.json` (histórico), `real-validation.json`, `coverage.json`, `canonical-manifest.json`, recibos de publicação e recarga. Não expor configurações ou conteúdos privados. Manifesto de origem sanitizado em `integration-src/ciw-inventory/phase2-source-manifest.json`; PHP gerado apenas lido, nunca executado.

Permanecem: Tipos de Valor e Empresas×Imposto sem origem/schema confirmado; consultas de itens, representantes, títulos, notas e câmbio seguem o inventário. Equivalência visual/navegação global dos cadastros/logs não está integralmente concluída. Permissões CIW ao final; Conta corrente fornecedor continua excluído. Nenhuma concessão de negócio, mudança de conta humana, commit/push/schema/reseed.
