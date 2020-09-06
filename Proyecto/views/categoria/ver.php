<?php if (isset($categoria)): ?>
	<h1><?= $categoria->nombre ?></h1>
	<?php if ($productos->num_rows == 0): ?>
		<p>No hay productos para mostrar</p>
	<?php else: ?>
		<?php while ($product = $productos->fetch_object()): ?>
			<?php if($product->stock>0):?>
				<div class="product">
					<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
						<?php if ($product->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
						<?php endif; ?>	
						<h2><?= $product->nombre ?></h2>		
					</a>             
					<p>S/. <?= $product->precio ?></p>
					<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>" class="button">Comprar</a>
				</div>
			<?php else:?>
				<div class="product">
				<?php if ($product->imagen != null): ?>
					<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
				<?php endif; ?>	
					<br/>
					<h2><?= $product->nombre ?></h2><br/>
					<p>No hay stock disponible</p>
				</div>			
			<?php endif;?>		
		<?php endwhile; ?>
	<?php endif; ?>
<?php else: ?>
	<h1>La categoría no existe</h1>
<?php endif; ?>