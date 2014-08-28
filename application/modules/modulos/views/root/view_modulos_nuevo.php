<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Nuevo registro) - Administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
	<?php $this->load->view('view_root_header'); ?> 
	<div class="content">
		<?php $this->load->view('view_root_menu'); ?> 
		<div class="mainbar">
			<div class="page-head">
				<h2 class="pull-left"><i class="fa fa-table"></i>  <?php echo str_replace("_", " ", $titulo); ?> (Nuevo registro) </h2>
				<div class="bread-crumb pull-right">
					<a href="inicio/root"><i class="fa fa-home"></i> Inicio</a>  
					<span class="divider">/</span> 
					<a href="<?php echo str_replace("_", " ", $titulo); ?>/root/lista/<?php echo $this->uri->segment(5); ?>" class="bread-current">Cursos</a>
				</div>
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
										<br />
										<?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
										<?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>
										<?php echo input_text ("Nombre","nombre_modulo","nombre_modulo","Ingrese el nombre",$this->input->post('nombre_modulo'),form_error('nombre_modulo', '<div class="mensaje_error">', '</div>')); ?>
										<?php echo textarea ("Introducción","introduccion_modulo","introduccion_modulo","Ingrese la introducción",$this->input->post('introduccion_modulo'),form_error('introduccion_modulo', '<div class="mensaje_error">', '</div>')); ?>
										<?php echo editor ("Contenido","contenido_modulo","contenido_modulo",$this->input->post('contenido_modulo')) ?>
										<?php 
										foreach ($tipo_planes as $key => $value_tipo_planes) {
											$opciones[$value_tipo_planes->id_tipo_planes]=$value_tipo_planes->nombre;
										} 
										echo select ("Tipo de plan","id_tipo_planes","id_tipo_planes",$opciones,$this->input->post('id_tipo_planes')); 
										?>
										<?php 
										$opciones=array("1"=>"Activo","0"=>"Inactivo");
										echo select ("Estado","id_estados","id_estados",$opciones,$this->input->post('id_estados')); 
										?>
										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-6">
												<button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
												<a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>/lista/<?php echo $this->uri->segment(4) ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
											</div>
										</div>
										<?php if ($this->uri->segment(4)): ?>
											<?=form_hidden('id_cursos',$this->uri->segment(4))?>							
										<?php endif ?>
										<?php if ($this->input->post('id_cursos')): ?>
											<?=form_hidden('id_cursos',$this->input->post('id_cursos'))?>
										<?php endif ?>
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