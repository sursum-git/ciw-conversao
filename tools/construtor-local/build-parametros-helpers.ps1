# Gera wrappers ABL a partir do mapeamento revisado das bibliotecas PHP.
$ErrorActionPreference='Stop'
$root=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..'))
$directory=Join-Path $root 'integration-src\parametros-ima'
$catalog=Get-Content -LiteralPath (Join-Path $directory 'funcoes-parametros.json') -Raw|ConvertFrom-Json -NoEnumerate
function AblString([string]$value){'"'+$value.Replace('~','~~').Replace('"','~"')+'"'}
$path=Join-Path $directory 'parametros_ima.i'
$source=Get-Content -LiteralPath $path -Raw
$source=($source -split '/\* AUXILIARES PARAMETROS IMA')[0]
$source=($source -replace '\s*&ENDIF\s*$','').TrimEnd()
$builder=[Text.StringBuilder]::new()
$null=$builder.AppendLine($source)
$null=$builder.AppendLine('/* AUXILIARES PARAMETROS IMA - retorno CHARACTER, leitura sem cache. */')
foreach($entry in $catalog){
    $name=[string]$entry[0];$code=[string]$entry[1];$default=[string]$entry[2]
    $null=$builder.AppendLine("FUNCTION $name RETURNS CHARACTER ():")
    if($entry.Count -gt 3 -and $entry[3] -eq 'secret'){
        $null=$builder.AppendLine('    /* Credencial deve estar configurada em im-param; sem senha padrao no fonte. */')
    }
    if($entry.Count -gt 3 -and $entry[3] -eq 'blank-zero'){
        $null=$builder.AppendLine('    DEFINE VARIABLE cValor AS CHARACTER NO-UNDO.')
        $null=$builder.AppendLine(('    cValor = buscarParametroIma('+ (AblString $code) +', "").'))
        $null=$builder.AppendLine('    IF LENGTH(cValor) = 0 THEN RETURN "0".')
        $null=$builder.AppendLine('    RETURN cValor.')
    }else{
        $null=$builder.AppendLine(('    RETURN buscarParametroIma('+(AblString $code)+', '+(AblString $default)+').'))
    }
    $null=$builder.AppendLine('END FUNCTION.')
    $null=$builder.AppendLine()
}
$special=@'
/* Grupos do usuario devem ser fornecidos pelo backend autenticado.
   Mantem a regra de strstr(listaGrupos, "2") da biblioteca PHP. */
FUNCTION getMinutosVenctoPe RETURNS CHARACTER (INPUT pcGrupos AS CHARACTER):
    IF pcGrupos <> ? AND INDEX(pcGrupos, "2") > 0 THEN
        RETURN buscarParametroIma("PORTAL_MINUTOS_DESALOCAR_PE_LOJA", "").
    RETURN buscarParametroIma("PORTAL_MINUTOS_DESALOCAR_PE", "").
END FUNCTION.

FUNCTION getVlMinFreteCIFSudeste RETURNS CHARACTER (INPUT pcMoeda AS CHARACTER):
    DEFINE VARIABLE cMoeda AS CHARACTER CASE-SENSITIVE NO-UNDO.
    cMoeda = pcMoeda.
    IF cMoeda = "1" OR cMoeda = "real" THEN
        RETURN buscarParametroIma("vl_min_cif_sudeste", "1500").
    RETURN buscarParametroIma("vl_min_cif_sudeste_dolar", "300").
END FUNCTION.

FUNCTION getVlMinFreteCIF RETURNS CHARACTER (INPUT pcMoeda AS CHARACTER):
    DEFINE VARIABLE cMoeda AS CHARACTER CASE-SENSITIVE NO-UNDO.
    cMoeda = pcMoeda.
    IF cMoeda = "1" OR cMoeda = "real" THEN
        RETURN buscarParametroIma("vl_min_cif", "2500").
    RETURN buscarParametroIma("vl_min_cif_dolar", "600").
END FUNCTION.

FUNCTION getAprovGerenciaPedWeb RETURNS CHARACTER (INPUT pcTipoPed AS CHARACTER):
    DEFINE VARIABLE cTipoPed AS CHARACTER CASE-SENSITIVE NO-UNDO.
    cTipoPed = pcTipoPed.
    IF cTipoPed = "pe" THEN RETURN getAprovGerenciaPedWebPe().
    RETURN getAprovGerenciaPedWebPi().
END FUNCTION.

/* Raiz web explicita para o backend ABL; nao inferir pelo diretorio PASOE. */
FUNCTION getDirRaizWeb RETURNS CHARACTER ():
    RETURN buscarParametroIma("diretorio_raiz_web", "/var/www/clients/client1/web2/web").
END FUNCTION.

FUNCTION getDirAnexosEmail RETURNS CHARACTER (INPUT pcEstab AS CHARACTER):
    RETURN buscarParametroIma("dir_anexo_email_" + pcEstab, RIGHT-TRIM(getDirRaizWeb(), "/") + "/dfe").
