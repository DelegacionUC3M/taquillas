<div id='cuerpo'>
		<form action='/taquillas/admin/firma' method='post'>
			<ul id='formulario'>
				Campus:
				<li><select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select></li>
				Edificio: 
				<li> <select id='edificio' name='edificio'></select></li>
				Planta:
				<li> <select id='planta' name='planta'></select></li>
				Zona:
				<li> <select id='zona' name='zona'></select></li>
				Dueño:
				<li> <input name='user_id' value=> </li>
				Num. Taquilla:
				<li> <input name='num_taquilla' value=></li>
				<li><div id='tipoTaquilla'></div></li>

				Firma: <li><input name='firmaComp' value=></li>
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