<?php
    class EncomendaDAO {
        public function create($encomenda) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO encomenda(data_pedido, data_retirada, id_cliente, id_pagamento) 
                    VALUES (:dp, :dr, :c, :p)"
                );
                $query->bindValue(':dp', $encomenda->getDataPedido(), PDO::PARAM_STR);
                $query->bindValue(':dr', $encomenda->getDataRetirada(), PDO::PARAM_INT);
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
                    $encomenda = new Produto(); // Classe bean
                    $encomenda->setId($linha['id_encomenda']);
                    $encomenda->setDataPedido($linha['data_pedido']);
                    $encomenda->setDataRetirada($linha['data_retirada']);
                    // Atributo da associação (com Categoria)
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
                    $encomenda = new Produto(); // Classe bean
                    $encomenda->setId($linha['id_encomenda']);
                    $encomenda->setDataPedido($linha['data_pedido']);
                    $encomenda->setDataRetirada($linha['data_retirada']);
                    
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
                    SET data_pedido = :dp, data_retirada = :dr,
                    WHERE id_encomenda = :i"
                );
                $query->bindValue(':dp', $encomenda->getDataPedido(), PDO::PARAM_STR);
                $query->bindValue(':dr', $encomenda->getDataRetirada(), PDO::PARAM_INT);
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