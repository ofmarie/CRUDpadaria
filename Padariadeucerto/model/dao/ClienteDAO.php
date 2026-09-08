<?php
    class ClienteDAO {
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
    }