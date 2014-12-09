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

  <script>
    $(function() {
      $( "#ciudad" ).autocomplete({
        source: "<?php echo base_url().'ciudades'; ?>",
        minLength: 2,
      });
    });
  </script>
</head>
<body> 
 <?php $this->load->view('view_site_header'); ?>

 <section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Editar Perfil</h6>
    <p>Estos son los datos que aparecerán en tus certificados.</p>
    <div class="circle">
      <div class="circle_wrap">
       <img src="html/site/img/edit_icon.png" alt="">
     </div>

   </div>
 </div>            
</section>

<?php $attributos=array('name'=>'form-perfil','id'=>'form-perfil'); ?>
<?php  if ($mensaje=='fb'): ?>
  <?=form_open_multipart(base_url().$this->uri->segment(1).'/actualizar_perfil/'.$mensaje,$attributos)?>

<?php else: ?>
  <?=form_open_multipart(base_url().$this->uri->segment(1).'/actualizar_perfil',$attributos)?>

<?php endif ?>

<section class="editar">
  <div class="editar_wrap">
    <div class="change_pic">
      <div class="change_pic_wrap clear">
        <div class="change_pic_col1 imagePreview">
          <?php if ( $mi_perfil->foto): ?>
            <img src="escalar.php?src=<?php echo base_url(); ?>uploads/aprendices/<?php echo $mi_perfil->foto; ?>&w=126&h=126&zc=1" alt="">
          <?php else: ?>
            <img src="html/site/img/sin_foto.png" alt="">
          <?php endif ?>
        </div>


        <a id="cambia_foto" href="#"> <div class="change_pic_col2"> <p>Cambiar Foto</p></div> </a>
        <div class="explicacion_texto">La imagen no debe superar los 1500x1500 pixeles ni mayor a 5Mb</div>
        
        <input type="file" name="userfile" value="" id="userfile" onchange="previewImage(this,[256],4);" />

        


        <input type="hidden" name="foto_antes" value="uploads/aprendices/<?php echo $mi_perfil->foto; ?>">


      </div>
    </div>
    <div class="edit_block">
      <p>Nombre</p>
      <input type="text" placeholder="* Nombre" name="nombres" id="nombres" value="<?php echo $mi_perfil->nombres; ?>"> 
      <?php echo form_error('nombres', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>
    <div class="edit_block">
      <p>Apellido</p>
      <input type="text" placeholder="* Apellido" name="apellidos" id="apellidos" value="<?php echo $mi_perfil->apellidos; ?>">
      <?php echo form_error('apellidos', '<div class="mensaje_error">', '</div>'); ?> 

    </div>
    <div class="edit_block">
      <p>Email</p>
      <input type="text" placeholder="* email" name="correo" id="correo" value="<?php echo $mi_perfil->correo; ?>">
      <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?> 

    </div>
    <div class="edit_block">
      <p>Ciudad</p>
      <input type="text" placeholder="* Ciudad" name="ciudad" id="ciudad" value="<?php echo  ($mi_perfil->ciudad); ?>"> 
      <?php echo form_error('ciudad', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>
    <div class="edit_block">
      <p>Identificación</p>
      <input type="text" placeholder="* Identificación" name="identificacion" id="identificacion" value="<?php echo $mi_perfil->identificacion; ?>">                        
      <?php echo form_error('identificacion', '<div class="mensaje_error">', '</div>'); ?> 
    </div>


    <?php echo  form_error('userfile', '<div class="mensaje_error error_foto">', '</div>'); ?>
    <?php #si existe mensaje y si es diferente de fb (fb es para ver si esta actualizando perfil despues de registrarse con facebook) ?>
    <?php if ($mensaje && $mensaje!='fb'): ?>
      <div class="mensaje_exito"> <?php echo $mensaje; ?> </div>
    <?php endif ?>

    <?php if ($this->uri->segment(2)=="confirmar" || $this->uri->segment(2)=="actualizar_perfil" || $this->uri->segment(2)=="editar_perfil"): ?>
     <div style="font-size: 12px;"> 
      <b style="font-wie;color: #F00;font-weight: bold;">Advertencia:</b> Estos serán los datos usados en tus certificados, ten cuidado pues solo es permitido actualizarlos <b>una (1) vez</b>, si necesitas ayuda debes ir a la sección de soporte.
    </div>
  <?php endif ?>


  <div id="c1"> 
    <div>
      <div id="c2"><a target="_blank" href="contenidos/informacion/6/terminos-y-condiciones.html">Acepto los Términos y condiciones</a></div>
      <div id="c3"><input type="checkbox" name="acepto" id="acepto" value="1"></div>
    </div>
  </div>



  <?php if ($mi_perfil->cambiar_info==0): ?>
   <a href="#" id="submit"><div class="editar_btn">Actualizar datos</div> </a>
 <?php else: ?>

   <?php if ($mensaje && $mensaje!='fb'): ?>
     <a href="cursos"><div class="editar_btn">Ir a cursos</div> </a>
   <?php else: ?>
     <a><div class="editar_btn">Ya no se permite actualizar</div> </a>
   <?php endif ?>

   
 <?php endif ?>

 <div class="forgot_pass">
  <a href="login/cambiar_clave"><p>Cambiar contraseña</p></a>
</div>
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


      if ($('#acepto').is(':checked'))  {
        $('#form-perfil').submit();
      }

      else {
        alert ("Debes aceptar los términos y condiciones.");
        return false;
      }



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


