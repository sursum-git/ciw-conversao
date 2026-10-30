"""Evidence-only five-origin proposal; never edits the global inventory or marks Converted."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';I=R/'integration-src/ciw-inventory/inventory-reviewed.json'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
inventory=load(I);publication=load(S/'official-build7/metadata-publication.json');assert publication['success'] and publication['sourceOperations']==140
specs=[
 ('cons_descontos_geral','op1045','ciw.descontos-importacao-geral','Consulta GLOBAL e labels atuais publicados; SUM reutilizado e COALESCE de utilização/saldo preservados. Falta UI LDAP após autorização e confronto final de apresentação/agrupamentos/exportações/navegação. Manutenção e estorno continuam nos programas próprios; este reader não os implementa.'),
 ('cons_det_desconto_geral','op1045','ciw.descontos-importacao-geral','GET por identidade do desconto e projeção de SUM bruto em vl_utiliz_detalhe disponíveis no reader único. Falta confrontar a apresentação do detalhe legado, que usa contexto desconto_importacao_id_corrente; não declarar origem convertida apenas por compartilhar a tela geral.'),
 ('grid_cta_corren_desconto','op1046','ciw.descontos-importacao-lancamentos','Seis campos físicos e dono desconto_importacao_id publicados com read/get/filtros; cod_usuario permanece DATE física, não ator textual. Falta UI LDAP e confronto final dos links/exportações. Escritores de lançamentos continuam separados.'),
 ('cons_itens_aptos_distr_custo','op1049','ciw.custo-distribuicao-itens-aptos','Consulta GLOBAL aptos publicada com joins e filtro situacao<>3 originais; sem empresa do container ou flags adicionais inventadas. Falta UI LDAP e confronto da seleção/navegação para a manutenção/simulação de distribuição. O reader não simula nem persiste rateio.'),
 ('cons_cta_corren_distr_item_container','op1050','ciw.custo-distribuicao-lancamentos-item','Oito campos físicos por item_container_id publicados; read/get/filtros/contexto comprovados no PASOE e no runtime nativo, incluindo chave JSON em ordem real. Falta UI LDAP e confronto final de retorno/exportações; sem fórmula nova de saldo, moedas ou estorno.'),
]
proofs=['official-compile-verification.json','canonical-manifest.json','active-manifest.json','canonical-keyfix-manifest.json','metadata-publication.json','pasoe-read-proof.json','pasoe-native-ledger-positive-proof.json']
for name in proofs:assert load(S/'official-build7'/name)['success']
rows=[]
for app,program,screen,remaining in specs:
 entry=next(x for x in inventory['entries'] if x['name']==app)
 source=R/'sources/scriptcase/ciw-completion-next20-20261028'/app
 files=[p for p in source.glob('*.php') if p.name=='index.php' or p.name.endswith('_grid.class.php')]
 assert len(files)==2 and any(x['program']==program and x['screen']==screen for x in publication['published'])
 rows.append({'name':app,'beforeEntrySha256':hashlib.sha256(json.dumps(entry,sort_keys=True,ensure_ascii=False,separators=(',',':')).encode()).hexdigest(),'stateGroupPreserved':entry['state_group'],'proposedRemaining':remaining,'relatedPublishedProgram':program,'relatedPublishedScreen':screen,'sourceProofs':[{'path':str(p.relative_to(R)),'sha256':sha(p)}for p in files],'convertedProposed':False,'applied':False})
result={'success':True,'inventoryBaselineSha256':sha(I),'scope':'remaining/evidence only; no automatic state or target mapping change','proofs':[{'path':str((S/'official-build7'/n).relative_to(R)),'sha256':sha(S/'official-build7'/n)}for n in proofs],'proposals':rows,'globalInventoryChanged':False,'authorizationChanged':False,'requiresRootReviewByHash':True}
(S/'readonly7-reconciliation-proposal.json').write_text(json.dumps(result,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
print('Prepared5 remaining/evidence proposals; state groups untouched; no Converted inference')
