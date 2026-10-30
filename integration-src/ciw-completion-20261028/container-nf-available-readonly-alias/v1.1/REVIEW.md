# Review companion1053 v1.1

Corrigido o P2 reproduzido diretamente no serviço9: `nf_key=id + espaço` retornava sucesso. O novo guard somente de nfs-disponiveis valida formato/67 bytes/ASCII antes de alocar68 bytes, compara o HEX de67 bytes e libera MEMPTR em FINALLY. Nenhuma conversão/trim/correção do alias. ID lowercase já era recusado; ValidKey e guard canônico do ID permanecem literalmente iguais.

Separadas causas503, preservando valores/ordem dos limites: CONTAINER_NF_CANDIDATE_LIMIT (>200 elegíveis), CONTAINER_NF_SOURCE_LIMIT (>50mil leituras contadas), CONTAINER_NF_QUERY_TIMEOUT (10s/STOP). Sem truncamento/paginação nova. 50mil conta linhas lidas pelos loops fixos, não I/O interno do banco. Nenhum teste remoto/negócio foi executado nesta preparação.

RED direto: alias com espaço aceito e causas candidato/timeout genéricas. GREEN local12.8 NUMDBS0: (18aliases+2timeout+39disponíveis+231financeiras)×4CP/culturas=1.160 checks. Os 231 testes antigos são byteiguais; os39 anteriores mudaram SOMENTE duas expectativas de código. Timeout foi forçado em uma cópia privada do serviço com >=10000→>=0 em exatamente dois pontos; prova do ramo sem esperar10s, jamais artefato de produção. Nenhuma alegação de validar latência real/SQL/collation.

5 anchors por bytes, reversão exata e zero EOL alterado em linhas preservadas; ABI13parâmetros/10handles e11rotinas centrais literalmente iguais. Apenas Service.p/r é candidato à publicação; nada de wrapper/OO/PHP/frontend/metadados. Freeze1053, releases9/9-v2 e progresso1055 preservados. Compilação12.2, revisão independente e publicação do delta são gates do root; quatro dos cinco containers observados ainda falharam por limite no9 e não recebem readproof por inferência.
