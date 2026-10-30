# Companion1047 de normalização de enums dependentes

P1: normalizeEntityPayload manda os dois parâmetros string/dropdown ao normalizeOptionItems legado, que os reduz a[]; a validação de lookup dependente exige os mesmos enums fechados. O preview anterior pulava essa etapa ao montar BuilderEntity manualmente. Trocar dataType paraenum continua incompatível com o contrato.

Delta isolado sobre Builder combinado8, somente leitura dessa baseline, sem alterar stage8 ou freezes. Coletar nomes ligados por optionsSource.parameterFields já fechado e preservar enums APIfield string/dropdown somente nesses nomes. Novo helper privado de lista1..20 é chamado tanto na normalização quanto no validator, conservando exatamente a fronteira já existente: value/text string, sem chave extra, duplicata ou coerção. normalizeOptionItems global intacto; campos sem referência seguem caminho antigo. O guard process-only continua obrigatório antes de persistir/publicar CRUD.

RED→GREEN com normalizeEntityPayload e validateExternalDraft reais do JSON1047 congelado, CombinedMetadataTest copiado para runtime próprio, schemas completos, negativas de tipos/referências/listas/CRUD saveDraft/publicação e regressões legadas. Patches de bytes com baseline futuro8 explícito e preservação de EOL fora de anchors. Não compilar ABL, integrar, publicar, conceder acesso ou executar negócio.
