# Proposta concreta de validação real do lote1042

**SUPERSEDIDO em28/10:** a proposta concreta com CID2147000110, defs4/5, replay CENTRAL TT150×4 e a closure MED atual verificada está em `integration-src/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config/REAL-1042-PROPOSAL.md`. O gate histórico de trigger possivelmente ausente abaixo não prevalece; root comprovou oito hashes e dois aliases atuais, sem alterar/desabilitar o trigger. Payloads privados e hash autorizável são referenciados no novo manifesto. Este registro permanece apenas como histórico da proposta anterior.

Estado: **somente proposta, sem escrita ou concessão executada**. Preparada a pedido do root enquanto1047 continua ativo. O freeze1042 SHA75b0f1351d95e648516ffccdd9c4d85bb1cf20a22e3b966783aea4ab323ff8f5 permanece imutável.

**Gate de limpeza prevalente:** o trigger legado `estrg\tdpp001.p/r` pode estar ausente no ambiente. A determinação humana é mantê-lo. Não prometer a limpeza nem criar a fixture antes de comprovar SEARCH/registro no dicionário e sua closure; não desabilitar, substituir ou contornar o trigger. O pacote isolado `container-expense-batch-preflight` prepara somente a coleta readonly dessa evidência. Mesmo SEARCH positivo não comprova que a cascata executará com sucesso.

## Fixture única e limites

Criar UM container MED novo por API canônica de cabeçalho, com número manual previamente reservado e inexistente, e marca única `CIW-1042-VALIDACAO-<UTC>` em narrativa/identificação textual. O número e todos os valores exigidos pelo contrato só serão preenchidos depois do preflight readonly do root. Não copiar filhos ou documentos de um container comercial. Dados cadastrais de empresa/estabelecimento/fornecedor são somente referências existentes validadas; nenhum cadastro será alterado.

Criar exatamente DUAS despesas gerais manuais novas nesse container, com duas definições existentes distintas, ativas, não tributárias, não calculadas, sem percentual, sem distribuição, sem custo não recuperável e não usadas como base de nenhum imposto/calculada. A e B devem ter `item_container_id=0`, `log_manual=true`, `vl_base_imp=0`, sem movimentos contábeis. Valores iniciais previstos: A=1,00 e B=2,00. Usar as APIs canônicas de manutenção individual para preparar a fixture; não alterar/contornar regras para facilitar o teste.

O container terá ZERO itens/alocações, custos/versões, documentos/NFs, pagamentos/títulos, anexos, permissões/saldos de representantes, descontos e movimentos financeiros/comerciais. Cotação/configuração interna deve ser válida segundo o coletor existente. Não inserir item fictício para ultrapassar validação fiscal; se o core recusar container vazio, o cenário fica bloqueado e exige nova proposta.

Cap de segurança para esta proposta: até20despesas fiscais/não recuperáveis geradas pela configuração existente, além de A/B; até22despesas físicas no container; até4memórias de cálculo durante toda a prova; até22novos IDs de despesa. Sem alteração de fórmula, definição, vínculo da empresa ou parâmetros IMA. Se o preflight/planejamento revelar cardinalidade maior, interromper antes da primeira escrita e rever a proposta. Os campos previstos de A/B não ultrapassam3,00; despesas fiscais devem resultar em0, porque não há itens nem A/B nas bases fiscais. Essa expectativa precisa ser demonstrada antes da autorização.

Não restaurar/retroceder sequências. Gaps de sequências usados pela prova são efeitos técnicos possíveis e devem constar do recibo; a limpeza remove registros da fixture, preservando as trilhas de auditoria.

## Preflight readonly obrigatório do root

1. Confirmar programa1042, versão assinada, fonte/rota fixa, sessão MED, compilação/publicação oficial e conexão correta. Não repetir grants anteriores da wave1.
2. Escolher/reservar `container_id` manual novo; GET/consulta física comprovam ausência. Preencher marca, estabelecimento MED real, fornecedor e todos os valores obrigatórios do cabeçalho no payload proposto.
3. Escolher os DOIS IDs existentes de definição A/B. Conferir dados físicos, vínculo ativo/empresa MED, `log_imposto=0`, `log_calculada=false`, percentuais zero, ausência de bases/relacionamentos e exclusão de parâmetros/contas de distribuição. Não presumir que nomes ou IDs usados em TT existem no banco.
4. Ler configuração fiscal completa usada pelo coletor, cotação e parâmetros IMA diretamente; calcular a cardinalidade máxima, confirmar ausência de ciclo/denominador inválido e apresentar por TT/planejador os efeitos fiscais esperados0. A prova deve mostrar os limites acima, sem executar o escritor real.
5. Conferir cleanup canônico: `ContainersCabecalhoRules.BeforeDelete` bloqueia dependências comerciais/pagamentos/custos e planeja exclusão de despesas/memórias pelo container (fontes atuais PlanDelete despesas/calcs). Confirmar exatamente as dependências vazias da fixture e o caminho autenticado de exclusão. Nunca substituir falha de limpeza por DELETE SQL ou varredura de registros semelhantes.
6. Produzir recibo fechado com ID/marker, payloads concretos de criação e lote, IDs A/B, pré-condições, allowlist de tabelas/chaves, cardinalidades máximas e payload de limpeza. Hash desse recibo deve ser o objeto de autorização humana. **Este documento com IDs ainda pendentes não autoriza executar a prova nem pedir uma aprovação genérica.**

