# Correções da pesquisa de estoque

Cadastro aprovado: uma palavra digitada, uma palavra para pesquisar e indicador
ativo. As três regras iniciais previstas são CAMBRAYA→CAMBRAIA, CAIMAN→CAYMAN e
ELASTANO→ELAST.. A tabela física é espec.estoque_termo_busca, compartilhada.

## Quando a regra é usada

A BO seleciona os itens normalmente. Se essa primeira seleção produzir algum
candidato, ela segue para os saldos sem ler o cadastro de equivalências. Se não
produzir nenhum, lê as regras ativas NO-LOCK, corrige todas as palavras aplicáveis
de uma só vez e repete apenas a seleção. Não repete quando nada muda.

Exemplo: CAMBRAYA COM ELASTANO vira CAMBRAIA COM ELAST.. Substituição de palavra
completa, sem diferenciar caixa e sem encadear o destino em outra regra. Códigos
numéricos, zeros e curingas existentes são preservados; ponto de abreviação é
literal. Origem e destino exclusivamente numéricos, incluindo notação científica,
são recusados no cadastro.

Filtros de propriedades continuam iguais. Mínimos, referências e outros filtros
de saldo aplicados depois da seleção nunca provocam nova tentativa. O cliente
ABL e POST /SursumPrograms/consulta-estoque usam a mesma BO; a página PHP legada
não é alterada nesta entrega. Não há gravação de pesquisas ou saldos em WP.

## Manutenção

Tela publicada em22/10/2026: iol.estoque-termos-busca, programa cd0190, título Correções da
pesquisa de estoque. Metadados Builder em integration-src/saldo-pv/metadata.
Digitado é imutável depois da inclusão; destino e ativo podem ser alterados.
Cadastro valida palavras únicas, comprimentos50/100, duplicidades e concorrência
por row_stamp. Auditoria inclui as imagens anterior/posterior e usuário da sessão
do backend. Não concede permissões humanas automaticamente.

API administrativa ativa no recurso fechado estoque_termos da rota existente
/SursumPrograms/ciw-cadastros, com autenticação privada já usada pelos cadastros.
Operações read/get/create/update/delete; create recebe digitado, termo_pesquisa e
ativo opcional. Demais operações usam id=termo_digitado; update/delete exigem
row_stamp atual. As respostas de consulta de estoque permanecem inalteradas.

Fonte de configuração exclusiva `motor_progress_estoque_termos`, usando a mesma
API e autenticação dos cadastros. A fonte CIW compartilhada possui operações
contextuais de outros recursos; sua reutilização exigiria campos estranhos a esta
entidade. Os cinco acréscimos iniciais nela foram removidos, preservando todas as
operações anteriores. Não houve mudança no Builder para contornar essa validação.

As três equivalências iniciais estão cadastradas e ativas. Link disponível em
CIW → Cadastros e parâmetros → Correções da pesquisa de estoque. Acesso direto:
`http://127.0.0.1:8765/production/app.html?screenId=iol.estoque-termos-busca`.

Validação oficial12.2:113checksBO,62cliente,52API e23CRUD em cada cultura;
backend662testes/4295asserções;14consultas de estoque no PASOE real com tasilpar.
Houve comparação positiva de duas/três palavras com equivalências temporárias
novas marcadas, depois removidas por imagem exata. Nenhum produto ou saldo foi
alterado. Registro de CRUD também removido; imagens e autoria foram relidas após
cleanup, incluindo Logs do registro e Logs Exclusão com chave textual.

Interface verificada em navegador isolado: grade com as três regras, criação com
Ativo ligado e campo Digitado imutável na edição. Nenhum formulário real foi
salvo nesse teste de interface. Menu assinado preservou permissões humanas.

Estado e evidências: [registro de execução](estoque-termos-execucao.md).
