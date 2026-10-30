# Comparação da página IOL com a boSaldoPV — 20/10/2026

## Resultado após a correção — versão publicada às20:47BRT

**14 de14 cenários retornaram os mesmos itens e os mesmos saldos PE/PI exibidos.**
A página foi operada novamente, com carga completa dos resultados; a rodada final
da BO executou os14 filtros com `login=tasilpar`, `tipoUsuario=4`, representante0
(sem seleção de representante), empresa5 e estabelecimentos5/505 salvo o filtro
específico. Quantidades vazias na grade foram normalizadas para zero, com comparação
na precisão exibida de duas casas decimais.

| Cenários | Resultado após correção |
|---|---|
| Item175182, mínimos0/100/20.000m | Iguais: PE50,00 ePI18.200,00; tipo4 ignora mínimos |
| SomentePE e somentePI no175182 | Iguais: ambas as colunas50,00/18.200,00 |
| Item400288 emKG, mínimos0/20kg | Iguais: PE19,60 ePI0 |
| SomenteES e somenteSC no175182 | Iguais: ES50,00/18.200,00; SCnenhum item |
| UnidadeKG incompatível e gramatura1.000..1.001 no175182 | Iguais: nenhum item |
| Somente tabelaRubi no175182 | Iguais nos itens/saldos; preços não comparados |
| PesquisaCAMBRAIA | Iguais:175100,175181,175182,175183 e seus saldos |
| Item135114 negativo | Iguais: PE-2,00 ePI0 |

`pesquisaItem` implementa a busca do campo Item da página: códigos numéricos exatos,
listas separadas por vírgula, descrição por frase/palavras e os curingasLIKE. Zeros
à esquerda são preservados. `itemContem` conserva o contrato anterior de trecho do
código. O chamador deve usar `pesquisaItem` para o valor digitado na página.

`exibirAmbosSaldos=YES` é o novo padrão: buscarPE/buscarPI selecionam a elegibilidade
dos itens, enquanto ambos os saldos reais são retornados para os itens aprovados.
Uma origem não selecionada nunca salva um item reprovado nas origens selecionadas.
`exibirAmbosSaldos=NO` preserva o comportamento anterior. A coleta e as fórmulas são
compartilhadas, sem uma segunda implementação de cálculo para a grade.

Exemplo dos novos parâmetros (a configuração de usuário vem de contexto confiável):

```abl
ASSIGN ttFiltroSaldoPV.pesquisaItem = "CAMBRAIA"
       ttFiltroSaldoPV.exibirAmbosSaldos = YES
       ttFiltroSaldoPV.buscarPE = YES
       ttFiltroSaldoPV.buscarPI = NO.
```

Compilação oficial12.2/.42:95 checks aprovados em cada cultura AMERICAN/EUROPEAN,
18 tabelas sintéticas vazias após ambas e compilação contra esquema real sem erros.
XREF confirma índicecodigo para códigos exatos/listas e preservação dos caminhos
codigo/fam-ge/grupo. A TT interna de elegibilidade possui índice poritem.
Revisão independente sem achados concretos.

Publicados somente boSaldoPV.p/.i/.r12.2 no ERP.137, após backup/guarda e conferência
dos hashes; a boSaldo original foi preservada. **Recompilar chamadores e liberar
instâncias persistentes antigas**, pois a estrutura da TT de filtros mudou.
As14 execuções finais usaram exatamente o `.r` deste recibo; nenhuma escrita comercial.
O teste executou no cliente12.2 do .42; validação por consumidor PASOE continua pendente.

Evidências vigentes em `.runtime/bo-saldo-20261020/`:
`compiled122-page-parity/verification.json`, `publish-page-parity-receipt.json`,
`live-page-tasilpar-parity/web-cases.json` e
`live-page-tasilpar-parity-final/{bo-resultados,comparison,receipt}.json`.
Comparador:`compare-tasilpar-parity-final-results.py`.
Não generalizar os14 casos para preços, todas as referências/containers ou payloadPHP
integral. A página não exibe o login da sessão; foi usado o login informado pelo usuário,
com tipo4 confirmado no cadastro. Leituras feitas em momentos distintos, sem snapshot
transacional comum. As primeiras capturas antecipadas de navegação foram descartadas.

