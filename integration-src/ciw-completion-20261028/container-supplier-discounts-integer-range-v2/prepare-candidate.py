from pathlib import Path
import json,hashlib
D=Path(__file__).resolve().parent
def rep(body,old,new,count=1):
 old=old.encode();new=new.encode();assert body.count(old)==count,(old[:100],body.count(old));return body.replace(old,new)
def change(rel,edit):
 body=(D/'baseline'/rel).read_bytes();row=next(x for x in json.loads((D/'baselines.json').read_text())['files']if x['relative']==rel);assert hashlib.sha256(body).hexdigest()==row['baselineSha256'];(D/'candidate'/rel).write_bytes(edit(body))
def builder(b):
 b=rep(b,"$this->normalizeContextFields($payload['contextFields'] ?? [], $entity, $pageType)","$this->normalizeContextFields($payload['contextFields'] ?? [], $entity, $pageType, $payload)")
 b=rep(b,"private function normalizeContextFields(mixed $value, ?BuilderEntity $entity, string $pageType = 'crud'): array","private function normalizeContextFields(mixed $value, ?BuilderEntity $entity, string $pageType = 'crud', array $profile = []): array")
 b=rep(b,"['field', 'filter', 'createDefault', 'readonly', 'required', 'filterOnly'], 'contextFields'","['field', 'filter', 'createDefault', 'readonly', 'required', 'filterOnly', 'integerRange'], 'contextFields'")
 code='''            if (array_key_exists('integerRange', $item)) {
                $range = $item['integerRange']; $unsupportedConsumer = false; foreach ($entity->getFields() as $candidate) { $options = $candidate->getOptions(); if (isset($options['api']['optionsSource']) || isset($options['attachment']) || ($options['editor'] ?? null) === 'file') { $unsupportedConsumer = true; } }
                if ($pageType !== 'crud' || ($profile['allowCreate'] ?? null) !== false || ($profile['allowUpdate'] ?? null) !== false || ($profile['allowDelete'] ?? null) !== false || $unsupportedConsumer || $fields[$field]->isPrimaryKey() || ($item['required'] ?? null) !== true || ($item['readonly'] ?? null) !== true || ($item['filter'] ?? null) !== true || ($item['createDefault'] ?? null) !== false || !is_array($range) || array_is_list($range) || count($range) !== 2 || array_diff(array_keys($range), ['min', 'max']) || !is_int($range['min'] ?? null) || !is_int($range['max'] ?? null) || $range['min'] < -2147483648 || $range['max'] > 2147483647 || $range['min'] > $range['max']) { throw new RuntimeHttpException('BUILDER_CONTEXT_INVALID', 'integerRange exige CRUD readonly, integer nao PK, sem opcoes remotas/arquivos e limites int32 fechados.', 422); }
            }
'''.replace('\n','\r\n')
 return rep(b,"            foreach (['filter', 'createDefault', 'readonly', 'required'] as $key)",code+"            foreach (['filter', 'createDefault', 'readonly', 'required'] as $key)")
