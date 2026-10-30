# Candidato op1042 — revisão local

Ponte de manutenção rápida usando o frontend nativo e o core de despesas existente. Atualização em lote sincroniza impostos e invalida versões; exclusão em lote somente invalida versões. Não inclui despesas calculadas, inclusão/defaults ou fórmulas próprias.

## Fronteiras verificadas

- Contexto MED obrigatório em read/get/batch; identidade e definição da despesa imutáveis. Aliases de get divergentes são recusados.
- UI real envia contexto separado e os 14 campos físicos originais selecionados por configuração opt-in. Somente `vl_prev`, `vl_base_imp` e `log_manual` são editáveis. Fluxos sem flag preservam o payload anterior.
- Wrapper valida envelope fechado e cria apenas o campo privado `batch_expected_before`. Core compara todas as imagens contra snapshots adquiridos sob lock, antes de mutação, contador ou callback. Imagem inválida: 422; obsoleta: 409. MED também é validado sob lock para o opt-in. Chamadas internas antigas não precisam fornecer imagem.
- O wrapper conserva `resource` para o adaptador; regressão de wiring cobre essa fronteira. A execução autenticada completa da API pública permanece gate oficial.
- Read/get reais do Runtime recusam resposta cruzada. Batch usa ator da sessão e permissões, registra imagens confirmadas em auditoria nativa e somente eventos técnicos se a auditoria estiver indisponível.
- Commit confirmado com apresentação inválida retorna sucesso com `committed=true`, `auditAvailable=false` e `presentationAvailable=false`. A regressão Kendo real verifica descarte do rascunho e ausência de segunda submissão ao salvar novamente.
- Patch de navegação clona o builderConfig publicado op1003 1.0.2 e acrescenta um rowLink; preserva o link de memória de cálculo e todo o restante. Não modifica a versão publicada.

## Verificação de 28/10/2026

Comando: `powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-expense-batch/tests/verify-all.ps1`.

Resultado: 7 entradas ABL compiladas localmente em OpenEdge 12.8 sem banco; 271 checks por combinação UTF-8/ISO8859-1 × AMERICAN/EUROPEAN; 42 checks do Runtime real com transporte injetado, incluindo respostas TT do core; 12 checks de wiring/preservação do pai; preview Builder; 16 checks JS de saveBatch; 8 checks Kendo real; suíte Kendo batch anterior; PHPUnit batch anterior 28 testes/478 assertions. RED anterior demonstrou stale aceito no core sem seam.

As imagens físicas serializadas são comparadas por tipo, NULL e conteúdo RAW. Os testes cobrem maiúsculas/minúsculas e espaços internos; não afirmam roundtrip de espaços finais físicos. Não foram exercitados banco real, contenção real entre sessões, coleta de 50 mil linhas ou timeout real. Guardas existentes permanecem 50 mil/10 segundos/200 por página; lote público limitado a 100 linhas.

## Gates de integração do root

1. Rever manifest e aplicar patches somente com baseline exato; reader/Runtime já usam o estado após wave1. Rebase se os canônicos mudarem.
2. Compilar API pública, adaptador, core e dependências com OpenEdge 12.2 oficial `.42`, inclusive quatro combinações de charset/formato. Os 7 compiles locais não substituem esta etapa.
3. Integrar rota aditiva ao registro real e decidir cadastro da fonte dedicada com somente 3 operações. Reutilizar autenticação protegida existente apenas em runtime; `authHeaders` do artefato está vazio.
4. Cadastrar op1042 e gerar/publicar conforme governança. Aplicar a navegação sobre clone da versão real op1003 1.0.2 em nova versão, preservando a existente.
5. Publicar somente em sursum-api/med e validar read/get/recusas e sessão/permissões/auditoria reais. Testes comerciais, grants e mudanças de banco exigem escopo separado e não foram executados aqui.

Fiscal readonly v2 permanece congelado. Este pacote não altera inventário global nem fontes compartilhadas.
