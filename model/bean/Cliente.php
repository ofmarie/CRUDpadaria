<?php
    class Cliente{
        //Atributos
        private $id;
        private $nome;
        private $telefone;


        //Metodos de encapsulamento(getters e setters)
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }
    }