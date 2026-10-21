<?php 

session_start();

if(!isset($_SESSION['usuario_id'])){
    echo "Erro";
    header("Location: ./ex1_assumir.php");
    exit;
}

?>