<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Modulo <?php echo $titulo; ?> (Nuevo registro) - Administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
	<?php $this->load->view('view_root_header'); ?> 
	<div class="content">
		<?php $this->load->view('view_root_menu'); ?> 
		<div class="mainbar">

			<div class="page-head">
				<h2 class="pull-left"><i class="fa fa-table"></i> Modulo <?php echo $titulo; ?> (Nuevo registro)</h2>
				<div class="bread-crumb pull-right">
					<a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
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
										<?php echo input_text ("Url personalizado (Url externa)","url_personalizado","url_personalizado","Ingrese una url externa s&oacute;lo si desea que la página vaya a otro lugar, deje el campo vacío si no es necesario", $this->input->post('url_personalizado') ,form_error('url_personalizado', '<div class="mensaje_error">', '</div>')); ?>

										<?php echo input_text ("Nombre men&uacute;","titulo","titulo","Ingrese el Nombre del men&uacute;",$this->input->post('titulo'),form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>
										<?php echo textarea ("Descripci&oacute;n","descripcion","descripcion","Ingrese la descripci&oacute;n del contenido",$this->input->post('descripcion'),form_error('descripcion', '<div class="mensaje_error">', '</div>')); ?>
										<div class="form-group">
											<label class="col-lg-2 control-label">Foto</label>
											<div class="col-lg-5">
												<input type="hidden" name="image">
												<div class="fileupload   fileupload-new " data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">						
														<img src="" alt=""/>
													</div>
													<div>
														<span class="btn btn-file">
															<span class="fileupload-exists">Cambiar</span>
															<span class="fileupload-new">Seleccione imagen</span>					
															<input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile" id="userfile"/>
														</span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>
														<?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>
													</div>
												</div>
											</div>
										</div>
										<?php echo editor ("Contenido","contenido","contenido",$this->input->post('contenido'),form_error('contenido', '<div class="mensaje_error">', '</div>')); ?>
										<?php 
										$opciones=array("1"=>"Activo","0"=>"Inactivo");
										echo select ("Estado","id_estados","id_estados",$opciones,$this->input->post('id_estados')); 
										?>
										<?php 
										$opciones=array("1"=>"Si","0"=>"No");
										echo select ("Habilitar en footer","habilitar_en_footer","habilitar_en_footer",$opciones,$this->input->post('habilitar_en_footer')); 
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