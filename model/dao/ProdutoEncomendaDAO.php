<?php
    class ProdutoEncomendaDAO {
        public function create($produtohasencomenda) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produtohasencomenda(quantidade, id_encomenda, id_produto) 
                    VALUES (:q, :e, :p)"
                );
                $query->bindValue(':q', $produtohasencomenda->getQuantidade(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':e', $produtohasencomenda->getEncomenda()->getId(), PDO::PARAM_INT);
                $query->bindValue(':p', $produtohasencomenda->getProduto()->getId(), PDO::PARAM_INT);

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
                $query = BD::getConexao()->prepare("SELECT * FROM produtohasencomenda");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarEncomenda = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $produtohasencomenda = new ProdutoEncomenda(); // Classe bean
                    $produtohasencomenda->setId($linha['id_encomenda']);
                    $produtohasencomenda->setQuantidade($linha['quantidade']);
                   // Atributo da associação (com encomenda)
                    $daoEncomenda = new ClienteDAO();
                    $encomenda = $daoEncomenda->find($linha['id_cliente']);
                    $produtohasencomenda->setEncomenda($encomenda);

                    $daoProduto = new ProdutoDAO();
                    $produto = $daoProduto->find($linha['id_pagamento']);
                    $produtohasencomenda->setProduto($produto);


                    array_push($listarEncomenda, $produtohasencomenda);
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
                    "SELECT * FROM produtohasencomenda WHERE id_encomenda = :i"
                );
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                if($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $produtohasencomenda = new ProdutoEncomenda(); // Classe bean
                    $produtohasencomenda->setId($linha['id_encomenda']);
                    $produtohasencomenda->setQuantidade($linha['quantidade']);
                    
                    // Atributo da associação (com encomenda)
                    $daoEncomenda = new EncomendaDAO();
                    $encomenda = $daoEncomenda->find($linha['id_cliente']);
                    $produtohasencomenda->setEncomenda($encomenda);

                    $daoProduto = new ProdutoDAO();
                    $produto = $daoProduto->find($linha['id_pagamento']);
                    $produtohasencomenda->setProduto($produto);

                }
                
                return $produtohasencomenda;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }


        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM produtohasencomenda
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