# Comparação de desempenho do painel IOL —17/10/2026

> **Correção posterior da identidade:** a conferência da auditoria durante a otimização identificou que a sessão local do navegador estava como **admin**. A confirmação textual anterior do login não bastou para comprovar tasilpar no construtor. Por isso, os números deste relatório ficam como histórico do ambiente e **não devem ser usados como comparação autenticada entre tasilpar nos dois sistemas**. O pedido atual exige nova série com identidade confirmada no servidor. As medições diretas do PASOE usam explicitamente tasilpar pelo gateway e continuam identificadas como ensaios separados de serviço.

**Resultado observado:** para `tasilpar`, o PHP original recebeu os indicadores em mediana de **2,304s** e o painel convertido em **3,447s**. O convertido levou **49,6% mais tempo**, diferença de **1,143s**. Isso descreve estas instalações e caminhos de rede; não demonstra que uma linguagem seja mais rápida que outra.

## Método

- Usuário fez login como `tasilpar` nos dois sistemas. No legado, o menu identificou TASILPAR e o painel passou a apresentar dados sem os warnings da abertura anônima. A senha não foi solicitada no chat nem copiada para o benchmark. O construtor agora usa a senha real pelo provedor ima-user-web; a credencial temporária histórica não autentica mais essa conta.
- Mesmo navegador Chrome155/Windows e viewport1102×836. Página legada direta `https://imaonline.imatextil.com.br/iol/bl_pag_ini_ger/`, excluindo o menu. Nova página `http://127.0.0.1:8765/production/app.html?screenId=iol.inicial-gerencial`, versão1.0.2.
-2rodadas de aquecimento descartadas e **12recargas medidas por painel**, alternando qual sistema é medido primeiro. Sem requisições concorrentes de carga. Cache HTTP padrão do navegador, sem limpar caches do banco, alterar parâmetros ou reiniciar processos.
- Tempos obtidos das APIs Navigation/Resource Timing do navegador por CDP. **Indicadores recebidos**: `responseEnd` do HTML no PHP, pois o servidor entrega os dados nele; `responseEnd` da última consulta `analytics.query.run` no convertido. O DOM do novo painel foi conferido com render gate pronto. Isso não mede o instante exato da pintura final dos pixels.
- `load` e DOMContentLoaded, isoladamente, não representam dados prontos em uma página assíncrona. FCP não ficou disponível de forma consistente e foi excluído. Não houve medição de CPU/memória do servidor, plano de execução ou concorrência multiusuário.
-p95 é o percentil empírico dessas12amostras e coincide com a maior amostra; não é uma estimativa robusta de SLA.

## Tempos do navegador

| Métrica | PHP original | Construtor + PHP + PASOE |
|---|---:|---:|
| Indicadores recebidos — mediana |2,304s |3,447s |
| Indicadores recebidos —p95 |2,419s |3,692s |
| Faixa observada |2,207–2,419s |3,389–3,692s |
| TTFB do documento — mediana |2,261s |0,00085s |
| DOMContentLoaded — mediana |2,342s |0,301s |
| Evento load — mediana |2,342s |0,302s |
| Entradas de requisição por recarga |3 |46 |

O HTML estático do construtor chega quase imediatamente por loopback. Esse TTFB pequeno não é vantagem no tempo dos indicadores: o trabalho comercial ocorre depois, nas APIs.

Decomposição observada no convertido:

| Etapa | Mediana |
|---|---:|
| Navegação até início das consultas comerciais |0,964s |
| Primeira consulta — duração desde o disparo |1,243s |
| Segunda consulta — duração desde o disparo |2,495s |
| Janela das duas consultas, disparadas praticamente juntas |2,495s |

As medianas são calculadas independentemente; não se deve exigir que sua soma seja idêntica à mediana total.

## Medição separada do motor PASOE

Outra série teve2aquecimentos e12pares sequenciais, chamando `resumo` e `vendedores` com o token privado da integração e identidade `tasilpar`, resolvida de verdade em user-web. Esse teste usa a fronteira de serviço existente; não é um login de navegador e não substitui a série completa acima. Evidência guarda apenas tempos e quantidades.

| Operação | Mediana |p95 |
|---|---:|---:|
| Resumo |0,796s |0,880s |
| Vendedores |0,799s |0,911s |
| Par sequencial |1,634s |1,743s |

Inclui HTTP/túnelSSH/PASOE/bancos; exclui gatewayPHP local, autenticação de navegador, governança runtime, arquivos estáticos e renderização. Não subtrair essas medianas das medianas de outra série para alegar um custo exato de PHP ou banco. Elas mostram que o motor responde em aproximadamente0,8s por recurso nas condições medidas.

