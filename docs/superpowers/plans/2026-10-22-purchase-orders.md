# Processos de compra — próxima entrega
> Execução: superpowers:subagent-driven-development para tarefas independentes, revisão final e publicação conforme motor-progress-publicar-pasoe.

Objetivo: converter consulta/formulário ATIVOS grid_procs_compra + form_pub_procs_compra para frontend Builder JSON, reutilizar o financeiro existente e registrar usuário e imagens de todas as alterações confirmadas. Pedido atual é continuação do padrão já autorizado; não reiniciar a arquitetura nem as conversões anteriores.

## Contrato e limites
- Nova tela proposta ciw.processos-compra-med, entidade procs_compra_med_progress, código livre confirmado no Builder antes de cadastrar; a consulta financeira cd0107 existente continua disponível e ganha navegação para o cadastro se compatível.
- Inicial MED explícita (empresa resolvida do cadastro EMS2=5/EMS5=500). Sem seleção livre de banco/empresa/usuário no navegador.
- Mesma fonte motor_progress_ciw_cadastros e rota ciw-cadastros. Recurso fechado procs_compra_med, read/get/create/update/delete. Contextos/identidades estritos.
- Campos físicos14: proc_compra_id,empresa_id,qt_container,cod_situacao,cod_proc_fornec,qt_dias_translado,cotacao_prevista,observacao,dt_registro,fornecedor_id,dt_limite,log_facilid_contato_fornec,log_considerar_previsao,nr_container_original. qt_container/cotacao_prevista preservados readonly conforme formulário ativo. ID por alocador privado concorrente: conferir sequência real; se ausente serializar pelo cadastro MED, alocar MAX+1 sob lock e validar chave única física (não inventar sequência/schema); empresa MED derivada/readonly. Row_stamp opaco server-side para update/delete e conflito409. Inclui fonte defaults reais, sem inferir campos obrigatórios/naturezas.
- DataISO, inteiros sem fração, lógica JSONboolean, textos pelos limites efetivos do formulário (nr_container_original20dígitos, cod_proc_fornec100,observacao16000); FORMATx(n) Progress NÃOécomprimentomáximodecoluna. Campos calculados de apresentação não são colunas persistidas.
- Formulário efetivo: Principal/Observação;12editores, inclusive PKreadonly e nr_container_original comlabel Container Original; não converter varianteform_proc_compra antiga por engano.
- Novo/edição/exclusão usam transação raiz única, EXCL/NO-WAIT, rollback integral, sucesso somente depoiscommit. Sem desabilitar triggers. Excluir bloqueia dependências (itens,containers,vínculos de pagamentos,despesas,controles,anexos), sem cascata implícita.
- Troca fornecedor valida títulos/valores pelos serviços financeiros existentes e recusa contexto incoerente; função legada alterarFornecItensPed não executaUPDATE, não inventar sua migração de ledger.
- Flagprevisão0→1 no formulário efetivo: limpar ledger>2 dos itens próprios, gerar obrigações tipo3 qty*negociado, refazer pagamentos tipo4, reconciliar containers relacionados e diferença embarque10. Flag1→0 limpa ledger>2 dos itens próprios conforme legado. Extensão deve REUTILIZAR AllocateOrder/AddPlan/BalanceValue/PersistPlans e runtime/totais existentes, sem duplicar fórmulas no novo writer.
- Regras financeiras em procedimento reutilizável independente da API; qualquer atualização em containers vinculados deve ter imagem completa e autoria. Nenhum comando de custo/fiscal/estoque novo nesta entrega.
- Auditoria audit.version1/sourceprogress-transaction/resourceprocs-compra/operation/id/actor.login/before/after/changes/warnings. Main14campos físicos, dados15campos comrow_stamp. CTAimagens14 comproc_compra_id sintético; alterações colaterais precisam escopo próprio confirmado, não presumir que todos os itens de container são do mesmo pedido.
- Logs do formulário recordEvents; Logs Exclusão mostra apenas exclusões do cadastro. Reutilizar viewer e classes nativas, tipo string no contexto mas normalização numéricaestrita. Identidade vem da sessão autenticada.
- Navegação mínima real: Pagamentos já entregue; outros links somente se destino realmente publicado. Não anunciar conversão de itens/despesas/anexos/controles sem prova.

## Tarefas
1. [x] ABL: testes TTs primeiro, include de snapshot/stamp compartilhada, writer + adaptador + regras/financeiro reutilizáveis; extensão restrita leitor paginado comum e dispatcher. Preservar regressões existentes e ABI pública.
2. [x] PHP: contrato audit fechado/ator, importação nativa e escopo de Logs; suporte de query usando o normalizador existente; testes RED/GREEN e suite canônica.
3. [x] Metadados: draft/sourcemapping/Home/navegação; validador nativo, comparação de catálogo e publicação aditiva comguardas. Preservar telas financeiras/versões anteriores e sessões humanas.
4. [x] Oficial: compilar OpenEdge12.2/.42, culturasAMERICAN/EUROPEAN/codepagesUTF8/ISO8859-1, publicar só artefatos pertinentes no137, recarregar sóMEDocioso na sursum-api/med9911; validarPASOE/Builder/UI.
5. [x] Autorização específica recebida, cenário executado e limpo: pedir autorização ESPECÍFICA para novo cenário operacional quando pronto; autorizações antigas de pagamentos/container não cobrem novas alterações financeiras. Enquanto isso testarTT e leituras reais. Nunca escrever títuloERPexistente.
6. [x] Atualizar documentação/inventário e4memórias com estado efetivamente publicado/validado e limites; semsenhas/dadoscomerciais. Semcommit/push/reseed.

## Evidência e decisões
Fontes recém-lidos e sanitizados em sources/scriptcase/purchases/. Manifestos purchase-source-manifest.json e purchase-active-form-source-manifest.json no inventário. SemPHPexecutado. Candidatos em integration-src/purchase-orders/, estado privado .runtime/purchase-orders-20261022/. Baselines canônicos exigidos antes de integrar; não sobrescrever alterações concorrentes.

Decisão de integridade: trocar fornecedor só sem vínculos de pagamentos OU ledger para os itens, sem migrar ledger (função legada não executavaUPDATE). Exclusão só sem dependências; preservar linhas/arquivos associados. Essas proteções evitam órfãos e seguem a orientação de integridade já aceita no projeto. Sem nova fórmula financeira no writer.

Estado final desta entrega: cadastro cd0108/1.0.0 publicado, API/read/interface validados; cenário operacional SC_TEST_PROC_COMPRA_20261022 autorizado, validado e limpo (pai1680). A sequência física seq_procs_compra existe; nenhum fallback de identidade foi necessário. Dependências físicas diretas confirmadas: itens/pagamentos/despesas/anexos; controles_proc_compra não foi encontrada como FK em espec e não foi inventada. Itens/Anexos não equivalem a fluxos integralmente convertidos. Ver docs/ciw-processos-compra-2026-10-22.md e memória atualizada.
