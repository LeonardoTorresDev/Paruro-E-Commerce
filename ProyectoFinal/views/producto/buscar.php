<h1>Resultados para busqueda: <?=$_POST['buscar']?></h1>
    <?php if ($productos->num_rows == 0): ?>
		<p>No hay productos para mostrar</p>
	<?php else: ?>
    <?php while ($product = $productos->fetch_object()): ?>
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
        <?php endwhile; 
    endif;?>
