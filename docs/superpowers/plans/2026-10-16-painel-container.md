# Conversão do Painel do Container

> Execução nesta sessão: root integra e publica; agentes trabalham nos domínios independentes. Proposta escrita e resumo em chat aprovados pelo usuário com “faça”. Não repetir aprovação do mesmo fluxo.

**Objetivo:** abrir o painel pelo registro da consulta de containers, transportar contexto validado e converter seus programas com frontend nativo por metadados e APIs Progress.

**Especificação:** [proposta aprovada](../../proposta-conversao-painel-containers.md). O pedido abrange o menu e programas vinculados, não apenas a ponte. Dependências e divergências devem ser resolvidas por evidência antes de liberar escrita.

**Arquitetura:** consulta op1000 permanece independente. Painel CRUD em formulário contextual incorpora páginas filhas via linkedPage. Serviços ABL separam leituras, cálculos e comandos transacionais. Contexto container_id corresponde a espec.pp-container.nr-container. Empresa/fornecedor/conexões derivam no servidor. Nenhuma leitura dispara cálculo persistente ou reparação histórica.

## Restrições globais

- Reutilizar construtor-pg; nenhum frontend paralelo, template livre ou mudança Kendo/vendor.
- Publicar por APIs oficiais Builder/governança e permissões existentes, sem SQL nas tabelas de metadados ou alteração assinada.
- Compilar ABL executável no OpenEdge12.2/.42 e validar sursum-api/med; publicação137 por montagem .111 com backup e hash. Não publicar .r12.8.
- Parâmetros IMA via include existente, leitura direta NO-LOCK sem cache.
- Escrever apenas registros próprios de teste na validação, removendo ao concluir. Não executar o PHP legado nem seus processos para explorar.
- Transações de escrita ABL devolvem snapshots confirmados de antes/depois e usam suporte de log já existente; nenhum sucesso antes do commit.
- Preservar diffs anteriores; sem commit/push, schema ou reassinatura.
- Determinação do usuário16/10: custo e versões são rotinas separadas reutilizáveis; não reescrever regras em múltiplos programas. Calculator puro e Collector central atendem consultas/processos; VersionService próprio deve persistir/consultar/fechar usando o resultado central, nunca outra cópia da matemática.

## Riscos a verificar em testes

1. Container ausente, inválido ou contexto divergente nunca acessa registros de outro container; Limpar filtros preserva vínculo.
2. Duas janelas de containers não compartilham empresa, fornecedor, moeda nem rastro.
3. Carregar painel/aba somente lê; os comandos persistentes são intencionais e autorizados.
4. Moeda/zero/ausência/DATE/escala e versões desatualizadas seguem regra evidenciada; divisão por zero não retorna cálculo enganoso.
5. Falha de lock, regra ou integração desfaz todas as escritas relacionadas; log técnico e snapshots não confundem tentativa com alteração confirmada.

## Etapas

- [x] Revalidar proposta, aplicação alvo e fluxos existentes do construtor.
- [ ] Completar fontes descendentes e inventários separados de consultas e regras, com referências de linha.
- [ ] Obter dicionários reais e relacionamentos necessários; chaves, tipos, escala, triggers e índices.
- [x] Extensão genérica TDD do Builder para abas/formulário contextual; validar erros, estado vazio e compatibilidade antiga.
- [x] APIs de leitura de contexto e filhas: read/get fechados, campos tipados, vínculo fixo e testes temp-table nas duas culturas.
- [x] Metadados do painel/filhas e link Painel na consulta, códigos livres verificados no bootstrap.
- [x] Compilar12.2, publicar lote pertinente e validar consultas reais sem negócio escrito.
- [x] Portar cálculos de resumo, custos/comparativos e rastro com casos de referência rastreáveis; expor resultados estruturados.
- [ ] Portar regras de manutenção do cabeçalho/filhos em serviços transacionais com snapshots/logs; cobrir rollback/concorrência.
- [ ] Integrar comandos de impostos/custos/associações/versões no mecanismo nativo de processo, execução explícita e contexto fixo.
- [ ] Integrar anexos com arquivos autenticados e metadados; preservar acesso ao acervo e validar limites/vínculo.
- [ ] Executar verificações de API, UI nativa, regressões, integridade e revisão de código; corrigir os achados.
- [ ] Registrar publicação/evidências e memória com estado preciso de cada programa, incluindo pendências reais se houver impedimento externo.

## Progresso verificado após retomada16/10

NAT-OPERACAO-IMP corrigido/publicado; painel1.0.3 com11abas readonly e quatro recursos de custos calculáveis. Histórico nullable corrigido sem alterar fórmulas. Lote coerente12.2:52fontes,24suites,1962checks/cultura; PASOE27custos,25financeiro e PHP11telas. Nenhuma escrita de negócio/consumo de sequência. Fonte e metadados de leitura sincronizados para canônicos. Revisão independente do delta NAT/nullable/metadados/publicação não encontrou critical/important.

Etapas de escrita/processos/anexos permanecem abertas. Serviços privados preparados (incluindo fechamento e driver de versões) passaram no12.2, mas ainda não equivalem a integração pública/auditoriaPHP validada. Próxima integração: política privada do cabeçalho, wrappers filhos/processos, importação fechada de auditoria e fechamento. Ver context/RETOMADA_2026-10-16.md para manifests ativos; não reutilizar .r antigos.
