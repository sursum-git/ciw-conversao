from pathlib import Path
import json,hashlib
D=Path(__file__).resolve().parent
def change(relative,edit):
 baseline=D/'baseline'/relative;body=baseline.read_bytes();expected=next(x['baselineSha256']for x in json.loads((D/'baselines.json').read_text())['files']if x['relative']==relative)
 assert hashlib.sha256(body).hexdigest()==expected
 target=D/'candidate'/relative;target.write_bytes(edit(body))
def replace(body,old,new,count=1):
 old=old.encode();new=new.encode();assert body.count(old)==count,(old[:80],body.count(old));return body.replace(old,new)
def php(body):
 body=replace(body,"$this->normalizeContextFields($payload['contextFields'] ?? [], $entity)","$this->normalizeContextFields($payload['contextFields'] ?? [], $entity, $pageType)")
 body=replace(body,'private function normalizeContextFields(mixed $value, ?BuilderEntity $entity): array',"private function normalizeContextFields(mixed $value, ?BuilderEntity $entity, string $pageType = 'crud'): array")
 body=replace(body,"['field', 'filter', 'createDefault', 'readonly', 'required'], 'contextFields'","['field', 'filter', 'createDefault', 'readonly', 'required', 'filterOnly'], 'contextFields'")
 anchor="            $seen[$field] = true;\r\n            foreach (['filter', 'createDefault', 'readonly', 'required'] as $key)"
 insertion="            $seen[$field] = true;\r\n            if (array_key_exists('filterOnly', $item)) {\r\n                if ($pageType !== 'crud' || !is_bool($item['filterOnly']) || ($item['filterOnly'] && (($item['required'] ?? null) !== false || ($item['filter'] ?? null) !== true || ($item['readonly'] ?? null) !== true || ($item['createDefault'] ?? null) !== false))) { throw new RuntimeHttpException('BUILDER_CONTEXT_INVALID', 'filterOnly exige CRUD, contexto opcional readonly, filtro ativo e sem default de criacao.', 422); }\r\n            }\r\n            foreach (['filter', 'createDefault', 'readonly', 'required'] as $key)"
 body=replace(body,anchor,insertion)
 return replace(body,'        return $value;\r\n    }\r\n\r\n    private function normalizeFieldCondition','        foreach ($value as $index => $item) { if (($item[\'filterOnly\'] ?? null) === false) { unset($value[$index][\'filterOnly\']); } }\r\n        return $value;\r\n    }\r\n\r\n    private function normalizeFieldCondition')
change('backend/src/Builder/ProgramBuilderService.php',php)
def engine(body):
 body=replace(body,'        const raw = supplied[item.field];','        const raw = supplied[item.field];\r\n        if (item.filterOnly === true && Object.prototype.hasOwnProperty.call(supplied, item.field) && (raw == null || raw === "")) { throw global.CrudUtils.makeError("CRUD_CONTEXT_INVALID", "Selecao informada invalida: " + item.field + "."); }')
 body=replace(body,'contextValues: this.contextValues || {},','contextValues: this.getRequestContextValues(),',2)
 body=replace(body,'context: Object.assign({}, this.contextValues || {})','context: Object.assign({}, this.getRequestContextValues())')
 method='''    getRequestContextValues() {
      const values = this.contextValues || {};
      const excluded = global.CrudUtils.ensureArray(this.definition && this.definition.contextFields).filter((item) => item.filterOnly === true).map((item) => item.field);
      if (!excluded.length) { return values; }
      return Object.fromEntries(Object.entries(values).filter(([field]) => excluded.indexOf(field) === -1));
    }

'''.replace('\n','\r\n')
 return replace(body,'    withContextFilters(filters) {',method+'    withContextFilters(filters) {')
change('src/crud-engine/CrudEngine.js',engine)
def form(body):
 start=body.index(b'    getRemoteOptionsContext() {');before=body[:start];tail=body[start:]
 return before+replace(tail,'global.CrudUtils.ensureArray(this.definition.contextFields).forEach((item) => {','global.CrudUtils.ensureArray(this.definition.contextFields).forEach((item) => {\r\n        if (item.filterOnly === true) { return; }')
