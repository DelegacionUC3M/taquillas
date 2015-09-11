
	<ul class='menuHorizontal'>
		<li class='numero'> <b>Id</b> </li>
		<li class='numero'> <b>App_id</b> </li>
		<li class='numero'> <b>Rol</b> </li>
	</ul>
	<ul class='menuHorizontal2'>
		<?php if (!empty($lista)) {
			foreach ($lista as $usuario){
		?>
		<li class='numero'> <?php echo $usuario['id'] ?></li> 
		<li class='numero'> <?php echo $usuario['app_id'] ?> </li>
		<li class='numero'> <?php echo $usuario['rol'] ?></li>
		<li class='numero'> <a href='/taquillas/manager/modificarUsuario/<?php echo $usuario["id"]?>'> Modificar </a></li> 
		<?php } }
	?>
	</ul>
