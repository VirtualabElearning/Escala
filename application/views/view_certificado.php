<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?=base_url()?>" /> 
	<link rel="stylesheet" type="text/css" href="html/pdf/certificados/style.css" />
	<meta charset="utf-8">
</head>


<body>

<div class="main">
	<div class="wrapper">


		<img src="html/site/img/logo.jpg" alt="" class="logopdf">

		<div class="Escuela"> La escuela de capacitación laboral <b>ESCALA</b> </div>

		<div class="licencia">
			Licencia de funcionamiento según resolución No 000987, 31 de julio de 1997,<br>
			expedida por la Secretaría de Educación Municipal de Medellín
		</div>


		<div class="certifica">
			Certifica la asistencia y participación al programa de <br><b>“<?php echo $titulo_curso; ?>”</b>, a:
		</div>

		<div class="campo1"><?php echo $nombres_completos; ?></div>
		<div class="linea1"></div>




		<div class="identificado">
			<div class="capa1">   Identificado (a) con cédula No  <div class="cedula"><?php echo $identificacion; ?></div> <div class="linea2">  </div> </div>
		</div>



		<div class="duracion">
			Con una duración de 6 horas<br/>Dado el <?php echo $fecha_creado; ?>
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