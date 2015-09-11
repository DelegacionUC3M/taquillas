
	<h2>Entrar a Taquillas</h2>
	<p>
		Está intentando acceder a un área protegida.
		<br>
		Introduzca su usuario y contraseña:
	</p>

	<?php if (!empty($error)) { ?>
		<p class="error"> <?php echo $error; ?> </p>
	<?php } ?>
	
	<form class="<?php echo isset ($error) ? 'error' : '' ?>" method="post">
		<input type="text" name="nia" id="nia" placeholder="NIA" />
		<input type="password" id="password" name="password" placeholder="Contraseña" />

		<button type="submit" value="Entrar">Entrar</button>
	</form>
