# Exercício 1: atribuição de tarefa solta

Exercício isolado do projeto FiscalWeb (sistema web de tarefas e controle de extração de notas de um escritório contábil). Objetivo: praticar PHP puro com PDO, sessão e validação de entrada antes de levar esses conceitos para o sistema real.

**Status:** em andamento. Etapa 3 de 5.

## Problema

Uma tarefa "solta" (sem responsável) é visível para todos os usuários, e qualquer um pode assumi-la. Se dois usuários clicarem quase ao mesmo tempo, só um deve ficar com a tarefa. O sistema precisa distinguir dois casos diferentes: entrada inválida (ID malformado) e "perdeu a corrida" (a tarefa já foi assumida por outro).

## Estrutura de arquivos

| Arquivo | Função |
|---|---|
| `connect.php` | Cria o `$pdo`. Não imprime nada e interrompe o script se a conexão falhar |
| `assumir.php` | Recebe o POST, valida o `tarefa_id`, tenta assumir a tarefa e grava o resultado na sessão |
| `ex1_assumir.php` | Página com a listagem de tarefas soltas e o botão de assumir |
| `teste_lista.php` | Teste isolado da listagem (SELECT, `fetchAll`, `foreach`, `htmlspecialchars`) |

## Etapas

- [x] **Etapa 1: `connect.php`**
  - [x] Remover o `echo "CONECTADO"` (saída antes do `header("Location")` quebra o redirecionamento)
  - [x] Interromper o script no `catch` com mensagem genérica, sem detalhes técnicos
- [x] **Etapa 2: validar `tarefa_id` no `assumir.php`**
  - [x] `filter_var` com `FILTER_VALIDATE_INT` e comparação com `=== false`
- [ ] **Etapa 3: listagem no `ex1_assumir.php`** (em andamento)
  - [x] `teste_lista.php` isolado funcionando (regra do exercício isolado)
  - [ ] SELECT das tarefas soltas (`responsavel IS NULL`)
  - [ ] `fetchAll` e `foreach` no `<tbody>`
  - [ ] `value` do campo escondido com o id real da tarefa
  - [ ] Todo texto vindo do banco com `htmlspecialchars`
- [ ] **Etapa 4: resultado atravessar o redirecionamento**
  - [ ] `assumir.php` grava o recado na sessão conforme o `rowCount()` (1 = sucesso, 0 = já assumida)
  - [ ] `ex1_assumir.php` lê o recado, apaga e exibe a mensagem uma única vez
- [ ] **Etapa 5: limpeza**
  - [ ] Remover o `var_dump($_SESSION)`
  - [x] Tratar POST sem `tarefa_id`
  - [x] Criar um usuário do banco exclusivo para a aplicação, em vez de usar o root
  - [ ] Finalizar este README

## Como rodar

1. Criar o banco e as tabelas, com o nome do script SQL (Banco pronto em [database](./database/bd.sql)).
2. Configurar as credenciais no [connect](./config/connect.php), de acordo com seu banco.
3. Subir o servidor na pasta raiz usando `php -S localhost:8000 -t public`
4. Acessar `http://localhost:8000/public/ex1_assumir.php`

## Decisões e aprendizados

- **Sem saída antes de `header()`:**
- **Parar quando a conexão falha:** 
- **`=== false` em vez de `!`:**
- **Entrada inválida vs. perdeu a corrida:**
- **Sessão em vez de parâmetro na URL para o recado:**
- **Por que `htmlspecialchars`:**
- **Erros encontrados e como resolvi:** 

## Segurança

- Entrada validada no servidor antes de chegar ao banco (`filter_var`).
- Consultas com parâmetros usam prepared statements. 
- Saída vinda do banco escapada com `htmlspecialchars`.
- Mensagens de erro de conexão genéricas, com detalhes só no log.
- Pendente: usuário de banco com privilégios mínimos (Etapa 5).
- Pendente: Proteção CSRF no POST.
- Pendente: Salvar credenciais em arquivos .env
- Ponto a analisar: como a ação "assumir" poderia ser abusada? (ID manipulado, requisição repetida, usuário sem permissão)