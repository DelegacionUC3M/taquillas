
<div id='cuerpo'>
	<?php if (!empty($confirm)) { ?>
		<p class="correcto"> <?php echo $confirm; ?> </p>
	<?php } ?>
	
	
	Nos imaginamos los datos bonitos y eso <br>
	<ul id='formulario'>
		<li> Nombre: <?php echo $_SESSION['user']->cn ?></li>
		<li> NIA: <?php echo $_SESSION['user']->uid ?></li>
		<li> Correo: <?php echo $_SESSION['user']->mail?></li>
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
	</ul>
	<form action='/taquillas/taquilla/confirmar/<?php echo $reserva->id?>' method='post'>
		<button id='confirmar' type="submit" value="confirmar" name='confirmar'>Confirmar reserva</button>
	</form>
	
</div>