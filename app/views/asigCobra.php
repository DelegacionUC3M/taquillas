	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
		<form action='/taquillas/admin/asignar' method='post'>
			<ul class='formulario'>

				<p>Campus: </p>
				<li> <select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select></li>
				<p>Edificio:</p>
				<li><select id='edificio' name='edificio'></select></li>
				<p>Planta:</p>
				<li><select id='planta' name='planta'></select></li>
				<p>Zona:</p>
				<li><select id='zona' name='zona'></select></li>
				<p>Tipo Taquilla:</p>
				<li><div id='tipoTaquilla'></div></li>
				<p>NIA:</p>
				<li><input type='text' name='user_id' value=''></li>
				<p>Num. Taquilla (Opcional):</p>
				<li> <input name='num_taquilla' value=></li>
			</ul>
  			<button class='icon-signin confirmar' type='submit' name='asignar'>Asignar Taquilla</button>

		</form>
