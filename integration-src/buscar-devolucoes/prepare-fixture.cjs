/* Apenas gera schema sintetico: nunca conectar este DF ao ERP. */
const fs = require('node:fs');
const path = require('node:path');
const root = path.resolve(__dirname, '../..');
const schema = JSON.parse(fs.readFileSync(path.join(root, 'integration-src/iol-pagina-inicial-gerencial/schema/iol-schema.json')));
const fields = {
  'docum-est': 'nro-docto,serie-docto,cod-emitente,tot-valor,esp-docto,cod-estabel,cidade,uf,dt-trans,dt-emissao,nat-operacao',
  'natur-oper': 'nat-operacao,tipo-compra,tp-rec-desp',
  'devol-cli': 'cod-estabel,cod-emitente,nro-docto,serie-docto,nat-operacao,serie,nr-nota-fis,codigo-rejei',
  'nota-fiscal': 'cod-estabel,cod-emitente,nr-nota-fis,serie,nr-pedcli,nome-ab-cli,cod-rep,no-ab-reppri,dt-emis-nota,dt-cancela,idi-sit-nf-eletro,estado,cidade,vl-tot-nota,val-desconto-total,nat-operacao,esp-docto',
  'ped-venda': 'nr-pedcli,nome-abrev,nr-pedido,cod-priori',
  'ped-repre': 'nr-pedido,nome-ab-rep,perc-comis',
};
let df = '';
function add(table, definitions) {
  df += `ADD TABLE "${table}"\n  AREA "Schema Area"\n`;
  for (const f of definitions) df += `ADD FIELD "${f.name}" OF "${table}" AS ${f.type}\n${f.type === 'decimal' ? '  DECIMALS 10\n' : ''}`;
}
for (const [name, list] of Object.entries(fields)) {
  const t = schema.find(t => t.table === `ems2med.${name}`);
  add(name, list.split(',').map(name => {
    const f = t.fields.find(f => f.name === name);
    if (!f) throw Error(`Campo nao documentado: ${name}`);
    return f;
  }));
}
const ext = JSON.parse(fs.readFileSync(path.join(root, 'integration-src/container-panel/schema/espec/schema-ped-venda-ext.json')));
add('ped-venda-ext', ['cod-estabel', 'nr-pedido', 'preposto'].map(name => ext.fields.find(f => f.name === name)));
/* codigo-rejei/descricao inferidos do SELECT PHP; confirmar no schema real. */
add('cod-rejeicao', [{name: 'codigo-rejei', type: 'integer'}, {name: 'descricao', type: 'character'}]);
/* Tipos dos campos confirmados no SELECT legado calcularDescontoNF. */
add('it-nota-fisc', ['cod-estabel','serie','nr-nota-fis','char-2'].map(name => ({name,type:'character'})));
add('user-web', [{name:'Login',type:'character'},{name:'tp-usuario',type:'integer'},{name:'nome-ab-cli',type:'character'}]);
add('repres', [{name:'nome-abrev',type:'character'},{name:'cod-rep',type:'integer'}]);
df += '.\n';
fs.writeFileSync(path.join(__dirname, 'FixtureBuscarDevolucoes.df'), df);