END FUNCTION.

FUNCTION getDirRelAnexosEmail RETURNS CHARACTER (INPUT pcEstab AS CHARACTER):
    RETURN buscarParametroIma("dir_rel_anexo_email_" + pcEstab, "../../dfe").
END FUNCTION.

FUNCTION getCaixaNFe RETURNS CHARACTER (INPUT pcEstab AS CHARACTER):
    RETURN buscarParametroIma("caixa_nfe_" + pcEstab, "~{outlook.office365.com:993/imap/ssl~}INBOX").
END FUNCTION.

FUNCTION getUsuarioCaixaNFe RETURNS CHARACTER (INPUT pcEstab AS CHARACTER):
    RETURN buscarParametroIma("usr_caixa_nfe_" + pcEstab, "nfe.medtextil@imatextil.com.br").
END FUNCTION.

FUNCTION getSenhaCaixaNFe RETURNS CHARACTER (INPUT pcEstab AS CHARACTER):
    RETURN buscarParametroIma("senha_caixa_nfe_" + pcEstab, "").
END FUNCTION.

FUNCTION getDirArquivoCsvImpPreco RETURNS CHARACTER ():
    RETURN buscarParametroIma("dir_csv_imp_preco", RIGHT-TRIM(getDirRaizWeb(), "/") + "/" + getDirPV() + "/_lib/file/doc/item_preco").
END FUNCTION.

/* Colecao somente no backend; pode conter configuracao sensivel.
   Nao serializar indiscriminadamente em respostas de API ou logs. */
FUNCTION getParametros RETURNS Progress.Json.ObjectModel.JsonArray ():
    DEFINE BUFFER bListaParametrosIma FOR {&SURSUM_PARAMETROS_IMA_TABELA}.
    DEFINE VARIABLE jaResultado AS Progress.Json.ObjectModel.JsonArray NO-UNDO.
    DEFINE VARIABLE joParametro AS Progress.Json.ObjectModel.JsonObject NO-UNDO.
    jaResultado = NEW Progress.Json.ObjectModel.JsonArray().
    FOR EACH bListaParametrosIma NO-LOCK BY bListaParametrosIma.cod-param:
        joParametro = NEW Progress.Json.ObjectModel.JsonObject().
        IF bListaParametrosIma.cod-param = ? THEN joParametro:AddNull("cod-param").
        ELSE joParametro:Add("cod-param", bListaParametrosIma.cod-param).
        IF bListaParametrosIma.val-param = ? THEN joParametro:AddNull("val-param").
        ELSE joParametro:Add("val-param", bListaParametrosIma.val-param).
        jaResultado:Add(joParametro).
    END.
    RETURN jaResultado.
END FUNCTION.

FUNCTION limparVar RETURNS CHARACTER
    (INPUT pcValor AS CHARACTER, INPUT pcCaracteres AS CHARACTER, INPUT pcSeparador AS CHARACTER):
    DEFINE VARIABLE cResultado AS CHARACTER CASE-SENSITIVE NO-UNDO.
    DEFINE VARIABLE cRestante AS CHARACTER CASE-SENSITIVE NO-UNDO.
    DEFINE VARIABLE cParte AS CHARACTER CASE-SENSITIVE NO-UNDO.
    DEFINE VARIABLE i AS INTEGER NO-UNDO.
    IF pcSeparador = ? OR LENGTH(pcSeparador) = 0 THEN
        UNDO, THROW NEW Progress.Lang.AppError("Separador nao pode ser vazio.", 0).
    IF pcCaracteres = ? THEN RETURN pcValor.
    cResultado = pcValor.
    cRestante = pcCaracteres.
    REPEAT:
        i = INDEX(cRestante, pcSeparador).
        IF i = 0 THEN cParte = cRestante.
        ELSE cParte = SUBSTRING(cRestante, 1, i - 1).
        IF LENGTH(cParte) > 0 THEN cResultado = REPLACE(cResultado, cParte, "").
        IF i = 0 THEN LEAVE.
        cRestante = SUBSTRING(cRestante, i + LENGTH(pcSeparador)).
    END.
    RETURN cResultado.
END FUNCTION.
&ENDIF
'@
$null=$builder.AppendLine($special)
[IO.File]::WriteAllText($path,$builder.ToString(),[Text.UTF8Encoding]::new($false))
$functions=@([regex]::Matches($builder.ToString(),'(?ms)^FUNCTION\s+(\w+)\s+RETURNS\s+([\w.]+)\s*\((.*?)\):')|ForEach-Object{
    [ordered]@{name=$_.Groups[1].Value;returns=$_.Groups[2].Value;arguments=($_.Groups[3].Value -replace '\s+',' ').Trim()}
})
$functions|ConvertTo-Json -Depth 5|Set-Content -LiteralPath (Join-Path $directory 'funcoes-disponiveis.json') -Encoding utf8
"Include gerada: $($catalog.Count) getters simples e auxiliares de regras/colecao."
