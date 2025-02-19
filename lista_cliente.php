<?php 
include "ajudante.php";
include "conexao.php";
$lista_clientes = listar_clientes($conexao); ?>


<!DOCTYPE html>
<html>
<head>
    <title>CLIENTE DO BANCO</title>
    <link rel="stylesheet" href="banco.css" type="text/css" />
</head>
<body>
  <h2>Resultado da pesquisa:</h2>
  <table>
    <tr>
      <th>N° CONTA</th>
      <th>AGÊNCIA</th>
      <th>NOME</th>
      <th>CPF</th>
      <th>ENDEREÇO</th>
      <th>SALDO</th>
    </tr>
    <?php foreach ($lista_clientes as $cliente): ?>
      <tr>
        <td><?php echo htmlspecialchars($cliente['numero_conta']); ?></td>
        <td><?php echo htmlspecialchars($cliente['numero_agencia']); ?></td>
        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
        <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
        <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
        <td><?php echo htmlspecialchars($cliente['saldo']); ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <a href="inicio_banco.php"><button type="submit" >VOLTAR</button></a>
</table>
</body>
</html>