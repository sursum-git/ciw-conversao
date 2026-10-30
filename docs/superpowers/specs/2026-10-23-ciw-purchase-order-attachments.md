# Anexos do processo de compra MED

Continuar o fluxo já aprovado de conversão por JSON/APIs Progress, agora em `grid_anexos_proc_compra` e `form_anexos_proc_compra`. O menu do processo chama a consulta, que filtra o processo físico e reúne anexos gerais e de itens. Preservar itens e vínculos históricos, sem reparar divergências automaticamente.

Manter frontend, política PDF/imagens/Office/ZIP até20MB, broker e coordenador já existentes. Compartilhar um único writer Progress de anexos entre contexto item e processo. O contexto é escolhido por adaptadores fixos no servidor, nunca por flag livre da requisição. A API antiga mantém suas duas identidades obrigatórias e contratos atuais. Nova API exige somente processo MED; inclusão gera item0 e usa `seq_anexos_proc_compra` existente, sem DDL/reset. Atualização não muda processo nem item. Documentos associados a itens só são acessíveis se o item existir e pertencer ao mesmo processo; vínculos divergentes/órfãos permanecem intocados e não autorizam acessar outro processo.

Uma entidade distinta, `proc_compra_documentos_progress`, com tela `ciw.proc-compra-documentos`, mantém permissões próprias. Adicionar aba Anexos e ação à consulta do processo cd0108, preservando suas abas e telas descendentes atuais. O código operacional será escolhido no catálogo real. Não criar menu/Home paralelo.

Auditoria mantém sete campos físicos e dono real, ator autenticado, data/ref geradas no servidor, stamp e rollback. Os eventos das duas telas de anexos devem aparecer no mesmo registro quando vinculados a item, e ser agregados ao processo/item corretos. Logs Exclusão mostra somente exclusões principais. Escopos SQL continuam fechados e tipados; anexo geral com item0 não deve ser associado a outro item.

Abordagem adotada: ampliar o núcleo reutilizável com adaptadores fixos de item/processo. Copiar um writer ou usar PHP/SQL direto repetiria regras e violaria a orientação expressa do usuário. A implementação está autorizada como continuação; concessões novas e um novo cenário operacional dependem de autorização específica, sem reutilizar aprovações encerradas.

Validar TT nos dois escopos e regressão de amostras/leitor, PHP payload/auditoria/SQL/transporte e metadados nativos. Compilar no OpenEdge12.2/.42 e publicar/validar em sursum-api/med9911. Não alterar/duplicar storage nem bibliotecas Kendo. Testes de negócio somente em novos registros marcados, com limpeza própria e preservação de logs após aprovação. Preservar os4727anexos anteriores e os registros do usuário. Memória deve distinguir preparado/publicado/validado.
