# Exercício 1: atribuição de tarefa solta

Exercício isolado do projeto FiscalWeb (sistema web de tarefas e controle de extração de notas de um escritório contábil). Objetivo: praticar PHP puro com PDO, sessão e validação de entrada antes de levar esses conceitos para o sistema real.

**Status:** em andamento. A funcionalidade principal está pronta. Restam as pendências listadas em "Limitações e pendências".

## Problema

Uma tarefa "solta" (sem responsável) é visível para todos os usuários, e qualquer um pode assumi-la. Se dois usuários clicarem quase ao mesmo tempo, só um deve ficar com a tarefa: o `UPDATE` só altera a linha se `responsavel_id` ainda for nulo, e o `rowCount()` informa se a tarefa foi realmente assumida. Quem não consegue recebe o aviso de que a tarefa já foi assumida.

A listagem traz só tarefas sem responsável, então a tarefa assumida some da tela. A visão de "minhas tarefas" fica para o painel do sistema real.

Entradas inválidas (POST sem `tarefa_id`, ID malformado, método diferente de POST) não geram mensagem na tela, porque os botões da tela nunca produzem esse tipo de requisição. Elas são rejeitadas no servidor e registradas no log.

## Estrutura de arquivos

| Arquivo | Função |
|---|---|
| `config/connect.php` | Cria o `$pdo`. Não imprime nada e interrompe o script se a conexão falhar |
| `config/assumir.php` | Recebe o POST, valida o `tarefa_id`, tenta assumir a tarefa e grava o resultado na sessão |
| `config/trocar_usuario.php` | Simula o login: grava o `usuario_id` do select na sessão, sem validação. No sistema real o usuário vem do login |
| `config/reset_banco.php` | Ferramenta de teste: define `responsavel_id` como nulo nas tarefas dos usuários 1 e 2. Ver pendências |
| `public/ex1_assumir.php` | Página: SELECT e leitura da mensagem no topo, listagem e botão de assumir no HTML |
| `public/css/estilo.css` | Estilos da página |
| `database/bd.sql` | Cria o banco, as tabelas e os dados de exemplo |
| `exercicios_isolados/teste_lista.php` | Teste isolado da listagem (SELECT, `fetchAll`, `foreach`, `htmlspecialchars`) |

O arquivo `public/ex2_transicoes.php` pertence ao Exercício 2 e não é coberto aqui.

## Como a mensagem de retorno funciona

1. O `assumir.php` decide o resultado e grava uma única chave na sessão: `$_SESSION['flash']`, com o tipo (`sucesso` ou `erro`) como chave e o texto como valor.
2. Redireciona para `ex1_assumir.php` (POST, redirect, GET).
3. A página lê a chave no topo, antes do HTML, e apaga da sessão na mesma hora.
4. O HTML só imprime, com `htmlspecialchars`. Ao recarregar a página, a mensagem não reaparece.

## Etapas

- [x] **Etapa 1: `connect.php`**
  - [x] Remover o `echo "CONECTADO"` (saída antes do `header("Location")` quebra o redirecionamento)
  - [x] Interromper o script no `catch` com mensagem genérica, sem detalhes técnicos
- [x] **Etapa 2: validar `tarefa_id` no `assumir.php`**
  - [x] `filter_var` com `FILTER_VALIDATE_INT` e comparação com `=== false`
- [ ] **Etapa 3: listagem no `ex1_assumir.php`**
  - [x] `teste_lista.php` isolado funcionando (regra do exercício isolado)
  - [x] SELECT das tarefas soltas (`responsavel_id IS NULL`)
  - [x] `fetchAll` e `foreach` no `<tbody>`
  - [x] `value` do campo escondido com o id real da tarefa
  - [x] Todo texto vindo do banco com `htmlspecialchars`
  - [x] Status do banco traduzido para texto legível por dicionário
  - [ ] Mensagem quando não há tarefas soltas
- [x] **Etapa 4: resultado atravessar o redirecionamento**
  - [x] `assumir.php` grava o resultado na sessão, em uma única chave (`flash`), com tipo (`sucesso` ou `erro`) e texto: `rowCount()` igual a 1 gera `sucesso`, qualquer outro valor gera `erro`, e falha do banco no `catch` também gera `erro`
  - [x] `ex1_assumir.php` lê a mensagem no topo, antes do HTML, apaga da sessão na mesma hora e só imprime no HTML, escapada com `htmlspecialchars`, uma única vez
- [x] **Etapa 5: limpeza**
  - [x] Remover o `var_dump($_SESSION)`
  - [x] Tratar POST sem `tarefa_id`
  - [x] Criar um usuário do banco exclusivo para a aplicação, em vez de usar o root
  - [x] Finalizar este README

## Como rodar

Requisitos: PHP com a extensão `pdo_mysql` e um servidor MySQL ou MariaDB.

1. Executar o script [bd.sql](./database/bd.sql). Atenção: ele começa com `DROP DATABASE IF EXISTS exercicios` e apaga qualquer banco com esse nome.
2. Criar um usuário de banco exclusivo para a aplicação. O código só executa `SELECT` e `UPDATE` na tabela `tarefas`.
3. Ajustar usuário e senha em [connect.php](./config/connect.php).
4. Subir o servidor na pasta raiz: `php -S localhost:8000`
5. Acessar `http://localhost:8000/public/ex1_assumir.php`

## Como testar a corrida

1. Abrir a página em duas janelas, sendo uma anônima (a sessão é compartilhada entre abas do mesmo navegador).
2. Em cada janela, escolher um usuário diferente e clicar em "Trocar".
3. Recarregar as duas, para que ambas mostrem a mesma lista.
4. Na janela A, assumir a tarefa 1.
5. Na janela B, que ainda mostra a lista antiga, assumir a mesma tarefa 1.
6. Resultado esperado: A recebe o aviso de sucesso, B recebe "Esta tarefa já foi assumida por outra pessoa", e o banco guarda o usuário de A como responsável.

O botão "reset" devolve as tarefas à situação de teste, com a ressalva descrita nas pendências.

## Segurança

Implementado:

- Entrada validada no servidor antes de chegar ao banco (`filter_var`).
- Consultas com parâmetros usam prepared statements.
- Saída vinda do banco escapada com `htmlspecialchars`, inclusive o `value` do campo escondido.
- Usuário de banco exclusivo da aplicação, no lugar do root.
- A condição de corrida é resolvida no próprio `UPDATE`, com `responsavel_id IS NULL` no `WHERE`.

## Limitações e pendências

Segurança:

- Sem proteção CSRF nos POSTs.
- Credenciais de banco escritas no `connect.php`, sem arquivo `.env`.
- A senha do usuário do banco está vazia no `connect.php`. 
- Não há login: `trocar_usuario.php` aceita qualquer `usuario_id`, sem validação. É uma simulação assumida para o exercício.
- A pasta `config/` fica dentro da raiz servida por `php -S`. No sistema real, só `public/` deve ser exposto.

Funcionais:

- A listagem não trata o caso sem tarefas soltas: a tabela aparece só com o cabeçalho.
- `rowCount() = 0` não distingue "tarefa já assumida" de "ID inexistente", então o aviso pode não descrever a causa exata.
- O reset zera o responsável de todas as tarefas dos usuários 1 e 2, inclusive as que já nasciam atribuídas no `bd.sql`. Depois dele, tarefas "Em andamento" e "Concluída" aparecem na lista como assumíveis. Para voltar ao estado original, rode o `bd.sql` de novo.
- Falha do banco na listagem interrompe a página com `die` e mensagem genérica, sem o layout.