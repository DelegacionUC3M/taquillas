<div id='cuerpo'>
	<h2>Entrar a Taquillas</h2>

	<p class="error"><?php echo isset($error) ? $error : '' ?></p>
	
	<form class="<?php echo isset ($error) ? 'error' : '' ?>" method="post">
		<input type="text" name="nia" id="nia" placeholder="NIA" />
		<input type="password" id="password" name="password" placeholder="Contraseña" />

		<button type="submit" value="Entrar">Entrar</button>
	</form>
</div>