'use strict';
// Leitura do catalogo/metadados atuais. Nao chama endpoints de negocio.
const fs = require('node:fs');
const path = require('node:path');
const root = path.resolve(__dirname, '../..');
const base = 'http://127.0.0.1:8765';
const privateState = path.join(root, '.runtime/construtor-pg');
(async () => {
  const password = fs.readFileSync(path.join(privateState, 'acesso-local.txt'), 'utf8')
    .split(/\r?\n/).find(line => line.startsWith('Senha inicial=')).slice(14);
  const login = await fetch(base + '/api/auth/login', {
    method: 'POST', headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username: 'admin', password, tenantId: 'default', rememberMe: false })
  }).then(r => r.json());
  if (!login.authenticated) throw new Error('Login local nao concluido');
  const headers = { Authorization: 'Bearer ' + login.token,
    'X-Runtime-Auth-Token': login.token, 'X-Runtime-Tenant-Id': login.tenantId,
    'X-Runtime-User-Id': String(login.user.id), 'X-Runtime-Session-Id': login.session.sessionId };
  try {
    const response = await fetch(base + '/api/admin/program-builder/bootstrap', { headers });
    if (!response.ok) throw new Error('Catalogo HTTP ' + response.status);
    const bootstrap = await response.json();
    const programs = [];
    for (const p of bootstrap.programs.filter(p => p.screenId?.startsWith('ciw.'))) {
      const r = await fetch(base + '/api/runtime/screens/' + encodeURIComponent(p.screenId), { headers });
      const d = r.ok ? await r.json() : {};
      programs.push({ code: p.programCode || p.code, title: p.programTitle || p.title,
        screenId: p.screenId, runtimeHttpStatus: r.status,
        version: d.program?.version || null, permissions: d.permissions || {},
        tabs: (d.crud?.form?.tabs || []).map(t => ({ id: t.id, title: t.title, type: t.type })) });
    }
    const output = path.join(root, 'integration-src/ciw-inventory/builder-evidence.json');
    fs.writeFileSync(output, JSON.stringify({ at: new Date().toISOString(),
      scope: 'CIW', businessEndpointsCalled: false, programs }, null, 2));
    console.log(JSON.stringify({ programs: programs.length,
      runtimeErrors: programs.filter(p => p.runtimeHttpStatus !== 200).length,
      screens: programs.map(p => ({ screen: p.screenId, version: p.version,
        write: !!(p.permissions.create || p.permissions.edit || p.permissions.delete) })) }));
  } finally {
    await fetch(base + '/api/auth/logout', { method: 'POST', headers });
  }
})().catch(e => { console.error(e.message); process.exitCode = 1; });
