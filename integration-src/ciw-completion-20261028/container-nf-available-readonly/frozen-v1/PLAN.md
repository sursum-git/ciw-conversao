# op1053 — NFs disponíveis do container

**Objetivo:** entregar uma consulta contextual somente leitura para o conjunto aberto por `bl_selecao_nf`, sem habilitar associação ou desassociação.

**Arquitetura aprovada na tarefa:** o wrapper financeiro existente mantém seus dez handles e autenticação. Um recurso fechado `nfs-disponiveis` usa o mesmo `NfRow`, `NfKey` e mapeamento JSON de `nfs`. O runtime valida binding, aliases, contexto e resposta bruta antes do mapper genérico. O construtor gera op1053 por JSON, sem nova biblioteca ou frontend.

**Fontes e regras:** fornecedor `pp-container.cod-emit-forn`, estabelecimento `cod-estabel`, natureza iniciada em 3 e `idi-sit-nf-eletro=3`. Excluir os documentos vinculados ao mesmo container, independentemente dos demais cinco campos do vínculo. O nome da ação legado é invertido; o botão ativo demonstra que esta lista é a de disponíveis. Empresa MED pelo prefixo 5, banco fixo ems2med; nenhuma escolha de empresa/banco pelo cliente. Não exigir a tabela empresas neste novo recurso, pois a seleção legada usa diretamente o cabeçalho.

**Arquivos:** patches por bytes e SHA256 de `ContainersPainelFinanceRead.p`, `ContainersPainelFinanceReadService.p` e `RuntimeApiEntityActionService.php`; novo `php/RuntimeContainerNfAvailableRead.php`; metadata op1053, duas operações aditivas e link no cabeçalho op1000/ciw.containers. Não modificar Query/Reader ERP, fórmulas, freezes anteriores ou canônicos. O Action foi rebatido explicitamente sobre o build8 integrado; o antigo baseline7 está preservado no recibo privado.

- [x] Registrar hashes de fontes/dicionários e baselines; preparar estágio próprio.
- [x] Escrever TT que retorna RED no leitor anterior: filtro real, documento apenas, NULL, contexto MED, aliases e limites.
- [x] Implementar o recurso usando os mapeadores existentes; executar TT em UTF-8/ISO8859-1 × AMERICAN/EUROPEAN, NUMDBS0 e regressão financeira.
- [x] Exercitar Runtime real com transporte injetado: binding fechado, shape bruto, IDOR, aliases, writers e regressões contextuais.
- [x] Entrar por normalizeEntityPayload e validateExternalDraft reais, registry detail, AJV2020 e UI Kendo nativa.
- [ ] Revisar bytes/reversão/hashes, congelar candidato e manifesto com gates exatos.

**Limites declarados:** 50.000 linhas processadas pelas consultas fixas de vínculos/documentos (a linha seguinte detecta excesso; não é uma medição de IO interno do banco), STOP-AFTER 10 segundos, no máximo 200 NFs elegíveis por execução; exceder qualquer limite recusa sem resposta parcial. Paginação/filtros locais nativos sobre conjunto fechado. Valores NULL e espaços não são normalizados. Diferenças potencialmente ambíguas de comparação documental recusam com 422, sem afirmar equivalência SQL ainda não comprovada. O pacote é parcial: somente MED/read/get; a origem também contém fluxo IMA. A compilação oficial 12.2/.42 e a validação PASOE pertencem ao root; testes locais 12.8 não são publicação. Associar/desassociar continuam lacunas de manutenção, sobretudo o DELETE legado omite dois campos do vínculo.
