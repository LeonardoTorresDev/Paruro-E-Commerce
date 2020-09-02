<?php
    class PedidoController{
        public function hacer(){
            Utils::isNotAdmin();

            require_once "views/pedido/hacer.php";
        }
        public function add(){
            
        }
    }
?>