<?php
ob_start();
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset ="utf-8">
        <title>Tienda Paruro</title>
        <link rel="icon" href="<?=base_url?>assets/img/favicon.png"/>
        <link rel="stylesheet" href="<?=base_url?>assets/styles/styles.css"/>
    </head>
    <body>
        <!--CABECERA-->
        <header id="header">
            <div id="logo">
                <a href="<?=base_url?>">
                    Paruro E-Commerce
                </a>
                <h2>
                    Compras seguras desde la comodidad de tu casa...
                </h2>
                <hr/>
            </div>
        </header>
        <!--MENU-->
        <nav id="menu">
            <ul class="menu_lista">
                <li class="menu_el">
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <li class="menu_barra">
                    <form class="busq" action="<?=base_url?>producto/buscar" method="POST">
                        <input class="busqBarra" type="text" name="buscar">
                        <input class="busqBoton" type="image" src="<?=base_url?>assets/img/lupa.png">
                    </form>                
                </li>


                <?php if(!isset($_SESSION['identity'])):?>
                <li class="menu_el">
                    <a href="<?=base_url?>usuario/login">Inicio de sesion</a>
                </li>
                <li class="menu_el">
                    <a href="<?=base_url?>usuario/registro">Registro</a>
                </li>
                <?php else: ?>
                    <li class="menu_el">
                        <a><?=$_SESSION['identity']->nombre.' '.$_SESSION['identity']->apellidos?></a>
                    </li>
                    <li class="menu_el" >
                        <a href="<?=base_url?>usuario/logout">Cerrar sesion</a>
                    </li>
                <?php endif;?>    

                <li class="menu_el">
                    <a href="<?=base_url?>usuario/contacto">Contacto</a>
                </li>
            </ul>
        </nav>
        <!--BARRA LATERAL-->

        <div id="content">