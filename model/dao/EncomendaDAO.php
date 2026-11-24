<?php
    class EncomendaDAO {
        public function create($encomenda) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO encomenda(data_pedido, data_retirada, id_cliente, id_pagamento) 
                    VALUES (:d, :r, :c, :p)"
                );
                $query->bindValue(':d', $encomenda->getDataPedido(), PDO::PARAM_STR);
                $query->bindValue(':r', $encomenda->getDataRetirada(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':c', $encomenda->getCliente()->getId(), PDO::PARAM_INT);
                $query->bindValue(':p', $encomenda->getPagamento()->getId(), PDO::PARAM_INT);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM encomenda");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarEncomenda = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $encomenda = new Encomenda(); // Classe bean
                    $encomenda->setId($linha['id_encomenda']);
                    $encomenda->setDataPedido($linha['data_pedido']);
                    $encomenda->setDataRetirada($linha['data_retirada']);
                    // Atributo da associação (com cliente)
                    $daoCliente = new ClienteDAO();
                    $cliente = $daoCliente->find($linha['id_cliente']);
                    $encomenda->setCliente($cliente);

                    $daoPagamento = new PagamentoDAO();
                    $pagamento = $daoPagamento->find($linha['id_pagamento']);
                    $encomenda->setPagamento($pagamento);


                    array_push($listarEncomenda, $encomenda);
                }
                
                return $listarEncomenda;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "SELECT * FROM encomenda WHERE id_encomenda = :i"
                );
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                if($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $encomenda = new Encomenda(); // Classe bean
                    $encomenda->setId($linha['id_encomenda']);
                    $encomenda->setDataPedido($linha['data_pedido']);
                    $encomenda->setDataRetirada($linha['data_retirada']);
                    
                    // Atributo da associação (com cliente)
                    $daoCliente = new ClienteDAO();
                    $cliente = $daoCliente->find($linha['id_cliente']);
                    $encomenda->setCliente($cliente);

                    $daoPagamento = new PagamentoDAO();
                    $pagamento = $daoPagamento->find($linha['id_pagamento']);
                    $encomenda->setPagamento($pagamento);

                }
                
                return $encomenda;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }

        public function update($encomenda) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE encomenda
                    SET data_pedido = :d, data_retirada = :r,
                    WHERE id_encomenda = :i"
                );
                $query->bindValue(':d', $encomenda->getDataPedido(), PDO::PARAM_INT);
                $query->bindValue(':r', $encomenda->getDataRetirada(), PDO::PARAM_INT);
                $query->bindValue(':i', $encomenda->getId(), PDO::PARAM_INT);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM encomenda
                    WHERE id_encomenda = :i"
                );                
                $query->bindValue(':i', $id, PDO::PARAM_INT);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }