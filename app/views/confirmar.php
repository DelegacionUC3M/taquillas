
<div id='cuerpo'>
	<p class="error">
	<?php if (!empty($confirm)){
		print_r($confirm);
	} ?>
	</p>
	
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
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Confirmar reserva</button>
	</form>
	
</div>