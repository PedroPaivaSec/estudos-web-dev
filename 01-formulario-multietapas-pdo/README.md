# Laboratório 01: formulário multi-etapas com PDO e sessão

> **Laboratório congelado de propósito.** Este código foi mantido exatamente como foi concluído, com os erros que ele tem. Ele é o ponto de partida do histórico de aprendizado deste repositório. Os problemas estão listados na seção [Limitações conhecidas](#limitações-conhecidas) e são tratados nos laboratórios seguintes. **Não use este código como referência de boas práticas.**

## Contexto

Este projeto nasceu de uma atividade da disciplina de desenvolvimento web (IF Sudeste MG). O objetivo da aula era um formulário de cadastro simples ligado ao MySQL, usando as funções `mysqli` ensinadas na turma.

Aproveitei a atividade para estudar por conta própria dois assuntos: PDO com prepared statements e controle de estado com `$_SESSION`. O resultado funcionou como exercício de aprendizado, mas está longe de ser um código seguro ou completo. Documento isso aqui de forma aberta para registrar de onde parti.

## O que o laboratório faz

O cadastro de um funcionário é dividido em três telas. Os dados de cada tela ficam na sessão até a última etapa, quando tudo é gravado de uma vez no banco.

1. `index.php`: e-mail e senha. `cadIndex.php` guarda os dois em `$_SESSION['usr']['cred']`.
2. `cadPerson.php`: nome, telefone e CPF. `cad_person.php` guarda em `$_SESSION['usr']['dado']`.
3. `cadEnd.php`: rua, bairro, cidade, estado e CEP. `cad_end.php` guarda em `$_SESSION['usr']['end']`, monta o `INSERT` com prepared statement e grava na tabela `usr`.

Cada tela intermediária confere se a etapa anterior está na sessão. Se não estiver, redireciona para o início.

## Conceitos estudados

- Conexão com o banco usando PDO.
- Prepared statements com placeholders nomeados (`:nome`, `:email`...), para separar a consulta dos dados.
- `$_SESSION` para levar dados entre páginas.
- Travas de fluxo: checar se a etapa anterior foi concluída e se o método da requisição é POST.
- Redirecionamento com `header("Location: ...")`.

## Estrutura

```
01-formulario-multietapas-pdo/
├── config/
│   ├── conexao.php      conexão PDO, session_start e constante BASE_URL
│   ├── cadIndex.php     guarda e-mail e senha na sessão
│   ├── cad_person.php   guarda nome, telefone e CPF na sessão
│   └── cad_end.php      guarda o endereço e grava tudo no banco
├── database/
│   └── banco.sql        criação do banco e da tabela usr
└── public/
    ├── index.php        etapa 1
    ├── cadPerson.php    etapa 2
    ├── cadEnd.php       etapa 3
    ├── cadFin.html      tela de sucesso (não é exibida, ver limitações)
    └── css/pag.css
```

## Limitações conhecidas

Listo o que identifiquei ao revisar o código depois de concluído. A coluna da direita indica o que já foi tratado em exercícios posteriores. O que está como pendente continua pendente.

| # | Problema | Onde | Situação |
|---|---|---|---|
| 1 | Senha gravada em texto puro no banco. O correto é guardar um hash (`password_hash`) e conferir com `password_verify` | `cad_end.php`, coluna `senha` | Pendente |
| 2 | Senha fica guardada na sessão entre as etapas | `cadIndex.php` | Pendente |
| 3 | `header("Location")` sem `exit` depois, então o script continua executando após o redirecionamento | `cad_person.php` e `cad_end.php` (bloqueio de método diferente de POST) | Corrigido no lab 02 |
| 4 | `execute` sem tratamento de erro: e-mail ou CPF repetido gera erro não tratado | `cad_end.php` | Corrigido no lab 02 (`try/catch` com registro em log) |
| 5 | Mensagem de erro da conexão exibida na tela, com detalhes técnicos | `conexao.php` | Corrigido no lab 02 (detalhes só no log, mensagem genérica na tela) |
| 6 | Conexão com o usuário `root` e senha vazia | `conexao.php` | Parcial: o lab 02 usa um usuário de banco dedicado, mas a senha ainda está vazia e as credenciais ainda estão no código |
| 7 | Sem validação no servidor: campos só têm `required` do HTML, sem checar formato de CPF, telefone, CEP ou estado | `cadIndex.php`, `cad_person.php`, `cad_end.php` | Corrigido no lab 02 (validação com `filter_var`) |
| 8 | Sem proteção contra CSRF nos formulários | todos os formulários | Pendente |
| 9 | Caminhos quebrados: os arquivos de `public/` ainda apontam para `../src/`, mas a pasta foi renomeada para `config/` numa mudança de estrutura | `public/*.php` | Mantido. O laboratório não roda sem ajuste (ver abaixo) |
| 10 | A tela `cadFin.html` nunca aparece: depois do `INSERT`, o script redireciona para `cadEnd.php` e apaga a sessão | `cad_end.php` | Mantido |
| 11 | O `banco.sql` cria o banco `pedrdb` e depois usa `pedrodb`, então o script falha em um ambiente limpo | `banco.sql` | Mantido |

## Como rodar (com o ajuste mínimo)

No estado em que foi concluído, o projeto não executa por causa do item 9. Para ver o fluxo funcionando sem alterar a lógica:

1. Use o Laragon e copie a pasta `01-formulario-multietapas-pdo` para dentro do `www`. A constante `BASE_URL` em `config/conexao.php` assume o endereço `http://localhost/01-formulario-multietapas-pdo/public`, então `php -S` não serve para este laboratório.
2. Nos arquivos de `public/` e nos `action` dos formulários, troque `../src/` por `../config/`.
3. No `database/banco.sql`, corrija o nome do banco (`pedrdb` para `pedrodb`) e importe o script.
4. Confira as credenciais em `config/conexao.php` e acesse `http://localhost/01-formulario-multietapas-pdo/public/index.php`.

## O que mudou depois

Este laboratório é o ponto zero da trilha. O laboratório [02-exercicio-transicao-de-tarefas](../02-exercicio-transicao-de-tarefas/) já mostra as correções dos itens 3, 4, 5, 7 e parte do 6, além de escape de saída com `htmlspecialchars` e mensagens de retorno que atravessam o redirecionamento. Os itens 1, 2 e 8 ficam registrados aqui até serem tratados em um exercício próprio.

## Tecnologias

- HTML5 e CSS3
- PHP 8.3
- MySQL
- PDO e prepared statements
- Sessões nativas (`$_SESSION`)
- Laragon como ambiente local
