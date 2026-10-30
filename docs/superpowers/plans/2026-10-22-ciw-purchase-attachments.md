# Anexos dos itens de compra MED — plano de implementação

Execução inline com `superpowers:executing-plans`, preservando canônicos por candidatos e hashes. Requisitos: continuidade do cadastro existente, frontend por JSON, rotinas compartilhadas e logs autenticados com imagens anteriores/atuais. O usuário definiu PDF, imagens, Office e ZIP até20MB para novos arquivos; download histórico preservado.

## Arquitetura e limites

- Scriptcase170: `form_anexos_proc_compra_item`, `grid_anexos_proc_compra_item`, variante de consulta `grid_anexos_proc_compra_item_amostra`. Doze fontes sanitizados em sources/scriptcase/purchase-attachments.
- Banco: espec.anexos_proc_compra,7campos físicos,4725registros/MAX5303 na inspeção oficial12.2, referência única e nenhum trigger. Tipo em espec.tipos_anexo. Não reutilizar MAX+1 do legado nem sequências de outra identidade.
- Acervo confirmado em `/var/www/clients/client1/web2/web/ciw/_lib/file/doc` no disco local ext4 do170, sem symlink ou montagem compartilhada. Não presumir acesso por PHP local/PASOE. Adaptador próximo do acervo, autenticado, com configuração privada fora da raiz pública.
- Metadados/gravação continuam em Progress. Serviço de arquivos genérico e único no construtor e adaptador de storage reutilizável; nenhum arquivo físico anterior sobrescrito/apagado por update/delete. Arquivos novos recebem referência única; descrição/tipo/contexto/stamp pertencem ao contrato fechado. Download resolve arquivo a partir do registro autorizado.
- Suporte de arquivo aditivo no frontend existente: seletor no formulário, upload multipart no mesmo Salvar (sem upload ao abrir/cancelar), download autenticado; reutilizar Kendo/HttpClient/dispatcher/sessão/permissão/integridade/transação. Não criar app paralelo ou modificar Kendo.
- PDF, imagens raster, Office e ZIP até20*1024*1024bytes. Validar conteúdo/extensão no servidor; download histórico como attachment. Nada de executar/abrir HTML ou SVG inline. Bytes nunca nos logs.
- Banco/disco não compartilham transação: estágio privado, objeto imutável, recibo de operação e estado reconciliável. Compensar somente objeto novo em falha confirmada; resultado incerto preserva arquivo e bloqueia repetição automática. Não manter lock de banco durante upload.
- Novos schema/grants/testes operacionais precisam de consentimento específico; autorizações anteriores de amostras estão consumidas/fechadas. Avançar candidatos, testes e compilação antes dessa etapa.

## 1. Transporte e armazenamento reutilizáveis

- [x] Criar testes RED para política de arquivos, tamanho exato/excedido, MIME/extensão, nome forjado, confinamento/symlink, HMAC/replay, imutabilidade, objeto parcial e falhas de disco.
- [x] Implementar broker pequeno junto ao acervo, sem credenciais no fonte, e cliente PHP genérico com streams; journal privado para objetos novos, sem excluir acervo legado.
- [x] Implementar contexto privado de transporte de arquivo e adaptação multipart/binário no controller nativo, usando os mesmos gates do dispatcher. Não aceitar objeto de arquivo/path vindo de JSON.
- [x] Implementar editor de arquivo no formulário/HttpClient existentes, metadados fechados e download autenticado. Cancelar formulário não deve persistir bytes. Exemplo/paridade demo/produção quando aplicável.
- [x] Executar testes do transporte e revisão independente antes de integrar canônicos/publicar o broker.

## 2. CRUD contextual Progress e auditoria

- [x] Testes TT: CRUD, contexto MED, tipo, descrição800, data gerada no servidor, identidade/stamp, campos ocultos, rollback e preservação de referência anterior. Buffer físico7campos, imagem auditada completa e dono real.
- [x] Serviço único PurchaseItemAttachmentsApi/Service, include Snapshot e leitor compartilhado. Callback de sequência fixa, sem fallback/MAX. Arquivo novo somente por referência emitida pelo storage confiável; frontend não altera caminho/data/dono.
- [x] Perfil PHP compartilha transporte contextual existente, valida imagens/ator/commit e integra Logs/Logs Exclusão e agregação no item/processo. Testar payload nativo e filtros SQL adversariais.
- [x] Compilar no42/OE12.2 e testar culturas AMERICAN/EUROPEAN × UTF8/ISO8859-1. Conferir logs, não só exitcode.

## 3. Metadados, publicação e prova operacional

- [x] Escolher código livre no catálogo atual; acrescentar aba Anexos ao item1.0.1, preservando Envios de amostras, formato e pai1.0.2. Registrar operações na fonte existente73ops, preservando anteriores.
- [x] Preparar sequência/grants/cenário novos com escopo concreto e obter autorizações específicas somente para o que faltar. Cenário deve usar pai/item/anexos/arquivos novos marcados e limpeza, sem alterar documentos existentes.
- [x] Integrar canônicos com backup/hash, publicar p/r12.2 no137 via111 e recarregar só MED ocioso sursum-api/med9911. Publicar metadados pelo Builder e adaptar acesso autorizado.
- [x] Validar upload/download real, hash dos bytes, histórico imutável, substituição, metadados, exclusão do vínculo, usuário/imagens nos logs e UI; limpar próprios registros e arquivos autorizados. Conferir fisicamente IDs congelados, inclusive órfãos, sem depender do pai existir.
- [x] Atualizar inventário, documentação e quatro memórias distinguindo preparados/publicados/validados; fechar gates de teste ao concluir.

## Foco de revisão

Autorização deve ocorrer antes de persistir bytes ou ler o acervo; arquivo de outro item/tenant não pode ser baixado. Campo de caminho enviado pelo navegador nunca é autoridade. Falha/timeout não pode duplicar vínculo nem apagar bytes antigos. Download e cancelamento não executam manutenção. Legacy sem arquivo e datas nulas continuam legíveis; identidade de item/processo não pode ser mudada. Logs devem mostrar o dono/usuário real e imagens completas, sem conteúdo, senha, token ou chave privada.
