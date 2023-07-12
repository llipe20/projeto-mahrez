<?php 

    // COD DE ATUALIZAÇÃO DE DADOS DE LOGIN

     include_once "../../conexao.php";
     session_start();

     if (isset($_POST['button-salvar'])) 
     {
         $nome = mysqli_escape_string($conn, $_POST['nome']);
         $valor_hora = mysqli_escape_string($conn, $_POST['valor-hora']);
         $senha = mysqli_escape_string($conn, $_POST['senha']);
         $conf_senha = mysqli_escape_string($conn, $_POST['confirm-password']);
 
         if (empty($nome) or empty($valor_hora) or empty($senha) or empty($conf_senha)) 
         {
             echo '<script>alert("Preencha os dados!")</script>';
             echo "<script>window.location.href = '../../../html/home/function/settings.php'</script>"; 
         }
         else
         {
            if($senha != $conf_senha)
            {
                echo '<script>alert("As senhas estão diferentes!")</script>';
                echo "<script>window.location.href = '../../../html/home/function/settings.php'</script>"; 
            }
            else
            {
                $sql = "UPDATE conta SET nome = '$nome', valorHora = $valor_hora, senha = '$senha' WHERE login = $_SESSION[id]";
                $result = mysqli_query($conn, $sql);

                if(mysqli_affected_rows($conn) > 0)
                {
                    $_SESSION['usuario'] = $nome;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['valorHora'] = $valor_hora;
                    
                    mysqli_close($conn);

                    echo '<script>alert("Atualizado com SUCESSO!!")</script>';
                    echo "<script>window.location.href = '../../../html/home/home.php'</script>"; 
                }
                else
                {
                    mysqli_close($conn);

                    echo '<script>alert("Erro ao salvar no banco!! Tente novamente")</script>';
                    echo "<script>window.location.href = ',,/../../html/home/home.php'</script>"; 
                }
            }
         }
     }
 ?>