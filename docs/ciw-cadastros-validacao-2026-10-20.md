# CIW — cadastros publicados em20/10/2026

O usuário determinou converter as outras aplicações e deixar permissões para o
final. Essa prioridade substitui o bloqueio histórico da fase1A; autenticação e
controles atuais permanecem. Conta corrente fornecedor continua excluído.

## Entrega efetiva

| Cadastro | Programa | Tela | Estado |
|---|---|---|---|
|Colorações|cd0094|ciw.coloracoes|Publicado1.0.0, CRUD/lote e auditoria validados|
|Situações do container|cd0095|ciw.situacoes-container|Publicado1.0.0, CRUD/lote e auditoria validados|
|Tipos de versão de custo|cd0096|ciw.tipos-versao-custo|Publicado1.0.0, CRUD/lote e auditoria validados|
|Motivos de desconto|cd0097|ciw.motivos-desconto|Publicado1.0.0, CRUD/lote e auditoria validados|

Metadados JSON publicados pelo Builder oficial no frontend existente. As consultas
legadas correspondentes apontam para esses cadastros no inventário, mas a
equivalência de apresentação/filtros/navegação continua parcial. Conferência
visual das quatro telas ainda pendente: navegador permanece no login humano;
nenhuma sessão do usuário foi substituída para executar os testes administrativos.

## Implementação e provas

- Serviço privado compartilhado `CiwCadastroCrudService.p`, definição fechada por
  recurso e wrapper `CiwCadastrosCrud.p`. Endpoint
  `POST /SursumPrograms/ciw-cadastros`, somente recursos enumerados; banco/tabela
  não vêm do cliente. Header técnico privado e ator reconstruído pela sessão PHP.
- Chaves físicas inteiras, geradas no servidor; locks NOWAIT, original completo,
  bloqueio de referências conhecidas e lote atômico. Nenhuma regra de custo
  duplicada, schema alterado ou registro existente usado em teste de escrita.
- Cinco programas compilados sem erros em OpenEdge12.2/.42; testes de transação
  com60checks nas culturas AMERICAN e EUROPEAN. Definições com8checks em UTF-8
  e ISO8859-1. A falha16063 reproduzida no PASOE foi corrigida com LONGCHAR UTF-8;
  somente as sessões ociosas do agente med receberam refresh oficial.
- Publicação no compartilhamento137 via111, instância **sursum-api/med**. Manifestos,
  backups e hashes em `.runtime/ciw-cadastros-20261020/publish/`. Artefatos12.8
  locais não usados. Não houve troca de instância nem reinício amplo.
- CRUD real pelo backend do construtor nos quatro recursos: inclusão de dois
  registros, lote misto, conflito de original, falha posterior com rollback
  integral e campo desconhecido recusado. Apenas registros novos marcados CODEx;
  removidos no finally e comparação dos dados anteriores preservada.
- Após revisão independente, corrigida a validação de auditoria que aceitava
  apenas tipos_anexo. Teste RED reproduziu descarte do lote; GREEN aceitou recurso
  confiável e recusou vínculo adulterado. Nova prova real confirmou28eventos
  (3inclusões,1alteração,3exclusões por recurso), snapshots e ator autenticado,
  apesar do header forjado enviado pelo teste. Logs consultados somente leitura.
- PHP: **536testes/3206asserções**, suite completa aprovada. Catálogo atual:
  **23telas CIW**, todas com definição runtime HTTP200. Isso não significa que
  os262programas legados estejam integralmente convertidos.

Evidências privadas: `real-crud-evidence.json`, `audit-evidence.json`, logs de
compilação/testes e recibos `publication-*.json` na mesma pasta `.runtime`.
Estado público sanitizado em `integration-src/ciw-inventory/cadastros-validation.json`.
Não guardar conteúdo dos arquivos privados em fontes/documentação.

## Pendências e próxima ordem

1. Despesas × Impostos: chave composta física despesa_id/imposto_id/empresa_id.
   Preservar as três partes e validar referências; não criar chave artificial.
2. Parâmetros IMA: chave textual cod-param; edição administrativa dos campos
   legados. Consumo pelas APIs continua pela include parametros_ima.i, direto
   NO-LOCK e sem cache. Não exportar valores potencialmente secretos.
3. Tipos de valor e Empresas × Imposto: formulários declaram tipos_valor e
   empresas_imposto; ausentes no dicionário espec consultado. Perfil principal
   especw aponta ao DSN espec_w_pro, mesmo banco espec/111 (SQLbroker10112).
   ticontrole2 é conexão auxiliar, não evidência de origem SQL desses cadastros.
   Consulta ao catálogo ticontrole não encontrou tabelas e ODBC legado não
   conectou. Uso/origem precisam confirmação; não inventar schema/adapter.
4. Conferir consulta de Tipos de anexo e consultas absorvidas; logs/navegação
   pela infraestrutura existente, preservando histórico.
5. Seguir as demais fases do inventário; concluir permissões CIW ao final.

Não houve commit/push, concessão nova de permissões de negócio, mudança de senha,
reseed ou alteração de Kendo. A prova humana tcassimiro da etapa de permissões
permanece pendente e deixou de bloquear as outras conversões por ordem do usuário.
