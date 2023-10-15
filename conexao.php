<?php

    require_once realpath(__DIR__ . '/vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $servidor = $_SERVER["DB_HOST"];
    $usuario = $_SERVER["DB_USER"];
    $senha = $_SERVER["DB_PASSWORD"];
    $dbname = $_SERVER["DB_DATABASE"];

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>