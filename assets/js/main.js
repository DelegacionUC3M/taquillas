
$(function() {

	var edificios;
	$.get('/taquillas/taquilla/getEdificios', function(data){

		edificios = data;

		$('#campus').click(function(){
			$('#edificio').html(generarEdificios(edificios));
			$('#planta').html('');
			$('#zona').html('');
			$('#tipoTaquilla').html('');
			if($('#campus').val() == 2){
				$('#tipoTaquilla').html('<label>Simple 4€</label><input type="radio" name="tipo" value="simple"><br><label>Doble 6€</label><input type="radio" name="tipo" value="doble"><br>');
			}
			else if ($('#campus').val() == 1){
				$('#tipoTaquilla').html('<label>Simple 6€</label><input type="radio" name="tipo" value="simpleccssjj"><br>');
			}
			$('#edificio').click(function(){
				$('#planta').html(generarPlantas(edificios));
				$('#zona').html('');

				$('#planta').click(function(){
					console.log($('#planta').val());
					$('#zona').html(generarZonas(edificios));
				})
			})
		});

	});

});


function generarEdificios(edificios) {
	var campus = $('#campus').val();
	var resultado = "<option name='vacio'></option>\n";
	for (key in edificios[campus]){
		var guion = key.search(" - ");
		var nombre = key.substr(guion+3,key.length);
		resultado += '<option name="'+nombre+'" value="'+key+'"> '+key+' </option>\n';
	}
	return resultado;
}

function generarPlantas(edificios) {
	var campus = $('#campus').val();
	var edf = $('#edificio').val();
	var resultado = "<option name='vacio'></option>\n";
	for (key in edificios[campus][edf]){
		resultado += '<option name="planta '+key+'" value="'+key+'""> Planta '+key+' </option>\n';
	}
	return resultado;

}

function generarZonas(edificios) {
	var campus = $('#campus').val();
	var edf = $('#edificio').val();
	var planta = $('#planta').val();
	var resultado = "<option name='vacio'></option>\n";
	for (key in edificios[campus][edf][planta]){
		resultado += '<option name="'+key+'" value='+key+'> Zona '+key+' </option>\n';
	}
	return resultado;
}
