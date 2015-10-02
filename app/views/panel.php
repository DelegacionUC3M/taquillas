	<ul id='opciones'>

		<h2>Usuarios</h2>
		<li> <a href='/taquillas/inicio/condiciones'> Reserva taquilla </a></li>

		<?php if ($user->rol >=50) { ?>
		<h2>Funciones de Administrador</h2>
		<li> <a href='/taquillas/admin/listar'> Listar taquillas </a> <i>(Buscar, filtrar o modificar)</i></li>
		<!--<li> <a href='/taquillas/admin/asignar'> Asignar y cobrar taquillas</a> <i>(Reservar, cobrar y recibos)</i></li>-->
		<!--<li> <a href='/taquillas/admin/gestionTaq'> Gestionar Taquillas </a> <i>(Búsqueda de una única taquilla) </i></li> -->
		<li> <a href='/taquillas/admin/intercambiar'> Intercambiar Taquillas </a></li>
		<li> <a href='/taquillas/admin/stats'> Estadísticas </a></li>
		<li> <a href='/taquillas/admin/firma'> Comprobación de firmas </a></li>
		<?php }

		if ($user->rol >= 100) { ?>
		<h2>Funciones de Manager</h2>
		<li> <a href='/taquillas/manager/gestionUsuarios'> Gestionar Usuarios </a> <i>(Agregar, listar, borrar, modificar)</i></li> <!-- Añadir/Borrar/Editar usuarios a la app -->
		<li> <a href='/taquillas/manager/bloquear'> Bloquear/Liberar Aplicación </a></li>
		<li> <a href='/taquillas/manager/resetear'> Resetear Aplicación </a></li>
		<?php } ?>

	</ul>
