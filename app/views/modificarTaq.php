<div>

	<?php if(isset($datos)){ 
			if (isset($cambio)){
				?> <div id='mensaje'><?php echo $cambio ?></div> 
	<?php  }  ?>

		<form action='?' method='post'>
			Campus: <?php if ($datos->campus == 1){
								echo "Getafe";
							} else if ($datos->campus == 2){
								echo "Leganés";
							} else {
								echo $datos->campus;
							} ?><br>
			Edificio: <?php $nombre = new Taquilla;
							echo Taquilla::$nombreEdificios[$datos->campus][$datos->edificio]; ?><br>
			Planta: <?php echo $datos->planta ?><br>
			Zona: <?php echo $datos->zona ?><br>
			Núm. Taquilla: <?php echo $datos->num_taquilla?><br>
			Tipo: <?php echo $datos->tipo ?><br>
			Estado: <input name='estado' value=<?php if (!is_null($datos->estado)){ echo $datos->estado; } ?>> <br>
			Dueño: <input name='user_id' value=<?php if (!is_null($datos->user_id)){ echo $datos->user_id; } ?>> <br>
			Fecha: <input name='fecha' value=<?php if (!is_null($datos->fecha)){ echo $datos->fecha; } ?>> <br>

			<button id='modificar' type="submit" value="gestion" name='gestion'> Modificar </button>
			<a href='/taquillas/admin/listar'> Atrás </a>
			</form>


	<?php } ?>
</div>