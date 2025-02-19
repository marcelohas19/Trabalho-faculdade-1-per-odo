<?php
include "ajudante.php";
include "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRIAR CONTA</COMmand></title>
    <link rel="stylesheet" href="banco.css" type="text/css" />
</head>
<body>
    <h1>CRIAR CONTA</h1>
    <form action="" method="get">
        <label for="">Nome:</label>
            <input type="text" name="nome" id="" placeholder="Nome Completo" required>

        <label for="">CPF:</label>
            <input type="text" name="cpf" id="" placeholder="ex:000.000.000-00" minlength="14" maxlength="14" required>

        <label for="">Endereço</label>
            <input type="text" name="endereco" id="" required>
        
        <button type="submit" value="CRIAR">CRIAR</button>
    </form>
    <a href="inicio_banco.php"><button type="submit" >VOLTAR</button></a>
</body>
</html>

<?php
echo criar_conta($conexao);
