<?php
// Somente leitura: contratos publicados. Nenhuma credencial ou sessão humana é exportada.
$b='D:/opencode/construtor-pg/backend';require $b.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();
$controller=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$catalog=new App\Runtime\PublishedModuleCatalog($em->getRepository(App\Entity\ScreenDefinition::class),$integrity);$rows=[];
$cleanEndpoint=static function(array $endpoint):array{
 $allowed=['code','type','method','path','url','requestContextFields','itemsPath','itemPath','responseContract'];$result=array_intersect_key($endpoint,array_flip($allowed));
 if(isset($endpoint['bodyTemplate']))$result['bodyTemplate']=array_intersect_key($endpoint['bodyTemplate'],array_flip(['resource','operation','program']));
 foreach(['url','path']as $key)if(isset($result[$key]))$result[$key]=parse_url($result[$key],PHP_URL_PATH)?:$result[$key];
 return $result;
};
foreach($catalog->screenIds('ciw')as $id){
 $screen=$catalog->screen($id);$code=$screen->getDefinition()['program']['entity']??null;if(!$code)continue;
 $entity=$em->getRepository(App\Entity\BuilderEntity::class)->findOneBy(['code'=>$code]);if(!$entity)continue;$integrity->assertBuilderEntity($entity);
 if($entity->getEntityType()!=='api')continue;$metadata=$entity->getMetadata();$source=$metadata['apiSource']??[];$endpoints=[];
 foreach(['listEndpoint','detailEndpoint','createEndpoint','updateEndpoint','deleteEndpoint','batchEndpoint']as $op)if(!empty($source[$op]))$endpoints[$op]=$cleanEndpoint($source[$op]);
 $runtime=[];foreach($em->getRepository(App\Entity\RuntimeEndpoint::class)->findBy(['screenId'=>$id,'enabled'=>true])as $ep){$integrity->assertEndpoint($ep);$runtime[]=['id'=>$ep->getEndpointId(),'handler'=>$ep->getHandler(),'config'=>array_intersect_key($ep->getConfig(),array_flip(['entityCode','operation','allowCreate','allowUpdate','allowDelete','fieldCode','processOptions']))];}
 $rows[]=['screenId'=>$id,'entityCode'=>$code,'apiBinding'=>$metadata['apiBinding']??null,'responseContract'=>$source['responseContract']??null,'endpoints'=>$endpoints,'operations'=>array_map($cleanEndpoint,$source['operations']??[]),'fields'=>array_map(fn($f)=>['code'=>$f->getCode(),'type'=>$f->getDataType()],$entity->getFields()->toArray()),'runtime'=>$runtime];
}
echo json_encode(['mode'=>'read-only','screens'=>count($rows),'entities'=>count(array_unique(array_column($rows,'entityCode'))),'programs'=>$rows],JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;
