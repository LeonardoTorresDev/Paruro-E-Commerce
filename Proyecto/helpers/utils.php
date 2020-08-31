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
    }
    
?>