## Permissões mínimas a conferir

Para o operador LDAP real, somente as ausentes entre `container_despesas_lote_progress.read`, `.edit` e `.delete`, no contexto1042. Sem `.create`, `.process`, acesso administrativo ou permissões de outros programas. Leitura existente do pai e acesso nativo de Logs por registro precisam ser conferidos; se faltarem, listar separadamente o privilégio exato e a razão, sem ampliar automaticamente.

Criação e limpeza da fixture serão executadas por identidade já autorizada nas APIs de manutenção correspondentes, com autoria real e auditoria. Não conceder poderes extras ao operador para montar/remover a fixture. Grants, quando necessários, só depois de autorização humana específica e registrada; nada desta proposta os aplica.

## Sequência da prova após autorização concreta

1. Criar cabeçalho marcado e A/B. Registrar IDs retornados e imagens14campos, mestre completo e filhos fiscais. Verificar que somente o novo container recebeu efeitos e que cada callback fiscal permaneceu nos limites. A preparação pode gerar uma memória por inclusão individual: até2.
2. Abrir1042 como operador real no contexto da fixture. Conferir somente3editáveis, PK/definição readonly, snapshots14 e contexto. Editar A para1,01 e B para2,02. Cancelar primeiro e comprovar ZEROrequisições/mutações. Editar novamente e salvar UM lote homogêneo update: duas linhas, uma transação, uma sincronização fiscal/memória, sem despesas calculadas e sem efeitos financeiros. Confirmar autoria LDAP e imagens completas em Logs.
3. Negativa de stale: carregar os originais de A/B, editar A localmente sem salvar. Pela manutenção canônica já autorizada, alterar B de2,02 para2,03 (até1memória adicional, totalmáximo4). Submeter o lote com primeira linha válida e segunda obsoleta. Esperar409 e ZEROmutação de A, ZEROmemória/ID/callback do lote recusado e nenhuma auditoria confirmada desse lote. Conferir B somente com a alteração concorrente registrada. Recarregar e descartar o rascunho; não insistir/repetir uma confirmação ambígua.
4. Negativas de contrato usam exclusivamente a fixture: PK/definição imutáveis, original incompleto e lote misto devem ser recusados antes de efeitos. Não usar IDs comerciais para testar ownership.
5. Recarregar A/B e excluir AMBAS por UM lote delete. Esperar duas exclusões e somente stale do mestre; contador/memórias fiscais inalterados. Conferir Logs com usuário/before-after e ausência de sincronização/calculadas. Sem segundo delete de confirmação.
6. Limpeza pela API canônica de cabeçalho, **somente se o gate prévio de trigger/closure tiver sido comprovado**: verificar marca e allowlist novamente; excluir somente o container novo. O fonte da cascata planeja remover despesas fiscais e memórias; execução real ainda não foi comprovada. GET do container e consultas exatas das chaves devem confirmar ausência de todos os registros criados. Não apagar logs de auditoria, cadastros existentes, registros anteriores ou do usuário.

## Efeitos máximos e parada

Allowlist comercial: UM mestre novo; até22despesas e4memórias novas vinculadas exclusivamente a ele; updates/exclusões apenas dessas chaves; stale/timestamp do próprio mestre. Em um lote update: até1mestre+2selecionadas+1memória+20linhas fiscais, máximo24registros distintos. Em lote delete:1mestre+2selecionadas, sem memória. Nenhuma tabela financeira, item, custo/versão ou configuração pode receber alteração.

Recibos técnicos e auditoria nativa são preservados. Interromper se qualquer efeito exceder allowlist, actor/contexto divergir, commit ficar indeterminado, usuário criar vínculo na fixture, ou limpeza canônica recusar. Não reenviar uma operação possivelmente confirmada. Em limpeza bloqueada, manter os IDs exatos e reportar o motivo ao root; não alterar dependências ou excluir registros por aproximação.

A validação deve terminar com prova de limpeza, comparação das chaves protegidas/preexistentes e recibo dos privilégios efetivamente usados. A criação, os lotes, a alteração concorrente, a exclusão e a limpeza precisam estar TODOS no escopo da autorização concreta; nenhuma dessas ações foi executada aqui.
