<div id="registro">
    <h1>Registro de Admin</h1>
    <hr/>

    <?php if(isset($_SESSION['identity']) && $_SESSION['identity']->rol=='root'):?>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
            <strong class="alert_green">Registro completado correctamente</strong>
        <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
            <strong class="alert_red">Registro fallido, introduzca bien los datos</strong>
        <?php endif; ?>
        

            <form action="saveAdmin" method="POST">
                <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'],'nombre'):'' ;?> 
                <label for="nombre">Compañia o razon social</label>
                <input type="text" name="nombre" placeholder="Ingrese su nombre" />
                <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'],'apellidos'):'';?>
                <label for="apellidos">Identificador</label>
                <input type="text" name="apellidos" placeholder="Ingreses su apellidos" />
                <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'],'email'):'';?>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Ingrese su email" />
                <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'],'password'):'';?>

                <label for="cuenta">Cuenta Bancaria (solo números)</label>
                <input type="text" name="cuenta" placeholder="XXXX-XXXX-XXXX-XXXX"/>
                
                <label for="password">Contraseña</label>       
                <input type="password" name="password" placeholder="Ingrese su contraseña" />
                <input type="submit" value="Registrar"/>
                <?php Utils::deleteSession('register'); ?>
                <?php Utils::deleteSession('errores'); ?>
            </form>
      
    <?php else: ?>
        <?php header("Location:".base_url);?>
    <?php endif;?>

   
</div>     