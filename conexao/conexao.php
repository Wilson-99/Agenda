<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "agenda_db";

try{
    //Conexao com a porta
    //$conecta = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    
    //Conexao sem a porta
    $conecta = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

    //echo "Conexão com banco de dados realizado com sucesso.";
}catch(PDOException $erro){
    echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerando " . $erro->getMessage();
}