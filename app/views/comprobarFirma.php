		<form action='/taquillas/admin/firma' method='post'>
			<ul class='formulario'>
				
				<li><p> Campus: </p> 
					<select id='campus' name='campus'>
						<option name='vacio'></option>
						<option name='CSSJJ' value='1'> CSSJJ </option>
						<option name='Leganes' value='2'> Leganés </option>
					</select>
				</li>
				
				<li> <p> Edificio:  </p><select id='edificio' name='edificio'></select></li>
				
				<li> <p> Planta: </p><select id='planta' name='planta'></select></li>
				
				<li> <p> Zona: </p><select id='zona' name='zona'></select></li>
				
				<li> <p> Dueño: </p><input name='user_id' value=> </li>
				
				<li> <p> Num. Taquilla: </p><input name='num_taquilla' value=></li>
				
				<li> <p> Tipo Taquilla: </p><div id='tipoTaquilla'></div></li>
				
				<li> <p> Firma: </p> <input name='firmaComp' value=></li>
			<button class='confirmar' type='submit' name='firma'> Generar Firma</button>
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