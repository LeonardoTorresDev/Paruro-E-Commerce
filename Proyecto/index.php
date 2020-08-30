<?php
    require_once 'autoload.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/sidebar.php';
    if(isset($_GET['controller'])){
        $nombre_controlador=$_GET['controller'].'Controller';
    }else{
        echo "El controlador que buscas no existe";
        exit();
    }

    if(class_exists($nombre_controlador)){
        $controlador=new $nombre_controlador();
        if(isset($_GET['action'] )&& method_exists($controlador,$_GET['action'])){
            $action=$_GET['action'];
            $controlador->$action();
        }else{
            echo "El método que buscas no existe";
        }
    }else{
        echo "La clase que buscas no existe";
    }
    require_once 'views/layout/footer.php';
?>