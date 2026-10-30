"""Gera o escopo CIW alcançável a partir do menu Scriptcase conhecido.

Não acessa o servidor, não executa PHP e não altera dados de negócio.  A fonte
é o inventário remoto já coletado, cuja lista de referências foi extraída dos
fontes publicados do Scriptcase.  O resultado não substitui uma conferência
do cadastro dinâmico ``itens_menu`` quando o SSH estiver disponível.
"""
from __future__ import annotations

import argparse
import collections
import json
from datetime import datetime, timezone
from pathlib import Path


ROOT = Path(__file__).resolve().parents[2]
DEFAULT_ROOTS = ("menu_ctrl_importacao",)
STATUS_ORDER = ("Convertido", "Parcial", "Preparado", "Pendente", "Triagem")


def normalized_status(entry: dict) -> str:
    state_group = entry.get("state_group", "")
    if state_group in STATUS_ORDER:
        return state_group
    raise ValueError(f"Estado não classificado: {entry.get('name')}: {state_group!r}")


def closure(entries: dict[str, dict], roots: tuple[str, ...]) -> tuple[dict[str, int], list[dict]]:
    distance: dict[str, int] = {}
    dangling: list[dict] = []
    queue: collections.deque[tuple[str, int]] = collections.deque((root, 0) for root in roots)
    while queue:
        name, depth = queue.popleft()
        prior = distance.get(name)
        if prior is not None and prior <= depth:
            continue
        distance[name] = depth
        entry = entries.get(name)
        if entry is None:
            continue
        for target in entry.get("references", []):
            if target not in entries:
                dangling.append({"source": name, "target": target})
                continue
            queue.append((target, depth + 1))
    return distance, sorted(dangling, key=lambda item: (item["source"], item["target"]))


def build_report(entries: dict[str, dict], roots: tuple[str, ...]) -> dict:
    distances, dangling = closure(entries, roots)
    scoped = []
    for name, depth in distances.items():
        entry = entries.get(name)
        if entry is None:
            continue
        scoped.append({
            "application": name,
            "depth": depth,
            "reach": "menu" if depth == 0 else "chamada transitiva",
            "status": normalized_status(entry),
            "state": entry["state"],
            "family": entry["family"],
            "technicalType": entry["technical_type"],
            "targetScreen": entry.get("target_screen", ""),
            "remaining": entry["remaining"],
            "calledBy": sorted(entry.get("inbound_references", [])),
            "calls": sorted(entry.get("references", [])),
        })
    scoped.sort(key=lambda item: (STATUS_ORDER.index(item["status"]), item["depth"], item["application"]))
    outside = sorted(set(entries) - set(distances))
    counts = collections.Counter(item["status"] for item in scoped)
    return {
        "generatedAt": datetime.now(timezone.utc).isoformat(),
        "basis": {
            "inventory": "integration-src/ciw-inventory/inventory-reviewed.json",
            "roots": list(roots),
            "coverage": "Fechamento transitivo das referências estáticas de aplicações Scriptcase.",
            "limitation": "O SSH do servidor Scriptcase estava indisponível na geração; confirmar posteriormente as entradas ativas da tabela dinâmica itens_menu."
        },
        "counts": {
            "inScope": len(scoped),
            "byStatus": {status: counts.get(status, 0) for status in STATUS_ORDER},
            "outsideScope": len(outside),
            "unresolvedReferences": len(dangling),
        },
        "inScope": scoped,
        "outsideScope": outside,
        "unresolvedReferences": dangling,
    }


def markdown(report: dict) -> str:
    lines = [
        "# Escopo de conversão CIW — menu e chamadas",
        "",
        "Este documento separa o escopo operacional do inventário histórico. Ele começa nos menus conhecidos e segue chamadas entre aplicações; não transforma backups, testes ou alternativas não alcançadas em escopo de conversão.",
        "",
        "## Base e limite",
        "",
        f"- Raiz: `{', '.join(report['basis']['roots'])}`.",
        f"- {report['basis']['coverage']}",
        f"- **Limite atual:** {report['basis']['limitation']}",
        "",
        "## Resumo",
        "",
        "| Situação | Quantidade |",
        "| --- | ---: |",
    ]
    for status, count in report["counts"]["byStatus"].items():
        lines.append(f"| {status} | {count} |")
    lines.extend([
        f"| Fora do escopo transitivo atual | {report['counts']['outsideScope']} |",
        f"| Referências sem aplicação inventariada | {report['counts']['unresolvedReferences']} |",
        "",
    ])
    for status in STATUS_ORDER:
        rows = [item for item in report["inScope"] if item["status"] == status]
        if not rows:
            continue
        lines.extend([f"## {status}", "", "| Aplicação | Alcance | Tela atual | Situação |", "| --- | --- | --- | --- |"])
        for item in rows:
            screen = item["targetScreen"] or "—"
            reach = "menu" if item["depth"] == 0 else f"nível {item['depth']}"
            lines.append(f"| `{item['application']}` | {reach} | `{screen}` | {item['state']} |")
        lines.append("")
    if report["unresolvedReferences"]:
        lines.extend(["## Referências a conferir", "", "| Origem | Destino |", "| --- | --- |"])
        for edge in report["unresolvedReferences"]:
            lines.append(f"| `{edge['source']}` | `{edge['target']}` |")
        lines.append("")
    lines.extend([
        "## Regra de leitura",
        "",
        "`Convertido` significa que o inventário registra uma conversão publicada/validada para aquela origem ou fluxo absorvido. `Parcial` e `Preparado` continuam pendências; `Triagem` não é conversão e não deve entrar em uma contagem de telas entregues.",
        "",
    ])
    return "\n".join(lines)


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("--root", action="append", dest="roots", help="Aplicação raiz do menu; repetível.")
    args = parser.parse_args()
    roots = tuple(args.roots or DEFAULT_ROOTS)
    input_path = ROOT / "integration-src/ciw-inventory/inventory-reviewed.json"
    output_dir = ROOT / "integration-src/ciw-inventory/menu-scope"
    data = json.loads(input_path.read_text(encoding="utf-8"))
    entries = {entry["name"]: entry for entry in data["entries"]}
    missing = sorted(set(roots) - set(entries))
    if missing:
        raise SystemExit(f"Raiz não inventariada: {', '.join(missing)}")
    report = build_report(entries, roots)
    output_dir.mkdir(parents=True, exist_ok=True)
    (output_dir / "menu-scope.json").write_text(json.dumps(report, ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
    (output_dir / "MENU_E_CHAMADAS.md").write_text(markdown(report), encoding="utf-8")
    print(json.dumps(report["counts"], ensure_ascii=False))


if __name__ == "__main__":
    main()
