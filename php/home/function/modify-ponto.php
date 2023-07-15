<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php  // COD QUE SALVA AS ALTERAÇÕES FEITAS NO PONTO; 

    include_once '../../conexao.php';
    session_start();

    function dia_semana($data)  // FUNÇÃO PARA DETECTAR O DIA DA SEMANA
    {
        $diaSemana = date('N', strtotime($data));

        return $diaSemana;
    }

    if (isset($_POST['button-salva'])) 
    {
        $entrada = mysqli_escape_string($conn, $_POST['entrada']);
        $saida = mysqli_escape_string($conn, $_POST['saida']);
        $local = mysqli_escape_string($conn, $_POST['local']);
        $equipe = mysqli_escape_string($conn, $_POST['equipe']);
        $desc = mysqli_escape_string($conn, $_POST['desc']);
        $data_banco = mysqli_escape_string($conn, $_POST['data']);
        $cod = mysqli_escape_string($conn, $_POST['cod']);

        if (empty($entrada) or empty($saida) or empty($local) or empty($equipe) or empty($desc)) 
        {
            echo '<script>alert("Preencha os dados!")</script>';
            echo "<script>window.location.href = '../../../html/home/function/modificar-ponto.php'</script>"; 
        }
        else
        {
           // pegando a data do banco para recalcuular o valor da hora;
                $dia = dia_semana($data_banco);

                $time_entrada = strtotime($entrada);
                $time_saida = strtotime($saida);

                if ($dia == 6)   // SE TRABALHAR NO SABADO
                {
                    $hora_extra = (($time_saida - $time_entrada - 3600) / 3600)* 1.5;
                }
                elseif ($dia == 7) // SE TRABALHAR NO DOMINGO
                {
                    $hora_extra = (($time_saida - $time_entrada - 3600) / 3600)* 2;
                }
                else // DIAS UTIEIS
                {
                    $hora_extra = ($time_saida - $time_entrada - 3600) / 3600;
                }
                
                // Fazer update

                $sql = "UPDATE folha SET entrada = '$entrada', saida = '$saida', atividade = '$local', equipe = '$equipe', descricao = '$desc', horas = $hora_extra  WHERE cod = $cod";
                $resul = mysqli_query($conn, $sql);

                if (!$resul)
                {
                    echo '<script>alert("Erro ao salvar dados no banco, tente novamente")</script>';
                    echo "<script>window.location.href = '../../html/home/function/before-modificar-ponto.php'</script>"; 

                } 
                else
                {
                    mysqli_close($conn); // fechando conexão;

                    echo '<script>alert("Salvo com sucesso!")</script>';
                    echo "<script>window.location.href = '../../../html/home/function/before-modificar-ponto.php'</script>"; 
                }      
            }
              
        }
?>
    
</body>
</html>