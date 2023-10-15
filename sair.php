<?php
    include("conexao.php");

    session_start();

    unset ($_SESSION['nomeadm']);
    unset ($_SESSION['senhaadm']);

    mysqli_close($conn);

    header("location: index.php");
?>