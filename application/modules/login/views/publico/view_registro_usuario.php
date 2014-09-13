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

<section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Registro</h6>
    <p>Regístrate y disfruta de la web</p>
    
 </div>            
</section>

<?php $attributos=array('name'=>'form-perfil','id'=>'form-perfil'); ?>
<?=form_open_multipart(base_url().'registro_usuario_validar',$attributos)?>


<section class="editar">

  <div class="editar_wrap">
    <a href="facebook_login/<?php echo $this->uri->segment(2); ?>"> <div class="facebook_btn">Registro con Facebook</div></a>
    <div class="change_pic">
      <div class="change_pic_wrap clear">
        <div class="change_pic_col1 imagePreview">
          <img src="uploads/aprendices/<?php echo $this->input->post('userfile'); ?>" alt="">
        </div>


        <a id="cambia_foto" href="#"> <div class="change_pic_col2"> <p>Subir foto</p></div> </a>

     
        <input type="file" name="userfile" value="" id="userfile" onchange="previewImage(this,[256],4);" />


        <input type="hidden" name="foto_subida" value="<?php echo $this->session->userdata('foto_subida'); ?>">


      </div>
    </div>
    <div class="edit_block">
      <p>Nombre</p>
      <input type="text" placeholder="* Nombre" name="nombres" id="nombres" value="<?php if ($mensaje=='')  { echo $this->input->post('nombres'); } ?>"> 
      <?php echo form_error('nombres', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>
    <div class="edit_block">
      <p>Apellido</p>
      <input type="text" placeholder="* Apellido" name="apellidos" id="apellidos" value="<?php if ($mensaje=='')  {echo $this->input->post('apellidos'); } ?>">
      <?php echo form_error('apellidos', '<div class="mensaje_error">', '</div>'); ?> 

    </div>
    <div class="edit_block">
      <p>Email</p>
      <input type="text" placeholder="* email" name="correo" id="correo" value="<?php if ($mensaje=='')  { echo $this->input->post('correo'); } ?>">
      <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?> 

    </div>
    <div class="edit_block">
      <p>Ciudad</p>
      <input type="text" placeholder="* Ciudad" name="ciudad" id="ciudad" value="<?php if ($mensaje=='')  { echo $this->input->post('ciudad');  } ?>"> 
      <?php echo form_error('ciudad', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>
    <div class="edit_block">
      <p>Identificaci&oacute;n</p>
      <input type="text" placeholder="* Identificaci&oacute;n" name="identificacion" id="identificacion" value="<?php if ($mensaje=='')  { echo $this->input->post('identificacion'); } ?>">                        
      <?php echo form_error('identificacion', '<div class="mensaje_error">', '</div>'); ?> 
    </div>



 <div class="edit_block">
      <p>Contrase&ntilde;a</p>
      <input type="password" placeholder="* Contrase&ntilde;a" name="contrasena1" id="contrasena1" value="">                        
      <?php echo form_error('contrasena1', '<div class="mensaje_error">', '</div>'); ?> 
    </div>


 <div class="edit_block">
      <p>Confirmar Contrase&ntilde;a</p>
      <input type="password" placeholder="* Confirmar Contrase&ntilde;a" name="contrasena2" id="contrasena2" value="">                        
      <?php echo form_error('contrasena2', '<div class="mensaje_error">', '</div>'); ?> 
    </div>


   <?php echo  form_error('userfile', '<div class="mensaje_error error_foto">', '</div>'); ?>

<?php if ($mensaje): ?>
  <div class="mensaje_exito"><?php echo $mensaje; ?></div>
<?php endif ?>


    <a href="#" id="submit"><div class="editar_btn">Guardar </div> </a>


   
  </section>

  <?=form_close()?>


  <?php $this->load->view('view_site_footer'); ?>

  <style>
    #userfile {
      display: none;
    }

    .imagePreview p {
      display:none;
    }

    .error_foto{

    }
  </style>

  <script>

    $(document).ready(function() {

      $('#cambia_foto').click(function(event) {
        event.preventDefault();
        $('#userfile').click();
      });

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


