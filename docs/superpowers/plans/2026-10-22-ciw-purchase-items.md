# Conversão dos itens dos processos de compra

Continuação autorizada pelo usuário em 22/10/2026. Reutilizar o construtor por JSON e as rotinas Progress existentes. Não alterar bibliotecas Kendo, autenticação ou instância. Schema limitado à sequência dedicada aprovada posteriormente pelo usuário, sem mudanças nas tabelas existentes. Preservar fontes e recibos de entregas anteriores.

1. Conferir fontes publicados de `grid_itens_proc_compra` e `form_itens_proc_compra`, schema e dependências. Fixar contrato contextual MED, incluindo 46 campos físicos, versão do registro e quantidades alocada/saldo calculadas.
2. Implementar ABL em candidato isolado, com testes TT. Usar o financeiro compartilhado para diferenças de obrigação tipo 3 e rateio tipo 4, sem reconstrução destrutiva do histórico. Atualizar containers vinculados pelas rotinas fiscais/financeiras existentes. Bloquear exclusão com alocações e redução abaixo do alocado. Auditar todas as imagens e efeitos na mesma transação.
3. Integrar PHP com validação fechada, usuário da sessão e importação das imagens completas. Criar metadados nativos da consulta/formulário contextual e acesso na aba Itens do processo; preservar pagamentos e demais abas.
4. Revisar, compilar no OpenEdge 12.2/.42, testar regressões/culturas, integrar candidatos com guardas de hash e publicar no compartilhamento .137. Validar PASOE sursum-api/med e navegação nativa.
5. Solicitar cenário operacional novo e delimitado somente quando o pacote estiver concreto e pronto. Executar apenas após autorização, remover dados de teste e conferir títulos originais. Atualizar quatro memórias e inventário com o estado real.

## Contrato inicial

- Recurso: `proc_compra_itens`; entidade `proc_compra_itens_progress`; tela `ciw.proc-compra-itens`, programa candidato `op1014` (confirmar disponibilidade).
- Rota existente `/SursumPrograms/ciw-cadastros`, operações read/get/create/update/delete. `proc_compra_id` obrigatório na raiz, validado contra processo MED, nunca mutável em `values`.
- ID inteiro gerado no servidor; update/delete exigem `id` e `row_stamp` da leitura. Campos desconhecidos recusados. Escritas apenas nos campos físicos editáveis; projeções não são persistidas.
- Imagens de auditoria do item: todos os 46 campos físicos. Resposta de leitura: mesmos campos + `row_stamp`, `qt_alocada`, `qt_saldo`, `calc_gm` (50). Autor somente confiável da sessão PHP/identidade Progress. Efeitos com recurso/tipo/owner reais e origem do item/processo distintas.
- As datas são datas civis ISO; `dt_item_certificacao` é DATE. Inteiros usam n0/decimals0. `calc_gm` é apenas apresentação se suportada pelo frontend nativo.
- Exclusão proibida se existir qualquer `itens_container`, mesmo com quantidade zero. Redução da compra proibida abaixo da soma alocada. Pai/contexto MED obrigatório em todas as operações.
- `localDescItem` é vazio nos fontes analisados; não inventar preenchimento ERP. `validarItemMesmoCodigoPrecoDif` não tem chamada ativa comprovada; não criar regra nova por existir helper.
- Manter eventos de datas dos inputs de produção/SO-LD usando suporte nativo existente ou normalização servidor limitada às mudanças dos respectivos inputs; não sobrescrever ajustes manuais incondicionalmente.

## Execução e revisão

Candidatos: `integration-src/purchase-items/`. Recibos privados novos: `.runtime/purchase-items-20261022/`. Não reexecutar testes anteriores encerrados. Implementação delegada sequencial, conforme skill subagent-driven-development; controller confere contratos, empacota e publica. Nenhum commit/push/reset/reseed. Como este workspace não é checkout Git e os canônicos possuem mudanças existentes, isolamento por candidatos e manifesto/hash substitui worktree/commits nesta entrega.

## Checkpoint de publicação22/10

Etapas1–5 concluídas. Canônicos integrados,17artefatos oficiais12.2 publicados e MED recarregado. Filho op1014/1.0.0 e pai cd0108/1.0.2 publicados; payload nativo e filtro Logs Exclusão corrigidos e revisados. PHP695testes/4696asserções; ABL371checks por combinação em4culturas/codepages; interface nativa e acesso específico autorizados/conferidos. Cenário novo SC_TEST_PROC_ITENS_20261022 executou16etapas, preservou49logs com usuário/imagens e terminou com leitura física oficial comprovando zero registros próprios e dois títulos inalterados. Limpeza exata dos9movimentos zerados restantes concluída, gates encerrados. Quatro memórias registram o estado final. Não repetir cenários concluídos; amostras separadas, Anexos e outras origens continuam fora desta entrega.
