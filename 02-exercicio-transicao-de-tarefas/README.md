# Exercício 1: atribuição de tarefa solta

Exercício isolado do projeto FiscalWeb (sistema web de tarefas e controle de extração de notas de um escritório contábil). Objetivo: praticar PHP puro com PDO, sessão e validação de entrada antes de levar esses conceitos para o sistema real.

**Status:** em andamento. Etapa 3 de 5.

## Problema

Uma tarefa "solta" (sem responsável) é visível para todos os usuários, e qualquer um pode assumi-la. Se dois usuários clicarem quase ao mesmo tempo, só um deve ficar com a tarefa: o `UPDATE` só altera a linha se `responsavel_id` ainda for nulo, e o `rowCount()` informa se a tarefa foi realmente assumida. Quem não consegue recebe o aviso de que a tarefa já foi assumida.

Entradas inválidas (POST sem `tarefa_id`, ID malformado, método diferente de POST) não geram mensagem na tela, porque os botões da tela nunca produzem esse tipo de requisição. Elas são rejeitadas no servidor e registradas no log.

Limitação conhecida: `rowCount() = 0` não distingue "tarefa já assumida" de "ID inexistente", então o aviso pode não descrever a causa exata.

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
- [ ] **Etapa 3: listagem no `ex1_assumir.php`**
  - [x] `teste_lista.php` isolado funcionando (regra do exercício isolado)
  - [ ] SELECT das tarefas soltas (`responsavel_id IS NULL`)
  - [ ] `fetchAll` e `foreach` no `<tbody>`
  - [ ] `value` do campo escondido com o id real da tarefa
  - [ ] Todo texto vindo do banco com `htmlspecialchars`
- [x] **Etapa 4: resultado atravessar o redirecionamento**
  - [x] `assumir.php` grava o resultado na sessão, em uma única chave (`flash`), com tipo (`sucesso` ou `erro`) e texto: `rowCount()` igual a 1 gera `sucesso`, qualquer outro valor gera `erro`, e falha do banco no `catch` também gera `erro`
  - [x] `ex1_assumir.php` lê a mensagem no topo, antes do HTML, apaga da sessão na mesma hora e só imprime no HTML, escapada com `htmlspecialchars`, uma única vez
- [ ] **Etapa 5: limpeza**
  - [x] Remover o `var_dump($_SESSION)`
  - [x] Tratar POST sem `tarefa_id`
  - [x] Criar um usuário do banco exclusivo para a aplicação, em vez de usar o root
  - [ ] Finalizar este README

## Como rodar

1. Criar o banco e as tabelas, com o nome do script SQL (Banco pronto em [database](./database/bd.sql)).
2. Configurar as credenciais no [connect](./config/connect.php), de acordo com seu banco.
3. Subir o servidor na pasta raiz usando `php -S localhost:8000`
4. Acessar `http://localhost:8000/public/ex1_assumir.php`

## Segurança

- Entrada validada no servidor antes de chegar ao banco (`filter_var`).
- Consultas com parâmetros usam prepared statements.
- Saída vinda do banco escapada com `htmlspecialchars`.
- Mensagens de erro de conexão genéricas, com detalhes só no log.
- Usuário de banco exclusivo da aplicação criado, no lugar do root.
- Pendente: Proteção CSRF no POST.
- Pendente: Salvar credenciais em arquivos .env
- Ponto a analisar: como a ação "assumir" poderia ser abusada? (ID manipulado, requisição repetida, usuário sem permissão)