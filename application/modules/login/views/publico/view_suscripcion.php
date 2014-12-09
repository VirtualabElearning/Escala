<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('view_site_css_js'); ?>

</head>
<body> 
  <?php $this->load->view('view_site_header'); ?>
  <?php #krumo ($mis_cursos_suscripcion); ?>
  <section class="encabezado2 clear">
    <div class="encabezado2_wrap">
      <h6>Subscripción</h6>
      <p>Verifica el estado de tu cuenta.</p>
      <div class="circle">
        <div class="circle_wrap">
          <img src="html/site/img/icono_19.png" alt="">
        </div>
      </div>
    </div>            
  </section>

  <section class="aula">
    <div class="aula_wrap clear">

      <?php #krumo ($mis_cursos_suscripcion); ?>

      <?php foreach ($mis_cursos_suscripcion as $key => $value): ?>
        <div class="sus_col1">
          <h2>Tu estás registrado</h2>
          <?php if ($value->id_tipo_planes==$this->config->item('Premium')): ?>
            <h3>Usuario Premium</h3>
          <?php else: ?>
            <h3>Usuario Estándar</h3>
          <?php endif ?>


          <h4>Curso <?php echo $value->titulo; ?></h4>
        </div>
        <div class="sus_col2">
          <?php if ($value->id_tipo_planes==$this->config->item('Premium')): ?>
            <h5>Pago de suscripción</h5>
          <?php else: ?>
            <h5>Suscripción del curso</h5>
          <?php endif ?>
          <div class="fecha clear">
            <?php if ($value->id_tipo_planes==$this->config->item('Premium')): ?>
              <p><?php echo fecha_pdf($value->fecha_pago); ?></p>
              <h2>$<?php echo number_format($value->valor); ?></h2>  
            <?php else: ?>
             <p><?php echo fecha_pdf($value->fecha_creado); ?></p>
             <h2>Gratis</h2>  
           <?php endif ?>
         </div>


         <?php if ($value->id_tipo_planes==$this->config->item('Premium')): ?>
           <h3>Aprobado</h3>
         <?php else: ?>
           <a href="http://virtualab.sem/Escala/cursos/registrarme_al_curso_premium/<?php echo amigable($value->id_cursos); ?>/<?php echo amigable($value->titulo); ?>.html"><h2>PASAR A PREMIUM AHORA</h2></a>
         <?php endif ?>


       </div>
     <?php endforeach ?>

   </div>
 </section>

 <?php $this->load->view('view_site_footer'); ?>
        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->
    </body>
    </html>
