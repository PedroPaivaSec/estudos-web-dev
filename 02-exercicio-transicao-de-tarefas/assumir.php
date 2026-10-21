<?php

session_start();
require_once "connect.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ./ex1_assumir.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['tarefa_id'])) {

        try {
            $query = "UPDATE tarefas SET responsavel_id = :user WHERE responsavel_id IS NULL AND id = :taskid";
            $stmt = $pdo->prepare($query);

            $task = filter_var($_POST['tarefa_id'], FILTER_VALIDATE_INT);
            $usr = filter_var($_SESSION['usuario_id'], FILTER_VALIDATE_INT);

            $stmt->execute([
                ':user' => $usr,
                ':taskid' => $task
            ]);
            $cont = $stmt->rowCount();
            header("Location: ./ex1_assumir.php");
            exit;
        } catch (PDOException $e) {
            error_log("Erro de atribuição" . $e->getMessage());
            die("Falha ao atribuir a tarefa para esse usuário");
        }
    }
} else {
    header("Location: ./ex1_assumir.php");
    exit;
}
