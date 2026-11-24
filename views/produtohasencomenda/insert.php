<?php
    // Incluir o arquivo de autoload
    require "../../autoload.php";

    // Instanciar um objeto da classe produtohasencomenda$produtohasencomenda (bean)
    $produtohasencomenda = new ProdutoEncomenda();

    // Definir os valores dos atributos a partir do form
    $produtohasencomenda->setQuantidade($_POST['quantidade']);
  
    // Instanciar um objeto da Encomenda
    $produtohasencomenda = new Encomenda();
    $produtohasencomenda->setId($_POST['id_encomenda']);

    // Definir a produtohasencomenda$produtohasencomenda no produtohasencomenda$produtohasencomenda
    $produtohasencomenda->setEncomenda($produtohasencomenda);

    // Instanciar um objeto da Encomenda
    $produto = new Produto();
    $produto->setId($_POST['id_produto']);

    // Definir a produtohasencomenda$produtohasencomenda no produtohasencomenda$produtohasencomenda
    $produtohasencomenda->setProduto($produto);

    // Instanciar um objeto da classe filmeDAO
    $dao = new ProdutoEncomendaDAO();

    // Invocar o método create
    $dao->create($produtohasencomenda);

    // Redirecionar para o index (COMENTAR CASO NÃO FUNCIONE)
    header('Location: index.php');