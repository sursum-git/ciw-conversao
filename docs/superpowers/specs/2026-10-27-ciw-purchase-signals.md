# Alertas contextuais do processo de compra MED

Converter a parte de processos/itens das regras1–4 de `bl_sinaliz.criarAlertas`, alcançando as consultas `cons_proc_compra_sinaliz` e `cons_itens_proc_compra_sinaliz` por uma aba nativa **Alertas** no processo já publicado. O recorte é contextual: processo obrigatório, empresa MED, consulta somente leitura. Não declarar convertido o painel global inteiro, a regra5 de containers, o cadastro dos sinalizadores nem seus outros fluxos. Controles continua pendência final.

A arquitetura já foi determinada pelo usuário: reutilizar frontend por JSON, rotinas compartilhadas, navegação dos cadastros existentes e auditoria nativa. A continuação expressa autoriza executar essa arquitetura sem repetir questionário de desenho. Nenhum cálculo fiscal, custo ou financeiro será copiado. Abrir Alertas não executa manutenção ou processo.

Regras exatas do PHP, somente para processos cod_situacao=1:

1. Item exige aprovaçãoSO/LD, envio real conhecido e recebimento real ausente; alerta quando hoje>=envio+dias1.
2. Item exige aprovaçãoSO/LD, recebimento real conhecido e aprovação real ausente; hoje>=recebimento+dias2.
3. Término real ausente, término previsto conhecido E recebimento realSO/LD conhecido; hoje>=previsto−dias3. Preservar essa última condição do código mesmo sem constar na descrição cadastrada. Não exigir flagaprovação nesta regra.
4. Processo sem QUALQUER vínculo em pagt os_proc_compra (tabela física `pagtos_proc_compra`), com registro conhecido; hoje>registro+dias4. Não trocar > por>=, não consultar/alterar títuloERP e não somar valores.

Usar `PurchaseSignalRules.p` para avaliação de datas e condição; `PurchaseSignalsService.p` para composição em leitura dos buffers fixos; `PurchaseSignalsApi.p` para bindings/TODAY internos. Validar contexto por `PurchaseOrderContext.i`; paginação/filtros/ordenação/chave composta/detalhe por `CiwErpReadService.p`, acrescentando um contrato fixo. Datas, SQL, empresa, programas e listas de IDs não podem vir do navegador.

Configuração1–4 vem da tabela física `sinalizadores_importacao`, leituraNOLOCK sem cache. Ausência/valor desconhecido recusa503; não inventar dias. Em27/10 os dias físicos são10/2/7/7 (regra5=5). O dicionário confirmou somente cinco campos: ID,nome,título,descrição,dias. Os títulos/descrições existentes têm mojibake; não corrigir registros de produção neste recorte. Usar rótulo canônico legível da regra no grid e preservar título/descrição configurados no detalhe, documentando essa diferença de apresentação.

A projeção terá chave estável `record_key` JSON com sinaliz_imp_id/proc_compra_id/item_proc_compra_id (item0 para regra4), dados da regra/datas/processo/item e link **Itens do processo** para a tela já publicada. API apenas read/get; get reavalia contexto e chave. Limites de leitura/tempo, resposta sem sucesso parcial. Nenhuma nova transação de negócio/auditoria fictícia; logs técnicos são nativos. As manutenções seguem pelos cadastros atuais, com usuário e imagens anteriores/atuais. Preservar os modos Logs/LogsExclusão e nove abas do pai.

Isolar candidatos/baselines, testesTT RED→GREEN/culturas/codificações, regressão do leitor compartilhado, revisão única ao final, integração porhash/backups. Compilar .42/OE12.2, publicar .137via.111 e validar somente sursum-api/med/9911. Preservar política/administração de consumidores concorrente27/10. Sem DDL/escrita operacional. Só solicitar a nova permissão read de Alertas depois de publicação/validação concreta; não reutilizar autorizações consumidas.
