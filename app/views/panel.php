<div id='cuerpo'>

	<ul id='opciones'>

		<li> <a href='/taquillas/taquilla/reservar'> </a> Reserva taquilla </li>

		<?php if ($user->rol >=50) { ?>
		<li> <a href='/taquillas/admin/lista'> </a> Listar taquillas </li>
		<li> <a href='/taquillas/admin/cobrar'> </a> Asignar y cobrar taquillas </li>
		<li> <a href='/taquillas/admin/gestionTaquillas'> </a> Gestionar Taquillas </li>
		<li> <a href='/taquillas/admin/sancionar'> </a> Sancionar usuarios </li>
		<li> <a href='/taquillas/admin/estadisticas'> </a> Estadísticas </li>
		<li> <a href='/taquillas/admin/firma'> </a> Firma </li>
		<?php } 

		if ($user->rol >= 100) { ?>
		<li> <a href='/taquillas/manager/gestionUsuarios'> </a> Gestionar Usuarios </li>
		<li> <a href='/taquillas/manager/bloquear'> </a> Bloquear Aplicación </li>
		<li> <a href='/taquillas/manager/resetear'> </a> Resetear Aplicación </li>
		<?php } ?>

	</ul>

</div>