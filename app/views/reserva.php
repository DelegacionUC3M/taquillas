<div id='cuerpo'>
	
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
	<form action='/taquillas/taquilla/reservar' method='post'>
		<ul id='formulario'>
			Campus:
			<li> <select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select></li>
			Edificio:
			<li><select id='edificio' name='edificio'></select></li>
			Planta: 
			<li><select id='planta' name='planta'></select></li>
			Zona: 
			<li><select id='zona' name='zona'></select></li>

			<li><div id='tipoTaquilla'></div></li>
			<div> Num. Taquilla (Opcional)
			<li><input name='num_taquilla' value=></div></li>
			<button id='reserva' type='submit' value='reserva' name='formulario'>Reservar taquilla</button>

	</form>
</div>