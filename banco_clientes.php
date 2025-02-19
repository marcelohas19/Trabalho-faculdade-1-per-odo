<?php


function cadastro($conexao, $dadosCliente) {
    
    // Escapar os dados para evitar SQL Injection
    $nome = mysqli_real_escape_string($conexao, $dadosCliente['nome']);
    $cpf = mysqli_real_escape_string($conexao, $dadosCliente['cpf']);
    $endereco = mysqli_real_escape_string($conexao, $dadosCliente['endereco']);
    
    $sqlBusca = "SELECT * FROM contas WHERE cpf = $cpf";
 
    if(mysqli_query($conexao, $sqlBusca)){
        return "CPF JÁ CADASTRADO";
    }else{
        $sql = "INSERT INTO contas (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco')";
        
        if (mysqli_query($conexao, $sql)) {
            return "Cliente cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar cliente: " . mysqli_error($conexao);
        }
    }
}
    
    
function deposito($conexao, $numeroConta, $valor) {
    // Verificar se o valor do depósito é válido
    if ($valor <= 0) {
        return "Erro: O valor do depósito deve ser maior que zero.";
    }

    // Escapar o número da conta
    $numeroConta = mysqli_real_escape_string($conexao, $numeroConta);

    // Verificar se a conta existe
    $sqlVerificar = "SELECT saldo FROM contas WHERE numero_conta = '$numeroConta'";
    $resultado = mysqli_query($conexao, $sqlVerificar);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obter o saldo atual
        $dados = mysqli_fetch_assoc($resultado);
        $saldoAtual = $dados['saldo'];

        // Calcular o novo saldo
        $novoSaldo = $saldoAtual + $valor;

        // Atualizar o saldo no banco de dados
        $sqlAtualizar = "UPDATE contas SET saldo = '$novoSaldo' WHERE numero_conta = '$numeroConta'";
        if (mysqli_query($conexao, $sqlAtualizar)) {
            return "Depósito realizado com sucesso! Novo saldo: $novoSaldo.";
        } else {
            return "Erro ao atualizar saldo: " . mysqli_error($conexao);
        }
    } else {
        return "Erro: Conta não encontrada.";
    }
}

function saque($conexao, $numeroConta, $valor) {
    // Verificar se o valor do saque é válido
    if ($valor <= 0) {
        return "Erro: O valor do saque deve ser maior que zero.";
    }

    // Escapar o número da conta
    $numeroConta = mysqli_real_escape_string($conexao, $numeroConta);

    // Verificar se a conta existe
    $sqlVerificar = "SELECT saldo FROM contas WHERE numero_conta = '$numeroConta'";
    $resultado = mysqli_query($conexao, $sqlVerificar);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obter o saldo atual
        $dados = mysqli_fetch_assoc($resultado);
        $saldoAtual = $dados['saldo'];

        // Verificar se há saldo suficiente
        if ($saldoAtual >= $valor) {
            // Calcular o novo saldo
            $novoSaldo = $saldoAtual - $valor;

            // Atualizar o saldo no banco de dados
            $sqlAtualizar = "UPDATE contas SET saldo = '$novoSaldo' WHERE numero_conta = '$numeroConta'";
            if (mysqli_query($conexao, $sqlAtualizar)) {
                return "Saque realizado com sucesso! Novo saldo: $novoSaldo.";
            } else {
                return "Erro ao atualizar saldo: " . mysqli_error($conexao);
            }
        } else {
            return "Erro: Saldo insuficiente. Saldo atual: $saldoAtual.";
        }
    } else {
        return "Erro: Conta não encontrada.";
    }
}

function transferencia($conexao, $conta_origem, $conta_destino, $valor){
    $origem = mysqli_real_escape_string($conexao, $conta_origem);
    $destino = mysqli_real_escape_string($conexao, $conta_destino);
    $quantia = (float)$valor;

    
    // Verificar se a conta existe
    $sqlVerificar = "SELECT numero_conta, saldo 
                 FROM contas 
                 WHERE numero_conta IN ('$origem', '$destino') 
                 ORDER BY FIELD(numero_conta, '$origem', '$destino')
                 ";


    $resultado = mysqli_query($conexao, $sqlVerificar);
    
    if ($resultado && mysqli_num_rows($resultado) === 2){

        $saldo_conta_origem = busca_saldo($conexao, $origem);
        if($quantia <= $saldo_conta_origem){
        
            //ATUALIZA SALDO DAS 
            $saldos = array();
            $i= 0;
            while ($dados = mysqli_fetch_assoc($resultado)) {
                $saldos[$i] = $dados['saldo'];
                $i++;
            }
            
            // Validar saldo suficiente na conta de origem
            $novo_saldo_origem = $saldos[0] - $quantia;
            $novo_saldo_destino = $saldos[1] + $quantia;
            
            
            $sqlAtualizar01 = "UPDATE contas SET saldo = '$novo_saldo_origem' WHERE numero_conta = '$origem'";
            $sqlAtualizar02 = "UPDATE contas SET saldo = '$novo_saldo_destino' WHERE numero_conta = '$destino'";
            
            if(mysqli_query($conexao, $sqlAtualizar01) && mysqli_query($conexao, $sqlAtualizar02)){
                return "TRANSFERENCI REALIZADA COM SUCESSO";
            }else{
                return "ERRO AO REALIZAR TRANFERENCIA";
            }
        }else {
            return "SALDO INSUFICIENTE";
        }
    }else{
        return "CONTA NÃO EMCONTRADA";
    }
}

function buscar_contas($conexao){
        $sqlBusca = "SELECT * FROM contas;";
        $resultado = mysqli_query($conexao, $sqlBusca);
    
        $lista_clientes = array();
    
        while($lista_cliente = mysqli_fetch_assoc($resultado))
        {
            $lista_clientes[] = $lista_cliente;
        }
    
        return $lista_clientes;
}

function busca_cliente($conexao, $nome, $cpf, $campo){
     if($campo === 'nome'){
        $sql = "SELECT * FROM contas WHERE nome LIKE '%$nome%' ";
    }else{
        $sql = "SELECT * FROM contas WHERE cpf = $cpf ";
    }


    if($resultado = mysqli_query($conexao, $sql)){
        return  mysqli_fetch_assoc($resultado);
    }else {
        return "CONTA NÃO ENCOTRADA";
    }
}

function exclui_conta_banco($conexao, $conta) {
    // Escapar o número da conta para evitar SQL Injection
    $numeroconta = mysqli_real_escape_string($conexao, $conta);

    // Montar o comando SQL
    $sql = "DELETE FROM contas WHERE numero_conta = '$numeroconta'";

    // Executar o comando SQL
    if (mysqli_query($conexao, $sql)) {
        if (mysqli_affected_rows($conexao) > 0) {
            return "Conta excluída com sucesso!";
        } else {
            return "Conta não encontrada.";
        }
    } else {
        return "Erro ao excluir conta: " . mysqli_error($conexao);
    }
}



function busca_saldo($conexao, $conta){
    $num_conta = mysqli_real_escape_string($conexao, $conta);

    $sql = "SELECT saldo FROM contas WHERE numero_conta = '$num_conta'";

    $resultado = mysqli_query($conexao, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        return $dados['saldo'];
    } else {
        return null;
    }
}








    
