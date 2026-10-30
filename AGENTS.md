# Contexto para continuar este projeto

Antes de trabalhar, leia [context/PROJECT_CONTEXT.md](context/PROJECT_CONTEXT.md). Ele registra a implantação local do construtor, a integração com o motor Progress, os contratos, os testes e as pendências reais.

Para continuar após o chat de16/10/2026, ler primeiro [context/RETOMADA_2026-10-16.md](context/RETOMADA_2026-10-16.md). Contém caminhos Scriptcase, estado publicado versus fontes preparados, decisões mais recentes e ordem de retomada; corrige estados históricos do contexto longo.

- Responder em português, de forma direta. Reutilizar o frontend do `construtor-pg` por metadados JSON; não criar um frontend paralelo nem alterar bibliotecas Kendo.
- Este workspace contém a conversão e suas ferramentas. Os projetos canônicos relacionados ficam em `D:\opencode\construtor-pg` e `D:\opencode\motor-progress\v2`; ler seus próprios AGENTS/contextos antes de alterá-los e preservar mudanças existentes.
- ABL executável deve ser compilado em OpenEdge 12.2 no `.42`, publicado e validado no PASOE real conforme a skill `motor-progress-publicar-pasoe`. Usar `sursum-api/med`; não trocar de instância como fallback.
- Nunca gravar senhas/tokens em fontes, exemplos ou memória. `.runtime/` contém estado privado ignorado; mencionar caminhos, nunca seu conteúdo.
- Testes de negócio autorizados devem usar somente registros novos marcados para teste e removê-los ao terminar. Preservar registros criados pelo usuário.
- Atualizar a memória ao mudar ambiente, contratos, caminhos, decisões ou estado de validação. Diferenciar exemplos preparados, fontes cadastradas e telas efetivamente publicadas.
- Parâmetros IMA nas APIs: usar a include Progress `sursum-api/includes/parametros_ima.i`, com leitura direta NO-LOCK de espec.im-param. O usuário determinou que essa consulta não deve usar cache nas APIs.
- Custos e versões de container devem ficar em rotinas separadas e reutilizáveis. Compartilhar coleta, cálculo e persistência de versões entre APIs/programas; não repetir fórmulas ou regras. Duplicação só quando não houver forma viável de reutilizar, com motivo registrado. Determinação explícita do usuário em16/10/2026.
