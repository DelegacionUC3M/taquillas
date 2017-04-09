$(function() {
             $('#send').on('submit', function(event) {
                var number = $('#number').val();
                var type = $('#type').val();
                var school = $('#school').val();
                var building = $('#building').val();
                var floor = $('#floor').val();
                var zone = $('#zone').val();
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
            });
        });

$(document).ready(function(){
		$("#send").on( "click", function() {
			$('#succesAlert').hide(1500);
			$('#errorAlert').hide(1500);
		 });
	});