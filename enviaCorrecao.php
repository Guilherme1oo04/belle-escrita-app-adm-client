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
    $nota = $_POST['nota'];

    if ($nota > 1000){
        header("location: corrigir.php");
        $_SESSION['notademais'] = 'A nota máxima é 1000';
    }

    $url = 'http://localhost:8085/emailredacao';

    $data = array(
        "htmlCorrecao" => $correcao,
        "emailEnviar" => $emailAtual,
        "temaRed" => $temaAtual,
        "nota" => $nota,
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