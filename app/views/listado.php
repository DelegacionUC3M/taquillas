<div id='cuerpo'>

	<div id='filtros'>
	<form action='/taquillas/admin/listar' method='post'>
		<ul id='formulario'>
			<b>Campus: </b>
			<li> <select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select> </li>
			<b>Edificio: </b>
			<li> <select id='edificio' name='edificio'></select> </li>
			<b>Planta: </b>
			<li> <select id='planta' name='planta'></select> </li>
			<b>Zona: </b>
			<li> <select id='zona' name='zona'></select> </li>
		</ul>
		<button id='listaBoton' type='submit' name='busqueda'> Listar</button>
	</form>
	</div>

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
			<?php if (!empty($lista)) {
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
				if ($nombreViejo != $taquilla->edificio){
					$nombreViejo = $taquilla->edificio;
					?> <li> ~ ~ ~ ~ ~ ~ <?php 
						echo Taquilla::$nombreEdificios[$taquilla->campus][$taquilla->edificio];
					?> ~ ~ ~ ~ ~ ~ </li><br> <?php 
				}
				?>
			<ul id='listaTaq'>
				<li> <?php echo $taquilla->num_taquilla?></li> 
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