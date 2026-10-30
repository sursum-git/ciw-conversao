"""Opt-in native snapshot/context capability; shared files only become staged patches."""
from pathlib import Path
import json,hashlib,difflib
root=Path(__file__).resolve().parents[1];repo=Path('D:/opencode/construtor-pg');stage=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch/native');patchdir=root/'patches/native-batch-context';patchdir.mkdir(parents=True,exist_ok=True)
patches=[]
def patch(rel,changes):
 p=repo/rel;before=p.read_text(encoding='utf-8-sig');after=before
 for old,new in changes:
  assert after.count(old)==1,(rel,old[:80]);after=after.replace(old,new)
 (patchdir/(p.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(p),tofile=str(p))),encoding='utf-8')
 target=stage/rel;target.parent.mkdir(parents=True,exist_ok=True);target.write_text(after,encoding='utf-8')
 patches.append(dict(target=str(p).replace('\\','/'),baselineSha256=hashlib.sha256(p.read_bytes()).hexdigest(),changes=[dict(old=a,new=b)for a,b in changes]))
snapshot='''        if (array_key_exists('batchSnapshot', $input)) {
            $snapshot = $this->closedObject($input['batchSnapshot'], ['originalFields','contextFields'], 'crudOptions.batchSnapshot');
            $available = []; foreach ($entity->getFields() as $field) { $available[$field->getCode()] = $field; }
            foreach (['originalFields','contextFields'] as $key) {
                $items = $snapshot[$key] ?? null;
                if (!is_array($items) || !array_is_list($items) || !$items || count($items)>64 || count(array_unique($items,SORT_REGULAR))!==count($items)) { $invalid('batchSnapshot.'.$key); }
                foreach ($items as $name) {
                    if (!is_string($name) || !isset($available[$name]) || !in_array($available[$name]->getDataType(),['integer','decimal','boolean','string','date','datetime'],true)) { $invalid('batchSnapshot.'.$key); }
                }
            }
            $result['batchSnapshot'] = $snapshot;
        }
'''
patch('backend/src/Builder/ProgramBuilderService.php',[("['pageSize', 'gridFields', 'filterFields', 'defaultSort', 'defaultGroup'], 'crudOptions'","['pageSize', 'gridFields', 'filterFields', 'defaultSort', 'defaultGroup', 'batchSnapshot'], 'crudOptions'"),("        return $result;\n    }\n\n    private function normalizeMasterDetailBuilderConfig",snapshot+"        return $result;\n    }\n\n    private function normalizeMasterDetailBuilderConfig"),("'editing' => ['mode' => $config['gridEditMode'] ?? 'form'],","'editing' => ['mode' => $config['gridEditMode'] ?? 'form'] + (isset($crudOptions['batchSnapshot']) ? ['snapshot' => $crudOptions['batchSnapshot']] : []),"),("                'allowCreate' => $version->isAllowCreate(),","                ...($endpointId === 'batch' && isset($version->getBuilderConfig()['crudOptions']['batchSnapshot']) ? ['batchSnapshot' => $version->getBuilderConfig()['crudOptions']['batchSnapshot']] : []),\n                'allowCreate' => $version->isAllowCreate(),")])
patch('src/crud-engine/CrudEngine.js',[("        initialNavigationState: this.navigationGridState,","        initialNavigationState: this.navigationGridState,\n        contextValues: this.contextValues || {},")])
patch('src/crud-engine/CrudKendoGridRenderer.js',[("      this.filters = global.CrudUtils.ensureArray(options.initialFilters);","      this.filters = global.CrudUtils.ensureArray(options.initialFilters);\n      this.contextValues = options.contextValues || {};"),("    batchValuesEqual(left, right) {","""    batchOriginalValues(row) {
      const snapshot = this.definition.grid && this.definition.grid.editing && this.definition.grid.editing.snapshot;
      if (!snapshot) { return this.batchValues(row); }
      const original = {};
      snapshot.originalFields.forEach((name) => { original[name] = row[name] == null ? null : row[name]; });
      return original;
    }

    batchValuesEqual(left, right) {"""),("this.batchOriginals.set(String(row[this.definition.dataModel.primaryKey]), this.batchValues(row));","this.batchOriginals.set(String(row[this.definition.dataModel.primaryKey]), this.batchOriginalValues(row));"),("        await this.httpClient.request({url: endpoint.url, method: endpoint.method || \"POST\", data: {changes}});","""        const data = {changes};
        const snapshot = this.definition.grid && this.definition.grid.editing && this.definition.grid.editing.snapshot;
        if (snapshot) {
          data.context = {};
          snapshot.contextFields.forEach((name) => {
            if (!Object.prototype.hasOwnProperty.call(this.contextValues, name)) { throw new Error("Contexto obrigatorio do lote: " + name + "."); }
            data.context[name] = this.contextValues[name];
          });
        }
        await this.httpClient.request({url: endpoint.url, method: endpoint.method || "POST", data});""")])
validator='''      const snapshot = definition.grid && definition.grid.editing && definition.grid.editing.snapshot;
      if (snapshot != null) {
        if (closed(snapshot, ["originalFields", "contextFields"], "grid.editing.snapshot")) {
          if (definition.grid.editing.mode !== "batch") { errors.push("Snapshot exige modo batch."); }
          ["originalFields", "contextFields"].forEach((key) => {
            const names = snapshot[key];
            if (!Array.isArray(names) || !names.length || names.length > 64 || new Set(names).size !== names.length || names.some((name) => typeof name !== "string" || !fields[name] || ["integer","decimal","number","boolean","string","text","date","datetime"].indexOf(fields[name].type) === -1)) { errors.push("Campos de snapshot invalidos."); }
          });
          global.CrudUtils.ensureArray(snapshot.contextFields).forEach((name) => {
            if (!global.CrudUtils.ensureArray(definition.contextFields).some((item) => item.field === name && item.required && item.readonly)) { errors.push("Snapshot exige contexto obrigatorio readonly."); }
          });
        }
      }
'''
patch('src/crud-engine/CrudDefinitionValidator.js',[("      global.CrudUtils.ensureArray(definition.grid && definition.grid.rowLinks).forEach((link) => {",validator+"      global.CrudUtils.ensureArray(definition.grid && definition.grid.rowLinks).forEach((link) => {")])
(patchdir/'patch-plan.json').write_text(json.dumps(dict(textPatches=patches),indent=2),encoding='utf-8')
legacy=(repo/'tests/frontend/crud-grid-batch-smoke.mjs').read_text(encoding='utf-8-sig')
legacy=legacy.replace("import { chromium } from 'playwright';", "import fs from 'node:fs';\nimport { createRequire } from 'node:module';\nconst {chromium}=createRequire('D:/opencode/construtor-pg/package.json')('playwright');\nconst nativePath="+json.dumps(str(stage).replace('\\','/'))+";const repoPath='D:/opencode/construtor-pg';")
legacy=legacy.replace('path.resolve(file)','path.join(fs.existsSync(path.join(nativePath,file))?nativePath:repoPath,file)')
(stage/'legacy-batch-regression.mjs').write_text(legacy,encoding='utf-8')
print('Prepared native opt-in patches',len(patches))
