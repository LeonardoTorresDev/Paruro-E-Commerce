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
                        <a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>reporte/reporte" target="_blank" rel="noopener noreferrer">Descargar reporte</a>
                    </li>
                        <?php if ($_SESSION['identity']->rol=='root') :?>
                            <li>
                                <a href="<?=base_url?>usuario/registroadmin">Registrar administrador</a>
                            </li>
                        <?php endif;?>             
                    <?php else:?>
                    <?php $stats=Utils::statsCarrito();?>
                    <li>
                        <a href="<?=base_url?>carrito/index">Ver mi carrito</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>carrito/index">Productos: <?=$stats['count']?></a>
                    </li>
                    <li>
                        <a href="<?=base_url?>carrito/index">Total: S/.<?=$stats['total']?></a>
                    </li>
                    <li>
                        <a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a>
                    </li>
                    <?php endif;?>    
                </ul> 
            </div>
        <?php endif;?>
        
        <?php if(empty($_SESSION['identity'])):?>
            <div id="categorias">
                <h3>Mi carrito</h3>
                <ul>
                    
                    <?php $stats=Utils::statsCarrito();?>
                    <li>
                        <a href="<?=base_url?>carrito/index">Ver mi carrito</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>carrito/index">Productos: <?=$stats['count']?></a>
                    </li>
                    <li>
                        <a href="<?=base_url?>carrito/index">Total: S/.<?=$stats['total']?></a>
                    </li>
                    
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
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                <?php endwhile;?>    
            </ul>    
        
        </div>
        
    </aside>


    <!--Contendio principal-->
    <div id="central">