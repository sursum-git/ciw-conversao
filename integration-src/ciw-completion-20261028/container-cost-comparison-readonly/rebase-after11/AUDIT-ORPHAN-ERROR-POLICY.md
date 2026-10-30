# Auditoria de políticas1040/41 — rebase11

Nenhuma fórmula, writer ou collector central foi alterado. O snapshot1649 permanece imutável. Os cinco candidatos compartilham somente os deltas1040/41 sobre as fontes11 e preservam despesa/imposto1055. A próxima integração depende de composição posterior com os hashes efetivos12.

## Master órfão — lacuna confirmada, decisão pendente

O SQL fonte junta versão/itens persistidos com itens atuais e compra; não consulta `pp-container`. `ContainersVersionComparisonService.p` exige master antes de chamar `ContainersVersionService.consultar`, que também o exige. Assim, versão+itens ainda existentes com master apagado retornam404 no candidato, embora os joins fonte possam gerar linhas. Não há master sintético nem cópia de coleta para contornar a regra.

O teste ComparisonServiceTest passou de19 para21 verificações: comprova a versão persistida ainda existente, recria o join atual, apaga somente o master TT e observa404. As quatro combinações de codepage/cultura reproduzem o gate, sem banco. Isso não é prova de inexistência de órfãos físicos e não autoriza excluir esses registros silenciosamente.

Proposta mínima para revisão separada, NÃO implementada: política privada `read_require_master` BOOLEAN, defaultTRUE, lida apenas no ramo consultar de versão selecionada. O wrapper1040/41 poderia fornecerFALSE por código fixo, mantendo o pedido HTTP fechado, FindVersion por versão+container, a captura comum e todos os writers/consultas antigas no defaultTRUE. Seria necessário remover a prechecagem redundante somente deste wrapper, recalcular os offsets do orçamento conjunto e acrescentar testes de antigo/novo/orphan/missing version/cross-container/DBerror. Mudaria um serviço central compartilhado: precisa revisão/coerência de publicação e regressão189 do writer; não foi inserido por este rebase.

Alternativa é extrair a captura comum em seam interna readonly. É maior e não justifica duplicar a coleta. A política não pode ser exposta como campo arbitrário de payload nem relaxar os outros endpoints.

## Projeção com erro — contrato atual

Um único projector readonly consome os valores persistidos para BRL/USD. NULL bruto continua NULL; os vetores SQL constantes/derived e a metadata física sustentam os casos e escalas observados. Não se aplica regra genérica de que todo zero falha. Nenhum fetchODBC textual0 foi reinterpretado como zero quando o nullflag indicaNULL.

O materializer guarda erro interno em placeholder, mantendo identidade/operandos físicos; não transforma erro financeiro em um NULL bem-sucedido. O reader identifica placeholders antes dos filtros e recusa filtro derivado se existir algum, com `COMPARISON_DERIVED_FILTER_UNPROVEN`503. Após aplicar filtros físicos, qualquer erro remanescente recusa o resultado inteiro antes de ordenação/página: divisor0 comprovado422, configuração503. Portanto take/skip não escondem erro fora da página. O campo privado não é projetado ao cliente.

ComparisonReaderTest13 cobre esse fecho; ComparisonProjectionTest26 e ComparisonSqlObservedTest274 por combinação cobrem NULL/zero/escalas. A ordem de avaliação de colunas físicas pelo otimizador e limites de overflow/ties não foi provada com dados empresariais. SELECTs derivados sintéticos e SQLDescribeCol não substituem essa prova; o gate fica explícito.

## Demais provas e gates

Diagnóstico12.8:18 programas únicos compilados sem DB (8 preflight +18 execuções de closure);19 suítes/923 verificações por combinação,3692/76 logs no total. FULLPHP1001/7807;414 fontes staged e nenhum App fora do stage. Native Builder205e/registry/AJV/validator/FilterRenderer: ambas as moedas têm12 filtros decimal/eq. O Builder205e é dependência privada de teste e ainda requer integração por sua release própria antes da metadata. Nenhum canônico Builder72c6 foi escrito.

Preparo oficial offline separado `official-build13-preparation`:39 compiles propostos,19 suítes,76 logs esperados; source baseline11 retido para compose-after12. Nenhum SSH, AVM12.2, API, SQL, negócio, grant ou catálogo executado. Metadados são quatro operações aditivas sobre export146 como proposta, e dois links apenas após export fresco do paiop1005/owner nativo; autenticação real deverá ser preservada em memória pelo publisher futuro.
