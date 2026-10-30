# Desenhos e tipos — prova de origem antes do próximo pacote

Fontes sanitizadas: sources/scriptcase/ciw-completion-linked-20261028, manifesto integration-src/ciw-inventory/ciw-completion-linked-20261028-source-manifest.json.

| Origem | Perfil principal literal | Projeção |
|---|---|---|
| grid_desenhos/index.php:7 | ems206espPRO | grid.class.php:898: desenho_id,codigo,descricao,nome_arquivo,tipo_desenho_id |
| grid_tipos_desenho/index.php:7 | ems206espPRO | grid.class.php:877: tipo_desenho_id,descricao,ativo |
| form_desenhos/index.php:50 | especw | apl.php:3163: mesmos cinco campos na inclusão |
| form_tipos_desenho/index.php:50 | especw | apl.php:2991: mesmos três campos na inclusão |

**Não presumir que consulta e manutenção usam o mesmo banco.** O dicionário oficial12.2 da espec conectada em28/10 comprovou ausência de ambas as tabelas; não autoriza criar tabelas nem trocar de instância. Root deve resolver somente o destino do perfil ems206espPRO e confirmar dicionário/uso da origem real. A manutenção especw permanece separada até prova de vínculo.

Atualização provada pelo root: ems206espPRO resolve o DSN espec_pro; especw resolve espec_w_pro. Ambos apontam a DB espec, servidor .111, broker SQL10112. O dicionário ABL da mesma base permanece sem ambas as tabelas. Recibo privado source-profiles.json contém somente o resultado delimitado, sem credenciais. Portanto a diferença literal de nomes de perfil não prova outro banco ativo; a lacuna agora é comprovar uso/origem real dessas aplicações frente à ausência física. Não criar schema para fazer a conversão encaixar.

O evento onload dos dois formulários apenas guarda/formata campos (desenhos apl:2729; tipos apl:2587); nenhum serviço de negócio específico foi encontrado nele. O insert inclui a PK informada e inicializa NM_cmp_auto/NM_seq_auto vazios (desenhos apl:3085; tipos apl:2913); não foi encontrada chamada de sequência nesses fontes. Não converter esse achado em regra de geração sem conferir schema e evento completo. O formulário mantém chave readonly na alteração; confirmar contrato do core para PK manual antes da implementação.

nome_arquivo é input text (form_desenhos_form0.php:1251). Referências genéricas a _lib/file/doc e jquery.fileupload no boilerplate não comprovam upload de desenho; não construir transporte de arquivo por esse nome de campo.

Pacote seguinte somente após origem/esquema provados: consultas nativas e, se identidade/referências forem confirmadas, CRUD via core reutilizável com locks, concorrência e auditoria usuário/anterior-atual. Nenhum DDL, grant, escrita operacional, publicação ou teste de negócio foi feito nesta descoberta. Despesas de container em lote/defaults podem avançar em paralelo usando fontes/esquema já existentes.
