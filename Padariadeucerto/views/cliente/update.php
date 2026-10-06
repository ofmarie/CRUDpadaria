<?php
    require "../../autoload.php";

    //Instanciar um objeto da classe Cliente(bean)
    $cliente = new  Cliente();

    //Definir os valores dos atributos a partir dos dados do form;
    $cliente->setId($_POST['id']);
    $cliente->setNome($_POST['nome']);
    $cliente->setTelefone($_POST['telefone']);

    //instanciar um objeto da classe ClienteDao
    $dao = new ClienteDAO();

    //invocar o método update da classe ClienteDAO
    $dao->update($cliente);

    //redirecionar para o index.php
    header('Location: index.php');

?>