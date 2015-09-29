$(function() {

	var edificios;
	var formulario = [];

	if (sessionStorage.getItem('form') != null) {
		$.get('/taquillas/taquilla/getEdificios', function(data){
			edificios = data;
			formulario = sessionStorage.getItem('form').split(',');
			
			$('#campus').click(function(){
				sessionStorage.clear();
				formulario = [];
				formulario.push($('#campus option:selected').val());
				sessionStorage.setItem('form', formulario);
				console.log(formulario);
				$('#edificio').html(generarEdificios(edificios, false));
				$('#planta').html('');
				$('#zona').html('');
				$('#tipoTaquilla').html('');
				if($('#campus').val() == 2){
					$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simple"><label>Simple 4€</label><br><input type="radio" name="tipo" value="doble"><label>Doble 6€</label><br>');
				}
				else if ($('#campus').val() == 1){
					$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simpleccssjj"><label>Simple 6€</label><br>');
				}
			});

			$('#edificio').click(function(){
				while(formulario.length>1) {
					formulario.pop();
				}
				formulario.push($('#edificio option:selected').val());	
				sessionStorage.setItem('form', formulario);
				console.log(formulario);
				$('#planta').html(generarPlantas(edificios, false));
				$('#zona').html('');
			});


			$('#planta').click(function(){
				while(formulario.length>2) {
					formulario.pop();
				}
				formulario.push($('#planta option:selected').val());
				sessionStorage.setItem('form', formulario);
				console.log(formulario);	
				$('#zona').html(generarZonas(edificios, false));
			});

			$('#zona').click(function() {
				while(formulario.length>3) {
					formulario.pop();
				}
				formulario.push($('#zona option:selected').val());
				sessionStorage.setItem('form', formulario);
				console.log(formulario);
			});

			if($('#edificio').html(generarEdificios(edificios, true))) {
				if($('#campus').val() == 2){
					$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simple"><label>Simple 4€</label><br><input type="radio" name="tipo" value="doble"><label>Doble 6€</label><br>');
				}
				else if ($('#campus').val() == 1){
					$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simpleccssjj"><label>Simple 6€</label><br>');
				}
				if ($('#planta').html(generarPlantas(edificios, true))) {
					$('#zona').html(generarZonas(edificios, true));
				}
				
			}			
		});
	}

	$('#resetear').click(function () {
		var bool = confirm('¿Estas seguro de querer resetear?');
		if(bool == true) {
			$('#resetearDiv').html(
				'<form id="resetear" action="/taquillas/manager/resetear" method="post"> <button type="submit" name="confirmar_reseteo"> CONFIRMAR </button> </form>');
		}
	});

	$('#campus').click(function() {
		sessionStorage.clear();
		formulario = [];
		formulario.push($('#campus option:selected').val());
		sessionStorage.setItem('form', formulario);
		$('#edificio').click(function() {
			while(formulario.length>1) {
				formulario.pop();
			}
			formulario.push($('#edificio option:selected').val());	
			sessionStorage.setItem('form', formulario);
			$('#planta').click(function() {
				while(formulario.length>2) {
					formulario.pop();
				}
				formulario.push($('#planta option:selected').val());
				sessionStorage.setItem('form', formulario);	
				$('#zona').click(function() {
					while(formulario.length>3) {
						formulario.pop();
					}
					formulario.push($('#zona option:selected').val());
					sessionStorage.setItem('form', formulario);
				});
			});
		});
	});

	$.get('/taquillas/taquilla/getEdificios', function(data){
		edificios = data;

		$('#campus').click(function(){
			$('#edificio').html(generarEdificios(edificios, false));
			$('#planta').html('');
			$('#zona').html('');
			$('#tipoTaquilla').html('');
			if($('#campus').val() == 2){
				$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simple"><label>Simple 4€</label><br><input type="radio" name="tipo" value="doble"><label>Doble 6€</label><br>');
			}
			else if ($('#campus').val() == 1){
				$('#tipoTaquilla').html('<input type="radio" name="tipo" value="simpleccssjj"><label>Simple 6€</label><br>');
			}
			$('#edificio').click(function(){
				$('#planta').html(generarPlantas(edificios, false));
				$('#zona').html('');

				$('#planta').click(function(){
					$('#zona').html(generarZonas(edificios, false));
				})
			})
		});

	});	

	$('#eps1').on('click', function(){
		$('#eps2').slideToggle('slow',function() {
			$.get('/taquillas/taquilla/getStatsTotalEPS', function(datos){
				//Dibujar graficas
			    $('#totalEPS').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: 'EPS'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsEPS1', function(datos){

				//Dibujar graficas
			    $('#ed1eps').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '1 - Agustin de Betancourt'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsEPS2', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed2eps').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '2 - Sabatini'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsEPS4', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed4eps').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '4 - Torres Quevedo'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsEPS7', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed7eps').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '7 - Juan Benet'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});	
		});
	});

	$('#csj1').click(function(){
		$('#csj2').slideToggle('slow',function() {
			$.get('/taquillas/taquilla/getStatsTotalCSJ', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#totalCSJ').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: 'CCSSJJ'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ4', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed4csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '4 - Gómez de la Serna'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ5', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed5csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '5 - Giner de los Ríos'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ6', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed6csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '6 - Normante'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ7', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed7csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '7 - Foronda'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ9', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed9csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '9 - Adofo Posada'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ10', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed10csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '10 - Campomanes'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ12', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed12csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '12 - María Moliner'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});

			$.get('/taquillas/taquilla/getStatsCSJ15', function(datos){

				$taquilla = datos;
				//Dibujar graficas
			    $('#ed15csj').highcharts({
			        chart: {
			        	backgroundColor: '#E1E1E1',
		                plotBackgroundColor: '#E1E1E1',
		                plotBorderWidth: null,
		                plotShadow: false
			        },
			        title: {
			            text: '15 - López Aranguren'
			        },
			        tooltip: {
			        	pointFormat: '{series.name}: {point.y}(<b>{point.percentage:.1f}%</b>)'
			        },
			        plotOptions: {
			        	pie: {
			        		allowPointSelect: true,
			        		cursor: 'pointer',
			        		dataLabels: {
			        			enabled: true,
			        			format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)',
			        			style: {
			        				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			        			},
			        			connectorColor: 'silver'
			        		}
			        	}
			        },
			        series: [{
			            type: 'pie',
			            name: 'Taquillas',
			            data: datos
			        }]
			    });
			});
		});
	});
});

