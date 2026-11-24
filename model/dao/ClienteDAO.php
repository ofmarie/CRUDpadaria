<?php
    class ClienteDAO {
        public function create($cliente){
            //os :n e :t são apelidos para os atributos nome e telefone!
            try{
                $query = BD::getConexao()->prepare("INSERT INTO cliente(nome, telefone) VALUES (:n, :t) ");
                $query->bindValue(':n', $cliente->getNome(), PDO::PARAM_STR);
                $query->bindValue(':t', $cliente->getTelefone(), PDO::PARAM_STR);

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
                $query = BD::getConexao()->prepare("SELECT * FROM cliente");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarCliente = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha){
                    $cliente = new Cliente();//Classe bean
                    $cliente->setId($linha['id_cliente']);
                    $cliente->setNome($linha['nome']);
                    $cliente->setTelefone($linha['telefone']);

                    array_push($listarCliente, $cliente);
                }

                return $listarCliente;


            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
            
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM cliente WHERE id_cliente = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

               
                if($linha = $query->fetch(PDO::FETCH_ASSOC)){
                    $cliente = new Cliente();//Classe bean
                    $cliente->setId($linha['id_cliente']);
                    $cliente->setNome($linha['nome']);
                    $cliente->setTelefone($linha['telefone']);
                }

                return $cliente;


            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
            
        }

        public function update($cliente){
            //os :n e :t são apelidos para os atributos nome e telefone!
            try{
                $query = BD::getConexao()->prepare("UPDATE cliente 
                SET nome = :n, telefone = :t WHERE id_cliente = :i");
                $query->bindValue(':i', $cliente->getId(), PDO::PARAM_INT);
                $query->bindValue(':n', $cliente->getNome(), PDO::PARAM_STR);
                $query->bindValue(':t', $cliente->getTelefone(), PDO::PARAM_STR);

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
                $query = BD::getConexao()->prepare("DELETE FROM cliente 
                WHERE id_cliente = :i
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