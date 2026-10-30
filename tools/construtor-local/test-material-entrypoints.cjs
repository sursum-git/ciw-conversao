"use strict";

const assert = require("node:assert/strict");
const fs = require("node:fs");
const path = require("node:path");
const test = require("node:test");

const projectRoot = "D:/opencode/construtor-pg";

function walk(directory) {
  return fs.readdirSync(directory, { withFileTypes: true }).flatMap((entry) => {
    const target = path.join(directory, entry.name);
    if (entry.isDirectory()) {
      return ["node_modules", ".git", "docs", "examples", "kendo", "vendor"].includes(entry.name) ? [] : walk(target);
    }
    return entry.isFile() && entry.name.endsWith(".html") ? [target] : [];
  });
}

test("todas as entradas Kendo usam Material IMA antes do JavaScript iniciar", () => {
  const themedPages = walk(projectRoot).filter((file) => fs.readFileSync(file, "utf8").includes('id="kendo-theme-link"'));
  assert.ok(themedPages.length > 0, "nenhuma entrada Kendo localizada");

  const nonMaterial = themedPages.filter((file) => !/id="kendo-theme-link"[^>]*href="[^"]*material-ima\.css"/.test(fs.readFileSync(file, "utf8")));
  assert.deepEqual(nonMaterial, [], "entradas sem tema Material IMA: " + nonMaterial.map((file) => path.relative(projectRoot, file)).join(", "));
});

test("as configuracoes globais carregam Material IMA", () => {
  const production = JSON.parse(fs.readFileSync(path.join(projectRoot, "public/config/crud-engine.production.config.json"), "utf8"));
  const standard = JSON.parse(fs.readFileSync(path.join(projectRoot, "public/config/crud-engine.config.json"), "utf8"));
  assert.match(production.theme.kendoTheme, /material-ima\.css$/);
  assert.match(standard.theme.kendoTheme, /material-ima\.css$/);
});

test("Material IMA usa a base visual Material 2", () => {
  const theme = fs.readFileSync(path.join(projectRoot, "src/styles/material-ima.css"), "utf8");
  assert.match(theme, /@import url\("\.\.\/\.\.\/kendo\/styles\/material-2\.css"\);/);
  assert.doesNotMatch(theme, /material-main\.css/);
});
