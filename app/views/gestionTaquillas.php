<div id='cuerpo'>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>

	<form action='/taquillas/admin/listar' method='post'>
		<ul id='formulario'>
			<b>Campus: </b>
			<li> <select id='campus' name='campus'> 
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select></li>
			<b>Edificio: </b>
			<li> <select id='edificio' name='edificio'></select></li>
			<b>Planta: </b>
			<li> <select id='planta' name='planta'></select></li>
			<b>Zona: </b>
			<li> <select id='zona' name='zona'></select></li>
			<b>Tipo Taquilla:</b>
			<li> <input name='tipo' value=> </li>
			<b>Estado: </b>
			<li> <input type='number' min='0' max='4' name='estado' value=> </li>
			<b>Dueño: </b>
			<li> <input name='user_id' value=> </li>
			<b>Fecha: </b>
			<li> <input type='date' name='fecha' value=> </li>
			<b>Num. Taquilla: </b>
			<li> <input name='num_taquilla' value=> </li>
		</ul>
		<button id='listaBoton' type='submit' name='busqueda'> Listar</button>
	</form>

	<div id='listadoTaquillas'> 
		<ul id='menuHorizontal'>
			<li> <b>Numero</b> </li>
			<li> <b>Planta</b> </li>
			<li> <b>Zona</b> </li>
			<li> <b>Tipo</b> </li>
			<li> <b>Estado</b> </li>
			<li> <b>Dueño</b> </li>
			<li> <b>Fecha</b> </li>
		</ul>
		<ul id='Vertical'>
			<?php if (isset($lista)) {
			$i = 0;
			$nombreViejo = "";
			$campusViejo = "";
			foreach ($lista as $taquilla){
				if ($campusViejo != $taquilla->campus) {
					$campusViejo = $taquilla->campus;
					?> <li> + + + + + <?php 
						echo Taquilla::$nombreCampus[$taquilla->campus];
					?> + + + + + </li><br> <?php 
				}
				if ($nombreViejo != $taquilla->edificio) {
					$nombreViejo = $taquilla->edificio;
					?> <li> ~ ~ ~ ~ ~ ~ <?php 
						echo Taquilla::$nombreEdificios[$taquilla->campus][$taquilla->edificio];
					?> ~ ~ ~ ~ ~ ~ </li><br> <?php 
				}
				?>
			<ul id='listaTaq'>
				<li> <?php echo $taquilla->num_taquilla?> </li> 
				<li> <?php echo $taquilla->planta?> </li>
				<li> <?php echo $taquilla->zona?> </li>
				<li> <?php echo $taquilla->tipo?> </li>
				<li> <?php echo $taquilla->estado?> </li>
				<li> <?php echo $taquilla->user_id?> </li>
				<li> <?php echo $taquilla->fecha?> </li>
				<li> <a href='/taquillas/admin/gestion/<?php echo $taquilla->id?>'> Modificar </a></li> 
			</ul>
			<?php } }
		?>
		</ul>
	</div>
</div>