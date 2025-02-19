<?php
include "ajudante.php";
include "conexao.php";?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXCLUI</title>
    <link rel="stylesheet" href="banco.css" type="text/css" />
</head>
<body>
    <h1>EXCLUI CONTA</h1>
    <form action="" method="get">
        <label for="">Número da conta</label>
            <input type="number" name="numero_conta" id="">
            
        <button type="submit" name="opcao" value="1">Cancelar</button>
        <button type="submit" name="opcao" value="2">Excluir</button>
    </form>
</body>
</html>

<?php

exclui_conta($conexao);