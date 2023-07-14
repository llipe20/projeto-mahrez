
<?php   // COD DE TRATAMENTO PARA NOVO USUÁRIOS; 

    include_once "../conexao.php";

    if (isset($_POST['button-salvar'])) 
    {
        $nome = mysqli_escape_string($conn, $_POST['nome']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $valor_hora = mysqli_escape_string($conn, $_POST['valor-hora']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);

        if (empty($nome) or empty($email) or empty($valor_hora) or empty($senha)) 
        {
            echo '<script>alert("Preencha os dados!")</script>';
            echo "<script>window.location.href = '../../html/login/nova-conta.html'</script>"; 
        }
        else
        {
            $sql = "SELECT * FROM conta WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                echo '<script>alert("Usuário existente! Use outro email!")</script>';
                echo "<script>window.location.href = '../../html/login/nova-conta.html'</script>"; 
            }
            else
            {
                $sql = "INSERT INTO conta VALUES (DEFAULT,'$nome','$email','$senha',$valor_hora)";
                $result = mysqli_query($conn, $sql);

                if(mysqli_affected_rows($conn) > 0)
                {
                    mysqli_close($conn);

                    echo '<script>alert("Usuario criado com SUCESSO!!")</script>';
                    echo "<script>window.location.href = '../../index.html'</script>"; 
                }
                else
                {
                    mysqli_close($conn);

                    echo '<script>alert("Erro ao salvar no banco!! Tente novamente")</script>';
                    echo "<script>window.location.href = '../../index.html'</script>";
                }
            }
        }
    }
?>