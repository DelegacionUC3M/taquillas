<div>
	<p class="confirm">
	<?php if(!empty($confirm)){
		echo $confirm;
	}
	?>
	</p>
	<p class="error">
	<?php if(!empty($error)){
		echo $error;
	}
	?>
	</p>
	<form action='/taquillas/admin/intercambiar' method='post'>
		<ul id='intercambiar'>
			<li> Usuario 1: <input name='user1'></li>
			<li> Usuario 2: <input name='user2'></li>
		<div>
		<?php if (!empty($usuario1)) { ?>
				<ul id='usuario1'> 
				<?php foreach ($usuario1 as $taq) { ?>
					<ul id='intercambio1'> <input type='radio' name='taquilla1' value=<?php echo $taq->id ?> > 
						<li> Número: <?php echo $taq->num_taquilla ?> </li> 
						<li> Edificio: <?php echo $taq->edificio ?> </li>
						<li> Planta: <?php echo $taq->planta ?> </li>
						<li> Zona: <?php echo $taq->zona ?> </li>
						<li> Tipo: <?php echo $taq->tipo ?> </li>
						<li> Usuario: <?php echo $taq->user_id ?> </li>
						<li> Fecha: <?php echo $taq->fecha ?> </li>
					</ul>
				<?php } ?>	
			</ul>
		<?php }
			if (!empty($usuario2)) { ?>
				<ul id='usuario2'>
				<?php foreach ($usuario2 as $taq) { ?>
					<ul id='intercambio2'> <input type='radio' name='taquilla2' value=<?php echo $taq->id ?> >
						<li> Número: <?php echo $taq->num_taquilla ?> </li> 
						<li> Edificio: <?php echo $taq->edificio ?> </li>
						<li> Planta: <?php echo $taq->planta ?> </li>
						<li> Zona: <?php echo $taq->zona ?> </li>
						<li> Tipo: <?php echo $taq->tipo ?> </li>
						<li> Usuario: <?php echo $taq->user_id ?> </li>
						<li> Fecha: <?php echo $taq->fecha ?> </li>
					</ul>
				<?php } ?>
				</ul>
		<?php } ?>
		</div>

		<button id='intercambiar' type="submit" value="confirmar" name='intercambiar'>Asignar</button>
	</form>
</div>