<?php
    class Encomenda {
        // Atributos
        private $id;
        private $dataPedido;
        private $dataRetirada;
        private $cliente; // Associação com a classe Categoria
        private $pagamento; // Associação com a classe Categoria

        // Métodos de encapsulamento (getters e setters)
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

         public function getDataPedido() {
            return $this->dataPedido;
        }

        public function setDataPedido($dataPedido) {
            $this->dataPedido = $dataPedido;
        }

        public function getDataRetirada() {
            return $this->dataRetirada;
        }

        public function setDataRetirada($dataRetirada) {
            $this->dataRetirada = $dataRetirada;
        }

        // Get e Set do atributo de associação
        public function getCliente() {
            return $this->cliente;
        }

        public function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        // Get e Set do atributo de associação
        public function getPagamento() {
            return $this->pagamento;
        }

        public function setPagamento($pagamento) {
            $this->pagamento = $pagamento;
        }
    }