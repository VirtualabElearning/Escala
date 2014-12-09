<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?=base_url()?>" /> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Administrador - Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>

  <?php $this->load->view('view_root_header'); ?> 

  <!-- Main content starts -->

  <div class="content">

   
   <?php $this->load->view('view_root_menu'); ?>


   <!-- Main bar -->
   <div class="mainbar">

    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-home"></i> Administrador principal </h2>

      <!-- Breadcrumb -->
      <div class="bread-crumb pull-right">
        <a href="inicio/admin"><i class="fa fa-home"></i> Inicio</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="inicio/admin" class="bread-current">Administrador principal</a>
      </div>

      <div class="clearfix"></div>

    </div>
    <!-- Page heading ends -->



    <!-- Matter -->

    <div class="matter">
      <div class="container">

        <!-- Today estatus. jQuery Sparkline plugin used. -->



        <!-- Today estatus ends -->



        <!-- Chats, File upload and Recent Comments -->
        <div class="row">
 <div class="col-md-2"> </div>

          <div class="col-md-8">
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Novedades Virtualab</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>

              <div class="slider-wrapper theme-default">
                <div id="slider_docente" class="nivoSlider">
                  <img src="html/admin/nivo/images/banner1.jpg" data-thumb="html/admin/nivo/images/banner1.jpg" alt="" />
                  <img src="html/admin/nivo/images/banner2.jpg" data-thumb="html/admin/nivo/images/banner2.jpg" alt="" />
<?php /* ?>
                <a href="http://dev7studios.com"><img src="html/admin/nivo/images/banner2.jpg" data-thumb="html/admin/nivo/images/banner2.jpg" alt="" title="This is an example of a caption" /></a>
                <?php */ ?>       
                <img src="html/admin/nivo/images/banner3.jpg" data-thumb="html/admin/nivo/images/banner3.jpg" alt="" />
              </div>

            </div>

<?php /* ?>

          <div class="widget-content">
            <div class="padd">

             <div id="bar-chart"></div>

           </div>
           <div class="widget-foot">
            <!-- Footer goes here -->
          </div>
        </div>
        <?php */ ?>





      </div>


    </div>

 <div class="col-md-2"> </div>

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