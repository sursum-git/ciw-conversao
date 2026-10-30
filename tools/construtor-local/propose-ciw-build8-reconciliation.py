"""Conservative evidence/remaining proposal only, never edits global inventory."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';B=S/'official-build8'
sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest()
ip=R/'integration-src/ciw-inventory/inventory-reviewed.json';inventory=json.loads(ip.read_text(encoding='utf-8-sig'))
coverage=json.loads((S/'source-coverage.json').read_text(encoding='utf-8-sig'))
remaining={
 'cons_item_container_amostra':'Consulta GLOBAL op1052/ciw.itens-container-amostra/1.0.0 publicada e validada: quatro campos da origem, joins e ambas as situacoes=3, read/get/filtros/paginacao. Ordenacao container ASC e desempate PK declarados no candidato; concluir review de fidelidade de ordenacao/empates e demais recursos genericos da grade antes de promover a origem. Acesso humano fica na etapa final. Nao atribuir automaticamente manutencao de desenhos/envios de outras aplicacoes a esta consulta.',
 'form_item_custos_manual':'Consulta GLOBAL somente leitura op1051/ciw.item-custos-manuais/1.0.0 publicada e validada para cod_tipo_custo=1, com23campos fisicos/NULL/DATETIME e chave opaca. Isto nao converte o formulario de inclusao/alteracao/exclusao: eventos de escrita manuais e seus vinculos permanecem pendentes, sem nova sequencia/DDL ou formula duplicada. Acesso humano fica na etapa final.',
 'cons_selec_despesas':'Processo explicito op1047/ciw.container-selecionar-despesas/1.0.0 publicado, linkCID no paiop1003/1.0.4 e opcoes readonly das oito ordenacoes validadas. Rotinas centrais compartilhadas preservam criar defaults ativos naoimpostos, marcar selecionadas e calculadas subset/fallback, seguidas de impostos. TT/rollback/auditoria estao comprovados; execucao operacional positiva com registros novos/limpeza e acesso humano read/process permanecem pendentes e nao autorizados por esta proposta. Limites de collation/empate e selecao1..100 continuam declarados.'
}
proofpaths=[B/'official-compile-verification.json',B/'canonical-manifest.json',B/'active-manifest.json',B/'pasoe-read-proof.json',B/'runtime-read-proof.json',S/'build8-metadata-publication-preparation/metadata-publication.json']
for p in proofpaths:assert json.loads(p.read_text(encoding='utf-8-sig'))['success']
entries=[]
for name,text in remaining.items():
 e=next(e for e in inventory['entries'] if e['name']==name)
 source=next(e for e in coverage['entries'] if e['application']==name)
 entries.append({'application':name,'preserve':{k:e.get(k) for k in ['state_group','target_screen','target_version']},
                 'remainingBefore':e['remaining'],'remainingProposed':text,
                 'evidenceAppendProposed':'Build8 oficial12.2:74compiles/84TT4664checks; runtime/metadata/nativo publicados. Ver official-build8/{official-compile-verification,active-manifest,pasoe-read-proof,runtime-read-proof}.json e build8-metadata-publication-preparation/metadata-publication.json. Sem negocio/processrun/permissao humana nova.',
                 'sourceFiles':source['substantive'],'promoteConverted':False})
result={'status':'PROPOSAL_NOT_APPLIED','scope':'remaining/evidence only','inventoryBaselineSha256':sha(ip),
        'applicationCount':inventory['application_count'],'proofs':[{'path':str(p),'sha256':sha(p)} for p in proofpaths],
        'entries':entries,'statesPreserved':True,'targetsPreserved':True,'countsPreserved':True,
        'globalInventoryChanged':False,'humanPermissionsChanged':False,'businessExecuted':False,
        'reviewRequired':'Root compare current source events/query and actual receipts before applying any proposal.'}
p=S/'build8-reconciliation-proposal.json';p.write_text(json.dumps(result,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print(json.dumps({'origins':len(entries),'inventoryChanged':False,'sha256':sha(p)}))
