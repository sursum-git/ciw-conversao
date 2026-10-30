from pathlib import Path
import json
root=Path(__file__).resolve().parents[1];repo=Path('D:/opencode/construtor-pg')
state=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection')
stage=state/'native';out=state/'regressions';out.mkdir(exist_ok=True)
# Preserve original test bodies/assertions; substitute only the two staged frontend files.
for name in ['api-process-context-smoke.mjs','container-process-logs-smoke.mjs','process-session-flag-smoke.mjs']:
 text=(repo/'tests/frontend'/name).read_text(encoding='utf-8')
 text=text.replace("from 'playwright'", "from 'file:///D:/opencode/construtor-pg/node_modules/playwright/index.mjs'")
 text=text.replace("from 'playwright';", "from 'file:///D:/opencode/construtor-pg/node_modules/playwright/index.mjs';")
 if "from 'node:fs'" not in text and "from 'fs'"not in text:text="import fs from 'node:fs';\n"+text
 choose="(fs.existsSync('"+stage.as_posix()+"/'+file) ? '"+stage.as_posix()+"/'+file : file)"
 text=text.replace('path.resolve(file)','path.resolve('+choose+')').replace("fs.readFileSync(file,'utf8')","fs.readFileSync("+choose+",'utf8')")
 (out/name).write_text(text,encoding='utf-8')
print('Prepared unchanged legacy assertions against staged ProcessEngine/Validator')
