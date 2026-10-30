from pathlib import Path
import json,hashlib,difflib,copy
root=Path(__file__).resolve().parents[1];repo=Path('D:/opencode/construtor-pg')
state=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/native/public/metadata/schemas');state.mkdir(parents=True,exist_ok=True)
out=root/'patches/native-lookup-parameters';plans=[]
parameter_fields={'type':'array','minItems':1,'maxItems':2,'uniqueItems':True,'items':{'type':'string','pattern':'^(?!context$|operation$|resource$|parameters$)[a-z][a-z0-9_]*$'}}
options={'type':'object','required':['endpointId'],'properties':{'endpointId':{'type':'string','pattern':'^options\\.[A-Za-z_][A-Za-z0-9_]*$'},'parameterFields':parameter_fields},'additionalProperties':False}
for name in ['process-definition-v1.schema.json','crud-definition-v1.schema.json']:
 p=repo/'public/metadata/schemas'/name;raw=p.read_bytes();before=raw.decode('utf-8-sig');d=json.loads(before);changes=[]
 if name.startswith('process'):
  props=d['$defs']['parameterField']['properties'];assert 'array'not in props['type']['enum'] and 'optionsSource'not in props
  changes=[{'op':'add','path':'/$defs/parameterField/properties/type/enum/-','value':'array'},{'op':'add','path':'/$defs/parameterField/properties/itemType','value':{'const':'integer'}},{'op':'add','path':'/$defs/parameterField/properties/optionsSource','value':options}]
  props['type']['enum'].append('array');props['itemType']={'const':'integer'};props['optionsSource']=copy.deepcopy(options)
 else:
  props=d['$defs']['field']['properties']['optionsSource']['properties'];assert 'parameterFields'not in props
  changes=[{'op':'add','path':'/$defs/field/properties/optionsSource/properties/parameterFields','value':parameter_fields}];props['parameterFields']=copy.deepcopy(parameter_fields)
 after=json.dumps(d,ensure_ascii=False,indent=2)+'\n';(state/name).write_text(after,encoding='utf-8')
 (out/(name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=p.as_posix(),tofile=p.as_posix())),encoding='utf-8')
 plans.append({'target':p.as_posix(),'baselineSha256':hashlib.sha256(raw).hexdigest(),'operations':changes,'candidateSha256':hashlib.sha256((state/name).read_bytes()).hexdigest()})
(out/'schema-patch-plan.json').write_text(json.dumps({'jsonPatches':plans},indent=2)+'\n',encoding='utf-8')
print('Prepared minimal process/CRUD JSONSchema native lookup patches')
