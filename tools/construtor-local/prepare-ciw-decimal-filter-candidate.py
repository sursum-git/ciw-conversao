"""Prepare the isolated Builder decimal-filter fix and real-generation regression."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parents[2]
base=root/'integration-src/ciw-completion-20261028/builder-decimal-filters'
base.mkdir(exist_ok=True)
assert not (base/'ProgramBuilderService.php').exists()
state=root/'.runtime/ciw-completion-20261028/builder-decimal-filters';state.mkdir(exist_ok=True)
canonical=Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php')
raw=canonical.read_bytes();digest=hashlib.sha256(raw).hexdigest()
assert digest.startswith('72c6'),digest
(state/'ProgramBuilderService-baseline.php').write_bytes(raw)
start=raw.index(b'                $filterCandidates[$code] = [')
end=raw.index(b'            ++$position;',start)
candidate=raw[start:end]
old=b"['boolean', 'enum', 'integer', 'date', 'datetime']"
new=b"['boolean', 'enum', 'integer', 'decimal', 'date', 'datetime']"
# Exactly two filter type checks and one candidate operator check.
assert candidate.count(old)==3
candidate=candidate.replace(old,new)
old=b"'operator' => in_array($dataType, ['boolean', 'enum', 'integer'], true) ? 'eq' : 'contains',"
new=b"'operator' => in_array($dataType, ['boolean', 'enum', 'integer', 'decimal'], true) ? 'eq' : 'contains',"
assert candidate.count(old)==1
candidate=candidate.replace(old,new)
candidate=raw[:start]+candidate+raw[end:]
(base/'ProgramBuilderService.php').write_bytes(candidate)
(base/'patch-manifest.json').write_text(json.dumps(dict(target=str(canonical),before=digest,after=hashlib.sha256(candidate).hexdigest(),changedMembershipChecks=4,canonicalChanged=False),indent=2)+'\n')
(base/'bootstrap.php').write_text('''<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$mode=getenv('CIW_DECIMAL_MODE');
if(!in_array($mode,['baseline','candidate'],true))throw new RuntimeException('Closed test mode required');
require $mode==='candidate'?__DIR__.'/ProgramBuilderService.php':'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters/ProgramBuilderService-baseline.php';
''')
original=Path('D:/opencode/construtor-pg/backend/tests/Builder/ProgramBuilderCrudOptionsTest.php').read_text()
method=original[original.index('    private function service()'):original.index('    private function payload()')]
method=method.replace("foreach (range(1, 20) as $index) {", "foreach (['decimal','integer','boolean','string','date','datetime','enum'] as $offset=>$type) {\n            $index=$offset+1;")
method=method.replace("->setDataType('integer')->setPrimaryKey($index === 1)","->setDataType($type)->setPrimaryKey($index === 2)")
header=original[:original.index('final class ProgramBuilderCrudOptionsTest')]
tests='''final class DecimalFilterGenerationTest extends TestCase
{
METHOD
    private function definition(bool $explicit): array
    {
        $payload=['programCode'=>'op1000','programTitle'=>'Consulta','module'=>'operacional','screenId'=>'ciw.consultas','builderEntityCode'=>'consultas','allowCreate'=>false,'allowUpdate'=>false,'allowDelete'=>false];
        if($explicit)$payload['crudOptions']=['filterFields'=>['field_1','field_2','field_3','field_4','field_5','field_6','field_7']];
        $definition=$this->service()->saveDraft($payload)['generatedDefinition'];
        $name=$explicit?'explicit':'default';
        file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters/'.getenv('CIW_DECIMAL_MODE').'-'.$name.'.json',json_encode($definition,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
        return $definition;
    }
    public function testDefaultDecimalFilterUsesNumericTypeAndEquality(): void
    {
        $d=$this->definition(false);$f=$d['crud']['filter']['fields'];
        self::assertSame('decimal',$f[0]['type']);self::assertSame('eq',$f[0]['operator']);
        self::assertSame('integer',$f[1]['type']);self::assertSame('eq',$f[1]['operator']);
        self::assertSame('boolean',$f[2]['type']);self::assertSame('eq',$f[2]['operator']);
        self::assertSame('text',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);
        self::assertSame('date',$f[4]['type']);self::assertSame('contains',$f[4]['operator']);
        self::assertCount(5,$f);
    }
    public function testExplicitDecimalFilterUsesNumericTypeAndEquality(): void
    {
        $d=$this->definition(true);$f=$d['crud']['filter']['fields'];
        self::assertSame('decimal',$f[0]['type']);self::assertSame('eq',$f[0]['operator']);
        foreach([1=>'integer',2=>'boolean',4=>'date',5=>'datetime',6=>'enum']as$i=>$type){self::assertSame($type,$f[$i]['type']);self::assertSame('eq',$f[$i]['operator']);}
        self::assertSame('text',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);
        self::assertCount(7,$f);
    }
}
'''.replace('METHOD',method)
(base/'DecimalFilterGenerationTest.php').write_text(header+tests)
print('Prepared isolated candidate: four membership additions; two real Builder regression cases; no canonical change')
