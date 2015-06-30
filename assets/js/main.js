
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
					$('#zona').html(generarZonas(edificios));
				})
			})
		});

	});	

	$('#eps1').on('click', function(){
		$('#eps2').slideToggle('slow',function() {
			$.get('/taquillas/taquilla/getStatsTotalEPS', function(datos){
console.log(datos);
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
		resultado += '<option name="planta '+key+'" value="'+key+'"> Planta '+key+' </option>\n';
	}
	return resultado;

}

function generarZonas(edificios) {
	var campus = $('#campus').val();
	var edf = $('#edificio').val();
	var planta = $('#planta').val();
	var resultado = "<option name='vacio'></option>\n";
	for (key in edificios[campus][edf][planta]){
		console.log(key);
		if (key == '') {
			resultado += "<option name='sin zonas ' value='null'> Sin zonas </option>\n";
		} else {
			resultado += "<option name='zona "+key+"' value="+key+"> Zona "+key+" </option>\n";
		}
	}
	return resultado;
}
