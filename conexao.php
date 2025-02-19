<?php 

$bdservidor = '127.0.0.1';
$bdUsuario = 'banco';
$bdSenha = 'senha';
$bdBanco = 'banco';

$conexao = mysqli_connect($bdservidor, $bdUsuario, $bdSenha, $bdBanco);

if(mysqli_connect_errno()){
    echo "problema em conectar com o banco de dados";
    die();
}