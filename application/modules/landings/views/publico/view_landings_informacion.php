<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 <base href="<?=base_url()?>" /> 
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo $contenido->titulo; ?>|<?php echo $custom_sistema->nombre_sistema; ?></title>
 <meta name="description" content="<?php echo $contenido->descripcion; ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php $this->load->view('view_site_css_js'); ?>
</head>
<body>
 <?php $this->load->view('view_site_header'); ?>
 <div class="brand_line">Hello</div>



 <section class="landing">
    <div class="landing_wrap clear">
       <div class="landing_col1">
           <h3><?php echo $contenido->titulo; ?></h3>
           <p> <?php echo $contenido->contenido; ?></p>
           <div class="video" id="video">
            <div class="video_wrap">

             <?php if ($contenido->url_video==''): ?>
                <img src="uploads/landings/<?php echo $contenido->foto; ?>" alt="<?php echo $contenido->titulo; ?>    ">
            <?php else: ?>
                <?php  parse_str( parse_url( $contenido->url_video, PHP_URL_QUERY ), $url_video );    ?>
                <iframe width="462" height="260" src="http://www.youtube.com/embed/<?php echo $url_video['v']; ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
            <?php endif ?>




        </div>
    </div>
</div>

<div class="landing_col2">
   <div class="landing_form">
       <?php $attributos=array('class'=>'form-horizontal','name'=>'form_generator','id'=>'form_generator'); ?>
       <?=form_open(base_url().'plataforma/validar.html',$attributos)?>

       <div class="name">
        <input type="text" placeholder="* Nombre" name="nombres" id="nombres" value="<?php echo $this->input->post('nombres'); ?>">   
        <?php echo form_error('nombres', '<div class="mensaje_error">', '</div>'); ?>                                 
    </div>
    <div class="name">
        <input type="text" placeholder="* Apellido" name="apellidos" id="apellidos" value="<?php echo $this->input->post('apellidos'); ?>">  
        <?php echo form_error('apellidos', '<div class="mensaje_error">', '</div>'); ?>                                  
    </div>
    <div class="pass">
        <input type="text" placeholder="* Email" name="correo" id="correo" value="<?php echo $this->input->post('correo'); ?>">
        <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?>

    </div>
    <div class="pass">
        <input type="text" placeholder="* Telefono" name="telefono" id="telefono" value="<?php echo $this->input->post('telefono'); ?>">
        <?php echo form_error('telefono', '<div class="mensaje_error">', '</div>'); ?>

    </div>
    

  <?php if ($msg!=''): ?>
                <h6 style="display:block;"><?php echo $msg; ?></h6>
            <?php else: ?>
              <a href="#" id="submit">  <div class="cta_btn"> Empezar</div> </a>
            <?php endif ?>


   


    <div class="newsletter clear">
        <p>Quiero recibir ofertas especiales</p><input type="checkbox" name="recibir_ofertas" id="recibir_ofertas" value="1" <?php if ($this->input->post('recibir_ofertas')): ?> checked <?php endif ?> >
    </div>
<input type="hidden" name="id_contenidos" value="<?php if (!$this->uri->segment(3)) { echo $this->input->post('id_contenidos'); } else {  echo $this->uri->segment(3); } ?>">
<input type="hidden" name="url" value="<?php echo current_url(); ?>">
<input type="hidden" name="titulo_landing" value="<?php echo $contenido->titulo; ?>">  
<?php echo form_close(); ?>
</div>
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