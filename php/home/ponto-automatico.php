<script>
<?php

function ponto_automatico() // FUNÇÃO DE ADD PONTO AUTOMATICAMENTE
    {
        include '../conexao.php';
        date_default_timezone_set('America/Sao_Paulo');

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

function agendarExecucaoDiaria() {
  const agora = new Date();
  const proximaExecucao = new Date(agora);
  proximaExecucao.setDate(proximaExecucao.getDate() + 1);
  proximaExecucao.setHours(0, 0, 0, 0); // Define a próxima execução para o início do próximo dia

  const tempoRestante = proximaExecucao.getTime() - agora.getTime();

  setTimeout(function () {
    ponto_automatico();
    agendarExecucaoDiaria(); // Agendando próxima execução após 24 horas
  }, tempoRestante);
}

// Inicia o agendamento
agendarExecucaoDiaria();
</script>

