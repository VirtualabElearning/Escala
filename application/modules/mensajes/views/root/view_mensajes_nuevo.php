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
				<h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Nuevo mensaje)</h2>
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
											<?=form_open_multipart(base_url().$titulo.'/root/enviar',$attributos)?>
											<?php 
											$opciones=array(''=>'Seleccione...');
											foreach ($mis_cursos as $key => $value) {
												$opciones[$value->id_cursos]=$value->titulo;
											}
											echo select ("Curso","id_cursos","id_cursos",$opciones); 
											?>
											<?php 	
											$opciones=array(''=>'seleccione');
											echo select ("Usuario","id_usuarios","id_usuarios",$opciones);  
											?>
											<?php echo textarea ("Mensaje","mensaje","mensaje","Escriba el mensaje"); ?>
											<?php echo form_error('mensaje', '<div class="mensaje_error">', '</div>'); ?>
											<input type="hidden" id="id_estados" name="id_estados" value="<?php echo $this->config->item('estado_no_leido'); ?>">
											<div class="form-group">
												<div class="col-lg-offset-2 col-lg-6">
													<button type="submit" class="btn btn-sm btn-primary btnguardar">Enviar</button>
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

	<script>
		$('#id_cursos').change(function(event) {
			jQuery.ajax({
				url:'<?php echo base_url(); ?>mensajes/root/get_estudiantes_curso/'+$('#id_cursos option:selected').val(),
				type: "post",
				ajaxSend:function(result){              
					console.log ("ajaxSend\n");
				},
				success:function(result){ 
					$('#id_usuarios').html(result);
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
		});	

	</script>






</body>
</html>