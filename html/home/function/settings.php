<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/style-mobile/login.css" media="screen and (max-width: 800px)">
    <title>Configurações</title>
</head>
<body>
        <!-- CAIXA DE APRESENTAÇÃO  -->
        <div class="box-terciario">
            <img class="photo-litle" src="../imagem/form.png" alt="formulario">

            <h1>Configurações</h1>
        </div>
        <!-- CAIXA DE INFORMAÇÕES -->
        <form class="box-novo-usuario" action="../../../php/home/function/configuracao.php" method="POST">
            
            <h2>Veja suas informações</h2>

            <div class="box-text">
            <label for="nome">User name:</label>
            <input class="box-input-set" type="text" name="nome" value="<?php session_start(); echo $_SESSION['usuario'];?>">
            </div>

            <div class="box-text">
            <label for="email">E-mail:</label>
            <input class="box-input-set" type="email" name="email" value="<?php echo $_SESSION['email'];?>">
            </div>

            <div class="box-text">
            <label for="valor-hora">Valor da hora:</label>
            <input class="box-input-set" type="number" step="0.1" name="valor-hora" value="<?php echo $_SESSION['valorHora'];?>">

            <div class="box-text">
            <label for="senha">Password:</label>
            <input class="box-input-set" type="password" name="senha" value="<?php echo $_SESSION['email'];?>">

            <div class="box-text">
            <label for="confirm-password">Confirm password:</label>
            <input class="box-input-set"  type="password" name="confirm-password" value="<?php echo $_SESSION['email'];?>">
        
            <input class="box-button" type="submit" name="button-salvar" value="Salvar">

            <a class="link-voltar" href="../home.php">Voltar</a>   
        </form>
    </div>
</body>
</html>