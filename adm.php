<?php
    include("conexao.php");

    session_start();

    if (!isset($_SESSION['nomeadm']) && !isset($_SESSION['senhaadm'])){
        $_SESSION['loginErro'] = 'Login inválido!';
        header("location: index.php");
    }

    $comandoSql = "SELECT * FROM redacoes WHERE statusRed = 'Não corrigida'";
    $requisicao = mysqli_query($conn, $comandoSql);

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

        body{
            background-color: var(--cor3);
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a{
            display: block;
            width: 60px;
            text-align: center;
            background-color: var(--cor2);
            color: var(--cor1);
            text-shadow: 1px 1px 0px black;
            margin: auto;
            margin-top: 10px;
            text-decoration: none;
            font-size: 25px;
            font-family: 'Poppins', sans-serif;
            padding: 5px;
            border-radius: 20px;
        }
        a:hover{
            box-shadow: 0px 0px 5px var(--cor2);
        }

        h1{
            color: var(--cor2);
            text-shadow: 1px 1px 0px black;
            text-align: center;
        }

        table{
            border: 1px solid var(--cor2);
            border-collapse: collapse;
            text-align: center;
            margin: auto;
            max-width: 800px;
            width: 100%;
        }

        table td{
            padding: 10px;
            border: 1px solid var(--cor2);
            text-align: center;
            font-size: 18px;
            color: var(--cor2);
            word-wrap: break-word;
        }

        .botao-corrigir{
            display: block;
            border: none;
            text-align: center;
            background-color: var(--cor2);
            color: var(--cor1);
            text-shadow: 1px 1px 0px black;
            margin: auto;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            padding: 5px 10px;
            border-radius: 15px;
            cursor: pointer;
        }
        .botao-corrigir:hover{
            box-shadow: 0px 0px 5px var(--cor2);
        }
    </style>
</head>
<body>
    <a href="sair.php">Sair</a>

    <h1>Redações para corrigir</h1>

    <table>
        <tr>
            <td><strong>E-mail do Autor</strong></td>
            <td><strong>Tema</strong></td>
            <td><strong>Id da Redação</strong></td>
            <td></td>
        </tr>

        <?php
            while ($row_redacao = mysqli_fetch_assoc($requisicao)){
                echo "<tr>
                        <td>" . $row_redacao['emailAutor'] . "</td>
                        <td>" . $row_redacao['tema'] . "</td>
                        <td>" . $row_redacao['idRedacao'] . "</td>
                        <td>
                            <form action='corrigir.php' method='POST'>
                                <input type='hidden' name='redacao_atual' value = '" . $row_redacao['idRedacao'] . "'>
                                <input type='submit' value='Corrigir' class='botao-corrigir'>
                            </form>
                        </td>
                    </tr>";
            }
        ?>

    </table>
</body>
</html>