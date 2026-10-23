<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['usuario_id'] = (int)$_POST['usuario_id'];

    header("Location: ../public/ex1_assumir.php");
    exit();
};
