<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php // FUNÇÕES ESPÉCIFICCAS PARA OS CODIGOS;

function calculadorHoras($hora,$data)
{

    if ($data == 6 or $data == 7 )
    {
        return $hora;
    }
    elseif ($data == 5)
    {
        $extra = $hora - 8;
        return $extra;
    }
    else
    {
        $extra = $hora - 9;
        return $extra;
    }
}

    // FUNÇÃO para pegar todos os registros de um usuário do mês e exibir os dias com link 
   
    function montarTabela($id)
    {
        date_default_timezone_set('America/Sao_Paulo');
    
        include '../../../php/conexao.php';
    
        $mes_atual = intval(date('m'));
    
        // Montar consulta SQL para obter todos os registros do mês atual
        $sql = "SELECT * FROM folha WHERE usuario = $id AND MONTH(STR_TO_DATE(dia, '%Y-%m-%d')) = '$mes_atual' ORDER BY dia";
        $result = mysqli_query($conn, $sql);
    
        $registros_banco = array(); // Array para armazenar os registros do banco por dia
    
        while ($row = mysqli_fetch_assoc($result)) {
            $dia = date('d', strtotime($row['dia']));
            $registros_banco[$dia] = $row; // Armazena o registro do dia no array usando o dia como chave
        }
        
        $totHora = 0;
        
         // Exibir os registros da tabela para cada dia do mês
         for ($i = 1; $i <= 30; $i++) 
         {
            $dia_com_zeros = sprintf("%02d", $i);
            $registro_banco = isset($registros_banco[$dia_com_zeros]) ? $registros_banco[$dia_com_zeros] : null;
    
            

            if ($registro_banco !== null && $registro_banco['dia'] !== null) 
            {
                
                $week = dia_semana(date('d-m-Y', strtotime($registro_banco['dia'])));
                $extra = calculadorHoras($registro_banco['horas'], $week);

                if ($week == 6 || $week == 7) 
                {
                    echo '<tr>';
                    echo '<td class="final-semana">' . $dia_com_zeros . '</td>';
                    echo "<td class='final-semana'>" . $registro_banco['entrada'] . "</td>";
                    echo "<td class='final-semana'>" . $registro_banco['saida'] . "</td>";
                    echo "<td class='final-semana'>" . $registro_banco['horas'] . "</td>";
                    echo "<td class='final-semana'>" . $extra . "</td>";
                    echo '</tr>';

                    $totHora = $totHora + $extra;
                } 
                else 
                {
                    echo '<tr>';
                    echo '<td>' . $dia_com_zeros . '</td>';
                    echo '<td>' . $registro_banco["entrada"] . '</td>';
                    echo '<td>' . $registro_banco["saida"] . '</td>';
                    echo '<td>' . $registro_banco["horas"] . '</td>';
                    echo '<td>' . $extra . '</td>';
                    echo '</tr>';

                    $totHora = $totHora + $extra;
                }
            } 
            else
            {
                echo '<tr>';
                echo '<td>' . $dia_com_zeros . '</td>';
                echo '<td>-</td>';
                echo '<td>-</td>';
                echo '<td>-</td>';
                echo '<td>-</td>';
                echo '</tr>';
            }
        }
    
        if (mysqli_num_rows($result) == 0) {
            // Caso não haja registros no banco para o mês atual, exibe a mensagem "Sem horas!"
            // e completa a tabela com os dias sem registros
            for ($i = 1; $i <= 30; $i++) {
                $dia_com_zeros = sprintf("%02d", $i);
                if (!isset($registros_banco[$dia_com_zeros])) {
                    echo '<tr>';
                    echo '<td>' . $dia_com_zeros . '</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                    echo '</tr>';
                }
            }
            echo '<h2 class="msg-vazio">Sem horas!</h2>';
        }

        $_SESSION['tot-hora'] = $totHora;
    }
    





    // Verificar se a função calcular_salario já foi declarada
    if (!function_exists('calcular_salario')) {
        // Calcula todas as 220 horas foram feitas no mês;
        function calcular_salario($id_usuario)
        {
            include '../../../php/conexao.php';

            $sql = "SELECT dia,horas FROM folha WHERE usuario = $id_usuario ORDER BY dia;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $meta = 0;

                while ($dados = mysqli_fetch_assoc($result)) 
                {
                    $dia_semana = dia_semana($dados['dia']);

                    if ($dia_semana != 5 and $dia_semana != 6 and $dia_semana != 7)
                    {
                         $hora = $dados['horas'] - ($dados['horas'] - 9);
                    }
                    elseif ($dia_semana == 5)
                    {
                        $hora = $dados['horas'] - ($dados['horas'] - 8);
                    }
                    else
                    {
                        $hora = 0;
                    }

                    $meta += $hora;
                }
                
                $_SESSION['valorMeta'] = $meta;
                
                if ($meta < 220)
                {
                    $valor = 220 - $meta;
                    return 'Faltam '.$valor.' horas';
                }
                elseif ($meta > 220)
                {
                    $valor = $meta - 220;
                    return 'Ultrapassou '.$valor.' horas';
                }
                else
                {
                    return 'Alcançada';
                }
            }
        }
    }





    // Verificar se a função calcular_hora_extra já foi declarada
    if (!function_exists('calcular_hora_extra')) {
        // FUNÇÃO que converte hora em dinheiro;
        function calcular_hora_extra($hora) 
        {   
            $valor = $hora * $_SESSION['valorHora'];
            $_SESSION['valorExtra'] = $valor;
            $reais = number_format($valor, 2, ',', '.');

            return $reais;
        }
    }



    // Verificar se a função quant_hora_extra já foi declarada
    if (!function_exists('quant_hora_extra')) {
        // Calcula todas as horas extras feitas no mês;
        function quant_hora_extra($id_usuario)
        {
            include '../../../php/conexao.php';

            $sql = "SELECT saida, dia, horas FROM folha WHERE usuario = $id_usuario AND (horas > 9 OR horas < 8) ORDER BY dia;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
            {
                $tot_extra = 0;

                while ($dados = mysqli_fetch_assoc($result)) 
                {
                    $dia_semana = dia_semana($dados['dia']);

                    if ($dia_semana != 5 && $dia_semana != 6 && $dia_semana != 7) 
                    {
                        $extra = $dados['horas'] - 9;
                    } 
                    elseif ($dia_semana == 5) 
                    {
                        $extra = $dados['horas'] - 8;
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
    }

    
    
    
    
    
    // função para verificar se o usuário fez login para poder navegar nas páginas
    function verificar_login()  
    {
        session_start();

        if ($_SESSION['logado'] == false)
        {   
            echo "<script>window.location.href = '../../../index.html'</script>";  // PAG DE LOGIN
        }
        else
        {
            return true;
        }
    }

    function verificar_home()  
    {
        session_start();

        if ($_SESSION['logado'] == false)
        {   
            echo "<script>window.location.href = '../../index.html'</script>";  // PAG DE LOGIN
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





    // FUNÇÃO para pegar todos os registros de um usuário do mês e exibir os dias com link 
    function catar_registro()
    {
        date_default_timezone_set('America/Sao_Paulo');

        $id_usuario = $_SESSION['id'];

        include '../../../php/conexao.php';

        $mes_atual = intval(date('m'));

        $sql = "SELECT cod,dia FROM folha WHERE usuario = $id_usuario AND MONTH(STR_TO_DATE(dia, '%Y-%m-%d')) = '$mes_atual' ORDER BY dia";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result)) {
            
                $dia = date('d', strtotime($row['dia']));

                echo '<div class="box-button-dia">
                        <button class="button-dia" onclick="window.location.href = \'../function/modificar-ponto.php?cod=' . $row['cod'] . '\'">Dia ' . $dia . '</button>
                      </div>';

            }
        }
        else
        {
            echo '<h2 class="msg-vazio">Sem horas!</h2>';
        }
    }







    // Função que traz registros específicos na tabela de folha
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
?>
</body>
</html>
