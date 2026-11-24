<?php
    //Incluir o arquivo autoload 
    require "../../autoload.php";

    //Instanciar um objeto da classe cliente (bean)
    $cliente = new Cliente();

    //Definir os valores dos atributos a partir do form
    $cliente->setNome($_POST['nome']);
    $cliente->setTelefone($_POST['telefone']);

    //Instanciar a classe ClienteDAO
    $dao = new ClienteDAO();

    //Invocar o termo create
    $dao->create($cliente);

    //Redirecionar para o index (comentar caso não funcione)
    header('Location: index.php');


?>