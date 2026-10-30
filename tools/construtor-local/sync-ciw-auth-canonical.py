"""Sincroniza somente novos fontes CIW e memoria desta entrega, com guards/backup."""
import hashlib,json,re
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-auth-20261017';M=Path('D:/opencode/motor-progress/v2');B=Path('D:/opencode/construtor-pg')
def sha(data):return hashlib.sha256(data).hexdigest()
source=ROOT/'integration-src/ciw-auth'
report=(ROOT/'docs/integracao-ciw-auth-validacao.md').read_bytes()
files={M/'sursum-api/programs/CiwAuthenticationService.p':(source/'CiwAuthenticationService.p').read_bytes(),M/'sursum-api/sursum/CiwAuthenticationBoundary.cls':(source/'CiwAuthenticationBoundary.cls').read_bytes(),M/'sursum-api/rest/CiwAuthenticationWebHandler.cls':(source/'CiwAuthenticationWebHandler.cls').read_bytes(),M/'docs/CIW_AUTHENTICATION.md':report,B/'backend/docs/ima-user-web-auth.md':report}
for name in ['CiwAuthenticationServiceTest.p','CiwAuthenticationBoundaryTest.p','CiwAuthenticationEncodingTest.p','VerifyCiwAuthenticationNoPayload.p','RunCiwAuthenticationTests.p','CompileCiwAuthentication.p','ReadCiwAuthenticationSchema.p']:
 files[M/'tests/abl/ciw-auth'/name]=(source/name).read_bytes()
