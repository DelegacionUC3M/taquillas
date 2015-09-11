
	<?php if (!empty($mensaje)) { ?>
		<p class="correcto"> <?php echo $mensaje; ?> </p>
	<?php } ?>

	<form action='/taquillas/manager/modificarUsuario/<?php echo $usuario['id'] ?>' method='post'>
		<ul class='formulario'>
			<b>Id:</b>
			<li> <?php echo $usuario['id'] ?></li>
			<b>App id:</b>
			<li> <?php echo $usuario['app_id'] ?></li>
			<b>Rol:</b> 
			<li> <input id='rol' name='rol' value='<?php echo $usuario['rol'] ?>'> </li>
		</ul>
	<button class='confirmar' type='submit' name='modificarUsuario'>Modificar</button>
	</form>
	<form action='/taquillas/manager/modificarUsuario/<?php echo $usuario['id'] ?>' method='post'>
	<button class='confirmar' type='submit' name='eliminarUsuario'>Eliminar</button>
	</form>
