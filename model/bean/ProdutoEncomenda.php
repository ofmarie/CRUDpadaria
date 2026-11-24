<?php
    class ProdutoEncomenda {
        // Atributos
        private $id;
        private $quantidade;
        private $encomenda; // Associação com a classe Categoria
        private $produto; // Associação com a classe Categoria

        // Métodos de encapsulamento (getters e setters)
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }
         
        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        // Get e Set do atributo de associação
        public function getEncomenda() {
            return $this->encomenda;
        }

        public function setEncomenda($encomenda) {
            $this->encomenda = $encomenda;
        }

        // Get e Set do atributo de associação
        public function getProduto() {
            return $this->produto;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }
    }