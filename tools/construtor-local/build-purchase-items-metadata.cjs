// Candidatos JSON para o construtor existente; não escreve no catálogo.
const c=require('./purchase-payments-builder-common.cjs');
const meta=c.path.join(c.root,'integration-src/purchase-items/metadata');c.fs.mkdirSync(meta,{recursive:true});
const save=(n,v)=>c.fs.writeFileSync(c.path.join(meta,n),JSON.stringify(v,null,2)+'\n');
const schema=c.readJson(c.path.join(c.root,'integration-src/container-panel/schema/schema-itens_proc_compra.json'));
const sc=c.readJson(c.path.join(c.root,'integration-src/purchase-items/scriptcase-fields.json'));
const grid=['item_proc_compra_id','descricao','codigo_erp','qt_dias_producao','unid_medida','vl_custo_dolar','vl_negociado','qt_comprada','qt_alocada','qt_saldo','dt_item_certificacao'];
const extras=[{name:'row_stamp',type:'character'},{name:'qt_alocada',type:'decimal',decimals:2},{name:'qt_saldo',type:'decimal',decimals:2},{name:'calc_gm',type:'decimal',decimals:4}];
const fields=[...schema.fields,...extras].map((s,i)=>{
 const code=s.name,r=sc.fields[code]??{},readonly=['item_proc_compra_id','proc_compra_id','row_stamp','qt_alocada','qt_saldo','calc_gm'].includes(code),dataType=({integer:'integer',character:'string',decimal:'decimal',logical:'boolean',date:'date'})[s.type];
 const f={code,label:code==='calc_gm'?'Gramatura (G/M)':code==='dt_item_certificacao'?'Data de certificação':code==='row_stamp'?'Controle de concorrência':code==='qt_alocada'?'Qt. alocada':code==='qt_saldo'?'Saldo para alocação':r.label??code,dataType,primaryKey:code==='item_proc_compra_id',required:['descricao','unid_medida'].includes(code),readonlyField:readonly,position:i*10,apiJsonPath:code,apiWritePath:['item_proc_compra_id','row_stamp','proc_compra_id'].includes(code)?code:'values.'+code,apiShowInGrid:grid.includes(code),apiShowInForm:code!=='row_stamp',apiShowInFilter:grid.includes(code),options:{readonly,writable:!readonly}};
 if(dataType==='integer')Object.assign(f.options,{decimals:0,format:'n0',min:0,max:2147483647});
 if(!readonly){f.options.defaultValue=dataType==='date'?null:dataType==='boolean'?s.initial==='sim':dataType==='integer'||dataType==='decimal'?Number(s.initial??0):'';}
 if(dataType==='decimal'){f.precision=24;f.scale=s.decimals;Object.assign(f.options,{decimals:s.decimals,format:'n'+s.decimals,max:999999999999});if(code==='qt_comprada')f.options.min=0;}
 if(code==='qt_dias_producao')f.options.max=9999;
 if(code==='qt_dias_calc_so_ld')f.options.max=999;
 if(r.maxLength)f.length=r.maxLength;
 if(code==='observacao'){f.dataType='text';f.options.editor='textarea';}
 if(sc.staticOptions[code]&&!['log_mostruario','log_aprov_so_ld','ind_distr_custo'].includes(code))Object.assign(f.options,{editor:'dropdown',options:sc.staticOptions[code].map(x=>({value:dataType==='integer'?Number(x.value):x.value,text:x.text}))});
 if(code==='unid_medida')f.options.defaultValue='MT';
 if(code.startsWith('ind_')&&code!=='ind_distr_custo')f.options.defaultValue=0;
 if(code==='ind_distr_custo')Object.assign(f.options,{editor:'dropdown',defaultValue:1,options:[{value:0,text:'Não'},{value:1,text:'Sim / Negociado maior que registro'},{value:2,text:'Negociado menor que registro'},{value:3,text:'Negociado igual ao registro'}]});
 const lookup=({coloracao_id:'coloracao',formato_amostra_id:'formato_amostra',item_estacao:'estacao'})[code];
 if(lookup)Object.assign(f.options,{editor:'dropdown',api:{optionsSource:{operationCode:'proc_compra_itens_opcoes_'+lookup,valueField:'value',textField:'text'}}});
 return f;
});
const entityDraft={code:'proc_compra_itens_progress',name:'Itens do Processo de Compra — MED',entityType:'api',createPhysicalTable:false,structureModuleCode:'operacional',structureType:'main',structureBaseNumber:1014,apiSourceCode:'motor_progress_ciw_cadastros',...Object.fromEntries([['List','read'],['Detail','get'],['Create','create'],['Update','update'],['Delete','delete']].map(([n,op])=>['api'+n+'OperationCode','proc_compra_itens_'+op])),fields};
const section=(id,title,fields,columns=2)=>({id,title,columns,fields});
const programDraft={programCode:'op1014',programTitle:entityDraft.name,module:'operacional',builderEntityCode:entityDraft.code,pageType:'crud',gridEditMode:'form',screenId:'ciw.proc-compra-itens',version:'1.0.0',programOrigin:'standard',ownerScope:'system',allowCreate:true,allowUpdate:true,allowDelete:true,permissionPrefix:entityDraft.code,subtitle:'Empresa MED. Itens vinculados ao processo de compra selecionado.',rowLinks:[],contextFields:[{field:'proc_compra_id',filter:true,createDefault:true,readonly:true,required:true}],crudOptions:{pageSize:50,defaultSort:[{field:'item_proc_compra_id',dir:'asc'}],gridFields:grid.map(field=>({field})),filterFields:grid},formOptions:{mode:'popup',tabs:[
 {id:'principal',title:'Principal',sections:[section('identificacao','Item do pedido',['item_proc_compra_id','proc_compra_id','descricao','codigo_erp','unid_medida','qt_comprada','qt_alocada','qt_saldo','vl_custo_dolar','vl_negociado','vl_base_tributacao','vl_cubagem','ind_distr_custo','dt_item_certificacao'])]},
 {id:'especificacoes',title:'Especificações',sections:[section('tecido','Especificações do tecido',['composicao','shrinkage','peso','largura','calc_gm','rolo','coloracao_id','item_estacao','formato_amostra_id'])]},
 {id:'prazos',title:'Prazos e amostras',sections:[section('producao','Produção e mostruário',['qt_dias_producao','dt_maxima_producao','dt_prev_termino_producao','dt_termino_producao','log_mostruario','dt_mostruario','dt_cheg_amostras_emb','dt_recbto_laudo','dt_recbto_embalagem']),section('so_ld','Strike Offs e Lab Dips',['log_aprov_so_ld','qt_dias_calc_so_ld','dt_prev_envio_desenhos','dt_real_envio_desenhos','dt_prev_recbto_so_ld','dt_real_recbto_so_ld','dt_prev_aprov_so_ld','dt_real_aprov_so_ld'])]},
 {id:'avaliacao',title:'Avaliação',sections:[section('qualidade','Produção e qualidade',fields.filter(f=>f.code.startsWith('ind_')&&f.code!=='ind_distr_custo').map(f=>f.code))]},
 {id:'observacao',title:'Observações',sections:[section('observacao','Observações',['observacao'],1)]}
]}};
save('proc-compra-itens-builder-draft.json',{entityDraft,programDraft});
const operations=[['read','list'],['get','detail'],['create','create'],['update','update'],['delete','delete']].map(([operation,type])=>({code:'proc_compra_itens_'+operation,name:entityDraft.name+' — '+operation,type,method:'POST',path:'/SursumPrograms/ciw-cadastros',requestContextFields:['proc_compra_id'],bodyTemplate:{resource:'proc_compra_itens',operation},...(type==='list'?{itemsPath:'data',totalPath:'total'}:{itemPath:'data'})}));
for(const lookup of ['coloracao','formato_amostra','estacao'])operations.push({code:'proc_compra_itens_opcoes_'+lookup,name:'Opções de '+lookup+' do item',type:'list',method:'POST',path:'/SursumPrograms/ciw-cadastros',requestContextFields:['proc_compra_id'],bodyTemplate:{resource:'proc_compra_itens',operation:'options',lookup},itemsPath:'data',totalPath:'total'});
save('api-source-additions.json',{sourceCode:'motor_progress_ciw_cadastros',operations});
const parent=c.readJson(c.path.join(c.root,'integration-src/purchase-orders/metadata/processos-compra-med-builder-draft.json'));
parent.programDraft.version='1.0.2';parent.programDraft.subtitle='Empresa MED. Cadastro do pedido de importação, itens e pagamentos vinculados.';
parent.programDraft.formOptions.tabs.splice(2,0,{id:'itens',title:'Itens',type:'linkedPage',linkedPage:{screenId:'ciw.proc-compra-itens',engine:'crud',hideHeader:false,requireRecord:true,filters:[{field:'proc_compra_id',sourceField:'proc_compra_id',operator:'eq'}]}});
save('processos-compra-med-builder-draft.json',parent);
save('navigation-proposal.json',{parentScreen:'ciw.processos-compra-med',parentVersion:'1.0.2',childScreen:programDraft.screenId,context:'proc_compra_id',homeChange:false,preservePayments:true,deferred:['form_itens_proc_compra_amostra','grid_anexos_proc_compra'],dateSuggestions:'server-on-save-when-inputs-change',virtualCalcGm:'not-persisted'});
console.log('PASS: four metadata candidates prepared; no catalog writes.');
