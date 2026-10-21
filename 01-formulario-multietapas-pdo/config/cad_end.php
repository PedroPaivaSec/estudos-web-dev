<?php

require_once __DIR__ . '/conexao.php';

//Bloqueia requisição diferente de POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: " . BASE_URL . "/index.php");
}

//Verifica se todos os dados foram inseridos
if (!isset($_SESSION['usr']['cred']) && !isset($_SESSION['usr']['dado'])){

    header("Location: " . BASE_URL . "/index.php");
    exit();
}

//Insere o restante dos dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_SESSION['usr']['end'] = [
        'rua' => $_POST['rua'],
        'bairro' => $_POST['bairro'],
        'cidade' => $_POST['cidade'],
        'estado' => $_POST['estado'],
        'cep' => $_POST['cep']
    ];
}

//Incerção no banco com todos os dados unificados.

//querry criada para mandar pro banco usando "placeholder" (":nome" ou "?").
$querry = "INSERT INTO usr
            (nome, email, senha, telefone, rua, bairro, cidade, estado, cep, cpf) 
            VALUES
            (:nome, :email, :senha, :telefone, :rua, :bairro, :cidade, :estado, :cep, :cpf)";

// variavel que prepara a querry. Banco de dados valida a estrutura da querry.
$stmt = $pdo->prepare($querry);

// executa a querry no banco com os dados separados da linha da querry.
$stmt->execute([
    ':nome' => $_SESSION['usr']['dado']['nome'],
    ':email' => $_SESSION['usr']['cred']['email'],
    ':senha' => $_SESSION['usr']['cred']['senha'],
    ':telefone' => $_SESSION['usr']['dado']['telefone'],
    ':rua' => $_SESSION['usr']['end']['rua'],
    ':bairro' => $_SESSION['usr']['end']['bairro'],
    ':cidade' => $_SESSION['usr']['end']['cidade'],
    ':estado' => $_SESSION['usr']['end']['estado'],
    ':cep' => $_SESSION['usr']['end']['cep'],
    ':cpf' => $_SESSION['usr']['dado']['cpf']
]);


header("Location: " . BASE_URL . "/cadEnd.php");
unset($_SESSION['usr']);