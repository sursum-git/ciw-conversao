# form_tipos_anexo — conversão publicada

Em 15/10/2026, a aplicação foi convertida para o frontend do construtor-pg usando JSONs de metadados e APIs Progress. Tela: [Tipos de anexo](http://127.0.0.1:8765/production/app.html?screenId=ciw.tipos-anexo), programa cd0091, entidade tipos_anexo_progress, fonte motor_progress_tipos_anexo.

## Uso

Clique em **Adicionar linha**, preencha a descrição diretamente na grade e repita para outras linhas. Edite células existentes ou marque **Excluir linha**. **Salvar lote** confirma tudo em uma transação Progress; uma falha desfaz o conjunto e conserva o rascunho para correção. **Cancelar lote** descarta as mudanças locais após confirmação. O ID é gerado pelo servidor e não aceita edição.

A descrição aceita até100 caracteres, inclusive acentos, e pode ficar vazia. O limite vem do Scriptcase; o formato Progress x(50) não é limite físico. Cada lote admite até100 mudanças.

## Regras no backend

`TiposAnexoCrud.p` autentica o header privado X-Tipos-Anexo-Token, cria buffers de tabelas fixas e usa a include `sursum-api/includes/parametros_ima.i`. Consulta diretamente `TP_ANEXO_PRO_FORMA`, sem cache. No banco consultado o valor é1: esse tipo não pode ser excluído. Configuração ausente ou inválida bloqueia exclusões. Também são verificadas referências em anexos_container.tipos_anexo_id e anexos_proc_compra.tipos_anexo_id.

No PHP original, verificarParamProForma recebe o ID, repassa-o a buscarParametroIma e faz uma atribuição no if. Não há chave literal nessa função. O código do parâmetro foi identificado no banco; a conversão aplica a intenção da regra com comparação correta.

`TiposAnexoCrudService.p` valida o lote antes de gravar, usa EXCLUSIVE-LOCK NOWAIT e uma única transação. Update/delete conferem o snapshot original, incluindo diferenças de maiúsculas, espaços e null. O PHP exige sessão e permissão por operação e envia uma chamada externa. Erros identificam a linha; nenhuma divisão em chamadas CRUD individuais.

## Evidências

- OpenEdge12.2 no .42: três fontes compilados sem erros e50 verificações em temp-table. Incluem Pró-Forma, dependências, validação, Unicode, concorrência e rollback.
- PHP:238 testes,1183 asserções; revisão independente do mascaramento de segredos passou.
- Frontend: testes batch/editor e regressões formulário/editor/render-gate passaram no Edge.
- API real: duas inclusões em um lote; alteração/exclusão/inclusão juntas; conflito de snapshot; erro na terceira linha desfez as duas anteriores; autenticação e campos inválidos recusados.
- Navegador real: edição de células, duas inclusões em um request, alteração/exclusão conjuntas, cancelamento local e zero erros JavaScript.
- Registros próprios de teste removidos; os20 tipos originais preservados. Dependências operacionais não foram criadas para teste; a proteção foi exercitada com temp-tables.
- PASOE registrou admin, agent-3, sursum-api, PID e duração. Auditoria PHP confirmou6 eventos de sucesso e2 de falha. Integridade:1025 registros assinados, zero inválidos. Empresas passou pelos checks de leitura e interface, sem gravação nesta entrega.

## Arquivos e operação

Metadados canônicos em `D:/opencode/construtor-pg/integrations/ciw-tipos-anexo/`. Fontes ABL em `D:/opencode/motor-progress/v2/sursum-api/programs/`. Cópias e testes desta conversão em `integration-src/tipos-anexo/`. O modo genérico está documentado em `D:/opencode/construtor-pg/docs/crud-edicao-lote.md`.

Publicação sursum-api/med, catálogo mesclado, sem reinício. Backup `/tmp/codex-tipos-anexo-20261015/backup-20261015T154452Z`. Compilados publicados vieram exclusivamente do OpenEdge12.2. Credenciais ficam no runtime privado; somente hash no PASOE. Não repetir importação inicial sobre o programa existente.

Checks `verify-tipos-anexo.cjs` e `verify-tipos-anexo-ui.cjs` em tools/construtor-local fazem escritas somente em registros próprios novos, com limpeza. `verify-tipos-anexo-audit.ps1` consulta logs. Evidências detalhadas em .runtime/construtor-pg, sem valores de credenciais.

Para trocar uma API, salve o cadastro da fonte e depois o vínculo da entidade, que guarda um snapshot. Preserve operation=batch e o contrato transacional da tela. Consulte a memória principal em context/PROJECT_CONTEXT.md.
