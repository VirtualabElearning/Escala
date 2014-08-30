$(function() {


	//$( "#dragx" ).sortable();






$('#entrar').click(function(event) {
	event.preventDefault();

var formData = {correo:$('#correo').val(),contrasena:$('#contrasena').val()}; 


$('#form_generator').submit();
/*
	jQuery.ajax({
		type: 'POST',
		url:'ingresar/validar',
		data: formData ,

		ajaxSend:function(result){        
			console.log ("ajaxSend\n");

		},
		success:function(result){       
			console.log ("success\n");
			alert (result);
			
},
complete:function(result){        
	console.log ("complete\n");


},
beforeSend:function(result){        
	console.log ("beforeSend\n");


},
ajaxStop:function(result){        
	console.log ("ajaxStop\n");

}

});
*/
});




});