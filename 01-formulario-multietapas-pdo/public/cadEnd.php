<?php

require_once __DIR__ . '/../src/conexao.php';

//Mesma trava da pagina anterior, mas agora verifica o array "cred" e "dado" de dentro da sessão.
if (!isset($_SESSION['usr']['cred']) OR !isset($_SESSION['usr']['dado'])){

    header("Location: " . BASE_URL . "/index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pag.css">
    <title>Cadastro de funcionário</title>
</head>
<body>
    <header>
        <h1>Cadastro de funcionário</h1>
    </header>
    <main>
        <form action="../src/cad_end.php" method="POST">
            Rua: <br><br>
            <input type="text" name="rua" required><br><br>

            Bairro: <br><br>
            <input type="text" name="bairro" required><br><br>

            Cidade: <br><br>
            <input type="text" name="cidade" required><br><br>

            Estado: <br><br>
            <input type="text" name="estado" required><br><br>
            
            Cep: <br><br>
            <input type="text" name="cep" required><br><br>

            <button type="submit" name="Cadastrar" value="Cadastrar">Cadastrar</button>
        </form>
    </main>
</body>
</html>