files[M/'conf-web-handler/ciw-authentication.handlers.example.json']=(json.dumps({'handlers':[{'uri':'/CiwAuthentication','class':'CiwAuthenticationWebHandler','enabled':True}]},indent=2)+'\n').encode()
files[M/'tests/abl/ciw-auth/README.md']=('''# Testes CIW de autenticacao

Compilar em OpenEdge12.2/.42, com os fontes de produto e testes copiados para
staging plano, OpenEdge.Net.pl no PROPATH e espec conectado. Executar
CompileCiwAuthentication.p; exigir COMPILER:ERROR=no e PASS108+31 por cultura.
CiwAuthenticationEncodingTest.p deve executar com CPINTERNAL UTF-8 e ISO8859-1,
contra o mesmo servico .r12.2: PASS3 em cada um. Somente TT; nao cria usuarios.
VerifyCiwAuthenticationNoPayload.p le apenas contagem da rota exclusiva, sem
payloads/senhas. Ferramentas e manifestos: conversao-sc/tools/construtor-local/
prepare-ciw-auth-compile.py e prepare-ciw-auth-delta.py. Nenhum fixture publicado.
Ver docs/CIW_AUTHENTICATION.md para estado real, caminhos e pendencia positiva.
''').encode()
block='''## Login CIW bl_tela_login — estado vigente17/10/2026

Plano complementar aprovado e executado aqui. Provedor **ima-user-web** integrado
ao AuthService/login existentes, cadastrado/habilitado pelo comando governado.
Usuario indicou **tasilpar/default**, vinculado pelo CRUD administrativo; grupos,
permissoes e demais contas preservados. Nenhum usuario/senha/grant Progress alterado.
Campo auth_source acrescentado a entidade compartilhada auth_user via Builder
oficial, sem schema/reseed: preservado modo none; normalizador registrou defaults
administrativos e globalTable=true para tabela tecnica ja compartilhada. Backups
privados auth-user-entity-{before,after}.json; nao repetir seed/import.

ABL12.2/.42:108servico+31fronteira em cada cultura AMERICAN/EUROPEAN. Revisao
independente unica concluida; lacuna Unicode reproduziu RED ISO8859-1 e foi
corrigida com GetLongchar UTF8/comparacao de bytes. EncodingGREEN3+3; espec tem
codepageISO8859-1. PHP completo491testes/2846assercoes, Auth26/116 e lint container.
Publicado em share137 via111, **sursum-api/med/9911**: handler dedicado
/CiwAuthentication sem ApiExecutionRepository/payload/CORS, no-store.11negativos
PASOE apos delta e11negativos da autorizacaoCIW passaram. Probe exclusivo: zero
execucoes de payload, nenhum payload lido. Sem negocio escrito.

Manifestos privados em D:/opencode/conversao-sc/.runtime/ciw-auth-20261017/:
publish/active-manifest.json + encoding-publish/active-manifest.json (prevalece
no servico .p/.r). ROOT.handlers ativado por tcman jmx refreshWeb para med;
refreshAgent sozinho nao recarrega mapping. Delta carregado apenas em sessoes
med ociosas; nao reiniciar/refresh por rotina. CIW_AUTH_CONNECTION_FILE aponta
arquivo privado; nunca imprimir/conservar conteudo em memoria de projeto.

**Atualizacao:** pessoa confirmou login tasilpar. GET /api/auth/session HTTP200
confirmou ima-user-web; mesma sessao ativa no servidor por hash, provider/type
corretos, sem impersonacao. AllowlistCIW agora somente ima-user-web; manifesto
source-enable/active-manifest.json prevalece no config de autorizacao, token
preservado.11negativos repetidos apos ativacao passaram.

**Pendente:** tasilpar teve as7decisoes de Coloracoes negadas no PASOE. ProbeRO
12.2 confirmou5vinculos de grupo e zero concessoes para grid_pub_coloracoes e
form_pub_coloracoes. Nenhum grant/usuario/permissao modificado. Permissoes locais
seguem apenasIOL. Pergunta enviada por outra conta existente/autorizada para
ALLOW, sem senha. Nao concluir1A nem habilitar writers; faltam positivo e
logout/revogacao reais. Sessao atual preservada. DiagnosticoPASOE usa identidade
derivada da sessao real verificada, nao prova uma telaCIW autorizada no PHP.
Admin continua local. Dois minors do cadastro adiados conforme relatorio. Proximo
funcional na ordem geral: Coloracoes; Conta corrente fornecedor/Tarefas excluido
temporariamente. Relatorio: D:/opencode/conversao-sc/docs/integracao-ciw-auth-validacao.md.

'''
contexts=[ROOT/'context/RETOMADA_2026-10-16.md',ROOT/'context/PROJECT_CONTEXT.md',M/'context/PROJECT_CONTEXT.md',B/'CONTEXTO_PROJETO.md',B/'docs/continuidade-codex.md']
for p in contexts:
 raw=p.read_bytes();text=raw.decode('utf-8-sig')
 text=re.sub(r'(?ms)^## Login CIW bl_tela_login — estado vigente17/10/2026\n.*?(?=^## |\Z)','',text)
 text=re.sub(r'(?ms)^## Execucao do login bl_tela_login aprovada —17/10/2026\r?\n.*?(?=^## |\Z)','',text)
 index=text.find('\n')+1
 files[p]=(text[:index]+'\n'+block+text[index:].lstrip('\r\n')).encode('utf-8')
baseline={str(p):sha(p.read_bytes()) if p.exists() else None for p in files}
previousPath=PRIVATE/'canonical-verification.json'
previous={e['file']:e['after'] for e in json.loads(previousPath.read_text())} if previousPath.exists() else {}
backup=PRIVATE/'canonical-backup';backup.mkdir(exist_ok=True)
result=[]
for i,(p,data) in enumerate(files.items()):
 old=p.read_bytes() if p.exists() else None
 if (sha(old) if old is not None else None)!=baseline[str(p)]:raise RuntimeError('Mudanca concorrente: '+str(p))
 if old is not None and p not in contexts and old!=data and sha(old)!=previous.get(str(p)):raise RuntimeError('Destino ja existe/diverge do ultimo hash: '+str(p))
 if old is not None and old!=data and not (backup/(str(i)+'.bin')).exists():(backup/(str(i)+'.bin')).write_bytes(old)
 p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes(data)
 if p.read_bytes()!=data:raise RuntimeError('Hash divergiu')
 result.append({'file':str(p),'before':baseline[str(p)],'after':sha(data)})
(PRIVATE/'canonical-verification.json').write_text(json.dumps(result,indent=2))
print('PASS: fontes/testes/docs e contextos sincronizados com guards; '+str(len(result))+' arquivos')
