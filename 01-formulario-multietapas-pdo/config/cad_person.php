<?php

require_once __DIR__ . '/conexao.php';

//Mesma ideia da trava no lado do servidor, se de alguma forma a requisição pra esse script vier diferente de POST, o usuario é redirecionado de volta pro index.
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: " . BASE_URL . "/index.php");
}

//caso contrario, insira os dados no array.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_SESSION['usr']['dado'] = [
        'nome' => $_POST['nome'],
        'telefone' => $_POST['telefone'],
        'cpf' => $_POST['cpf']
        ];
    
    header("Location: " . BASE_URL . "/cadEnd.php");
}

?>