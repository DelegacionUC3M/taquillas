$(function() {
	var edificios;
	$.get('taquillas/taquilla/getEdificios', function(data) {
		console.log(JSON.parse(data));
	});

})