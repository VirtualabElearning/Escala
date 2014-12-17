<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Respuestas de usuario) - Administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
	<?php $this->load->view('view_root_header'); ?> 
	<div class="content">
		<?php $this->load->view('view_root_menu'); ?> 
		<div class="mainbar">
			<div class="page-head">
				<h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Respuestas de usuario)</h2>
				<div class="bread-crumb pull-right">
					<a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
					<span class="divider">/</span> 
					<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/root/respuestas_estudiantes/<?php echo $this->uri->segment(4) ?>" class="bread-current">Modulo <?php echo $titulo; ?></a>				</div>
					<div class="clearfix"></div>
				</div>
				<div class="matter">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="widget">
									<div class="widget-head">
										<div class="pull-left"><?php echo str_replace("_", " ", $titulo); ?></div>
										<div class="widget-icons pull-right">
											<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
											<a href="#" class="wclose"><i class="fa fa-times"></i></a>
										</div>  
										<div class="clearfix"></div>
									</div>
									<div class="widget-content">
										<div class="padd">

											<?php #krumo ($lista_respuestas); ?>

											<br />
											<?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
											<?=form_open_multipart('',$attributos)?>

											<?php foreach ($lista_respuestas as $key => $value): ?>
												<div class="form-group">
													<label class="col-lg-2 control-label">Nombres completos</label>
													<div class="col-lg-5"><input disabled="true" type="text" class="form-control " value="<?php echo $value->nombres; ?> <?php echo $value->apellidos; ?>">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label">Curso</label>
													<div class="col-lg-5"><input disabled="true" type="text" class="form-control " value="<?php echo $value->titulo; ?>">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label">Encuesta</label>
													<div class="col-lg-5"><input disabled="true" type="text" class="form-control " value="<?php echo $value->nombre; ?>">
													</div>
												</div>
												<?php break; ?>
											<?php endforeach ?>

											<?php foreach ($lista_respuestas as $key => $value): ?>
												
												<div class="bordex">
													<div class="form-group">
														<label class="col-lg-2 control-label">Pregunta #<?php echo $key+1; ?> </label>
														<div class="col-lg-5"><input disabled="true" type="text" class="form-control " value="<?php echo $value->pregunta; ?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-2 control-label">Respuesta</label>
														<div class="col-lg-5"><input disabled="true" type="text" class="form-control " value="<?php echo $value->respuesta; ?>">
														</div>
													</div>
												</div>
											<?php endforeach ?>


											<div class="form-group">
												<div class="col-lg-offset-2 col-lg-6">
													<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/root/respuestas_estudiantes/<?php echo $this->uri->segment(4) ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Volver</button></a>
												</div>
											</div>


											<?=form_close()?>
										</div>
									</div>
									<div class="widget-foot">
									</div>
								</div>
							</div>  

						</div>
					</div>
				</div>
			</div>
		</div>      
		<div class="clearfix"></div>
	</div>
	<?php $this->load->view('view_admin_footer'); ?>
</body>
</html>