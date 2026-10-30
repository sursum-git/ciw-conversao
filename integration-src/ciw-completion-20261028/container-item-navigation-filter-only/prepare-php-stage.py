from pathlib import Path
import hashlib,json
D=Path(__file__).resolve().parent;W=D.parents[2];R=W/'.runtime/ciw-completion-20261028/container-item-navigation-filter-only';S=R/'php-stage';C=Path('D:/opencode/construtor-pg/backend/src')
assert not S.exists(),'Stage is immutable after preparation; choose a fresh stage for a changed candidate'
rows=[]
for source in sorted(C.rglob('*.php')):
 relative=source.relative_to(C);candidate=D/'candidate/backend/src'/relative;body=(candidate if candidate.exists() else source).read_bytes();target=S/relative;target.parent.mkdir(parents=True,exist_ok=True);target.write_bytes(body);rows.append({'canonical':str(source),'staged':str(target),'canonicalSha256':hashlib.sha256(source.read_bytes()).hexdigest(),'stagedSha256':hashlib.sha256(body).hexdigest(),'candidate':candidate.exists()})
(R/'php-stage-manifest.json').write_text(json.dumps({'files':rows,'canonicalWrites':False,'networkExecuted':False},indent=2)+'\n')
bootstrap="""<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=__DIR__.'/php-stage/';
spl_autoload_register(static function(string $class)use($stage):void { if(str_starts_with($class,'App\\')&&!str_starts_with($class,'App\\Tests\\')){$file=$stage.str_replace('\\','/',substr($class,4)).'.php';if(!is_file($file))throw new RuntimeException('Missing staged class '.$class);require $file;} },true,true);
register_shutdown_function(static function()use($stage):void {$rows=[];$bad=[];foreach(array_merge(get_declared_classes(),get_declared_interfaces(),get_declared_traits())as$class){if(!str_starts_with($class,'App\\')||str_starts_with($class,'App\\Tests\\'))continue;$r=new ReflectionClass($class);if($r->isAnonymous())continue;$file=$r->getFileName();if(!$file)continue;$file=str_replace('\\','/',$file);$staged=str_starts_with($file,str_replace('\\','/',$stage));if(!$staged)$bad[]=$class;$rows[]=['class'=>$class,'path'=>$file,'sha256'=>hash_file('sha256',$file),'staged'=>$staged];}file_put_contents(__DIR__.'/php-stage-loader-proof.json',json_encode(['success'=>!$bad,'loadedAppDefinitions'=>count($rows),'outsideStage'=>$bad,'files'=>$rows],JSON_PRETTY_PRINT));});
"""
# PHP single-quoted namespace literals need two backslashes in source.
bootstrap=bootstrap.replace("'App\\'","'App\\\\'").replace("'App\\Tests\\'","'App\\\\Tests\\\\'").replace("str_replace('\\','/'","str_replace('\\\\','/'")
(R/'php-stage-bootstrap.php').write_text(bootstrap,encoding='utf-8')
xml=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{(R/'php-stage-bootstrap.php').as_posix()}" cacheResult="false"><testsuites><testsuite name="NavigationFilterOnlyFull"><directory>D:/opencode/construtor-pg/backend/tests</directory><directory>{(D/'tests').as_posix()}</directory></testsuite></testsuites></phpunit>'''
(R/'phpunit.xml').write_text(xml,encoding='utf-8')
print(json.dumps({'phpSourceFiles':len(rows),'candidateOverlays':sum(x['candidate']for x in rows),'canonicalWrites':False}))
