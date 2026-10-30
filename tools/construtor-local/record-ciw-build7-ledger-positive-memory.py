"""Record the real1050 detail proof and pending explicit four-read question."""
from pathlib import Path
import hashlib,json,re,shutil
root=Path(__file__).resolve().parents[2];state=root/'.runtime/ciw-completion-20261028';build=state/'official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(build/'pasoe-native-ledger-positive-proof.json');assert proof['success']and proof['positiveGetProved']and proof['nativeGetExactPasoe']and proof['pasoeCrossOwnerRejected']
gate=load(state/'build7-readonly-access/authorization.json');assert gate['authorized']is False and gate['consumed']is False
backup=state/'memory-build7-ledger-positive-backup';backup.mkdir()
detail=root/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=detail.read_text(encoding='utf-8-sig');shutil.copy2(detail,backup/detail.name)
heading='## Build7 publicado e validado — quatro consultas no construtor'
addition='''
**Atualização prevalente — quatro detalhes reais agora comprovados:** o probe privado70729 terminou/exit0, compilado emOpenEdge12.2, NUMDBS1 somente leitura, encontrou cinco pares de identidades com parentexistente dentro dos limites. Nenhum valor financeiro/nome foi projetado e não houve escrita. Usando um dono observado, **1050 passou lista/detalhe/filtroPK/contradição/cross-owner no PASOE e lista/detalhe/filtro no runtime nativo**, com igualdade dos dados. Prova official-build7/pasoe-native-ledger-positive-proof.json; linhas somente no arquivo privado ledger-probed-owner-rows-private.json. Os recibos anteriores de extratos vazios continuam observações válidas dos primeiros donos, mas NÃO são mais limitação de teste positivo. Não repetirprobe70729 ou inventarIDs.

**Quatro NOVASreads1045/46/49/50 foram solicitadas em pergunta assíncrona**, ainda sem resposta nesta gravação. Gate build7-readonly-access/authorization.json authorized=false/consumed=false. Ferramentas enable-ciw-completion-build7-reads.php e verify-ciw-completion-build7-access.php lintadas; modo prepare executado somente leitura, quatro telas assinadas presentes. Aguardar autorização específica; esclarecido escopo GLOBAL das duas consultas gerais e dono obrigatório dos dois extratos, sem writers/processos. Não confundir com3W1consumidas ou4AUXanteriores pendentes. As passagens antigas abaixo sobre teste1050pendente/probeemexecução/gateem preparação são históricas e supersedidas por esta atualização.

'''
assert addition.strip()not in text;text=text.replace(heading,heading+'\n'+addition,1);detail.write_text(text,encoding='utf-8')
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')];receipts=[]
for i,path in enumerate(paths):
 raw=path.read_bytes();text=raw.decode('utf-8-sig');match=re.search(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',text,re.S);assert match
 marker=match.group(0);marker=marker.replace('Runtime4listas/3detalhes/contextos/linkpassou. GET1050positivoainda não provado(datasetobservadovazio); probeRO70729 emexec, não repetir.','Runtime4listas/QUATROdetalhespositivos/contextos/linkpassou. 1050lista/get/filtros/crossowner reaisPASOE+nativeGREEN porIDobservadoprobe12.2RO70729CONCLUÍDO5pares; não repetir.')
 marker=marker.replace('QuatroNOVASreads empreparação, NÃOconcedidas;','QuatroNOVASreads solicitadas em pergunta assíncrona, AGUARDAMresposta/gatefalse, NÃOconcedidas;')
 assert marker!=match.group(0);shutil.copy2(path,backup/(str(i)+'-'+path.name));path.write_text(text[:match.start()]+marker+text[match.end():],encoding='utf-8');receipts.append(dict(path=str(path),before=hashlib.sha256(raw).hexdigest(),after=sha(path)))
work=load(state/'ROOT_ACTIVE.json');work.update(officialBuild7='PUBLISHED25_4METADATA140_NATIVE4READ4POSITIVEGET',ledger1050='PHP_F227_GREEN917_6018_REAL_PASOE_NATIVE_GET_FILTER_OWNER_GREEN',build7HumanAccess='PENDING_EXPLICIT4READ_RESPONSE_GATEFALSE',next='Composeofficial8_1047exactmaps_1051_1052;awaitAUX/batch1042/new4readanswers;globalACTIVE')
(state/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n');(state/'memory-build7-positive-ledger.json').write_text(json.dumps(dict(success=True,files=receipts,allFourPositiveDetails=True,humanGrantsApplied=False,businessWrites=False,goal='ACTIVE'),indent=2)+'\n')
print('PASS4markers/detail;4realpositivegets;probe70729complete5;new4readquestion pending;goalACTIVE')
