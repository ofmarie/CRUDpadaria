<?php
    //Incluir o arquivo autoload 
    require "../../autoload.php";

    //Instanciar um objeto da classe Pagamento (bean)
    $pagamento = new Pagamento();

    //Definir os valores dos atributos a partir do form
    $pagamento->setTipoPagamento($_POST['tipo_pagamento']);

    //Instanciar a classe PagamentoDAO
    $dao = new PagamentoDAO();

    //Invocar o termo create
    $dao->create($Pagamento);

    //Redirecionar para o index (comentar caso não funcione)
    header('Location: index.php');


?>