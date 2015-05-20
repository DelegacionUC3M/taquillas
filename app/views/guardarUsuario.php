<div>

	<?php if (!empty($error)){
		print_r($error);
	} ?>
	<form action='/taquillas/manager/anadirUsuario' method='post'>
			
			NIA: <input id='nia' name='nia'><br>

			Rol: <input id='rol' name='rol'><br>

  			<button id='anadir' type='submit' name='anadirUsuario'>Añadir Usuario</button>

		</form>

</div>