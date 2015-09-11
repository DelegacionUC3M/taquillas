
	<?php if(BLOQUEAR==0) { ?>
		<div> Al realizar click en el siguiente botón estarás bloqueando la aplicación</div>

		<button id='bloqueo'>BLOQUEAR</button>
		Hay que esconderlo mediante CSS
		<form action='/taquillas/manager/bloquear' method='post'>
		<button id='confirmar_bloqueo' type='submit' name='confirmar_bloqueo'>CONFIRMAR</button>
		</form>

	<?php } else { ?>

		<div> Al realizar click en el siguiente botón estarás desbloqueando la aplicación</div>

		<button id='desbloqueo'>DESBLOQUEAR</button>
		Hay que esconderlo mediante CSS
		<form action='/taquillas/manager/bloquear' method='post'>
		<button id='confirmar_desbloqueo' type='submit' name='confirmar_desbloqueo'>CONFIRMAR</button>
		</form>
		
	<?php } ?>
