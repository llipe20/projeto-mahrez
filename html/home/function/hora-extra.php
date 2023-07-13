<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    
    <title>Hora Extra - Mahrez</title>

</head>
<body>
    <?php include_once './data.php'; verificar_login(); ?>
    <script>
        function toggleContent(iteracao) 
        {
            var conteudo = document.getElementById('conteudo-' + iteracao);
            var header = document.getElementById('header-' + iteracao);
            var icone = document.getElementById(iteracao);

            if (conteudo.style.display == 'flex') 
            {
                conteudo.style.display = 'none';
                header.style.borderRadius = '12px';
                icone.textContent = 'expand_more';
            } 
            else 
            {
                header.style.borderRadius = '12px 12px 0px 0px';
                conteudo.style.height = '450px';
                conteudo.style.display = 'flex';
                icone.textContent = 'expand_less';
            }
        }
    </script>
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

                    // pegando a data do banco para recalcuular o valor da hora;
                  
                    $dia = dia_semana($dados['dia']);

                    if ($dia != 5 and $dia != 6 and $dia != 7)   // SE TRABALHAR NOS DIAS UTEIS
                    {
                        $hora_extra = $dados['horas'] - 9;
                    }
                    elseif ($dia == 5) // SE TRABALHAR NA SEXTA
                    {
                        $hora_extra = $dados['horas'] - 8;
                    }
                    else // FINAIS DE SEMANA
                    {
                        $hora_extra = $dados['horas'];
                    }

                    echo '
                    <div class="box-box-hora-extra">
                        <header id="header-'.$dados['cod'].'" class="box-header-hora-extra">
                            <h2 class="titulo">'.semana(dia_semana($dados['dia'])).' - '.$data_banco.'</h2>
                            <span id="'.$dados['cod'].'" class="material-icons">expand_more</span>
                        </header>
                
                        <div id="conteudo-'.$dados['cod'].'" class="box-conteudo-hora-extra">
                
                            <p class="p-hora-extra">Hora de entrada: '.$dados['entrada'].'</p>
                
                            <p class="p-hora-extra">Hora de entrada: '.$dados['saida'].'</p>
                
                            <p class="p-hora-extra">Atividade: '.$dados['atividade'].'</p>
                
                            <p class="p-hora-extra">Equipe: '.$dados['equipe'].'</p>
                
                            <p class="p-hora-extra">Descrição: '.$dados['descricao'].'</p>

                            <p class="p-hora-extra">Horas ganha: '.$hora_extra.'</p>
                        </div>
                    </div>';
                   

                    $tot_horas += $hora_extra;
                }

                $_SESSION['totHoras'] = $tot_horas;
            }
        }
    ?>
    <div class="box-principal-hora-extra">
        <div class="box-header-fixo" id="box-fixo">
            <h2 class="titulo"><?php session_start(); echo 'Total de horas extras: '.$_SESSION['totHoras']?></h2>
        </div>

        <div class="box-main-pai">
            <?php catador_hora_extras($_SESSION['id']);?>
        </div>

        <a id="voltar-hora-extra" class="link-voltar" href="../../home/home.php">Voltar</a>
    </div>

    <script>
        var headers = document.querySelectorAll('.box-header-hora-extra');
        headers.forEach(function(header) 
            {
                var id = header.getAttribute('id').replace('header-', '');
                header.addEventListener('click', function() 
                {
                    toggleContent(id);
                });
            });
    </script>
</body>
</html>
