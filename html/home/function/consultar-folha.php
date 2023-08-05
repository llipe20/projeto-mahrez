<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <link rel="stylesheet" href="../../../css/style-desktop/function.css" media="screen and (min-width: 801px)">
    <link rel="stylesheet" href="../../../css/impresso.css" media="print">

    <!-- EMOJIS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <script src="../../../java-script/function-button.js"></script>
    <title>Document</title>
</head>
<body id="folha">
    <?php include_once './data.php'; verificar_login(); ?>

    <div class="box-principal-folha">

        <form action="" method="POST" id="form">
            <select name="mes-selecionado" id="mes-selecionado" onchange="enviar()">
                <option value="01" <?php if(!isset($_POST['mes-selecionado']) || $_POST['mes-selecionado'] == '01') echo 'selected'; ?>>Janeiro</option>
                <option value="02" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '02') echo 'selected'; ?>>Fevereiro</option>
                <option value="03" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '03') echo 'selected'; ?>>Março</option>
                <option value="04" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '04') echo 'selected'; ?>>Abril</option>
                <option value="05" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '05') echo 'selected'; ?>>Maio</option>
                <option value="06" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '06') echo 'selected'; ?>>Junho</option>
                <option value="07" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '07') echo 'selected'; ?>>Julho</option>
                <option value="08" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '08') echo 'selected'; ?>>Agosto</option>
                <option value="09" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '09') echo 'selected'; ?>>Setembro</option>
                <option value="10" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '10') echo 'selected'; ?>>Outubro</option>
                <option value="11" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '11') echo 'selected'; ?>>Novembro</option>
                <option value="12" <?php if(isset($_POST['mes-selecionado']) && $_POST['mes-selecionado'] == '12') echo 'selected'; ?>>Dezembro</option>
            </select>
        </form>
     
        <!-- ENVIAR FORMULÁRIO AUTOMÁTICAMENTE -->
        <script>
            function enviar() {
                document.getElementById("form").submit();
            }
        </script>

        <!-- HTML -->
        <header id="box-header-folha" class="box-header">

        <span onclick="before()" class="material-symbols-outlined">
            chevron_left
        </span>
            <?php 
            date_default_timezone_set('America/Sao_Paulo'); 
            echo '<h2 class="titulo">'.detector_mes(isset($_POST['mes-selecionado']) ? $_POST['mes-selecionado'] : date('m')).'</h2>';
            ?>

        <span onclick="after()" class="material-symbols-outlined">
            chevron_right
        </span>

        </header>

        <table class="box-conteudo-folha">
            <tr class="th">
                <td>Dia</td>
                <td>Entrada</td>
                <td>Saida</td>
                <td>Horas</td>
                <td>Extras</td>
                <td>Negativas</td>
            </tr>
            <?php 
                montarTabela($_SESSION['id'], isset($_POST['mes-selecionado']) ? $_POST['mes-selecionado'] : date('m'));
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
