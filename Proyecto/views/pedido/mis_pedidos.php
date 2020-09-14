
<?php if (isset($gestion)): ?>
	<h1>Gestionar pedidos</h1>
<?php else: ?>
	<h1>Mis pedidos</h1>
<?php endif; ?>
<?php if(isset($_SESSION['pedido'])&& $_SESSION['pedido']=='complete'):?>
    <strong class="alert_green">El pedido ha sido realizado correctamente</strong><br/>
<?php elseif(isset($_SESSION['pedido'])&& $_SESSION['pedido']=='failed'):?>
    <strong class="alert_red">El pedido no se ha podido realizar</strong><br/>
<?php endif;?>
<?php Utils::deleteSession('pedido');?>
<table>
	<tr>
		<th>Nº Pedido</th>
		<th>Coste</th>
		<th>Fecha</th>
		<th>Estado</th>
	</tr>
	<?php
	while ($ped = $pedidos->fetch_object()):
		?>

		<tr>
			<td>
				<a href="<?= base_url ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
			</td>
			<td>
				S/. <?= $ped->coste ?> 
			</td>
			<td>
				<?= $ped->fecha ?>
            </td>
            <td>
				<?=Utils::showStatus($ped->estado)?>
			</td>
			
		</tr>

	<?php endwhile; ?>
</table>