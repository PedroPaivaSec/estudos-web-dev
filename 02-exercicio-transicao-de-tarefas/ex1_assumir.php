<?php 

session_start();

var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercício 1: assumir tarefa solta</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<main>
  <h1>Tarefas soltas</h1>
  <p class="apoio">Demandas gerais sem responsável. Quem estiver livre assume.</p>

  <!-- Simula o login. No projeto real o usuário vem do login, nunca de um select. -->
  <form class="barra" method="post" action="trocar_usuario.php">
    <label for="usuario">Agir como</label>
    <select id="usuario" name="usuario_id">
      <option value="1">Ana (id 1)</option>
      <option value="2">Bruno (id 2)</option>
    </select>
    <button type="submit">Trocar</button>
  </form>

  <!-- Mensagem de retorno: o PHP imprime UMA destas duas, conforme o resultado -->
  <div class="aviso ok" role="status">Tarefa assumida com sucesso.</div>
  <div class="aviso erro" role="alert">Esta tarefa já foi assumida por outra pessoa.</div>

  <table>
    <thead>
      <tr><th>Tarefa</th><th>Status</th><th>Responsável</th><th>Ação</th></tr>
    </thead>
    <tbody>
      <!-- Repita esta linha com um foreach do PHP -->
      <tr>
        <td>Conferir guias do mês</td>
        <td>Em aguardo</td>
        <td>Ninguém</td>
        <td>
          <form method="post" action="assumir.php">
            <input type="hidden" name="tarefa_id" value="1">
            <button type="submit">Assumir</button>
          </form>
        </td>
      </tr>
      <tr>
        <td>Organizar pasta de documentos</td>
        <td>Em andamento</td>
        <td>Ana</td>
        <td>Indisponível</td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