## Principais causas e prioridades

1. **Coleta comercial repetida duas vezes.** `AnalyticsEngine.runDashboardQuery` dispara os dois datasets; em `IolInicialGerencial.p`, tanto `resumo` quanto `vendedores` executam IdentityService, Collector completo e Calculator completo antes de selecionar o array de resposta. O PHP original calcula ambos dentro de uma única abertura. Prioridade: produzir um único resultado coerente por atualização e distribuir seus dois conjuntos, sem cache comercial compartilhado entre usuários e sem repetir fórmulas. É uma proposta; não foi implementada nesta análise.
2. **Fila no caminhoPHP local.** As duas chamadas começam praticamente juntas; a primeira termina em cerca de1,24s e a segunda em2,49s. O harness está configurado com `php -S`; o padrão observado é compatível com atendimento serial no servidor local. Não atribuir todo esse intervalo ao ABL. Validar uma hospedagem PHP com workers apropriados e repetir o mesmo ensaio antes de dimensionar produção. Uma requisição única também reduziria essa dependência.
3. **Preparação anterior às consultas: cerca de0,96s.** Inclui carregamento/execução do frontend e chamadas de configuração, sessão, literais e definição. Vale rastrear quais chamadas precisam estar no caminho crítico. O benchmark não isolou o tempo de cada validação de segurança; não se recomenda removê-las para ganhar tempo.
4. **Arquivos estáticos pesados.** No local, Resource Timing contabilizou cerca de **9,01MB por recarga**. Kendo all representou6,16MB; Material0,97MB; o tema inicial default-urban0,78MB também foi transferido antes da troca para MaterialIMA. Priorizar cache/revalidação e compressão na hospedagem e evitar carregar um tema inicial que será substituído. Não editar as bibliotecas Kendo. Esses arquivos foram rápidos em loopback; em acesso remoto o custo pode aumentar. O benefício real precisa de nova medição.

O legado registrou4,88KB transferidos pelo documento e recursos expostos ao Resource Timing, com HTML comprimido de4,58KB. Seus recursos de terceiros apareceram com transferência0/cache e podem ter informações de timing limitadas. Por isso, esses totais não provam que seu custo inicial sem cache seja de apenas4,88KB.

## Equivalência e limites da conclusão

Na inspeção autenticada, faturamento/meta mensal, seis vendedores,7pedidos em avaliação e698pedidos abertos estavam de acordo entre os painéis. Valores foram observados apenas para conferir escopo; os arquivos de benchmark não contêm snapshots comerciais.

**Divergência encontrada:** o indicador Ideal da loja apareceu como **0% no PHP e52% no convertido**. Isso precisa de análise funcional própria antes de afirmar paridade integral. Não foi corrigido ou normalizado durante o ensaio. O bloco de metas é inicialmente recolhido no legado e aberto no convertido; os dados já estão no HTML legado, portanto essa diferença visual não elimina seu cálculo da medição.

O legado é servido por HTTPS remoto. O novo usa frontend/backend locais e alcança PASOE pelo túnelSSH. A medição é útil para a experiência atual, mas mistura arquitetura, implantação e rede. Não é um teste isolado de PHP contra Progress, nem uma previsão de desempenho multiusuário.

**Próxima melhoria de maior impacto provável:** remover o trabalho duplicado por atualização e repetir esta mesma bateria; depois medir cache/entrega dos estáticos e uma implantação PHP com concorrência apropriada. Nenhum ganho futuro em segundos ou percentual está garantido por esta medição.

## Evidências e reprodução

- `.runtime/iol-gerencial/benchmark-browser-20261017.json`:28observações, sendo24válidas, ambiente e tamanhos de recursos sem dados comerciais.
- `.runtime/iol-gerencial/benchmark-summary-20261017.json`: estatísticas calculadas.
- `.runtime/iol-gerencial/benchmark-pasoe-20261017.json`: medição de serviço separada.
- `tools/construtor-local/benchmark-iol-api.cjs --pasoe-only`: ensaio da fronteira readonly. O modo login antigo não pode ser usado com a senha temporária após a troca de provedor; ele falhou antes de medir e não entra nos resultados.

A coleta no navegador usou apenas recargas, leitura de timings e abertura visual das metas. Não houve alteração em produto, autenticação, negócios, publicação, cache de parâmetros ou configurações de produção. O método de injeção de script no início da navegação não era suportado e não foi aplicado; a conclusão usa somente timings nativos disponíveis, sem cronometrar latência das ferramentas.
