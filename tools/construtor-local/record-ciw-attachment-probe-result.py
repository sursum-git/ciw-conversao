"""Close the completed readonly probe in local memory, preserving missing-file evidence."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
probe=load(S/'attachment-identity-readonly-probe/results/attachment-identity-private.json')
files=load(S/'container-attachments-download/document-files-preflight.json')
assert probe['completed']and probe['numDbs']==1 and probe['foundCount']==5 and not probe['partial']
assert files['brokerRootMatchesLegacyDoc']and len(files['references'])==5 and all(not r['exists']for r in files['references'])and not files['fileAvailabilityValidated']
p=R/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=p.read_text(encoding='utf-8');old='em execução49935 nesta gravação; credencial jáentrada, não repetir. Sempublication ouprogramasdenegócio. Próximoé confirmar retorno/compilelog/JSONprivado e disponibilidadefísica fechada, semprintfilenames.'
new='CONCLUÍDO49935/exit0/12.2compilePASS/cincoidentidadesprivadas, não repetir. Statliteral170confirmou todasas cinco referências antigas AUSENTES; rootseguecorreto. document-files-preflight.json registra fileAvailabilityValidated=false, semdownload/conteúdo/write. Positivoarquivo aindaNÃOprovado; companiondereferênciasrecentes em preparação, semmatchingfuzzy/reinterpretação de basename. Sempublication ouprogramasdenegócio.'
assert text.count(old)==1;text=text.replace(old,new)
text=text.replace('cobertura seráatualizada pelogerente sempromoverestados.','cobertura atualizada pelogerente:176fontessubstantivos/23semPHP/1wrapperincompleto entreas200nãoencerradas, sempromoverestados.')
p.write_text(text,encoding='utf-8')
work=load(S/'ROOT_ACTIVE.json');work.update(attachmentProbe='COMPLETED49935_122_5IDS_NO_REPLAY',attachmentRoot='ROOT_MATCH_5OLD_PERSISTED_REFS_MISSING_FILE_POSITIVE_PENDING',sourceCoverage='176SUBSTANTIVE23NOPHP1WRAPPER_OF200')
(S/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(S/'memory-attachment-probe-result.json').write_text(json.dumps(dict(success=True,officialProbeCompleted=True,positiveFileAvailability=False,oldReferencesMissing=5,businessWrites=False,documentWrites=False,goal='ACTIVE'),indent=2)+'\n')
print('PASS memoryprobe49935completed; rootcorrect/fiveoldfilesmissing; no positivefileclaim')
