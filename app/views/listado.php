<div id='listado'>

	<div id='filtros'>
	<form action='/taquillas/admin/listar' method='post'>
		
		<select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select>

			<select id='edificio' name='edificio'></select>

			<select id='planta' name='planta'></select>

			<select id='zona' name='zona'></select>

		<button id='listaBoton' type='submit' name='busqueda'> Listar</button>
	</form>
	</div>

	<div id='listadoTaquillas'> 
		<ul id='menuHorizontal'>
			<li> Numero </li>
			<li> Planta </li>
			<li> Zona </li>
			<li> Tipo </li>
			<li> Estado </li>
			<li> Dueño </li>
			<li> Fecha </li>
		</ul>
		<ul id='Vertical'>
			<?php if (!empty($lista)) {
			$i = 0;
			$nombreViejo = "";
			foreach ($lista as $taquilla){
				if ($nombreViejo != $taquilla->edificio){
					$nombreViejo = $taquilla->edificio;
					?> <li> ~ ~ ~ ~ ~ ~ <?php 
						//$nombre = new Taquilla;
						//$nombre->rellenar();
						//echo $nombre->nombreEdificios[$taquilla->campus][$taquilla->edificio];
						echo Taquilla::$nombreEdificios[$taquilla->campus][$taquilla->edificio];
					?> ~ ~ ~ ~ ~ ~ </li> <?php 
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