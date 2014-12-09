<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Explicacion</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('view_site_css_js'); ?>
  <link rel="stylesheet" href="login/assets/css/login.css"> 

</head>
<body>
 <?php $this->load->view('view_site_header'); ?>


 <section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Gamification</h6>
    <p>Conoce cómo aprender jugando.</p>
    <div class="circle">
      <div class="circle_wrap">
        <img src="html/site/img/juegos_interactivos.png" alt="" style="width: 108px;">
      </div>
      
    </div>
  </div>            
</section>     











       <section class="explicacion">
            <div class="explicacion_wrap">
                <h2>Sistema de puntuación Campus Escala</h2>
                





                <div class="expl_txt">
                    <h3>Status</h3>
                    <p>Mientras Más puntos tengas podrás ascender de status en tu plataforma, esto te dará privilegios EXCLUSIVOS que tus compañeros no tendrán. 
                    </p>
                </div>
                <ul class="expl_tab expl_title clear">
                    <li class="expl_col1">Status</li>
                    <li class="expl_col2">Pts</li>
                    <li class="expl_col3">Privilegios</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1"><img src="html/site/img/status_1.png" alt=""><p>Nuevo</p></li>
                    <li class="expl_col2">0</li>
                    <li class="expl_col3">Todos iniciamos siendo nuevos, es el primer status que tendrás.</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1"><img src="html/site/img/status_2.png" alt=""><p>Experto</p></li>
                    <li class="expl_col2">50</li>
                    <li class="expl_col3">Tus compañeros verán en las discusiones que eres todo un experto en lo que dices y aportas.</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1"><img src="html/site/img/status_3.png" alt=""><p>Campeón</p></li>
                    <li class="expl_col2">100</li>
                    <li class="expl_col3">Es el estatus de mayor conocimiento en la plataforma, tendrás el privilegio de crear y fomentar tus propias discusiones.</li>
                </ul>








                <div class="expl_txt">
                    <img src="html/site/img/icono_16.png" alt="">
                    <h3>Puntaje:</h3>
                    <p>Nuestras calificaciones se miden por puntos, a medida que avances en tu aprendizaje irás ganando más y más... 
                    </p>
                </div>
        
                <ul class="expl_tab expl_title clear">
                    <li class="expl_col1">Tarea</li>
                    <li class="expl_col2">Pts</li>
                    <li class="expl_col3">Comentarios</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1">Primer curso matriculado</li>
                    <li class="expl_col2">+10</li>
                    <li class="expl_col3">Solo sucede una vez</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1">Primera actividad finalizada</li>
                    <li class="expl_col2">+10</li>
                    <li class="expl_col3">Solo sucede una vez</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1">Actividades finalizadas</li>
                    <li class="expl_col2">+1</li>
                    <li class="expl_col3">Cada actividad otorga este puntaje</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1">Compartir premio en tus redes sociales</li>
                    <li class="expl_col2">+2</li>
                    <li class="expl_col3">Por Facebook +2 y por Twitter +2</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1">Evaluación</li>
                    <li class="expl_col2">Max. +10</li>
                    <li class="expl_col3">Dependiendo el resultado obtenido, máximo +10</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1">Más del 15% de la comunidad da me encanta a tu participación</li>
                    <li class="expl_col2">+10</li>
                    <li class="expl_col3">Aplica por cada discusión</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1">Más del 10% de la comunidad da me encanta a tu participación</li>
                    <li class="expl_col2">+5</li>
                    <li class="expl_col3">Aplica por cada discusión</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1">Más del 5% de la comunidad da me encanta a tu participación</li>
                    <li class="expl_col2">+3</li>
                    <li class="expl_col3">Aplica por cada discusión</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1">Curso finalizado con certificado</li>
                    <li class="expl_col2">+20</li>
                    <li class="expl_col3">Solo aplica para plan estándar</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1">+5 días sin ingresar a la plataforma</li>
                    <li class="expl_col2">-2* día</li>
                    <li class="expl_col3">Después del 5to día te restaremos puntos.                    </li>
                </ul>









                 <div class="expl_txt">
                    <h3>Recompensas</h3>
                    <p>Al finalizar cada módulo con éxito recibirás una caja sorpresa, allí podrás encontrar distintos premios. 
                    </p>
                </div>
                <ul class="expl_tab expl_title clear">
                    <li class="expl_col1">Recompensa</li>
                    <li class="expl_col2">Pts</li>
                    <li class="expl_col3">Privilegios</li>
                </ul>
                <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1"><img src="html/site/img/icono_17.png" alt=""><p>Sorpresa</p></li>
                    <li class="expl_col2">0</li>
                    <li class="expl_col3">En esta caja sorpresa podrás encontrar diversos premios.</li>
                </ul>
                <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1"><img src="html/site/img/icono_8.png" alt=""><p>Bonos</p></li>
                    <li class="expl_col2">+puntos</li>
                    <li class="expl_col3">podrás recibir bonos cargados de puntos.</li>
                </ul>
                  <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1"><img src="html/site/img/icono_11.png" alt=""><p>Buena suerte</p></li>
                    <li class="expl_col2">0</li>
                    <li class="expl_col3">El logro a la buena suerte lo podrás ganar en una caja sorpresa.</li>
                </ul>
                  <ul class="expl_tab clear" id="expl_gray">
                    <li class="expl_col1"><img src="html/site/img/status_3.png" alt=""><p>Crea discusión</p></li>
                    <li class="expl_col2">0</li>
                    <li class="expl_col3">podrás crear una discusión en caso de no ser usuario campeón.</li>
                </ul>
                 <ul class="expl_tab clear" id="expl_white">
                    <li class="expl_col1"><img src="html/site/img/icono_13.png" alt=""><p>Contenido Premium</p></li>
                    <li class="expl_col2">0</li>
                    <li class="expl_col3">podrás ver contenido Premium, en caso de no serlo.</li>
                </ul>








            </div>
        </section>
        









<?php $this->load->view('view_site_footer'); ?>
        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->


      <script>

        $(document).ready(function() {

         
        });

      </script>

    </body>
    </html>
