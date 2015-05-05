<div>

	<?php if(isset($datos)){ ?>

		<form action='/taquillas/taquilla/gestion' method='post'>
					
			<input type='hidden' name='campus' value=<?php echo $reserva->campus?>> 
			<input type='hidden' name='edificio' value=<?php echo $reserva->edificio?>>
			<input type='hidden' name='planta' value=<?php echo $reserva->planta?>>
			<input type='hidden' name='zona' value=<?php echo $reserva->zona?>>
			<input type='hidden' name='tipo' value=<?php echo $reserva->tipo?>>
			<input type='hidden' name='num_taquilla' value=<?php echo $reserva->num_taquilla?>>

			<button id='modificar' type="submit" value="gestion" name='gestion'>Modificar</button>
		</form>
		Campus: <?php if ($datos->campus == 1){
							echo "Getafe";
						} else if ($datos->campus == 2){
							echo "Leganés";
						} else {
							echo $datos->campus;
						} ?><br>
		Edificio: <?php $nombre = new Taquilla;
						$nombre->rellenar();
						echo $nombre->nombreEdificios[$datos->campus][$datos->edificio]; ?><br>
		Planta: <?php echo $datos->planta ?><br>
		Zona: <?php echo $datos->zona ?><br>
		Núm. Taquilla: <?php echo $datos->num_taquilla?><br>
		Dueño: <?php echo $datos->user_id?><br>
		Fecha: <?php echo $datos->fecha ?><br>

	<?php } ?>
</div>