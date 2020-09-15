<?php
  
    class Usuario{
        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $password;
        private $rol;
        private $imagen;
        private $cuenta;
        private $db;

        public function __construct()
        {
            $this->db=Database::connect();
        }

        function getId(){
            return $this->id;
        }
        function setId($id){
            $this->id=$id;
        }
        function getNombre(){
            return $this->nombre;
        }
        function setNombre($nombre){
            $this->nombre=$this->db->real_escape_string($nombre);
        }
        function getApellidos(){
            return $this->apellidos;
        }
        function setApellidos($apellidos){
            $this->apellidos=$this->db->real_escape_string($apellidos);
        }
        function getEmail(){
            return $this->email;
        }
        function setEmail($email){
            $this->email=$this->db->real_escape_string($email);
        }
        function getPassword(){
            return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
        }
        function setPassword($password){
            $this->password = $password;
        }
        function getRol(){
            return $this->rol;
        }
        function setRol($rol){
            $this->rol=$rol;
        }
        function getCuenta(){
            return $this->cuenta;
        }
        function setCuenta($cuenta){
            $this->cuenta=$cuenta;
        }
        function getImagen(){
            return $this->imagen;
        }
        function setImagen($imagen){
            $this->imagen=$imagen;
        }

        public function save(){
            $sql="INSERT INTO usuarios VALUES (NULL, '{$this->getNombre()}' , '{$this->getApellidos()}' , '{$this->getEmail()}' , '{$this->getPassword()}','user', NULL,NULL);";
            $save=$this->db->query($sql);
            $result=false;
            if($save){
                $result=true;
            }
            return $result;
        }

        public function saveAdmin(){
            $sql="INSERT INTO usuarios VALUES (NULL, '{$this->getNombre()}' , '{$this->getApellidos()}' , '{$this->getEmail()}' , '{$this->getPassword()}','admin',NULL,'{$this->getCuenta()}');";
            $save=$this->db->query($sql);
            $result=false;
            if($save){
                $result=true;
            }
            return $result;
        }
        
        public function login(){
            //Comprobar si existe el usuario
            $result=false;
            $email=$this->email;
            $password=$this->password;

            $sql="SELECT * FROM usuarios WHERE email='$email';";
            $login=$this->db->query($sql);

            if($login && $login->num_rows==1){
                $usuario=$login->fetch_object();
                $verify=password_verify($password,$usuario->password);
                if($verify){
                    $result=$usuario;
                }
            }
            return $result;
        }

        public function cuentaByVendor($vendedor_id){
            $sql="SELECT cuenta FROM usuarios WHERE id=$vendedor_id";
            $cuenta=$this->db->query($sql);
            return $cuenta->fetch_object();
        }
        
    }
?>