<div id='cuerpo'>
	
	<h2>Reserva tu taquilla</h2>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
	<form action='/taquillas/taquilla/reservar' method='post'>
		<ul id='formulario'>
			<li>
				<p>Campus:</p>
				<select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select>
			</li>
			<li>
				<p>Edificio:</p>
				<select id='edificio' name='edificio'></select>
			</li>
			<li>
				<p>Planta:</p>
				<select id='planta' name='planta'></select>
			</li>
			<li>
				<p>Zona:</p>
				<select id='zona' name='zona'></select>
			</li>
			<li>
				<p>Tipo Taquilla:</p>
				<div id='tipoTaquilla'></div>
			</li>
			<li>
				<p>Num. Taquilla (Opcional):</p>
				<input name='num_taquilla' value=>
			</li>
			<button class='icon-signin' id='reserva' type='submit' value='reserva' name='formulario'>Reservar taquilla</button>

	</form>
</div>