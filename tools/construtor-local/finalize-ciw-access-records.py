"""Atualiza estado de retomada a partir das evidencias, sem ler segredos."""
import json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
PRIVATE=ROOT/'.runtime/ciw-access-20261016'
proof=json.loads((PRIVATE/'pasoe-negative-validation.json').read_text(encoding='utf-8'))
assert len(proof['cases'])==11 and all(c['passed'] for c in proof['cases'])
scope=ROOT/'integration-src/ciw-inventory/conversion-scope.json'
data=json.loads(scope.read_text(encoding='utf-8'))
data['current_stage']='phase1a_php_abl_published_negative_validated_real_ima_provider_session_pending'
scope.write_text(json.dumps(data,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
context=ROOT/'context/PROJECT_CONTEXT.md'
text=context.read_text(encoding='utf-8-sig')
paragraphs=text.split('\n\n')
for i,p in enumerate(paragraphs):
 if p.startswith('**Entrega parcial1A:**'):
  paragraphs[i]='**Entrega parcial1A publicada:** transportePHP protege origem da sessao ativa; suite456testes/2467assercoes e revisao independente passaram. CiwAccessRead/Boundary/Service compilados no OpenEdge12.2 (.42),156+82checks por cultura AMERICAN/EUROPEAN, revisao independente sem achados, publicados com .r/config e rota POST /SursumPrograms/ciw-access em sursum-api/med. Onze negativos PASOE passaram; allowedAuthProviders vazia nega tudo ate confirmar provedor/sessao IMA real. Caso positivo, login sem vinculo/acao negada reais e sessao expirada ponta a ponta pendentes; nao declarar1A concluida ou iniciar writers dependentes. Dicionarios12.2/indices confirmados, sem ler usuarios; sem escrita de negocio/schema/grants/commit. Nove arquivos canonicos novos+rota sincronizados com guards. Evidencias/pendencias em docs/integracao-ciw-access-validacao.md; credencial privada apenas .runtime/ciw-access-20261016/connection.json (nunca imprimir).'
 if p.startswith('**Acesso faltante:**'):
  paragraphs[i]='**Acesso SSH liberado:** compilador42 e runtime111 acessados por entrada protegida nesta sessao; nenhuma senha persistida. Compartilhamento //192.168.0.137/ERP confirmado. Publicacao preservou alteracao concorrente da rota IOLv3 ao reler baseline apos guard recusar catalogo antigo, antes de qualquer escrita. Pendencia externa atual e identificar provedor autenticador e disponibilizar sessao IMA real no construtor; nao reutilizar senhasSSH como LDAP nem autorizar local/admin por conveniencia.'
text='\n\n'.join(paragraphs)
marker='## Atualizacao do catalogo na entrega CIW1A —16/10/2026'
if marker not in text:
 marker_text=marker+'\n\nCatalogo relido em2026-10-16T20:35Z:19telasCIW, todasmetadadosHTTP200; painel1.0.4,6com escrita habilitada nos metadados/13leitura. Novas telas existentes ciw.container-gerar-versao, ciw.container-fechar-custos e ciw.container-sincronizar-impostos; nao foram criadas nesta entrega1A. Relatorio HTML/texto/JSON regenerado com262aplicacoes e19telas; equivalencia funcional anterior nao foi automaticamente promovida pelo aparecimento de metadados. Estado anterior16telas/1.0.3 abaixo e historico.\n\n'
 text=text.replace('## Inventário geral CIW solicitado em16/10/2026',marker_text+'## Inventário geral CIW solicitado em16/10/2026',1)
context.write_text(text,encoding='utf-8')
checkpoint=ROOT/'context/RETOMADA_2026-10-16.md'
text=checkpoint.read_text(encoding='utf-8-sig')
note='> Atualizacao CIW1A posterior: servico/fronteira/wrapper compilados12.2,238checks/cultura, publicados em sursum-api/med;11negativos reais passaram. Allowlist vazia nega tudo; falta provedor/sessao IMA real para concluir1A. SSH42/111 liberado por entrada protegida nesta sessao, sem persistir senha. Catalogo atual19telasCIW/HTTP200, painel1.0.4,6com escrita nos metadados/13leitura;16telas/1.0.3 abaixo sao historicos. Ver docs/integracao-ciw-access-validacao.md. Conta corrente fornecedor continua excluido.\n\n'
if note not in text:
 pos=text.index('\n\n')+2
 text=text[:pos]+note+text[pos:]
 checkpoint.write_text(text,encoding='utf-8')
plan=ROOT/'docs/superpowers/plans/2026-10-16-ciw-fase1a-identidade.md'
text=plan.read_text(encoding='utf-8-sig')
lines=text.splitlines()
task=0
for i,line in enumerate(lines):
 if line.startswith('### Tarefa'):task=int(line[10])
 done=(task in (3,4) or (task==1 and any(s in line for s in ['Conferir hashes','Confirmar dicionários','Fixar o recurso','Fixar enum','Revisar contrato'])) or (task==5 and any(s in line for s in ['Executar skill','Rodar PHPUnit','Preparar configuração','Conferir metadados'])))
 if done and line.startswith('- [ ]'):lines[i]=line.replace('- [ ]','- [x]',1)
text='\n'.join(lines)+'\n'
text=text.replace('**Execução:** plano aprovado','**Estado atual:** tarefas3/4 publicadas e11negativosPASOE passaram;238checks/cultura12.2. Tarefa1/origem e tarefa5/caso positivo integrado permanecem pendentes. Lista de provedores vazia nega tudo.\n\n**Execução:** plano aprovado',1) if '**Estado atual:**' not in text else text
text=text.replace('Métodos de execução ainda não escolhidos pelo usuário; este documento não inicia delegação.','Execução aqui aprovada pelo usuário; revisão independente final conforme skill, sem criar novos chats.')
text=text.replace('a informação externa pendente é o acesso remoto correto','a informação externa pendente é o provedor/sessão real IMA; SSH já liberado nesta sessão')
plan.write_text(text,encoding='utf-8')
with (PRIVATE/'progress.md').open('a',encoding='utf-8') as out:
 out.write('\nTask5 parcial: PUBLICADO6artefatos12.2+config+rota em sursum-api/med;11negativosPASOE passaram; sincronizados9arquivos canonicos novos+rota, contexto com backup. Nenhum negocio escrito. Ruling: manter HTTP200/envelope error.status do roteador existente — evidencia real e fonte canonicaconfirmam esse contrato; testes corrigidos para verificar ambos sem alterar componente compartilhado — custo se errado: consumidor que ignorar success/error.status pode interpretar recusa como sucesso; contratoPHP existente ja trata envelope. Inventario262aplicacoes/19telas atuais regenerado, sem promover equivalencia funcional por metadados. Bloqueio restante: provedor/sessao real IMA; caso positivo integrado/loginausente/acaonegada/sessaoexpirada ainda pendentes. Nao encerrar1A.\n')
print('Memoria, plano e escopo atualizados; fase1A registrada como parcial.')
