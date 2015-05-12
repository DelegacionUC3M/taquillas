
<div id='cuerpo'>
	<p class="error">
	<?php if (!empty($confirm)){
		print_r($confirm);
	}
		if (!empty($error)){
			print_r($error);
		}  
	?>
	</p>
	Nos imaginamos los datos bonitos y eso <br>

	<p> Nombre: <?php echo $reserva->user_id ?></p>
	<p> NIA: <?php echo $reserva->user_id ?></p>
	<p> Correo: <?php echo $reserva->user_id."@alumnos.uc3m.es"?></p>
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
	<p> Estado: <?php echo $reserva->estado ?></p>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Asignar </button>
	</form>
	<form action='/taquillas/admin/cobrar/<?php echo $reserva->id ?>' method='post'>
		<input type='hidden' name='user_id' value=<?php echo $reserva->user_id?>>
		<button id='cobrar' type="submit" value="cobrar" name='cobrar'>Asignar y Cobrar</button>
	</form>
	
</div>
