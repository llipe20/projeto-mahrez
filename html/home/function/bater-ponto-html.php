<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <link rel="stylesheet" href="../../../css/style-desktop/function.css" media="screen and (min-width: 801px)">

    <title>Bater ponto - Mahrez</title>
</head>
    <?php include_once './data.php'; verificar_login(); ?>
<body class="body-bater-ponto">
    <div class="box-principal-bater-ponto">

        <div class="box-header">
            <img src="../../imagem/working.png" alt="working">

            <h1>Trabalhou muito hoje?</h1>
        </div>
        <!-- CAIXA DE CONTÉUDO -->
            <form class="box-conteudo" action="../../../php/home/function/bater-ponto.php" method="POST">
                
                <!--DATA DO PONTO -->
                <div class="box-data">
                    <?php include_once './data.php'; date_default_timezone_set('America/Sao_Paulo'); echo '<h2 class="data">'.semana(dia_semana(date('y-m-d H:m:s'))).' - '.date('d . m').'</h2>';?>
                </div>

                <!-- HORA DE ENTRADA -->
                <div class="box-time">
                    <label for="entrada">Hora de entrada:</label>
                    <input class="input-time" id="entrada" type="time" name="entrada" autofocus required>
                </div>
                
                <!-- HORA DE SAIDA -->
                <div class="box-time">
                    <label for="saida">Hora de saida:</label>
                    <input class="input-time" id="saida" type="time" name="saida" required>
                </div>
                
                <!-- LOCAL DE TRABALHO -->
                <div class="box-text">
                    <label for="local">Local:</label>
                    <input class="input-text" id="local" type="text" name="local" placeholder="ex: Enchedora">
                </div>

                <!-- COLABORADORES DA ÁREA -->
                <div class="box-textarea-equipe">
                    <label for="equipe">Colaboradores:</label>
                    <textarea class="input-textarea-equipe" id="equipe" type="text" name="equipe" rows="2" cols="51" placeholder="ex: Felipe Mello..."></textarea>
                </div>
                
                <!-- DESCRIÇÃO DA ATIV -->
                <div class="box-textarea-desc">
                    <label for="desc">Descrição da atividade:</label>
                    <textarea class="input-textarea-desc" id="desc" name="desc" rows="6" cols="51" placeholder="ex: Aperta parafuros..."></textarea>
                </div>
                
                <div class="box-button">
                    <input class="button" type="submit" name="button-salvar" value="Salvar">

                    <a class="link-voltar" href="../home.php">Voltar</a>
                <div>  
                </div>
            </form>
        </div>
    </div>
</body>
</html>