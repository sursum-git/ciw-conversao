# Conversão das aplicações CIW parciais e preparadas

## Intenção

Concluir somente as aplicações do escopo de menu que hoje estão marcadas como `Parcial` ou `Preparado`, sem ampliar o trabalho para as 80 origens pendentes nem para as quatro em triagem. Cada origem só passa a `Convertido` após API, metadados, publicação e validação aplicável.

## Escopo

São 21 origens do recorte `menu_ctrl_importacao`: 13 parciais e oito preparadas. O inventário canônico é `integration-src/ciw-inventory/menu-scope/menu-scope.json`.

As parciais cobrem cotações, login, consulta/painel de containers, versões, pagamentos, anexos, despesas, documentos fiscais, títulos e itens. As preparadas concentram a geração de versões, distribuição, manutenção de despesas em lote e simulação/fechamento de custo.

## Fora de escopo

- As 80 origens pendentes, quatro em triagem e 106 não alcançadas pelo menu.
- Biblioteca Kendo e um frontend paralelo.
- Reimplementar fórmulas de custos, versões, impostos ou distribuição: devem usar serviços Progress únicos já existentes ou evoluídos de forma central.
- Criar/substituir arquivos de anexos ausentes. Há 146 referências sem o acervo físico confirmado.
- `Controles`, mantido como pendência final por decisão do usuário.

## Abordagens consideradas

1. Converter todas as 21 telas como CRUDs independentes. Rejeitada: duplicaria processos de custo e permitiria telas sem fluxo transacional válido.
2. Concluir primeiro as telas parciais e depois ativar os fluxos preparados por domínio reutilizável. Escolhida: mantém o frontend do construtor por JSON, reduz duplicação e permite validar cada domínio antes de publicar processos gravadores.

## Arquitetura e decisões

- ABL/OOABL em `motor-progress/v2` permanece a regra de negócio; PHP só autentica, encaminha e adapta o contrato do runtime.
- A fonte de cada programa no construtor será acrescida por operações preservando as já publicadas, com preview integral e locks/grants temporários. Não serão concedidos acessos humanos além dos explicitamente autorizados.
- Toda escrita relevante deve registrar ator, ação, imagens anterior/atual e identificador de transação através das classes de log/transação existentes.
- Operações de gerar versão, distribuir custo, simular/fechar custo ou alterar dados fiscais só serão exercitadas em registros novos, identificados e autorizados pelo usuário. Se não houver autorização específica, a entrega pode incluir API, testes sem banco e publicação somente de consulta, mas não validação gravadora real.
- Anexos de container continuam com leitura/metadados até existir caminho ou backup dos arquivos físicos.

## Sequência aprovada

1. Corrigir/completar fidelidade de leitura e navegação das telas parciais já publicadas; encerrar cada origem cujo gap seja apenas metadado, ação ou validação.
2. Completar as APIs e ações faltantes do painel de containers usando serviços reutilizáveis.
3. Publicar os oito fluxos preparados em blocos de domínio: versões; despesas em lote; distribuição; simulação/fechamento.
4. Fazer validação real controlada por cenário autorizado, atualizar o inventário e manter bloqueios explícitos quando faltar dado, arquivo ou autorização.

## Critério de aceite

Uma origem é `Convertido` somente se sua equivalência foi confrontada, a API está compilada em OpenEdge 12.2 e publicada em `sursum-api/MED`, a tela/metadata está publicada, as permissões continuam mínimas e há prova de leitura ou de teste transacional autorizado. Caso contrário, permanece `Parcial`, `Preparado` ou `Bloqueado` com motivo registrado.
