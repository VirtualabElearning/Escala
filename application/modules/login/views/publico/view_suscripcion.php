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


         <section class="encabezado2 clear">
            <div class="encabezado2_wrap">
                <h6>Suscripción</h6>
                <p>Verifica los datos de tu plan.</p>
                <div class="circle">
                    <div class="circle_wrap">
                        <img src="img/icono_5.png" alt="">
                    </div>
                   
                </div>
            </div>            
        </section>

        <section class="aula">
            <div class="aula_wrap clear">
                <div class="sus_col1">
                    <h2>Tu estas registrado</h2>
                    <h3>Usuario Premium</h3>
                    <h4>Tu suscripcion esta vigente hasta el 11 de agosto 2015</h4>
                </div>
                <div class="sus_col2">
                    <h5>Pago de suscripcion</h5>
                    <div class="fecha clear">
                        <p>Agosto 10,2014</p>
                        <h2>$20</h2>                        
                    </div>
                    <h3>Aprobado 52369845</h3>
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
