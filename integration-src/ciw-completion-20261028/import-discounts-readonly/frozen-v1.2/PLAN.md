# Plano — consultas de descontos de importação

**Objetivo:** entregar op1045/1046 somente leitura, preservando consulta global,
detalhe e lançamentos contextualizados pelo desconto.

**Arquitetura:** coletor único de descontos e lançamentos NO-LOCK agrega SUM
ignorando NULL; expõe utilizado geral COALESCE0, soma bruta do detalhe nullable e
saldo autorizado−COALESCE0. Adaptador seleciona uma TT e reutiliza
CiwErpReadService para filtros/ordenação/página/GET. API com buffers físicos fixos.
Metadados nativos, permissões próprias sem grants, sem frontend adicional.

**Escopo comprovado:** cons_descontos_geral global sem WHERE empresarial;
cons_det_desconto_geral restringe desconto_importacao_id; grid_cta_corren_desconto
usa o mesmo contexto. grid_descontos_importacao restringe item_container_id e é
outra origem, fora deste incremento. cod_usuario do ledger permanece DATE.

**Reuso investigado:** ContainersCustoReadService agrega créditos por container,
filtra log_credito e converte pela cotação. ContainersVersionAuxSnapshotService
captura proporções autorizadas sob contexto de escrita. Nenhum desses implementa
saldo autorizado global; não reutilizar filtros/conversões divergentes. Nova
agregação existe uma única vez no coletor e é compartilhada pelos dois recursos.

- [ ] Escrever e observar RED TT do coletor para soma conhecida/NULL, valores
  negativos, saldo desconhecido, contexto, DATE físico e limites globais.
- [ ] Implementar coletor/TT mínimos e obter GREEN nas quatro combinações locais.
- [ ] Implementar API/Service e propostas isoladas Reader/dispatcher/PHP com
  baselines SHA256. Validar read/get, chave completa, contexto, alias estrito,
  readonly, paginação200 e ausência de dados parciais.
- [ ] Gerar dois metadados e quatro operações novas, link geral→ledger, campos de
  detalhe preservando soma nullable; registrar gaps de lookup sem alegar conversão
  completa de fontes não cobertas.
- [ ] Executar PHP real readCiwErpPage/get com transporte simulado e revisão;
  congelar manifesto. Root integra, compila12.2/.42 e valida PASOE/nativo.

Canônicos e freezes anteriores preservados. Sem publicação, rede, DDL, CRUD,
grants ou escrita de registros comerciais por este executor.
