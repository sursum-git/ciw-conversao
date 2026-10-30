# Consulta manual de colorações em Progress

Atualizado em 15/10/2026. Fonte compilado no OpenEdge 12.2, publicado no PASOE `sursum-api/med` e validado com 41 registros reais. A fonte API já está cadastrada no backend local do construtor. Este pacote oferece uma consulta; não cria uma tela nem operações de inclusão, alteração ou exclusão.

## Arquivos

| Arquivo | Uso |
|---|---|
| `ConsultarColoracoesManual.p` | Programa ABL, assinatura INPUT JsonObject / OUTPUT JsonObject |
| `CompileColoracoes.p` | Runner de compilação 12.2 conectado a `espec`; não publicar |
| `rota-adicionar.json` | Registro no array `routes` do roteador PASOE |
| `api-source.json` | Cadastro da fonte pelo backend do construtor; marcador privado no token |
| `operacao-adicionar.json` | Operação de lista para o catálogo |
| `entity-fields.json` | Campos da entidade API de consulta |

A tabela real é `espec.coloracoes`: `coloracao_id` inteiro, `descricao` texto de até 50 caracteres e `log_inativo` lógico. O índice `primario` é primário e único sobre `coloracao_id`. Não foram encontrados triggers ou expressões de validação no dicionário. `itens_proc_compra` também possui `coloracao_id`; isso é indício de dependência, não prova de integridade referencial automática. Não existe exclusão neste exemplo.

## Contrato publicado

`POST http://127.0.0.1:19910/med/web/SursumPrograms/coloracoes-consulta-manual`

Corpo `{}`. O PHP envia o header privado `X-Coloracoes-Token`; nunca colocar o segredo no JSON de tela ou no navegador. O programa compara SHA-256 com `sursum-conf/coloracoes-api.json` e executa um `FOR EACH espec.coloracoes NO-LOCK BY coloracao_id`, com campos fixos. Não aceita ABL, SQL, tabela ou WHERE livre do cliente.

Resposta ilustrativa (valores fictícios):

```json
{"success":true,"data":[{"coloracao_id":1,"descricao":"Azul","log_inativo":false}]}
```

Valores desconhecidos do Progress viram `null`. Erros têm `success:false` e `error` com `code`, `message` e `status`. O roteador retorna esses erros dentro do JSON, inclusive quando o transporte é HTTP 200. O contrato `sursum-programs` do cliente PHP converte esse envelope em erro do runtime.

Não configurar `totalPath`: esta implementação retorna a lista completa. O PHP faz filtro, ordenação, total e paginação. Isso atende a tabela atual de 41 registros; para tabelas grandes, desenvolver paginação no próprio programa e ajustar o contrato.

## Selecionar no construtor

1. Acessar [o construtor local](http://127.0.0.1:8765/production/program-builder.html) como administrador. Em Fonte API → Abrir cadastro de APIs, localizar **Motor Progress — Colorações (consulta manual)**, código `motor_progress_coloracoes_manual`.
2. Em uma entidade do tipo API destinada a **colorações**, selecionar essa fonte e a operação de lista `read` / Consultar colorações. Definir os três campos de `entity-fields.json`. Usar `coloracao_id` como chave e `integer`, para exibição sem casas decimais.
3. Usar somente consulta/visualização; desabilitar inclusão, alteração e exclusão. A API não oferece operações de detalhe ou escrita. Criar/publicar o programa pelo fluxo normal de governança do construtor, escolhendo um código disponível.
4. Salvar a entidade após alterar a fonte ou suas operações: o runtime utiliza um snapshot da API salvo na entidade. Apenas Salvar API não atualiza esse vínculo.

Não selecionar essa fonte na entidade de empresas: os campos pertencem a outra tabela. Não foi alterado o vínculo `empresas_progress` nem a tela `ciw.empresas`.

## Compilação e publicação realizadas

- Compilador: Windows `192.168.0.42`, `C:\Progress_12\OE\bin\_progres.exe`, OpenEdge 12.2.12; log: `COMPILER:ERROR=no`, `PASS: compile 12.2 coloracoes`.
- Conexão de compilação: `-db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec`, codepages UTF-8.
- Fonte e `.r`: `/mnt/datasul/ERP/sursum/sursum-api/programs/ConsultarColoracoesManual.{p,r}`. O programa foi copiado também para o checkout canônico `D:\opencode\motor-progress\v2\sursum-api\programs`.
- Catálogo: `/mnt/datasul/ERP/sursum/conf-web-handler/program-routes.json`, nova rota mesclada preservando as anteriores.
- Backup do catálogo: `/tmp/codex-coloracoes-20261015/backup-20261015T123318Z` no servidor `.111`.
- Configuração remota contém somente o hash; a credencial local fica em `.runtime/construtor-pg/coloracoes-connection.json`, fora do versionamento.
- Sem reinício de instância. Validação via túnel SSH autenticado, porta local 19910 → loopback 9910 da mesma instância `sursum-api`.

Validação: 41 registros, nomes e tipos exatos dos três campos, ordenação por ID, 13 descrições com caracteres acentuados, recusas de token ausente/incorreto. Nenhum registro de negócio alterado. Cadastro da fonte confirmou contrato `sursum-programs` e resposta administrativa com segredo mascarado.

Ferramentas em `../../tools/construtor-local`: `verify-coloracoes.ps1` repete a consulta e as recusas de autenticação; `register-coloracoes.ps1` cadastra uma fonte nova e recusa sobrescrever uma existente; `publish-coloracoes.py` é publicador inicial, também recusa sobrescrever artefatos/rota. Uma atualização futura exige publicação com backup e verificação da versão anterior, sem remover essas proteções.

As evidências locais ficam em `.runtime/coloracoes-compiled-20261015/compile-coloracoes.log`, `.runtime/construtor-pg/coloracoes-validation.json` e `coloracoes-registration.json`. O schema completo está em `../../integration-src/schema-coloracoes-dictionary.json`.

O handler mantém auditoria de duração/PID/agente/instância. O usuário logado é enviado pelo PHP quando esta fonte é consumida por uma entidade autenticada com contrato Sursum. A validação desta entrega chamou a API diretamente e não simulou uma nova tela autenticada.

Memória geral: [contexto da conversão](../../context/PROJECT_CONTEXT.md).
