<?php
    require "../../autoload.php";

    //Instanciar um objeto da classe$categoria(bean)
    $categoria = new  Categoria();

    //Definir os valores dos atributos a partir dos dados do form;
    $categoria->setId($_POST['id']);
    $categoria->setDescricao($_POST['descricao']);
   

    //instanciar um objeto da classe ClienteDao
    $dao = new CategoriaDAO();

    //invocar o método update da classe ClienteDAO
    $dao->update($categoria);

    //redirecionar para o index.php
    header('Location: index.php');

?>