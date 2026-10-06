<?php
    //Incluir o arquivo autoload 
    require "../../autoload.php";

    //Instanciar um objeto da classe categoria (bean)
    $categoria = new categoria();

    //Definir os valores dos atributos a partir do form
    $categoria->setCategoria($_POST['categoria']);

    //Instanciar a classe ClienteDAO
    $dao = new CategoriaDAO();

    //Invocar o termo create
    $dao->create($categoria);

    //Redirecionar para o index (comentar caso não funcione)
    header('Location: index.php');


?>