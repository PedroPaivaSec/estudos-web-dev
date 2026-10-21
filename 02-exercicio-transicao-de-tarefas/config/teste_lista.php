<?php

require_once __DIR__ . "/connect.php";

try {

    $query = "SELECT * FROM usuarios";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $key => $resultado){

    }

} catch (PDOException $e) {

    echo "Erro na seleção: " . $e->getMessage();
};
