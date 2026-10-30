(function () {
  "use strict";

  const state = { rows: [], selected: null };
  const fields = [
    ["executionId", "Execução"], ["requestId", "Requisição"], ["executionStatus", "Status"],
    ["executionType", "Tipo"], ["endpoint", "Endpoint"], ["programName", "Programa"],
    ["queryCode", "Consulta"], ["jobId", "Tarefa"], ["startedAt", "Início"],
    ["finishedAt", "Fim"], ["durationMs", "Duração ms"], ["pasoePid", "PID"],
    ["userName", "Usuário"], ["hostName", "Host"], ["databaseName", "Banco"],
    ["errorCode", "Código erro"], ["errorMessage", "Mensagem"],
    ["killRequestedBy", "Solicitou interrupção"], ["killReason", "Motivo interrupção"]
  ];

  function setStatus(message) { $("#statusBox").text(message); }
  function baseUrl() { return String($("#baseUrlInput").val() || "").replace(/\/+$/, ""); }
  function statusClass(value) { return "status-" + String(value || "").toLowerCase(); }
  function statusTemplate(item) {
    const value = item.executionStatus || item.status || "";
    return '<span class="status-pill ' + statusClass(value) + '">' + kendo.htmlEncode(value) + '</span>';
  }
  function parseProgressDate(value) {
    const text = String(value || "");
    const match = text.match(/^(\d{2})\/(\d{2})\/(\d{4})\s+(\d{2}):(\d{2}):(\d{2})(?:,(\d{1,3}))?/);
    if (!match) return null;
    return new Date(Number(match[3]), Number(match[2]) - 1, Number(match[1]), Number(match[4]), Number(match[5]), Number(match[6]), Number((match[7] || "0").padEnd(3, "0")));
  }
  function normalize(row) {
    const copy = Object.assign({}, row);
    copy.startedAtDate = parseProgressDate(copy.startedAt);
    copy.finishedAtDate = parseProgressDate(copy.finishedAt);
    copy.durationMs = Number(copy.durationMs || 0);
    return copy;
  }
  async function getJson(url) {
    const response = await fetch(url, { cache: "no-store" });
    const text = await response.text();
    let payload;
    try { payload = JSON.parse(text); } catch (error) { throw new Error(text || error.message); }
    if (!response.ok || !payload || payload.success === false) {
      throw new Error((payload && payload.errorMessage) || (payload && payload.message) || response.statusText);
    }
    return payload;
  }
  function filteredRows(rows) {
    const user = String($("#userInput").val() || "").toLowerCase();
    const endpoint = String($("#endpointInput").val() || "").toLowerCase();
    return rows.filter((row) => {
      if (user && !String(row.userName || "").toLowerCase().includes(user)) return false;
      if (endpoint) {
        const haystack = [row.endpoint, row.programName, row.queryCode].join(" ").toLowerCase();
        if (!haystack.includes(endpoint)) return false;
      }
      return true;
    });
  }
  function queryString() {
    const params = new URLSearchParams();
    const limit = $("#limitInput").val() || "100";
    const statusList = $("#statusInput").data("kendoDropDownList");
    const status = statusList ? statusList.value() : "";
    const pid = $("#pidInput").val();
    params.set("limit", limit);
    if (status) params.set("status", status);
    if (pid) params.set("pid", pid);
    return params.toString();
  }
  function grid() { return $("#executionGrid").data("kendoGrid"); }
  function updateSummary(rows) {
    const failedStatuses = new Set(["failed", "cancelled", "killRequested"]);
    const completed = rows.filter((row) => row.executionStatus === "completed").length;
    const failed = rows.filter((row) => failedStatuses.has(row.executionStatus)).length;
    const maxDuration = rows.reduce((max, row) => Math.max(max, row.durationMs || 0), 0);
    $("#recordCount").text(rows.length);
    $("#completedCount").text(completed);
    $("#failedCount").text(failed);
    $("#maxDuration").text(maxDuration + " ms");
  }
  function renderDetail(item) {
    state.selected = item || null;
    const list = $("#detailList").empty();
    fields.forEach(([name, title]) => {
      const wrapper = $("<div>");
      $("<dt>").text(title).appendTo(wrapper);
      $("<dd>").text(item ? (item[name] == null ? "" : item[name]) : "").appendTo(wrapper);
      list.append(wrapper);
    });
  }
  async function loadDetail(executionId) {
    if (!executionId) return;
    const payload = await getJson(baseUrl() + "/executions/" + encodeURIComponent(executionId));
    renderDetail(normalize(payload));
  }
  async function loadExecutions() {
    const url = baseUrl() + "/executions?" + queryString();
    setStatus("Carregando...");
    kendo.ui.progress($(".grid-section"), true);
    try {
      const payload = await getJson(url);
      state.rows = (payload.data || []).map(normalize);
      const rows = filteredRows(state.rows);
      grid().dataSource.data(rows);
      updateSummary(rows);
      renderDetail(null);
      setStatus("Atualizado em " + kendo.toString(new Date(), "dd/MM/yyyy HH:mm:ss") + ".");
    } finally {
      kendo.ui.progress($(".grid-section"), false);
    }
  }
  function initControls() {
    $("#baseUrlInput, #userInput, #endpointInput, #pidInput, #limitInput").kendoTextBox();
    $("#statusInput").kendoDropDownList({
      optionLabel: "Todos", dataTextField: "text", dataValueField: "value",
      dataSource: [
        { text: "completed", value: "completed" }, { text: "running", value: "running" },
        { text: "queued", value: "queued" }, { text: "failed", value: "failed" },
        { text: "cancelled", value: "cancelled" }, { text: "killRequested", value: "killRequested" }
      ]
    });
    $("#refreshButton").kendoButton({ themeColor: "primary", click: () => loadExecutions().catch((error) => setStatus(error.message)) });
    $("#copyIdButton").kendoButton({ click: function () {
      if (!state.selected || !state.selected.executionId) return;
      navigator.clipboard.writeText(state.selected.executionId).then(() => setStatus("ID copiado."), () => setStatus(state.selected.executionId));
    }});
    $("#userInput, #endpointInput, #pidInput, #limitInput, #baseUrlInput").on("keydown", function (event) {
      if (event.key === "Enter") loadExecutions().catch((error) => setStatus(error.message));
    });
  }
  function initGrid() {
    $("#executionGrid").kendoGrid({
      dataSource: { data: [], pageSize: 25, schema: { model: { id: "executionId", fields: { startedAtDate: { type: "date" }, finishedAtDate: { type: "date" }, durationMs: { type: "number" } } } } },
      height: "52vh", selectable: "row", sortable: true, filterable: true, resizable: true, reorderable: true,
      pageable: { pageSizes: [10, 25, 50, 100], buttonCount: 5 },
      columns: [
        { field: "startedAtDate", title: "Início", width: 165, format: "{0:dd/MM/yyyy HH:mm:ss}" },
        { field: "executionStatus", title: "Status", width: 125, template: statusTemplate },
        { field: "durationMs", title: "ms", width: 80 },
        { field: "executionType", title: "Tipo", width: 110 },
        { field: "endpoint", title: "Endpoint", width: 260 },
        { field: "programName", title: "Programa", width: 240 },
        { field: "userName", title: "Usuário", width: 150 },
        { field: "pasoePid", title: "PID", width: 120 },
        { field: "errorMessage", title: "Mensagem", width: 230 },
        { field: "executionId", title: "Execução", width: 220 }
      ],
      change: function () {
        const item = this.dataItem(this.select());
        loadDetail(item && item.executionId).catch((error) => setStatus(error.message));
      }
    });
  }
  $(function () {
    kendo.culture("pt-BR");
    initControls();
    initGrid();
    loadExecutions().catch((error) => setStatus(error.message));
  });
})();
