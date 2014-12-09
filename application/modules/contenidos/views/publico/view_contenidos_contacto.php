<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
   <base href="<?=base_url()?>" /> 
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>Información de contacto|<?php echo $custom_sistema->nombre_sistema; ?></title>
   <meta name="description" content="Información de contacto">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php $this->load->view('view_site_css_js'); ?>
</head>
<body>
    <?php $this->load->view('view_site_header'); ?>
    <div class="brand_line">Hello</div>

    <section class="login">

        <?php $attributos=array('class'=>'form-horizontal','name'=>'form_generator','id'=>'form_generator'); ?>
        <?=form_open(base_url().'contenidos/validar_contacto.html',$attributos)?>

        <div class="login_wrap">
            <h3>Contáctanos</h3>
            <div class="name">
                <input type="text" placeholder="* Nombres Y Apellidos" name="nombres_completos" id="nombres_completos" value="<?php echo $this->input->post('nombres_completos') ?>">
                <?php echo form_error('nombres_completos', '<div class="mensaje_error">', '</div>'); ?>
            </div>
            <div class="email">
                <input type="text" placeholder="* Email"  name="correo" id="correo" value="<?php echo $this->input->post('correo'); ?>">
                <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?>
            </div>
            <textarea cols="30" rows="10" placeholder="Escribe tu mensaje" name="mensaje" id="mensaje"><?php echo $this->input->post('mensaje'); ?></textarea>
            <?php echo form_error('mensaje', '<div class="mensaje_error">', '</div>'); ?>


            <?php if ($ok=='enviado'): ?>
                <h6 style="display:block;">Tu mensaje ha sido enviado satisfactoriamente</h6>

            <?php else: ?>

                <a href="#" id="submit"> <div class="login_btn"> Enviar Mensaje</div></a>
            <?php endif ?>

             <div class="contact_info">
             <?php $custom_sistema->info_contacto=str_replace("\n", "<br>", $custom_sistema->info_contacto); ?>
                   <?php echo $custom_sistema->info_contacto; ?>
                </div>

                
        </div>
    </section>
    <?php $this->load->view('view_site_footer'); ?>
    <script>
        $(document).ready(function() {
            $('#submit').click(function(event) {
              event.preventDefault();
              $('#form_generator').submit();
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
