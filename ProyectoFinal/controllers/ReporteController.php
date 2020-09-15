<?php
    require './vendor/autoload.php';
    require_once 'models/pedido.php';
    require_once 'models/producto.php';
    
    use Spipu\Html2Pdf\Html2Pdf;
    class ReporteController{
        public function index(){
            require_once 'views/reporte/index.php';
        }
        public function reporte(){
            Utils::isAdmin();

            //Obtenemos el nombre del vendedor y lo enviamos al reporte
            $vendedor_id=$_SESSION['identity']->id;
            $nombre=$_SESSION['identity']->nombre.' '.$_SESSION['identity']->apellidos;

            //Obtenemmos los costos (asi como el numero de columnas) y los enviamos al reporte
            $pedidos=new Pedido();
            $pedidos=$pedidos->getRows($vendedor_id);
            $numeroDePedidos=$pedidos->num_rows;
            $ingresoTotal=0;
            while($fetch=$pedidos->fetch_object()){
                $ingresoTotal+=(float)$fetch->coste;          
            }

            $producto=new Producto();
            //Obtenemos los productos (numero de unidades vendidas y ganancias obtenidas de ese producto)
            $productos=$producto->getProductsBySells($vendedor_id);
            
            //Obtenemos el producto mas vendido
            $top=$producto->getTop($vendedor_id);
            $top=$top->fetch_object()->nombre;
            
            
            //die();
            $html2pdf=new Html2Pdf();
            $numero=12;
            ob_start();
            require './template/template.php';
            $html=ob_get_clean();
            ob_end_clean();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        }
        
    }   
?>