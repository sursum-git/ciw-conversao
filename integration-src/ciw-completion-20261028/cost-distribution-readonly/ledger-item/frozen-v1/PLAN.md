# op1050 — conta corrente de distribuição do item

Reserva1050 confirmada pelo gerente/root. Somente consulta contextual da origem cons_cta_corren_distr_item_container: oito campos físicos selecionados, WHERE item_container_id=item_container_corrente, sem tipo de movimento restritivo e sem join de existência com item. O simulador envia esse contexto no botão SC_btn1; não duplicar simulador ou qualquer writer. Despesa_container_id é campo físico adicional não selecionado e fica fora.

TDD: projetar o ledger tipado por owner, sem cálculo; confirmar NULL/sinal/data/PK/isolamento/limites; reader central faz filtro/ordem/página/get. API com buffer fixo espec.cta_corren_custo_distr; serviço recebe owner positivo inteiro e rejeita campos extras. Chave JSON inclui owner+PK física. Contexto diferente não pode recuperar GET. Coletor com orçamento50mil/10s compartilhado, nenhum dado parcial em erro.

Separado do produto1049 e seu freeze; preparar metadados nativos JSON e propostas aditivas por baseline atual somente depois dos testes. Root compila12.2 e valida mesma MED. Sem DDL, writer, grants ou rede. Não alterar saldo/custo/versões centrais nem fabricar link do simulador publicado sem export real e prova contextual.
