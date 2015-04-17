$(function() {
	var edificios;
	$.get('/taquillas/taquilla/getEdificios', function(data) {
		console.log(data);
	})
	$('#pregunta a.tab').on('click', function(){
		
	})
})