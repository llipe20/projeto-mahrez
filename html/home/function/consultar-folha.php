<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // Define o fuso horário para Brasília
date_default_timezone_set('America/Sao_Paulo');
        echo date('d-m-y H:m:s');
    ?>
</body>
</html>