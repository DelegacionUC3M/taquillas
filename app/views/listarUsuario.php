<div>
	<div id='listadoUsuarios'> 
		<ul id='menuHorizontal'>
			<li> Id </li>
			<li> App_id </li>
			<li> Rol </li>
		</ul>
		<ul id='Vertical'>
			<?php if (!empty($lista)) {
				foreach ($lista as $usuario){
			?>
			<ul id='listaUsuario'>
				<li> <?php echo $usuario['id'] ?></li> 
				<li> <?php echo $usuario['app_id'] ?> </li>
				<li> <?php echo $usuario['rol'] ?></li>
				<li> <a href='/taquillas/manager/modificarUsuario/<?php echo $usuario["id"]?>'> Modificar </a></li> 
			</ul>
			<?php } }
		?>
		</ul>
	</div>
</div>