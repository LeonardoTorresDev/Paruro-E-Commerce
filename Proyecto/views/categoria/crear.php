<div id="registro">
    <h1>Crear nueva categoria</h1>
    <hr/>
    <?php if(isset($_SESSION['categoria_save']) && $_SESSION['categoria_save'] == 'failed'): ?>
            <strong class="alert_red">Registro fallido, introduzca bien los datos</strong>
    <?php endif; ?>
    <form action="<?=base_url?>categoria/save" method="POST">
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'],'nombre'):'' ;?> 
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre" placeholder="Ingrese el nombre de la categoria"/>
        <input type="submit" value="Guardar categoria"/>
        <?php Utils::deleteSession('categoria_save'); ?>
        <?php Utils::deleteSession('errores'); ?>
    </form> 
</div>    