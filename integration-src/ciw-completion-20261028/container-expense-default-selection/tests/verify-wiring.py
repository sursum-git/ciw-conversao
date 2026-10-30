from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/container-expense-default-selection'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
checks=0
def test(value,label):
 global checks
 checks+=1
 assert value,label
for plan_name in ['core-plan.json','php-plan.json','native-lookup-parameters/patch-plan.json']:
 plan=json.loads((root/'patches'/plan_name).read_text(encoding='utf-8'))
 for entry in plan['textPatches']:
  target=Path(entry['target']);test(sha(target)==entry['baselineSha256'],'physical baseline changed '+target.name)
  before=target.read_text(encoding='utf-8-sig');after=before
  for change in entry['changes']:
   test(after.count(change['old'])==1,'exact unique patch anchor '+target.name);after=after.replace(change['old'],change['new'])
  if 'motor-progress'in target.parts:stage=state/'local'/target.relative_to(Path('D:/opencode/motor-progress/v2'))
  elif 'native-lookup'in plan_name:stage=state/'native'/target.relative_to(Path('D:/opencode/construtor-pg'))
  else:stage=state/'php'/target.name
  test(stage.read_text(encoding='utf-8-sig')==after,'staged candidate matches exact patch '+target.name)
for entry in json.loads((root/'patches/native-lookup-parameters/schema-patch-plan.json').read_text(encoding='utf-8-sig'))['jsonPatches']:
 test(sha(Path(entry['target']))==entry['baselineSha256'],'schema physical baseline changed')
 test(sha(state/'native/public/metadata/schemas'/Path(entry['target']).name)==entry['candidateSha256'],'schema candidate changed')
before=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersImpostosService.p').read_text(encoding='utf-8-sig')
after=(state/'local/sursum-api/programs/ContainersImpostosService.p').read_text(encoding='utf-8-sig')
def proc(text,name):return re.search(r'^PROCEDURE '+name+r':.*?^END PROCEDURE\.',text,re.M|re.S).group()
for name in ['TaxPlan','IpiPlan','StepMemory','SharedTaxAmount']:
 test(proc(before,name)==proc(after,name),'central formula/primitive changed '+name)
for name in ['TaxPlan','IpiPlan','CalculatedPlan','UpsertPlan','PersistPlan','LoadState','LoadCompany','LoadCatalog']:
 test(after.count('PROCEDURE '+name+':')==1,'duplicated shared primitive '+name)
test(re.findall(r'^DEFINE (?:INPUT|OUTPUT|INPUT-OUTPUT) PARAMETER.*$',after,re.M)==re.findall(r'^DEFINE (?:INPUT|OUTPUT|INPUT-OUTPUT) PARAMETER.*$',before,re.M),'fiscal ABI altered')
test('ELSE IF cOperation="calcular_impostos" THEN RUN TaxPlan.'in after,'tax-only1043 branch lost')
test('IF cOperation<>"selecionar_despesas" THEN FOR EACH ttRel'in after,'old calculated topology changed')
wrapper=(state/'local/sursum-api/programs/ContainersProcessos.p').read_text(encoding='utf-8-sig')
test('{sursum-api/includes/parametros_ima.i}'in wrapper,'direct IMA include lost')
builder=json.loads((root/'metadata/selection-builder-draft.json').read_text(encoding='utf-8-sig'));test(builder['programDraft']['programCode']=='op1047','reservation')
fields={f['code']:f for f in builder['entityDraft']['fields']}
test([o['value']for o in fields['ordem_campo']['options']['options']]==['ordem','despesa_id','log_calculada','perc_calculo'],'UI offers unsupported text order')
test(fields['despesa_ids']['required']is True,'public empty selection accepted')
test(fields['despesa_ids']['options']['api']['optionsSource']['parameterFields']==['ordem_campo','ordem_direcao'],'signed enum dependencies missing')
source=json.loads((root/'metadata/api-source-preview.json').read_text(encoding='utf-8-sig'));test(len(source['operations'])==8,'source6->8 preview')
addition=json.loads((root/'metadata/source-addition.json').read_text(encoding='utf-8-sig'));baseline=Path(addition['target']);original=json.loads(baseline.read_text(encoding='utf-8-sig'))
test(sha(baseline)==addition['baselineSha256']and addition['baselineIsFuture1043']is False,'source actual published hash guard')
test(source['operations'][:6]==original['operations'],'source preserves all six current operations exactly')
test({k:source[k]for k in source if k!='operations'}=={k:original[k]for k in source if k!='operations'},'source global sanitized fields preserved')
parentPatch=json.loads((root/'metadata/parent-navigation.json').read_text(encoding='utf-8-sig'));parentPath=Path(parentPatch['target']);parent=json.loads(parentPath.read_text(encoding='utf-8-sig'))
test(sha(parentPath)==parentPatch['baselineSha256']and parentPatch['baselineVersion']=='1.0.3','parent actual published1.0.3 hash guard')
config=next(v['builderConfig']for v in parent['versions']if v['version']=='1.0.3');preview=json.loads((root/'metadata/parent-builderConfig-preview.json').read_text(encoding='utf-8-sig'))
test(preview['rowLinks'][:-1]==config['rowLinks']and {x['id']for x in config['rowLinks']}=={'memoria_calculo','calcular_impostos'},'parent existing memory/tax links preserved')
test({k:v for k,v in preview.items()if k!='rowLinks'}=={k:v for k,v in config.items()if k!='rowLinks'},'parent only additive row link')
test(not any(source.get('authHeaders',{}))and all(not op.get('headers')for op in source['operations']),'private auth headers included')
result={'success':True,'checks':checks,'canonicalFilesChanged':False,'metadataGate':'rebased to published source6 and parent1.0.3; root must compare live hashes before publication'}
(state/'wiring-result.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print('PASS exact baseline/patch wiring and sole fiscal primitives checks='+str(checks))
