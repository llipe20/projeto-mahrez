<?php 

    // COD DE RECUPERAÇÃO DE SENHA DE USUÁRIO;

     include_once "../conexao.php";
     session_start();

     if (isset($_POST['button'])) 
     {
         $email = mysqli_escape_string($conn, $_POST['email']);
         $nova_senha = mysqli_escape_string($conn, $_POST['novo-password']);
         $conf_senha = mysqli_escape_string($conn, $_POST['confirm-password']);
 
         if (empty($email) or empty($nova_senha) or empty($conf_senha)) 
         {
             echo '<script>alert("Preencha os dados!")</script>';
             echo "<script>window.location.href = '../../html/login/nova-senha.html'</script>"; 
         }
         else
         {
            $sql = "SELECT * FROM conta WHERE email = '$email'";
            $resul = mysqli_query($conn, $sql);

            if (mysqli_num_rows($resul) == 0) 
            {
                echo '<script>alert("Usuário inexistente!")</script>';
                echo "<script>window.location.href = '../../html/login/nova-senha.html'</script>"; 
            }
            else 
            {
                $dados = mysqli_fetch_assoc($resul);

                if($nova_senha != $conf_senha)
                {
                    echo '<script>alert("As senhas estão diferentes!")</script>';
                    echo "<script>window.location.href = '../../html/login/nova-senha.html'</script>"; 
                }
                else
                {
                    $sql = "UPDATE conta SET senha = '$nova_senha' WHERE login = $dados[login]";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0)
                    {        
                        mysqli_close($conn);

                        echo '<script>alert("Atualizado com SUCESSO!!")</script>';
                        echo "<script>window.location.href = '../../html/login/index.html'</script>"; 
                    }
                    else
                    {
                        mysqli_close($conn);

                        echo '<script>alert("Erro ao salvar no banco!! Tente novamente")</script>';
                        echo "<script>window.location.href = '../../html/login/index.html'</script>"; 
                    }
                }
            }
         }
     }
 ?>