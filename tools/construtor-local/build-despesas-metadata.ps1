$ErrorActionPreference='Stop'
$root=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\integration-src\despesas'))
$source=@{code='motor_progress_despesas';name='Motor Progress — Despesas';providerType='generic';responseContract='sursum-programs';authMode='header_static';baseUrl='http://127.0.0.1:19910/med/web';status='active';timeoutSeconds=25;authHeaders=@{'X-Despesas-Token'='__RUNTIME_SECRET__'};operations=@()}
foreach($resource in @('despesas','empresas_despesa')){
 foreach($operation in @('read','get','create','update','delete')){
  $type=@{read='list';get='detail';create='create';update='update';delete='delete'}[$operation]
  $op=@{code=($resource+'_'+$operation);name=($resource+' '+$operation);type=$type;method='POST';path='/SursumPrograms/despesas';bodyTemplate=@{resource=$resource;operation=$operation}}
  if($operation -eq 'read'){$op.itemsPath='data'}elseif($operation -ne 'delete'){$op.itemPath='data'}
  $source.operations+= $op
 }
}
foreach($code in @('opcoes_despesas','opcoes_impostos','opcoes_empresas','opcoes_custo')){
 $source.operations+=@{code=$code;name=$code;type='custom';method='POST';path='/SursumPrograms/despesas';bodyTemplate=@{resource='despesas';operation=$code};itemsPath='data'}
}
$source|ConvertTo-Json -Depth 25|Set-Content (Join-Path $root 'api-source.json') -Encoding utf8
function Field($code,$label,$type,$pos,$grid=$false,$filter=$false,$form=$true,$readonly=$false,$options=@{}){
 $f=@{code=$code;label=$label;dataType=$type;position=$pos;required=$false;apiJsonPath=$code;apiWritePath=$code;apiShowInGrid=$grid;apiShowInFilter=$filter;apiShowInForm=$form;options=$options}
 if($readonly){$f.readonlyField=$true;$f.options.readonly=$true;$f.options.writable=$false}
 return $f
}
function Source($op,$value,$text,$exclude=$false){return @{operationCode=$op;valueField=$value;textField=$text;excludeCurrent=$exclude}}
function Flag($default=0){return @{editor='dropdown';defaultValue=$default;options=@(@{value=0;text='Não'},@{value=1;text='Sim'})}}
function Entity($code,$name,$num,$resource){return @{code=$code;name=$name;entityType='api';structureModuleCode='cadastros';structureType='main';structureBaseNumber=$num;createPhysicalTable=$false;apiSourceCode='motor_progress_despesas';apiListOperationCode=($resource+'_read');apiDetailOperationCode=($resource+'_get');apiCreateOperationCode=($resource+'_create');apiUpdateOperationCode=($resource+'_update');apiDeleteOperationCode=($resource+'_delete');fields=@()}}
function Program($code,$title,$entity,$screen){return @{programCode=$code;programTitle=$title;module='cadastros';builderEntityCode=$entity;pageType='crud';gridEditMode='form';screenId=$screen;version='1.0.1';programOrigin='standard';ownerScope='system';allowCreate=$true;allowUpdate=$true;allowDelete=$true;permissionPrefix=$entity}}
$d=Entity 'despesas_progress' 'Despesas' 92 'despesas'
$id=Field 'despesa_id' 'ID' 'integer' 10 $true $true $true $true;$id.primaryKey=$true;$d.fields+=$id
$f=Field 'descricao' 'Descrição' 'string' 20 $true $true;$f.length=100;$f.options.defaultValue='';$d.fields+=$f
$d.fields+=Field 'log_imposto' 'Imposto?' 'integer' 30 $true $true $true $false (Flag)
$d.fields+=Field 'ordem' 'Ordem' 'integer' 40 $false $false $true $false @{defaultValue=0;min=0;max=9999}
$d.fields+=Field 'log_calculada' 'Calculada?' 'boolean' 50 $false $true $true $false @{defaultValue=$false}
$calc=@{field='log_calculada';operator='eq';value=$true}
# _Decimals=2 no dicionário real; o formato de exibição legado mostra 4.
$f=Field 'perc_calculo' '% Cálculo' 'decimal' 60 $false $false $true $false @{defaultValue=0;visibleWhen=$calc;min=0};$f.precision=17;$f.scale=2;$d.fields+=$f
$d.fields+=Field 'log_vl_prod_base_calculo' 'Valor do produto na base de cálculo?' 'boolean' 70 $false $false $true $false @{defaultValue=$false;visibleWhen=$calc}
$d.fields+=Field 'log_calc_por_item' 'Calculada por item?' 'boolean' 80 $false $false $true $false @{defaultValue=$false}
$d.fields+=Field 'ind_imposto' 'Imposto' 'integer' 90 $false $false $true $false @{editor='dropdown';defaultValue=0;options=@(@{value=0;text='Não informado'},@{value=1;text='II'},@{value=2;text='ICMS'},@{value=3;text='IPI'},@{value=4;text='PIS'},@{value=5;text='COFINS'})}
$d.fields+=Field 'md_relacs_desp' 'Despesas da base de cálculo' 'json' 100 $false $false $true $false @{editor='multiselect';defaultValue=@();visibleWhen=$calc;api=@{collection=@{itemType='integer'};optionsSource=(Source 'opcoes_despesas' 'despesa_id' 'descricao' $true)}}
$p=Program 'cd0092' 'Despesas' 'despesas_progress' 'ciw.despesas'
$p.subtitle='Cadastro de despesas e bases de cálculo'
$p.rowLinks=@(@{id='empresas';label='Empresas';screenId='ciw.empresas-despesa';parameters=@(@{field='despesa_id';sourceField='despesa_id'})})
$draft=@{entityDraft=$d;programDraft=$p}
New-Item -ItemType Directory -Path (Join-Path $root 'despesas') -Force|Out-Null
$draft|ConvertTo-Json -Depth 35|Set-Content (Join-Path $root 'despesas\builder-draft.json') -Encoding utf8
$d=Entity 'empresas_despesa_progress' 'Empresas por despesa' 93 'empresas_despesa'
$id=Field 'empresa_despesa_id' 'ID' 'integer' 10 $false $false $true $true;$id.primaryKey=$true;$d.fields+=$id
$d.fields+=Field 'empresa_nome' 'Empresa' 'string' 20 $true $true $false $true
$d.fields+=Field 'codigo_desp_erp' 'Código despesa ERP' 'integer' 30 $true $true $true $false @{defaultValue=0;min=0}
$d.fields+=Field 'log_ativo' 'Ativo?' 'integer' 40 $true $true $true $false (Flag)
$noTax=@{field='eh_imposto';operator='eq';value=$false};$tax=@{field='eh_imposto';operator='eq';value=$true}
$f=Field 'vl_padrao' 'Valor padrão' 'decimal' 50 $true $false $true $false @{defaultValue=0;enabledWhen=$noTax;min=0};$f.precision=10;$f.scale=2;$d.fields+=$f
$f=Field 'percentual' 'Percentual' 'decimal' 60 $true $false $true $false @{defaultValue=0;enabledWhen=$tax;min=0};$f.precision=8;$f.scale=2;$d.fields+=$f
$f=Field 'cod_nat_operacao' 'Natureza de operação' 'string' 70 $true $false $true $false @{defaultValue='';enabledWhen=$tax};$f.length=12;$d.fields+=$f
$parentOptions=Source 'opcoes_despesas' 'despesa_id' 'descricao';$parentOptions.copyFields=@{eh_imposto='log_imposto'}
$d.fields+=Field 'despesa_id' 'Despesa' 'integer' 80 $false $true $true $false @{editor='dropdown';api=@{optionsSource=$parentOptions}}
$d.fields+=Field 'empresa_id' 'Empresa' 'integer' 90 $false $false $true $false @{editor='dropdown';readonlyOnEdit=$true;api=@{optionsSource=(Source 'opcoes_empresas' 'empresa_id' 'nome')}}
$d.fields+=Field 'log_custo' 'Considera no custo?' 'integer' 100 $false $false $true $false (Flag)
$f=Field 'percentual_custo' '% Custo' 'decimal' 110 $false $false $true $false @{defaultValue=0;enabledWhen=$tax;min=0};$f.precision=8;$f.scale=4;$d.fields+=$f
$d.fields+=Field 'despesa_custo_id' 'Despesa de custo' 'integer' 120 $false $false $true $false @{editor='dropdown';defaultValue=0;enabledWhen=$tax;api=@{optionsSource=(Source 'opcoes_custo' 'despesa_id' 'descricao')}}
$d.fields+=Field 'impostos' 'Impostos que usam esta despesa na base' 'json' 130 $false $false $true $false @{editor='multiselect';defaultValue=@();api=@{collection=@{itemType='integer'};optionsSource=(Source 'opcoes_impostos' 'despesa_id' 'descricao' $true)}}
$d.fields+=Field 'perc_custo' 'Percentual legado' 'integer' 140 $false $false $false $true
$d.fields+=Field 'descricao_despesa' 'Descrição da despesa' 'string' 150 $false $false $false $true
$d.fields+=Field 'eh_imposto' 'É imposto' 'boolean' 160 $false $false $false $true
$p=Program 'cd0093' 'Empresas por despesa' 'empresas_despesa_progress' 'ciw.empresas-despesa'
$p.subtitle='Configuração da despesa por empresa'
$p.contextFields=@(@{field='despesa_id';filter=$true;createDefault=$true;readonly=$true;required=$true})
$draft=@{entityDraft=$d;programDraft=$p}
New-Item -ItemType Directory -Path (Join-Path $root 'empresas-despesa') -Force|Out-Null
$draft|ConvertTo-Json -Depth 35|Set-Content (Join-Path $root 'empresas-despesa\builder-draft.json') -Encoding utf8
Write-Output 'JSONs gerados sem credenciais; validar via builder antes de publicar.'



