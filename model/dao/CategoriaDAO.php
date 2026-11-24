<?php 
    class CategoriaDAO {
         public function create($categoria){
           
            try{
                $query = BD::getConexao()->prepare("INSERT INTO categoria(descricao) VALUES (:d) ");
                $query->bindValue(':d', $categoria->getDescricao(), PDO::PARAM_STR);

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
                $query = BD::getConexao()->prepare("SELECT * FROM categoria");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listarCategoria = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $categoria = new Categoria(); // Classe bean
                    $categoria->setId($linha['id_categoria']);
                    $categoria->setDescricao($linha['descricao']);

                    array_push($listarCategoria, $categoria);
                }
                
                return $listarCategoria;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM categoria WHERE id_categoria = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

               
                if($linha = $query->fetch(PDO::FETCH_ASSOC)){
                    $categoria = new categoria();//Classe bean
                    $categoria->setId($linha['id_categoria']);
                    $categoria->setDescricao($linha['descricao']);
                }

                return $categoria;


            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
            
        }

        public function update($categoria){
           
            try{
                $query = BD::getConexao()->prepare("UPDATE categoria 
                SET descricao = :d WHERE id_categoria = :i");
                $query->bindValue(':i', $categoria->getId(), PDO::PARAM_INT);
                $query->bindValue(':d', $categoria->getDescricao(), PDO::PARAM_STR);

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
                $query = BD::getConexao()->prepare("DELETE FROM categoria 
                WHERE id_categoria = :i
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