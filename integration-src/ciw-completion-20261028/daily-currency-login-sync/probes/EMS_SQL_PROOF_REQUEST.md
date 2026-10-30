# Gate SQLEMS2 — somente prova delimitada pelo root

Nenhuma conexão/query é executada neste pacote. O perfil espec_pro do teste SQL atual aponta espec; não serve como evidência da tabela física comum.cotacao. Qualquer SQLColumns/PREPARE necessita perfil comprovadamente ligado ao MESMO banco comum do dicionário12.2. Não trocar perfil/DB por fallback. Não registrar credenciais.

Fonte index.php:5985–6002: dia-1 repetições de `0;`, concatenação de31-dia repetições de `5.12345;` com último delimitador removido; util_incr_valor(...,delimitador='') apenas concatena (7483–7510). Os quatro literais completos e contagens estão em ems2-literal-cases.json. Dias1/15/28:30 tokens não vazios. Dia31:30 zeros e delimitador final,31 tokens com último vazio. Nenhuma conclusão de valor físico do slot31 deriva dessa contagem.

Dicionário oficial: cotacao DECIMAL10 EXTENT31; PK(mo-codigo INTEGER,ano-periodo CHARACTER); usuario CHARACTER EXTENT31. Formato x(12) NÃO estabelece limite físico de12caracteres nem regra de ator. UPDATE fonte5823 preserva slots1..dia-1 e escreve o valor em TODOS os slots dia..31. INSERT fonte5986 passa um literal ao campo array, não às31colunas individuais.

Provas mínimas desejadas, sem DDL/writes/seq/programa de negócio:

1. SQLColumns somente pub.cotacao no perfil comum correto: tipo do campo/31pseudo-colunas e versão/driver, sem linhas comerciais.
2. PREPARE sem EXECUTE, se o driver suportar, do INSERT literal que usa ("ano-periodo","mo-codigo",cotacao); registrar apenas aceitação/código, caso/dia. Não executar statement de escrita. PREPARE aceito comprova sintaxe/tipo aceito, NÃO conversão/assignment do vetor em execução.
3. Se a conversão para o array ocorrer apenas no EXECUTE, manter gate. Uma futura prova exige cenário próprio expressamente autorizado com limpeza/rollback e sem dados do usuário; este pacote não solicita nem executa essa escrita.

O adaptador candidato bloqueia EMS2 inexistente ANTES de seus efeitos, sem preencher slot31 silenciosamente. EMS5 contém triggers create/delete/write; o legado usa SQL ODBC e o candidato é ABL. Closure dos triggers, dependências, diferenças entre drivers e efeitos externos/rollback são gates separados; não usar DISABLE TRIGGERS nem copiar regras.
