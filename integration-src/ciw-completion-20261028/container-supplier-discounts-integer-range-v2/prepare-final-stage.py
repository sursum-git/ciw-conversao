from pathlib import Path
import hashlib,json,shutil
D=Path(__file__).resolve().parent
W=D.parents[2]
R=W/'.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2/final-local-v1'
C=Path('D:/opencode/construtor-pg/backend/src')
assert not R.exists(),'Final scope already staged; do not overwrite receipts'
proof=W/'.runtime/ciw-completion-20261028/build13-root-companions-v3/canonical-manifest.json'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
official=json.loads(proof.read_text())
assert official['success'] is True
for row in official['files']:
 assert sha(Path(row['target']))==row['sha256'],row['target']
S=R/'php-stage';S.mkdir(parents=True)
rows=[]
for p in sorted(C.rglob('*.php')):
 rel=p.relative_to(C);target=S/rel;target.parent.mkdir(parents=True,exist_ok=True);shutil.copyfile(p,target)
 rows.append({'relative':rel.as_posix(),'canonicalPath':str(p),'canonicalSha256':sha(p),'stageSha256':sha(target),'overlay':False})
for rel in ['Builder/ProgramBuilderService.php','Runtime/RuntimeImportDiscountRead.php']:
 target=S/rel;src=D/'candidate/backend/src'/rel;shutil.copyfile(src,target)
 row=next(r for r in rows if r['relative']==rel);row.update({'stageSha256':sha(target),'overlay':True,'overlaySource':str(src)})
assert len([r for r in rows if r['overlay']])==2
data={'success':True,'srcCurrent13':True,'canonicalManifest':str(proof),'canonicalManifestSha256':sha(proof),'files':rows,'overlays':['Builder/ProgramBuilderService.php','Runtime/RuntimeImportDiscountRead.php'],'old1056ActionQueryOverlay':False,'routing1056IntegrationProven':False}
(R/'php-stage-manifest.json').write_text(json.dumps(data,indent=2)+'\n')
bootstrap='''<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=__DIR__.'/php-stage/';
spl_autoload_register(static function(string $class)use($stage):void {if(str_starts_with($class,'App\\\\')&&!str_starts_with($class,'App\\\\Tests\\\\')){$file=$stage.str_replace('\\\\','/',substr($class,4)).'.php';if(!is_file($file))throw new RuntimeException('Missing staged class '.$class);require $file;}},true,true);
register_shutdown_function(static function()use($stage):void {$rows=[];$bad=[];foreach(array_merge(get_declared_classes(),get_declared_interfaces(),get_declared_traits())as$class){if(!str_starts_with($class,'App\\\\')||str_starts_with($class,'App\\\\Tests\\\\'))continue;$r=new ReflectionClass($class);if($r->isAnonymous()||!$r->getFileName())continue;$file=str_replace('\\\\','/',$r->getFileName());$staged=str_starts_with($file,str_replace('\\\\','/',$stage));if(!$staged)$bad[]=$class;$rows[]=['class'=>$class,'path'=>$file,'sha256'=>hash_file('sha256',$file),'staged'=>$staged];}file_put_contents(__DIR__.'/php-stage-loader-proof.json',json_encode(['success'=>!$bad,'loadedAppDefinitions'=>count($rows),'outsideStage'=>$bad,'files'=>$rows],JSON_PRETTY_PRINT));});
'''
(R/'php-stage-bootstrap.php').write_text(bootstrap)
(R/'phpunit.xml').write_text(f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{R.as_posix()}/php-stage-bootstrap.php" cacheResult="false"><testsuites><testsuite name="IntegerRangeFullCurrent13"><directory>D:/opencode/construtor-pg/backend/tests</directory><directory>{D.as_posix()}/tests</directory></testsuite></testsuites></phpunit>''')
print(json.dumps({'phpSources':len(rows),'overlays':data['overlays'],'stage':str(R),'canonicalManifestSha256':sha(proof)}))
