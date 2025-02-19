<?php 

include "opcoes.php";

if(isset($_POST['pagina'])){
    $pagina = $_POST['pagina'];
    switch( $pagina){
        case 1:
            header('Location: criar_conta.php');
            break;
        case 2:
            header('Location: excluir_conta.php');
            break;
        case 3: 
            header('Location: deposito.php');
            break;
        case 4:
            header('Location: pesquisar.php');
            break;
        case 5:
            header('Location: transferir.php');
            break;
        case 6:
            header('Location: lista_cliente.php');
            break;
    }
}


