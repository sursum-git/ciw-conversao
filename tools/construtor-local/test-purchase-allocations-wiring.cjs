'use strict';
const fs=require('node:fs'),assert=require('node:assert/strict'),path=require('node:path');
const base=path.resolve(__dirname,'../../integration-src/purchase-allocations/abl');
const dispatcher=fs.readFileSync(path.join(base,'CiwCadastrosCrud.p'),'utf8');
assert.match(dispatcher,/WHEN "proc_compra_alocacoes" THEN DO:\s*cService=SEARCH\("sursum-api\/programs\/PurchaseItemAllocationsApi\.r"\)\.[\s\S]*?RUN VALUE\(cService\)\(poRequest,OUTPUT poResponse\)\. RETURN\.\s*END\./,'fixed dispatcher entry must reach new adapter');
const adapter=fs.readFileSync(path.join(base,'PurchaseItemAllocationsApi.p'),'utf8');assert.match(adapter,/SEARCH\('sursum-api\/programs\/PurchaseItemAllocationsService\.r'\)/);
assert.match(adapter,/espec\.procs_compra,espec\.empresas,espec\.itens_proc_compra,espec\.itens_container,espec\.pp-container,espec\.situacoes_container/);
const reader=fs.readFileSync(path.join(base,'CiwErpReadService.p'),'utf8');assert.match(reader,/WHEN 'proc_compra_alocacoes' THEN DO:/);
console.log('PASS fixed dispatcher -> adapter -> service -> shared reader wiring');
