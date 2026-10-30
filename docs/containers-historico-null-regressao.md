# Regressão: histórico unitário sem custo realizado

Corrigida em16/10/2026, somente no coletor e nos testes. Sem publicação ou escrita em banco real. A alteração preserva a correção NAT já recebida do responsável e não altera fórmulas, VersionService, distribuição, fiscal, fechamento ou includes.

Falha reproduzida em OpenEdge12.8, culturas AMERICAN/EUROPEAN: o segundo snapshot da composição consultava o primeiro histórico com `vl_unit_realiz=?`. A serialização de `ContainersCustoReadService.p` chamava o leitor numérico obrigatório `D()` nesse campo opcional, causando `VERSION_HELPER_FAILED: Valor numerico desconhecido: vl_unit_realiz`. A regressão independente em comparativos também falhou antes da correção.

Correção estreita no bloco de anexação de histórico: para `vl_unit_prev` e `vl_unit_realiz`, somente nessa saída histórica, valor físico desconhecido gera JSONnull em `vl_unit_prev_versao` ou `vl_unit_real_versao`; valores conhecidos continuam pelo mesmo `D()` obrigatório. O próprio `D()`, os demais campos e os cálculos não foram relaxados. Não converter custo ausente em zero nem exigir custo realizado em snapshot legitimamente incompleto.

Evidências auxiliares12.8:

- `CompileContainersCustoReadTests.p`: coletor175 checks e núcleo existente87 por cultura. Inclui comparativos com realizado ausente, ambos os campos históricos ausentes, detalhe de comparativo/itens, cálculo atual preservado e erro quando o valor tributado obrigatório atual fica desconhecido.
- `CompileContainersVersionMissingActualTests.p`:7 checks por cultura; integração pelos helpers reais cria exatamente duas versões, conserva `vl_unit_realiz=?` nas duas e mantém o previsto conhecido, sem custo realizado fictício zero.
- Logs em `.runtime/container-custo-read-local/` e `.runtime/container-version-missing-actual-local/`. Manifesto em `.runtime/container-history-null-regression-manifest.json`.

A compilação12.2 e publicação PASOE ficam com o responsável; os resultados acima não são validação do runtime publicado.
