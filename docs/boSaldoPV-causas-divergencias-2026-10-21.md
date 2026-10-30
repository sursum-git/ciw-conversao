# Causas das diferenças entre PHP e boSaldoPV

Leitura de 21/10/2026 dos fontes PHP no `.170`, confrontada com a boSaldoPV
publicada e a matriz real de 67 verificações. As sete diferenças da lista foram
explicadas por três comportamentos: complemento de saldo pela grade, descarte
de origem pelo mínimo e normalização de oportunidade para somente PE.
As quatro diferenças de validação decorrem de contratos de entrada distintos.
Nenhum fonte de produto foi alterado.

## Decisão do usuário sobre responsabilidades

**Decisão posterior e vigente:** após a explicação do saldo complementar, o
usuário considerou esse comportamento um provável erro da consulta PHP e
determinou desconsiderá-lo. Não reproduzir na BO as buscas complementares sem
referência/mínimo/estabelecimento, incluindo o efeito observado no caso com
mínimo. As cinco ocorrências relacionadas a esse comportamento são diferenças
intencionais aceitas, não pendências de correção da BO. A BO mantém os critérios
recebidos e suas regras de perfil existentes. Nenhuma mudança de código foi feita.

Com essa decisão e a responsabilidade do chamador descrita abaixo, nenhuma das
divergências da matriz67 permanece como correção solicitada na BO. Os resultados
brutos da comparação são preservados: não converter diferenças aceitas em
igualdade numérica nem afirmar paridade literal com o PHP.

O usuário determinou que os itens **1 e 4 da resposta do diagnóstico** —
normalização de oportunidade para somente PE e validações de entrada — são
responsabilidade do cliente que chama a BO. Resultados vazios para entradas
que não seguem as regras são aceitáveis; não acrescentar essas validações nem
a normalização de origem na BO para reproduzir o formulário. Essa numeração
refere-se à resposta do chat: corresponde às seções 3, 4 e 5 deste documento.

As diferenças de oportunidade e de validação da matriz são mantidas como
observações do contrato entre página e chamada direta, **não como defeitos a
corrigir na BO**. O chamador deve preparar os parâmetros adequados; a comparação
anterior de oportunidade enviou os checkboxes antes da normalização do PHP.
Não afirmar que a BO atual retorna vazio em todos esses casos: a auditoria
registrou respostas diferentes, aceitas pelo usuário como tratamento do cliente.

Na definição anterior, permaneciam no escopo da BO os itens **2 e 3 da resposta**: complemento de
saldo da grade e referência combinada com mínimo (seções 1 e 2 abaixo).
São cinco ocorrências da lista na matriz, incluindo repetições de evidência:
quatro de referência/origem complementar e uma do caso combinado.
A decisão posterior acima retirou também esses itens do escopo de correção.

## 1. Referência na origem complementar: a grade PHP faz outra consulta

O controlador chama `getFiltroEstoqUnicoItem`, que calcula somente as origens
selecionadas e guarda `estoque_pe`/`estoque_pi`. A grade, em `inicializa`, define
`log_pe` e `log_pi` a partir da **existência de linhas nesses arrays**, não
diretamente dos checkboxes. Esses indicadores são globais ao conjunto retornado,
não individuais por item.

No evento onRecord da grade:

```php
// Existe array PE e não existe array PI:
$aSaldoPI = $this->getQtsPI('item', $this->it_codigo);

// Existe array PI e não existe array PE:
$aSaldoPE = $this->buscarSaldoEstoque(
    '5', " and saldo.\"it-codigo\" = '$this->it_codigo' ",
    false, 1, true, false
);
```

As chamadas complementares omitem referência, estabelecimento selecionado e
mínimos. A PI tem ainda uma condição que pula esse complemento quando
`refs_sel` é exatamente a string `'led'`. Não generalizar o comportamento como
“a origem não selecionada sempre é exibida com os mesmos filtros”.

A BO usa `referenciaPermitida` nas duas coletas, inclusive na origem coletada
somente para exibição quando `exibirAmbosSaldos=YES`. Mantém também o contexto
de estabelecimento. Por isso os resultados confirmados foram:

