<?php

    require_once 'models/categoria.php';
    require_once 'models/producto.php';

    class CategoriaController{
        public function index(){
            Utils::isAdmin();
            $categoria=new Categoria();
            $categorias=$categoria->getAll();
            require_once 'views/categoria/index.php';
        }
        public function crear(){
            Utils::isAdmin();
            require_once 'views/categoria/crear.php';
        }
        public function save(){
            Utils::isAdmin();
            if(isset($_POST)&& isset($_POST['nombre'])){

                $nombre=isset($_POST['nombre'])?$_POST['nombre']:false;

                $errores=array();

                if(!empty($nombre)&& !is_numeric($nombre)&&!preg_match("/[0-9]/",$nombre)){
                    $nombre_validate=true;
                }
                else{
                    $nombre_validate=false;
                    $errores['nombre']="El nombre no es valido";
                }

                if($nombre && count($errores)==0){
                    $categoria=new Categoria();
                    $categoria->setNombre($_POST['nombre']);
                    $save=$categoria->save();
                    if($save){
                        $_SESSION['categoria_save']="complete";
                        header("Location:".base_url."categoria/index");
                    }
                    else{
                        $_SESSION['categoria_save']="failed";
                        header("Location:".base_url."categoria/crear"); 
                    }
                }
                else{
                    $_SESSION['errores']=$errores;
                    $_SESSION['categoria_save']="failed";
                    header("Location:".base_url."categoria/crear"); 
                }  
                             
            }
            else{
                $_SESSION['categoria_save']="failed";
                header("Location:".base_url."categoria/crear"); 
            }            
        }
        public function ver(){
            if(isset($_GET)){
                $id=$_GET['id'];
                $categoria= new Categoria();
                $categoria->setId($id);
                $categoria=$categoria->getOne();

                $producto=new Producto();
                $producto->setCategoria_id($id);
                $productos=$producto->getAllCategory();
                
        
            }

            require_once 'views/categoria/ver.php';
        } 
    }
?>