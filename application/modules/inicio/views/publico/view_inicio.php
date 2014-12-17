<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <base href="<?=base_url()?>" /> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $inicio->titulo; ?> | <?php echo $custom_sistema->nombre_sistema; ?></title>
    <meta name="description" content="<?php echo $inicio->descripcion; ?>">
    <meta name="keywords" content="<?php echo $inicio->keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php $this->load->view('view_site_css_js'); ?>
</head>
<body>
 <?php $this->load->view('view_site_header'); ?>

 <!--SECCIÓN ATRIBUTOS-->
 <section class="atributos clear" <?php if ($inicio->foto_banner!='') { ?> style="background: url('uploads/pagina_inicio/<?php echo $inicio->foto_banner; ?>') left center no-repeat fixed;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;" 
 <?php }  ?>>



 

    <h3> <?php echo $inicio->slogan; ?> </h3>


    <div class="atributos_wrap clear">

        <div id="atr_slider clear mobile-visible">
            <div class="atr_slider_wrap">
                <div class="atr_mobile_blocks clear">
                 <?php foreach ( json_decode(json_decode($inicio->cajas)->titulos) as $key => $value): ?>
                     <?php $_atributos_fotos=json_decode(json_decode($inicio->cajas)->atributo_fotos); ?>
                     <div class="atr_mobile_block">
                        <div class="atr_mobile_block_wrap">
                            <img src="uploads/pagina_inicio/<?php echo $_atributos_fotos[$key]->{"atributo_foto".($key+1)}; ?>" alt="contenidos de calidad">
                            <h2><?php echo $value->{"atributo_titulo".($key+1)}; ?></h2>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>




    <?php foreach ( json_decode(json_decode($inicio->cajas)->titulos) as $key => $value): ?>
        <div class="atributo <?php if ($key<2)  {   ?> mobile-hider <?php } else { ?>atributo_third<?php } ?> mobile-hider">
            <div class="atributo_wrap">
                <?php $_atributos_fotos=json_decode(json_decode($inicio->cajas)->atributo_fotos); ?>
                <img src="uploads/pagina_inicio/<?php echo $_atributos_fotos[$key]->{"atributo_foto".($key+1)}; ?>" alt="contenidos de calidad">
                <h2><?php echo $value->{"atributo_titulo".($key+1)}; ?></h2>
                <?php $_contenido=json_decode(json_decode($inicio->cajas)->contenidos); ?>
                <p><?php echo $_contenido[$key]->{"atributo_contenido".($key+1)}; ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>
<a href="<?php echo json_decode($inicio->ver_cursos)->boton_url; ?>">  <div class="ver_cursos"><?php echo json_decode($inicio->ver_cursos)->boton_nombre; ?> </div></a>

</section>

<section class="cursos_destacados">
    <h4><?php echo $inicio->titulo_destacados; ?></h4>
    <h5><?php echo $inicio->descripcion_destacados; ?></h5>
    <div class="cursos_destacados_wrap clear" <?php if (count($cursos_destacados)==1): ?>  <?php elseif (count($cursos_destacados)==2): ?>   <?php endif ?>>
        <?php foreach ($cursos_destacados as $key => $value): ?>
            <div class="curso">
                <div class="curso_wrap">
                    <div class="curso_pic">

                        <img src="escalar.php?src=<?php echo base_url(); ?>uploads/cursos/<?php echo $value->foto; ?>&amp;w=306&amp;h=218&amp;zc=1" alt="><?php echo $value->titulo; ?>">
                    </div>
                    <div class="curso_des">
                        <h2><?php echo $value->categoria_cursos; ?></h2>
                        <p><?php echo $value->titulo; ?></p>
                    </div>      
                    <a href="cursos/detalle/<?php echo $value->id_cursos; ?>/<?php echo amigable($value->titulo); ?>.html"> <div class="curso_btn <?php if ($value->id_tipo_planes!=1) { echo " color2"; } ?>"> Entrar <?php #echo $value->tipo_plan; ?></div> </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>

<section class="registrate">
    <h4><?php echo $inicio->titulo_registrate; ?></h4>
    <div class="registrate_wrap clear">
        <?php foreach ($tipo_planes as $key => $value): ?>
  <?php $_urls=@json_decode(json_decode($inicio->planes)->urls); ?>
            <?php if ($key==0): ?>
               <a href="<?php echo $_urls[$key]; ?>">
               <?php else: ?>
                <a href="<?php echo $_urls[$key]; ?>">
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
                       <a href="<?php echo $_urls[$key]; ?>"><div class="premium_btn">Empezar</div></a>
                   <?php else: ?>
                    <a href="<?php echo $_urls[$key]; ?>"><div class="basic_btn">Empezar</div></a>
                <?php endif ?>
            </div>
        </div>
    </a>



<?php endforeach ?>

</div>
</section>



<section class="testimonial"  id="div3">
    <div class="testimonial_wrap clear">
        <h4><?php echo json_decode($inicio->titulo_testimonios)->titulo_testimonios; ?></h4>
        <p class="test_p"><?php echo json_decode($inicio->titulo_testimonios)->des_testimonios; ?></p>
        <div class="test_block_wrap">

            <?php foreach (json_decode(json_decode($inicio->testimonios)->nombres_completos) as $key => $value): ?>

                <div class="<?php if ($key<2) { ?> testi_block <?php } else { ?> testi_block_no_margin <?php } ?> clear">
                    <div class="test_edge">                              
                    </div>
                    <div class="testi_block_wrap clear">
                        <p> <?php $_texto_testimonio=json_decode(json_decode($inicio->testimonios)->texto_testimonio); ?>
                            “<?php echo $_texto_testimonio[$key]->{"txt_testimonio".($key+1)}; ?>”
                        </p>
                    </div>
                    <div class="testi_pep clear">
                        <div class="pep clear">
                            <div class="pep_pic">


                                <?php $_testi_fotos=json_decode(json_decode($inicio->testimonios)->testi_fotos); ?>
                                <?php $_nombres_completos=json_decode(json_decode($inicio->testimonios)->nombres_completos); ?>
                                <img src="uploads/pagina_inicio/<?php echo $_testi_fotos[$key]->{"testi_foto".($key+1)}; ?>" alt="<?php echo $_nombres_completos[$key]->{"testi_nombres_completos".($key+1)}; ?>">
                            </div>
                            <div class="pepName">
                                <?php $_nombres_completos=json_decode(json_decode($inicio->testimonios)->nombres_completos); ?>
                                <h5><?php echo $_nombres_completos[$key]->{"testi_nombres_completos".($key+1)}; ?></h5>
                                <?php $_profesion=json_decode(json_decode($inicio->testimonios)->profesion); ?>
                                <p><?php echo $_profesion[$key]->{"testi_profesion".($key+1)}; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>

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
