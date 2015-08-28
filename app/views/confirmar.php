
<div id='cuerpo'>
	<?php if (!empty($confirm)) { ?>
		<p class="correcto"> <?php echo $confirm; ?> </p>
	<?php } ?>
	
	<ul id='formulario'>
		<h3>Datos del usuario</h3>
		<li><b>Nombre:</b> <?php echo ucwords(strtolower($_SESSION['user']->cn)) ?></li>
		<li><b>NIA:</b> <?php echo $_SESSION['user']->uid ?></li>
		<li><b>Correo:</b> <?php echo $_SESSION['user']->mail?></li>

		<h3>Datos de la taquilla</h3>
		<li><b>Campus:</b> <?php
		if ($reserva->campus == 1){
			echo "Getafe";
		} else if ($reserva->campus == 2){
			echo "Leganés";
		} else {
			echo $reserva->campus;
		} ?></li>
		<li><b>Edificio:</b> <?php echo $reserva->edificio ?></li>
		<li><b>Planta:</b> <?php echo $reserva->planta ?></li>
		<li><b>Zona:</b> <?php echo $reserva->zona ?></li>
		<li><b>Tipo:</b> <?php echo $reserva->tipo ?></li>
		<li><b>Número:</b> <?php echo $reserva->num_taquilla ?></li>
	</ul>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Confirmar reserva</button>
	</form>
	
</div>
