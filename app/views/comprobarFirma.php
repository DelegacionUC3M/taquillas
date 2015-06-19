<div>
	<div id='filtros'>
		<form action='/taquillas/admin/firma' method='post'>

				Campus: <select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select><br>
				Edificio: <select id='edificio' name='edificio'></select><br>
				Planta: <select id='planta' name='planta'></select><br>
				Zona: <select id='zona' name='zona'></select><br>
				Dueño: <input name='user_id' value=> <br>
				Num. Taquilla: <input name='num_taquilla' value=><br>
				<div id='tipoTaquilla'></div>

				Firma: <input name='firmaComp' value=><br>
			<button id='firma' type='submit' name='firma'> Generar Firma</button>
		</form>
		<p id='mensajeFirma'>
			<?php if(!empty($firma)) {
					echo 'La firma generada es: '.$firma;
				}
			?> <br> <?php 
				if (!empty($introducido)) {
					echo 'La firma introducida es: '.$introducido;
				}
			?> <br> <?php 
				if (!empty($resultado)) {
					echo $resultado;
				}
			?>
		</p>
	</div>
</div>