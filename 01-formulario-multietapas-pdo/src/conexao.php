<?php

//Inicia a sessão no navegador.
session_start();

//Defini a url principal dentro da constante magica(BASE_URL).
define('BASE_URL', 'http://localhost/01-formulario-multietapas-pdo/public');

//Dados da conexão com o banco de dados.
$hostname = "localhost";
$user = "root";
$password = "";
$dbname = "pedrodb";

try {

//Realiza a conexão com o banco.
$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $password); 

}catch (PDOException $e){

//Se der erro, a mensagem é armazenada na variavel $e e mostrada na tela.
echo $e->getMessage(); 
}
