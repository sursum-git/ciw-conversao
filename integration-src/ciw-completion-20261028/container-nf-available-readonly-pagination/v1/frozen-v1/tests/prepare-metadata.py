from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');P=Path(__file__).resolve().parents[1]
old=W/'integration-src/ciw-completion-20261028/container-nf-available-readonly/frozen-v1/metadata'
def write(name,value):(P/'metadata'/name).write_text(json.dumps(value,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
(P/'metadata').mkdir(exist_ok=True)
preview=json.loads((old/'api-source-preview.json').read_text(encoding='utf8'))
assert len(preview['operations'])==6
assert [x['code']for x in preview['operations'][-2:]]==['nfs_disponiveis_read','nfs_disponiveis_get']
preview['operations'][-2]['totalPath']='total'
write('api-source-preview.json',preview)
addition=json.loads((old/'source-addition.json').read_text(encoding='utf8'))
addition['operations'][0]['value']['totalPath']='total'
addition['supersedesHeldProposalOnly']=str(old/'source-addition.json')
addition['requiresCurrentExportBeforePublication']=True
write('source-addition.json',addition)
draft=json.loads((old/'builder-draft.json').read_text(encoding='utf8'))
draft['programDraft']['crudOptions']['defaultSort']=[{'field':'documento','dir':'asc'},{'field':'serie','dir':'asc'},{'field':'nat_operacao','dir':'asc'}]
draft['programDraft']['changeSummary']='Consulta MED somente leitura com paginação completa dentro dos limites de leitura; associação, desassociação e exportação de todas as linhas permanecem indisponíveis.'
write('builder-draft.json',draft)
for name in ['parent-navigation-delta.json','parent-builder-preview.json']:
 (P/'metadata'/name).write_bytes((old/name).read_bytes())
print(json.dumps({'program':'op1053','operationsBefore':4,'operationsAfter':6,'listTotalPath':'total','newFrontend':False,'authReplacementAllowed':False}))
