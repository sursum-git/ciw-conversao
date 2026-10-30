# Preflight1042 — somente configuração e metadados

`ExpenseBatch1042ReadOnlyPreflight.p` não recebe parâmetros. Requer conexão `espec` readonly fornecida pelo root; não conecta bancos. Lê empresas MED, despesas, vínculos da empresa, bases fiscais e relações calculadas por consultas fixas NO-LOCK, além do dicionário de triggers das três tabelas de cleanup. Lê somente o parâmetro IMA `despesa_distr_custo` pela include canônica, diretamente/sem cache. Não lê containers, despesas operacionais, itens, títulos, usuários ou credenciais.

Gera `expense-batch-preflight.json` no diretório de execução escolhido pelo root. Retorna snapshots de configuração sanitizáveis, candidatos distintos seguros para DUAS definições manuais não bases, cardinalidades máximas e SEARCH de `estrg\tdpp001.p/r`/variante portable, além das dependências de limpeza. Máximo50mil linhas/10s; candidatos acima200 recusados sem truncamento.

Não executa escritor, trigger, sequência, DDL, SQL livre, CONNECT ou grants. `zero_fiscal_proven=false` e `cleanup_proven=false` são deliberados: root precisa reproduzir configuração em TT pelo planner central, confirmar ausência de ciclos/ambiguidade e cardinalidade≤20; e auditar a closure do trigger existente. SEARCH não prova que exclusão funciona. Se tdpp001 estiver ausente, manter o trigger e bloquear criação de fixture; não desabilitar/bypassar.

O teste local somente compila12.8 com include IMA substituída por TT no harness e verifica NUM-DBS=0/recusa sem conexão. Não é execução do probe em banco real nem compilação oficial. Root compila12.2/.42 e executa separado com espec readonly. O programa/include devem ser copiados ao pacote de execução, nunca ao PASOE.
