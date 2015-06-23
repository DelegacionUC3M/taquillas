<div id='cuerpo'>
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($correcto)) { ?>
		<p class="correcto"> <?php echo $correcto; ?> </p>
	<?php } ?>
	<form action='/taquillas/manager/anadirUsuario' method='post'>
		<ul id='formulario'>
			<b>NIA:</b>
			<li> <input id='nia' name='nia'></li>
			<b>Rol:</b>
			<li> <input id='rol' name='rol'></li>
		</ul>
  			<button id='anadir' type='submit' name='anadirUsuario'>Añadir Usuario</button>
		</form>

</div>