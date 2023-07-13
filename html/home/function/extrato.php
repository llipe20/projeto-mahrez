<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo '<link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">';?>
    <title>Extrato - Mahrez</title>
</head>
<body>
    <?php include_once './data.php'; session_start(); verificar_login();?>
    <div class="box-principal">
        <header class="box-header">
            <img src="../../imagem/dollar-coin.png" alt="dolar_coin">
            <?php date_default_timezone_set('America/Sao_Paulo'); echo '<h2 class="titulo">'.detector_mes(date('m')).'</h2>';?>
        </header>

        <div class="box-conteudo-extrato">

            <!-- Mostra A QUANT DE HORAS -->
            <div class="box-text">
                <p class="p-extrato">Horas Extras:</p><span><?php echo quant_hora_extra($_SESSION['id']);?></span>
            </div>
            

           <!-- Mostra O VALOR DAS HORAS EM R$ -->
           <div class="box-text">
                <p class="p-extrato">Valor das horas: </p><span><?php echo calcular_hora_extra(quant_hora_extra($_SESSION['id']));?></span>
            </div>


           <!-- Mostra A META MENSAL DE HORA  -->
           <div class="box-text">
                <p class="p-extrato">Meta mensal: </p><span><?php echo calcular_salario($_SESSION['id'])?></span>
           </div>

            <!-- Mostra O SALÁRIO DIA 07 -->
            <div class="box-text">
                <p class="p-extrato">Salário: </p><span><?php $salario = $_SESSION['valorExtra'] + ($_SESSION['valorHora'] * ($_SESSION['valorMeta'] - 110) - 105.6); echo number_format($salario, 2, ',', '.')?></span>
            </div>


            <!-- Mostra O SALÁRIO COMPLETO -->
            <div class="box-text">
                <p class="p-extrato">Salário Completo: </p><span><?php $salario = $_SESSION['valorExtra'] + ($_SESSION['valorHora'] * $_SESSION['valorMeta']) - 105.6; echo number_format($salario, 2, ',', '.')?></span>
            </div>
            
            <div class="box-voltar">
                 <a class="link-voltar" href="../../home/home.php">Voltar</a>
            </div>
           
        </div>
    </div>
</body>
</html>