## Histórico: comparação anterior à correção

Foram concluídos14 cenários na página
https://imaonline.imatextil.com.br/iol/ctrl_filtro_estoq_unificado/
e executados os mesmos filtros na boSaldoPV12.2. **Os itens coincidiram em13 dos14
casos.** Em11 casos também coincidiram as duas quantidades PE/PI, normalizando vazio
da grade para zero e comparando a precisão exibida de duas casas decimais.

O usuário informou o login `tasilpar`. Consulta restrita de `espec.user-web` confirmou
um único cadastro, `tp-usuario=4`; nenhuma senha foi lida. A rodada final da BO usou
`login=tasilpar`, `tipoUsuario=4`, representante0 (sem seleção de representante),
empresa5 e estabelecimentos5/505, salvo indicação diferente. A página abriu sem
solicitar autenticação e não mostra o login; a identidade de sua sessão foi informada
pelo usuário, não verificada visualmente. Nenhuma sessão ou permissão foi alterada.

## Histórico: resultados da rodada anterior

| Filtros | Página PE / PI | BO PE / PI | Comparação |
|---|---|---|---|
| Item175182, PE+PI, mínimos0 | 50,00 / 18.200,00 | 50,00 / 18.200,00 | Igual |
| Item175182, mínimo100m | 50,00 / 18.200,00 | 50,00 / 18.200,00 | Igual, tipo4 ignora mínimo |
| Item175182, mínimo20.000m | 50,00 / 18.200,00 | 50,00 / 18.200,00 | Igual, tipo4 ignora mínimo |
| Item175182, somentePE | 50,00 / 18.200,00 | 50,00 / 0,00 | Mesmo item, coluna PI adicional na página |
| Item175182, somentePI | 50,00 / 18.200,00 | 0,00 / 18.200,00 | Mesmo item, coluna PE adicional na página |
| Item400288, unidadeKG, mínimos0 | 19,60 / vazio | 19,60 / 0,00 | Igual após normalizar vazio |
| Item400288, unidadeKG, mínimo20kg | 19,60 / vazio | 19,60 / 0,00 | Igual, tipo4 ignora mínimo |
| Item175182, somenteES/estab5 | 50,00 / 18.200,00 | 50,00 / 18.200,00 | Igual |
| Item175182, somenteSC/estab505 | Nenhum item | Nenhum item | Igual |
| Item175182, unidadeKG | Nenhum item | Nenhum item | Igual |
| Item175182, gramatura1.000 a1.001 | Nenhum item | Nenhum item | Igual |
| Item175182, somente tabelaRubi/2 | 50,00 / 18.200,00 | 50,00 / 18.200,00 | Igual nos saldos; preços não comparados |
| CampoItem=`CAMBRAIA` | Quatro itens | Nenhum item | Divergência de pesquisa textual |
| Item135114, mínimos0 | -2,00 / vazio | -2,00 / 0,00 | Igual, tipo4 permite saldo negativo |

Para as consultas numéricas, o valor do campoItem foi passado ao `itemContem` da BO,
com o mesmo código digitado. Os códigos são exatos na pesquisa PHP; nesta amostra,
não houve código adicional pela pesquisa de trecho da BO. Isso não comprova paridade
geral entre busca numérica exata, listas e pesquisa por trecho.

## Histórico: divergências confirmadas antes da correção

1. **Pesquisa por descrição.** Na página, `CAMBRAIA` encontrou175100,175181,175182 e175183.
   Na BO, `itemContem=CAMBRAIA` não encontrou itens. O campo da página aceita código
   ou descrição; `itemContem` continua limitado ao código. Os helpers `gerarFiltroPartes`
   e `gerarFiltroTermo` foram localizados nesta investigação no fonte gerado
   `iol/ctrl_filtro_estoq_unificado/ctrl_filtro_estoq_unificado_apl.php` do .170.
   Termos numéricos geram igualdade/lista de códigos; texto pesquisa descrição por
   frase ou conjunção de palavras; grupos separados por vírgula são combinados por OR.
   O achado substitui a pendência histórica de localização desses helpers, mas a
   implementação dessa busca na BO continua pendente. Não foi alterada nesta tarefa.
