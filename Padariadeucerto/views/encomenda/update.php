<?php
    // Incluir o arquivo de autoload
    require "../../autoload.php";

    // Instanciar um objeto da classe encomenda$encomenda (bean)
    $encomenda = new Encomenda();

    // Definir os valores dos atributos a partir do form
    $encomenda->setDataPedido($_POST['data_pedido']);
    $encomenda->setDataRetirada($_POST['data_retirada']);
    $encomenda->setId($_POST['id']);

    // Instanciar um objeto da classe filmeDAO
    $dao = new EncomendaDAO();

    // Invocar o método create
    $dao->update($encomenda);

    // Redirecionar para o index (COMENTAR CASO NÃO FUNCIONE)
    header('Location: index.php');