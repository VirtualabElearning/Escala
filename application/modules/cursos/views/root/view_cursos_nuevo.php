<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!-- Title and other stuffs -->
	<title>Modulo <?php echo $titulo; ?> (Nuevo registro) - Administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>

	<?php $this->load->view('view_root_header'); ?> 

	<!-- Main content starts -->
	<div class="content">

		<?php $this->load->view('view_root_menu'); ?> 
		<div class="mainbar">

			<div class="page-head">
				<h2 class="pull-left"><i class="fa fa-table"></i> Modulo <?php echo $titulo; ?> (Nuevo registro)</h2>
				<!-- Breadcrumb -->
				<div class="bread-crumb pull-right">
					<a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
					<!-- Divider -->
					<span class="divider">/</span> 
					<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista" class="bread-current">Modulo <?php echo $titulo; ?></a>
				</div>
				<div class="clearfix"></div>
			</div>


			<div class="matter">
				<div class="container">
					<div class="row">
						<div class="col-md-12">


							<div class="widget">
								<div class="widget-head">
									<div class="pull-left"><?php echo $titulo; ?></div>
									<div class="widget-icons pull-right">
										<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
										<a href="#" class="wclose"><i class="fa fa-times"></i></a>
									</div>  
									<div class="clearfix"></div>
								</div>
								<div class="widget-content">
									<div class="padd">

										<br />
										<?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
										<?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>
										<?php #krumo ($categoria_cursos); ?>
										<?php 
										foreach ($categoria_cursos as $key => $value) {
											$opciones[$value->id_categoria_cursos]=$value->nombre;
										}
										?>
										<?php echo select ('Categoria cursos','id_categoria_cursos','id_categoria_cursos',$opciones,$this->input->post('id_categoria_cursos'));
										?>

										<?php echo input_text ("Titulo","titulo","titulo","Ingrese el titulo del curso",$this->input->post('titulo'),form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>
										

										<?php echo textarea ("Descripción corta","descripcion","descripcion","Ingrese la descripción corta",$this->input->post('descripcion'),form_error('descripcion', '<div class="mensaje_error">', '</div>')); ?>
										 <div id="descripcion_contador" class="contar_caracteres"></div>

										<?php echo textarea ("Objetivos de aprendizaje","contenido","contenido","Ingrese los Objetivos de aprendizaje", $this->input->post('contenido') ,form_error('contenido', '<div class="mensaje_error">', '</div>')); ?>
										 <div id="contenido_contador" class="contar_caracteres"></div>

										


										<div class="form-group">
											<label class="col-lg-2 control-label">Foto</label>
											<div class="col-lg-5">
												<input type="hidden" name="image" id="image">

												<div class="fileupload   fileupload-exists " data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
														<img src="http://www.placehold.it/306x218/EFEFEF/AAAAAA" alt="img"/>
													</div>


													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">						
														<img src="http://www.placehold.it/306x218/EFEFEF/AAAAAA" alt="img"/>
													</div>

													<div class="explicacion_texto">Debe ser de 306x218</div>
													
													<div>
														<span class="btn btn-file">
															<span class="fileupload-exists">Cambiar</span>
															<span class="fileupload-new">Seleccione imagen</span>					
															<input type="file" value="" name="userfile" id="userfile"/>
														</span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>
														<?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>
													</div>
												</div>
											</div>
										</div>


										<?php echo input_text ("Url video trailer youtube","video","video","Escriba la url del trailer (si este campo está vacío, se pondrá en su lugar la foto)",$this->input->post('video'),form_error('video', '<div class="mensaje_error">', '</div>')); ?>



										<?php #echo editor ("Objetivos de parendizaje","objetivos_aprendizaje","objetivos_aprendizaje",$this->input->post('objetivos_aprendizaje'),form_error('objetivos_aprendizaje', '<div class="mensaje_error">', '</div>')) ?>

										<?php echo editor ("Prerrequisitos","prerrequisitos","prerrequisitos",$this->input->post('prerrequisitos'),form_error('prerrequisitos', '<div class="mensaje_error">', '</div>')) ?>

										<?php # echo editor ("Descripción corta","contenido","contenido",$this->input->post('contenido'),form_error('contenido', '<div class="mensaje_error">', '</div>')) ?>




										<?php $array_opc=array(); ?>
										<?php $cursos_checked=json_decode($detalle->instructores_asignados); $checkeado=""; ?>
										<?php foreach ($instructores_lista as $key => $value_instructores): ?>
											<?php $checkeado=""; ?>
											<?php if ( @in_array($value_instructores->id_usuarios,$cursos_checked)) { $checkeado="checked"; }  ?>
											<?php $array_opc['instructores_asignados[]|'.amigable($value_instructores->nombres." ".$value_instructores->apellidos ).'|'.$value_instructores->id_usuarios.'|'.$checkeado]=$value_instructores->nombres." ".$value_instructores->apellidos." [ ".$value_instructores->correo." ] "; ?>
										<?php endforeach  ?>
										<?php 
										echo checkbox ('Instructores asignados',$array_opc,1,''); ?>
										<?php
										echo form_error('instructores_asignados', '<div class="mensaje_error">', '</div>');
										?>
										<?php 
										$opciones=array("1"=>"Si","0"=>"No");
										echo select ("¿Curso destacado?","destacar","destacar",$opciones,$this->input->post('destacar')); 
										?>
										<?php /* ?>
										<?php $opciones=array();
										foreach ($tipo_planes as $key => $value) {
											$opciones[$value->id_tipo_planes]=$value->nombre;
										}
										?>
										<?php echo select ('Tipo plan','id_tipo_planes','id_tipo_planes',$opciones,$detalle->id_tipo_planes);
										?>
										<?php */ ?>

										<input type="hidden" name="id_tipo_planes" id="id_tipo_planes" value="1">

										<?php 
										$opciones=array("1"=>"Activo","0"=>"Inactivo");
										echo select ("Estado","id_estados","id_estados",$opciones,$this->input->post('id_estados')); 
										?>

										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-6">
												<button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
												<a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>

											</div>
										</div>

										<?=form_close()?>

									</div>
								</div>
								<div class="widget-foot">
									<!-- Footer goes here -->
								</div>
							</div>
						</div>  

					</div>
				</div>
			</div>
		</div>

		<!-- Matter ends -->

	</div>

	<!-- Mainbar ends -->        
	<div class="clearfix"></div>

</div>
<!-- Content ends -->







<?php $this->load->view('view_admin_footer'); ?>

</body>
</html>