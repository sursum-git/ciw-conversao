import hashlib,json
from pathlib import Path
pid=2118550
proc=Path('/proc')/str(pid)
env={}
for entry in (proc/'environ').read_bytes().split(b'\0'):
    if b'=' in entry:
        key,value=entry.split(b'=',1)
        name=key.decode(errors='replace')
        if name in {'CATALINA_BASE','CATALINA_HOME','PASOE_AGENT_NAME','PASOE_INSTANCE','APPSERVER_NAME','HOSTNAME','OEABL_APP_NAME','OEAGENTNAME','OEABLAPPNAME','AGENT_NAME','DLC','WRKDIR'}:
            env[name]=value.decode(errors='replace')
args=(proc/'cmdline').read_bytes().decode(errors='replace').split('\0')
selected={}
for i,arg in enumerate(args[:-1]):
    if arg in {'-name','-logfile','-T','-ubpid','-ASID','-sessionModel','-uuid','-appname','-agentname'}:
        selected[arg]=args[i+1]
print(json.dumps({'pid':pid,'process':(proc/'comm').read_text().strip(),'cwd':str((proc/'cwd').resolve()),'identityEnvironment':env,'identityArguments':selected},indent=2))
root=Path('/mnt/datasul/ERP/sursum')
for name in ['PasoeExecutionContext.cls','PasoeExecutionContext.r','JsonProgramWebHandler.cls','JsonProgramWebHandler.r','ApiExecutionRepository.cls']:
    file=root/name
    print(name,hashlib.sha256(file.read_bytes()).hexdigest() if file.exists() else 'MISSING')
props=Path('/dados/pasoe/sursum-api/conf/openedge.properties')
for line in props.read_text().splitlines():
    if line.startswith('[') or any(line.strip().startswith(x+'=') or line.strip().startswith(x+' =') for x in ['agentLogFile','agentStartupParam','appName','agentStartupProc','sessionStartupProc']):
        if 'password' not in line.lower(): print(line)
