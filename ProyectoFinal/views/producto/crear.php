
<div id="registro">
    <?php if(isset($edit)&& isset($pro) && is_object($pro)):?>
        <h1>Editar producto:<br/> <?=$pro->nombre?></h1>
        <?php $action_url=base_url."producto/save&id=".$pro->id;?>
        <?php if($pro->usuario_id!=$_SESSION['identity']->id): header("Location: ".base_url."producto/gestion"); endif;?>
    <?php else:?>
        <h1>Crear nuevo producto</h1>
        <?php $action_url=base_url."producto/save";?>
    <?php endif;?>
    <hr/>

    

    <form action="<?=$action_url?>" method="POST" enctype="multipart/form-data">

        
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>
        
        <label for="precio">Precio</label>
        <input type="number" name="precio"  step="0.01" min="0.01" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>
        
        <label for="stock">Stock</label>
        <input type="number" name="stock"   min="1" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>
        
        <label for="categoria">Categoria</label>
        <?php $categorias=Utils::showCategorias();?>
        <select name="categoria">
            <?php while($cat=$categorias->fetch_object()):?>
                <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>>
                    <?=$cat->nombre?>
                </option>
            <?php endwhile;?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
			<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/> 
		<?php endif; ?>
        <input type="file" name="imagen"/>
        <input type="submit" value="Registrar producto"/>

    </form>
</div>