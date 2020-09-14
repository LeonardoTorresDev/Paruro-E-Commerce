<?php
    class Utils{
        public static function deleteSession($name){
            if(isset($_SESSION[$name])){
                $_SESSION[$name]=null;
                unset ($_SESSION[$name]);
            }
            return $name;
        }
        public static function mostrarError($errores,$campo){
            $alerta='';
            if(isset($errores[$campo])&&!empty($campo)){
                $alerta="<strong class='alert_red'>".$errores[$campo].'</strong>';
            }
            return $alerta;
        }
        public static function isAdmin(){
            if(!empty($_SESSION)){
                if( isset($_SESSION['identity']) && (isset($_SESSION['admin']) || ($_SESSION['identity']->rol=='root'))){
                    return true;
                }
                else{
                    header("Location: ".base_url);
                }
            }
            else{
                header("Location: ".base_url);
            }
        }

        public static function isNotAdmin(){
            if(!isset($_SESSION['identity'])){
                return true;
            }else{
              if(isset($_SESSION['admin'])||$_SESSION['identity']->rol=='root'){
                header("Location:".base_url);
              }else{
                  return true;
              }
            }
        }

        public static function isUser(){
            if(isset($_SESSION['identity'])){
                if( isset($_SESSION['admin'])|| $_SESSION['identity']->rol=='root'){
                    header("Location:".base_url);
                }else{
                    return true;
                }
            }
            else{
                header("Location:".base_url);
            }
        }

        public static function isLoged(){
            if(isset($_SESSION['identity'])){
                return true;
            }
            else{
                header("Location:".base_url);
            }
        }

        public static function showCategorias(){
            require_once 'models/categoria.php';
            $categoria= new Categoria();
            $categorias=$categoria->getAll();
            return $categorias;
        }

        public static function statsCarrito(){
            $stats=array(
                'count'=>0,
                'total'=>0
            );
            if(isset($_SESSION['carrito'])){
                              
                foreach($_SESSION['carrito'] as $indice=>$elemento){
                    $stats['count']+=$elemento['unidades'];
                    $stats['total']+=$elemento['unidades']*$elemento['precio'];
                }
                
            }
            
            return $stats;
        }

        public static function showStatus($status){
            $value = 'Pendiente';
            
            if($status == 'Confirm'){
                $value = 'Pendiente';
            }elseif($status == 'preparation'){
                $value = 'En preparación';
            }elseif($status == 'ready'){
                $value = 'Preparado para enviar';
            }elseif($status = 'sended'){
                $value = 'Enviado';
            }
            
            return $value;
        }

    }
    
?>