change('src/crud-engine/CrudKendoFormRenderer.js',form)
def validator(body):
 body=replace(body,'["field", "filter", "createDefault", "readonly", "required"], "contextFields"','["field", "filter", "createDefault", "readonly", "required", "filterOnly"], "contextFields"')
 anchor='        if (!fields[item.field] || ["integer", "string"].indexOf(fields[item.field].type) === -1)'
 insertion='''        if (Object.prototype.hasOwnProperty.call(item, "filterOnly") && (typeof item.filterOnly !== "boolean" || (item.filterOnly && (definition.pageType !== "crud" || !fields[item.field] || fields[item.field].type !== "integer" || item.required !== false || item.filter !== true || item.readonly !== true || item.createDefault !== false)))) { errors.push("filterOnly exige contexto integer opcional readonly, filtro ativo e sem default de criacao."); }
'''.replace('\n','\r\n')
 return replace(body,anchor,insertion+anchor)
change('src/crud-engine/CrudDefinitionValidator.js',validator)
def normalizer(body):
 body=replace(body,'      const crud = source.crud || {};','      const crud = source.crud || {};\r\n      if (Object.prototype.hasOwnProperty.call(source, "contextFields")) { source.contextFields = this.normalizeContextFields(source.contextFields, source.dataModel || crud.dataModel); }')
 body=replace(body,'    normalizeLegacyCrudDefinition(definition) {\r\n      const source = global.CrudUtils.clone(definition);','    normalizeLegacyCrudDefinition(definition) {\r\n      const source = global.CrudUtils.clone(definition);\r\n      if (Object.prototype.hasOwnProperty.call(source, "contextFields")) { source.contextFields = this.normalizeContextFields(source.contextFields, source.dataModel); }')
 method='''    normalizeContextFields(value, model) {
      if (!Array.isArray(value)) { return value; }
      value.forEach((item) => {
        if (!item || typeof item !== "object" || !Object.prototype.hasOwnProperty.call(item, "filterOnly")) { return; }
        const field = model && model.fields && model.fields[item.field];
        if (Object.keys(item).some((key) => ["field", "filter", "createDefault", "readonly", "required", "filterOnly"].indexOf(key) === -1) || typeof item.filterOnly !== "boolean" || (item.filterOnly && (!field || field.type !== "integer" || item.required !== false || item.filter !== true || item.readonly !== true || item.createDefault !== false))) {
          throw global.CrudUtils.makeError("CRUD_CONTEXT_INVALID", "filterOnly exige contexto integer opcional readonly, filtro ativo e sem default de criacao.");
        }
        if (item.filterOnly === false) { delete item.filterOnly; }
      });
      return value;
    }

'''.replace('\n','\r\n')
 return replace(body,'    normalizeQueryConfig(queryConfig) {',method+'    normalizeQueryConfig(queryConfig) {')
change('src/page-engine/PageDefinitionNormalizer.js',normalizer)
def schema(body):
 start=body.index(b'\n    "contextField": {')+1;end=body.index(b'\n    "fieldCondition": {',start)+1;section=body[start:end]
 section=replace(section,'        "required": {\r\n          "type": "boolean"\r\n        }','        "required": {\r\n          "type": "boolean"\r\n        },\r\n        "filterOnly": {\r\n          "type": "boolean"\r\n        }')
 conditional='''      "allOf": [
        {
          "if": {"properties": {"filterOnly": {"const": true}}, "required": ["filterOnly"]},
          "then": {
            "required": ["filter", "required", "readonly", "createDefault"],
            "properties": {"filter": {"const": true}, "required": {"const": false}, "readonly": {"const": true}, "createDefault": {"const": false}}
          }
        }
      ],
'''.replace('\n','\r\n')
 section=replace(section,'      "additionalProperties": false',conditional+'      "additionalProperties": false')
 return body[:start]+section+body[end:]
change('public/metadata/schemas/crud-definition-v1.schema.json',schema)
print('Candidate6 byte-anchored files prepared; no canonical writes')
