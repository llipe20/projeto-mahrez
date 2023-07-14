<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <link rel="stylesheet" href="../../../css/style-desktop/function.css" media="screen and (min-width: 801px)">

    <title>Configurações</title>
</head>
<body>
    <?php include_once './data.php'; verificar_login(); ?>
    <div class="box-principal">

        <!-- CAIXA DE APRESENTAÇÃO  -->
        <div class="box-header-hora-extra">
            <h1>Veja suas informações</h1>
        </div>
        <!-- CAIXA DE INFORMAÇÕES -->
        <form class="box-conteudo" action="../../../php/home/function/configuracao.php" method="POST">

            <div class="box-text">
                <label for="nome">User name:</label>
                <input class="input-texto" type="text" name="nome" value="<?php echo $_SESSION['usuario']; ?>">
            </div>

            <div class="box-text">
                <label for="email">E-mail:</label>
                <input class="input-texto" type="email" name="email" value="<?php echo $_SESSION['email']; ?>">
            </div>

            <div class="box-text">
                <label for="valor-hora">Valor da hora:</label>
                <input class="input-time" type="number" step="0.1" name="valor-hora" value="<?php echo $_SESSION['valorHora']; ?>">
            </div>

            <div class="box-text">
                <label for="senha">Password:</label>
                <input class="input-texto" type="password" name="senha" value="<?php echo $_SESSION['senha']; ?>">
            </div>

            <div class="box-text">
            <label for="confirm-password">Confirm pass:</label>
            <input class="input-texto"  type="password" name="confirm-password" value="<?php echo $_SESSION['senha']; ?>">
            </div>

            <div class="box-button">
            <input class="button" type="submit" name="button-salvar" value="Salvar">

            <a class="link-voltar" href="../home.php">Voltar</a>   
            </div>
        </form>
    </div>
</body>
</html>

