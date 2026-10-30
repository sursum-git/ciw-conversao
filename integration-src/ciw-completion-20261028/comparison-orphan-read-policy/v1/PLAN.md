# Política privada para leitura de versão órfã

Escopo autorizado pelo gerente: candidato isolado; sem integrar canônicos, publicar ou alterar freezes1649/17ac. Não há nova API, cálculo ou escrita.

Arquitetura: `ContainersVersionService` conserva `read_require_master=true` por padrão. A política privada booleana pode ser falsa apenas em `consultar` com `versao_id` específico. A verificação de pertencimento versão+container e CaptureSnapshot/ChildRows permanecem únicos e byte iguais. O novo caller comparison fixa false em objeto criado no servidor, sem copiar payloadHTTP para a política; dispensa seu próprio FIND de mestre. A coleta não usa Context/CollectVersionSnapshot de writers: estes continuam exigindo transação e pai físico.

Alternativas descartadas: pai fictício falsificaria contexto; copiar collector duplicaria projeção/NULL/limites; flexibilizar todos os callers mudaria o histórico MED e writers. Reutilizar a política no collector central mantém a seleção fonte sem master e preserva contratos anteriores.

- [ ] Copiar baselines canônicos atuais e17ac; pin Reader12/Finance12 apenas como dependências. Preparar overlay Reader comparação por hunks sobre12 exclusivamente para testar o produto composto; não aplicar em canônico.
- [ ] TT RED: padrão antigo404 com versão/itens órfãos, opt-in deve consultar; crossowner/missing continuam404. Testar política malformada/list/write e injeçãoHTTP nos boundaries reais.
- [ ] Implementar somente dois candidatos ABI compatíveis. Expor patch reversível por bytes e comprovar partes de writer/snapshot inalteradas.
- [ ] TT GREEN em4combinações CP/cultura, regressões189central e históricos/readers relevantes. Compilação local12.8 diagnóstico/NUMDBS0;12.2 oficial permanece gate do root.
- [ ] Entregar snapshot candidato e manifesto/review, sem composição oficial final antes de revisão do gerente/root.

Orçamento causal: o caller anterior fazia FIND master, a central fazia outro FIND master, depois CheckReadBudget para a versão e cada filho. Logo reservava2leituras (`read_max_rows=49998`) e iniciava materializador com3+filhos. O opt-in não faz os dois FINDs; central mantém versão+filhos e o materializador inicia1+filhos, teto50000. DO STOP-AFTER10 externo continua incluindo chamada central e materializador; não amplia prazo global. Não há listagem global de versões órfãs.