function generarEdificios(edificios, autocompletar) {
	var campus;
	var formulario = [];
	if (sessionStorage.getItem('form') != null && autocompletar == true) {
		formulario = sessionStorage.getItem('form').split(',');	
	}

	(formulario[0] != null) ? campus = formulario[0] : campus = $('#campus').val();

	var resultado = "<option name='vacio'></option>\n";
	for (key in edificios[campus]) {
		var guion = key.search(" - ");
		var nombre = key.substr(guion+3,key.length);
		if ((formulario != null) && (key == formulario[1])) {
			resultado += '<option name="'+nombre+'" value="'+key+'" selected> '+key+' </option>\n';
		} else {
			resultado += '<option name="'+nombre+'" value="'+key+'"> '+key+' </option>\n';
		}
	}
	return resultado;
}

function generarPlantas(edificios, autocompletar) {
	var campus;
	var edf;
	var formulario = [];

	if (sessionStorage.getItem('form') != null && autocompletar == true) {
		formulario = sessionStorage.getItem('form').split(',');	
	} 

	(formulario[0] != null) ? campus = formulario[0] : campus = $('#campus').val();
	(formulario[1] != null) ? edf = formulario[1] : edf = $('#edificio').val();
	
	var resultado = "<option name='vacio'></option>\n";
	
	for (key in edificios[campus][edf]) {
		if ((formulario != null) && (key == formulario[2])) {
			resultado += '<option name="planta '+key+'" value="'+key+'" selected> Planta '+key+' </option>\n';
		} else {
			resultado += '<option name="planta '+key+'" value="'+key+'"> Planta '+key+' </option>\n';
		}
	}
	return resultado;

}

function generarZonas(edificios, autocompletar) {
	var campus;
	var edf;
	var planta;
	var formulario = [];

	if (sessionStorage.getItem('form') != null && autocompletar == true) {
		formulario = sessionStorage.getItem('form').split(',');	
	} 

	(formulario[0] != null) ? campus = formulario[0] : campus = $('#campus').val();
	(formulario[1] != null) ? edf = formulario[1] : edf = $('#edificio').val();
	(formulario[2] != null) ? planta = formulario[2] : planta = $('#planta').val();

	var resultado = "<option name='vacio'></option>\n";

	for (key in edificios[campus][edf][planta]) {
		if (key == '') {
			resultado += "<option name='sin zonas ' value='null' > Sin zonas </option>\n";
		} else {
			if ((formulario != null) && (key == formulario[3])) { 
				resultado += '<option name="zona '+key+'" value="'+key+'" selected> Zona '+key+' </option>\n';
			} else {
				resultado += '<option name="zona '+key+'" value="'+key+'"> Zona '+key+' </option>\n';
			}
		}
	}
	return resultado;
}