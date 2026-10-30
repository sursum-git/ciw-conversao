# Construtor PG neste computador

O construtor está instalado como ambiente local de desenvolvimento em `D:\opencode\construtor-pg`, com o frontend original e o backend Symfony/PHP. A tela de empresas e a API Progress estão publicadas; consulta e formulário foram verificados com os dados reais.

## Acesso

- Login: http://127.0.0.1:8765/production/login.html
- Editor após o login: http://127.0.0.1:8765/production/program-builder.html
- Empresas: http://127.0.0.1:8765/production/app.html?screenId=ciw.empresas
- Usuário: `admin`, assinante Principal.
- Senha inicial: `D:\opencode\conversao-sc\.runtime\construtor-pg\acesso-local.txt`, arquivo privado local.

Selecione a área administrativa após o login. Os metadados, programas e configurações do construtor ficam no PostgreSQL local, separado do banco de negócio `espec` do Progress.

## Serviços locais

| Componente | Endereço ou pasta |
| --- | --- |
| Frontend e proxy das APIs | `127.0.0.1:8765` |
| Backend PHP 8.4.3 / Symfony 8.0.10 | `127.0.0.1:8000` |
| PostgreSQL 14.3 | `127.0.0.1:55432`, banco `construtor_pg` |
| Dados do cluster e logs | `D:\opencode\conversao-sc\.runtime\construtor-pg` |
| Configuração privada do backend | `backend\.env.local` e `backend\.env.dev.local` |

Para iniciar novamente:

```powershell
& D:\opencode\conversao-sc\tools\construtor-local\start.ps1
```

Para parar os serviços desta instalação:

```powershell
& D:\opencode\conversao-sc\tools\construtor-local\stop.ps1
```

Os processos PHP e Node iniciam em segundo plano. O helper serve os assets do frontend original e encaminha `/api/` ao PHP. Configurações privadas do backend e arquivos Git não são servidos. O serviço PostgreSQL preexistente do computador permanece independente deste cluster.

## Instalação e validação realizadas

Foram instaladas as dependências do `composer.lock` e `package-lock.json`, aplicadas 48 migrações e carregado o catálogo padrão pelo comando oficial `app:install:bootstrap`. O assinante Principal e o administrador foram configurados pelo comando `app:subscriber:create`.

O seed original tinha um defeito em instalações novas: as associações inversas das entidades permaneciam vazias na memória ao assinar a integridade, apesar dos campos já estarem persistidos. Isso passava no monitor executado pelo mesmo processo, mas falhava após recarregar o banco. A correção em `backend/src/Command/SeedRuntimeMetadataCommand.php` limpa o EntityManager após o flush e antes de assinar, fazendo a assinatura usar os campos persistidos.

Evidência registrada:

- Antes da correção, a assinatura da primeira entidade correspondia a `fields=[]`, embora tivesse 14 campos persistidos.
- O teste de instalação nova falhou antes da correção e passou com um segundo banco novo depois dela.
- PHPUnit: 5 testes de integridade estrutural, 52 assertions, todos aprovados.
- Monitor da base principal em sessão separada: 958 registros, 0 inválidos.
- Navegador de teste: login real, escolha da área administrativa e carregamento da árvore do construtor aprovados.
- Arquivos privados: `/backend/.env.local` e `/.git/config` responderam HTTP 403.

Os bancos `construtor_pg_seed_red` e `construtor_pg_seed_green` são exclusivamente dos testes desta instalação. Não contêm dados operacionais Progress.

## Integração de empresas

A especificação está em `docs/superpowers/specs/2026-10-14-empresas-construtor-design.md`, acompanhada de `empresas-screen-proposta.json`, aceito pelo normalizador e validador reais do frontend. A integração usa entidade API e metadados JSON, sem uma nova interface.

O programa é `cd0090`, entidade `empresas_progress`, fonte `motor_progress_empresas`. Os metadados executáveis estão em `D:\opencode\construtor-pg\integrations\ciw-empresas`. O PHP consome o PASOE por túnel SSH autenticado, sem armazenar a senha SSH. Execute `tools\construtor-local\tunnel.ps1` para reconectar e mantenha esse terminal aberto. O túnel atual usa `127.0.0.1:19910` até o conector HTTP 9910 da instância `sursum-api/med`; HTTPS 9911 não foi validado por problema no certificado de teste e no acesso direto.

Veja `integracao-empresas-validacao.md` para publicação, testes e limitações. Os testes de gravação Progress passaram em temp-table e, após autorização explícita do usuário em 15/10/2026, no banco operacional: CRUD pelo PHP e quatro inclusões simultâneas com IDs distintos. Todos os registros de teste foram removidos; empresas preexistentes preservadas. O assistente de ativação comercial do produto conserva seu fluxo próprio; esta instalação local foi preparada pelo bootstrap CLI para desenvolvimento e validação.
