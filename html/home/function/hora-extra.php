
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- EMOJS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../../css/style-mobile/function.css" media="screen and (max-width: 800px)">
    <link rel="stylesheet" href="../../../css/style-desktop/function.css" media="screen and (min-width: 801px)">
    
    <title>Hora Extra - Mahrez</title>

</head>
<body>
    <?php session_start(); ?>
    <script>
        function toggleContent(iteracao) 
        {
            var conteudo = document.getElementById('conteudo-' + iteracao);
            var header = document.getElementById('header-' + iteracao);
            var extra = document.getElementById('extra-' + iteracao);
            var negativa = document.getElementById('negativa-' + iteracao);
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
                extra.style.color = 'green';
                negativa.style.color = 'red';
                icone.textContent = 'expand_less';
            }
        }
    </script>
    <?php 
        function catador_hora_extras($id, $mes)
        {
            include './data.php';
            include '../../../php/conexao.php';
            date_default_timezone_set('America/Sao_Paulo');

            $sql = "SELECT * FROM folha WHERE usuario = $id AND horas < 8 OR horas > 9 AND horas > 0 ORDER BY dia";

            $result = mysqli_query($conn, $sql);

            $extra = 0;
            $negativa = 0;
            $hora_negativa = 0;

            if (mysqli_num_rows($result) > 0)
            {
                while ($dados = mysqli_fetch_assoc($result))
                {
                    $data = date_create($dados['dia']);
                    $data_banco = date_format($data, ' d . m');

                    // Fazer verificação para pegar apenas os dados do mês atual
                    $mes_banco = date_format($data, 'm');
                    $mes_atual = $mes;

                    if ($mes_atual == $mes_banco)
                    {
                        // pegando a data do banco para recalcuular o valor da hora;

                        $dia = dia_semana($dados['dia']);
 
                        if ($dados['horas'] < 0)
                        {
                            $hr = $dados['horas'];
                            $hora_negativa = $dados['horas'];
                            $hora_extra = 0;
                        }
                        elseif ($dia != 5 and $dia != 6 and $dia != 7)   // SE TRABALHAR NOS DIAS UTEIS
                        {
                            $hr = $dados['horas'] - 9;

                            if ($hr < 0)
                            {
                                $hora_negativa = $hr;
                                $hora_extra = 0;
                            }
                            else
                            {
                                $hora_negativa = 0;
                                $hora_extra = $hr;
                            }
                        }
                        elseif ($dia == 5) // SE TRABALHAR NA SEXTA
                        {
                            $hr = $dados['horas'] - 8;

                            if ($hr < 0)
                            {
                                $hora_negativa = $hr;
                                $hora_extra = 0;
                            }
                            else
                            {
                                $hr = 0;
                                $hora_negativa = 0;
                                $hora_extra = $hr;
                            }
                        }
                        else // FINAIS DE SEMANA
                        {
                            $hora_extra = $dados['horas'];
                            $hora_negativa = 0;
                        }

                        echo '
                            <div class="box-box-hora-extra">

                                <header id="header-'.$dados['cod'].'" class="box-header-hora-extra">

                                    <h2 class="titulo">'.semana(dia_semana($dados['dia'])).' - '.$data_banco.'</h2>

                                    <span id="'.$dados['cod'].'" class="material-icons">expand_more</span>

                                </header>
                    
                                <div id="conteudo-'.$dados['cod'].'" class="box-conteudo-hora-extra">
                    
                                    <p class="p-hora-extra">Hora da entrada: '.$dados['entrada'].'</p>
                        
                                    <p class="p-hora-extra">Hora dea saída: '.$dados['saida'].'</p>
                        
                                    <p class="p-hora-extra">Atividade: '.$dados['atividade'].'</p>
                        
                                    <p class="p-hora-extra">Equipe: '.$dados['equipe'].'</p>
                        
                                    <p class="p-hora-extra">Descrição: '.$dados['descricao'].'</p>

                                    <p id="extra-'.$dados['cod'].'" class="p-hora-extra">Horas ganha: '. $hora_extra.'</p>

                                    <p id="negativa-'.$dados['cod'].'" class="p-hora-extra">Horas negativas: '. $hora_negativa.'</p>
                                </div>
                            </div>';

                        $extra = $extra + $hora_extra;
                        $negativa = $negativa + $hora_negativa;
                    }
                }
                
                $tot_horas = $extra + $negativa;
                $_SESSION['totHoras'] = $tot_horas;

                if ($tot_horas == 0)
                {
                    echo '<h2 class="msg-vazio">Sem horas extras!</h2>';
                }
            }
            else
            {
                $_SESSION['totHoras'] = '0';

                echo '<h2 class="msg-vazio">Sem horas extras!</h2>';
            }

            $mes = date('m');
            $_SESSION['mes'] = detector_mes($mes);
        }
    ?>
    <div class="box-principal-hora-extra">
        <div class="box-header-fixo" id="box-fixo">

            <span class="material-symbols-outlined">
                chevron_left
            </span>

            <div class="min-box-header-fixo">
                
                <h2 class="titulo">
                    <?php echo  $_SESSION['mes']?>
                </h2>
        
                <h2 class="titulo">
                    <?php 
                        if (isset($_SESSION['totHoras']))
                        { 
                            echo 'Horas extras: '.$_SESSION['totHoras'];
                        }
                        else
                        {
                            echo 'Horas extras: ';
                        }
                    ?>
                </h2>
            </div>
            
            <span class="material-symbols-outlined">
                chevron_right
            </span>
        </div>

        <div class="box-main-pai">
            <?php 
                $month = 8;
                catador_hora_extras($_SESSION['id'], $month);
            ?>
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


        // Lidar com o valor inicial assim que a página for carregada



    </script>
</body>
</html>