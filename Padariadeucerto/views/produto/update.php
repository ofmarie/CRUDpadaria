<?php
    // Incluir o arquivo de autoload
    require "../../autoload.php";

    // Instanciar um objeto da classe produto (bean)
    $produto = new Produto();

    // Definir os valores dos atributos a partir do form
    $produto->setDescricao($_POST['descricao']);
    $produto->setPreco($_POST['preco']);
    $produto->setId($_POST['id']);

    // Instanciar um objeto da classe filmeDAO
    $dao = new ProdutoDAO();

    // Invocar o método create
    $dao->update($produto);

    // Redirecionar para o index (COMENTAR CASO NÃO FUNCIONE)
    header('Location: index.php');