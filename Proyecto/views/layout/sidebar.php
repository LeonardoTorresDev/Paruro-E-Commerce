<aside id="lateral">
    <?php if(isset($_SESSION['identity'])):?>
        <div id="login" class="block-aside">
            <h3>Bienvenido, <?=$_SESSION['identity']->nombre.' '.$_SESSION['identity']->apellidos?></h3>
            <ul>
               
                
                <?php if(isset($_SESSION['admin'])):?>
                <li>
                    <a href="">Gestionar categorias</a>
                </li>
                <li>
                    <a href="">Gestionar catalogo</a>
                </li>
                <li>
                    <a href="">Gestionar pedidos</a>
                </li>
                <li>
                    <a href="">Registrar otro admin</a>
                </li>
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
            <li>
                <a href="">Electronica</a> 
            </li>
            <li>
                <a href="">Mecanica-electrica</a>
            </li>
        </ul>    
    
    </div>
    
</aside>

<!--Contendio principal-->
<div id="central">