'use strict';
const fs = require('node:fs');
const path = require('node:path');
const {createRequire} = require('node:module');
const repo = 'D:/opencode/construtor-pg';
const state = path.resolve(__dirname, '../../.runtime/construtor-pg');
const {chromium} = createRequire(path.join(repo, 'package.json'))('playwright');

(async () => {
  const password = fs.readFileSync(path.join(state, 'acesso-local.txt'), 'utf8')
    .split(/\r?\n/).find(line => line.startsWith('Senha inicial=')).slice('Senha inicial='.length);
  const browser = await chromium.launch({channel: 'msedge', headless: true});
  const page = await browser.newPage({viewport: {width: 1440, height: 1000}});
  const errors = [];
  page.on('pageerror', error => errors.push(error.message));
  try {
    await page.goto('http://127.0.0.1:8765/production/login.html?noRemember=1');
    await page.locator('#login-user').fill('admin');
    await page.locator('#login-password').fill(password);
    await page.locator('#login-submit').click();
    await page.getByRole('button', {name: /administrativa/i}).click({timeout: 20000});
    await page.waitForURL(/\/production\/home\.html/, {timeout: 20000});
    await page.goto('http://127.0.0.1:8765/production/program-builder.html');
    await page.locator('.program-builder-shell').waitFor({timeout: 20000});
    await page.locator('.program-builder-tree [role="treeitem"]').first().waitFor({timeout: 20000});
    if (errors.length) throw new Error('Erros JavaScript: ' + errors.join('; '));
    await page.screenshot({path: path.join(state, 'construtor-local.png'), fullPage: true});
    console.log('PASS: login real, área administrativa e árvore do construtor carregados.');
    console.log('Captura: ' + path.join(state, 'construtor-local.png'));
    await page.evaluate(async () => {
      await new window.CrudHttpClient().logout();
    });
  } finally {
    await browser.close();
  }
})().catch(error => { console.error(error.message); process.exitCode = 1; });
