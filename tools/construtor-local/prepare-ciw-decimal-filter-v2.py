"""Retain numeric data models; fix only filter typing before the native renderer."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parents[2]
oldbase=root/'integration-src/ciw-completion-20261028/builder-decimal-filters'
base=root/'integration-src/ciw-completion-20261028/builder-decimal-filters-v2';base.mkdir()
state=root/'.runtime/ciw-completion-20261028/builder-decimal-filters-v2';state.mkdir()
canonical=Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php')
raw=canonical.read_bytes();assert hashlib.sha256(raw).hexdigest().startswith('72c6')
(state/'ProgramBuilderService-baseline.php').write_bytes(raw)
start=raw.index(b'                $filterCandidates[$code] = [')
end=raw.index(b'            ++$position;',start)
block=raw[start:end]
lines=block.splitlines(keepends=True);changed=0
for i,line in enumerate(lines):
 if b"'type' => in_array($dataType," in line or b"'operator' => in_array($dataType," in line:
  line=line.replace(b"'integer'",b"'integer', 'decimal'")
  line=line.replace(b'$dataType',b'$filterDataType');lines[i]=line;changed+=1
assert changed==4
eol=b'\r\n' if b'\r\n' in raw else b'\n'
assignment=b"                $filterDataType = $field->getDataType() === 'decimal' ? 'decimal' : $dataType;"+eol
candidate=raw[:start]+assignment+b''.join(lines)+raw[end:]
(base/'ProgramBuilderService.php').write_bytes(candidate)
for name in ['bootstrap.php','DecimalFilterGenerationTest.php']:
 text=(oldbase/name).read_text().replace('builder-decimal-filters/','builder-decimal-filters-v2/')
 if name.endswith('Test.php'):
  text=text.replace("'programTitle'=>'Consulta','module'", "'programTitle'=>'Consulta','subtitle'=>'Regressao de filtros numericos','module'")
  text=text.replace("self::assertSame('text',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);\n        self::assertSame('date',$f[4]['type']);self::assertSame('contains',$f[4]['operator']);", "self::assertSame('date',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);\n        self::assertSame('datetime',$f[4]['type']);self::assertSame('contains',$f[4]['operator']);")
 (base/name).write_text(text)
(base/'patch-manifest.json').write_text(json.dumps(dict(target=str(canonical),before=hashlib.sha256(raw).hexdigest(),after=hashlib.sha256(candidate).hexdigest(),scope='two CRUD filter paths only; preserve normalized number data model; one local filterDataType variable and four checks',canonicalChanged=False),indent=2)+'\n')
print('Prepared v2 filter-only candidate; numeric data model unchanged; no canonical changes')
