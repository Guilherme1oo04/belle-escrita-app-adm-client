<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belle Escrita</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arizonia&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root{
            --cor1: #41E0A5;
            --cor2: #494C82;
            --cor3: #CDC1D5;
            --cor4: #AC49DA;
        }

        *{
            margin: 0;
            padding: 0;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            flex-direction: column;
            background-color: var(--cor3);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .inputs{
            position: relative;
            width: 300px;
            margin: 0 auto;
            display: flex;
        }

        .inputs input{
            border: 2px solid var(--cor2);
            outline: none;
            width: 300px;
            height: 40px;
            font-size: 22px;
            background-color: #fff;
            color: var(--cor2);
            border-radius: 10px;
            margin-bottom: 40px;
            padding: 5px;
            position: relative;
        }
        .inputs input:hover{
            box-shadow: 0px 0px 12px var(--cor2);
        }
        .inputs input:focus ~ label, .inputs input:not(:placeholder-shown) ~ label{
            margin-top: -15px;
            margin-left: 10px;
            padding: 2px;
            border-radius: 2px;
            font-size: 15px;
            background-color: var(--cor2);
            color: var(--cor1);
        }
        .inputs label{
            position: absolute;
            left: 0;
            top: 0;
            margin-left: 5px;
            margin-top: 10px;
            font-size: 25px;
            color: var(--cor2);
            transition: 0.5s;
            pointer-events: none;
        }

        .botao-enviar{
            background-color: var(--cor2);
            width: 100px;
            font-size: 20px;
            color: var(--cor1);
            padding: 10px;
            border-radius: 20px;
            border: none;
            margin: 30px auto;
            cursor: pointer;
            font-weight: 600;
        }

        .botao-enviar:hover{
            box-shadow: 0px 0px 8px var(--cor2);
        }

        .mensagem{
            color: var(--cor2);
            margin: 10px auto;
        }

        .titulo-belle-escrita{
            font-size: 60px;
            font-family: 'Arizonia', cursive;
            color: var(--cor2);
            margin: 50px auto;
            text-shadow: 1px 1px 1px black;
        }

        p{
            color: var(--cor2);
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1 class="titulo-belle-escrita">Belle Escrita</h1>
    <form action="processaLogin.php" method="post">
            <p class="mensagem">
                <?php
                    if (isset($_SESSION['loginErro'])){
                        echo $_SESSION['loginErro'];
                        unset ($_SESSION['loginErro']);
                    }
                ?>
            </p>

            <section class="inputs">
                <input type="text" id="nomeadm" name="nomeadm" maxlength=50 required placeholder=" ">
                <label for="nomeadm">Nome</label>
            </section>
            <section class="inputs">
                <input type="password" id="senhaadm" name="senhaadm" maxlength=50 required placeholder=" ">
                <label for="senhaadm">Senha</label>
            </section>
            <input type="submit" value="Entrar" class="botao-enviar">
    </form>
</body>
</html>