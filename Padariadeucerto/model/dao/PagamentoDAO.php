<?php 
    class PagamentoDAO {
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
    }
?>