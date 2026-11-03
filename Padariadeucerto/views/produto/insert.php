<?php
    // Incluir o arquivo de autoload
    require "../../autoload.php";

    // Instanciar um objeto da classe produto (bean)
    $produto = new Produto();

    // Definir os valores dos atributos a partir do form
    $produto->setDescricao($_POST['descricao']);
    $produto->setPreco($_POST['preco']);
  
    // Instanciar um objeto da Categoria
    $categoria = new Categoria();
    $categoria->setId($_POST['id_categoria']);

    // Definir a categoria no produto
    $produto->setCategoria($categoria);

    // Instanciar um objeto da classe filmeDAO
    $dao = new ProdutoDAO();

    // Invocar o método create
    $dao->create($produto);

    // Redirecionar para o index (COMENTAR CASO NÃO FUNCIONE)
    header('Location: index.php');