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
  <link rel="stylesheet" href="login/assets/css/login.css"> 

</head>
<body>
 <?php $this->load->view('view_site_header'); ?>

 <div class="brand_line">
  Hello
</div>


<?php $attributos=array('name'=>'form-perfil','id'=>'form-perfil'); ?>
<?=form_open_multipart(base_url().$this->uri->segment(1).'/actualizar_clave',$attributos)?>


<section class="login">
  <div class="login_wrap">
    <p>Ingresa tu nueva contraseña</p>

    <?php if ($this->session->userdata('if_update')!=1): ?>
      <div class="pass">
        <input type="password" id="contrasena_anterior" name="contrasena_anterior" placeholder="* Contraseña anterior">
        <?php echo form_error('contrasena_anterior', '<div class="mensaje_error">', '</div>'); ?>  
      </div>
    <?php endif ?>


    <div class="pass">
      <input type="password" id="contrasena1" name="contrasena1" placeholder="* Nueva contraseña">
      <?php echo form_error('contrasena1', '<div class="mensaje_error">', '</div>'); ?>  

    </div>
    <div class="pass">
      <input type="password" id="contrasena2" name="contrasena2" placeholder="* Confirmar contraseña">
      <?php echo form_error('contrasena2', '<div class="mensaje_error">', '</div>'); ?>  

    </div>
    
    <?php if ($mensaje): ?>
      <div class="mensaje_exito"> <?php echo $mensaje; ?> </div>
    <?php endif ?>



    <a href="#" id="submit">  <div class="login_btn"> Actualizar Contraseña </div> </a>

  </div>
</section>


<?=form_close()?>



<?php $this->load->view('view_site_footer'); ?>


<script>

  $(document).ready(function() {

    $('#submit').click(function(event) {
      event.preventDefault();
      $('#form-perfil').submit();
    });

  });

</script>



        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->
    </body>
    </html>
