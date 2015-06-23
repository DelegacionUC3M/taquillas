<div id='cuerpo'>
	
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
	<form action='/taquillas/taquilla/reservar' method='post'>
		<ul id='formulario'>
			<b>Campus:</b>
			<li> <select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select></li>
			<b>Edificio:</b>
			<li><select id='edificio' name='edificio'></select></li>
			<b>Planta:</b> 
			<li><select id='planta' name='planta'></select></li>
			<b>Zona:</b> 
			<li><select id='zona' name='zona'></select></li>
			<b>Tipo Taquilla:</b>
			<li><div id='tipoTaquilla'></div></li>
			<div> <b>Num. Taquilla (Opcional):</b>
			<li><input name='num_taquilla' value=></div></li>
			<button id='reserva' type='submit' value='reserva' name='formulario'>Reservar taquilla</button>

	</form>
</div>