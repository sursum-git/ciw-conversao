from pathlib import Path
import hashlib,json,difflib
root=Path(__file__).resolve().parents[1];repo=Path('D:/opencode/construtor-pg');state=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/native');plans=[]
def patch(name,changes):
 p=repo/name;before=p.read_text(encoding='utf-8-sig');after=before
 for old,new in changes:
  assert after.count(old)==1,(name,old);after=after.replace(old,new)
 dest=state/name;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_text(after,encoding='utf-8')
 out=root/'patches/native-lookup-parameters';out.mkdir(parents=True,exist_ok=True);(out/(p.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(p),tofile=str(p))),encoding='utf-8')
 plans.append({'target':p.as_posix(),'baselineSha256':hashlib.sha256(p.read_bytes()).hexdigest(),'changes':[{'old':a,'new':b}for a,b in changes]})
patch('backend/src/Builder/ProgramBuilderService.php',[
 ("['operationCode', 'valueField', 'textField', 'excludeCurrent', 'copyFields'], 'optionsSource'","['operationCode', 'valueField', 'textField', 'excludeCurrent', 'copyFields', 'parameterFields'], 'optionsSource'"),
 ('        return $value;\n    }\n\n    private function validateApiOptionsOperation', '''        if (array_key_exists('parameterFields',$value)) {
            $names=$value['parameterFields'];
            if (!is_array($names) || !array_is_list($names) || !$names || count($names)>2 || count(array_unique($names,SORT_REGULAR))!==count($names)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametros de opcoes invalidos.',422); }
            foreach($names as $name) { if (!is_string($name) || !preg_match('/^[a-z][a-z0-9_]*$/D',$name) || in_array($name,['context','operation','resource','parameters'],true)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametro de opcoes invalido.',422); } }
        }
        return $value;
    }

    private function validateApiOptionsOperation'''),
 ("        foreach ($source['copyFields'] ?? [] as $target => $path) {",'''        foreach ($source['parameterFields'] ?? [] as $name) {
            $parameter=null;foreach($entity->getFields() as $field) { if ($field->getCode()===$name) { $parameter=$field; } }
            $options=$parameter?->getOptions() ?? []; $values=$options['options'] ?? null;
            if (!$parameter || $parameter->getDataType()!=='string' || ($options['editor']??null)!=='dropdown' || ($options['readonly']??false) || !is_array($values) || !array_is_list($values) || !$values || count($values)>20) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Parametro exige enum escalar fechado.',422); }
            $seen=[];foreach($values as $option) { if (!is_array($option) || array_diff(array_keys($option),['value','text']) || !is_string($option['value']??null) || !is_string($option['text']??null) || isset($seen[$option['value']])) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PARAMETERS','Enum de opcoes invalido.',422); } $seen[$option['value']]=true; }
        }
        foreach ($source['copyFields'] ?? [] as $target => $path) {'''),
 ("                if (!$lookup || !\\App\\Runtime\\RuntimeProcessLookupPolicy::allows($lookup, array_column(is_array($contexts) ? $contexts : [], 'field'))) { $fail(); }","                if (!$lookup || !\\App\\Runtime\\RuntimeProcessLookupPolicy::allows($lookup, array_column(is_array($contexts) ? $contexts : [], 'field'))) { $fail(); }\n                foreach ($source['parameterFields'] ?? [] as $dependency) { if (!in_array($dependency,$value['parameterFields'],true)) { $fail(); } }"),
 ("                if (($apiField['optionsSource']['excludeCurrent'] ?? false) === true) { $fields[$code]['optionsSource']['excludeCurrent'] = true; }","                if (($apiField['optionsSource']['excludeCurrent'] ?? false) === true) { $fields[$code]['optionsSource']['excludeCurrent'] = true; }\n                if (isset($apiField['optionsSource']['parameterFields'])) { $fields[$code]['optionsSource']['parameterFields']=$apiField['optionsSource']['parameterFields']; }"),
 ("        $crud = $this->generateCrudDefinition($config);\n        $contextCodes", "        $crud = $this->generateCrudDefinition($config);\n        $lookupParameters=[];foreach($config['_entity']->getFields() as $field) { $lookupParameters=array_merge($lookupParameters,$field->getOptions()['api']['optionsSource']['parameterFields'] ?? []); }\n        $contextCodes"),
 ("'label' => $field['label'], 'type' => $field['type'],\n                'required'", "'label' => $field['label'], 'type' => in_array($name,$lookupParameters,true) ? 'dropdown' : $field['type'],\n                'required'"),
 ("        $existingProgram = $this->programs->findOneBy(['code' => $programCode]);", "        $this->assertApiOptionsPageType($pageType, $entity);\n        $existingProgram = $this->programs->findOneBy(['code' => $programCode]);"),
 ("        $grant = null;\n        try {", "        $this->assertApiOptionsPageType($version->getPageType(), null, $version->getGeneratedDefinition());\n        $grant = null;\n        try {"),
 ("    private function endpointConfig(BuilderProgramVersion $version, string $endpointId, string $handler): array",'''    private function assertApiOptionsPageType(string $pageType, ?BuilderEntity $entity = null, array $definition = []): void
    {
        if ($pageType === 'process') { return; }
        $fail = static function (): never { throw new RuntimeHttpException('ENTITY_API_OPTIONS_PROCESS_ONLY','Opcoes dependentes sao permitidas somente em paginas de processo.',422); };
        foreach ($entity?->getFields() ?? [] as $field) {
            $source = $field->getOptions()['api']['optionsSource'] ?? null;
            if (is_array($source) && array_key_exists('parameterFields',$source)) { $fail(); }
        }
        $pending = [$definition];
        while ($pending) {
            $node = array_pop($pending);
            if (is_array($node['optionsSource'] ?? null) && array_key_exists('parameterFields',$node['optionsSource'])) { $fail(); }
            foreach ($node as $value) { if (is_array($value)) { $pending[] = $value; } }
        }
    }

    private function processLookupParameterConfig(BuilderProgramVersion $version,string $endpointId):array
    {
        if ($version->getPageType()!=='process' || !str_starts_with($endpointId,'options.')) { return []; }
        $entity=$this->entities->findOneBy(['code'=>$version->getBuilderEntityCode()]);
        foreach($entity?->getFields() ?? [] as $field) { if ($field->getCode()===substr($endpointId,8) && isset($field->getOptions()['api']['optionsSource']['parameterFields'])) { return ['lookupParameterFields'=>$field->getOptions()['api']['optionsSource']['parameterFields']]; } }
        return [];
    }

    private function endpointConfig(BuilderProgramVersion $version, string $endpointId, string $handler): array'''),
 ("                'fieldCode' => str_starts_with($endpointId, 'options.') ? substr($endpointId, 8) : null,", "                ...$this->processLookupParameterConfig($version,$endpointId),\n                'fieldCode' => str_starts_with($endpointId, 'options.') ? substr($endpointId, 8) : null,")
])
patch('src/process-engine/ProcessDefinitionValidator.js',[
 ("Object.keys(field.optionsSource).some(key=>key!=='endpointId')", "Object.keys(field.optionsSource).some(key=>!['endpointId','parameterFields'].includes(key))"),
 ("        if (field.required != null && typeof field.required !== \"boolean\") {",'''        if (field.optionsSource && field.optionsSource.parameterFields != null) {
          const names=field.optionsSource.parameterFields;
          if (!Array.isArray(names) || !names.length || names.length>2 || new Set(names).size!==names.length || names.some(name=>{
            const parameter=fields.find(value=>(value.field || value.name || value.id)===name);
            return typeof name!=='string' || !parameter || name===(field.field || field.name || field.id) || parameter.type!=='dropdown' || parameter.readonly || !Array.isArray(parameter.options) || !parameter.options.length || parameter.options.some(option=>!option || typeof option.value!=='string' || typeof option.text!=='string');
          })) { errors.push(label+'.parametros de opcoes exigem enums fechados.'); }
        }
        if (field.required != null && typeof field.required !== "boolean") {''')
])
patch('src/process-engine/ProcessEngine.js',[
 ('      this.optionsPromise=this.loadParameterOptions();','      this.bindLookupParameterChanges();\n      this.optionsPromise=this.loadParameterOptions();'),
 ('    loadParameterOptions() {','''    bindLookupParameterChanges() {
      const fields=global.CrudUtils.ensureArray(this.definition.process.parameters.fields);
      const names=new Set();fields.forEach(field=>(field.optionsSource && field.optionsSource.parameterFields || []).forEach(name=>names.add(name)));
      names.forEach(name=>{const widget=this.fieldWidgets[name];if(widget){widget.bind('change',()=>{this.optionsPromise=this.loadParameterOptions();});}});
    }

    lookupParametersMatch(parameters) {
      const fields=global.CrudUtils.ensureArray(this.definition.process.parameters.fields);
      for(const field of fields) {
        const names=field.optionsSource && field.optionsSource.parameterFields;if(!names){continue;}
        if(this.optionsLoading || this.optionsFailed){return false;}
        const confirmed=this.lookupParameterValues && this.lookupParameterValues[field.field || field.name || field.id];
        if(!confirmed){return false;}
        for(const name of names) {
          const parameter=fields.find(item=>(item.field || item.name || item.id)===name);
          if(parameters[name]!==confirmed[name] || this.getFieldValue(this.normalizeField(parameter))!==confirmed[name]){return false;}
        }
      }
      return true;
    }

    loadParameterOptions() {'''),
 ("        return Promise.resolve(this.httpClient.request({url:endpoint.url,method:'POST',data:{context:Object.assign({},this.contextValues)}})).then(response=>{",'''        const requestData={context:Object.assign({},this.contextValues)};
        if(source.parameterFields) {
          requestData.parameters={};
          try { source.parameterFields.forEach(name=>{const parameter=this.definition.process.parameters.fields.find(item=>(item.field || item.name || item.id)===name),value=this.getFieldValue(this.normalizeField(parameter));if(!parameter.options.some(option=>option.value===value)){throw global.CrudUtils.makeError('PROCESS_OPTIONS_INVALID','Parametro fora do enum.');}requestData.parameters[name]=value;}); }
          catch(error) { return Promise.reject(error); }
        }
        return Promise.resolve(this.httpClient.request({url:endpoint.url,method:'POST',data:requestData})).then(response=>{'''),
 ('          widget.dataSource.data(data);widget.enable(!field.readonly);', '''          if(source.parameterFields){
            const previous=widget.value();widget.dataSource.data(data);widget.value(previous.filter(id=>ids.has(Number(id))));
            this.lookupParameterValues=this.lookupParameterValues || {};this.lookupParameterValues[field.field || field.name || field.id]=Object.assign({},requestData.parameters);
          }else{widget.dataSource.data(data);}
          widget.enable(!field.readonly);'''),
 ('    sendProcessRequest(endpoint, parameters) {\n      if (this.destroyed || this.isProcessing)', '    sendProcessRequest(endpoint, parameters) {\n      if (!this.lookupParametersMatch(parameters.values)) {return Promise.resolve(false);}\n      if (this.destroyed || this.isProcessing)')
])
out=root/'patches/native-lookup-parameters/patch-plan.json';out.write_text(json.dumps({'textPatches':plans},indent=2),encoding='utf-8');print('Prepared native dependent lookup opt-in patches on post1042 baselines')
