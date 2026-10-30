"use strict";

const { chromium } = require("playwright");

const baseUrl = process.env.CIW_E2E_BASE_URL || "http://127.0.0.1:8765";
const username = String(process.env.CIW_E2E_USERNAME || "").trim();
const password = String(process.env.CIW_E2E_PASSWORD || "");

if (!username || !password) {
  throw new Error("CIW_E2E_USERNAME e CIW_E2E_PASSWORD sao obrigatorios.");
}

async function run() {
  const browser = await chromium.launch({
    headless: true,
    executablePath: "C:/Program Files/Google/Chrome/Application/chrome.exe"
  });
  const page = await browser.newPage();
  const events = [];
  page.on("response", async (response) => {
    if (!response.url().includes("/api/")) return;
    const event = { path: new URL(response.url()).pathname, status: response.status() };
    if (response.status() >= 400) {
      try {
        const body = await response.json();
        event.errorCode = body && body.error && body.error.code || null;
      } catch (_) {
        event.errorCode = "NON_JSON";
      }
    }
    events.push(event);
  });

  try {
    await page.goto(baseUrl + "/production/login.html", { waitUntil: "networkidle" });
    await page.locator("#login-user").fill(username);
    await page.locator("#login-password").fill(password);
    const homeResponse = page.waitForResponse(
      (response) => new URL(response.url()).pathname === "/api/runtime/screens/home",
      { timeout: 15000 }
    ).catch(() => null);
    await page.locator("#login-submit").click();
    await homeResponse;
    await Promise.race([
      page.locator(".home-shell").waitFor({ state: "visible", timeout: 10000 }),
      page.locator(".crud-message-error").waitFor({ state: "visible", timeout: 10000 })
    ]).catch(() => null);

    const state = await page.evaluate(() => ({
      url: location.href,
      hasToken: Boolean(localStorage.getItem("crudEngine.authToken")),
      hasSession: Boolean(localStorage.getItem("crudEngine.runtimeSessionId")),
      loginMessage: (document.querySelector("#login-message") || {}).textContent || "",
      homeError: (document.querySelector(".crud-message-error") || {}).textContent || ""
    }));

    const diagnosis = state.homeError ? await page.evaluate(async () => {
      const root = document.createElement("main");
      root.id = "ciw-e2e-diagnostic-root";
      document.body.appendChild(root);
      const engine = new window.HomeEngine({
        root: "#ciw-e2e-diagnostic-root",
        screenId: "home",
        configUrl: "../public/config/crud-engine.production.config.json",
        productionErrors: false,
        httpClient: new window.CrudHttpClient({ allowLocalFallback: false })
      });
      try {
        await engine.init();
        return { reproduced: false };
      } catch (error) {
        return {
          reproduced: true,
          code: error && error.code || error && error.error && error.error.code || null,
          message: String(error && error.message || ""),
          validationErrors: error && error.payload && error.payload.error && error.payload.error.details && error.payload.error.details.errors || []
        };
      } finally {
        root.remove();
      }
    }) : null;

    console.log(JSON.stringify({ state, diagnosis, events }, null, 2));

    const auth = await page.evaluate(() => ({
      token: localStorage.getItem("crudEngine.authToken") || "",
      tenant: localStorage.getItem("crudEngine.runtimeTenantId") || "default",
      user: localStorage.getItem("crudEngine.runtimeUserId") || "",
      session: localStorage.getItem("crudEngine.runtimeSessionId") || ""
    }));
    if (auth.token && auth.session) {
      await page.evaluate(async (current) => {
        await fetch("/api/auth/logout", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + current.token,
            "X-Runtime-Auth-Token": current.token,
            "X-Runtime-Tenant-Id": current.tenant,
            "X-Runtime-User-Id": current.user,
            "X-Runtime-Session-Id": current.session
          },
          body: "{}"
        });
      }, auth);
    }
  } finally {
    await browser.close();
  }
}

run().catch((error) => {
  console.error(error.stack || String(error));
  process.exitCode = 1;
});
