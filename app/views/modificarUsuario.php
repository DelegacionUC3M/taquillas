<div>

	<?php if (!empty($mensaje)){
		print_r($mensaje);
	} ?>

	<form action='/taquillas/manager/modificarUsuario/<?php echo $usuario['id'] ?>' method='post'>
		Id: <?php echo $usuario['id'] ?><br>
		App id: <?php echo $usuario['app_id'] ?><br>
		Rol: <input id='rol' name='rol' value='<?php echo $usuario['rol'] ?>'> <br>
	<button id='modificarUsuario' type='submit' name='modificarUsuario'>Modificar</button>
	</form>
	<form action='/taquillas/manager/modificarUsuario/<?php echo $usuario['id'] ?>' method='post'>
	<button id='eliminarUsuario' type='submit' name='eliminarUsuario'>Eliminar</button>
	</form>

</div>