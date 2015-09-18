	
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($confirm)) { ?>
		<p class="correcto"> <?php echo $confirm; ?> </p>
	<?php } ?>

	<h2> Confirmación </h2>
	<ul class='formulario'>
		
		<li> <b>Nombre: </b><?php echo ucwords(strtolower($nombre)) ?></li>
		
		<li> <b>NIA: </b><?php echo $reserva->user_id ?></li>
		
		<li> <b>Correo: </b><?php echo $email?></li>
		
		<li> <b>Campus: </b><?php
		if ($reserva->campus == 1){
			echo "Getafe";
		} else if ($reserva->campus == 2){
			echo "Leganés";
		} else {
			echo $reserva->campus;
		} ?></li>
		
		<li> <b>Edificio: </b><?php echo $reserva->edificio ?></li>
		
		<li> <b>Planta: </b><?php echo $reserva->planta ?></li>
		
		<li> <b>Zona: </b><?php echo $reserva->zona ?></li>
		
		<li> <b>Tipo: </b><?php echo $reserva->tipo ?></li>
		
		<li> <b>Num.Taquilla: </b><?php echo $reserva->num_taquilla ?></li>
		
		<li> <b>Estado: </b>
					<?php switch($reserva->estado) {
								case 1: echo 'Libre'; break;
								case 2: echo 'Reservada'; break;
								case 3: echo 'Abonada'; break;
								case 4: echo 'Incidencia'; break;
						} ?>
			</select>
		</li>
	</ul>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button class='confirmar' type="submit" value="confirmar" name='confirmar'>Asignar </button>
	</form>
	<form action='/taquillas/admin/cobrar/<?php echo $reserva->id ?>' method='post'>
		<input type='hidden' name='user_id' value=<?php echo $reserva->user_id?>>
		<button class='confirmar' type="submit" value="cobrar" name='cobrar' formtarget='_blank' >Asignar y Cobrar</button>
	</form>

