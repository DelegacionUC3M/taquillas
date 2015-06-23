
<div id='cuerpo'>
	<?php if (!empty($confirm)) { ?>
		<p class="correcto"> <?php echo $confirm; ?> </p>
	<?php } ?>
	
	
	Nos imaginamos los datos bonitos y eso <br>
	<ul id='formulario'>
		<li> <b>Nombre:</b> <?php echo $_SESSION['user']->cn ?></li>
		<li> <b>NIA:<b> <?php echo $_SESSION['user']->uid ?></li>
		<li> Correo: <?php echo $_SESSION['user']->mail?></li>
		<li> <b>Campus:</b> <?php
		if ($reserva->campus == 1){
			echo "Getafe";
		} else if ($reserva->campus == 2){
			echo "Leganés";
		} else {
			echo $reserva->campus;
		} ?></li>
		<li> <b>Edificio:</b> <?php echo $reserva->edificio ?></li>
		<li> <b>Planta:</b> <?php echo $reserva->planta ?></li>
		<li> <b>Zona:</b> <?php echo $reserva->zona ?></li>
		<li> <b>Tipo:</b> <?php echo $reserva->tipo ?></li>
		<li> <b>Num.</b> Taquilla: <?php echo $reserva->num_taquilla ?></li>
	</ul>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Confirmar reserva</button>
	</form>
	
</div>