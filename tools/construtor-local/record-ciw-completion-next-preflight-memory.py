"""Local checkpoint only; no canonical code, grants or business writes."""
from pathlib import Path
import json,hashlib,shutil
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert load(S/'readonly7-reconciliation-applied.json')['countsPreserved']
assert load(S/'container-attachments-download/document-root-preflight-scope.json')['fileAvailabilityValidated']is False
sql=load(S/'sql-profile-diagnostic-v6.json');assert sql['connected']is False
sources=load(R/'integration-src/ciw-inventory/ciw-completion-next20d-20261028-source-manifest.json');assert len(sources['scope'])==20 and len(sources['files'])==77
p=R/'context/CIW_COMPLETION_GOAL_2026-10-28.md';before=p.read_bytes();text=before.decode('utf-8-sig')
heading='## Build7 publicado e validado — quatro consultas no construtor'
addition='''## Retomada seguinte — composição8 retida e preflight de anexos

**Build8 ainda NÃO liberado, compilado oficialmente ou publicado.** Composição local1047seleção/1051custosmanuaisreadonly/1052amostrasglobal reúne110fontes,74compiles12.2planejados,21suites/1.166checks×4/4.664.71compileslocais12.8/84logsTT/NUMDBS0 e FULL944PHP6.273 passaram, mas entrada REAL validateExternalDraft1047 retorna422ENTITY_API_OPTIONS_PARAMETERS: normalização descarta opções dos dois parâmetros string/dropdown. Gerente/executor corrigem em candidato isolado com teste da entrada completa; não integrar snapshot antigo nem relaxar validação global.1051/1052/Registry6ops passaram separadamente. ExatoPHP1050f227 e demais baselines7 continuam obrigatórios.

**Anexos readonly candidato revisado, não publicado:** manifest container-attachments-download/e64108d15e24b1692c2d9ad31555cbeb4e960a6fd660a551cbe17e922d6522df e manager-review1868dae411c20fb1f4f6ed7a9587fc103e30fc6ac75021eb822cfe024861f570. Reusa op1004/broker/rota existentes, semupload/manutenção. Root170comparado ao diretório Scriptcase, existe/nãosymlink/configidêntica. Porémconsulta332526retornou0anexos; document-root-preflight-scope.json registra fileAvailabilityValidated=false. Não confundir rootPASS com arquivopositivo. Readeratual não expõe caminho_arquivo, só tem_arquivo. Probe privado12.2somente leitura de até5IDs+basenameMED,50miloperações/10s/NUMDBS1: attachment-identity-readonly-probe/plano075252d430f56666d35fa878650604af60d910d630b6bcd449d7502367290a54 em execução49935 nesta gravação; credencial jáentrada, não repetir. Sempublication ouprogramasdenegócio. Próximoé confirmar retorno/compilelog/JSONprivado e disponibilidadefísica fechada, semprintfilenames.

**SQLODBC continua inconclusivo:** v3/4/5 falharam por erro de sintaxe no próprio diagnóstico (fecho de array), identificado por lintPHP e corrigido antesv6. Não foi falhaVPN/driverprovada. v6concluiu: DSNregistrado, credenciais presentes, conexãofalse, SQLSTATEnull, warningUTF8válido/mbdisponível, apenaspalavrasDriverManager/DataDirect/ODBC/SQLConnect. SemconsultaSQLliteral executada; gates1040/41/48 mantidos. Nenhumaviso bruto/credencial persistido. Não repetir diagnósticos sem nova hipótese concreta.

**Reconciliação conservadora aplicada:** cincoorigens1045/46/49/50 tiveram apenas remaining/evidence corrigidos porhash/fontes+7recibos positivos, sem alterar state/state_group/target/sourcehistory/contagens. readonly7-reconciliation-applied.json. Inventário continua262/62Convertido/200nãoencerrado, semfecharorigemporsimilaridade.

**Coleta20d CONCLUÍDA57422/exit0:**20apps/77arquivos/383literais sensíveis omitidos, sources/scriptcase/ciw-completion-next20d-20261028 e integration-src/ciw-inventory/ciw-completion-next20d-20261028-source-manifest.json. Sófontes, semexecutarPHPlegado;ControlesFINAL/menuContaCorrenteexclusão pontual preservados. Request20d não émais pendência de coleta; cobertura seráatualizada pelogerente sempromoverestados.

TrêsreadsW1reiteradaspelo usuário jáestavamconsumidas/UIverificadas, não reaplicadas. QuatroAUX,quatroNOVASreads7 e1042perms/cenário continuamSEMresposta/gatefalse;nenhumgrant/write inferido. Objetivoglobal ACTIVE.

'''
assert addition.strip()not in text
backup=S/'memory-next-preflight-before.md';assert not backup.exists();shutil.copy2(p,backup)
p.write_text(text.replace(heading,addition+heading,1),encoding='utf-8')
work=load(S/'ROOT_ACTIVE.json');work.update(officialBuild8='PREPARED_LOCAL_GREEN_BUT_NATIVE1047_ENUM_NORMALIZATION_GATE_NO_RELEASE',attachmentRoot='ROOT_MATCH_CONFIRMED_FILE_AVAILABILITY_UNPROVEN',attachmentProbe='RUNNING49935_DO_NOT_REPLAY',source20d='COLLECTED20_APPS77FILES383OMITTED',sqlProfile='V6_INCONCLUSIVE_NO_LITERAL_SQL_PROOF',reconciliation='5ORIGINS_EVIDENCE_ONLY_STATES_COUNTS_TARGETS_PRESERVED')
(S/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(S/'memory-next-preflight.json').write_text(json.dumps(dict(success=True,before=hashlib.sha256(before).hexdigest(),after=hashlib.sha256(p.read_bytes()).hexdigest(),canonicalCodeChanged=False,humanGrantsChanged=False,businessWrites=False,goal='ACTIVE'),indent=2)+'\n')
print('PASS local continuation memory; build8 withheld/probe49935running/source20dcomplete; goalACTIVE')
