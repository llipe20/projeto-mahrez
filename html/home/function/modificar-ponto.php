<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <title>Bater ponto - Mahrez</title>
</head>
<body class="body-bater-ponto">
    <?php include_once 'data.php'; session_start(); $cod = intval($_GET['cod']); trazer_folha($cod);?>

    <div class="box-principal-bater-ponto">

        <div class="box-header">
            <img src="../../imagem/error-message.png" alt="working">

            <h1>Cuidado, pontue corretamente!</h1>
        </div>

        <!-- CAIXA DE CONTÉUDO -->
            <form class="box-conteudo" action="../../../php/home/function/modify-ponto.php" method="POST">
                
                <!-- HORA DE ENTRADA -->

                <input type="hidden" name="data" value="<?php echo $_SESSION['data'];?>">
                <input type="hidden" name="cod" value="<?php echo $cod;?>">

                <div class="box-time">
                    <label for="entrada">Hora de entrada:</label>
                    <input class="input-time" id="entrada" type="time" name="entrada" value="<?php echo $_SESSION['entrada'];?>">
                </div>

                <!-- HORA DE SAIDA -->
                <div class="box-time">
                    <label for="saida">Hora de saida:</label>
                    <input class="input-time" id="saida" type="time" name="saida" value="<?php echo $_SESSION['saida'];?>">
                </div>
                
                <!-- LOCAL DE TRABALHO -->
                <div class="box-text">
                    <label for="local">Local:</label>
                    <input class="input-text" id="local" type="text" name="local" value="<?php echo $_SESSION['atividade'];?>">
                </div>

                <!-- COLABORADORES DA ÁREA -->
                <div class="box-textarea-equipe">
                    <label for="equipe">Colaboradores:</label>
                    <textarea class="input-textarea-equipe" id="equipe" type="text" name="equipe" rows="2" cols="51" placeholder="ex: Jair Bolsonaro..."><?php echo $_SESSION['equipe'];?></textarea>
                </div>
                
                <!-- DESCRIÇÃO DA ATIV -->
                <div class="box-textarea-desc">
                    <label for="desc">Descrição da atividade:</label>
                    <textarea class="input-textarea-desc" id="desc" name="desc" rows="6" cols="51" placeholder="ex: Organizar canteiro..."><?php echo $_SESSION['desc'];?></textarea>
                </div>
                
                <div class="box-button">
                    <input class="button" type="submit" name="button-salva" value="Salvar">

                    <a class="link-voltar" href="../function/before-modificar-ponto.php">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>