<div>
		<p class="error"> <?php if (!empty($error)) print_r($error); ?> </p>
		
		<form action='/taquillas/taquilla/reservar' method='post'>
			
			Campus: <select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select><br>

			Edificio: <select id='edificio' name='edificio'></select><br>

			Planta: <select id='planta' name='planta'></select><br>

			Zona: <select id='zona' name='zona'></select><br>

			<div id='tipoTaquilla'></div>

			<div> Num. Taquilla (Opcional) <input name='num_taquilla' value=></div><br>
  			<button id='reserva' type='submit' value='reserva' name='formulario'>Reservar taquilla</button>

		</form>
</div>