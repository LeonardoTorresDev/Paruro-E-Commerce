    
    <div id="registro">
        <h1>Inicio de sesion</h1>
        <hr/>
        <?php if(isset($_SESSION['error_login'])):?>
            <strong class="alert_red">Inicio de sesion fallido, verifique que sus datos sean los correctos</strong>
        <?php endif;?>    

        <form action="inicioSesion" method="POST">
            <label for="email">Ingrese su email</label>
            <input type="email" name="email" placeholder="Email"/>
            <label for="password">Ingrese su contraseña</label>
            <input type="password" name="password" placeholder="Contraseña"/>
            <input type="submit" value="Iniciar sesion">
        </form>
        <?php Utils::deleteSession('error_login'); ?>
    </div>     
