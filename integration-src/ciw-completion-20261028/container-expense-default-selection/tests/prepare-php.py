from pathlib import Path
import json,hashlib,difflib
root=Path(__file__).resolve().parents[1];w=root.parents[2];repo=Path('D:/opencode/construtor-pg/backend/src/Runtime');state=w/'.runtime/ciw-completion-20261028/container-expense-default-selection/php';state.mkdir(parents=True,exist_ok=True)
pre=w/'.runtime/ciw-completion-20261028/container-tax-only/frozen-v1';plans=[];predecessors=[];base={};physicalBaselines={};integrated={}
prior=json.loads((root/'patches/php-plan.json').read_text(encoding='utf-8'));expected={e['target']:e['expectedFuture1043Sha256']for e in prior['predecessorBaselines']}
official=w/'.runtime/ciw-completion-20261028/official-build7/canonical-manifest.json'
integrated7={Path(e['target']).as_posix():e['sha256']for e in json.loads(official.read_text(encoding='utf-8-sig'))['files']}
for entry in json.loads((pre/'patches/php-plan.json').read_text())['textPatches']:
 p=Path(entry['target']);text=p.read_text(encoding='utf-8-sig');start=hashlib.sha256(p.read_bytes()).hexdigest()
 is_integrated=hashlib.sha256(text.encode()).hexdigest()==expected[p.as_posix()]
 if not is_integrated and p.as_posix()in integrated7:
  assert start==integrated7[p.as_posix()],f'Integrated7 baseline moved {p}'
  # Root authorized exact additive rebase after1043 and the four readonly resources.
  for change in entry['changes']:assert change['new']in text,(p,'1043 predecessor not preserved')
  is_integrated=True
 if not is_integrated:
  assert start==next(e['canonicalCurrentSha256']for e in prior['predecessorBaselines']if e['target']==p.as_posix()),f'Root explicit rebase required {p}'
  for c in entry['changes']:
   assert text.count(c['old'])==1,(p,c['old']);text=text.replace(c['old'],c['new'])
 base[p.name]=text;physicalBaselines[p.name]=start;integrated[p.name]=is_integrated;predecessors.append({'target':p.as_posix(),'canonicalCurrentSha256':start,'original1043BaselineSha256':entry['baselineSha256'],'expectedFuture1043Sha256':hashlib.sha256(text.encode()).hexdigest(),'predecessorAlreadyIntegrated':is_integrated,'rebase1043ByExactAnchors':not is_integrated})
def patch(name,changes):
 p=repo/name;before=base.get(name,p.read_text(encoding='utf-8-sig'));after=before
 for old,new in changes:
  assert after.count(old)==1,(name,old);after=after.replace(old,new)
 (state/name).write_text(after,encoding='utf-8');(root/'patches'/f'{name}.patch').write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(p),tofile=str(p))),encoding='utf-8')
 plans.append({'target':p.as_posix(),'baselineSha256':physicalBaselines[name]if name in base and integrated[name]else hashlib.sha256(before.encode()).hexdigest()if name in base else hashlib.sha256(p.read_bytes()).hexdigest(),'baselineIsFuture1043':name in base and not integrated[name],'changes':[{'old':a,'new':b}for a,b in changes]})
