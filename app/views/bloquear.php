
<div>
	<?php if(BLOQUEO==0){ ?>
		<div> Al realizar click en el siguiente botón estarás bloqueando la aplicación</div>

		<button id='bloqueo'>BLOQUEAR</button>
		<button id='confirmar_bloqueo' method='post' name='confirmar_bloqueo'>CONFIRMAR</button>

	<?php } else { ?>

		<div> Al realizar click en el siguiente botón estarás desbloqueando la aplicación</div>

		<button id='desbloqueo' method='post' name='desbloqueo'>DESBLOQUEAR</button>
		<button id='confirmar_desbloqueo' method='post' name='confirmar_desbloqueo'>CONFIRMAR</button>
		
	<?php } ?>

</div>