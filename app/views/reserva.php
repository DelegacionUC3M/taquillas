<div>
		<?php if (!empty($error)) print_r($error); ?>
		<form action='/taquillas/taquilla/reservar' method='post'>
			
			<select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select>

			<select id='edificio' name='edificio'></select>

			<select id='planta' name='planta'></select>

			<select id='zona' name='zona'></select>

			<div id='tipoTaquilla'></div>

			<div> Num. Taquilla (Opcional) <input type="text" name="num_Taquilla" value="Num. taquilla"></div>
  			<button id='reserva' type="submit" value="reserva" name='formulario'>Reservar taquilla</button>

		</form>
</div>