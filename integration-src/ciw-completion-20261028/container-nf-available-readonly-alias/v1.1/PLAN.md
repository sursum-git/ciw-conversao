# Companion1053 v1.1 — alias exato e causas de limite

Baseline canônica9 `ContainersPainelFinanceReadService.p` SHA09678e8fabe46c2fd35ea3bf814e587765490135533a034822236da2ed5c37cf. Patch somente no novo recurso `nfs-disponiveis`: comparar a representação hexadecimal dos 67 bytes da chave; manter formato canônico e recusar alias com espaço final. Recursos anteriores, mapper, fórmulas, filtros, caps e frontend intactos.

Separar os erros503 do mesmo recurso em `CONTAINER_NF_CANDIDATE_LIMIT` (>200 elegíveis), `CONTAINER_NF_SOURCE_LIMIT` (>50mil leituras contadas) e `CONTAINER_NF_QUERY_TIMEOUT` (10s/STOP). Sem truncar nem alterar capacidade/paginação.

TDD direto ABL: reproduzir espaço final aceito no serviço9; testar igualdade, alias/case/prefix/tipos e formato; observar o comportamento de lowercase, sem presumir nova falha. Provar demux200/50mil por TT reais. Timeout usa cópia técnica somente de teste com limiar zero, documentada por bytes; não alega esperar10s nem publica a fixture. Executar39regressões novas anteriores com apenas expectativas dos dois códigos atualizadas, 231financeiras antigas byteiguais, quatro combinações CP/cultura/NUMDBS0. Congelar patch, provas reversíveis e testes; root executa12.2/publica após revisão. Nenhum arquivo canônico, freeze9/1053 ou metadado alterado.
