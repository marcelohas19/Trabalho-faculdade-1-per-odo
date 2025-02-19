<?php
include "ajudante.php";
include "conexao.php";?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPOSITAR e Saque</title>
    <link rel="stylesheet" href="banco.css" type="text/css" />
</head>
<body>
    <h1>Deposito e Saque</h1>
    <form action="" method="get">
        <label for="">Numero da Conta</label>
        <input type="number" name="numero_conta" id="" placeholder="4 números" maxlength="4" required>

        <label for="">Valor da Operação</label>
        <input type="number" name="valor"  required>

        <button type="submit" name="opcao" value="1">DEPOSITAR</button>
        <button type="submit" name="opcao" value="2">SACAR</button>
    </form>
    <a href="inicio_banco.php"><button type="submit" >VOLTAR</button></a>
</body>
</html>

<?php
echo deposito_saque($conexao);