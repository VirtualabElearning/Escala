  <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Lista de cursos</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php $this->load->view('view_site_css_js'); ?>
   <link rel="stylesheet" href="html/plugins/autocomplete/autocomplete.css">
 <script type="text/javascript" src="html/plugins/autocomplete/autocomplete.js"></script>


  <script>
            $(document).ready(function(){
                $('.autocomplete').autocomplete();
            });
        </script>
</head>
<body>


  <?php $this->load->view('view_site_header'); ?>






  <section class="encabezado2">
    <div class="encabezado2_wrap">
      <h6>OFERTA DE CURSOS</h6>
      <p>Estos son los programas de formación que te ofrecemos.</p>
      <div class="circle" <?php if (!$this->session->userdata('id_estatus') ): ?> style="background:none;" <?php endif ?>>
        <div class="circle_wrap">
            <img src="html/site/img/icono_6.png" alt="">
        </div>
        <div class="filtro autocomplete mobile-hider">
         <?php $attributos=array("method"=>"get","id"=>"formbuscar","name"=>"formbuscar"); ?>
         <?=form_open(base_url().$this->uri->segment(1).'/buscar',$attributos)?>
         <input type="text" data-source="<?php echo $this->uri->segment(1); ?>/buscar_curso?buscar=" class="autocomplete" name="buscar" id="buscar"  autocomplete="off" value="<?php echo $this->input->get('buscar'); ?>" placeholder="* Buscar cursos">
         <img src="html/site/img/search_icon.png" alt="">
         <?=form_close()?>
       </div>
     </div>
   </div>            
 </section>




 <section class="cursos_destacados">
  <div class="cursos_destacados_wrap clear" <?php if (count($cursos_lista)==1): ?> style="width:320px;"  <?php elseif (count($cursos_lista)==2): ?>   style="width:640px;" <?php endif ?>>
   <?php $contador=1; ?>               
   <?php foreach ($cursos_lista as $key => $value): ?>



    <div class="curso">
      <div class="curso_wrap">
        <div class="curso_pic">
         <img src="escalar.php?src=<?php echo base_url(); ?>uploads/cursos/<?php echo $value->foto; ?>&amp;w=306&amp;h=218&amp;zc=1" alt="><?php echo $value->titulo; ?>">
       </div>
       <div class="curso_des">
        <h2><?php echo $value->categoria_cursos; ?></h2>
        <p><?php echo $value->titulo; ?></p>
      </div>


      <a href="cursos/detalle/<?php echo $value->id_cursos; ?>/<?php echo amigable($value->titulo); ?>.html"> <div class="curso_btn <?php if ($value->id_tipo_planes!=1) { echo ""; } ?>"> Entrar <?php if ($value->id_tipo_planes!=1) { echo "!"; } ?></div> </a>
    
    </div>
  </div>
  <?php $contador++; ?>
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
