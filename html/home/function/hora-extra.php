<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <title>Hora Extra - Mahrez</title>
</head>
<body>
    <div class="box-principal">
        <?php session_start(); catador_hora_extras($_SESSION['id']);?>

        <a class="link-voltar" href="../../home/home.php">Voltar</a>
    </div>
</body>
</html>