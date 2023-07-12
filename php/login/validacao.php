
<?php  // CÓDIGO DE VALIDAÇÃO DE LOGIN

    include_once "../conexao.php";
    session_start();

    if (isset($_POST['button-entrar'])) 
    {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);

        if (empty($email) or empty($senha))
        {
            echo '<script>alert("Preencha os dados!")</script>';
            echo "<script>window.location.href = '../../html/login/index.html'</script>"; 
        }
        else
        {
            $sql = "SELECT * FROM conta WHERE email = '$email'";
            $resul = mysqli_query($conn, $sql);

            if (mysqli_num_rows($resul) == 0) 
            {
                echo '<script>alert("Usuário inexistente!")</script>';
                echo "<script>window.location.href = '../../html/login/index.html'</script>"; 
            }
            else 
            {
                $dados = mysqli_fetch_array($resul);

                if ($dados['senha'] != $senha)
                {
                    echo '<script>alert("Senha incorreta!")</script>';
                    echo "<script>window.location.href = '../../html/login/index.html'</script>"; 
                }
                else
                {
                    $_SESSION['logado'] = true;
                    $_SESSION['id'] = $dados['login'];
                    $_SESSION['usuario'] = $dados['nome'];
                    $_SESSION['email'] = $dados['email'];
                    $_SESSION['senha'] = $dados['senha'];
                    $_SESSION['valorHora'] = $dados['valorHora'];

                    echo "<script>window.location.href = '../../html/home/home.php'</script>";  // PAG DA HOME 
                }
            }
        }
    }
    
?>