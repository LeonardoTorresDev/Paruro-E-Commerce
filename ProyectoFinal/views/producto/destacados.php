<h1 class="titulo">Ultimas novedades</h1>   

<?php while($product = $productos->fetch_object()): ?>
    <?php if($product->stock!=0):?>
        <div class="product">     
            <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                <?php if($product->imagen != null): ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
                <?php else: ?>
                    <img src="<?=base_url?>assets/img/camiseta.png" />
                <?php endif; ?>
                <h2><?=$product->nombre?></h2>
            </a>
            <p>S/. <?=$product->precio?></p>
            <a href="<?=base_url?>producto/ver&id=<?=$product->id?>" class="button">Comprar</a>    
    </div>
    <?php endif;?>
<?php endwhile; ?>
 
   
   

