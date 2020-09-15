<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Reporte de ventas</title>
        <style type="text/css">
            body{
                font-family:Helvetica;
            }
        </style>
    </head>
    <body>
        <p>Paruro E-Commerce: Compras seguras desde la comodidad de su casa...</p>                                           
        <h1>Reporte de Paruro E-commerce</h1>
        <hr/>
        <p>Reporte generado el dia 14 de septiembre del año 2020</p>
        <p>Compañia o razon social: <?=$nombre?></p>
        <h2>Reporte de ventas totales</h2>
        <ul>
            <li>Ingresos: S/.<?=$ingresoTotal?></li>
            <li>Pedidos totales: <?=$numeroDePedidos?> </li>
            <li>Producto mas vendido: <?=$top?></li>
        </ul>
        <h2>Ventas por producto</h2>
        <?php while($prod=$productos->fetch_object()):?>
            <h3><?=$prod->nombre?></h3>
            <ul>
                <li>Numero de unidades vendidas: <?=$prod->productos?></li>
                <li>Ganancias brutas: <?=$prod->ventas?></li>
            </ul>
        <?php endwhile;?>       
    </body>
</html>
