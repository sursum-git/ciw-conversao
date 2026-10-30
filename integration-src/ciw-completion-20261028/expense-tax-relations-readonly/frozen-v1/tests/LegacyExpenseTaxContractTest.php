<?php
namespace App\Tests\Runtime;
use PHPUnit\Framework\TestCase;
final class LegacyExpenseTaxContractTest extends TestCase {
 private const W='D:/opencode/conversao-sc/';
 public function testLegacyGlobalProjectionHasNoFixedCompanyOrDistinctAndActualLookupIsEmpty():void{
  $file=self::W.'sources/scriptcase/phase1/grid_despesas_impostos/grid_despesas_impostos_grid.class.php';$text=file_get_contents($file);self::assertSame(6,substr_count($text,'SELECT despesa_id, imposto_id from '));self::assertStringNotContainsString('SELECT DISTINCT despesa_id',$text);self::assertStringContainsString('"Despesa Id"',$text);self::assertStringContainsString('"Imposto Id"',$text);self::assertStringContainsString('sc_strip_script($this->despesa_id)',$text);self::assertStringContainsString('sc_strip_script($this->imposto_id)',$text);
  $lookup=self::W.'sources/scriptcase/ciw-completion-expense-tax-lookups-20261028/grid_despesas_impostos/grid_despesas_impostos_lookup.class.php';self::assertSame('0338ba51658129c761e0bcb4164e88f02fb4319bfc5d47396a6ea1a31e610b26',hash_file('sha256',$lookup));self::assertMatchesRegularExpression('/class grid_despesas_impostos_lookup\s*\{\s*\}/',file_get_contents($lookup));self::assertStringNotContainsString('SELECT',file_get_contents($lookup));
 }
 public function testDictionaryDoesNotClaimPositiveOrMandatoryForeignKeys():void{
  $schema=json_decode(file_get_contents(self::W.'integration-src/despesas/schema/schema-despesas_impostos.json'),true,512,JSON_THROW_ON_ERROR);self::assertSame(['despesa_id','imposto_id','empresa_id'],$schema['indexes'][0]['fields']);self::assertTrue($schema['indexes'][0]['unique']);self::assertTrue($schema['indexes'][0]['primary']);self::assertCount(3,$schema['fields']);foreach($schema['fields']as$f){self::assertSame('integer',$f['type']);self::assertFalse($f['mandatory']);self::assertSame('0',$f['initial']);self::assertSame(0,$f['extent']);self::assertNull($f['validation']);}
 }
 public function testCurrentCd0093IsDifferentCompanyExpenseOwnedCollectionAndSource144IsPreserved():void{
  $base=self::W.'.runtime/ciw-completion-20261028/expense-tax-current/';$program=json_decode(file_get_contents($base.'expense-company-program.json'),true,512,JSON_THROW_ON_ERROR);self::assertSame('cd0093',$program['program']['code']);self::assertSame('1.0.1',$program['versions'][0]['version']);self::assertSame('empresas_despesa_progress',$program['versions'][0]['builderEntityCode']);$entities=json_decode(file_get_contents($base.'expense-tax-entities.json'),true,512,JSON_THROW_ON_ERROR);$entity=array_values(array_filter(array_column($entities,'entity'),fn($e)=>$e['code']==='empresas_despesa_progress'))[0];$fields=array_column($entity['fields'],null,'code');self::assertSame('json',$fields['impostos']['dataType']);self::assertArrayHasKey('empresa_id',$fields);self::assertArrayHasKey('despesa_id',$fields);
  $sources=json_decode(file_get_contents($base.'sources-current.json'),true,512,JSON_THROW_ON_ERROR);$source=array_values(array_filter(array_column($sources,'apiSource'),fn($s)=>$s['code']==='motor_progress_ciw_cadastros'))[0];$preview=json_decode(file_get_contents(dirname(__DIR__).'/metadata/api-source-preview.json'),true,512,JSON_THROW_ON_ERROR);self::assertCount(144,$source['operations']);self::assertSame($source['operations'],array_slice($preview['operations'],0,144));self::assertCount(146,$preview['operations']);
 }
}
