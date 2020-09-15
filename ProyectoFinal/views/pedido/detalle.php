<h1>Detalle del pedido</h1>

<?php if (isset($pedido)): ?>
	<?php if(isset($_SESSION['admin'])||$_SESSION['identity']->rol=="root"): ?>
		<?php if($_SESSION['identity']->id==$pedido->vendedor_id):?>
			<h3>Cambiar estado del pedido</h3>
			<form action="<?=base_url?>pedido/estado" method="POST">
				<input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
				<select name="estado">
					<option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" />
			</form>
			<br/>
		<?php else: header("Location: ".base_url."pedido/mis_pedidos");?>
		<?php endif;?>
	<?php else:?>
		<h3>Detalle de pago</h3>
		<?php if($pedido->estado=="Confirm"):?>
			<p>Realice una transaccion a la siguiente cuenta bancaria para el envio de su producto: <?=$cuenta->cuenta?> </p><br/>
		<?php else:?>
			<p>Su pedido ha sido procesado con exito, este atento a las notificaciones</p><br/>
		<?php endif;?>
	<?php endif; ?>

	<h3>Dirección de envio</h3>
	<p>
		Provincia: <?= $pedido->provincia ?>   <br/>
		Cuidad: <?= $pedido->localidad ?> <br/>
		Direccion: <?= $pedido->direccion ?>   <br/><br/>
	</p>
	<h3>Datos del pedido:</h3>
	<p>
		Estado: <?=Utils::showStatus($pedido->estado)?> <br/>
		Número de pedido: <?= $pedido->id ?>   <br/>
		
		Productos:
	</p>
	<br/><br/>
	<table>
		<tr>
			<th>Imagen</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Unidades</th>
		</tr>
		<?php while ($producto = $productos->fetch_object()): ?>
			<tr>
				<td>
					<?php if ($producto->imagen != null): ?>
						<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="imagePedidos"/>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
				</td>
				<td>
					<?= $producto->precio ?>
				</td>
				<td>
					<?= $producto->unidades ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php endif; ?>
<div id="compraCarrito">
	<h2>Total a pagar: S/. <?= $pedido->coste ?>  <br/></h2>
</div>
