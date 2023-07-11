<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <title>Extrato - Mahrez</title>
</head>
<body>
    <?php include_once './data.php'; session_start();?>
    <div class="box-principal">
        <header class="box-header">
            <img src="../../imagem/dollar-coin.png" alt="dolar_coin">
            <h2 class="titulo">Domingo - 02/07</h2> <!-- Retorno PHP-->
        </header>

        <div class="box-conteudo-extrato">
            <p class="p-extrato">Horas Extras: <?php echo calcular_hora_extra($_SESSION['id']);?></p>
            <p class="p-extrato">Valor das horas: <?php echo "393,50"?></p>
            <p class="p-extrato">Salário: <?php echo "979,88"?></p>
            
            <div class="box-voltar">
                 <a class="link-voltar" href="../../home/home.html">Voltar</a>
            </div>
           
        </div>
    </div>
</body>
</html>