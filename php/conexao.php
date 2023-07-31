
<?php

    // CONEXÃO COM O BANCO DE DADOS COM MYSQLI PROCEDURAL;

    $server = 'sql111.infinityfree.com';
    $user = 'if0_34721939';
    $password = '3plpx19RjAxS';
    $database = 'if0_34721939_mahrez_banco';

    $conn = mysqli_connect($server,$user,$password,$database);

    if (!isset($conn))
    {
        die ('Conexão falhou'.mysqli_connect_error());
    }
?>