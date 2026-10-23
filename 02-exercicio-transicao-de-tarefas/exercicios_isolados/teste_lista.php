<?php
//exercicio isolado para praticar o uso de htmlspecialchars e percorrer lista de usuários na tabela com foreach

//conecta com o banco usando o arquivo connect
require_once __DIR__ . "/connect.php";

//try: Realiza a execução do select no banco de dados
try {

    $query = "SELECT * FROM usuarios"; //query montada
    $stmt = $pdo->prepare($query); //pdo prepara a query dentro da variavel stmt
    $stmt->execute(); //executa a query
    $result = $stmt->fetchAll(); //armazena todas as linhas retornadas da consulta

    echo "<ul>";
    foreach ($result as $resultado) { //para cada dado($resultado) dentro de $result, imprime na tela o que foi consultado

        echo "<li>" . htmlspecialchars($resultado['id'], ENT_QUOTES, 'UTF-8') . htmlspecialchars($resultado['nome'], ENT_QUOTES, 'UTF-8') . "</li>";
    }
    echo "</ul>";

    //catch: Gera erro se o comando falhar
} catch (PDOException $e) {

    error_log("Erro na seleção: " . $e->getMessage());
    die("Falha no SELECT");
}
