<?php

require_once __DIR__ . '/../src/conexao.php';

//Trava de segurança do lado do cliente para forçar o usuario a passar pelo index. Verifica se algum dado foi inserido no email ou senha(Array "cred") antes de prosseguir.
if (!isset($_SESSION['usr']['cred'])){

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
        <form action="../src/cad_person.php" method="POST">
            <label for="nome">Nome: </label><br><br>
            <input type="text" name="nome" required><br><br>

            <label for="telefone">Telefone: </label><br><br>
            <input type="tel" name="telefone" required><br><br> 

            <label for="cpf">CPF: </label><br><br>
            <input type="text" name="cpf" required><br><br> 

            <button type="submit" name="Cadastrar" value="Cadastrar">Cadastrar</button>
        </form>
    </main>
</body>
</html>