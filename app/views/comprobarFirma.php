<div id='cuerpo'>
		<form action='/taquillas/admin/firma' method='post'>
			<ul id='formulario'>
				<b>Campus:</b>
				<li><select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select></li>
				<b>Edificio: </b>
				<li> <select id='edificio' name='edificio'></select></li>
				<b>Planta:</b>
				<li> <select id='planta' name='planta'></select></li>
				<b>Zona:</b>
				<li> <select id='zona' name='zona'></select></li>
				<b>Dueño:</b>
				<li> <input name='user_id' value=> </li>
				<b>Num. Taquilla:</b>
				<li> <input name='num_taquilla' value=></li>
				<b>Tipo Taquilla:</b>
				<li><div id='tipoTaquilla'></div></li>
				<b>Firma:</b>
				<li><input name='firmaComp' value=></li>
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