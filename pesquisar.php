<?php
include "ajudante.php";
include "conexao.php";
?>
 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESQUISAR</title>
    <link rel="stylesheet" href="banco.css" type="text/css" />

    <script>
        function mostrarCampo() {
            var opcao = document.getElementById('pesquisa').value;
            // Esconde ambos os campos inicialmente
            document.getElementById('campoNome').style.display = 'none';
            document.getElementById('campoCpf').style.display = 'none';

            // Exibe o campo de acordo com a opção selecionada
            if  (opcao == 'cpf'){
                document.getElementById('campoCpf').style.display = 'block';
            } else if (opcao == 'nome') {
                document.getElementById('campoNome').style.display = 'block';
            }
        }
    </script>


</head>
<body>
    <h1>Pesquisar por conta</h1>
    <form action="" method="get">
        <label for="pesquisa">Escolha uma opção:</label>
        <select name="pesquisa" id="pesquisa" onchange="mostrarCampo()" required>
            <option value="">Selecione...</option>
            <option value="cpf">CPF</option>
            <option value="nome">Nome</option>
        </select>

        <!-- Campo de pesquisa por nome, inicialmente oculto -->
        <div id="campoNome" style="display:none;">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Digite o nome COPLETO">
        </div>
        
        <!-- Campo de pesquisa por CPF, inicialmente oculto -->
        <div id="campoCpf" style="display:none;">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="" placeholder="ex:000.000.000-00" minlength="14" maxlength="14">
        </div>
            

         <button type="submit">PESQUISAR</button>
    </form>
    
        <?php
        $dados = pesquisar($conexao);
        if (is_array($dados)){ ?>
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
                <?php foreach ($dados as $cliente): ?>
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
        <?php } else{
            echo $dados;
        }?>
        <a href="inicio_banco.php"><button type="submit" >VOLTAR</button></a>
</body>
</html>
