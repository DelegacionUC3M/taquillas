	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($datos)){ 
				if (!empty($cambio)) { ?>
					<p class="correcto"> <?php echo $cambio; ?> </p>
			<?php }  ?>
	<form action='?' method='post'>
		<ul class='formulario'>
			<li> <b>Campus: </b> 
			 <?php if ($datos->campus == 1){
							echo "Getafe";
						} else if ($datos->campus == 2){
							echo "Leganés";
						} else {
							echo $datos->campus;
						} ?> 
			</li>
			<li> <b>Edificio: </b><?php $nombre = new Taquilla;
							echo Taquilla::$nombreEdificios[$datos->campus][$datos->edificio]; ?></li>
			<li> <b>Planta: </b><?php echo $datos->planta ?></li>
			<li> <b>Zona: </b><?php echo $datos->zona ?></li>
			<li> <b>Núm. Taquilla: </b><?php echo $datos->num_taquilla?></li>
			<li> <b>Tipo Taquilla: </b><?php echo $datos->tipo ?></li>
			<li> <b>Estado: </b><input type='number' min='1' max='4' name='estado' value=<?php if (!is_null($datos->estado)){ echo $datos->estado; } ?>> </li>
			<li> <b>Dueño: </b><input name='user_id' value=<?php if (!is_null($datos->user_id)){ echo $datos->user_id; } ?>> </li>
			<li> <b>Fecha: </b><input type='date' name='fecha' value=<?php if (!is_null($datos->fecha)){ echo $datos->fecha; } ?>> </li>

			<li id='buttons'> <button class='confirmar' type="submit" value="gestion" name='gestion'> Modificar </button>
				<a href='/taquillas/taquilla/panel'><button class='confirmar' type='button'>Atrás</button></a></li>
		</ul>
	</form>
			<?php } ?>