<?php

require_once __DIR__ . '/conexao.php';

//trava do lado do servidor, caso o metodo de incerção de dados vier via POST, prosseguir, caso contrario não executa.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['usr']['cred'] = [
        'email' => $_POST['email'],
        'senha' => $_POST['senha']
        ];
    header("Location: " . BASE_URL . "/cadPerson.php");
}

?>