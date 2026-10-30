# CIW — itens e representantes ativos

Continuação solicitada após a publicação das consultas de fornecedores. Reutilizar o frontend oficial por JSON e a autenticação atual; permissões CIW no final e Conta corrente fornecedor fora do escopo.

Escopo de implementação: cons_itens (perfil ems2med → med_pro → ems2med/.111), seleção inclusiva ge-codigo50..60, campos it-codigo/desc-item como it_codigo/descricao; cons_representante_ativos (perfil ems5 → ems5_pro → ems5/.111), dat_desligto desconhecida, projeção distinta cdn_repres/nom_pessoa/nom_abrev, ordem cdn_repres. Não acrescentar regras da BO de saldos, filtros de permissão ou alterações de negócio.

1. Confirmar tipos/chaves reais por leitura delimitada. Serviço compartilhado fechado para read/get: chave textual de item, chave técnica opaca da projeção distinta de representante, aliases do Builder iguais, NO-LOCK e recusa de operações de escrita/campos livres. Testes TT incluindo limites50/60, desligados, acentos/null, apóstrofos/injeção, IDs inválidos, aliases divergentes e listas vazias.
2. Adicionar somente dois ramos fixos ao wrapper existente. Compilar12.2/.42, executar testes AMERICAN/EUROPEAN e preservar leituras anteriores.
3. Publicar serviço e wrapper p/r por hashes e backup, recarregar somente med ocioso, registrar duas telas read-only no Builder com filtros/paginação/ordenação existentes.
4. Validar PASOE/runtime contra diagnóstico NO-LOCK independente, testar detalhe/filtros/paginação/recusas e regressão. Uma revisão independente final. Atualizar inventário/contextos, distinguindo validação técnica de conferência visual.

Workspace atual não é repositório Git. Staging próprio .runtime/ciw-referencias-20261020, fontes integration-src/ciw-referencias. Sincronizar projetos canônicos com baseline e preservar alterações existentes; sem commit/push/schema.

Decisão baseada no diagnóstico real:876linhasativas/438repetiçõesdecódigo. cdn_repres não é PK única da consulta. Usar SHA256 da projeção completa em UTF8 como identidade de transporte oculta; DISTINCT por toda a projeção, preservando mesmo código com nomes distintos. Não alterar registros físicos.

## Resultado

Etapas1–4 concluídas:3fontes12.2 semerro,48checks nas4combinações de cultura/codepage,4artefatos p/r publicados,2telasBuilder,leituraPASOE/runtime vsDB e7anteriores aprovados,canônicos/inventário/memória atualizados. Revisão independente sem bloqueadores; observação menor do --validate-only documentada. Visual pendente. Documento de validação: docs/ciw-itens-representantes-validacao-2026-10-20.md.
