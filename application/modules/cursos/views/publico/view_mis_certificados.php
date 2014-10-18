<?php #krumo($this->session->all_userdata()); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Certificados</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php $this->load->view('view_site_css_js'); ?>

</head>
<body>


  <?php $this->load->view('view_site_header'); ?>

  <section class="encabezado">
    <div class="encabezado_wrap">
      <h6>Certificados</h6>
      <p>¡Una experiencia de aprendizaje online que te dejará sin palabras y potencializará tus capacidades para el éxito integral!</p>
    
      <div class="circle">
        <div class="circle_wrap">
            <img src="html/site/img/icono_9.png" alt="">
        </div>
     </div>

   </div>            
 </section>


        <section class="cert_page">
            <div class="cert_page_wrap clear">

               <div class="cert_block"> 
                    <div class="cert_block_wrap">   
                        <img src="html/site/img/icono_9.png" alt="">
                        <h3>Curso de Cocina integral</h3>
                        <p> Obteninido el 08 de Octubre 2014</p>
                        <div class="cert_btn">Descargar</div>
                    </div>
               </div>
               <div class="cert_block"> 
                    <div class="cert_block_wrap">   
                        <img src="html/site/img/icono_9.png" alt="">
                        <h3>Curso de Cliderazgo integral</h3>
                        <p> Obteninido el 08 de Octubre 2014</p>
                        <div class="cert_btn">Descargar</div>
                    </div>
               </div>
      
        
              

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
