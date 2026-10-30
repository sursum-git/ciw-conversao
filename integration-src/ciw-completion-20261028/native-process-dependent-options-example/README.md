# Exemplo nativo de opções dependentes

Pacote separado do produto1047 e de seus freezes. Três novos arquivos de exemplo e dois patches por hash (catálogo/matriz); nenhum código de produção ou biblioteca Kendo é alterado. Usa exatamente ProcessEngine/Validator/JSONSchema do candidato1047v1.2. Antes de integrar, root deve revisar/integrar essa extensão process-only e comparar baselines do catálogo/matriz.

A página local renderiza o motor real e dois enums fechados que recarregam uma seleção múltipla. Contexto obrigatório readonly, descarte de resposta antiga, execução suspensa durante carregamento, confirmação/cancelamento e ausência de execução na abertura são os comportamentos demonstrados. O cliente fictício fica em src/examples e só inicia na página identificada do exemplo; não chama fetch/XHR. O exemplo não implementa fórmulas, persistência ou auditoria comercial. A produção mantém screenId/endpointId, contexto/assinatura/permissões e regras no servidor.

A skill construtor-pg-demo-production-parity, citada pelo AGENTS, não está instalada após busca dos SKILL.md locais; checklist de docs/paridade-demo-producao.md aplicado diretamente. Matriz preparada por inserção de linha em bytes, preservando a codificação legada CP1252 e todo o conteúdo existente. Status pendente: o exemplo usa extensão ainda candidata, não publicada/integrada. Validação local não equivale a publicação nem execução de negócio.

Comandos: executar tests/prepare.py, depois tests/verify.cjs. O teste usa arquivo local do stage, assets Kendo locais e o motor congelado1047v1.2; bloqueia qualquer request HTTP/HTTPS e registra zero fetch/XHR. Não usa rota da produção. O JSON de exemplo e seu objeto estático no JS são comparados exatamente, sem JS vindo de metadata.
