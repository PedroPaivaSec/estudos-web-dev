<?php

session_start();
require_once __DIR__ . '/connect.php';

if (!isset($_SESSION['usuario_id'])) {
    error_log("Usuario sem sessão");
    header("Location: ../public/ex1_assumir.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['tarefa_id'])) {
        error_log("Um POST chegou sem tarefa_id");
        header("Location: ../public/ex1_assumir.php");
        exit;
    }

    $task = filter_var($_POST['tarefa_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $usr = filter_var($_SESSION['usuario_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if ($task === false) {

        error_log("Id inválido para essa tarefa");
        header("Location: ../public/ex1_assumir.php");
        exit;
    }
    if ($usr === false) {

        error_log("Id inválido para esse usuario");
        header("Location: ../public/ex1_assumir.php");
        exit;
    }
    try {
        $query = "UPDATE tarefas SET responsavel_id = :user WHERE responsavel_id IS NULL AND id = :taskid";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':user' => $usr,
            ':taskid' => $task
        ]);

        header("Location: ../public/ex1_assumir.php");
        exit;
    } catch (PDOException $e) {

        error_log("Erro de atribuição: " . $e->getMessage());
        die("Falha ao atribuir a tarefa para esse usuário");
    }
} else {

    error_log("Metodo de requisição diferente de POST");
    header("Location: ../public/ex1_assumir.php");
    exit;
}
