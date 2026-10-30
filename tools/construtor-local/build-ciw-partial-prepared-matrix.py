"""Gera a matriz de equivalência das origens CIW parciais e preparadas.

Lê somente o inventário e cópias locais dos fontes Scriptcase. Não executa PHP,
não acessa servidores e não altera o estado de nenhuma aplicação.
"""
from __future__ import annotations

import json
from pathlib import Path


ROOT = Path(__file__).resolve().parents[2]
SOURCE_ROOT = ROOT / "sources/scriptcase"
TARGET_STATUSES = ("Parcial", "Preparado")


def evidence_for(status: str) -> str:
    if status == "Parcial":
        return "API, metadata publicada e validação de leitura/navegação"
    if status == "Preparado":
        return "API/metadata publicados e cenário autorizado para processo gravador"
    raise ValueError(f"Estado sem regra de evidência: {status}")


def build_matrix(entries: list[dict], source_files: dict[str, list[str]]) -> list[dict]:
    rows = []
    for entry in entries:
        status = entry.get("state_group")
        if status not in TARGET_STATUSES:
            continue
        name = entry["name"]
        rows.append({
            "application": name,
            "status": status,
            "legacyState": entry.get("state", ""),
            "family": entry.get("family", ""),
            "technicalType": entry.get("technical_type", ""),
            "targetScreen": entry.get("target_screen", ""),
            "knownGap": entry.get("remaining", ""),
            "sourceFiles": sorted(source_files.get(name, [])),
            "requiredEvidence": evidence_for(status),
        })
    return sorted(rows, key=lambda row: (TARGET_STATUSES.index(row["status"]), row["application"]))


def normalize_scope_entries(entries: list[dict]) -> list[dict]:
    """Adapta somente as origens já alcançadas pelo menu para a matriz."""
    return [
        {
            "name": entry["application"],
            "state_group": entry["status"],
            "state": entry.get("state", ""),
            "family": entry.get("family", ""),
            "technical_type": entry.get("technicalType", ""),
            "target_screen": entry.get("targetScreen", ""),
            "remaining": entry.get("remaining", ""),
        }
        for entry in entries
    ]


def discover_sources() -> dict[str, list[str]]:
    result: dict[str, list[str]] = {}
    for path in SOURCE_ROOT.rglob("*"):
        if not path.is_file():
            continue
        for parent in path.parents:
            if parent == SOURCE_ROOT:
                break
            result.setdefault(parent.name, []).append(str(path.relative_to(ROOT)).replace("\\", "/"))
            break
    return result


def markdown(rows: list[dict]) -> str:
    lines = [
        "# Matriz de equivalência — CIW parcial e preparado",
        "",
        "Gerada apenas de inventário e cópias locais dos fontes Scriptcase. Uma origem não é promovida a convertida por esta matriz.",
        "",
        "| Origem | Estado | Tela atual | Fonte local | Gap conhecido | Evidência para encerrar |",
        "| --- | --- | --- | --- | --- | --- |",
    ]
    for row in rows:
        source = "<br>".join(f"`{file}`" for file in row["sourceFiles"]) or "—"
        screen = f"`{row['targetScreen']}`" if row["targetScreen"] else "—"
        lines.append(
            f"| `{row['application']}` | {row['status']} | {screen} | {source} | {row['knownGap']} | {row['requiredEvidence']} |"
        )
    return "\n".join(lines) + "\n"


def main() -> None:
    scope_path = ROOT / "integration-src/ciw-inventory/menu-scope/menu-scope.json"
    output_dir = ROOT / "integration-src/ciw-completion-20261028/partial-prepared"
    entries = normalize_scope_entries(json.loads(scope_path.read_text(encoding="utf-8"))["inScope"])
    rows = build_matrix(entries, discover_sources())
    output_dir.mkdir(parents=True, exist_ok=True)
    (output_dir / "matriz-equivalencia.json").write_text(
        json.dumps({"rows": rows}, ensure_ascii=False, indent=2) + "\n", encoding="utf-8"
    )
    (output_dir / "MATRIZ_EQUIVALENCIA.md").write_text(markdown(rows), encoding="utf-8")
    print(json.dumps({"partial": sum(row["status"] == "Parcial" for row in rows), "prepared": sum(row["status"] == "Preparado" for row in rows)}, ensure_ascii=False))


if __name__ == "__main__":
    main()
