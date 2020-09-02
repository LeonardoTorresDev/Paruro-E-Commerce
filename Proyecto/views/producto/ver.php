<?php if (isset($product)): ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
           
            <p class="description"> <?= $product->descripcion ?></p>
            <p class="price">Proveedor:
                <?=$vendedor->nombre.' '.$vendedor->apellidos;?> 
            </p>
            <p class="price">Precio: S/.<?= $product->precio ?></p>
            <p class="price">Stock:
                <?php if ($product->stock!=0):?>
                    <?=$product->stock?> unidades
                <?php else:?>
                    Producto no disponible
                <?php endif;?>
            </p>
            <?php if($product->oferta=='SI'):?>
                <p class="oferta">Producto en oferta</p>
            <?php endif;?>
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
		</div>
	</div>
<?php else:?>
	<h1>El producto no existe</h1>
<?php endif;?>
