<?php

//Busca o arquivo conexão.php a partir da raiz desse arquivo(__DIR__) e executa uma unica vez na pagina(_once).
require_once __DIR__ . '/../src/conexao.php';

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
        <form action="../src/cadIndex.php" method="POST">
            <div class="campo">
                <label for="email">Email: </label><br><br>
                <input type="email" name="email" required><br><br>
            </div>

            <div class="campo">
                <label for="senha">Senha: </label><br><br>
                <input type="password" name="senha" required><br><br>
            </div>
            <button type="submit" name="Cadastrar" value="Cadastrar">Cadastrar</button>
        </form>
    </main>
    
</body>
</html>