<div>
	<div id='cuerpo'>

		<?php if (!empty($confirm)){
			print_r($confirm);
		} ?>
		Nos imaginamos los datos bonitos y eso <br>

		<p> Nombre: <?php echo $_SESSION['user']->cn ?></p>
		<p> NIA: <?php echo $_SESSION['user']->uid ?></p>
		<p> Correo: <?php echo $_SESSION['user']->uid."@alumnos.uc3m.es"?></p>
		<p> Campus: <?php 
		if ($reserva->campus == 1){
			echo "Getafe";
		} else if ($reserva->campus == 2){
			echo "Leganés";
		} else {
			echo $reserva->campus;
		} ?></p>
		<p> Edificio: <?php echo $reserva->edificio ?></p>
		<p> Planta: <?php echo $reserva->planta ?></p>
		<p> Zona: <?php echo $reserva->zona ?></p>
		<p> Tipo: <?php echo $reserva->tipo ?></p>
		<p> Num. Taquilla: <?php echo $reserva->num_taquilla ?></p>
		<form action='/taquillas/taquilla/confirmar' method='post'>
					
			<input type='hidden' name='campus' value=<?php echo $reserva->campus?>>
			<input type='hidden' name='edificio' value=<?php echo $reserva->edificio?>>
			<input type='hidden' name='planta' value=<?php echo $reserva->planta?>>
			<input type='hidden' name='zona' value=<?php echo $reserva->zona?>>
			<input type='hidden' name='tipo' value=<?php echo $reserva->tipo?>>
			<input type='hidden' name='num_taquilla' value=<?php echo $reserva->num_taquilla?>>

			<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Confirmar reserva</button>
		</form>
		
	</div>
</div>