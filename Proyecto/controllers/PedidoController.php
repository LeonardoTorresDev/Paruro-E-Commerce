<?php
    require_once 'models/pedido.php';
    require_once 'models/usuario.php';
    class PedidoController{
        
        public function hacer(){
            Utils::isNotAdmin();

            require_once "views/pedido/hacer.php";
        }
        public function add(){
            if(isset($_SESSION['identity'])&& isset($_SESSION['carrito'])){
       
                $usuario_id = $_SESSION['identity']->id;
			    $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			    $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

                $arrayVendedores=array();
                $costeParcial=array();

                for($i=0;$i<count($_SESSION['carrito']);$i++){
                    array_push($arrayVendedores,$_SESSION['carrito'][$i]['producto']->usuario_id);
                }  
                
                $sinRepetir = array_map("unserialize", array_unique(array_map("serialize", $arrayVendedores)));

                for($i=0;$i<count($sinRepetir);$i++){
                    $costeParcial[$i]=0;
                    foreach($_SESSION['carrito'] as $indice=>$elemento){
                       if($elemento['producto']->usuario_id==$sinRepetir[$i]){     
                           $costeParcial[$i]+=$elemento['precio']*$elemento['unidades'];                       
                        }
                    }
                }
     
                if($provincia && $localidad && $direccion){
                    //Guardar datos en bd
                    $pedido=new Pedido();
                    $pedido->setUsuario_id($usuario_id);
                    $pedido->setProvincia($provincia);
                    $pedido->setLocalidad($localidad);
                    $pedido->setDireccion($direccion);
                    
                    $pedido->setEstado('Confirm');
                    for($i=0;$i<count($sinRepetir);$i++){
                      
                        $pedido->setVendedor_id($sinRepetir[$i]);
                        $pedido->setCoste($costeParcial[$i]);
                        $save=$pedido->save();
                        $save_linea=$pedido->save_linea($sinRepetir[$i]);
                       
                        if($save && $save_linea){
                            $_SESSION['pedido'] = "complete";
                        }else{
                            $_SESSION['pedido'] = "failed";                     
                            header("Location:".base_url);
                        }
                    } 
                    
                                  
                }else{
                    $_SESSION['pedido'] = "failed";
                    header("Location:".base_url);
                }
                if(isset($_SESSION['carrito'])){
                    unset($_SESSION['carrito']);//A futuro va a cambiar de posicion
                }
                $_SESSION['numeroPedidos']=count($sinRepetir);
                header("Location:".base_url.'pedido/mis_pedidos');	       
            }
            else{
                header("Location:".base_url);
            }
        }

        public function confirmado(){
               
            require_once "views/pedido/confirmado.php";
        }

        public function mis_pedidos(){
            Utils::isUser();
            $usuario_id=$_SESSION['identity']->id;
            $pedido=new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos=$pedido->getAllByUser();
            require_once "views/pedido/mis_pedidos.php";
        }

        public function detalle(){
            Utils::isLoged();
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                // Sacar el pedido
                $pedido = new Pedido();
                $pedido->setId($id);
                
                $pedido = $pedido->getOne();
                $vendedor=$pedido->vendedor_id;
                
                
                // Sacar los poductos
                $pedido_productos = new Pedido();
                $productos = $pedido_productos->getProductosByPedido($id);

                //Sacar el numero de cuenta
                $usuario=new Usuario();
                $cuenta=$usuario->cuentaByVendor($vendedor);
              
                
                require_once 'views/pedido/detalle.php';
            }else{
                header('Location:'.base_url.'pedido/mis_pedidos');
            }       
        }

        public function gestion(){
            Utils::isAdmin();
            $gestion = true;
            $usuario_id=$_SESSION['identity']->id;
            $pedido=new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos=$pedido->getAllByVendor();

            require_once 'views/pedido/mis_pedidos.php';
        }

        public function estado(){
            Utils::isAdmin();
            if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
                // Recoger datos form
                $id = $_POST['pedido_id'];
                $estado = $_POST['estado'];
                
                // Upadate del pedido
                $pedido = new Pedido();
                $pedido->setId($id);
                $pedido->setEstado($estado);
                $pedido->edit();
                
                header("Location:".base_url.'pedido/mis_pedidos');
            }else{
                header("Location:".base_url);
            }
        }
    }
?>