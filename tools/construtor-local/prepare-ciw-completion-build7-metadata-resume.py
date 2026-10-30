"""Freeze bounded catalog resume: only four owned detail types then four new screens."""
from pathlib import Path
import hashlib
root=Path(__file__).resolve().parents[2]
source=root/'tools/construtor-local/publish-ciw-completion-build7-metadata.cjs'
assert hashlib.sha256(source.read_bytes()).hexdigest()=='97bd66dfa42f1186909cff715664d9cb220f608ae4c8e42aa861fac2c97c079d'
text=source.read_text(encoding='utf-8')
text=text.replace("c.assert.ok(!c.fs.existsSync(c.path.join(state,'metadata-publication-started.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');", "c.assert.ok(c.fs.existsSync(c.path.join(state,'metadata-publication-started.json'))&&!c.fs.existsSync(c.path.join(state,'metadata-resume-started.json'))&&!c.fs.existsSync(c.path.join(state,'metadata-publication.json')),'INSPECT_PARTIAL_BEFORE_REPLAY');")
text=text.replace("const additions=sourcePlan.operations.map(x=>x.value);", "const typeProof=c.readJson(c.path.join(state,'metadata-operation-type-correction.json'));c.assert.ok(typeProof.success&&typeProof.nativeNormalizer&&typeProof.checks===41);evidences.push({type:'native-operation-types41',result:'SHA256 '+c.sha(c.path.join(state,'metadata-operation-type-correction.json'))});const additions=typeProof.operations;")
text=text.replace("for(const key of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(source[key],baseline[key]);c.assert.equal(source.operations.length,132);", "const inspected=c.readJson(c.path.join(state,'metadata-source-after-inspected.json'));for(const key of ['code','baseUrl','responseContract','operations'])c.assert.deepEqual(source[key],inspected[key]);c.assert.equal(source.operations.length,140);for(const op of baseline.operations)c.assert.deepEqual(source.operations.find(x=>x.code===op.code),op);\n  for(const expected of additions){const actual=source.operations.find(x=>x.code===expected.code);c.assert.ok(c.compatibleOperation(actual,{...expected,type:expected.type==='detail'?'custom':expected.type},source.baseUrl),'ONLY_EXPECTED_NATIVE_TYPE_DIFF_ALLOWED');for(const key of ['itemsPath','itemPath','totalPath'])c.assert.equal(actual[key]??null,expected[key]??null);}")
text=text.replace("save('metadata-source-before.json',source);save('metadata-publication-started.json'", "save('metadata-source-before-resume.json',source);save('metadata-resume-started.json'")
text=text.replace("source132to140:true", "sourceAlready140:true,onlyFourNewCustomToDetail:true")
text=text.replace("source.operations=[...source.operations,...additions];await api('/api-sources',source);", "source.operations=source.operations.map(op=>additions.some(x=>x.code===op.code&&x.type==='detail')?{...op,type:'detail'}:op);await api('/api-sources',source);")
text=text.replace("for(const old of before.operations)c.assert.deepEqual", "for(const old of baseline.operations)c.assert.deepEqual")
text=text.replace("source132to140/oldops", "source140/fourdetailtypes/old132ops")
assert "source.operations=[...source.operations,...additions]"not in text
out=root/'tools/construtor-local/resume-ciw-completion-build7-metadata.cjs';assert not out.exists();out.write_text(text,encoding='utf-8')
print('Prepared bounded source140 resume;onlyfour new types custom=>detail;old132/auth preserved;native41 proof required')
