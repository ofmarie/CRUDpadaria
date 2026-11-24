<?php
    class Pagamento{
        private $id;
        private $tipoPagamento;

            public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }
    
        public function getTipoPagamento(){
            return $this->tipoPagamento;
        }

        public function setTipoPagamento($tipoPagamento){
            $this->tipoPagamento = $tipoPagamento;
        }
    
    }