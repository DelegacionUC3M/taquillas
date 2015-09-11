
	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } if (!empty($correcto)) { ?>
		<p class="correcto"> <?php echo $correcto; ?> </p>
	<?php } ?>
	<form action='/taquillas/manager/anadirUsuario' method='post'>
		<ul class='formulario'>
			<p>NIA:</p>
			<li> <input id='nia' name='nia'></li>
			<p>Rol:</p>
			<li> <input id='rol' name='rol'></li>
		</ul>
  			<button class='confirmar' type='submit' name='anadirUsuario'>Añadir Usuario</button>
		</form>