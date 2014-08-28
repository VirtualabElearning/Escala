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
				<h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Nuevo registro)</h2>
				<div class="bread-crumb pull-right">
					<a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
					<span class="divider">/</span> 
					<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista" class="bread-current">Modulo <?php echo $titulo; ?></a>				</div>
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
											

											<?php 
											$opciones=array(""=>"Seleccione");
											foreach ($categorias_modulos_lista as $key => $value) {
												$opciones[$value->id_categorias_modulos_app]=$value->nombre ;
											}
											echo select ("Categoria Módulo","id_categorias_modulos_app","id_categorias_modulos_app",$opciones,$this->input->post('id_categorias_modulos_app')); 
											?>

											<?php echo input_text ("Nombre","nombre","nombre","Ingrese el nombre",$this->input->post('nombre')); ?>
											<?php echo form_error('nombre', '<div class="mensaje_error">', '</div>'); ?>

											<?php echo input_text ("Llave","llave","llave","Ingrese la llave del diccionario  (No es obligatorio, ver modulo diccionario)",$this->input->post('llave')); ?>
											<?php echo form_error('llave', '<div class="mensaje_error">', '</div>'); ?>

											<?php echo textarea ("Descripción","descripcion","descripcion","Ingrese la descripción",$this->input->post('descripcion'),form_error('descripcion', '<div class="mensaje_error">', '</div>')); ?>

											<?php echo input_text ("Carpeta","carpeta","carpeta","Ingrese el nombre de la carpeta",$this->input->post('carpeta')); ?>
											<?php echo form_error('carpeta', '<div class="mensaje_error">', '</div>'); ?>



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