change('backend/src/Builder/ProgramBuilderService.php',builder)
def normalizer(b):
 b=rep(b,'this.normalizeContextFields(source.contextFields, source.dataModel || crud.dataModel)','this.normalizeContextFields(source.contextFields, source.dataModel || crud.dataModel, source)')
 b=rep(b,'this.normalizeContextFields(source.contextFields, source.dataModel)','this.normalizeContextFields(source.contextFields, source.dataModel, source)')
 b=rep(b,'normalizeContextFields(value, model) {','normalizeContextFields(value, model, definition) {')
 b=rep(b,'"field", "filter", "createDefault", "readonly", "required", "filterOnly"','"field", "filter", "createDefault", "readonly", "required", "filterOnly", "integerRange"')
 b=rep(b,'      value.forEach((item) => {','      value.forEach((item) => {\r\n        if (item && typeof item === "object" && Object.prototype.hasOwnProperty.call(item, "integerRange")) { PageDefinitionNormalizer.integerContextRange(definition, item); }')
 static='''    static integerContextRange(definition, item) {
      if (!Object.prototype.hasOwnProperty.call(item, "integerRange")) { return null; }
      const range = item.integerRange, model = definition.dataModel || {}, fields = model.fields || {}, permissions = definition.permissions || {};
      if (definition.pageType !== "crud" || permissions.create !== false || permissions.edit !== false || permissions.delete !== false || item.field === model.primaryKey || Object.values(fields).some((field) => Object.prototype.hasOwnProperty.call(field, "optionsSource") || Object.prototype.hasOwnProperty.call(field, "attachment") || field.editor === "file") || !fields[item.field] || fields[item.field].type !== "integer" || item.required !== true || item.readonly !== true || item.filter !== true || item.createDefault !== false || Object.keys(item).some((key) => ["field", "filter", "createDefault", "readonly", "required", "filterOnly", "integerRange"].indexOf(key) === -1) || !range || typeof range !== "object" || Array.isArray(range) || Object.keys(range).length !== 2 || !Object.prototype.hasOwnProperty.call(range, "min") || !Object.prototype.hasOwnProperty.call(range, "max") || !Number.isInteger(range.min) || !Number.isInteger(range.max) || range.min < -2147483648 || range.max > 2147483647 || range.min > range.max) {
        throw global.CrudUtils.makeError("CRUD_CONTEXT_INVALID", "integerRange exige CRUD readonly, integer nao PK, sem opcoes remotas/arquivos e limites int32 fechados.");
      }
      return range;
    }

'''.replace('\n','\r\n')
 return rep(b,'    normalizeQueryConfig(queryConfig) {',static+'    normalizeQueryConfig(queryConfig) {')
change('src/page-engine/PageDefinitionNormalizer.js',normalizer)
def validator(b):
 b=rep(b,'["field", "filter", "createDefault", "readonly", "required", "filterOnly"], "contextFields"','["field", "filter", "createDefault", "readonly", "required", "filterOnly", "integerRange"], "contextFields"')
 code='''        if (Object.prototype.hasOwnProperty.call(item, "integerRange")) {
          try { global.PageDefinitionNormalizer.integerContextRange(definition, item); } catch (error) { errors.push("integerRange invalido para CRUD readonly ou limites int32."); }
        }
'''.replace('\n','\r\n')
 return rep(b,'        if (!fields[item.field] || ["integer", "string"].indexOf(fields[item.field].type) === -1)',code+'        if (!fields[item.field] || ["integer", "string"].indexOf(fields[item.field].type) === -1)')
change('src/crud-engine/CrudDefinitionValidator.js',validator)
def engine(b):
 b=rep(b,'        const raw = supplied[item.field];','        const raw = supplied[item.field];\r\n        const range = Object.prototype.hasOwnProperty.call(item, "integerRange") ? global.PageDefinitionNormalizer.integerContextRange(this.definition, item) : null;')
 original='''          if (!/^[1-9][0-9]*$/.test(String(raw)) || Number(raw) > 2147483647) { throw global.CrudUtils.makeError("CRUD_CONTEXT_INVALID", "Contexto invalido: " + item.field + "."); }
          value = Number(raw);'''.replace('\n','\r\n')
 new='''          if (range) {
            const canonical = typeof raw === "number" && Number.isInteger(raw) || typeof raw === "string" && /^(?:0|-[1-9][0-9]*|[1-9][0-9]*)$/.test(raw);
            if (!canonical || !Number.isInteger(Number(raw)) || Number(raw) < range.min || Number(raw) > range.max) { throw global.CrudUtils.makeError("CRUD_CONTEXT_INVALID", "Contexto inteiro fora da faixa: " + item.field + "."); }
            value = Number(raw);
          } else {
'''.replace('\n','\r\n')+original+'\r\n          }'
 return rep(b,original,new)
