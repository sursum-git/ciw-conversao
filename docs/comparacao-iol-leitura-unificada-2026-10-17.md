# Comparação IOL após leitura unificada — 17/10/2026

Publicado e validado: resumo e vendedores passam por uma chamada do navegador e uma execução comercial no PASOE. Ambos os painéis foram medidos com **tasilpar**. O resultado atual é empate prático na mediana; o PHP apresentou menor variação.

| Dados recebidos desde a navegação | PHP original | Construtor + Progress unificado |
| --- | ---: | ---: |
| Mediana | 2,314 s | 2,313 s |
| P95 | 2,475 s | 2,730 s |
| Mínimo | 2,200 s | 2,221 s |
| Máximo | 2,475 s | 2,730 s |

A diferença de mediana é de apenas 1,75 ms (0,08%), insuficiente para afirmar vantagem. No P95 o novo painel foi aproximadamente 10,3% mais lento. Com 12 amostras, o P95 coincide com o máximo observado; não representa SLA nem teste de carga.

## Método e identidade

Mesmo navegador, cache padrão, dois aquecimentos e 12 recargas válidas por painel, alternando a ordem. PHP: HTTPS remoto original; novo: servidor local e integração PASOE existente. Não é comparação isolada de CPU ou de linguagens. Medição final registrada aproximadamente às 18h53, horário de Brasília.

Identidade original confirmada no menu autenticado como TASILPAR. No construtor, auditoria do servidor confirmou tasilpar antes do ensaio (transação 7804) e foi novamente verificada após as amostras. Nenhuma impersonação. Credenciais não fazem parte das evidências.

Dados recebidos significa fim da resposta HTML no PHP, que já contém os indicadores, e fim da chamada analytics.query.run no novo painel. O DOM da página nova aparece antes dos dados: load mediano 0,307 s; esse número isolado não representa painel carregado. O ensaio aguardou também a lista de vendedores renderizada. A meta original permanece recolhida por padrão, mas seus dados já vêm no HTML.

## Mudança entregue

AnalyticsEngine envia datasetIds no endpoint existente. O backend valida todos os datasets e permissões antes da primeira leitura. As duas projeções usam o mesmo read/painel; respostas idênticas são compartilhadas apenas dentro da requisição autenticada, com descarte em finally. Não há cache entre atualizações, usuários ou de parâmetros IMA.

ABL coleta e calcula uma vez, devolvendo data.resumo e data.vendedores. Recursos antigos continuam compatíveis. Compilado em OpenEdge 12.2 no .42 e publicado em sursum-api/med, lote iol-gerencial-20261017-v4. Fonte e entidades atualizadas pelo Builder oficial; tela op1012 permanece na versão 1.0.2.

Todas as 12 amostras novas fizeram exatamente uma analytics.query.run. Auditoria confirmou uma api.progress.execution e uma projeção por entidade. Na página nova, preparo até a chamada mediano 0,964 s e duração mediana da chamada agrupada 1,348 s. Esses componentes mostram que ainda existe tempo fora da coleta Progress. Não foram alterados assets/hospedagem: 45 recursos e aproximadamente 9,02 MB transferidos no novo painel neste ensaio, contra três recursos e 4,9 KB no original com o cache observado.

Medição direta separada do serviço agrupado: mediana 0,901 s e P95 1,005 s, 12 chamadas após aquecimento. Não equivale ao tempo de tela completa.

## Validação e limites

Suíte PHP final: 510 testes e 2991 asserções passaram; smoke frontend passou. Compilação/testes ABL 12.2, validação PASOE real e revisão independente concluídos. Meta aberta, fontes menores, tema vermelho e iniciais dos vendedores preservados. Nenhuma escrita de negócio realizada.

A comparação anterior de navegador foi invalidada como ensaio de mesmo usuário: a auditoria revelou admin no construtor. Portanto, não usamos seus 3,447 s para calcular melhoria percentual como tasilpar. O relatório anterior conserva aviso de correção.

Permanece a divergência funcional já observada: Ideal Loja 0% no PHP e 52% no novo. Fórmulas não foram alteradas nesta otimização; paridade integral continua pendente de análise própria.

Evidências privadas em .runtime/iol-gerencial: benchmark-browser-grouped-20261017.json (28 observações, quatro aquecimentos excluídos das estatísticas), benchmark-summary-grouped-20261017.json e single-execution-verification.json. Manifesto de publicação publish/active-manifest-v4.json. Sem dados comerciais ou credenciais no arquivo de métricas.
