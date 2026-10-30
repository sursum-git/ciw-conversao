"""Prepare exact four-read grant tools; human authorization remains false."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028/wave2-aux-access';s.mkdir(exist_ok=True)
assert not(s/'authorization.json').exists(),'Prepared before; inspect rather than reset authorization'
old="['container_calculos_impostos_med_progress.read'=>true,'container_despesa_memoria_med_progress.read'=>true,'container_versoes_historico_med_progress.read'=>true]"
permissions=['container_versao_pagtos_historico_med_progress.read','container_versao_nfs_historico_med_progress.read','container_versao_descontos_historico_med_progress.read','container_versao_despesas_historico_med_progress.read']
new='['+','.join("'"+x+"'=>true"for x in permissions)+']'
text=(r/'tools/construtor-local/enable-ciw-completion-wave1-reads.php').read_text(encoding='utf-8-sig');assert old in text
text=text.replace(old,new).replace('wave1-access','wave2-aux-access').replace('explicit-ciw-completion-wave1-reads','explicit-ciw-completion-wave2-aux-reads').replace('somente3reads','somente4reads')
screens="['ciw.container-calculos-impostos-med','ciw.container-despesa-memoria-med','ciw.container-versao-itens-historico']"
assert screens in text
text=text.replace(screens,"['ciw.container-versao-pagamentos-historico','ciw.container-versao-nfs-historico','ciw.container-versao-descontos-historico','ciw.container-versao-despesas-historico']")
(r/'tools/construtor-local/enable-ciw-completion-wave2-aux-reads.php').write_text(text,encoding='utf-8')
verify=(r/'tools/construtor-local/verify-ciw-completion-wave1-access.php').read_text(encoding='utf-8-sig').replace(old,new).replace('wave1-access','wave2-aux-access').replace('exactly3reads','exactly4reads')
verify=verify.replace("$gate['humanApprovalReference']==='call_5111d629eb42427c81f8fccf247bd988'","is_string($gate['humanApprovalReference']??null)&&strlen($gate['humanApprovalReference'])>0")
(r/'tools/construtor-local/verify-ciw-completion-wave2-aux-access.php').write_text(verify,encoding='utf-8')
(s/'authorization.json').write_text(json.dumps(dict(authorized=False,consumed=False,user='tadeu.parreiras',permissions=permissions,humanApprovalReference=None,status='PENDING_HUMAN_RESPONSE'),indent=2)+'\n')
print('Prepared4readtools; authorizationfalse; no permission/database mutation')
