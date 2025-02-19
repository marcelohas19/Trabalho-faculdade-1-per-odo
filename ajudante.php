<?php

include "conexao.php";
include "banco_clientes.php";


function criar_conta($conexao) {
    if (isset($_GET['nome'], $_GET['cpf'], $_GET['endereco']) &&
        !empty($_GET['nome']) &&
        !empty($_GET['cpf']) &&
        !empty($_GET['endereco'])){
        $cliente = array();
        
        $cliente['nome'] = $_GET['nome'];
        $cliente['cpf'] = $_GET['cpf'];
        $cliente['endereco'] = $_GET['endereco'];
        
        
        return cadastro($conexao, $cliente);
    }
}



function deposito_saque($conexao){
    if(isset($_GET['numero_conta']) && !empty($_GET['numero_conta'])
    && isset($_GET['valor']) && !empty($_GET['valor'])
    && isset($_GET['opcao']) && !empty($_GET['opcao'])){
    
        $conta = $_GET['numero_conta'];
        $valor = $_GET['valor'];
        $opcao = $_GET['opcao'];
        switch ($opcao){
            case 1:
                if(isset($conta) && isset($valor) && !empty($conta) && !empty($valor)){
                    echo deposito($conexao, $conta, $valor);
                }
                break;
                case 2: 
                    if(isset($conta) && isset($valor) && !empty($conta) && !empty($valor)){
                        echo saque($conexao, $conta, $valor);
                    }
                    break;
        }
    }
}
    
function transferir($conexao){
        if(isset($_GET['contaOrigem']) && !empty($_GET['contaOrigem'])
            && isset($_GET['valor']) && !empty($_GET['valor'])
            && isset($_GET['contaDestino']) && !empty($_GET['contaDestino']))
        {
            $conta_origem = $_GET['contaOrigem'];
            $conta_destino = $_GET['contaDestino'];
            $valor = $_GET['valor'];
            
            return transferencia($conexao, $conta_origem, $conta_destino, $valor);
        }
}



function pesquisar($conexao){
    if((isset($_GET['nome']) && !empty($_GET['nome'])) || (isset($_GET['cpf']) && !empty($_GET['cpf']))){
        $nome = $_GET['nome'];
        $cpf = $_GET['cpf'];
        $campo = $_GET['pesquisa'];
        
        $dados = busca_cliente($conexao, $nome, $cpf, $campo);
        
        if(is_array($dados)){
            return [$dados];
        } else{
            return $dados;
        }
    }

}



function listar_clientes($conexao){
    $lista_clientes = buscar_contas($conexao);
    return $lista_clientes;
}


function exclui_conta($conexao){  
    if(isset($_GET['numero_conta'])  && isset($_GET['opcao']) ){
        
        
        $opcao = $_GET['opcao'];
        $conta = $_GET['numero_conta'];
        switch($opcao){
            case 1:
                header('Location: inicio_banco.php');
                break;
                case 2:
                    if(!empty($conta)){
                        echo exclui_conta_banco($conexao, $conta);
                    }
        }
    }
}