patch('RuntimeContainerAudit.php',[
 ("'container_processos_progress','container_itens_progress'","'container_processos_progress','container_despesas_selecao_progress','container_itens_progress'"),
 ("            'container_processos_progress' => ['motor_progress_container_processos','containers-processos','container_id','container_processes'],","            'container_processos_progress' => ['motor_progress_container_processos','containers-processos','container_id','container_processes'],\n            'container_despesas_selecao_progress' => ['motor_progress_container_processos','containers-processos','container_id','container_processes'],"),
 ("'calcular_impostos'=>'impostos'","'calcular_impostos'=>'impostos','selecionar_despesas'=>'impostos'")
])
patch('RuntimeApiEntityActionService.php',[
 ('        $allocationProcess = RuntimeContainerAllocationAudit::supports($definition);', '''        $expenseDefaults=RuntimeContainerExpenseDefaultsAudit::supports($definition);$expenseDefaultsActor=null;
        if ($expenseDefaults) {
            $order=array_intersect_key($requestData,array_flip(RuntimeContainerExpenseDefaultsAudit::PARAMETERS));
            if (!RuntimeContainerExpenseDefaultsAudit::binding($definition,$endpoint,'process') || $names!==['ordem_campo','ordem_direcao','despesa_ids'] || !RuntimeContainerExpenseDefaultsAudit::order($order) || !RuntimeProgressAuditSchema::exact($requestData,['container_id','ordem_campo','ordem_direcao','despesa_ids'])) { $invalid('Selecao exige contexto, IDs e ordenacao fechados.'); }
            $expenseDefaultsActor=$this->attachmentActor();
        }
        $allocationProcess = RuntimeContainerAllocationAudit::supports($definition);'''),
 ("            if ($containerTaxOnly && ($response['body']['committed'] ?? null) !== true)","            if ($expenseDefaults && ($response['body']['committed']??null)!==true) { throw new RuntimeHttpException('CONTAINER_SELECTION_UNCONFIRMED','Selecao nao confirmada. Consulte a transacao antes de repetir.',502); }\n            if ($containerTaxOnly && ($response['body']['committed'] ?? null) !== true)"),
 ("!($containerTaxOnly && ($response['body']['committed']??null)===true)","!(($containerTaxOnly || $expenseDefaults) && ($response['body']['committed']??null)===true)"),
 ("            if ($containerTaxOnly) { $audit = RuntimeContainerTaxAudit::inspect($definition,$endpoint,$response['body'],$context,$containerTaxActor); }","            if ($containerTaxOnly) { $audit = RuntimeContainerTaxAudit::inspect($definition,$endpoint,$response['body'],$context,$containerTaxActor); }\n            if ($expenseDefaults) { $audit=RuntimeContainerExpenseDefaultsAudit::inspect($definition,$endpoint,$response['body'],$context,$expenseDefaultsActor); }"),
 ("        $allowedContext = ['entityCode', 'operation', 'actionId', 'programId', 'permissionPrefix', 'traceability', '_runtime', '_runtimeEndpoint', 'id', 'context'];","        $allowedContext = ['entityCode', 'operation', 'actionId', 'programId', 'permissionPrefix', 'traceability', '_runtime', '_runtimeEndpoint', 'id', 'context'];\n        if (RuntimeContainerExpenseDefaultsAudit::supports($definition)) { $allowedContext[]='parameters'; }"),
 ("        $context = ApiRequestContext::resolve($definition, $endpoint, $payload);\n\n        $requestData = $context ?: null;",'''        $expenseDefaults=RuntimeContainerExpenseDefaultsAudit::supports($definition);
        if ($expenseDefaults && (!RuntimeContainerExpenseDefaultsAudit::binding($definition,$endpoint,'options') || ($config['lookupParameterFields']??null)!==RuntimeContainerExpenseDefaultsAudit::PARAMETERS || ($source['parameterFields']??null)!==RuntimeContainerExpenseDefaultsAudit::PARAMETERS || !RuntimeContainerExpenseDefaultsAudit::order($payload['parameters']??null))) { throw new RuntimeHttpException('CONTAINER_SELECTION_OPTIONS_INVALID','Opcoes exigem contexto e os dois enums assinados.',422); }
        $context = ApiRequestContext::resolve($definition, $endpoint, $expenseDefaults ? ['context'=>$payload['context']??[]] : $payload);

        $requestData = $context ?: null;
        if($expenseDefaults){$requestData+=$payload['parameters'];}'''),
 ("        if (RuntimePurchaseItemAudit::supports($definition) || RuntimePurchaseExpenseAudit::supports($definition)) {\n", "        if (RuntimeContainerExpenseDefaultsAudit::supports($definition) && !RuntimeContainerExpenseDefaultsAudit::options($response['body'],$context)) { throw new RuntimeHttpException('CONTAINER_SELECTION_OPTIONS_RESPONSE','Resposta de selecao invalida ou fora do contexto.',502); }\n        if (RuntimePurchaseItemAudit::supports($definition) || RuntimePurchaseExpenseAudit::supports($definition)) {\n"),
 ("        return ['data' => $result];\n\n    }\n\n\n\n    private function containerExpenseBatchRequest", "        if (RuntimeContainerExpenseDefaultsAudit::supports($definition)) { $this->transactions->log($definition['entityCode'].'.api.options','Consulta tecnica de despesas selecionaveis.',metadata:['technical'=>true,'itemsCount'=>count($result),'containerContext'=>['version'=>1,'source'=>'runtime-validated-context','containerId'=>$context['container_id']]]); }\n        return ['data' => $result];\n\n    }\n\n\n\n    private function containerExpenseBatchRequest")
])
patch('ScreenDefinitionService.php',[("['container_processos_progress', 'container_alocacao_progress']","['container_processos_progress', 'container_alocacao_progress', 'container_despesas_selecao_progress']")])
(root/'patches/php-plan.json').write_text(json.dumps({'requiresPredecessorManifestSha256':'b1235ab3d39a9c930abd12f7a05a9674cad4149ac9765169eb6d3b6b940ce5c3','rootAuthorizedRebase':'integrated7;1043 preserved plus readonly1045/46/49/50','officialManifestPath':official.as_posix(),'officialManifestSha256':hashlib.sha256(official.read_bytes()).hexdigest(),'predecessorBaselines':predecessors,'textPatches':plans},indent=2),encoding='utf-8');print('Prepared incremental PHP selection process/options audit on integrated7 after1043')
