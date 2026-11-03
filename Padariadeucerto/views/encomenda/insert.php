<?php
    // Incluir o arquivo de autoload
    require "../../autoload.php";

    // Instanciar um objeto da classe encomenda$encomenda (bean)
    $encomenda = new Encomenda();

    // Definir os valores dos atributos a partir do form
    $encomenda->setDataPedido($_POST['data_pedido']);
    $encomenda->setDataRetirada($_POST['data_retirada']);
  
    // Instanciar um objeto da Cliente
    $cliente = new Cliente();
    $cliente->setId($_POST['id_cliente']);

    // Definir a cliente$cliente no encomenda$encomenda
    $encomenda->setCliente($cliente);

    // Instanciar um objeto da Cliente
    $pagamento = new Pagamento();
    $pagamento->setId($_POST['id_pagamento']);

    // Definir a cliente$cliente no encomenda$encomenda
    $encomenda->setPagamento($pagamento);

    // Instanciar um objeto da classe filmeDAO
    $dao = new EncomendaDAO();

    // Invocar o método create
    $dao->create($encomenda);

    // Redirecionar para o index (COMENTAR CASO NÃO FUNCIONE)
    header('Location: index.php');