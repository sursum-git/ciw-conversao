# Conversão form_tipos_anexo — execução autorizada

Usuário pediu continuar em 15/10/2026 após aprovar a solução por continuidade. O desenho previamente apresentado é grade editável por metadados, adicionar/remover linhas, salvar/cancelar um lote, uma transação Progress com rollback completo e indicação da linha em erro. Preservar empresas e frontend existente. Este plano implementa o desenho em três áreas de arquivos independentes.

## Contrato entre camadas

- Programa `pageType=crud`, opção fechada de programa `gridEditMode=batch` (padrão form).
- Definição runtime `grid.editing.mode=batch`, `api.batch` endpoint autenticado. A entidade tem `apiBatchOperationCode`; fonte inclui operação type=batch. Sem URLs ou código livre no JSON de tela.
- Corpo do lote: `changes:[{operation:create|update|delete,clientId:string,id?:integer,data?:{descricao:string},original?:{descricao:string|null}}]`. Máximo100 mudanças; IDs de inclusões são gerados no Progress, nunca escolhidos pelo navegador. ID de update/delete obrigatório.
- PHP valida schema, campos e autorização de cada ação. Encaminha uma chamada com `operation=batch` e changes para a fonte API com contrato sursum-programs. Mantém auditoria e identidade autenticada; nenhuma transação distribuída simulada.
- ABL valida todo o lote e executa uma transação única; EXCLUSIVE-LOCK NOWAIT para update/delete, índice único e geração de IDs no servidor. original permite recusar alteração concorrente em vez de sobrescrever silenciosamente. Erro inclui linha/clientId em mensagem segura; o frontend preserva alterações locais em falha.
- Sucesso ABL `success=true,data:[...]` (lista atualizada), mais results se útil; PHP mapeia para dados runtime e frontend recarrega a consulta após sucesso. Falha segue envelope error code/message/status existente.
- Campos: tipo_anexo_id INTEGER readonly; descricao CHARACTER máximo100 caracteres conforme Scriptcase. IDs sem casas decimais. Não criar tabela PostgreSQL para dados Progress.
- Bloquear exclusão quando anexos_container.tipos_anexo_id ou anexos_proc_compra.tipos_anexo_id referenciam o registro. Identificar o parâmetro real de Pró-Forma; usar include backend sem cache. Enquanto não identificado, não habilitar exclusão que possa burlar essa regra.

## Tarefas

1. Frontend (arquivos src/crud-engine, schema JSON, tests/frontend): implementar modo batch no motor reutilizável, ações e confirmação Kendo, dirty-state, salvar/cancelar, recusar perda de rascunho em navegação/filtro/página, testes de contrato e comportamento. Sem modificar kendo/vendor nem criar segunda UI.
2. Backend PHP/builder (backend/src, backend/tests): fonte/binding de operação batch, gridEditMode fechado, definição/endpoint gerado, validação e autorização por ação, um request externo e auditoria. Manter APIs antigas e snapshots assinados. Testes pertinentes devem passar.
3. ABL e integração (este workspace + motor-progress/v2): confirmar schema/regras, criar wrapper autenticado/serviço transacional/testes temp-table, compilar12.2/publicar/validar PASOE. Preparar metadados e importar/públicar nova tela via builder oficial, com governança e código livre confirmado no bootstrap.
4. Revisão e testes integrados: login real, consulta e edição multirow; rollback de lote com erro; exclusão protegida; dados de teste novos marcados e removidos; regressão empresas e auditoria de identidade. Atualizar contextos.

## Decisões e limites

- Trabalhar nos checkouts atuais por dependência das alterações locais já instaladas; preservar diffs anteriores. Sem commit/push/merge ou reinício global.
- Alterações PHP e frontend serão feitas em áreas separadas; somente o coordenador publica artefatos remotos e dados de metadados. Agentes não alteram produção nem usam senhas.
- Três helpers exclusivamente de sessão/cache PHP já foram excluídos da include por determinação do usuário. Não reintroduzir cache.
- Exemplos de uso serão os JSONs reais da integração em integrations/; não editar demos/mocks/bibliotecas de terceiro para esta conversão.
- Testes de negócio: somente registros novos identificados como teste, com limpeza. Nunca remover o registro empresa3 criado pelo usuário.

## Resultado em 15/10/2026

Concluído: API e tela ciw.tipos-anexo publicadas, cd0091 versão builder4. Identificado TP_ANEXO_PRO_FORMA=1 no banco; wrapper consulta a include sem cache. Compilação12.2 e50 verificações ABL passaram; PHP238 testes/1183 asserções; testes frontend e interface real passaram. Lote misto, rollback completo, snapshot concorrente, identidade e auditoria verificados. Registros próprios removidos e20 tipos originais preservados. Integridade1025/0 inválidas e regressão empresas passaram. Detalhes em docs/integracao-tipos-anexo-validacao.md e memória context/PROJECT_CONTEXT.md. Nenhum commit/push.
