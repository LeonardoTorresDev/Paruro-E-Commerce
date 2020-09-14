<h1>Carrito de la compra</h1>
    <?php if(isset($_SESSION['vacio'])):?> 
       <p> <strong class="alert_red">El carrito esta vacio </strong></p><br/>
    <?php endif;?>
    <?php Utils::deleteSession('vacio');?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
        <?php if(isset($_SESSION['carrito'])):?>
            </tr>
            <?php foreach($carrito as $indice=>$elemento):
                $producto=$elemento['producto'];
                if($elemento['unidades']>$producto->stock){
                    $elemento['unidades']=$producto->stock;
                }
            ?>
            <tr>             
                <td>
                    <?php if ($producto->imagen != null): ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="imageCarrito"/>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>" class="linkTabla"><?=$producto->nombre?></a>
                </td>
                <td><?=$producto->precio?></td>
                <td><?=$elemento['unidades']?></td>  
                <td>
                    <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-delete">Quitar producto</a>
                </td>                           
            </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td>------</td>
                <td>------</td>
                <td>------</td>
                <td>------</td>
            </tr>     
        <?php endif;?>
        
</table>
<?php $stats=Utils::statsCarrito();?>
<div id="compraCarrito">
    <h2>Numero de productos: <?=$stats['count']?></h2>
    <h2>Importe total: <?=$stats['total']?></h2>
    <a href="<?=base_url?>pedido/hacer" class="button button-small">Hacer pedido</a>
    <a href="<?=base_url?>carrito/delete_all" class="button button-small button-delete">Vaciar carrito</a>
</div>
