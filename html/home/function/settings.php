<?php
session_start();
echo '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <title>Configurações</title>
</head>
<body>
    <div class="box-principal">

        <!-- CAIXA DE APRESENTAÇÃO  -->
        <div class="box-header-hora-extra">
            <h1>Veja suas informações</h1>
        </div>
        <!-- CAIXA DE INFORMAÇÕES -->
        <form class="box-conteudo" action="../../../php/home/function/configuracao.php" method="POST">

            <div class="box-text">
                <label for="nome">User name:</label>
                <input class="input-texto" type="text" name="nome" value="'. $_SESSION['usuario'].'">
            </div>

            <div class="box-text">
                <label for="email">E-mail:</label>
                <input class="input-texto" type="email" name="email" value="'.$_SESSION['email'].'">
            </div>

            <div class="box-text">
                <label for="valor-hora">Valor da hora:</label>
                <input class="input-time" type="number" step="0.1" name="valor-hora" value="'.$_SESSION['valorHora'].'">
            </div>

            <div class="box-text">
                <label for="senha">Password:</label>
                <input class="input-texto" type="password" name="senha" value="'.$_SESSION['email'].'">
            </div>

            <div class="box-tet">
            <label for="confirm-password">Confirm pass:</label>
            <input class="input-texto"  type="password" name="confirm-password" value="'.$_SESSION['email'].'">
            </div>

            <div class="box-button">
            <input class="button" type="submit" name="button-salvar" value="Salvar">

            <a class="link-voltar" href="../home.php">Voltar</a>   
            </div>
        </form>
    </div>
</body>
</html>';
?>
