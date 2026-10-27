<?php

session_start();
require_once __DIR__ . '/../config/connect.php';

$flash = null;

if (isset($_SESSION['flash'])) {
  $flash = $_SESSION['flash'];
  unset($_SESSION['flash']);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercício 1: assumir tarefa solta</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
  <main>
    <h1>Tarefas soltas</h1>
    <p class="apoio">Demandas gerais sem responsável. Quem estiver livre assume.</p>

    <!-- Simula o login. No projeto real o usuário vem do login, nunca de um select. -->
    <form class="barra" method="post" action="../config/trocar_usuario.php">
      <label for="usuario">Agir como</label>
      <select id="usuario" name="usuario_id">
        <option value="1">Ana (id 1)</option>
        <option value="2">Bruno (id 2)</option>
      </select>
      <button type="submit">Trocar</button>
    </form>

    <!-- Mensagem de retorno: o PHP imprime UMA destas duas, conforme o resultado -->
    <?php if (isset($flash)) {

      if (isset($flash['sucesso'])) { ?>
        <div class="aviso ok" role="status"> <?php echo htmlspecialchars($flash['sucesso'], ENT_QUOTES, 'UTF-8') ?></div>
      <?php } elseif (isset($flash['erro'])) { ?>
        <div class="aviso erro" role="alert"><?php echo htmlspecialchars($flash['erro'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php
      }
    } ?>

    <?php if (!isset($_SESSION['usuario_id'])) { ?>

      <div class="aviso erro" role="alert">Clique em trocar para Assumir a tarefa.</div>
    <?php } ?>

    <table>
      <thead>
        <tr>
          <th>Tarefa</th>
          <th>Status</th>
          <th>Responsável</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <!-- Repita esta linha com um foreach do PHP -->
        <tr>
          <td>Conferir guias do mês</td>
          <td>Em aguardo</td>
          <td>Ninguém</td>
          <td>
            <form method="post" action="../config/assumir.php">
              <input type="hidden" name="tarefa_id" value="1">
              <button type="submit">Assumir</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Emitir certidões negativas</td>
          <td>Em aguardo</td>
          <td>Ninguém</td>
          <td>
            <form method="post" action="../config/assumir.php">
              <input type="hidden" name="tarefa_id" value="2">
              <button type="submit">Assumir</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Organizar pasta de documentos</td>
          <td>Em aguardo</td>
          <td>Ninguém</td>
          <td>
            <form method="post" action="../config/assumir.php">
              <input type="hidden" name="tarefa_id" value="3">
              <button type="submit">Assumir</button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</body>

</html>