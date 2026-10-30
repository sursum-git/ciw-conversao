/* Monta apenas os artefatos declarados; fixtures nunca integram o manifesto de publicacao. */
const fs = require('node:fs');
const path = require('node:path');
const crypto = require('node:crypto');
const base = __dirname;
const target = path.resolve(process.argv[2] || '');
if (!process.argv[2] || target === base) throw Error('Informe uma pasta de staging diferente dos fontes');
const helper = 'esapi/consulta-notas/';
const mapping = {
  'esbo/boConsNotaFiscal.p': 'esbo/boConsNotaFiscal.p',
  'esbo/boConsNotaFiscal.i': 'esbo/boConsNotaFiscal.i',
  'boConsDevolucoes.p': 'esbo/boConsDevolucoes.p',
  'api_cons_nota_fiscal_wp.p': 'http-api/api_cons_nota_fiscal_wp.p',
};
for (const name of [
  'BuscarDevolucoes.p','BuscarDevolucoesIMA.p','BuscarDevolucoesMED.p',
  'BuscarNotasFiscaisIMA.p','BuscarNotasFiscaisMED.p','ConsultarNotasFiscais.p',
  'ConsultaNotasJsonParser.p','ConsultaNotasWpWriter.p','ConsultaNotasUsuarioEscopo.p',
  'ttFiltroDevolucoes.i','BuscarDevolucoesParametros.i','BuscarDevolucoesImpl.i',
  'BuscarDevolucoesValidarFiltro.i','BuscarNotasFiscaisParametros.i',
  'BuscarNotasFiscaisImpl.i','ConsultaNFFiltrosValidar.i','ConsultaNFContexto.i',
]) mapping[name] = helper + name;
const manifest=[];
for (const [source,destination] of Object.entries(mapping)) {
  const bytes=fs.readFileSync(path.join(base,source));
  const file=path.join(target,destination);
  fs.mkdirSync(path.dirname(file),{recursive:true}); fs.writeFileSync(file,bytes);
  manifest.push({source,destination,sha256:crypto.createHash('sha256').update(bytes).digest('hex')});
}
fs.writeFileSync(path.join(target,'source-manifest.json'),JSON.stringify(manifest,null,2)+'\n');
if (process.argv.includes('--tests')) {
  for (const name of ['BuscarDevolucoesTest.p','ConsultaNotasIntegrationTest.p',
    'ConsultaNotasApiRealTest.p','ConsultaNotasJsonParserTest.p','ConsultaNotasWpWriterTest.p',
    'ConsultaNotasUsuarioEscopoTest.p']) fs.copyFileSync(path.join(base,name),path.join(target,name));
  fs.cpSync(path.join(base,'tests'),path.join(target,'tests'),{recursive:true});
  fs.copyFileSync(path.join(base,'FixtureBuscarDevolucoes.df'),path.join(target,'FixtureBuscarDevolucoes.df'));
}
process.stdout.write(JSON.stringify({target,productionFiles:manifest.length})+'\n');
