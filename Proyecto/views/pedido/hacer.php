<?php if(isset($_SESSION['carrito'])):?>
    
    <?php if(isset($_SESSION['identity']) ):?>
        
        <div id="registro">
            <h1>Hacer pedido</h1>
            <hr/>
            <a href="<?=base_url?>carrito/index">Ver los productos y el precio del pedido</a><br/><br/>
            <form action="<?=base_url?>pedido/add" method="POST">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" required/>
                <label for="localidad">Localidad</label>
                <input type="text" name="localidad" required/>
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" required/>
                <input type="submit" value="Realizar pedido"/>
            </form>
        </div> 

    <?php else:?>
        <h1>Necesitas estar identificado</h1>
        <p>Necesitas estar logueado en esta web para poder realizar tu pedido</p>
        <a href="<?=base_url?>usuario/login">Login</a>
    <?php  endif;?>
<?php else:?>
    <?php
        $_SESSION['vacio']="error";
        var_dump($_SESSION['vacio']);
        
        header("Location:".base_url.'carrito/index');
    ?>
<?php endif;?>
