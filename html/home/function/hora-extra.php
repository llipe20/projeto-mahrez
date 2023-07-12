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
                    '
                    <div class="box-box-hora-extra">
                        <header class="box-header-hora-extra">
                            <h2 class="titulo">'.semana(dia_semana($dados['dia'])).' - '.$data_banco.'</h2>
                        </header>
                
                        <div class="box-conteudo-hora-extra">
                
                            <p class="p-hora-extra">Hora de entrada: '.$dados['entrada'].'</p>
                
                            <p class="p-hora-extra">Hora de entrada: '.$dados['saida'].'</p>
                
                            <p class="p-hora-extra">Atividade: '.$dados['atividade'].'</p>
                
                            <p class="p-hora-extra">Equipe: '.$dados['equipe'].'</p>
                
                            <p class="p-hora-extra">Descrição: '.$dados['descricao'].'</p>

                            <p class="p-hora-extra">Horas ganha: '.$dados['horas'].'</p>
                        </div>
                    </div>';
                   

                    $tot_horas += $dados['horas'];
                }

                $_SESSION['totHoras'] = $tot_horas;
            }
        }
    ?>
    <div class="box-principal-hora-extra">
        <div class="box-header" id="box-fixo">
            <h2 class="titulo"><?php session_start(); echo 'Total de horas extras: '.$_SESSION['totHoras']?></h2>
        </div>

        <div class="box-main-pai">
            <?php catador_hora_extras($_SESSION['id']);?>
        </div>

        <a class="link-voltar" href="../../home/home.php">Voltar</a>
    </div>
</body>
</html>