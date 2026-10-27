<?php

require_once __DIR__ . "/connect.php";

$query = "UPDATE tarefas SET responsavel_id  = NULL WHERE responsavel_id = 1 OR responsavel_id = 2";
$stmt = $pdo->prepare($query);
$stmt->execute();

header("Location: ../public/ex1_assumir.php");
exit();