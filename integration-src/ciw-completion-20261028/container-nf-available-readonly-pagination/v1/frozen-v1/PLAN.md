# NFs disponíveis paginadas: plano de implementação

> Execução inline, por pacote isolado. Nenhum subagente, escrita canônica ou publicação neste pacote.

**Objetivo:** consultar integralmente o conjunto elegível dentro dos limites existentes, por páginas de até 200 linhas, incluindo GET de registros depois da posição 200.

**Arquitetura:** seleção financeira e `NfRow` únicos; TT privada tipada com JSON original em CLOB; filtro/ordenação/página/total no leitor ERP existente. Frontend nativo por JSON; sem biblioteca ou renderer novo.

**Especificação:** [DESIGN.md](DESIGN.md). Baselines oficiais11 para Reader/Query/Action; FinanceService runtime10 `614795...`; demais componentes preservados.

1. Reproduzir RED no Service real sobre TT e no handle PHP real. Preservar os recibos da recusa de 401 candidatos e do envelope paginado não suportado.
2. Preparar hunks exatos de Finance/Reader, reusando mapper, chave, parser e alias guard. Testar páginas 201/401/1001, GET posterior, filtros/ordem/empates, NULL/precisão, fonte50mil e deadline externo durante RUN do leitor.
3. Encaminhar o DTO nativo pelo `RuntimeCiwErpQuery` e `readCiwErpPage`, com validação raw NF antes do mapper. Testar binding, ownership, alias, envelope/total, campos privados e ausência de escritores/export allRows.
4. Rebase por hash sobre oficial11 sem perder1055. Executar regressões49+47, financeiras231, aliases18 e origem39; FULL PHP STAGE com todos os App arquivos, helper1055 e loader proof.
5. Gerar proposta metadata aditiva, normalizar draft real/validar/roundtrip, AJV2020 e renderer nativo. Reexecutar os cinco DTOs capturados do renderer no handle PHP real.
6. Revisar bytes, contexto, limites e invariantes. Congelar fontes, candidatos privados, inputs e evidências com hashes. Root revisa/compila12.2/publica/valida PASOE e decide metadata; este pacote não cumpre essas etapas por teste local.

Comandos independentes de reexecução estão em `REVIEW.md`. Scripts `prepare*`, `build-patches`, `rebase-11` e `freeze` são ferramentas mutáveis de preparação: nunca executá-los sobre um freeze. `check-frozen.py` é o verificador somente leitura.
