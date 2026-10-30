"""Prepare native demo/docs candidates only. Never touch canonical frontend."""
from pathlib import Path
import hashlib,json,difflib
R=Path('D:/opencode/conversao-sc');C=Path('D:/opencode/construtor-pg')
OUT=R/'integration-src/ciw-completion-20261028/native-batch-snapshot-example'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
def put(rel,s):
 p=OUT/rel;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(s,encoding='utf-8');return p
d=json.loads((R/'.runtime/ciw-completion-20261028/container-expense-batch/bridge/native-preview.json').read_text(encoding='utf-8'))
d['screenId']='demo.batch-snapshot';d['program'].update(id='demo-batch-snapshot',entity='demo_expenses',title='Lote com originais protegidos',subtitle='Exemplo local: alterações ficam somente na memória desta página.')
d.pop('runtime',None);d['permissions']={'read':True,'create':False,'edit':True,'delete':True,'saveLayout':False}
d['dataSource']={'api':{'read':{'endpointId':'read','method':'POST'},'batch':{'endpointId':'batch','method':'POST'}}}
d['crud']['grid']['toolbar']=[]
for f in d['dataModel']['fields'].values():f.pop('technicalProperties',None)
put('examples/batch-snapshot.crud.json',json.dumps(d,ensure_ascii=False,indent=2)+'\n')
scripts=['vendor/jquery/jquery-4.0.0.min.js','kendo/js/kendo.all.min.js','kendo/kendo-license.js','kendo/js/cultures/kendo.culture.pt-BR.min.js','kendo/js/messages/kendo.messages.pt-BR.min.js','src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudToolbarRenderer.js','src/crud-engine/CrudKendoGridRenderer.js','src/examples/batch-snapshot-example.js']
put('examples/pages/batch-snapshot.html','''<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Lote com originais protegidos</title>
<link rel="stylesheet" href="../../kendo/styles/default-urban.css"><link rel="stylesheet" href="../../src/styles/crud-engine.css"><link rel="stylesheet" href="../../src/styles/examples-guide.css">
</head><body><main class="example-page-shell"><header class="example-page-header"><div><p class="example-kicker">Exemplo local</p><h1>Lote com originais protegidos</h1><p>Edite Valor previsto, Base de imposto ou Manual. As outras colunas e o contexto permanecem protegidos.</p></div></header>
<p>Salvar e excluir afetam apenas duas linhas fictícias na memória desta página. Recarregar restaura o exemplo.</p>
<p>Use os botões nativos do grid para salvar ou descartar. Atualizações e exclusões devem formar lotes separados.</p>
<div id="batch-snapshot-toolbar"></div><div id="batch-snapshot-grid"></div><p id="batch-snapshot-status" role="status"></p>
<details><summary>Último payload local</summary><pre id="batch-snapshot-payload"></pre></details>
</main>'''+''.join('\n<script src="../../'+s+'"></script>' for s in scripts)+'\n</body></html>\n')
# Data lives only in this explicit demo entry point, never in production bootstrap.
put('src/examples/batch-snapshot-example.js','''(function (global, $) {
  "use strict";
  if (global.document.body.dataset.production === "true") { throw new Error("Exemplo local indisponível em produção."); }
  const raw = DEFINITION;
  const definition = new global.PageDefinitionNormalizer().normalize(raw);
  new global.CrudDefinitionValidator().validate(definition);
  // These are local dispatch keys. This client never performs fetch/XHR.
  definition.api = {read: {url: "local.read", method: "POST"}, batch: {url: "local.batch", method: "POST"}};
  const snapshot = definition.grid.editing.snapshot;
  const editable = ["vl_prev", "vl_base_imp", "log_manual"];
  const clone = value => JSON.parse(JSON.stringify(value));
  const make = (id, expense, value) => Object.assign(Object.fromEntries(snapshot.originalFields.map(name => [name, null])), {
    despesa_container_id: id, container_id: 900001, despesa_id: expense, item_container_id: 0,
    vl_prev: value, vl_base_imp: 0, log_manual: true, log_utilizado: false, memoria_calculo: "Exemplo fictício"
  });
  let rows = [make(1, 101, 1), make(2, 102, 2)];
  const client = {request: async request => {
    if (request.url === "local.read") { return {data: clone(rows), total: rows.length}; }
    if (request.url !== "local.batch") { throw new Error("Operação fora do exemplo."); }
    const payload = request.data;
    if (!payload.context || payload.context.container_id !== 900001) { throw new Error("Contexto inválido."); }
    const changes = payload.changes;
    if (!Array.isArray(changes) || !changes.length || new Set(changes.map(change => change.operation)).size !== 1) { throw new Error("Use um lote homogêneo."); }
    // Illustrates full originals; fiscal/financial rules stay in the real backend.
    changes.forEach(change => {
      const row = rows.find(item => String(item.despesa_container_id) === String(change.id));
      if (!row || !change.original || snapshot.originalFields.some(name => !Object.prototype.hasOwnProperty.call(change.original, name) || change.original[name] !== row[name])) { throw new Error("Originais desatualizados."); }
      if (!["update", "delete"].includes(change.operation) || Object.keys(change.data || {}).some(name => !editable.includes(name))) { throw new Error("Campo protegido."); }
    });
    changes.forEach(change => {
      if (change.operation === "delete") { rows = rows.filter(row => String(row.despesa_container_id) !== String(change.id)); }
      else { Object.assign(rows.find(row => String(row.despesa_container_id) === String(change.id)), change.data); }
    });
    global.document.getElementById("batch-snapshot-payload").textContent = JSON.stringify(payload, null, 2);
    global.document.getElementById("batch-snapshot-status").textContent = "Lote aplicado somente à memória local.";
    return {committed: true, data: clone(rows), total: rows.length};
  }};
  global.kendo.culture("pt-BR");
  let toolbar;
  const renderer = new global.CrudKendoGridRenderer({definition, contextValues: {container_id: 900001}, httpClient: client,
    handlers: {batchChange: (dirty, saving) => { if (toolbar) { toolbar.setBatchState(dirty, saving); } }}
  });
  toolbar = new global.CrudToolbarRenderer({definition, handlers: {saveBatch: () => renderer.saveBatch(), cancelBatch: () => renderer.discardBatch()}});
  toolbar.render($("#batch-snapshot-toolbar"));
  renderer.render($("#batch-snapshot-grid"));
  // Exposed only under the explicit local example for functional UI verification.
  global.batchSnapshotExample = {renderer, ready: renderer.waitForInitialRead()};
}(window, window.jQuery));
'''.replace('DEFINITION',json.dumps(d,ensure_ascii=False)))
put('docs/batch-snapshot.md','''# Lote com originais e contexto protegidos

O exemplo `examples/pages/batch-snapshot.html` usa o mesmo `CrudKendoGridRenderer`, normalizador e validador publicados. Funciona com duas linhas fictícias em memória, sem requisições de rede. O botão salvar mostra o payload produzido pelo renderer; recarregar restaura os dados. Não reproduz regras fiscais, permissões ou transações do backend.

No Builder, habilite `gridEditMode: "batch"` e `crudOptions.batchSnapshot` com `originalFields` e `contextFields`. Os nomes devem ser campos existentes e únicos, no máximo64 por lista. No JSON gerado, a opção fica em `crud.grid.editing.snapshot`. Cada contexto listado precisa ser obrigatório e readonly. A PK e os campos históricos ficam readonly; somente os campos explicitamente editáveis vão em `changes[].data`. Os originais completos vão em `changes[].original`; o contexto vai em `context`. Nunca use um textarea de JSON para editar snapshot.

Sem opt-in, permanece o contrato anterior `{changes}`, com originais apenas dos campos editáveis. A capacidade é genérica; concorrência, ownership, transação, permissões e auditoria devem ser verificados pelo backend real de cada entidade.

Produção continua exclusivamente por `screenId`, metadata assinada e `endpointId`. Não copie a página de exemplo, os dados fictícios nem seu cliente em memória para `production/`; não carregue o JSON local no bootstrap de produção. Use os endpoints cadastrados e a sessão autenticada. O exemplo não libera permissões nem executa operações CIW.

No CIW1042, o snapshot contém14campos físicos e contexto `container_id`; apenas `vl_prev`, `vl_base_imp` e `log_manual` são editáveis. Os lotes update/delete são homogêneos. Recusa de stale precisa ocorrer antes de qualquer efeito, e uma resposta confirmada com apresentação indisponível limpa o rascunho para impedir reenvio. O teste comercial real depende de cenário novo autorizado, limites concretos e limpeza canônica comprovada. Compilação/publicação e leituras reais não comprovam essas escritas.

Validação da capacidade: testes nativos `container-expense-batch/tests/native-batch.cjs` e `browser-native.cjs`, além do teste funcional deste exemplo. A skill local `construtor-pg-demo-production-parity` não está instalada; o checklist de `docs/paridade-demo-producao.md` foi aplicado diretamente.
''')
matrix=C/'docs/paridade-demo-producao.md';raw=matrix.read_bytes()
try:raw.decode('utf-8');matrix_codec='utf-8'
except UnicodeDecodeError:matrix_codec='cp1252'
row='| 2026-10-28 | Lote opt-in com originais e contexto protegidos | examples/pages/batch-snapshot.html, examples/batch-snapshot.crud.json, src/examples/batch-snapshot-example.js | Mesmo renderer/validador/Builder; produção por screenId e endpointId, sem cliente local | ja-compativel | Integrar exemplo/documentação; validar cenário novo1042 antes de escrita real | Frontend e backend compartilhados integrados no build5; dados/cliente fictícios restritos ao exemplo; nenhuma biblioteca Kendo alterada. Skill de paridade ausente, checklist aplicado diretamente. |'
anchor=b'| --- | --- | --- | --- | --- | --- | --- |'
assert raw.count(anchor)==1
candidate=raw.replace(anchor,anchor+b'\n'+row.encode(matrix_codec),1)
p=OUT/'docs/paridade-demo-producao.md';p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes(candidate)
put('patches/paridade-demo-producao.md.patch',''.join(difflib.unified_diff(raw.decode(matrix_codec).splitlines(True),candidate.decode(matrix_codec).splitlines(True),fromfile=str(matrix),tofile=str(matrix))))
manifest={'status':'CANDIDATE_ONLY_NOT_INTEGRATED','canonicalWrites':False,'productionMocks':False,'matrixBaseline':{'target':str(matrix),'sha256':sha(matrix)},'files':[{'path':p.relative_to(OUT).as_posix(),'sha256':sha(p)} for p in sorted(OUT.rglob('*')) if p.is_file() and p.name!='manifest.json']}
put('manifest.json',json.dumps(manifest,ensure_ascii=False,indent=2)+'\n')
print(json.dumps({'success':True,'files':len(manifest['files']),'manifestSha256':sha(OUT/'manifest.json'),'canonicalWrites':False}))
