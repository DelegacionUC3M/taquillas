
<div id='cuerpo'>
	<p class="error">
		<?php if (!empty($error)){
				print_r($error);
			}  
		?>
	</p>
	<p class='correcto'>
		<?php if (!empty($confirm)){
			print_r($confirm);
		} ?>
	</p>
	Nos imaginamos los datos bonitos y eso <br>
	<ul id='formulario'>
		<li> Nombre: <?php echo $reserva->user_id ?></li>
		<li> NIA: <?php echo $reserva->user_id ?></li>
		<li> Correo: <?php echo $email?></li>
		<li> Campus: <?php
		if ($reserva->campus == 1){
			echo "Getafe";
		} else if ($reserva->campus == 2){
			echo "Leganés";
		} else {
			echo $reserva->campus;
		} ?></li>
		<li> Edificio: <?php echo $reserva->edificio ?></li>
		<li> Planta: <?php echo $reserva->planta ?></li>
		<li> Zona: <?php echo $reserva->zona ?></li>
		<li> Tipo: <?php echo $reserva->tipo ?></li>
		<li> Num. Taquilla: <?php echo $reserva->num_taquilla ?></li>
		<li> Estado: <?php echo $reserva->estado ?></li>
	</ul>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Asignar </button>
	</form>
	<form action='/taquillas/admin/cobrar/<?php echo $reserva->id ?>' method='post'>
		<input type='hidden' name='user_id' value=<?php echo $reserva->user_id?>>
		<button id='cobrar' type="submit" value="cobrar" name='cobrar' formtarget='_blank' >Asignar y Cobrar</button>
	</form>
	
</div>