| Item175182 / REF A01 | Página PE / PI | BO PE / PI |
|---|---:|---:|
| Somente PE | -1 / 18200 | -1 / 11200 |
| Somente PI | 50 / 11200 | -1 / 11200 |

Explica quatro ocorrências da matriz: `ref_so_pe`, `ref_so_pi`, a lista em
`det_ref_pe` e sua repetição `evidencia_ref_pe_final`. O detalhe em si foi igual.

Fontes:

- [PHP: indicadores dos arrays](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/grade-inicializa.php:715).
- [PHP: complemento PI](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/grade-linhas.php:402).
- [PHP: complemento PE](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/grade-linhas.php:410).
- [Progress: referência em PE](../integration-src/saldo-pv/esbo/boSaldoPV.p:423) e [em PI](../integration-src/saldo-pv/esbo/boSaldoPV.p:440).

## 2. Referência + mínimo: o PHP descarta PE e depois o busca sem filtro

No caso combinado, A01 tem saldo PE=-1 e o mínimo é 2 metros. O tipo4 passa pela
exceção de perfil na primeira parte de `filtrarPorQt`, mas a segunda parte ainda
remove linhas quando **total do item <= 0 e mínimo > 0**.

O encadeamento real é:

1. PE A01=-1 é removido pelo helper, apesar do perfil4.
2. PI A01=11200 permanece; o item entra pela origem PI.
3. O array PE fica vazio: `log_pe=false`; o PI tem linhas: `log_pi=true`.
4. A grade entra na mesma busca complementar PE acima, sem REF/mínimo/estab.
5. A consulta complementar retorna PE total=50; a página exibe 50/11200.

A BO calcula PE=-1 e PI=11200 com REF A01. Na etapa3, a PI mantém o item
elegível. Com `exibirAmbosSaldos=YES`, a linha PE real é preservada e
`atualizarTotais` soma `qtSaldoVenda` bruto, resultando em -1/11200. A BO não
executa a busca complementar usada pela grade.

Isso explica a ocorrência `combinado`. O saldo adicional 50 exibido pelo PHP
resulta de uma segunda consulta com outros critérios, não de somar A01 de
outra forma. Para paridade literal é necessário reproduzir essa política de
apresentação sem substituir o saldo real da referência.

Fontes:

- [PHP: descarte de total não positivo com mínimo](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/helper-filtrar-quantidade.php:38).
- [Progress: preservação das origens do item elegível](../integration-src/saldo-pv/esbo/boSaldoPV.p:601).
- [Progress: total exibido soma saldo real](../integration-src/saldo-pv/esbo/boSaldoPV.p:542).

Observação: como os indicadores PHP são globais, se outro item deixar o array
PE não vazio, `log_pe` pode continuar true e essa busca complementar não será
acionada para um item sem PE. Uma futura compatibilização não deve trocar essa
regra global por uma regra por item sem decidir conscientemente a diferença.

## 3. Oportunidade: o controlador PHP força a origem PE antes do helper

No evento onValidateSuccess, o controlador contém:

```php
if ($this->check_liquida_ima) {
    $this->opcoes_saldo = 1;
    $tabelaSel = 1;
}
```

Portanto, marcar PE+PI junto com Oportunidade não chega ao helper como PE+PI:
o controlador substitui por somente PE. O ramo adicional `log_tab_safira`
também força PE, com tabela selecionada2; esse controle estava oculto e não foi
manipulado na auditoria.

O probe enviou à BO os checkboxes capturados antes desse processamento interno.
A BO recebeu `buscarPE=YES`, `buscarPI=YES`, `soLiquidacao=YES` e não possui essa
normalização. `carregarLiquidacao` restringe PE, mas o PI continua elegível.
Por isso 175182 foi eliminado no PHP e mantido na BO por PI=18200 (PE=0).
Em CAMBRAIA, PHP retornou3 itens e BO4, incluindo175182.

A causa primária é a normalização do controlador não reproduzida na entrada da
BO/chamador. Adicionar indiscriminadamente o filtro de liquidação ao PI não
representa o fluxo PHP: o PHP retira PI da decisão de elegibilidade. A grade
ainda pode mostrar PI complementar para itens que tenham passado em PE.

