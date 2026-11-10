# 📓 Meus Estudos de PHP

Este repositório centraliza os meus exercícios, códigos de teste e projetos de estudo de **PHP**.

O objetivo é documentar a minha evolução técnica de forma gradual, saindo da base estruturada da web dinâmica, passando pela Orientação a Objetos, até chegar ao entendimento de frameworks modernos como o **Laravel**. Os laboratórios mostram também os erros que cometi e como fui corrigindo cada um.

---

## 🗺️ Trilha de Aprendizado

- [ ] **Fase 1: PHP Estruturado & Web Dinâmica** (em andamento)
  * [x] Formulários com `$_POST` e `$_GET`.
  * [x] Conexão com banco via **PDO** e consultas com *Prepared Statements*.
  * [x] `$_SESSION` para levar dados entre páginas.
  * [x] Padrão POST, redirect, GET: o resultado de uma ação atravessa o redirecionamento por uma mensagem guardada na sessão (flash).
  * [x] Condição de corrida tratada no próprio `UPDATE`, com condição no `WHERE`.
  * [x] Validação de entrada com `filter_var` (IDs) e escape de saída com `htmlspecialchars`.
  * [ ] Login com `password_hash` e `password_verify`.
  * [ ] CRUD completo.
  * [ ] Controle de acesso por perfil.
  * [ ] Proteção contra CSRF.
- [ ] **Fase 2: PHP Orientado a Objetos (POO)**
- [ ] **Fase 3: Ecossistema de Frameworks (Laravel)**

---

## 📂 Laboratórios Desenvolvidos

| Laboratório                                                               | Tema                                                         | Situação                                                      |
| ------------------------------------------------------------------------- | ------------------------------------------------------------ | ------------------------------------------------------------- |
| [01-formulario-multietapas-pdo](./01-formulario-multietapas-pdo/)         | Formulário de cadastro em três telas, com sessão e PDO       | Concluído e congelado de propósito, com os erros documentados |
| [02-exercicio-transicao-de-tarefas](./02-exercicio-transicao-de-tarefas/) | Tarefas de equipe: assumir tarefas e depois transitar status | Exercício 1 concluído. Exercício 2 em andamento               |

### 01: formulário multi-etapas

*O que foi estudado:* criação de um formulário dividido em telas separadas (credenciais, dados pessoais e endereço), usando sessões nativas para levar os dados entre as telas, e persistência no MySQL com PDO e consultas preparadas contra SQL Injection. O código foi mantido como foi concluído, e o README do laboratório lista os problemas que ele tem.

### 02: tarefas de equipe

*Exercício 1, atribuição de tarefa solta (concluído):* listagem de tarefas vindas do banco (`fetchAll` e `foreach`), tradução do status do banco para texto legível, e ação de assumir tarefa com `UPDATE` condicional, que garante que só um de dois usuários simultâneos fique com ela. O resultado da ação volta para a tela por mensagem na sessão (flash), com escape de saída e tratamento de lista vazia.

*Exercício 2, transições de status (Pendente).*

*(Os próximos exercícios serão adicionados aqui conforme eu avançar.)*

---

## 🔓 Pendências em aberto

Registro aqui o que ainda não foi tratado, para deixar claro o que não está resolvido. Os detalhes estão no README de cada laboratório.

| Pendência | Onde aparece |
|---|---|
| Senha gravada em texto puro, sem hash | Laboratório 01 |
| Senha guardada na sessão entre as etapas | Laboratório 01 |
| Proteção contra CSRF | Laboratórios 01 e 02 |
| Credenciais no código, sem `.env`, e senha de banco vazia | Laboratórios 01 e 02 |
| Login real (hoje é simulado por um select) | Laboratório 02 |

---

## 🛠️ Ambiente de Testes

- **Linguagem:** PHP 8.x
- **Banco de Dados:** MySQL
- **Ferramentas:** Git, terminal, Laragon (laboratório 01) e servidor embutido do PHP, `php -S` (laboratório 02)