	<h2> Usuarios </h2>
	<ul class='menuHorizontal'>
		<li class='numero'> <b>Id</b> </li>
		<li class='numero'> <b>App_id</b> </li>
		<li class='numero'> <b>Rol</b> </li>
	</ul>

	<?php if (!empty($lista)) {
			foreach ($lista as $usuario){
		?>
		<ul class='menuHorizontal2'>
			<li class='numero'> <?php echo $usuario['id'] ?></li> 
			<li class='numero'> <?php echo $usuario['app_id'] ?> </li>
			<li class='numero'> <?php echo $usuario['rol'] ?></li>
			<li class='numero'> <a href='/taquillas/manager/modificarUsuario/<?php echo $usuario["id"]?>'> Modificar </a></li> 
		</ul>
		<?php } 
	} ?>
	
