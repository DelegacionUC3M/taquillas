<div id='cuerpo'>
	<?php if (!empty($confirm)) { ?>
		<p class="correcto"> <?php echo $confirm; ?> </p>
	<?php } if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	</p>
	<form action='/taquillas/admin/intercambiar' method='post'>
		<ul id='intercambiar'>
			<li> <b>Usuario 1:</b> <input name='user1'></li>
			<li> <b>Usuario 2:</b> <input name='user2'></li>
		<div>
		<?php if (!empty($usuario1)) { ?>
				<ul id='usuario1'> 
				<?php foreach ($usuario1 as $taq) { ?>
					<ul id='intercambio1'> <input type='radio' name='taquilla1' value=<?php echo $taq->id ?> > 
						<li> <b>Número:</b> <?php echo $taq->num_taquilla ?> </li> 
						<li> <b>Edificio:</b> <?php echo $taq->edificio ?> </li>
						<li> <b>Planta:</b> <?php echo $taq->planta ?> </li>
						<li> <b>Zona:</b> <?php echo $taq->zona ?> </li>
						<li> <b>Tipo:</b> <?php echo $taq->tipo ?> </li>
						<li> <b>Usuario:</b> <?php echo $taq->user_id ?> </li>
						<li> <b>Fecha:</b> <?php echo $taq->fecha ?> </li>
					</ul>
				<?php } ?>	
			</ul>
		<?php }
			if (!empty($usuario2)) { ?>
				<ul id='usuario2'>
				<?php foreach ($usuario2 as $taq) { ?>
					<ul id='intercambio2'> <input type='radio' name='taquilla2' value=<?php echo $taq->id ?> >
						<li> <b>Número:</b> <?php echo $taq->num_taquilla ?> </li> 
						<li> <b>Edificio:</b> <?php echo $taq->edificio ?> </li>
						<li> <b>Planta:</b> <?php echo $taq->planta ?> </li>
						<li> <b>Zona:</b> <?php echo $taq->zona ?> </li>
						<li> <b>Tipo:</b> <?php echo $taq->tipo ?> </li>
						<li> <b>Usuario:</b> <?php echo $taq->user_id ?> </li>
						<li> <b>Fecha:</b> <?php echo $taq->fecha ?> </li>
					</ul>
				<?php } ?>
				</ul>
		<?php } ?>
		</div>

		<button id='intercambiar' type="submit" value="confirmar" name='intercambiar'>Asignar</button>
	</form>
</div>