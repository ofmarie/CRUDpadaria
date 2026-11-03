<?php
    class ProdutoDAO {
        public function create($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto(descricao, preco, id_categoria) 
                    VALUES (:d, :p, :c)"
                );
                $query->bindValue(':d', $produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':p', $produto->getPreco(), PDO::PARAM_INT);
                // Bind para a chave estrangeira
                $query->bindValue(':c', $produto->getCategoria()->getId(), PDO::PARAM_INT);

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
                $query = BD::getConexao()->prepare("SELECT * FROM produto");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarProduto = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $produto = new Produto(); // Classe bean
                    $produto->setId($linha['id_produto']);
                    $produto->setDescricao($linha['descricao']);
                    $produto->setPreco($linha['preco']);
                    // Atributo da associação (com Categoria)
                    $daoCategoria = new CategoriaDAO();
                    $categoria = $daoCategoria->find($linha['id_categoria']);
                    $produto->setCategoria($categoria);


                    array_push($listarProduto, $produto);
                }
                
                return $listarProduto;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "SELECT * FROM produto WHERE id_produto = :i"
                );
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                if($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $produto = new Produto(); // Classe bean
                    $produto->setId($linha['id_produto']);
                    $produto->setDescricao($linha['descricao']);
                    $produto->setPreco($linha['preco']);
                    
                }
                
                return $produto;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }

        public function update($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE produto
                    SET descricao = :d, preco = :p,
                    WHERE id_produto = :i"
                );
                $query->bindValue(':d', $produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':p', $produto->getPreco(), PDO::PARAM_INT);
                $query->bindValue(':i', $produto->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM produto
                    WHERE id_produto = :i"
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