<?php
    require_once 'models/producto.php';
    class CarritoController{
        
        public function index(){
            Utils::isNotAdmin();
            if(isset($_SESSION['carrito'])){
                $carrito=$_SESSION['carrito'];
            }
            
           
            require_once 'views/carrito/index.php';
        }
        public function add(){

            if(isset($_GET['id'])&& isset($_POST['cantidad'])){
                $cantidad=$_POST['cantidad'];
                $producto_id=$_GET['id'];
            }else{
                header("Location: ".base_url);
            }    

            if(isset($_SESSION['carrito'])){
                $contador=0;
                foreach($_SESSION['carrito'] as $indice=>$elemento){
                    if($elemento['id_producto']==$producto_id){
                        $_SESSION['carrito'][$indice]['unidades']+=$cantidad;
                        $contador++;
                    }
                }
            }

            if(!isset($contador)||$contador==0){
                //Conseguir producto
                $producto=new Producto();
                $producto->setId($producto_id);
                $producto=$producto->getOne();

                if(is_object($producto)){
                    $_SESSION['carrito'][]=array(
                        "id_producto"=>$producto->id,
                        "precio"=>$producto->precio,
                        "unidades"=>$cantidad,
                        "producto"=>$producto
                    );
                }
            }
                 
            header("Location:".base_url."carrito/index");
            
        }

        public function delete(){
            if(isset($_GET['index'])){
                $index = $_GET['index'];
                unset($_SESSION['carrito'][$index]);
            }
            header("Location:".base_url."carrito/index");
        }
        public function delete_all(){
            unset($_SESSION['carrito']);
            header("Location:".base_url."carrito/index");
        }
    }
?>