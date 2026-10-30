from pathlib import Path
import hashlib,json,shutil,sys
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/native-process-options-normalization-companion';state.mkdir(parents=True,exist_ok=True)
source=w/'.runtime/ciw-completion-20261028/official-build8';red='--red'in sys.argv;stage=state/('red'if red else'local');stage.mkdir(parents=True,exist_ok=True)
baseline=source/'backend-stage/backend/src/Builder/ProgramBuilderService.php';snapshot=state/'baseline-ProgramBuilderService.php'
if snapshot.exists():assert snapshot.read_bytes()==baseline.read_bytes(),'Builder8 moved; explicit rebase required'
else:snapshot.write_bytes(baseline.read_bytes())
for name in ['CombinedMetadataTest.php']:shutil.copy2(source/name,stage/name)
shutil.copytree(source/'metadata',stage/'metadata',dirs_exist_ok=True)
shutil.copytree(source/'backend-stage/backend/src',stage/'backend/src',dirs_exist_ok=True)
bootstrap="""<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class):void { if(str_starts_with($class,'App\\\\')) { $file=__DIR__.'/backend/src/'.str_replace('\\\\','/',substr($class,4)).'.php';if(is_file($file))require $file;} },true,true);
"""
(stage/'bootstrap.php').write_text(bootstrap,encoding='utf-8')
# RED uses the exact frozen/composed Builder. GREEN is patched separately by bytes.
if not red:exec((root/'tests/patch.py').read_text(encoding='utf-8'))
print('Prepared isolated '+('RED'if red else'GREEN')+' normalized entity draft inputs; stage8 untouched')