change('src/crud-engine/CrudEngine.js',engine)
def helper(b):
 old="  $context=$payload['context']??null;if(!is_array($context)||count($context)!==1||!array_key_exists('fornecedor_id',$context))self::invalid(422);\n  $id=self::signedInteger($context['fornecedor_id'],422,true);$leaves=0;"
 new="  $id=null;$leaves=0;\n  if(array_key_exists('context',$payload)){$context=$payload['context'];if(!is_array($context)||count($context)!==1||!array_key_exists('fornecedor_id',$context))self::invalid(422);$id=self::signedInteger($context['fornecedor_id'],422,true);}\n  elseif(($endpoint['bodyTemplate']['operation']??null)!=='read')self::invalid(422);"
 b=rep(b,old.replace('\n','\r\n'),new.replace('\n','\r\n'))
 b=rep(b,'use(&$visit,&$leaves,$id):void','use(&$visit,&$leaves,&$id):void')
 b=rep(b,"   if(($filter['field']??null)==='fornecedor_id'&&(!$and||($filter['operator']??null)!=='eq'||self::signedInteger($filter['value']??null,422)!==$id))self::invalid(422);", "   if(($filter['field']??null)==='fornecedor_id'){if(!$and||($filter['operator']??null)!=='eq')self::invalid(422);$selected=self::signedInteger($filter['value']??null,422);if($id!==null&&$selected!==$id)self::invalid(422);$id=$selected;}")
 return rep(b,"  return ['fornecedor_id'=>$id];","  if($id===null)self::invalid(422);return ['fornecedor_id'=>$id];")
change('backend/src/Runtime/RuntimeImportDiscountRead.php',helper)
def schema(b):
 start=b.index(b'\n    "contextField": {')+1;end=b.index(b'\n    "fieldCondition": {',start)+1;part=b[start:end]
 prop='''        "filterOnly": {
          "type": "boolean"
        }'''.replace('\n','\r\n')
 addition='''        "filterOnly": {
          "type": "boolean"
        },
        "integerRange": {
          "type": "object", "required": ["min", "max"], "additionalProperties": false,
          "properties": {"min": {"type": "integer", "minimum": -2147483648, "maximum": 2147483647}, "max": {"type": "integer", "minimum": -2147483648, "maximum": 2147483647}}
        }'''.replace('\n','\r\n')
 part=rep(part,prop,addition)
 # Preserve the predecessor filterOnly condition byte-for-byte and append a separate range condition.
 tail='''        }
      ],
      "additionalProperties": false'''.replace('\n','\r\n')
 replacement='''        },
        {
          "if": {"required": ["integerRange"]},
          "then": {"required": ["field", "required", "readonly", "filter", "createDefault"], "properties": {"required": {"const": true}, "readonly": {"const": true}, "filter": {"const": true}, "createDefault": {"const": false}}}
        }
      ],
      "additionalProperties": false'''.replace('\n','\r\n')
 part=rep(part,tail,replacement);b=b[:start]+part+b[end:]
 profile='''  "allOf": [
    {
      "if": {"required": ["contextFields"], "properties": {"contextFields": {"contains": {"type": "object", "required": ["integerRange"]}}}},
      "then": {
        "properties": {
          "permissions": {"required": ["create", "edit", "delete"], "properties": {"create": {"const": false}, "edit": {"const": false}, "delete": {"const": false}}},
          "dataModel": {"properties": {"fields": {"additionalProperties": {"not": {"anyOf": [{"required": ["optionsSource"]}, {"required": ["attachment"]}, {"required": ["editor"], "properties": {"editor": {"const": "file"}}}]}}}}}
        }
      }
    }
  ],
'''.replace('\n','\r\n')
 return rep(b,'\r\n  "properties": {','\r\n'+profile+'  "properties": {')
change('public/metadata/schemas/crud-definition-v1.schema.json',schema)
print('Prepared5 native sources + private1056 helper; Grid/Form/Process/API generic unchanged')
