# Revisão do pacote

## Conclusão

Não existe comando de envio em lote implementado na origem sanitizada examinada. A única transição de negócio comprovada é data de sessão → consulta EMS5. A consulta existente `cd0102` é reutilizável; o writer contextual `op1018` não é continuação comprovada e consulta representantes EMS2.

## Riscos que impedem uma declaração ampla de conversão

1. Associar `cdn_repres` de EMS5 a `cod_rep` de EMS2 inventaria identidade entre cadastros.
2. Declarar `cons_procs_compra` integralmente equivalente ao pai MED ocultaria o escopo multiempresa do legado.
3. A lacuna dos corpos dos dois blanks de pagamentos foi resolvida pela coleta do root. A leitura comprova pontes de navegação sem escrita invocada; a reconciliação proposta limita a cobertura ao fluxo MED existente e explicita as diferenças dos conjuntos consultados.
4. Repetir a alocação `op1025` ou os pagamentos `op1013` reabriria entregas concluídas e cenários já limpos.
5. Portar a exclusão da variante `form_proc_compra` copiaria um predicado de dependência não equivalente ao relacionamento processo/item.

## Validação realizada

Leitura de fontes sanitizadas, assinaturas SHA256, contexto prevalente e metadados canônicos. A coleta inclui trechos mínimos com numeração de linhas, estados históricos específicos e comparação dos sete campos da consulta com o cadastro MED. Não foi executado PHP legado nem código de produção; não há teste comportamental novo por não haver implementação funcional.

`collect-evidence.ps1` pode ser reexecutado: verifica os trechos esperados, hashes das cópias de `purchase-pending` contra seu manifesto de coleta e campos dos metadados. Ele grava apenas dentro deste diretório. O resultado é prova de análise, não teste de paridade operacional nem compilação OpenEdge.

## Integração recomendada

Integrar apenas a reconciliação de estados já comprovados e as referências documentais. Manter ausência de comando do controlador explicitamente registrada. Reutilizar as páginas já publicadas para navegação MED; não criar um formulário que prometa registrar envios. A cobertura das duas pontes de pagamentos foi verificada pelas quatro fontes novas; o eventual escopo além de MED e a igualdade exata de seus filtros legados não são afirmados. Nenhuma autorização para ampliar empresa ou refazer negócio decorre desta análise.
