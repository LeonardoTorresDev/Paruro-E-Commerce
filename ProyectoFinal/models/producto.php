<?php
    class Producto{
        private $id;
        private $categoria_id;
        private $usuario_id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;
        private $oferta;
        private $fecha;
        private $imagen;
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
        function getCategoria_id(){
            return $this->categoria_id;
        }
        function setCategoria_id($categoria_id){
            $this->categoria_id=$categoria_id;
        }
        function getUsuario_id(){
            return $this->usuario_id;
        }
        function setUsuario_id($usuario_id){
            $this->usuario_id=$usuario_id;
        }
        function getNombre(){
            return $this->nombre;
        }
        function setNombre($nombre){
            $this->nombre=$this->db->real_escape_string($nombre);
        }
        function getDescripcion(){
            return $this->descripcion;
        }
        function setDescripcion($descripcion){
            $this->descripcion=$this->db->real_escape_string($descripcion);
        }
        function getPrecio(){
            return $this->precio;
        }
        function setPrecio($precio){
            $this->precio=$this->db->real_escape_string($precio);
        }
        function getStock(){
            return $this->stock;
        }
        function setStock($stock){
            $this->stock=$this->db->real_escape_string($stock);
        }
        function getOferta(){
            return $this->oferta;
        }
        function setOferta($oferta){
            $this->oferta=$this->db->real_escape_string($oferta);
        }
        function getFecha(){
            return $this->fecha;
        }
        function setFecha($fecha){
            $this->fecha=$fecha;
        }
        function getImagen(){
            return $this->imagen;
        }
        function setImagen($imagen){
            $this->imagen=$imagen;
        }

        public function getVendedor($id){
            $sql="SELECT nombre, apellidos FROM usuarios WHERE id=$id;";
            $vendedor=$this->db->query($sql);
            return $vendedor->fetch_object();
        }

        public function getAll(){
            $productos=$this->db->query("SELECT * FROM productos ORDER BY id DESC;");
            return $productos;
        }

        public function getAllCategory(){
            $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                    . "INNER JOIN categorias c ON c.id = p.categoria_id "
                    . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                    . "ORDER BY id DESC;";
            $productos = $this->db->query($sql);
            return $productos;
        }

        public function getOne(){
            $producto=$this->db->query("SELECT * FROM productos WHERE id= {$this->getId()};");
            return $producto->fetch_object();
        }

        public function save(){
            
            $sql="INSERT INTO productos VALUES (NULL,{$this->getCategoria_id()},{$this->getUsuario_id()}, '{$this->getNombre()}' , '{$this->getDescripcion()}' , {$this->getPrecio()} , {$this->getStock()},null,CURDATE(),'{$this->getImagen()}');";
            $save=$this->db->query($sql);

            $result=false;
            if($save){
                $result=true;
            }
            return $result;
        }

        public function edit(){
            $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()}  ";
            
            if($this->getImagen() != null){
                $sql .= ", imagen='{$this->getImagen()}'";
            }
            
            $sql .= " WHERE id={$this->id};";
            
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        

        public function delete(){
            $sql="DELETE FROM productos WHERE id={$this->id}";
            $delete=$this->db->query($sql);
            $result=false;
            if($delete){
                $result=true;
            }
            return $result;
        }

        public function getProductosByText($string){
            $sql="SELECT * FROM productos WHERE nombre LIKE '%$string%';";
            
            $buscar=$this->db->query($sql);
            
            return $buscar;
        }

        public function getLast(){
            $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC LIMIT 9;");
		    return $productos;
        }

        public function getTop($id){
            $sql="SELECT  pro.nombre, SUM(li.unidades) AS 'productos', SUM(li.unidades)*pro.precio AS 'ventas'
            FROM lineas_pedidos li 
            INNER JOIN pedidos pe ON li.pedido_id=pe.id 
            INNER JOIN productos pro ON pro.id=li.producto_id 
            WHERE pe.estado='sended' AND pe.vendedor_id=$id 
            GROUP BY li.producto_id
            ORDER BY productos DESC LIMIT 1";
            $top=$this->db->query($sql);
            return $top;
        }

        public function getProductsBySells($id){
            $sql="SELECT  pro.nombre, SUM(li.unidades) AS 'productos', SUM(li.unidades)*pro.precio AS 'ventas'
            FROM lineas_pedidos li 
            INNER JOIN pedidos pe ON li.pedido_id=pe.id 
            INNER JOIN productos pro ON pro.id=li.producto_id 
            WHERE pe.estado='sended' AND pe.vendedor_id=$id 
            GROUP BY li.producto_id";
            $productos=$this->db->query($sql);
            return $productos;
        }
    }

?>