<?php
    class Pedido{
        private $id;
        
        private $usuario_id;
        private $vendedor_id;
        private $provincia;
        private $localidad;
        private $direccion;
        private $coste;
        private $estado;
        private $fecha;
        private $hora;
        private $db;

        function __construct(){
            $this->db=Database::connect();
        }

        function getId(){
            return $this->id;
        }
        function setId($id){
            $this->id=$id;
        }
       
        function getUsuario_id(){
            return $this->usuario_id;
        }
        function setUsuario_id($usuario_id){
            $this->usuario_id=$usuario_id;
        }

        function getVendedor_id(){
            return $this->vendedor_id;
        }
        function setVendedor_id($vendedor_id){
            $this->vendedor_id=$vendedor_id;
        }

        function getProvincia(){
            return $this->provincia;
        }
        function setProvincia($provincia){
            $this->provincia=$this->db->real_escape_string($provincia);
        }
        function getLocalidad(){
            return $this->localidad;
        }
        function setLocalidad($localidad){
            $this->localidad=$this->db->real_escape_string($localidad);
        }
        function getDireccion(){
            return $this->direccion;
        }
        function setDireccion($direccion){
            $this->direccion=$this->db->real_escape_string($direccion);
        }
        function getCoste(){
            return $this->coste;
        }
        function setCoste($coste){
            $this->coste=$this->db->real_escape_string($coste);
        }
        function getEstado(){
            return $this->estado;
        }
        function setEstado($estado){
            $this->estado=$this->db->real_escape_string($estado);
        }
        function getFecha(){
            return $this->fecha;
        }
        function setFecha($fecha){
            $this->fecha=$fecha;
        }
        function getHora(){
            return $this->hora;
        }
        function setHora($hora){
            $this->hora=$hora;
        }

        public function getAll(){
            $productos=$this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
            return $productos;
        }

        public function getOne(){
            $producto=$this->db->query("SELECT * FROM pedidos WHERE id= {$this->getId()};");
            return $producto->fetch_object();
        }

        public function getAllByUser(){
            $sql = "SELECT p.* FROM pedidos p "
                    . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
                
            $pedido = $this->db->query($sql);
                
            return $pedido;
        }

        public function getAllByVendor(){
            $sql = "SELECT p.* FROM pedidos p "
                    . "WHERE p.vendedor_id = {$this->getUsuario_id()} ORDER BY id DESC";
                
            $pedido = $this->db->query($sql);
                
            return $pedido;
        }

        public function getProductosByPedido($id){           
            $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                    . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                    . "WHERE lp.pedido_id={$id}";
                    
            $productos = $this->db->query($sql);
                
            return $productos;
        }

        public function save(){
            
            $sql="INSERT INTO pedidos VALUES (NULL, {$this->getUsuario_id()},{$this->getVendedor_id()} , '{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}', {$this->getCoste()}, '{$this->getEstado()}', CURDATE(),CURTIME())";
            ;
            $save=$this->db->query($sql);

            $result=false;
            if($save){
                $result=true;
            }
            return $result;
        }

        public function save_linea($id){
            $sql="SELECT LAST_INSERT_ID() AS 'pedido';";
            $query=$this->db->query($sql);
            $pedido_id=$query->fetch_object()->pedido;

            foreach($_SESSION['carrito'] as $elemento){ 
               
                if($id==$elemento['producto']->usuario_id){
                    $producto=$elemento['producto'];
                    $insert="INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id},{$producto->id},{$elemento['unidades']});";
                    $save=$this->db->query($insert);
              

                    $update="UPDATE productos SET stock=stock-{$elemento['unidades']} WHERE id={$producto->id};";
                    $save_update=$this->db->query($update);
                 
                }       
             
            }
                
            $result=false;
            if($save && $save_update){
                $result=true;
            }
            return $result;
        }

        public function edit(){
            $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
            $sql .= " WHERE id={$this->getId()};";
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function getRows($vendedor_id){
            $sql="SELECT coste FROM pedidos WHERE vendedor_id=$vendedor_id AND estado='sended'";
            $ventas=$this->db->query($sql);
            return $ventas;
        }

    }