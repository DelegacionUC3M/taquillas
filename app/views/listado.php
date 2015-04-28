<div id='listado'>

	<div id='filtros'>
	<form action='/taquillas/admin/listar' name='busqueda' method='post'>
		
		<select id='campus' name='campus'>
				<option name='vacio'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select>

			<select id='edificio' name='edificio'></select>

			<select id='planta' name='planta'></select>

			<select id='zona' name='zona'></select>
			
			<div id='tipoTaquilla'></div>

		<button type='submit' value='Búsqueda'> Listar</button>
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