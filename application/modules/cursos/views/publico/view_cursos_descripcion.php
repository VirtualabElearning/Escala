<?php #krumo($detalle_curso); ?>
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
  <title><?php echo $detalle_curso->titulo; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php $this->load->view('view_site_css_js'); ?>



</head>
<body>        

 <?php $this->load->view('view_site_header'); ?>

 <section class="encabezado2 clear">
  <div class="encabezado2_wrap">

    <h6><?php echo $detalle_curso->titulo; ?></h6>
    <p><?php echo $detalle_curso->descripcion; ?></p>
    

    <div class="circle">
      <div class="circle_wrap">
        <img src="html/site/img/icono_6.png" alt="">
      </div>

    </div>
  </div>            
</section>
<section class="description">
  <div class="description_wrap clear">
    <div class="col1">
      <div class="video_wrap">

        <?php if ($detalle_curso->video): ?>

          <?php 
          parse_str( parse_url( $detalle_curso->video, PHP_URL_QUERY ), $arrvideo );
          ?>
          <iframe width="462" height="260" src="//www.youtube.com/embed/<?php echo $arrvideo['v']; ?>?rel=0&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
        <?php else: ?>
          <img src="escalar.php?src=<?php echo base_url().'uploads/cursos/'.$detalle_curso->foto; ?>&w=462&h=260&zc=1  ?>" alt="">
        <?php endif ?>

      </div>
    </div>
    <div class="col2">
      <div class="col2_wrap">




        <?php if ($if_inscrito==1): ?>
          <?php  ?>
          <a class="biton" link="cursos/registrarme_al_curso/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $this->uri->segment(4); ?>" href="cursos/empezar/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $primer_mod_activ->id_modulos; ?>/<?php echo $primer_mod_activ->id_actividades_barra; ?>/<?php echo amigable($detalle_curso->titulo); ?>.html">  

          <?php else: ?>
            <?php if ($detalle_curso->id_tipo_planes==1): ?>
              <a class="biton" link="cursos/registrarme_al_curso/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $this->uri->segment(4); ?>" id="clicto">


              <?php else: ?>
                <a > 

                <?php endif ?>

              <?php endif ?>


              <h4>Descripción</h4>
              <p><?php echo str_replace("\n","<br>",$detalle_curso->contenido); ?> </p>



              <?php if ($if_inscrito==1): ?>
                <?php /* ?><a class="" link="cursos/registrarme_al_curso/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $this->uri->segment(4); ?>" href="cursos/empezar/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $primer_mod_activ->id_modulos; ?>/<?php echo $primer_mod_activ->id_actividades_barra; ?>/<?php echo amigable($detalle_curso->titulo); ?>.html"> <?php */ ?>  <div class="empezar_btn">Empezar </div> <?php /* ?> </a>  <?php */ ?>

              <?php else: ?>
                <?php if ($detalle_curso->id_tipo_planes==1): ?>
                <?php /* ?>  <a class="" link="cursos/registrarme_al_curso/<?php echo $detalle_curso->id_cursos; ?>/<?php echo $this->uri->segment(4); ?>" id=""> <?php */ ?> <div class="empezar_btn">Matricularme</div>  <?php /* ?> </a> <?php */ ?>


                <?php else: ?>
              <?php /* ?>    <a > <?php */ ?>  <div class="empezar_btn">Comprar</div>   <?php /* ?> </a> <?php */ ?> 

                <?php endif ?>

              <?php endif ?>


            </a>



          </div>
        </div>
      </div>
    </section>

    <section class="pensum">
      <div class="pensum_wrap">
        <div class="pensum_block">
          <h2>PREREQUISITOS</h2>
          <p><?php echo $detalle_curso->prerrequisitos ; ?></p>
        </div>

        <?php foreach ($detalle_curso->modulos as $key => $value): ?>
         <div class="pensum_block">
          <h2><?php echo $value->nombre_modulo; ?></h2>
          <p><?php echo $value->introduccion_modulo ; ?>
          </p>
        </div>
      <?php endforeach ?>

      <div class="teacher_block">
        <div class="teacher_block_wrap clear">

          <?php foreach ($detalle_curso->instructores as $key => $value): ?>
            <div class="teacher_col1">
              <img src="escalar.php?src=<?php echo base_url().'uploads/instructores/'.$value->foto; ?>&w=113&h=113&zc=1  ?>" alt="<?php echo $value->nombres; ?> <?php echo $value->apellidos; ?>">
            </div>

            <div class="teacher_col2">
              <h3><?php echo $value->nombres; ?> <?php echo $value->apellidos; ?></h3>
              <h2><?php echo $value->profesion; ?></h2>
              <p><?php echo $value->resumen_de_perfil; ?></p>
            </div>
          <?php endforeach ?>

        </div>
      </div>

    </div>

  </section>




















  <section class="registrate">
    <h4>Regístrate</h4>
    <div class="registrate_wrap clear">


      <?php foreach ($tipo_planes as $key => $value): ?>

       <?php if ($key==0): ?>
         <a href="cursos/registrarme_al_curso_premium/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>">
         <?php else: ?>
          <a href="cursos/registrarme_al_curso/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>">
          <?php endif ?>

          <div class="plan<?php if ($key==1)  {  echo "2"; } ?> <?php if ($key>0)  {  echo " no_margin "; } ?>">
           <div class="plan_wrap">
            <?php $_planes_valores=@json_decode(json_decode($inicio->planes)->planes_valores); ?>
            <h2><?php echo $tipo_planes[$key]->nombre; ?></h2>

            <h3><?php echo @$_planes_valores[$key]; ?></h3>
            <ul>
             <?php $_linea1=@json_decode(json_decode($inicio->planes)->lineas1); ?>
             <li class="grey"><?php if ( $_linea1[$key]!='') {  echo  $_linea1[$key];  } else { echo "&nbsp;"; } ?></li>
             <?php $_linea2=@json_decode(json_decode($inicio->planes)->lineas2); ?>
             <li class="white"><?php if ( $_linea2[$key]!='') {  echo  $_linea2[$key];  } else { echo "&nbsp;"; } ?></li>
             <?php $_linea3=@json_decode(json_decode($inicio->planes)->lineas3); ?>
             <li class="grey"><?php if ( $_linea3[$key]!='') {  echo  $_linea3[$key];  } else { echo "&nbsp;"; } ?></li>
             <?php $_linea4=@json_decode(json_decode($inicio->planes)->lineas4); ?>
             <li class="white"><?php if ( $_linea4[$key]!='') {  echo  $_linea4[$key];  } else { echo "&nbsp;"; } ?></li>
           </ul>
           <?php $_urls=@json_decode(json_decode($inicio->planes)->urls); ?>
           <?php if ($key==0): ?>
             <a href="cursos/registrarme_al_curso_premium/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"><div class="premium_btn">Empezar</div></a>
           <?php else: ?>
            <a href="cursos/registrarme_al_curso/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"><div class="basic_btn">Empezar</div></a>
          <?php endif ?>
        </div>
      </div>

    </a>




  <?php endforeach ?>

</div>
</section>

<?php $this->load->view('view_site_footer'); ?>


<script>


  $(document).ready(function() {

    if ($('.biton').length>0) {
 //$('.plan_wrap a').eq(0).attr('href', $('.biton').attr('link').replace('registrarme_al_curso','registrarme_al_curso_premium') );
  //  $('.plan_wrap a').eq(1).attr('href', $('.biton').attr('link') );
}


});


  $('#clicto').click(function(event) {
    event.preventDefault();

 //$('.plan_wrap a').eq(0).attr('href', $(this).attr('link').replace('registrarme_al_curso','registrarme_al_curso_premium') );

   // $('.plan_wrap a').eq(1).attr('href', $(this).attr('link') );
   var body = $("html, body");
   body.animate({scrollTop:$(".registrate").offset().top-100 }, '500', 'swing', function() { });

 });




</script>

        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->
    </body>
    </html>
