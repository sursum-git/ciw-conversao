from pathlib import Path
import hashlib,json,difflib
root=Path(__file__).resolve().parents[1];state=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only/php');state.mkdir(parents=True,exist_ok=True)
base=Path('D:/opencode/construtor-pg/backend/src/Runtime');plans=[]
def patch(name,changes):
 p=base/name;before=p.read_text(encoding='utf-8-sig');after=before
 for old,new in changes:
  assert after.count(old)==1,(name,old)
  after=after.replace(old,new)
 (state/name).write_text(after,encoding='utf-8')
 (root/'patches'/f'{name}.patch').write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(p),tofile=str(p))),encoding='utf-8')
 plans.append({'target':p.as_posix(),'baselineSha256':hashlib.sha256(p.read_bytes()).hexdigest(),'changes':[{'old':a,'new':b}for a,b in changes]})
patch('RuntimeContainerAudit.php',[("'sincronizar'=>'impostos'","'sincronizar'=>'impostos','calcular_impostos'=>'impostos'")])
patch('RuntimeApiEntityActionService.php',[
 ("        $allocationProcess = RuntimeContainerAllocationAudit::supports($definition);",'''        $containerTaxOnly = RuntimeContainerTaxAudit::selected($operation);
        $containerTaxActor = null;
        if ($containerTaxOnly) {
            if (!RuntimeContainerTaxAudit::binding($definition, $endpoint) || $names !== [] || $requestData !== $context) { $invalid('Calculo fiscal exige operacao fixa e somente contexto do container.'); }
            $containerTaxActor = $this->attachmentActor();
        }
        $allocationProcess = RuntimeContainerAllocationAudit::supports($definition);'''),
 ("            if ($allocationProcess && ($response['body']['committed'] ?? null) !== true)","            if ($containerTaxOnly && ($response['body']['committed'] ?? null) !== true) { throw new RuntimeHttpException('CONTAINER_TAX_UNCONFIRMED','Calculo fiscal nao confirmado. Consulte a transacao antes de repetir.',502); }\n            if ($allocationProcess && ($response['body']['committed'] ?? null) !== true)"),
 ("            if (!$allocationProcess && (($response['body']['success'] ?? true) === false || isset($response['body']['error'])))", "            if (!$allocationProcess && !($containerTaxOnly && ($response['body']['committed']??null)===true) && (($response['body']['success'] ?? true) === false || isset($response['body']['error'])))"),
 ("            if (RuntimeCiwCotacaoAudit::isImportEndpoint($definition, $endpoint)) {\n",'''            if ($containerTaxOnly) { $audit = RuntimeContainerTaxAudit::inspect($definition,$endpoint,$response['body'],$context,$containerTaxActor); }
            if (RuntimeCiwCotacaoAudit::isImportEndpoint($definition, $endpoint)) {
''')
])
(root/'patches/php-plan.json').write_text(json.dumps({'textPatches':plans},indent=2),encoding='utf-8')
print('Prepared tax-only PHP patches with current baselines')
