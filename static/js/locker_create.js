$(function() {
             $('#send').on('submit', function(event) {
                $.ajax({
                    url: '/manager/taquillas/crear',
                    data: $('form').serialize(),
                    type: 'POST'
                })
                .done(function(data){
                    if(data.error){
                        document.getElementById("lblErrorAlert").innerHTML=data.error;
                        $('#errorAlert').show(1500);
                        $('#succesAlert').hide();
                    }
                    else{
                        document.getElementById("lblSuccesAlert").innerHTML=data.success;
                        $('#errorAlert').hide();
                        $('#succesAlert').show(1500);
                    }
                });
                event.preventDefault();
            })
        });

$(document).ready(function(){
		$("#send").on( "click", function() {
			$('#succesAlert').hide(1500);
			$('#errorAlert').hide(1500);
		 });
	});

$(document).ready(function(){
	$("#selSchool").change(function(){
	            $.ajax({
                    url: '/manager/taquillas/filtrar_campus',
                    data: $('form').serialize(),
                    type: 'POST'
                })
                .done(function(data){
                    $('#selBuilding').empty();
                    $('#selFloor').empty();
                    $('#selZone').empty();
                    for(var building in data.buildings) {
                        $('#selBuilding').append('<option value="' + data.buildings[building] + '">' + data.buildings[building] +'</option>');
                    }
                    for(var floor in data.floors) {
                        $('#selFloor').append('<option value="' + data.floors[floor] + '">' + data.floors[floor] +'</option>');
                    }
                    for(var zone in data.zones) {
                        $('#selZone').append('<option value="' + data.zones[zone] + '">' + data.zones[zone] +'</option>');
                    }
                });
                event.preventDefault();
            });
        });

$(document).ready(function(){
	$("#selBuilding").change(function(){
	            $.ajax({
                    url: '/manager/taquillas/filtrar_edificio',
                    data: $('form').serialize(),
                    type: 'POST'
                })
                .done(function(data){
                    $('#selFloor').empty();
                    $('#selZone').empty();
                    for(var floor in data.floors) {
                        $('#selFloor').append('<option value="' + data.floors[floor] + '">' + data.floors[floor] +'</option>');
                    }
                    for(var zone in data.zones) {
                        $('#selZone').append('<option value="' + data.zones[zone] + '">' + data.zones[zone] +'</option>');
                    }
                });
                event.preventDefault();
            });
        });

$(document).ready(function(){
	$("#selFloor").change(function(){
	            $.ajax({
                    url: '/manager/taquillas/filtrar_planta',
                    data: $('form').serialize(),
                    type: 'POST'
                })
                .done(function(data){
                    $('#selZone').empty();
                    for(var zone in data.zones ) {
                        $('#selZone').append('<option value="' + data.zones[zone] + '">' + data.zones[zone] +'</option>');
                    }
                });
                event.preventDefault();
            });
        });