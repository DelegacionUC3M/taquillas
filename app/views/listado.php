
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	<form action='/taquillas/admin/listar' method='post'>
		<ul class='formulario'>
			Campus: 
			<li> <select id='campus' name='campus'> 
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
			Tipo Taquilla:
			<li><div id='tipoTaquilla'></div></li>
			Estado:
			<li> 
				<select id='estado' name='estado'> 
					<option name='vacio'></option>
					<option value='1'> Libre</option>
					<option value='2'> Reservada </option>
					<option value='3'> Ocupada </option>
					<option value='4'> Incidencia </option>
				</select>
			</li>
			Dueño: 
			<li> <input name='user_id' value=> </li>
			Fecha: 
			<li> <input type='date' name='fecha' value=> </li>
			Num. Taquilla: 
			<li> <input name='num_taquilla' value=> </li>
		</ul>
		<button class='confirmar' type='submit' name='busqueda'> Listar</button>
	</form>

	<div id='listadoTaquillas'> 
	<?php if (isset($lista)) {
		$i = 0;
			$nombreViejo = "";
			$campusViejo = "";
			foreach ($lista as $taquilla){
				if ($campusViejo != $taquilla->campus) {
					$campusViejo = $taquilla->campus;
					?> <h2> <?php 
						echo Taquilla::$nombreCampus[$taquilla->campus];
					?> </h2><br> <?php 
				}
				if ($nombreViejo != $taquilla->edificio) {
					$nombreViejo = $taquilla->edificio;
					?> <h3> <?php 
						echo Taquilla::$nombreEdificios[$taquilla->campus][$taquilla->edificio];
					?> </h3><br> 
					<ul class='menuHorizontal'>
						<li class='numero'> Numero </li>
						<li class='planta'> Planta </li>
						<li class='zona'> Zona </li>
						<li class='tipo'> Tipo </li>
						<li class='estado'> Estado </li>
						<li class='user_id'> Dueño </li>
						<li class='fecha'> Fecha </li>
					</ul> 
					<?php }	?>
		
		<ul class='menuHorizontal2'>
			<li class='numero'> <?php echo $taquilla->num_taquilla?> </li> 
			<li class='planta'> <?php echo $taquilla->planta?> </li>
			<li class='zona'> <?php echo $taquilla->zona?> </li>
			<li class='tipo'> <?php echo $taquilla->tipo?> </li>
			<li class='estado'> <?php switch($taquilla->estado) {
											case 1: echo 'Libre'; break;
											case 2: echo 'Reservada'; break;
											case 3: echo 'Ocupada'; break;
											case 4: echo 'Incidencia'; break;
										}
											?> </li>
			<li class='user_id'> <?php echo $taquilla->user_id?> </li>
			<li class='fecha'> <?php echo $taquilla->fecha?> </li>
			<li class='modificar'> <a href='/taquillas/admin/gestion/<?php echo $taquilla->id?>'> Modificar </a></li> 
		</ul>
		<?php } 
			} ?>
	</div>