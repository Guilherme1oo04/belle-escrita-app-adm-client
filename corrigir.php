<?php
    include("conexao.php");

    session_start();

    $_SESSION['idRedAtual'] = $_POST['redacao_atual'];

    if (!isset($_SESSION['nomeadm']) && !isset($_SESSION['senhaadm'])){
        $_SESSION['loginErro'] = 'Login inválido!';
        header("location: index.php");
    }
    if (!isset($_SESSION['idRedAtual'])){
        header("location: adm.php");
    }

    $idRedAtual = $_SESSION['idRedAtual'];


    $comandoSql = "SELECT * FROM redacoes WHERE idRedacao = $idRedAtual";
    $requisicao = mysqli_query($conn, $comandoSql);
    $result = mysqli_fetch_assoc($requisicao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belle Escrita</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>

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
            box-sizing: border-box;
        }

        body{
            font-family: 'Poppins', sans-serif;
            padding: 10px;
            background-color: var(--cor3);
        }

        #editor{
            background-color: #fff;
            border: 2px solid var(--cor2);
            margin-top: 5px;
        }
        #editor p{
            font-size: 18px;
        }

        #toolbar-container{
            border: 2px solid var(--cor2);
        }

        h1{
            color: var(--cor2);
            text-shadow: 1px 1px 0px black;
            text-align: center;
            margin-bottom: 15px;
        }

        .inputs{
            position: relative;
            width: 300px;
            margin: 20px auto;
            display: flex;
        }

        .inputs input{
            border: 2px solid var(--cor2);
            outline: none;
            width: 300px;
            height: 50px;
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
            display: block;
            background-color: var(--cor2);
            width: 200px;
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

    </style>
</head>
<body>

    <h1>Tema da redação: <?php echo $result['tema'];?></h1> 

    <!-- The toolbar will be rendered in this container. -->
    <div id="toolbar-container"></div>

    <!-- This container will become the editable. -->
    <div id="editor">
        <p>
            <?php
                echo $result['introducao'];
            ?>
        </p>
        <p>
            <?php
                echo $result['desenvolvimento1'];
            ?>
        </p>
        <p>
            <?php
                echo $result['desenvolvimento2'];
            ?>
        </p>
        <p>
            <?php
                echo $result['conclusao'];
            ?>
        </p>
    </div>

    <form action="enviaCorrecao.php" method="post">
        <section class="inputs">
            <input type="number" name="nota" required placeholder=" " id="nota">
            <label for="nota">Nota da Redação</label>
        </section>
        <input type="hidden" name="input-correcao" class="input-correcao">
        <input type="hidden" name="redacao-atual" value=<?php echo $result['idRedacao'];?>>
        <input type="hidden" name="tema-atual" value=<?php echo $result['tema'];?>>
        <input type="hidden" name="email-atual" value=<?php echo $result['emailAutor'];?>>
        <button onclick="return enviarCorrecao()" class="botao-enviar">Enviar Correção</button>
    </form>

    <script>

        DecoupledEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        function enviarCorrecao() {
            let texto = document.querySelector("#editor").innerHTML
            let input = document.querySelector(".input-correcao")

            input.value = texto

            return confirm("Tem certeza que quer enviar?")
        }

    </script>
</body>
</html>