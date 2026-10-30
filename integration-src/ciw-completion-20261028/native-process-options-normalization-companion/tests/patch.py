import re,difflib
origin=source/'backend-stage/backend/src/Builder/ProgramBuilderService.php';target=Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php');before=origin.read_bytes();after=before;changes=[]
def patch(old,new):
 global after
 pattern=b'\r?\n'.join(re.escape(part.encode('utf-8'))for part in old.split('\n'));matches=list(re.finditer(pattern,after));assert len(matches)==1,old
 match=matches[0];a=match.group();newline=b'\r\n'if before.count(b'\r\n')>before.count(b'\n')/2 else b'\n';b=new.encode('utf-8').replace(b'\n',newline);after=after[:match.start()]+b+after[match.end():]
 changes.append({'old':a.decode('utf-8'),'new':b.decode('utf-8'),'oldBytesHex':a.hex(),'newBytesHex':b.hex(),'oldNormalized':old,'newNormalized':new})
patch('        $fields = [];\n        $hasPrimaryKey = false;\n        foreach ($rawFields as $index => $item) {','''        $dependentOptionParameters = [];
        if ($entityType === 'api') {
            foreach ($rawFields as $rawField) {
                $lookup = is_array($rawField) ? ($rawField['options']['api']['optionsSource'] ?? null) : null;
                if (is_array($lookup) && array_key_exists('parameterFields', $lookup)) {
                    $lookup = $this->normalizeApiOptionsSource($lookup);
                    foreach ($lookup['parameterFields'] as $parameterName) { $dependentOptionParameters[$parameterName] = true; }
                }
            }
        }
        $fields = [];
        $hasPrimaryKey = false;
        foreach ($rawFields as $index => $item) {''')
patch("            $optionItems = $this->normalizeOptionItems($item['optionItems'] ?? ($options['options'] ?? null), $dataType);","""            $rawOptionItems = $item['optionItems'] ?? ($options['options'] ?? null);
            $optionItems = isset($dependentOptionParameters[$fieldCode]) && $dataType === 'string' && ($options['editor'] ?? null) === 'dropdown'
                ? $this->normalizeApiOptionsParameterItems($rawOptionItems)
                : $this->normalizeOptionItems($rawOptionItems, $dataType);""")
patch("            $options=$parameter?->getOptions() ?? []; $values=$options['options'] ?? null;\n            if (!$parameter || $parameter->getDataType()!=='string' || ($options['editor']??null)!=='dropdown' || ($options['readonly']??false) || !is_array($values) || !array_is_list($values) || !$values || count($values)>20) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametro exige enum escalar fechado.',422); }\n            $seen=[];foreach($values as $option) { if (!is_array($option) || array_diff(array_keys($option),['value','text']) || !is_string($option['value']??null) || !is_string($option['text']??null) || isset($seen[$option['value']])) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Enum de opcoes invalido.',422); } $seen[$option['value']]=true; }","""            $options=$parameter?->getOptions() ?? [];
            if (!$parameter || $parameter->getDataType()!=='string' || ($options['editor']??null)!=='dropdown' || ($options['readonly']??false)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametro exige enum escalar fechado.',422); }
            $this->normalizeApiOptionsParameterItems($options['options'] ?? null);""")
patch('    private function normalizeOptionItems(mixed $value, string $dataType): array','''    private function normalizeApiOptionsParameterItems(mixed $value): array
    {
        if (!is_array($value) || !array_is_list($value) || !$value || count($value) > 20) {
            throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametro exige enum escalar fechado.',422);
        }
        $seen = [];
        foreach ($value as $option) {
            if (!is_array($option) || array_diff(array_keys($option), ['value','text']) || !is_string($option['value'] ?? null) || !is_string($option['text'] ?? null) || isset($seen[$option['value']])) {
                throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Enum de opcoes invalido.',422);
            }
            $seen[$option['value']] = true;
        }
        return $value;
    }

    private function normalizeOptionItems(mixed $value, string $dataType): array''')
out=stage/'backend/src/Builder/ProgramBuilderService.php';out.write_bytes(after);patches=root/'patches';patches.mkdir(exist_ok=True)
(patches/'ProgramBuilderService.php.patch').write_text(''.join(difflib.unified_diff(before.decode('utf-8-sig').splitlines(True),after.decode('utf-8-sig').splitlines(True),fromfile=target.as_posix(),tofile=target.as_posix())),encoding='utf-8',newline='')
(patches/'patch-plan.json').write_text(json.dumps({'target':target.as_posix(),'baselineOrigin':origin.as_posix(),'baselineIsFutureComposed8':True,'baselineSha256':hashlib.sha256(before).hexdigest(),'candidateRuntimePath':out.as_posix(),'candidateSha256':hashlib.sha256(after).hexdigest(),'applyMode':'byte-exact-sequential-anchors','requires1047ManifestSha256':'ed0cc7a801afe2e75d086d61a94972f6d6102514595f3a049689989619631dee','changes':changes},indent=2)+'\n',encoding='utf-8')
