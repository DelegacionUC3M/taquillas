<div id='cuerpo'>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($datos)){ 
				if (!empty($cambio)) { ?>
					<p class="correcto"> <?php echo $cambio; ?> </p>
			<?php }  ?>
	<form action='?' method='post'>
		<ul id='formulario'>
			Campus: <li> <?php if ($datos->campus == 1){
								echo "Getafe";
							} else if ($datos->campus == 2){
								echo "Leganés";
							} else {
								echo $datos->campus;
							} ?> </li>
			Edificio: <li> <?php $nombre = new Taquilla;
							echo Taquilla::$nombreEdificios[$datos->campus][$datos->edificio]; ?></li>
			Planta: <li> <?php echo $datos->planta ?></li>
			Zona: <li> <?php echo $datos->zona ?></li>
			Núm. Taquilla: <li> <?php echo $datos->num_taquilla?></li>
			Tipo: <li> <?php echo $datos->tipo ?></li>
			Estado: <li> <input type='number' min='1' max='4' name='estado' value=<?php if (!is_null($datos->estado)){ echo $datos->estado; } ?>> </li>
			Dueño: <li> <input name='user_id' value=<?php if (!is_null($datos->user_id)){ echo $datos->user_id; } ?>> </li>
			Fecha: <li> <input type='date' name='fecha' value=<?php if (!is_null($datos->fecha)){ echo $datos->fecha; } ?>> </li>

			<li> <button id='modificar' type="submit" value="gestion" name='gestion'> Modificar </button>
				<a href='/taquillas/admin/gestionTaq'> Atrás </a><li>
		</ul>
	</form>
	<?php } ?>
</div>