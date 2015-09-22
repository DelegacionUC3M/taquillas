	<h2> Usuarios </h2>
	<ul class='menuHorizontal'>
		<li class='nombre'> <b>Nombre</b> </li>
		<li class='nia'> <b>NIA</b> </li>
		<li class='numero'> <b>Rol</b> </li>
	</ul>

	<?php if (!empty($lista)) {
			foreach ($lista as $usuario){
		?>
		<ul class='menuHorizontal2'>
			<li class='nombre'> <?php echo $usuario['nombre'].' '.$usuario['apellido1'].' '.$usuario['apellido2']  ?></li> 
			<li class='nia'> <?php echo $usuario['nia'] ?> </li>
			<li class='numero'> <?php echo $usuario['rol']  ?></li>
			<li class='numero'> <a href='/taquillas/manager/modificarUsuario/<?php echo $usuario["id"]?>'> Modificar </a></li> 
		</ul>
		<?php } 
	} ?>
	
