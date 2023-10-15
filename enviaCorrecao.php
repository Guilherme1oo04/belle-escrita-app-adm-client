<?php

    include("conexao.php");

    session_start();

    if (!isset($_SESSION['nomeadm']) && !isset($_SESSION['senhaadm'])){
        $_SESSION['loginErro'] = 'Login inválido!';
        header("location: index.php");
    }

    if (!$_POST['input-correcao']){
        header("location: corrigir.php");
    }

    $correcao = $_POST['input-correcao'];
    $idRedAtual = $_POST['redacao-atual'];
    $temaAtual = $_POST['tema-atual'];
    $emailAtual = $_POST['email-atual'];

    $nota1 = $_POST['competencia1'];
    $nota2 = $_POST['competencia2'];
    $nota3 = $_POST['competencia3'];
    $nota4 = $_POST['competencia4'];
    $nota5 = $_POST['competencia5'];

    $nota = $nota1 + $nota2 + $nota3 + $nota4 + $nota5;

    $url = 'http://localhost:8085/emailredacao';

    $data = array(
        "htmlCorrecao" => $correcao,
        "emailEnviar" => $emailAtual,
        "temaRed" => $temaAtual,
        "nota1" => $nota1,
        "nota2" => $nota2,
        "nota3" => $nota3,
        "nota4" => $nota4,
        "nota5" => $nota5,
    );
    $json = json_encode($data);

    $headers = [
        'Content-type: application/json',
        'Content-length:'. strlen($json),
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => $headers,
            'content' => $json
        ]
    ]);

    file_get_contents($url, false, $context);

    $comando1 = "UPDATE redacoes SET nota = $nota, statusRed = 'Corrigida' WHERE idRedacao = $idRedAtual";
    mysqli_query($conn, $comando1);
   
    header("location: adm.php");
?>