<?php
    require "../../autoload.php";

    //Instanciar um objeto da classe Cliente(bean)
    $cliente = new  Pagamento();

    //Definir os valores dos atributos a partir dos dados do form;
    $cliente->setId($_POST['id']);
    $cliente->setTipoPagamento($_POST['tipo_pagamento']);
   

    //instanciar um objeto da classe ClienteDao
    $dao = new PagamentoDAO();

    //invocar o método update da classe ClienteDAO
    $dao->update($pagamento);

    //redirecionar para o index.php
    header('Location: index.php');

?>