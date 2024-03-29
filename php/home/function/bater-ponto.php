
<?php  // CODIGO DE PROCESSAMENTO PARA SALVAR OS DADOS DO PONTO NO BANCO 

    include_once '../../conexao.php';
    session_start();

    function dia_semana($data)  // FUNÇÃO PARA DETECTAR O DIA DA SEMANA
    {
        $diaSemana = date('N', strtotime($data));

        return $diaSemana;
    }

    function analisar_registro() // FUNÇÃO PARA IMPEDIR QUE SEJA FEITO DOIS PONNTO EM UM MESMO DIA;
    {
        include '../../conexao.php';

        $sql = "SELECT dia FROM folha WHERE usuario = '$_SESSION[id]' ORDER BY cod DESC LIMIT 1";
        $result_folha = mysqli_query($conn, $sql);

        $row_folha = mysqli_fetch_assoc($result_folha);
        $data_banco = $row_folha['dia'];
        date_default_timezone_set('America/Sao_Paulo');
        $data_atual = date('Y-m-d');
        $timestamp_banco = strtotime($data_banco);
        $timestamp_atual = strtotime($data_atual);

        if ($timestamp_atual == $timestamp_banco)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

                        // INICIO DO COD

    if (isset($_POST['button-salvar'])) 
    {
        $hr_entrada = mysqli_escape_string($conn, $_POST['entrada']);
        $hr_saida = mysqli_escape_string($conn, $_POST['saida']);
        $local = mysqli_escape_string($conn, $_POST['local']);
        $equipe = mysqli_escape_string($conn, $_POST['equipe']);
        $desc = mysqli_escape_string($conn, $_POST['desc']);

        // HORAS NEGATIVAS;

        if (empty($hr_entrada) and empty($hr_saida) and empty($local) and empty($equipe) and empty($desc)) 
        {
            // Definindo o dia negativo; 
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d-m-Y');
            $dia = dia_semana($data);

            if ($dia == 5)
            {
                $let = -8;
                $const = true;
            }
            elseif ($dia == 6 or $dia == 7)
            {
                $const = false;
            }
            else
            {
                $let = -9;
                $const = true;
            }

            if ($const == false) // SÁBADO OU DOMINGO;
            {
                echo '<script>alert("Não é possivel gerar horas negativas em finais de semana!!")</script>';
                echo "<script>window.location.href = '../../../html/home/home.php'</script>"; 
            }     
            else
            {
                $sql = "INSERT INTO folha VALUES (DEFAULT,'$data','--:--','--:--','null','null','null',$let,$_SESSION[id])";

                $resul = mysqli_query($conn, $sql);

                if (!$resul)
                {
                    echo '<script>alert("Erro ao salvar dados no banco, tente novamente")</script>';
                    echo "<script>window.location.href = '../../html/home/function/bater-ponto-html.php'</script>"; 

                } 
                else
                {
                    mysqli_close($conn); // fechando conexão;

                    echo '<script>alert("Salvo com sucesso!")</script>';
                    echo "<script>window.location.href = '../../../html/home/home.php'</script>"; 
                }      
            }
        }
        else
        {
            $var = analisar_registro();

            if ($var == true)
            {
                echo '<script>alert("O ponto de hoje ja foi batido!")</script>';
                echo "<script>window.location.href = '../../../html/home/function/bater-ponto-html.php'</script>"; 
            }
            else
            {
                // Definindo a quantidade de hora do dia;
                date_default_timezone_set('America/Sao_Paulo');
                $data = date('d-m-Y');

                $dia = dia_semana($data);

                $time_entrada = strtotime($hr_entrada);
                $time_saida = strtotime($hr_saida);

                if ($dia == 6)   // SE TRABALHAR NO SABADO
                {
                    $h = $time_saida - $time_entrada;

                    if ($h > (3600 * 4))
                    {
                        $hr = $h - 3600;
                    }

                    $hora_extra = ($hr / 3600) * 1.5;
                }
                elseif ($dia == 7) // SE TRABALHAR NO DOMINGO
                {
                    $h = $time_saida - $time_entrada;

                    if ($h > (3600 * 4))
                    {
                        $hr = $h - 3600;
                    }

                    $hora_extra = ($hr / 3600) * 2;
                }
                else // DIAS UTIEIS
                {
                    $hr = $time_saida - $time_entrada;

                    if ($hr > (3600 * 4))
                    {
                        $hr = $hr - 3600;
                    }

                    $hora_extra = ($hr / 3600);
                }
                
                // Add dados do ponto no banco;

                $sql = "INSERT INTO folha VALUES (DEFAULT,'$data','$hr_entrada','$hr_saida','$local','$equipe','$desc',$hora_extra,$_SESSION[id])";
                $resul = mysqli_query($conn, $sql);

                if (!$resul)
                {
                    echo '<script>alert("Erro ao salvar dados no banco, tente novamente")</script>';
                    echo "<script>window.location.href = '../../html/home/function/bater-ponto.php'</script>"; 

                } 
                else
                {
                    mysqli_close($conn); // fechando conexão;

                    echo '<script>alert("Salvo com sucesso!")</script>';
                    echo "<script>window.location.href = '../../../html/home/home.php'</script>"; 
                }      
            }      
        }
    }
?>
