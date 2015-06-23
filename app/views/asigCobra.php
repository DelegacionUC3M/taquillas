<div id='cuerpo'>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
		<form action='/taquillas/admin/asignar' method='post'>
			<ul id='formulario'>
				Campus: 
				<li> <select id='campus' name='campus'>
					<option name='vacio'></option>
					<option name='CSSJJ' value='1'> CSSJJ </option>
					<option name='Leganes' value='2'> Leganés </option>
				</select></li>

				Edificio:
				<li><select id='edificio' name='edificio'></select></li>

				Planta:
				<li><select id='planta' name='planta'></select></li>

				Zona:
				<li><select id='zona' name='zona'></select></li>

				<li><div id='tipoTaquilla'></div></li>
				NIA <li><input type='text' name='user_id' value=''></li>
				Num. Taquilla (Opcional) <li> <input name='num_taquilla' value=></li>
			</ul>
  			<button id='reserva' type='submit' name='asignar'>Asignar Taquilla</button>

		</form>
</div>
