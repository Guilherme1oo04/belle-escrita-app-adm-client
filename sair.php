<?php
    session_start();

    unset ($_SESSION['nomeadm']);
    unset ($_SESSION['senhaadm']);

    header("location: index.php");
?>