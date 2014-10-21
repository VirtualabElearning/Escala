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



        <div class="row">









          <div class="col-md-4 botons_app">

            <ul class="nav nav-pills botssxx">

              <li class="dropdown dropdown-big">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                  <i class="fa fa-hand-o-up"></i> Preguntas por responder <span class="label label-primary"> <?php echo $mensajes_count; ?> </span> 
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <h5><i class="fa fa-envelope"></i> Mensajes </h5>
                    <hr>
                  </li>

                  <?php foreach ($mensajes as $key => $value): ?>
                    <li>
                    <h6><a href="#"><?php echo $value->nombres; ?> <?php echo $value->apellidos; ?></a></h6>
                      <p> <?php echo truncate($value->mensaje, 73); ?> </p>
                      <hr>
                    </li>
                  <?php endforeach ?>


                  <li>
                    <div class="drop-foot">
                      <a href="#">Ver todas</a>
                    </div>
                  </li>  

                </ul>
              </li>

            </ul>









            <div class="header-data botssxx2">


              <a href="#">
                <!-- Members data -->
                <div class="hdata">
                  <div class="mcol-left">
                    <!-- Icon with blue background -->
                    <i class="fa fa-user bblue"></i> 
                  </div>
                  <div class="mcol-right">
                    <!-- Number of visitors -->
                    <p>3000 <em>users</em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </a>


            </div>



          </div>



























        </div>



      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Promedio de visitas diarias</div>
              <div class="widget-icons pull-right">
                <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                <a href="#" class="wclose"><i class="fa fa-times"></i></a>
              </div>  
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">

               <div id="bar-chart"></div>

             </div>
             <div class="widget-foot">
              <!-- Footer goes here -->
            </div>
          </div>
        </div> 
      </div>
      <div class="col-md-6">
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Mensaje rapido a usuario</div>
            <div class="widget-icons pull-right">
              <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
              <a href="#" class="wclose"><i class="fa fa-times"></i></a>
            </div>  
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <div class="padd">

              <div class="form quick-post">

                <form class="form-horizontal">


                 <div class="form-group">
                  <label class="control-label col-lg-2">Usuario</label>
                  <div class="col-lg-5">                               
                    <select class="form-control">
                      <option value="">- Seleccone usuario -</option>
                      <option value="1">Edwin Garzon</option>
                      <option value="2">Camilo Lovera</option>

                    </select>  
                  </div>
                </div>      


                <div class="form-group">
                  <label class="control-label col-lg-2" for="title">Asunto</label>
                  <div class="col-lg-8"> 
                    <input type="text" class="form-control" id="title">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="control-label col-lg-2" for="content">Content</label>
                  <div class="col-lg-8">
                    <textarea class="form-control" rows="5" id="content"></textarea>
                  </div>
                </div>                           




                <!-- Buttons -->
                <div class="form-group">
                 <!-- Buttons -->
                 <div class="col-lg-offset-2 col-lg-6">
                  <button type="submit" class="btn btn-sm btn-success">Enviar</button>
                  <button type="reset" class="btn btn-sm btn-default">Reset</button>
                </div>
              </div>
            </form>
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

