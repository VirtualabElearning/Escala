<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Error en la base de datos</title>
	<style type="text/css">

		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}

		p {
			margin: 12px 15px 12px 15px;
		}
	</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		
		¡LO SENTIMOS! Este error no es muy común en el sistema, por favor haga clic en el botón enviar, para comunicarlo al administrador del sistema y poder corregir y mejorar la plataforma, muchas gracias por su colaboración. 

		<div style="padding: 10px; border: 1px solid rgb(212, 63, 58); margin: 50px;"> 
			


			<textarea id="mensaje_error" style="width: 1653px; height: 103px;"><?php echo ($message); ?></textarea>


			<button id="enviar">Reportar error</button>

		</div>




	</div>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	<script>

		$(document).ready(function() {


			$('#enviar').click(function(event) {


data = new Object;

data.mensaje_error=$('#mensaje_error').val();
data.url_actual='<?php echo current_url(); ?>';
data.var_post='<?php echo json_encode($_POST); ?>';
data.var_get='<?php echo json_encode($_GET); ?>';


jQuery.ajax({
	url:'<?php echo base_url(); ?>errores/enviar_error',
	type: "post",
	data:({
		data:data
	}),

	ajaxSend:function(result){				
		console.log ("ajaxSend\n");
	},
	success:function(result){				
		console.log ("success\n");
		alert (result);
		

	},
	complete:function(result){				
		console.log ("complete\n");
		alert ("Enviado exitosamente!, muchas gracias por su colaboracion");
		
	},
	beforeSend:function(result){				
		console.log ("beforeSend\n");
		

	},
	ajaxStop:function(result){				
		console.log ("ajaxStop\n");
	}




});


				


		});


	});


</script>




</body>
</html>