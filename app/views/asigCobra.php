	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
		<form action='/taquillas/admin/asignar' method='post'>
			<ul class='formulario'>

				
				<li> <p>Campus: </p> 
					<select id='campus' name='campus'>
						<option name='vacio'></option>
						<option name='CSSJJ' value='1'> CSSJJ </option>
						<option name='Leganes' value='2'> Leganés </option>
					</select>
				</li>
				
				<li> <p>Edificio: </p> 
					<select id='edificio' name='edificio'></select>
				</li>
				
				<li> <p>Planta: </p>
					<select id='planta' name='planta'></select>
				</li>
				
				<li> <p>Zona: </p>
					<select id='zona' name='zona'></select>
				</li>
				
				<li> <p>Tipo Taquilla: </p><div id='tipoTaquilla'></div>
				</li>
				
				<li> <p>NIA: </p> <input type='text' name='user_id' value=''></li>
				
				<li> <p>Num. Taquilla (Opcional): </p><input name='num_taquilla' value=></li>
			</ul>
  			<button class='icon-signin confirmar' type='submit' name='asignar'>Asignar Taquilla</button>

		</form>
