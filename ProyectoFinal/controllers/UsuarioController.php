<?php
    require_once 'models/usuario.php';
    class UsuarioController{
        public function index(){
            echo "Controlador usuario, Accion index";
        }
        public function registro(){
            require_once 'views/usuario/registro.php';
        }
        public function registroAdmin(){
            require_once 'views/usuario/registroadmin.php';
        }
        public function save(){
            if(isset($_POST)){

               $nombre=isset($_POST['nombre'])?$_POST['nombre']:false;
               $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:false;
               $email=isset($_POST['email'])?$_POST['email']:false;
               $password=isset($_POST['password'])?$_POST['password']:false;  
               
                //Array de errores
                $errores=array();
                
                // Validar los datos
                if(!empty($nombre)&& !is_numeric($nombre)&&!preg_match("/[0-9]/",$nombre)){
                    $nombre_validate=true;
                }
                else{
                    $nombre_validate=false;
                    $errores['nombre']="El nombre no es valido";
                }
            
                //Validar apellido
                if(!empty($apellidos)&& !is_numeric($apellidos)&&!preg_match("/[0-9]/",$apellidos)){
                    $apellido_validate=true;
                }
                else{
                    $apellido_validate=false;
                    $errores['apellidos']="El apellido no es valido";
                }
                //Validar email
                if(!empty($email)&&filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $email_validate=true;
                }
                else{
                    $email_validate=false;
                    $errores['email']="El email no es valido";
                }
                //Validar contraseña
                if(!empty($password)){
                    $password_validate=true;
                }
                else{
                    $password_validate=false;
                    $errores['password']="La contraseña esta vacia";
                }

               if($nombre && $apellidos && $email && $password && count($errores)==0){

                   $usuario=new Usuario();
                   $usuario->setNombre($nombre);
                   $usuario->setApellidos($apellidos);
                   $usuario->setEmail($email);
                   $usuario->setPassword($password);
                   $save=$usuario->save();

                   if($save){
                       $_SESSION['register']="complete";
                   }
                   else{
                       $_SESSION['register']="failed";
                   }
               }
               else{
                    $_SESSION['errores']=$errores;
                    $_SESSION['register']="failed";
               }          
            }
            else{
                
                $_SESSION['register']="failed";
            }
            header("Location:".base_url.'usuario/registro');
        }


        public function saveAdmin(){
            if(isset($_POST)){

               $nombre=isset($_POST['nombre'])?$_POST['nombre']:false;
               $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:false;
               $email=isset($_POST['email'])?$_POST['email']:false;
               $cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:false; 
               $password=isset($_POST['password'])?$_POST['password']:false;  
               
                //Array de errores
                $errores=array();
                
                // Validar los datos
                if(!empty($nombre)&& !is_numeric($nombre)&&!preg_match("/[0-9]/",$nombre)){
                    $nombre_validate=true;
                }
                else{
                    $nombre_validate=false;
                    $errores['nombre']="El nombre no es valido";
                }
            
                //Validar apellido
                if(!empty($apellidos)&& !is_numeric($apellidos)&&!preg_match("/[0-9]/",$apellidos)){
                    $apellido_validate=true;
                }
                else{
                    $apellido_validate=false;
                    $errores['apellidos']="El apellido no es valido";
                }
                //Validar email
                if(!empty($email)&&filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $email_validate=true;
                }
                else{
                    $email_validate=false;
                    $errores['email']="El email no es valido";
                }
                //Validar cuenta
                if(!empty($cuenta)&& preg_match("/[0-9]/",$cuenta)){
                    $cuenta_validate=true;
                }
                else{
                    $cuenta_validate=false;
                    $errores['cuenta']="La cuenta bancaria no es valida";
                }

                //Validar contraseña
                if(!empty($password)){
                    $password_validate=true;
                }
                else{
                    $password_validate=false;
                    $errores['password']="La contraseña esta vacia";
                }

               if($nombre && $apellidos && $email && $password && $cuenta && count($errores)==0){

                   $usuario=new Usuario();
                   $usuario->setNombre($nombre);
                   $usuario->setApellidos($apellidos);
                   $usuario->setEmail($email);
                   $usuario->setPassword($password);
                   $usuario->setCuenta($cuenta);
                   $save=$usuario->saveAdmin();

                   if($save){
                       $_SESSION['register']="complete";
                   }
                   else{
                       $_SESSION['register']="failed";
                   }
               }
               else{
                    $_SESSION['errores']=$errores;
                    $_SESSION['register']="failed";
               }          
            }
            else{
                
                $_SESSION['register']="failed";
            }
            header("Location:".base_url.'usuario/registroadmin');
        }


        public function login(){
            require_once 'views/usuario/login.php';
        }
       

        public function inicioSesion(){

            if(isset($_POST)){
                
                //Identificar al usuario
                $usuario=new Usuario();
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);

                $identity=$usuario->login();
                
                if($identity && is_object($identity)){
                    $_SESSION['identity']=$identity;

                    if($identity->rol=='admin'){
                        $_SESSION['admin']=true;
                    }
                    header("Location:".base_url);
        
                }else{
                    $_SESSION['error_login']="Identificacion fallida";
                    header("Location: ".base_url.'usuario/login');
                }

            }
            
        }

        public function logout(){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            if(isset($_SESSION['carrito'])){
                unset($_SESSION['carrito']);
            }
            header("Location:".base_url);
            ob_end_flush();
        }
        public function  contacto(){
            require_once 'views/contacto/index.php';
        }
    }
?>