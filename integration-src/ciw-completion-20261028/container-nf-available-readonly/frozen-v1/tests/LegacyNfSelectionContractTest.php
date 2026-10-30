<?php
namespace App\Tests\Runtime;
use PHPUnit\Framework\TestCase;
final class LegacyNfSelectionContractTest extends TestCase
{
 private static function source(string $relative):string{return file_get_contents('D:/opencode/conversao-sc/sources/scriptcase/'.$relative);}
 public function testActualSourceHasInvertedActionAndDocumentOnlyPredicate():void{
  $code=self::source('ciw-completion-next19c-20261028/bl_selecao_nf/index.php');self::assertStringContainsString('$acao_associacao_nf = \'desassociar\';',$code);self::assertStringContainsString('$fornecedor = $this->buscarFornecedorContainer(',$code);self::assertStringContainsString('$estabContainer = $this->buscarEstabContainer(',$code);$lines=explode("\n",$code);$predicate=array_values(array_filter($lines,static fn($l)=>str_contains($l,'$conteudo =')))[0];self::assertStringContainsString('<>',$predicate);self::assertStringContainsString("'".'$documento'."'",$predicate);self::assertStringNotContainsString('serie-docto',$predicate);self::assertStringNotContainsString('cod-estabel',$predicate);self::assertStringContainsString('idi-sit-nf-eletro',$code);
  $grid=self::source('containers/cons_docum_est_importacao/cons_docum_est_importacao_grid.class.php');self::assertStringContainsString('substr(\\"nat-operacao\\",1,1) = \'3\'',$grid);self::assertStringContainsString('if($this->sc_temp_acao_associacao_nf == \'associar\')',$grid);$index=self::source('containers/cons_docum_est_importacao/index.php');self::assertStringContainsString('Associar NF Importação',$index);self::assertStringContainsString('insert into pub.nfs_container(cod_emitente,documento,serie,estab,nat_operacao,container_id)',$index);
 }
 public function testExactPhpInterpolationOfNullEmptyAndSpacesWithoutExecutingLegacy():void{
  foreach([[null,''],['',''],['  ','  '],["000001","000001"]]as[$documento,$expected]){$conteudo=" \"nro-docto\" <> '$documento'";self::assertSame(" \"nro-docto\" <> '$expected'",$conteudo);}
 }
 public function testSqlThreeValuedInequalityTruthTableIsExplicitModelNotAnOdbcExecution():void{
  $notEqual=static fn(?string $left,?string $right):?bool=>$left===null||$right===null?null:$left!==$right;
  foreach([[null,'',null],['','',false],['SAFE','',true],['000001','000001',false],['000002','000001',true]]as[$left,$right,$expected]){self::assertSame($expected,$notEqual($left,$right));self::assertSame($expected===true,$notEqual($left,$right)===true,'Only TRUE passes a WHERE predicate');}
 }
}
