<?php 

$host = 'localhost';
$dbname = 'exercicios';
$user = 'task';
$password = '123456';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try{

    $pdo = new PDO($dsn, $user, $password, $options);

}catch(PDOException $e){

    error_log('Erro de conexão' . $e->getMessage());
    die("Erro na conexão com o banco.");

}

?>