<div id='listado'>

	<div id='filtros'>
	<form action='/taquillas/admin/listar' name='busqueda' method='post'>
		
		<select name='campus'> </select>
		<select name='edificio'> </select>
		<select name='planta'> </select>
		<select name='zona'> </select>
<!--	<label>Simple</label>
			<input type='radio' name='simple' value='simple'><br>
			<label>Doble</label>
			<input type='radio' name='doble' value='doble'><br> !-->
		<button type='submit' value='Búsqueda'>
	</form>
	</div>

	<div id='listadoTaquillas'> 
		<table>
			<tr id='encabezado'>
				<td> Numero </td>
				<td> Planta </td>
				<td> Zona </td>
				<td> Tipo </td>
				<td> Estado </td>
				<td> Dueño </td>
				<td> Fecha </td>
				<td> Modificar </td>
			</tr>
			<!-- Habría que luego rellenarla con las taquillas resultantes de la busqueda -->
		</table>
	</div>
	
</div>