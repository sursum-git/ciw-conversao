// Hospedagem local do frontend existente; o backend fica em outro processo PHP.
'use strict';
const http = require('node:http');
const fs = require('node:fs');
const path = require('node:path');

const root = path.resolve(process.argv[2] || 'D:/opencode/construtor-pg');
const port = Number(process.argv[3] || 8765);
const allowedDirectories = new Set(['production', 'assets', 'src', 'kendo', 'public']);
const allowedRootFiles = new Set(['program-builder.html', 'theme-builder.html']);
const types = {
  '.html': 'text/html; charset=utf-8', '.js': 'application/javascript; charset=utf-8',
  '.css': 'text/css; charset=utf-8', '.json': 'application/json; charset=utf-8',
  '.png': 'image/png', '.jpg': 'image/jpeg', '.jpeg': 'image/jpeg', '.gif': 'image/gif',
  '.svg': 'image/svg+xml', '.ico': 'image/x-icon', '.woff': 'font/woff',
  '.woff2': 'font/woff2', '.ttf': 'font/ttf', '.map': 'application/json; charset=utf-8'
};

http.createServer((request, response) => {
  let pathname;
  try {
    pathname = decodeURIComponent(new URL(request.url, 'http://127.0.0.1').pathname);
  } catch {
    response.writeHead(400); response.end(); return;
  }
  if (pathname.startsWith('/api/')) {
    const upstream = http.request({
      hostname: '127.0.0.1', port: 8000, path: request.url,
      method: request.method, headers: request.headers,
      timeout: /multipart\/form-data/i.test(request.headers['content-type'] || '') || pathname.endsWith('/endpoints/attachments.download') ? 180000 : 60000
    }, result => {
      response.writeHead(result.statusCode || 502, result.headers);
      result.pipe(response);
    });
    upstream.on('timeout', () => upstream.destroy());
    upstream.on('error', () => {
      if (!response.headersSent) {
        response.writeHead(502, {'Content-Type': 'application/json; charset=utf-8'});
        response.end(JSON.stringify({error: {code: 'LOCAL_BACKEND_UNAVAILABLE', message: 'Backend PHP local indisponível.'}}));
      } else {
        response.destroy();
      }
    });
    request.pipe(upstream);
    return;
  }
  if (pathname === '/') {
    response.writeHead(302, {Location: '/production/login.html'}); response.end(); return;
  }
  if (!['GET', 'HEAD'].includes(request.method)) {
    response.writeHead(405, {Allow: 'GET, HEAD'}); response.end(); return;
  }
  const relative = pathname.replace(/^\/+/, '');
  const segments = relative.split(/[\\/]/);
  const permitted = allowedDirectories.has(segments[0]) ||
    allowedRootFiles.has(relative) || relative.startsWith('vendor/jquery/');
  const file = path.resolve(root, relative);
  const inside = path.relative(root, file);
  if (!permitted || segments.some(segment => segment.startsWith('.')) ||
      inside.startsWith('..') || path.isAbsolute(inside) || !types[path.extname(file)]) {
    response.writeHead(403); response.end('Forbidden'); return;
  }
  fs.readFile(file, (error, data) => {
    if (error) { response.writeHead(404); response.end('Not found'); return; }
    response.writeHead(200, {'Content-Type': types[path.extname(file)], 'X-Content-Type-Options': 'nosniff'});
    response.end(request.method === 'HEAD' ? undefined : data);
  });
}).listen(port, '127.0.0.1', () => {
  console.log('Construtor: http://127.0.0.1:' + port + '/production/login.html');
});
