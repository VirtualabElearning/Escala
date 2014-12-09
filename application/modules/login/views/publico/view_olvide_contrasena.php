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

 <section class="login">
  <div class="login_wrap">    
    <div class="forgot_pass">
     <h1 <?php if ($mensaje=="enviado"): ?> style="display:none;"  <?php endif ?>>Email de registro a <?php echo $custom_sistema->nombre_sistema; ?></h1>


     <?php if ($mensaje=="enviado"): ?>
      <div class="titulo_registro">Restablecer tu contraseña</div>
      <div style="margin: 8px; padding: 10px;">Te hemos enviado a <b><?php echo $this->input->post('correo') ?></b> un mensaje para <b>restablecer tu contraseña</b>, revisa en tu bandeja de entrada o en la secci&oacute;n de SPAM.</div>
    <?php endif ?>


  </div>

  <?php $attributos=array('class'=>'form-horizontal','name'=>'form_generator','id'=>'form_generator'); ?>

  <?php if (!$mensaje=="enviado"): ?> 

   <?=form_open(base_url().'validar_olvide_contrasena',$attributos)?>
   <div class="name">
     <input type="text" placeholder="* Email" name="correo" id="correo" value="<?php echo $this->input->post('correo') ?>">
     <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?> 
   </div>
   <div class="login_btn"> Enviar</div>


   <?php if ($mensaje!='enviado' && $mensaje!=''): ?>
    <div class="mensaje_exito"> <?php echo $mensaje; ?> </div>
  <?php endif ?>


  <?php echo form_close(); ?>

<?php endif; ?>



</div>
</section>

<?php $this->load->view('view_site_footer'); ?>

        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->


      <script>


        $(document).ready(function() {


          $('.login_btn').click(function(event) {
           event.preventDefault();

           if ($('#correo').val()=='')  {
            alert ("Por favor, escribe tu correo");
            return false;

          }

          expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if ( !expr.test($('#correo').val()) )  {
            alert("Error: La dirección de correo " + $('#correo').val() + " es incorrecta.");
            return false;
          }

          $('#form_generator').submit();


        });


        });


      </script>


    </body>
    </html>