2. **Apresentação das origens não selecionadas.** Nos casos somentePE/somentePI,
   a grade manteve ambas as colunas de saldo. A BO calculou somente a origem solicitada.
   Os itens e os saldos das origens selecionadas coincidiram. Para reproduzir a grade
   integralmente, o chamador precisará separar a elegibilidade por origem da coleta de
   saldos adicionais para exibição; não basta comparar as duas colunas cegamente.

## Contexto de usuário e mínimos

Os helpers PHP e a BO desconsideram mínimos para os tipos3/4. Por isso os exemplos
com20.000m,20kg e saldo negativo não representam falha de filtro para `tasilpar`, que
é tipo4. A rodada exploratória com `tipoUsuario=0` e login vazio divergiu nesses casos;
ela não deve ser usada como resultado final para esse usuário. O chamador deve informar
login/tipo reais em vez de deixar `tipoUsuario=0` por omissão.

Nesta amostra, o cadastro e o resultado da BO explicam o comportamento observado.
Não foi comparado o conteúdo completo da sessão PHP, inclusive eventual representante
previamente selecionado. A conclusão não abrange todas as permissões e containers.

## Método, evidências e limites

- Página operada pelo navegador, com envio dos filtros e espera de carga completa.
  A consulta geral sem item foi interrompida durante a carga incremental e excluída.
- A máscara de gramatura transformou a primeira tentativa `1000` em`10,00`.
  Essa tentativa foi descartada. Repetição confirmou`1.000,00` e`1.001` no formulário
  antes do envio; somente ela foi contabilizada no cenário correspondente.
- BO executada no OpenEdge12.2/.42 contra ems2med/espec reais do .111, somente leitura
  NO-LOCK. O runner é temporário e usa o `.r` oficial cujo hash corresponde ao recibo
  de publicação: `9cfbe1fe92c33794bf4418834192de4cdb3a89bcc71b72bccdf190b5928aa6f5`.
- A rodada final teve14 execuções com `tasilpar`/tipo4. As28 execuções exploratórias
  com tipos0/3 são controles históricos, não somar como cenários distintos da página.
- Comparação automática por conjunto de códigos e quantidades PE/PI exibidas. Não
  compara preços, imagens, datas de chegada, payload integral ou detalhes por referência.
- Página e BO foram consultadas em momentos distintos, sem snapshot transacional comum.
  Não se pode generalizar a coincidência para todos os dados ou futuros movimentos.
- A BO e sua include permaneceram inalteradas. Nenhum registro comercial foi gravado
  ou removido, nem rota/restart/publicação adicional foi feito. Não é validação PASOE:
  a execução ABL ocorreu no cliente12.2 do .42.

Evidências privadas sob `.runtime/bo-saldo-20261020/`:
`live-page-comparison/web-cases.json`, `live-page-tasilpar/{bo-resultados,comparison,receipt}.json`,
`live-user-context/usuario-contexto.json` e `php-helpers/extraction-live-comparison.json`.
Probe de reprodução: `ComparePaginaSaldoTasilpar.p`; comparador:`compare-tasilpar-results.py`.
A consulta porCAMBRAIA foi repetida ao final com os mesmos quatro itens e deixada aberta.

Auditoria ampliada em21/10: ver [matriz de todos os campos](boSaldoPV-auditoria-filtros-2026-10-21.md). Foram encontradas diferenças de regra não cobertas pelos14+4casos anteriores; nova comparação real bloqueada pela conexãoSSHdo42. Não generalizar a igualdade anterior para todos os filtros.


Retomada após acesso restabelecido: auditoria ampliada concluída em12.2/.42,67retornos. Resultado47/54listasválidasiguais,9/9detalhesiguais,4diferençasdevalidação; relatório de21/10contém valoresconfirmados. BloqueioSSHanteriorfoisuperado. NenhumaBOalterada nesta auditoria.

