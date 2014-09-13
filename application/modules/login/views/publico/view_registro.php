<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
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
       
 
<section class="registrate">
  <h4>Regístrate</h4>
  <div class="registrate_wrap clear">




    <?php foreach ($tipo_planes as $key => $value): ?>

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

  <?php endforeach ?>

</div>
</section>







       <section class="testimonial"  id="div3">
                <div class="testimonial_wrap clear">
                    <h4>+8 países +1000 profesionales certificados</h4>
                    <p class="test_p">Ellos han estudiado en Escala Online y estos son sus comentarios tras haber vivido nuestra experiencia de aprendizaje online.</p>
                    <div class="test_block_wrap">
                        <div class="testi_block clear">
                            <div class="test_edge">                              
                            </div>
                            <div class="testi_block_wrap clear">
                                <p>
                                “Decidí hacer el curso de Liderazgo integral y en 2 meses mi vida profesional ha evolucionado como nunca antes.”
                                </p>
                            </div>
                            <div class="testi_pep clear">
                                <div class="pep clear">
                                    <div class="pep_pic">
                                        <img src="img/per1.png" alt="Person Testimonial one">
                                    </div>
                                    <div class="pepName">
                                        <h5>Mary Smith</h5>
                                        <p>@marysmith</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="testi_block clear">
                            <div class="test_edge">                              
                            </div>
                            <div class="testi_block_wrap clear">
                                <p>
                                ”Describiría a Escala como el lugar que me permitió descubrir mis capacidades y potencializarlas al máximo.”
                                </p>
                            </div>
                            <div class="testi_pep clear">
                                <div class="pep clear">
                                    <div class="pep_pic">
                                        <img src="img/per2.png" alt="Person Testimonial one">
                                    </div>
                                    <div class="pepName">
                                        <h5>Mary Smith</h5>
                                        <p>@marysmith</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testi_block_no_margin clear">
                            <div class="test_edge">                              
                            </div>
                            <div class="testi_block_wrap clear">
                                <p>
                                “Soy gerente comercial de una reconocida multinacional y en Escala superaron mis expectativas de desarrollo profesional y ejecutivo.”
                                </p>
                            </div>
                            <div class="testi_pep clear">
                                <div class="pep clear">
                                    <div class="pep_pic">
                                        <img src="img/per3.png" alt="Person Testimonial one">
                                    </div>
                                    <div class="pepName">
                                        <h5>Mary Smith</h5>
                                        <p>@marysmith</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
