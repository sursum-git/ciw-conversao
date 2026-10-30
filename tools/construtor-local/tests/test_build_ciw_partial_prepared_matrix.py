import importlib.util
import unittest
from pathlib import Path


ROOT = Path(__file__).resolve().parents[3]
MODULE_PATH = ROOT / "tools/construtor-local/build-ciw-partial-prepared-matrix.py"


def load_module():
    spec = importlib.util.spec_from_file_location("partial_prepared_matrix", MODULE_PATH)
    module = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(module)
    return module


class BuildMatrixTest(unittest.TestCase):
    def test_normalizes_menu_scope_entries_without_promoting_other_inventory_rows(self):
        module = load_module()
        scoped = module.normalize_scope_entries([
            {"application": "partial", "status": "Parcial", "state": "P", "family": "F", "technicalType": "Consulta", "targetScreen": "ciw.p", "remaining": "gap"},
            {"application": "ready", "status": "Convertido", "state": "C", "family": "F", "technicalType": "Consulta", "targetScreen": "ciw.c", "remaining": ""},
        ])

        self.assertEqual([entry["name"] for entry in scoped], ["partial", "ready"])
        self.assertEqual(scoped[0]["state_group"], "Parcial")
        self.assertEqual(scoped[0]["target_screen"], "ciw.p")

    def test_keeps_only_partial_and_prepared_entries_with_required_evidence_fields(self):
        module = load_module()
        entries = [
            {"name": "ready", "state_group": "Convertido"},
            {"name": "partial", "state_group": "Parcial", "state": "Parcial", "remaining": "gap", "target_screen": "ciw.partial", "technical_type": "Consulta/grade", "family": "F"},
            {"name": "prepared", "state_group": "Preparado", "state": "Preparado", "remaining": "gap", "target_screen": "", "technical_type": "Blank", "family": "F"},
        ]

        matrix = module.build_matrix(entries, {"partial": ["sources/a.php"], "prepared": []})

        self.assertEqual([row["application"] for row in matrix], ["partial", "prepared"])
        self.assertEqual(matrix[0]["sourceFiles"], ["sources/a.php"])
        self.assertEqual(matrix[1]["sourceFiles"], [])
        self.assertEqual(matrix[0]["requiredEvidence"], "API, metadata publicada e validação de leitura/navegação")
        self.assertEqual(matrix[1]["requiredEvidence"], "API/metadata publicados e cenário autorizado para processo gravador")


if __name__ == "__main__":
    unittest.main()
