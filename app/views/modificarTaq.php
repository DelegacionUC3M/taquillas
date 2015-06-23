<div id='cuerpo'>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($datos)){ 
				if (!empty($cambio)) { ?>
					<p class="correcto"> <?php echo $cambio; ?> </p>
			<?php }  ?>
	<form action='?' method='post'>
		<ul id='formulario'>
			<b>Campus:</b> <li> <?php if ($datos->campus == 1){
								echo "Getafe";
							} else if ($datos->campus == 2){
								echo "Leganés";
							} else {
								echo $datos->campus;
							} ?> </li>
			<b>Edificio:</b> <li> <?php $nombre = new Taquilla;
							echo Taquilla::$nombreEdificios[$datos->campus][$datos->edificio]; ?></li>
			<b>Planta:</b> <li> <?php echo $datos->planta ?></li>
			<b>Zona:</b> <li> <?php echo $datos->zona ?></li>
			Núm. <b>Taquilla:</b> <li> <?php echo $datos->num_taquilla?></li>
			Tipo <b>Taquilla:</b> <li> <?php echo $datos->tipo ?></li>
			<b>Estado:</b> <li> <input type='number' min='1' max='4' name='estado' value=<?php if (!is_null($datos->estado)){ echo $datos->estado; } ?>> </li>
			<b>Dueño:</b> <li> <input name='user_id' value=<?php if (!is_null($datos->user_id)){ echo $datos->user_id; } ?>> </li>
			<b>Fecha:</b> <li> <input type='date' name='fecha' value=<?php if (!is_null($datos->fecha)){ echo $datos->fecha; } ?>> </li>

			<li> <button id='modificar' type="submit" value="gestion" name='gestion'> Modificar </button>
				<a href='/taquillas/admin/gestionTaq'> Atrás </a><li>
		</ul>
	</form>
	<?php } ?>
</div>