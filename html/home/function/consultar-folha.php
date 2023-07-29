<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
     <link rel="stylesheet" href="../../../css/style-desktop/function.css" media="screen and (min-width: 801px)">
    <title>Document</title>
</head>
<body id="folha">
    <?php include_once './data.php'; verificar_login(); ?>

    <div class="box-principal-folha">
        <header id="box-header-folha" class="box-header">

            <?php date_default_timezone_set('America/Sao_Paulo'); echo '<h2 class="titulo">'.detector_mes(date('m')).'</h2>';?>

        </header>

        <table class="box-conteudo-folha">
            <tr class="th">
                <td>Dia</td>
                <td>Entrada</td>
                <td>Saida</td>
                <td>Horas</td>
                <td>Extras</td>
            </tr>
            <?php 
                montarTabela($_SESSION['id']);
            ?>

            

        </table>
        <div id="final-row">
                           
            <?php echo '<p id="final-hora">Total: '.$_SESSION['tot-hora'].'</p>';?>
                        
        </div>

        <div class="box-voltar">
            
            <a id="voltar-home-modponto" class="link-voltar" href="../home.php">Voltar</a>
        </div>
        
    </div>
</body>
</html>