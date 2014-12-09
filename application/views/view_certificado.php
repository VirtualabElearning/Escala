<?php #krumo ($custom_sistema); exit; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?=base_url()?>" /> 
	<link rel="stylesheet" type="text/css" href="certificado.css" />
	<meta charset="utf-8">
</head>
 

<body>

<div class="main">
	<div class="wrapper">

 
		<img src="uploads/personalizacion_general/<?php echo $custom_sistema->logo; ?>" alt="" class="logopdf">

		<div class="Escuela"> <?php echo $custom_sistema->certificado_texto1; ?> </div>

		<div class="licencia">
		<?php $custom_sistema->certificado_texto2=str_replace("\n", "<br>", $custom_sistema->certificado_texto2); ?>
			<?php echo $custom_sistema->certificado_texto2; ?> 
		</div>


		<div class="certifica">
			<?php echo $custom_sistema->certificado_texto3; ?> <br><b>“<?php echo $titulo_curso; ?>”</b>, a:
		</div>

		<div class="campo1"><?php echo $nombres_completos; ?></div>
		<div class="linea1"></div>




		<div class="identificado">
			<div class="capa1">Identificado (a) con cédula No  <div class="cedula"><?php echo $identificacion; ?></div> <div class="linea2">  </div> </div>
		</div>



		<div class="duracion">
			Dado el <?php echo $fecha_creado; ?>
		</div>



		<div class="cert_firma">
		<div class="linea3">  </div>
			Diego Alejandro Gómez Zuluaga
		</div>

	</div>
<div class="footer_pdf"></div>
		

</div>




</body>
</html>