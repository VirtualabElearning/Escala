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
                <a data-toggle="dropdown" href="mensajes/root" class="dropdown-toggle">
                  <i class="fa fa-hand-o-up"></i> Preguntas por responder <span class="label label-primary"> <?php echo $mensajes_count; ?> </span> 
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <h5><i class="fa fa-envelope"></i> Mensajes </h5>
                    <hr>
                  </li>

                  <?php foreach ($mensajes as $key => $value): ?>
                    <li>
                     <a href="mensajes/root/responder/<?php echo $value->id_mensajes; ?>"> <h6><?php echo $value->nombres; ?> <?php echo $value->apellidos; ?></h6></a>
                     <a href="mensajes/root/responder/<?php echo $value->id_mensajes; ?>">  <p> <?php echo truncate($value->mensaje, 30); ?> </p> </a>
                     <hr>
                   </li>
                 <?php endforeach ?>


                 <li>
                  <div class="drop-foot">
                    <a href="<?php echo base_url(); ?>mensajes/root">Ver todas</a>
                  </div>
                </li>  

              </ul>
            </li>

          </ul>

<?php /* ?>
  <?php $if_calif=if_calificar2($value->id_usuarios,$value->id_cursos); ?>
 <?php if ($if_calif==0) { echo "Por calificar"; } if ($if_calif==1) { echo "Calificado"; } ?>
 <?php */ ?>                      

 <?php $cal=0 ?>
 <?php foreach ($mis_cursos as $c_key => $c_value): ?>

  <?php $est=get_est_curso_actual($c_value->id_cursos); ?>

  <?php foreach ($est as $est_key => $est_value): ?>

    <?php $if_calif=if_calificar2($est_value->id_usuarios,$c_value->id_cursos); ?>

    <?php if ($if_calif==0): ?>
     <?php $cal=1; ?>
   <?php endif ?>
 <?php endforeach ?>

<?php endforeach ?>

<?php if ($cal>0): ?>
  <div class="header-data">
    <div class="hdata">
      <a href="cursos/root">
        <div class="mcol-left">
          <i class="fa fa-check bblue"></i> 
        </div>
        <div class="mcol-right">
          <p><em>por <br>Calificar</em></p>
        </div>
      </a>
      <div class="clearfix"></div>
    </div>
  </div>
<?php endif ?>


</div>



























</div>



</div>


<div class="row">
  <div class="col-md-6">
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
    <div class="col-md-6">
      <div class="widget">
        <div class="widget-head">
          <div class="pull-left">Mensaje masivo</div>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
          </div>  
          <div class="clearfix"></div>
        </div>
        <div class="widget-content">
          <div class="padd">

            <div class="form quick-post">

              <form action="<?php echo base_url(); ?>mensajes/root/enviar_masivo" method="post" accept-charset="utf-8" class="form-horizontal" role="form" enctype="multipart/form-data">                   
                <?php if ($mensaje_p): ?>
                  <div class="errormensaje"><?php echo $mensaje_p; ?></div>
                <?php endif ?>




       <?php if ($mensaje_ok): ?>
                  <div class="mensaje_ok"><?php echo $mensaje_ok; ?></div>
                <?php endif ?>



                <div class="form-group">
                  <label class="control-label col-lg-2">Curso</label>
                  <div class="col-lg-5">                               
                    <select class="form-control" name="id_cursos" id="id_cursos">
                      <option value="">- Seleccone curso -</option>
                      <?php foreach ($mis_cursos as $key => $value): ?>
                        <option value="<?php echo $value->id_cursos; ?>"><?php echo $value->titulo; ?></option>
                      <?php endforeach ?>
                    </select>  
                  </div>
                </div>      


                <div class="form-group">
                  <label class="control-label col-lg-2" for="content">Mensaje</label>
                  <div class="col-lg-8">
                    <textarea class="form-control" name="mensaje" id="mensaje" rows="5" placeholder="Digita el mensaje que quieres comunicar a todos los <?php echo asignar_frase_diccionario ($diccionario,"{estudiante}","Estudiante",2); ?>." id="content"></textarea>
                  </div>
                </div>                           




                <!-- Buttons -->
                <div class="form-group">
                 <!-- Buttons -->
                 <div class="col-lg-offset-2 col-lg-6">
                  <button type="submit" class="btn btn-sm btn-success">Enviar</button>
                </div>
              </div>
              <input type="hidden" id="id_estados" name="id_estados" value="<?php echo $this->config->item('estado_no_leido'); ?>">

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

