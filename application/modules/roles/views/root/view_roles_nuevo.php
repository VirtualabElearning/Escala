<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!-- Title and other stuffs -->
	<title>Listado de <?php echo $titulo; ?> - Adminsitrador</title>
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
				<h2 class="pull-left"><i class="fa fa-table"></i> Listado de <?php echo $titulo; ?></h2>
				<!-- Breadcrumb -->
				<div class="bread-crumb pull-right">
					<a href="index.html"><i class="fa fa-home"></i> Inicio</a> 
					<!-- Divider -->
					<span class="divider">/</span> 
					<a href="#" class="bread-current">Principal</a>
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


										<?php echo input_text ("Nombre","nombre","nombre","Ingrese el nombre del rol"); ?>
										<?php echo textarea ("Descripcion","descripcion","descripcion","Ingrese la decripcion del contenido"); ?>
										<?php echo form_error('descripcion', '<div class="mensaje_error">', '</div>'); ?>


										<?php 
										$opciones=array("1"=>"Activo","0"=>"Inactivo");
										echo select ("Estado","id_estados","id_estados",$opciones); 
										?>

										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-6">
												<button type="submit" class="btn btn-sm btn-primary">Guardar</button>
												<a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>"><button type="button" class="btn btn-sm btn-warning">Cancelar</button></a>
													
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