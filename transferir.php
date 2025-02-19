<?php
include "ajudante.php";
include "conexao.php";?>

<!DOCTYPE html>
<html>
<head>
    <title>Simulador de Transferência Bancária</title>
    <link rel="stylesheet" href="banco.css" type="text/css" />
    
</head>
<body>
    <h1>Simulador de Transferência Bancária</h1>
    <form>
        <label for="contaOrigem">Conta de Origem:</label>
        <input type="number" id="contaOrigem" name="contaOrigem" required>

        <label for="contaDestino">Conta de Destino:</label>
        <input type="number" id="contaDestino" name="contaDestino" required>

        <label for="valor">Valor da Transferência:</label>
        <input type="number" id="valor" name="valor" required>

        <button type="submit">Realizar Transferência</button>
        
    </form>
    <a href="inicio_banco.php"><button type="submit" >VOLTAR</button></a>
</body>
</html>

<?php
echo transferir($conexao);
    

































    