<div>
	<p class='error'>
		<?php if (!empty($error)){
				echo $error;
		} ?>
	</p>
	<p class='correcto'>
		<?php if (!empty($correcto)){
				echo $correcto;
		} ?>
	</p>
	<form action='/taquillas/manager/anadirUsuario' method='post'>
		<ul id='formulario'>
			NIA:
			<li> <input id='nia' name='nia'></li>
			Rol:
			<li> <input id='rol' name='rol'></li>
		</ul>
  			<button id='anadir' type='submit' name='anadirUsuario'>Añadir Usuario</button>
		</form>

</div>