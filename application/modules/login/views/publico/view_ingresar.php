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
  <script type="text/javascript" src="login/assets/js/login.js"></script>



</head>
<body>
  <?php $this->load->view('view_site_header'); ?>

  <div class="brand_line">
    Hello
  </div>
  <section class="login">
    <div class="login_wrap">


      <a href="facebook_login/<?php echo $this->uri->segment(2); ?>"> <div class="facebook_btn">Ingresar con Facebook</div></a>
      <?php $attributos=array('class'=>'form-horizontal','name'=>'form_generator','id'=>'form_generator'); ?>
      <?=form_open(base_url().'ingresar/validar',$attributos)?>
      
      <input type="hidden" name="redirecter" value="<?php echo $this->uri->segment(2); ?>">
      <div class="name"><input type="email" id="correo" name="correo" value="<?php echo $this->input->post('correo') ?>" placeholder="* Correo"><img src="html/site/img/name_icon.png" alt=""></div>
      <div class="pass">
        <input type="password" autocomplete="off" name="contrasena" value="" id="contrasena" placeholder="* Contrase&ntilde;a">
        <img src="html/site/img/pass_icon.png" alt="">
        <?php echo form_error('contrasena', '<div class="mensaje_error">', '</div>'); ?>
      </div>

      <a href="#" id="entrar"><div class="login_btn">Entrar</div></a>


      <div class="forgot_pass">
      <a href="<?php echo base_url(); ?>olvide_contrasena"><p>¿Olvidaste tu contraseña?</p></a>
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
