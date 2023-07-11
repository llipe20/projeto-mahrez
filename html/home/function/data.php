<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php // FUNÇÕES ESPÉCIFICCAS PARA OS CODIGOS;


    // Calcula todas as horas extras feita no fez;
    function calcular_hora_extra($id_usuario)
    {
        include_once '../../../php/conexao.php';
        include_once './data.php';

        $sql = "SELECT saida, dia, horas FROM folha WHERE usuario = $id_usuario AND (horas > 9 OR horas < 8) ORDER BY dia;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $tot_extra = 0;

            while ($dados = mysqli_fetch_assoc($result)) {
                $dia_semana = dia_semana($dados['dia']);

                if ($dia_semana != 5 && $dia_semana != 6 && $dia_semana != 7) 
                {
                    $time_extra = strtotime($dados['saida']);
                    $time_normal = strtotime('17:30');

                    $extra = ($time_extra - $time_normal) / 3600;

                } 
                elseif ($dia_semana == 5) 
                {
                    $time_extra = strtotime($dados['saida']);
                    $time_normal = strtotime('16:30');

                    $extra = ($time_extra - $time_normal) / 3600;

                } 
                else 
                {
                    $extra = $dados['horas'];
                }

                $tot_extra += $extra;
            }

            return $tot_extra;
        }
    }

    
    
    
    
    
    // função para verificar se o usuário fez login para poder navegar nas paginas
    function verificar_login()  
    {
        session_start();

        if ($_SESSION['logado'] == false)
        {   
            echo "<script>window.location.href = '../login/index.html'</script>";  // PAG DE LOGIN
        }
        else
        {
            return true;
        }
    }





    // FUNÇÃO PARA DIA DA SEMANA POR EXTENSO
    function semana($dia) 
    {
        $semana = array ('SEG','TER','QUA','QUI','SEX','SAB','DOM');
        return $semana[$dia - 1];
    } 





    // FUNÇÃO PARA DETECTAR O DIA DA SEMANA 1 á 7
    function dia_semana($data)  
    {
        $diaSemana = date('N', strtotime($data));

        return $diaSemana;
    }




    // FUNÇÃO PARA RETORNAR O MÊS POR EXTENSO
    function detector_mes($mes)
    {
        $valor = intval($mes);
        $meses = array ('null','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

        return $meses[$valor];
    }





    // FUNÇÃO para pegar todos os registro de uma usuário do mês e exibir os dias com link 
    function catar_registro()
    {
        session_start();
        $id_usuario = $_SESSION['id'];

        include '../../../php/conexao.php';

        $mes_atual = intval(date('m'));

        $sql = "SELECT cod,dia FROM folha WHERE usuario = $id_usuario AND MONTH(STR_TO_DATE(dia, '%Y-%m-%d')) = '$mes_atual'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result)) {
            
                $dia = date('d', strtotime($row['dia']));

                echo '<a class="button-dia" href="../function/modificar-ponto.php?cod=' . $row['cod'] . '">Dia '. $dia . '</a>';
            }
        }
    }





    // Função que traz registros espeficos na tebela de folha
    function trazer_folha($cod)
    {
        include '../../../php/conexao.php';

        $sql = "SELECT * FROM folha WHERE cod = $cod";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result))
        {
            $dados = mysqli_fetch_assoc($result);

            $_SESSION['entrada'] = $dados['entrada']; 
            $_SESSION['saida'] = $dados['saida']; 
            $_SESSION['atividade'] = $dados['atividade']; 
            $_SESSION['equipe'] = $dados['equipe']; 
            $_SESSION['desc'] = $dados['descricao']; 
            $_SESSION['data'] = $dados['dia']; 
        }
    }






    function ponto_automatico() // FUNÇÃO DE ADD PONTO AUTOMATICAMENTE
    {
        include '../../../php/conexao.php';

        $sql = "SELECT login FROM conta";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $login = $row['login'];

                $sql = "SELECT dia FROM folha WHERE usuario = '$login' ORDER BY cod DESC LIMIT 1";
                $result_folha = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result_folha) > 0 && mysqli_num_rows($result_folha) < 2) 
                {
                    $row_folha = mysqli_fetch_assoc($result_folha);
                    $data_banco = $row_folha['dia'];
                    $data_atual = date('d-m-Y');
                    $timestamp_banco = strtotime($data_banco);
                    $timestamp_atual = strtotime($data_atual);
                    $dia_semana = dia_semana($data_atual);

                    if ($timestamp_atual > $timestamp_banco && $dia_semana != 6 || $dia_semana != 7 || $dia_semana != 5) 
                    {
                        $sql = "INSERT INTO folha (cod,dia, entrada, saida, horas, usuario) VALUES (DEFAULT,'$data_atual', '07:30', '17:30', 9, '$login')";
                        mysqli_query($conn, $sql);
                    }
                    elseif ($timestamp_atual > $timestamp_banco && $dia_semana == 5)
                    {
                    $sql = "INSERT INTO folha (dia, entrada, saida, horas, usuario) VALUES ('$data_atual', '07:30', '16:30', 8, '$login')";
                        mysqli_query($conn, $sql);
                    }
                    else
                    {
                        exit();
                    }
                } 
                elseif (mysqli_num_rows($result_folha) == 0) 
                {
                    $dia_semana = dia_semana($data_atual);
                    $data_atual = date('d-m-Y');

                    if ($dia_semana != 5 || $dia_semana != 6 || $dia_semana != 7)
                    {
                        $sql = "INSERT INTO folha (dia, entrada, saida, horas, usuario) VALUES ('$data_atual', '07:30', '17:30', 9, '$login')";
                        mysqli_query($conn, $sql);
                    }
                    elseif ($dia_semana == 5)
                    {
                        $sql = "INSERT INTO folha (dia, entrada, saida, horas, usuario) VALUES ('$data_atual', '07:30', '17:30', 8, '$login')";
                        mysqli_query($conn, $sql);
                    }
                    else
                    {
                        exit();
                    }
                }
            }
        }
    }
?>
</body>
</html>