Explica `oportunidade` e `oportunidade_cambraia`.

Fontes:

- [PHP: origem forçada e tabela](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/controlador-valida.php:220).
- [PHP: helper recebe as opções já alteradas](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/controlador-valida.php:233).
- [Progress: liquidação na coleta PE](../integration-src/saldo-pv/esbo/boSaldoPV.p:428) e [PI ainda habilitado](../integration-src/saldo-pv/esbo/boSaldoPV.p:434).

## 4. Validações de origem e oportunidade

O PHP tem duas barreiras anteriores ao cálculo:

- `ValidateField_opcoes_saldo` exige campo preenchido.
- onValidate rejeita oportunidade marcada sem PE entre as opções.

A normalização para PE da seção anterior só acontece depois de a entrada
superar a validação. Por isso somente PI + Oportunidade é rejeitado, enquanto
PE+PI + Oportunidade é aceito e depois transformado em somente PE.

A BO valida valores desconhecidos e faixas, mas não exige que pelo menos um
dos flags buscarPE/PI seja YES e não exige buscarPE para soLiquidacao. Sem
origem, retorna vazio; com somente PI e oportunidade, retorna PI normalmente.

Fontes: [campo obrigatório PHP](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/controlador-origem-obrigatoria.php:8),
[oportunidade exige PE](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/controlador-valida.php:123),
[validação Progress](../integration-src/saldo-pv/esbo/boSaldoPV.p:193).

## 5. Intervalos invertidos: SQL vazio versus erro explícito

O helper de propriedades PHP monta predicados `>= inicial AND <= final` para
gramatura e peso. Não há comparação entre os extremos no caminho que gerou as
consultas observadas. Com início maior que fim, os predicados não encontram
itens e a página mostra “Registros não encontrados”.

O Progress compara os extremos antes de selecionar os candidatos e executa
`RETURN ERROR "Faixa de propriedades invertida."`. É uma diferença de contrato
de entrada, não uma diferença da fórmula de estoque. Na matriz real, foi
confirmado o sinal de erro; o probe não capturou essa mensagem em ERROR-STATUS.

Fontes: [predicados PHP](../.runtime/bo-saldo-20261021-auditoria/php-causes-readable/helper-propriedades.php:19)
e [rejeição Progress](../integration-src/saldo-pv/esbo/boSaldoPV.p:208).

## Evidência de diagnóstico e limites

Os arquivos PHP legíveis acima são cópias de funções, com finais de linha
normalizados. `php-causes-readable/manifest.json` registra arquivo remoto, linha
inicial, hash do fonte remoto e hash do corpo. Foram lidos o controlador
`ctrl_filtro_estoq_unificado_apl.php` e a grade
`cons_item_estoque_unificado_grid.class.php`, além dos helpers envolvidos.

Foi executada uma reprodução local isolada de sete condições, usando os blocos
originais de `filtrarPorQt`, inicialização, onRecord e normalização. Somente as
consultas ao banco foram substituídas por stubs com os saldos já observados na
matriz real. Os sete checks passaram, reproduzindo -1/18200,50/11200 e a troca
do mínimo2 para PE complementar50; também demonstraram o indicador global por
conjunto e a exceção literal `'led'`. Isso é evidência das condições e argumentos
do código, não uma nova execução PHP contra o banco.

Evidências privadas em `.runtime/bo-saldo-20261021-auditoria/`:
`php-cause-fixture.php`, `php-cause-fixture-result.json`,
`php-cause-fixture-manifest.json`, snapshots `php-causes*/extraction.json`,
mais a matriz real em `comparison.json` e `bo-batch1/bo-resultados.json`.

A compatibilização futura deve contemplar a normalização anterior ao helper e
o complemento de apresentação posterior a ele, reutilizando os cálculos de
saldo existentes. As nove consultas detalhadas já coincidentes devem ser
preservadas. Esta entrega é diagnóstico: não houve mudança de BO/PHP/include,
recompilação de produto, publicação, chamada PASOE ou alteração comercial.
