<?php
    $servername = "192.168.4.41"; //Nome do servidor
    $username = "appuser"; //Usuário do banco
    $password = "Digit@ltidf10"; //Senha do banco
    $dbname = "teste_intranet"; //Nome do banco

    //Cria a conexão 
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica o status da conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
?>