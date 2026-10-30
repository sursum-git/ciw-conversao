# CIW — conversões de cadastros com permissões ao final

Execução aqui, conforme determinação direta do usuário em20/10: converter as
outras aplicações e deixar permissões por último. Reutiliza o desenho da fase1
aprovado em16/10; esta ordem substitui o bloqueio histórico por CIW1A pendente.
Não remover autenticação nem controles atuais. Conta corrente fornecedor excluído.

## Entregas e contratos

- [x] Conferir schema real e eventos: Coloracoes, Situacoes do container,
  Tipos de versao de custo e Motivos de desconto estão no Progress; Tipos de
  valor e Empresas×Imposto nao foram encontrados em espec nem ticontrole;
  perfil principal especw em investigacao (ticontrole2 e conexao auxiliar). Despesas×Impostos tem PK composta;
  im-param tem chave textual. Não inventar chaves nem transportar tabelas entre bancos.
- [x] Implementar primeiro os quatro cadastros Progress de chave inteira com
  serviço compartilhado `CiwCadastroCrudService.p` e definição privada por recurso.
  Wrapper `CiwCadastrosCrud.p` fixa tabelas/buffers/referências; cliente escolhe
  somente recurso enumerado e operação fechada. Sem nomes de tabela/campo livres.
- [x] Testar em TT antes do serviço: read/get, defaults/null/Unicode/tipos/limites,
  CRUD, original completo, conflito, dependência, lote misto atômico com falha
  posterior e campos extras recusados. Compilar/executar em12.2/.42 nas duas culturas.
- [x] Publicar em sursum-api/med por manifesto, backup/hash, token técnico em header
  privado e identidade derivada da sessão PHP. API nunca exige/recebe senha humana.
- [x] Criar metadados JSON no Builder: source API, entidades e telas batch
  ciw.coloracoes, ciw.situacoes-container, ciw.tipos-versao-custo, ciw.motivos-desconto.
  Alocar códigos pelo catálogo atual, sem colisões/reseed/frontend paralelo/Kendo.
- [x] Integrar snapshots confirmados da transação à auditoria reutilizando
  RuntimeApiEntityActionService; testes de vínculo fonte/rota/recurso e tipagem.
- [ ] Validar pelo backend/telas reais, incluindo inclusão/alteração/exclusão e
  rollback somente em registros novos com marcador CODEx, removendo-os no final.
  Preservar integralmente registros anteriores e registrar evidências por aplicação.
- [ ] Converter Tipos de valor e Empresas×Imposto após resolver a origem e obter
  dicionário real. Perfil especw aponta ao próprio espec/111; as tabelas declaradas
  não foram encontradas. ODBC legado não conectou. Não inferir adapter SQL pela
  conexão auxiliar ticontrole2. Preservar chave informada de Tipos de valor.
- [x] Converter manutenção Despesas×Impostos com chave composta real (absorvida
  na coleção de Empresas por despesa) e Parâmetros IMA (cd0098) com chave textual.
  Publicação12.2/PASOE e testes reais limpos em20/10, conforme plano complementar.
  Leitura de parâmetros pelas APIs continua na include central sem cache.
- [ ] Conferir consulta de tipos de anexo já existente e apresentação/navegação
  das consultas absorvidas; conferência visual ainda pendente.
- [ ] Revisão independente única ao final; atualizar inventário e contextos
  distinguindo preparado/compilado/publicado/validado. Sem commit/push/schema.

Checkpoint20/10: revisão independente do primeiro lote encerrada,1P2 de auditoria
reproduzido/corrigido com RED/GREEN. CRUD real e28eventos confirmados; conferência
visual ainda pendente. Resultado e próxima ordem em
docs/ciw-cadastros-validacao-2026-10-20.md. Não marcar a fase inteira concluída.

## Interfaces do primeiro lote Progress

`RUN CiwCadastroCrudService.p(INPUT phData AS HANDLE, INPUT phReference1 AS HANDLE,
INPUT phReference2 AS HANDLE, INPUT poDefinition AS JsonObject,
INPUT poRequest AS JsonObject, OUTPUT poResponse AS JsonObject)`.
Definição exclusivamente servidor: resource,primaryKey,fields (name,type,maxLength).
Operações read/get/create/update/delete/batch. IDs são positivos int32, automáticos
nos quatro recursos deste lote; PK única e lock NOWAIT da última chave serializam
inclusões existentes, colisão em tabela vazia é recusada por índice único com
rollback integral. Sem sequência ou schema inventados.

Requests e envelopes seguem tipos-anexo já publicado: single usa campos planos,
id e original; batch usa changes [{operation,clientId,id?,data?,original?}].
Atualizar/excluir exige original completo dos campos editáveis; os snapshots da
auditoria vêm dos buffers sob lock e só saem depois do commit. Exclusão confere
todos os buffers de referência do dicionário, sem cascata. Máximo200 linhas/lote.
Sem garantia de serialização com inserts de consumidores legados sem FK/mesmo lock.

Tipo de versão sem referência homônima no dicionário exige conferir eventos antes
de liberar exclusão. Nenhuma restrição deve ser inferida apenas do nome de campo.

Fonte sanitizada: sources/scriptcase/phase1. Schemas atuais:
integration-src/ciw-cadastros/schema. Ledger/evidência privada:
.runtime/ciw-cadastros-20261020/. Nenhuma senha/token em fontes ou exemplos.
