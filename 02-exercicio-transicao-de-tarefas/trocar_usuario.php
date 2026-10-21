<?php

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_SESSION['usuario_id'] = $_POST['usuario_id'];

    header("Location: ./ex1_assumir.php");
    exit();
};

?>