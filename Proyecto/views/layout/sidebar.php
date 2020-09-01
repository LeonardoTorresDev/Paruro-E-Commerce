<div id="content" class="contenido">
    <aside id="lateral">
        <?php if(isset($_SESSION['identity'])):?>
            <div id="login" class="block-aside">
                <h3>Bienvenido, <?=$_SESSION['identity']->nombre.' '.$_SESSION['identity']->apellidos?></h3>
                <ul>
                
                    
                    <?php if(isset($_SESSION['admin'])||$_SESSION['identity']->rol=='root'):?>
                    <li>
                        <a href="<?=base_url?>categoria/index">Gestionar categorias</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>producto/gestion">Gestionar productos</a>
                    </li>
                    <li>
                        <a href="">Gestionar pedidos</a>
                    </li>
                        <?php if ($_SESSION['identity']->rol=='root') :?>
                            <li>
                                <a href="<?=base_url?>usuario/registroadmin">Registrar otro admin</a>
                            </li>
                        <?php endif;?>             
                    <?php else:?>
                    <li>
                        <a href="#">Mis pedidos</a>
                    </li>
                    <li>
                        <a href="#">Mi carrito</a>
                    </li>
                    <?php endif;?>    
                </ul> 
            </div>
        <?php endif;?>
        <div id="categorias">
            <h3>
                Categorias
            </h3> 
            <ul>
                <?php $categorias= Utils::showCategorias()?>
                <?php while($cat=$categorias->fetch_object()):?>
                    <li>
                        <a href=""><?=$cat->nombre?></a>
                    </li>
                <?php endwhile;?>    
            </ul>    
        
        </div>
        
    </aside>


    <!--Contendio principal-->
    <div id="central">