<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <title>Modificar Ponto</title>
    <script src="../../../java-script/function-button.js"></script>
</head>
<body>
    <?php include_once './data.php';?>

    <div class="box-principal">
        <div class="box-month">
            <?php echo '<h2 id="month">'.detector_mes(date('m')).'</h2>';?>
        </div>

        <div class="box-conteudo-dia">
            <?php catar_registro();?>
            <div class="box-button-dia">
                <button class="button-dia" onclick="a()">Dia 30</button>
            </div>
        </div>

        <a id="voltar-home-modponto" class="link-voltar" href="../home.php">Voltar</a>
    </div>
</body>
</html>