<div>

		<form action='/taquillas/taquilla/reserva' name='formulario' method='post'>
			
			<select id='campus' name='campus'>
				<option name='vacio' value='0'></option>
				<option name='CSSJJ' value='1'> CSSJJ </option>
				<option name='Leganes' value='2'> Leganés </option>
			</select>

			<select id='edificio' name='edificio'></select>

			<select id='planta' name='planta'></select>

			<select id='zona' name='zona'></select>

			<div id='tipoTaquilla'></div>
	<!--	<label>Simple 4€</label>
  			<input type="radio" name="simple" value="simple"><br>
  			<label>Doble 6€</label>
  			<input type="radio" name="doble" value="doble"><br>!
  			simple sociales -> 4€ -->

  			<button type="submit" value="reserva">Reservar taquilla</button>

		</form>
</div>