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
											<?php $attributos=array('class'=>'form-horizontal','role'=>'form','id'=>'form_recompensas'); ?>
											<?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>

											<ul class="nav nav-tabs" id="myTab">
												<li class="active"><a data-toggle="tab" href="#puntos">Puntos</a></li>
												<li><a data-toggle="tab" href="#video">Video</a></li>
												<li><a data-toggle="tab" href="#foro">Foro</a></li>
												<li><a data-toggle="tab" href="#logro">Logro</a></li>
											</ul>

											<?php $stylestmp="margin-top:15px;"; ?>

											<div class="tab-content" id="myTabContent">
												
												<div id="puntos" class="tab-pane fade in active">
													<div style="<?php echo $stylestmp; ?>"></div>
													<?php echo input_text ("Puntos","puntos","puntos","Ingrese los puntos a premiar"); ?>
													<input type="hidden" name="id_actividades_videos" value="">
													<input type="hidden" name="id_actividades_foro" value="">
													<input type="hidden" name="id_logros" value="">
												</div>

												<div id="video" class="tab-pane fade">
													<div style="<?php echo $stylestmp; ?>"></div>
													<?php 
													$opciones=array(""=>"Seleccione...");
													foreach ($videos_lista as $key => $value) {
														$opciones[$value->id_actividades_videos]=$value->nombre_actividad;
													}
													echo select ("Video","id_actividades_videos","id_actividades_videos",$opciones,$this->input->post('id_actividades_videos')); 
													?>
													<input type="hidden" name="id_actividades_foro" value="">
													<input type="hidden" name="puntos" value="">
													<input type="hidden" name="id_logros" value="">
												</div>

												<div id="foro" class="tab-pane fade">
													<div style="<?php echo $stylestmp; ?>"></div>
													
													<div class="form-group">
														<label class="col-lg-2 control-label">Crear foro</label>
														<div class="col-lg-5">
															<label class="checkbox-inline">
															<input type="checkbox" name="if_foro" id="if_foro" value="1" <?php if ($this->input->post('if_foro')!=0): ?> checked <?php endif ?>>
															</label>
														</div>
													</div>

													<input type="hidden" name="id_actividades_videos" value="">
													<input type="hidden" name="puntos" value="">
													<input type="hidden" name="id_logros" value="">
												</div>


												<div id="logro" class="tab-pane fade">
													<div style="<?php echo $stylestmp; ?>"></div>
													<?php 
													$opciones=array(""=>"Seleccione...");
													foreach ($logros_lista as $key => $value) {
														$opciones[$value->id_logros]=$value->nombre;
													}
													echo select ("Logro","id_logros","id_logros",$opciones,$this->input->post('id_logros')); 
													?>
													<input type="hidden" name="id_actividades_videos" value="">
													<input type="hidden" name="puntos" value="">
													<input type="hidden" name="id_actividades_foro" value="">
												</div>

											</div>

											<?php 
											$opciones=array("1"=>"Activo","0"=>"Inactivo");
											echo select ("Estado","id_estados","id_estados",$opciones,$this->input->post('id_estados')); 
											?>
											<div class="form-group">
												<div class="col-lg-offset-2 col-lg-6">
													<button type="submit" id="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
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

		$(document).ready(function() {

			$('#submit').click(function(event) {
				//event.preventDefault();

				$('#myTabContent > div').each(function(index, el) {
					if ( $(this).attr('id')!=$('#myTab > li.active > a').attr('href').replace("#","")  ) {
						$(this).remove();
					}
				});

				$('#form_recompensas').submit();
			});
		});	
	</script>


</body>
</html>