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
                <?php if ($product->stock>0):?>
                    <?=$product->stock?> unidades</p>
                    <form  action="<?=base_url?>carrito/add&id=<?=$product->id?>" method="POST">
                    <label for="cantidad" class="price">Cantidad</label>
                    <input type="number" class="ventas" name="cantidad" value="1" min="1" max="<?=$product->stock?>" required/>
                    <input type="submit" value="Comprar" class="button-ventas"/>
                    </form>
                <?php else:?>
                    Producto no disponible</p>
                <?php endif;?>        
		</div>
	</div>
<?php else:?>
	<h1>El producto no existe</h1>
<?php endif;?>
