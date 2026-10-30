'use strict';
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict'),base=path.resolve(__dirname,'../../integration-src/purchase-sample-formats/abl');
const wrapper=fs.readFileSync(path.join(base,'CiwCadastroCrudService.p'),'utf8'),core=fs.readFileSync(path.join(base,'CiwCadastroCoreService.p'),'utf8'),dispatcher=fs.readFileSync(path.join(base,'CiwCadastrosCrud.p'),'utf8'),identity=fs.readFileSync(path.join(base,'CiwCadastroSequenceIdentity.p'),'utf8');
assert.equal((wrapper.match(/DEFINE INPUT PARAMETER /g)||[]).length,5,'stable six-argument adapter');assert.equal((core.match(/^DEFINE INPUT PARAMETER /gm)||[]).length,6,'private seven-argument core');
assert.match(wrapper,/SEARCH\('sursum-api\/programs\/CiwCadastroCoreService\.r'\)/);assert.match(wrapper,/SEARCH\('sursum-api\/programs\/CiwCadastroSequenceIdentity\.r'\)/);
assert.match(dispatcher,/WHEN "formatos_amostra" THEN DO:\s*CREATE BUFFER hData FOR TABLE "espec\.formatos_amostra"[\s\S]*?CREATE BUFFER hReference1 FOR TABLE "espec\.itens_proc_compra"/);
assert.match(core,/cResource="formatos_amostra" AND CAN-FIND[\s\S]*?NOT VALID-HANDLE\(phIdentity\)[\s\S]*?CIW_CADASTRO_CONFIGURATION/);
assert.match(identity,/DYNAMIC-NEXT-VALUE\('seq_formatos_amostra','espec'\)/);assert.match(identity,/resourceValue<>'formatos_amostra'/);
console.log('PASS fixed wrapper/core/dispatcher/identity wiring; no identity fallback for formats');
