<div>
	<p class="error">
	<?php if (!empty($error)) print_r($error); ?>
	</p>
		<form action='/taquillas/admin/asignar' method='post'>
			
			Campus: <select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select><br>

			Edificio: <select id='edificio' name='edificio'></select><br>

			Planta: <select id='planta' name='planta'></select><br>

			Zona: <select id='zona' name='zona'></select><br>

			<div id='tipoTaquilla'></div>
			<div> NIA <input type='text' name='user_id' value=''></div>
			<div> Num. Taquilla (Opcional) <input name='num_taquilla' value=></div>
  			<button id='reserva' type='submit' name='asignar'>Asignar Taquilla</button>

		</form>
</div>
