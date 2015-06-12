<div>
	<p class="error">
	<?php if(!empty($error)){
		echo $error;
	}
	?>
	</p>
	<div id='filtros'>
	<form action='/taquillas/admin/gestionTaq' method='post'>

			Campus: <select id='campus' name='campus'> 
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select><br>
			Edificio: <select id='edificio' name='edificio'></select><br>
			Planta: <select id='planta' name='planta'></select><br>
			Zona: <select id='zona' name='zona'></select><br>
			Tipo: <input name='tipo' value=> <br>
			Estado: <input type='number' min='1' max='4' name='estado' value=> <br>
			Dueño: <input name='user_id' value=> <br>
			Fecha: <input type='date' name='fecha' value=> <br>
			Num. Taquilla: <input name='num_taquilla' value=> <br>
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