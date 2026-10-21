<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercício 2: transições de status</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<main>
  <h1>Minhas tarefas</h1>
  <p class="apoio">Conclua, reabra ou devolva para o grupo.</p>

  <!-- Simula o login. No projeto real o usuário vem do login, nunca de um select. -->
  <form class="barra" method="post" action="../config/trocar_usuario.php">
    <label for="usuario">Agir como</label>
    <select id="usuario" name="usuario_id">
      <option value="1">Ana (id 1)</option>
      <option value="2">Bruno (id 2)</option>
    </select>
    <button type="submit">Trocar</button>
  </form>

  <!-- O PHP imprime UMA destas mensagens, conforme o resultado -->
  <div class="aviso ok" role="status">Tarefa atualizada.</div>
  <div class="aviso erro" role="alert">Não foi possível atualizar esta tarefa.</div>

  <table>
    <thead>
      <tr><th>Tarefa</th><th>Status</th><th>Concluída em</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <!-- Cada status mostra só os botões que fazem sentido. Mas atenção: esconder botão não é proteção. -->
      <tr>
        <td>Enviar relatório ao gestor</td>
        <td>Em andamento</td>
        <td>-</td>
        <td>
          <form method="post" action="../config/concluir.php">
            <input type="hidden" name="tarefa_id" value="1">
            <button type="submit">Concluir</button>
          </form>
          <form method="post" action="../config/devolver.php">
            <input type="hidden" name="tarefa_id" value="1">
            <button type="submit">Devolver</button>
          </form>
        </td>
      </tr>
      <tr>
        <td>Atualizar cadastro de clientes</td>
        <td>Concluída</td>
        <td>20/10/2026 14:32</td>
        <td>
          <form method="post" action="../config/reabrir.php">
            <input type="hidden" name="tarefa_id" value="2">
            <button type="submit">Reabrir</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
