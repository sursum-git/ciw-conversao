# Auditoria CIW — validação em 21/10/2026

O ajuste foi implementado no projeto original `D:/opencode/construtor-pg` e aplicado à instalação local. tadeu.parreiras/default recebeu somente `ciw.audit.read`, além das 65 permissões anteriores. Assinatura do vínculo e três snapshots LDAP foram confirmados em processo novo; nenhum grupo administrador foi concedido.

O catálogo identifica os 28 programas/telas do CIW pelos vínculos da Home publicada e das telas filhas. O campo Builder.module usa os módulos técnicos cadastros/operacional, portanto não representa o módulo CIW do menu. Nenhuma regra depende apenas do prefixo ciw.

`RuntimeAuditAccessPolicy` aplica assinante e telas autorizadas antes da paginação/total e na busca por ID. Eventos exigem transação pai autorizada. O vínculo é relido e sua assinatura verificada por `AuthService::resolveLiveSubscriberAccess`. Vínculo ausente/inativo nega acesso operacional, mesmo que o snapshot antigo conserve permissões. Os endpoints de auditoria aceitam apenas a entidade configurada e leitura/detalhe. Recursos ORM brutos de auditoria não são um caminho alternativo para usuários operacionais e não permitem escrita.

Evidências: suite original 553 testes/3317 assertivas; final 562 testes/3378 assertivas PASS. Nove testes novos verificam catálogo real, isolamento de lista/total/get/eventos, payload de entidade adulterado pelo dispatcher, revogação de vínculo, ausência obrigatória de política, controles de formulário/lote/processo e proteção ApiPlatform. Container Symfony validado; cache dev sem debug reconstruído e política efetivamente injetada confirmada antes do grant.

Revisão independente identificou dois problemas durante a preparação: fallback para permissões base após remover vínculo, e possibilidade de payload.entityCode substituir a entidade publicada. Ambos foram reproduzidos e corrigidos antes da concessão; revisão final sem bloqueadores. Foi acrescentado também bloqueio explícito quando o serviço de política não estiver injetado.

Visual real, sessão humana: `admin.transacoes` filtrada por `ciw.despesas` carregou dados locais; o link Eventos abriu `admin.logs-transacoes` da transação17858, com quatro eventos. O painel exibiu autoria Tadeu Parreiras e informou que a consulta não alterou dados. Capturas `transacoes-ciw.png` e `eventos-ciw.png` em `.runtime/ciw-audit-20261021/`.

A rede foi restabelecida após a confirmação do usuário. O túnel local19910 foi reaberto para o PASOE9910 da mesma instância sursum-api/med. Conferência visual na sessão humana concluída: Colorações mostra Logs Exclusão e Logs por registro; Despesas mostra Logs Exclusão e Logs no formulário Visualizar; Empresas por despesa preserva despesa_id=1, mostra Incluir/Alterar/Excluir e ambos os controles de histórico. O histórico da despesa1 carregou21 transações e o da empresa por despesa carregou4. O histórico de Colorações/registro3 abriu vazio corretamente. Nenhuma escrita de negócio foi executada; não houve importação de histórico Scriptcase nem alteração ABL/PASOE nesta entrega.

Capturas adicionais: `coloracoes-logs.png`, `despesas-formulario-logs.png`, `despesas-formulario-historico.png`, `empresas-despesa-formulario-logs.png`, `empresas-despesa-historico.png`. O isolamento fora do escopo foi comprovado nos testes automatizados de política/dispatcher; nenhuma conta humana foi impersonada para testar uma negativa.

Recibos privados: `.runtime/ciw-audit-20261021/{baseline.json,code-final.json,before.json,applied.json,verify-access.php,canonical-final-suite.log,progress.md}`. Não reaplicar a ferramenta `tools/construtor-local/enable-ciw-audit-access.php`: recibo de execução única já existe. Snapshots agora contêm66 permissões; scripts antigos com expectativa65 devem recusar o estado atual.

A etapa de empresa nas APIs tem plano próprio aprovado e ainda está em implementação. Não confundir liberação de auditoria com troca de empresa operacional já funcionando.
