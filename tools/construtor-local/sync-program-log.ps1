$ErrorActionPreference='Stop'
$src='D:/opencode/conversao-sc/integration-src/program-log'
$target='D:/opencode/motor-progress/v2/sursum-api'
function AddAfterClass($file,$class,$until){
 $staged=Get-Content "$src/$file" -Raw
 $classMarker="CLASS ${class}:"
 $start=$staged.IndexOf($classMarker)+$classMarker.Length
 $end=$staged.IndexOf($until,$start)
 if($start -lt $classMarker.Length -or $end -lt 0){throw 'Marcadores de delta ausentes'}
 $path="$target/sursum/$file"
 $current=Get-Content $path -Raw
 if($current.Contains($staged.Substring($start,$end-$start))){return}
 if($current.Contains('METHOD PUBLIC LOGICAL logMessage(') -or $current.Contains('PROPERTY Current AS PasoeExecutionContext')){throw 'Delta diferente ja aplicado: revisar'}
 Set-Content $path ($current.Replace($classMarker,$classMarker+$staged.Substring($start,$end-$start))) -Encoding utf8
}
AddAfterClass 'PasoeExecutionContext.cls' 'PasoeExecutionContext' '    DEFINE PRIVATE VARIABLE cRequestId'
AddAfterClass 'ApiExecutionRepository.cls' 'ApiExecutionRepository' '    METHOD PUBLIC LOGICAL schemaAvailable()'
$handlerPath="$target/rest/JsonProgramWebHandler.cls"
$handler=Get-Content $handlerPath -Raw
if($handler.Contains('PasoeExecutionContext:clearCurrent()')){throw 'Handler ja adaptado: revisar'}
$handler=$handler.Replace('        DEFINE VARIABLE mBody AS MEMPTR NO-UNDO.',"        DEFINE VARIABLE mBody AS MEMPTR NO-UNDO.`r`n`r`n        PasoeExecutionContext:clearCurrent().")
$handler=$handler.Replace('                oContext:setCustomField("executionId", cExecutionId).',"                oContext:setCustomField(`"executionId`", cExecutionId).`r`n                PasoeExecutionContext:setCurrent(oContext).")
$handler=$handler.Replace('        IF cExecutionId <> "" THEN DO:',"        IF cExecutionId <> `"`" THEN DO:`r`n            IF NOT oExec:flushLogMessages(oContext) THEN`r`n                LOG-MANAGER:WRITE-MESSAGE(`"Falha ao persistir logs da execucao `" + cExecutionId,`"PROGRAM-LOG`").")
# O canonico pode conter outro IF identico antes do dispatch para payloads.
$handler=[regex]::Replace($handler,'(?m)(            IF cExecutionId <> "" THEN DO:\r?\n)            IF NOT oExec:flushLogMessages\(oContext\) THEN\r?\n                LOG-MANAGER:WRITE-MESSAGE\("Falha ao persistir logs da execucao " \+ cExecutionId,"PROGRAM-LOG"\)\.\r?\n(?=                ASSIGN joExecution = oExec:updateExecutionPayloads)','$1')
$finally=@'
        FINALLY:
            IF VALID-OBJECT(oExec) AND VALID-OBJECT(oContext) THEN DO:
                IF NOT oExec:flushLogMessages(oContext) THEN
                    LOG-MANAGER:WRITE-MESSAGE("Falha ao persistir logs pendentes da execucao " + cExecutionId,"PROGRAM-LOG").
            END.
            PasoeExecutionContext:clearCurrent().
'@
# Apenas o FINALLY do HandleRequest, identificado pela limpeza de MEMPTR.
$handler=[regex]::Replace($handler,'(?m)^        FINALLY:\r?\n            SET-SIZE\(mReply\)',$finally+"`r`n            SET-SIZE(mReply)")
if(!$handler.Contains('logs pendentes')){throw 'FINALLY nao localizado'}
Set-Content $handlerPath $handler -Encoding utf8
$tests="$target/../tests/abl/program-log"
New-Item -ItemType Directory -Path $tests -Force | Out-Null
Copy-Item "$src/*Test.p","$src/*Probe.p","$src/CompileProgramLog.p" $tests -Force
Write-Output 'PASS: somente os deltas de log aplicados aos fontes canonicos; demais alteracoes preservadas.'
