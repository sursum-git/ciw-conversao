# Execução aprovada: correções da pesquisa de estoque

## Estado final — concluído22/10/2026

Prevalece sobre a pendência histórica abaixo: acesso administrativo ao111 foi
fornecido e usado somente em entrada protegida. Recarga oficial de duas sessões
med ociosas na mesma sursum-api, sem restart. API ativa e tela Builder
cd0190/iol.estoque-termos-busca1.0.0 publicada (versão60/aprovação59).
Três regras definitivas ativas; testes temporários removidos. Cadastro/home/UI,
concorrência, auditoria e buscas reais concluídos. Nenhuma pendência desta entrega.

Configuração de fonte separada motor_progress_estoque_termos, mesma API/token:
validação da fonte CIW compartilhada exigia contexto inteiro de outros recursos.
Não alterado Builder; removidos somente cinco acréscimos próprios da fonte antiga.
Auditoria PHP e escopo textual dos logs ajustados exclusivamente para esta tela,
com tenant/tela/identidade exata preservados e testes RED/GREEN. Backend final
662testes4295asserções PASS; revisão independente sem bloqueadores.113BO/62cliente/
52JSON/23CRUD por cultura12.2 já publicados, sem alterações ABL nesta retomada.

14consultas de estoque no PASOE real tasilpar: CAMBRAYA/CAMBRAIA e CAIMAN/CAYMAN
comparados; duas/três palavras positivas com duas equivalências novas marcadas,
removidas ao fim. CADASTRO só manteve as três regras aprovadas. Não afirmar que
CAIMAN ELASTANO corresponde a um produto real; a combinação com ELAST. não estava
presente nos três itens CAYMAN consultados. Prova positiva de três regras e ponto
literal também coberta na fixture isolada. Nenhum produto/saldo/WP alterado.

CRUD PHP real incluiu um registro marcado, desativado/incluído, ativado/alterado,
stamp obsoleto recusado e exclusão; auditoria antes/depois/ator e Logs Exclusão
relidos após limpeza. Navegador isolado confirmou grade/defaults/chave imutável
sem salvar formulário. Home assinada ganhou um link, acessos anteriores intactos.

Evidências finais privadas adicionais: med-session-refresh.json,
publication-estoque-termos.json, initial-rules.json, crud-real.json,
confirmed-audit.json, native-record-log-scope.json, stock-real-results.json,
stock-multiword-verification.json, multiword-cleanup.json, ui-verification.json,
home-link-publication.json, final-runtime-read.json, final-verification.json.
Não repetir schema, publicadores, seeds ou fixtures; guardas de tentativa mantidas.

## Histórico de preparação e implantação

Em22/10/2026 o usuário aprovou cadastro próprio e segunda seleção apenas quando
a primeira etapa do pipeline não encontra itens. Todas as palavras originais
com regra ativa são substituídas simultaneamente, uma vez, sem encadeamento.
Etapas de saldo e mínimos nunca acionam outra pesquisa. Escopo BO/cliente/API,
sem alteração da página PHP legada.

Sequência: testes e rotina compartilhada; integração na etapa1; cadastro CRUD
com auditoria e metadados Builder; schema real/preflight; compilação12.2/.42;
publicação137/PASOE med9911; tela; validação e documentação finais.

Cadastro: espec.estoque_termo_busca, termo_digitadoCHAR50 chave única,
termo_pesquisaCHAR100, ativoLOGYES. Regras iniciais CAMBRAYA→CAMBRAIA,
CAIMAN→CAYMAN, ELASTANO→ELAST.. CRUD não altera chave depois da inclusão.

Estado atual: schema criado online em espec/area dados, com3campos. Primeira
tentativa sem modo online aguardou acesso exclusivo e somente o processo proprio
foi encerrado, com PID/comando/data conferidos; guard preservado. Segunda
tentativa NEW OBJECTS concluida e metadados relidos. Nenhuma tabela existente
alterada, nenhum serviço reiniciado.

Produção:18artefatos fontes/includes/r12.2 publicados137+canonical, com hashes e
backup. BO/include pública/cliente/API JSON preservam contratos.113checksBO,
62cliente,52JSON e23CRUD por cultura passaram12.2/.42, quatrofontes SAVE contra
schema real. PHP660testes4292asserções PASS. Revisão independente sem bloqueadores
após rejeitar números científicos na origem/destino; gramática numérica agora
compartilhada. Fonte de schema e metadados de tela preparados no workspace.

Ativação PENDENTE: PASOE ainda executa dispatcher antigo, recurso estoque_termos
retorna CIW_CADASTRO_RESOURCE_INVALID. SSH por chave root@.111 recusado; solicitada
conta/chave autorizada ou recarga med pela equipe. Nenhuma tentativa de adivinhar
senha de outro servidor. Tela Builder e três equivalências iniciais ainda NÃO
publicadas/cadastradas: importador bloqueia antes de mutar enquanto API não ativa.

Ruling: criação online usa prodict/load_df.p com NEW OBJECTS e sem commit com
erros, conforme utilitário oficial Progress. Não forçar schema exclusivo ou
reiniciar banco/servidor para aplicar tabela nova.

Provas privadas .runtime/estoque-termos-20261022/: schema-inspect.json,
schema-reference.df, schema-applied.json, official/, compiled122/,
fixture-source-manifest.json, php-full.log, publish-receipt.json, probe.json.
Não confundir testes/staging com validação real de cadastro ainda pendente.
