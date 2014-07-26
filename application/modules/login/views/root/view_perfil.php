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
        <h2 class="pull-left"><i class="fa fa-table"></i> Mi <?php echo $titulo; ?></h2>
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

            <div class="col-md-3">  </div>

            <div class="col-md-6">


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


                    <div class="clear_div">
                     <h5> <label for="foto" class="control-label col-lg-2">Foto</label></h5>
                     <p>  <img src="uploads/usuarios/<?php echo $perfil->foto; ?>" alt="">  </p>
                   </div>


                   <div class="clear_div">
                     <h5> <label for="name" class="control-label col-lg-2">Rol</label></h5>
                     <p><?php echo $perfil->nombre_rol ; ?></p>
                   </div>


                   <div class="clear_div">
                     <h5> <label for="name" class="control-label col-lg-2">Nombres</label></h5>
                     <p><?php echo $perfil->nombres ; ?></p>
                   </div>

                   <div class="clear_div">
                     <h5> <label for="name" class="control-label col-lg-2">Apellidos</label></h5>
                     <p><?php echo $perfil->apellidos; ?></p>
                   </div>


                   <div class="clear_div">
                    <h5> <label for="name" class="control-label col-lg-2">Correo</label></h5>
                    <p><?php echo $perfil->correo; ?></p>
                  </div>

                  <div class="clear_div">
                    <h5> <label for="name" class="control-label col-lg-2">Identificacion</label></h5>
                    <p><?php echo $perfil->identificacion; ?></p>
                  </div>


                  <div class="clear_div">
                    <h5> <label for="name" class="control-label col-lg-2">Perfil</label></h5>

                    <div class="txtperfil">  <p><?php echo $perfil->perfil; ?></p></div>
                  </div>


                  <div class="clear_div">
                   <h5> <label for="name" class="control-label col-lg-2">Estado</label></h5>
                   <p><?php echo $perfil->nombre_estado ; ?></p>
                 </div>
  

<a class="btn btn-info btn-xs" href="usuarios/root/editar/<?php echo $perfil->id_usuarios ; ?>/null/<?php echo base64_encode("login/root/perfil/".$perfil->id_usuarios); ?>"><i class="fa"></i> Editar</a>




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