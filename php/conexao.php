
<?php

    // CONEXÃO COM O BANCO DE DADOS COM MYSQLI PROCEDURAL;

    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'mahrez';

    $conn = mysqli_connect($server,$user,$password,$database);

    if (!isset($conn))
    {
        die ('Conexão falhou'.mysqli_connect_error());
    }
?>