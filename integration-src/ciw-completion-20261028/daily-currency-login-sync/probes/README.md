# Probe de dicionário1054 — preparado, não executado

Somente metadados de comum.cotacao e ems5.cotac_parid, em duas conexões com esses aliases lógicos. Compilar e executar exclusivamente no12.2/.42, em pasta nova isolada. Não abre buffers de dados dessas tabelas, não executa triggers, sequências ou programas de negócio. Não publica o.r.

Host/porta/nome físico dessas duas conexões não foram provados neste pacote. O plano está retido até o root fornecer descriptor JSON privado aprovado, sem credenciais, com approvedFor=daily-currency-login-sync-dictionary-only e connections contendo exatamente duas linhas. Cada linha tem somente database,host,port inteiro e logicalName(comum ou ems5). Não há conexão sugerida/fallback. O descriptor não integra uploads ou manifest de fontes.

Comando posterior do root: RunProbe122.ps1 -ConnectionsFile CAMINHO_PRIVADO_APROVADO. O script exige o caminho remoto fixo do plano e pasta sem receipts antigos. Não imprimir o descriptor.

Saída privada currency-dictionary-private.json: campos, tipos, formato, precisão, extent, initial, mandatory, índices/PK/componentes e nomes/eventos de triggers. Limites globais50.000leituras de dicionário/10s; por tabela512campos/32índices/64componentes por índice/128triggers. Incompleto elimina todas as tabelas parciais e completed=false. Tabela ausente aparece found=false, sem fingir schema vazio válido.

Os testes locais cobrem sintaxe PowerShell, substituição de uma barra Windows por slash e fronteira do descriptor. Não foi executado AVM, conexão, SSH nem negócio.
