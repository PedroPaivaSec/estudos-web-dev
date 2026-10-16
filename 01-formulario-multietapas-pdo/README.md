# Formulário Multi-etapas com Autenticação, PDO e Gerenciamento de Sessão

Este projeto nasceu de uma atividade acadêmica cujo objetivo inicial era apenas criar um formulário de cadastro simples conectado ao banco de dados MySQL utilizando PHP estruturado tradicional.

No entanto, decidi **ir muito além do escopo da aula** e das práticas legadas ensinadas. Busquei de forma autônoma soluções modernas de mercado para resolver problemas de segurança e usabilidade, transformando um script básico em uma aplicação web mais robusta e segura.

## 🚀 O Diferencial do Projeto (Indo além da Faculdade)
- **Migração para PDO (PHP Data Objects):** Recusei o uso das funções legadas e inseguras (`mysqli_connect`) ensinadas na grade e implementei a conexão utilizando PDO, o padrão moderno do mercado.
- **Segurança contra SQL Injection:** Utilizei *Prepared Statements* (`prepare` e `execute`) para garantir que todas as entradas de dados no banco sejam tratadas de forma segura.
- **Experiência do Usuário (UX) Multi-etapas:** Para evitar um formulário gigante e cansativo, criei uma mecânica de troca de telas para separar os campos de credenciais (e-mail e senha) dos campos de endereço e dados pessoais.
- **Gerenciamento de Estado com `$_SESSION`:** Como o protocolo HTTP não guarda dados entre as páginas, pesquisei e implementei sessões nativas do PHP para transitar os dados digitados na primeira etapa até a finalização do cadastro no banco de dados.

## 🧠 O que este desafio me ensinou:
1. Como pesquisar documentação técnica e aplicar conceitos que ainda não vi na faculdade.
2. Como funciona o ciclo de requisição e resposta da Web e a importância do controle de sessões.
3. A importância de blindar o código contra vulnerabilidades desde o dia 1 de desenvolvimento.

## 🛠️ Tecnologias e Conceitos Aplicados
- HTML5 / CSS3
- PHP 8.3
- MySQL
- PDO & Prepared Statements
- Sessions (`$_SESSION`)

## 📝 Como rodar o projeto localmente
1. Clone este repositório para o seu ambiente local.
2. Certifique-se de ter o MySQL ativo e importe o script SQL (se houver) ou crie a tabela correspondente.
3. Configure as credenciais do banco no seu arquivo de conexão.
4. Inicie o servidor embutido do PHP na pasta do projeto:
   ```bash
   php -S localhost:8000
   ```
