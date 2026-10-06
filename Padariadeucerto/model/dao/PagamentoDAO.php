<?php 
    class PagamentoDAO {
        public function create($pagamento){
            //arrumara as querys para a classe pagamento,
            //  foi copiado as atualizações do cliente para esta pasta!
            try{
                $query = BD::getConexao()->prepare("INSERT INTO pagamento(tipo_pagamento) 
                VALUES (:t) ");
                $query->bindValue(':t', $pagamento->getTipoPagamento(), PDO::PARAM_STR);

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
                $query = BD::getConexao()->prepare("SELECT * FROM pagamento");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarPagamento = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $pagamento = new Pagamento(); // Classe bean
                    $pagamento->setId($linha['id_pagamento']);
                    $pagamento->setTipoPagamento($linha['tipo_pagamento']);

                    array_push($listarPagamento, $pagamento);
                }
                
                return $listarPagamento;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }

         public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM pagamento WHERE id_pagamento = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

               
                if($linha = $query->fetch(PDO::FETCH_ASSOC)){
                    $pagamento = new Pagamento();//Classe bean
                    $pagamento->setId($linha['id_pagamento']);
                    $pagamento->setTipoPagamento($linha['tipo_pagamento']);
                }

                return $pagamento;


            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
            
        }

        public function update($pagamento){
           
            try{
                $query = BD::getConexao()->prepare("UPDATE pagamento 
                SET tipo_pagamento = :t WHERE id_pagamento = :i");
                $query->bindValue(':i', $id->getId(), PDO::PARAM_INT);
                $query->bindValue(':t', $pagamento->getTipoPagamento(), PDO::PARAM_STR);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id){
            //os :n e :t são apelidos para os atributos nome e telefone!
            try{
                $query = BD::getConexao()->prepare("DELETE FROM pagamento 
                WHERE id_pagamento = :i
                ");
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
?>