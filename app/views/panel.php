<div id='cuerpo'>

	<ul id='opciones'>

		<h2><b> Usuarios </b></h2>
		<li> <a href='/taquillas/taquilla/reservar'> Reserva taquilla </a></li>

		<?php if ($user->rol >=50) { ?>
		<h2><b> Funciones de Administrador </b></h2>
		<li> <a href='/taquillas/admin/listar'> Listar taquillas </a></li>
		<li> <a href='/taquillas/admin/asignar'> Asignar y cobrar taquillas </a></li>
		<li> <a href='/taquillas/admin/gestionTaq'> Gestionar Taquillas </a></li>
		<li> <a href='/taquillas/admin/intercambiar'> Intercambiar Taquillas </a></li>
		<li> <a href='/taquillas/admin/stats'> Estadísticas </a></li>
		<li> <a href='/taquillas/admin/firma'> Firma </a></li>
		<?php } 

		if ($user->rol >= 100) { ?>
		<h2><b> Funciones de Manager </b></h2>
		<li> <a href='/taquillas/manager/gestionUsuarios'> Gestionar Usuarios </a></li> <!-- Añadir/Borrar/Editar usuarios a la app -->
		<li> <a href='/taquillas/manager/bloquear'> Bloquear/Liberar Aplicación </a></li>
		<li> <a href='/taquillas/manager/resetear'> Resetear Aplicación </a></li>
		<?php } ?>

	</ul>

</div>