<?php
    require "../../autoload.php";

    //coletar o valor do id pela URL
    $id = $_GET['id'];

    //instanciar um objeto da classe ClienteDAO
    $dao = new ClienteDAO();

    //invocar um metodo para excluir 
    $dao->destroy($id);

    //redirecionar para index 
    header('Location : index.php');
?>