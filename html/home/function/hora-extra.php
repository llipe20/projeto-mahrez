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
    <?php 
        function catador_hora_extras()
        {
            include './data.php';
            include '../../../php/conexao.php';

            $sql = "SELECT * FROM folha WHERE usuario = $_SESSION[id] AND horas < 8 OR horas > 9 ORDER BY dia";
            $result = mysqli_query($conn, $sql);

            $tot_horas = 0;

            if (mysqli_num_rows($result) > 0)
            {
                while ($dados = mysqli_fetch_assoc($result))
                {
                    $data = date_create($dados['dia']);
                    $data_banco = date_format($data, ' d . m');

                    echo 
                    '<header class="box-header">
                        <img src="../../imagem/dollar-coin.png" alt="dolar_coin">
                        <h2 class="titulo">'.semana(dia_semana($dados['dia'])).' - '.$data_banco.'</h2>
                    </header>
            
                    <div class="box-conteudo-extrato">
            
                        <p class="p-extrato">Hora de entrada: '.$dados['entrada'].'</p>
            
                        <p class="p-extrato">Hora de entrada: '.$dados['saida'].'</p>
            
                        <p class="p-extrato">Atividade: '.$dados['atividade'].'</p>
            
                        <p class="p-extrato">Equipe: '.$dados['equipe'].'</p>
            
                        <p class="p-extrato">Descrição: '.$dados['descricao'].'</p>

                        <p class="p-extrato">Horas ganha: '.$dados['horas'].'</p>
            
                    </div>';

                    $tot_horas += $dados['horas'];
                }

                $_SESSION['totHoras'] = $tot_horas;
            }
        }
    ?>
    <div class="box-principal">
        <div class="header-fixa">
            <h2 class=""><?php session_start(); echo 'Total de horas extras: '.$_SESSION['totHoras']?></h2>
        </div>

        <div class="">
            <?php catador_hora_extras($_SESSION['id']);?>
        </div>

        <a class="link-voltar" href="../../home/home.php">Voltar</a>
    </div>
</body>
</html>