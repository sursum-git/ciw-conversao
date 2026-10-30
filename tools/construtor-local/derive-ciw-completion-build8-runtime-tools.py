"""Prepare build8 generators only; no inspection, SSH or publication."""
from pathlib import Path
import re
R=Path(__file__).resolve().parents[2];T=R/'tools/construtor-local'
for kind in ['runtime','publication']:
    value=(T/f'prepare-ciw-completion-build7-{kind}.py').read_text(encoding='utf-8')
    value=value.replace('official-build7','official-build8').replace('ciw-completion-20261028-wave4','ciw-completion-20261028-wave5')
    value=value.replace('4120','4664').replace('completion-wave4-tmp','completion-wave5-tmp')
    value=re.sub(r'(?<![A-Za-z0-9_.])25(?![0-9])','19',value)
    value=value.replace('25artifact','19artifact').replace('25runtime','19runtime')
    if kind=='publication':
        old="for folder in ['official-build5-v6','official-build6-v2']:"
        assert value.count(old)==1
        value=value.replace(old,"for folder in ['official-build5-v6','official-build6-v2','official-build7']:",1)
        start=value.index("priority=['ImportDiscountsReadTables'")
        end=value.index('\ndef priorityKey',start)
        value=value[:start]+"priority=['ContainerProcessBoundary','ContainerExpenseDefaultsPlan','SampleContainerItemsTable','ContainersImpostosService','ContainersProcessosService','SampleContainerItemsCollector','SampleContainerItemsReadService','SampleContainerItemsReadApi','ContainersProcessos','CiwErpReadService','CiwCadastrosCrud']"+value[end:]
    path=T/f'prepare-ciw-completion-build8-{kind}.py'
    assert not path.exists(),'Preserve any already prepared build8 generator'
    compile(value,str(path),'exec')
    path.write_text(value,encoding='utf-8')
print('Prepared build8-only runtime generators; root runs after official proof/fresh inspection. No remote execution.')
