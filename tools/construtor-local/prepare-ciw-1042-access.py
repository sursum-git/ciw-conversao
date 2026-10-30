"""Prepare the three explicitly approved permissions; no PHP/DB execution."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028/batch1042-access';s.mkdir()
authorization=json.loads((r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/human-authorization-20261028.json').read_text())
assert authorization['permissionApprovalReference']=='call_bc3aa9e44c784c699773a491d7037c2f/item0'
permissions=['container_despesas_lote_progress.read','container_despesas_lote_progress.edit','container_despesas_lote_progress.delete']
assert authorization['permissions']==permissions
old="['container_versao_pagtos_historico_med_progress.read'=>true,'container_versao_nfs_historico_med_progress.read'=>true,'container_versao_descontos_historico_med_progress.read'=>true,'container_versao_despesas_historico_med_progress.read'=>true]"
new='['+','.join("'"+x+"'=>true"for x in permissions)+']'
oldScreens="['ciw.container-versao-pagamentos-historico','ciw.container-versao-nfs-historico','ciw.container-versao-descontos-historico','ciw.container-versao-despesas-historico']"
for source,dest in [('enable-ciw-completion-wave2-aux-reads.php','enable-ciw-1042-access.php'),('verify-ciw-completion-wave2-aux-access.php','verify-ciw-1042-access.php')]:
 text=(r/'tools/construtor-local'/source).read_text();assert text.count(old)==1
 text=text.replace(old,new).replace('wave2-aux-access','batch1042-access').replace('explicit-ciw-completion-wave2-aux-reads','explicit-ciw1042-three-approved-permissions').replace('somente4reads','somente3permissoes').replace('exactly4reads','exactly3permissions')
 if source.startswith('enable'):
  assert oldScreens in text;text=text.replace(oldScreens,"['ciw.container-despesas-lote']")
  text=text.replace('// Preparação somente leitura por padrão. Aplicação exige autorização humana específica ainda não recebida.','// Aplicação exige a autorização específica recebida e o metadado publicado. Somente três permissões.')
  text=text.replace("$require(!file_exists($state.'/applied.json'),'Aplicacao ja registrada');", "$require(is_file($root.'/.runtime/ciw-completion-20261028/batch1042-metadata/metadata-publication.json'),'Metadados1042 ainda nao publicados');\n$require(!file_exists($state.'/applied.json'),'Aplicacao ja registrada');")
 (r/'tools/construtor-local'/dest).write_text(text)
(s/'authorization.json').write_text(json.dumps(dict(authorized=True,consumed=False,user='tadeu.parreiras',permissions=permissions,humanApprovalReference=authorization['permissionApprovalReference'],status='AUTHORIZED_WAIT_METADATA_AND_ROOT_REVIEW'),indent=2)+'\n')
print('Prepared exact3 grant tools/gate from explicit approval; no PHP/DB execution')
