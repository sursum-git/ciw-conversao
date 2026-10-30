$ErrorActionPreference='Stop'
$root=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..'))
$ciw=[IO.File]::ReadAllText((Join-Path $root 'sources\scriptcase\shared\form_im_param_apl.php'))
$start=$ciw.IndexOf('function buscarParametroIma(')
$end=$ciw.IndexOf('function util_incr_valor(', $start)
$ciw=$ciw.Substring($start,$end-$start)
$portal=[IO.File]::ReadAllText('D:\opencode\portal_sc\cons_wp_ped_venda_resumo_q_cliente.class.php')
$methods=@{}
$pattern='(?s)/\*----- Scriptcase Locale: PHP Method: parametros_ima\.php => function (\w+) ------\*/(.*?)/\*----- END - Scriptcase Locale: PHP Method: parametros_ima\.php => function \1 ------\*/'
foreach($match in [regex]::Matches($portal,$pattern)){$methods[$match.Groups[1].Value]=$match.Groups[2].Value}
$matches=[regex]::Matches($ciw,'function\s+(\w+)\s*\(')
for($i=0;$i -lt $matches.Count;$i++){
    $offset=$matches[$i].Index
    $length=if($i+1 -lt $matches.Count){$matches[$i+1].Index-$offset}else{$ciw.Length-$offset}
    $methods[$matches[$i].Groups[1].Value]=$ciw.Substring($offset,$length)
}
$include=[IO.File]::ReadAllText((Join-Path $root 'integration-src\parametros-ima\parametros_ima.i'))
$implemented=@([regex]::Matches($include,'(?im)^FUNCTION\s+(\w+)')|ForEach-Object{$_.Groups[1].Value})
$excluded=@('atualizarParametros','setParamsSessao','getNomeVarParams')
$missing=@($methods.Keys|Where-Object{$_ -notin $excluded -and $_ -notin $implemented})
if($missing.Count){throw ('Funcoes ausentes: '+($missing -join ', '))}
$catalog=Get-Content -LiteralPath (Join-Path $root 'integration-src\parametros-ima\funcoes-parametros.json') -Raw|ConvertFrom-Json -NoEnumerate
foreach($entry in $catalog){
    $name=[string]$entry[0];$code=[string]$entry[1];$default=[string]$entry[2]
    if(!$methods.ContainsKey($name)){throw ('Funcao sem origem PHP: '+$name)}
    $body=$methods[$name]
    $assigned=[regex]::Match($body, '\$parametro\s*=\s*([''"][^''"]+[''"])')
    if($assigned.Success){$body=$body.Replace('$parametro',$assigned.Groups[1].Value)}
    $call=[regex]::Match($body, 'buscarParametroIma\(\s*[''"]([^''"]+)[''"]\s*(?:,\s*(''[^'']*''|"[^"]*"|[0-9]+))?')
    if(!$call.Success -or $call.Groups[1].Value -cne $code){throw ('Chave divergente da origem PHP: '+$name)}
    if($entry.Count -gt 3 -and $entry[3] -in @('secret','blank-zero')){continue}
    $phpDefault=$call.Groups[2].Value.Trim('''','"')
    if($phpDefault -cne $default){throw ('Padrao divergente da origem PHP: '+$name)}
}
"PASS: $($implemented.Count) funcoes ABL; $($methods.Count-$excluded.Count) funcoes PHP pertinentes cobertas; $($catalog.Count) chaves/padroes simples conferidos contra o PHP; 3 rotinas de cache excluidas."
