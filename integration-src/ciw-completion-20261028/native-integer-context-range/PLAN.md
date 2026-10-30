# Native integer context range — plano de implementação

**Objetivo:** permitir contexto inteiro em faixa explícita, inclusive fornecedor0/negativo da origem1056, mantendo o comportamento positivo legado quando a opção não existe.

**Arquitetura:** propriedade opcional fechada `contextFields[].integerRange={min,max}`; os dois limites são inteiros int32 inclusivos e min≤max. Somente campo integer. Builder candidato205e preserva/valida o contrato; schema JSON valida forma/chaves/limites; validator JS e Engine fecham também tipo de campo/ordem dos limites. Sem keywords custom de AJV, nova biblioteca, Kendo, frontend paralelo ou relaxamento do resolvedor PHP genérico.

**Autorização:** gerente/root aprovaram este desenho sobre Builder205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7 candidato. O canônico72c6 não será escrito. Freeze1056ad6ae7a9 permanece imutável.

1. Copiar quatro baselines por hash (Builder205e, CRUDschema, CrudDefinitionValidator e CrudEngine) e guardar alvos canônicos/dependência decimal separados.
2. Escrever testes reais de Builder, schema/AJV, validator e Engine: fullint32/subrange,0/neg/minint, limites, ausência, chaves desconhecidas, ordem/tipos inválidos, overflow/float/bool/string−0. Capturar RED nas implementações antigas.
3. Alterar apenas os quatro pontos fechados. O ramo sem range do Engine mantém exatamente os bytes e comportamento antigos. Range explícito usa somente inteiro numérico ou string decimal canônica; nunca array/objeto/bool/float/−0 textual.
4. Criar companion1056 separado: somente integerRange no campo fornecedor_id e proposal de duas operações aditivas sobre fonte146 exportada. Preview real usa Builder205e+range e comprova filtros decimais numéricos; nenhum catálogo é gravado.
5. Rodar GREEN, regressões de normalização, FULLPHP com todas classes modificadas e fonte1056, AJV/validator/Engine reais; comparar ausência da opção com baseline por matriz. Binpatch por hash/aplicação/reversão; preservar demais schema capabilities, inclusive batch snapshot.
6. Congelar candidato/provas, registrar limites e entregar para revisão. Sem rede, canônicos, integração, publicação, grants ou negócio.

Schema2020 puro não compara dinamicamente min/max nem resolve dataModel[field]. A validação relacional completa fica em Builder+validatorJS+Engine. O schema continua fechado e limita ambos os valores ao domínio int32; os testes não o apresentam como substituto da validação completa.
