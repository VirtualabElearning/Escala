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
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url(); ?>html/site/css/normalize.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>html/site/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>color.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>html/site/css/custom.css">


  <script src="<?php echo base_url(); ?>html/site/js/vendor/modernizr-2.6.2.min.js"></script>
  <?php //  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> ?>
  <script src="html/site/js/jquery-1.7.2.min.js"></script>




  <script type="text/javascript" src="<?php echo base_url(); ?>html/site/js/functions.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>html/site/js/custom.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>customjs.js"></script>
  <script src="html/site/js/jquery-1.9.1.js"></script>

  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>

    window.addEventListener("load", function(){
      var load_screen = document.getElementById("load_screen");
      document.body.removeChild(load_screen);
    });
  </script>
  <script type="text/javascript">

    $(document).ready(function(){
      setMenuActive(3);
    });

  </script>


  <script src="html/site/js/isotope.pkgd.min.js"></script>

</head>
<body> 

  <?php $this->load->view('view_site_header'); ?>





  <div class="backdrop"></div>

  <?php ###################### caja sorpresa que sale solo al terminar cada modulo ################ ?>
  <div class="box_container">
    <div class="box">
      <div class="close">x</div>
      <h3>¡FELICITACIONES</h3>
      <div class="premio_img">
        <img src="<?php echo base_url(); ?>html/site/img/premio.png" alt="" id="surprise_result">
        <img src="<?php echo base_url(); ?>/html/site/img/sorpresa.gif" alt="" id="surprise_box">
      </div>
      <p>Ganaste <span></span>.</p>
      <div class="share_block">
        <h4>Compartir</h4>
        <ul class="share_icons clear">
          <li> <a onclick="window.open(this.href, this.target, 'width=600,height=600'); return false" id="fblink" class="sharerpoint" target="_blank" href="xxx"><img src="<?php echo base_url(); ?>html/site/img/face_icon_s.png" alt=""></a> </li>
          <li><a onclick="window.open(this.href, this.target, 'width=600,height=600'); return false" id="twlink" class="sharerpoint" target="_blank" class="btn share-twitter" data-via="<?php echo $custom_sistema->nombre_sistema; ?>" data-url="xxxx" href="https://twitter.com/share"><img src="<?php echo base_url(); ?>html/site/img/tweet_icon_s.png" alt=""></a></li>
        </ul>
      </div>
    </div>
  </div>











  <?php ##### sale cuando termino una actividad como si fuera un video ?>
  <section class="actividad_aprobada"></section>
  <div class="actividad_aprobada_wrap">
    <h3>+<?php echo $puntos_por_actividad; ?></h3>
    <h4>Buen trabajo</h4>
  </div>


  <?php ##solo si es evaluacion!!!!!! ?>
  <section class="actividad_aprobada2"></section>
  <div class="actividad_aprobada_wrap actividad_eval">
    <h3>+<?php echo $puntos_por_actividad; ?></h3>
    <h4>Buen trabajo</h4>
  </div>

  <?php ##### solo sale cuando es su primer curso ?>
  <?php if ($tiene_primer_curso=='si'): ?> 
    <div class="box_container">
     <div class="box2">
      <div class="close2">x</div>
      <h3>¡FELICITACIONES!</h3>
      <div class="premio_img">
        <div id="surprise_result" style="display:block;">
          <img style="display:block;" src="<?php echo base_url(); ?>/html/site/img/premio.png" alt="">
          <span style="top: 42px;">+<?php echo $puntos_primer_curso_ganados; ?></span>
        </div>
      </div>
      <p>Ganaste <?php echo $puntos_primer_curso_ganados; ?> puntos por matricularte a tu primer curso,
        te faltan <?php echo $minimo_faltante_a_experto; ?> puntos para ser <?php echo $estatus_proximo->nombre; ?>.</p>
      </div>
    </div>
  <?php endif ?>




  <?php ##ventana para primera actividad realizada y mostrar el analisis del esatus ?>
  <div class="box_container">
    <div class="box3">
      <div class="close3">x</div>
      <h3>¡FELICITACIONES!</h3>
      <div class="premio_img">

        <div id="surprise_result" style="display:block;">
          <img style="display:block;" src="<?php echo base_url(); ?>/html/site/img/premio.png" alt="">
          <span class="sp5" style="top: 42px;">+{puntos}</span>
        </div>

      </div>
      <p>Ganaste <span class="sp1">{punts}</span> puntos por <span class="sp4">{motivo}</span>,
        te faltan <span class="sp2">{restantes}</span> puntos para ser <span class="sp3">{prox_status}</span>.</p>
      </div>
    </div>




    <?php ### ventana para los motivos de medalla y posiblemente para cuando aumente en puntos y cambie de estatus, mostrar a que estatus pasé ?>
    <div class="box_container">
      <div class="box4">
        <div class="close4">x</div>
        <h3>¡FELICITACIONES!</h3>
        <div class="premio_img">

          <div id="surprise_result" style="display:block;">
            <img style="display:block;" src="<?php echo base_url(); ?>/html/site/img/premio.png" alt="">
            <span class="sp5" style="top: 42px;">+{puntos}</span>
          </div>

        </div>
        <p class="motivo_medalla">{motivo de la medalla}</p>
      </div>
    </div>


    <a <?php if ( $mi_plan_actual==$this->config->item('Estandar'))  { ?> onclick=" alert ('Lo siento, debes ser usuario premium para enviar mensajes.'); return false;" <?php } ?> <?php if ( $mi_plan_actual==$this->config->item('Premium')) { ?> id="btn3" <?php } ?>>
      <div class="question_btn">
        <div class="question_btn_wrap">
          <img src="html/site/img/question_icon.png" alt="Pregunta">
          <h6>Pregunta</h6>
        </div>
      </div>
    </a>



    <section class="question">
      <div class="question_wrap">
        <h5>Pregunta al facilitador</h5>
        <h6 class="hider">Tu pregunta ha sido enviada con éxito, recibirás la notificación de respuesta en tus mensajes de entrada <img src="html/site/img/inbox_icon.png" alt=""></h6>
        <textarea name="" id="pregunta" cols="30" rows="10" placeholder="Escribe tu pregunta"></textarea>
        <a href="#" id="enviar_pregunta">  <div class="send_question">Enviar </div></a>
      </div>
    </section>

    <section class="encabezado clear">
      <div class="encabezado_wrap">
        <h6><?php echo $detalle_curso->categoria_cursos; ?></h6>
        <p><?php echo $detalle_curso->titulo; ?></p>
        <div class="circle">
          <div class="circle_wrap">
            <img src="html/site/img/<?php echo $detalle_curso->miestatus; ?>.png" alt="<?php echo $detalle_curso->miestatusnombre; ?>" title="<?php echo $detalle_curso->miestatusnombre; ?>">
          </div>
        </div>
      </div>            
    </section>

    <?php #krumo ($detalle_curso); ?>
    <?php #krumo ($detalle_curso->modulos_vistos_arr); ?>
    <?php #krumo ($detalle_curso->actividad_actual); ?>


    <?php #krumo ($detalle_curso->actividades); ?>



    <?php #krumo ($detalle_curso->actividades); ?>
    <?php #krumo ($detalle_curso->actividades_vistas); ?>

    <?php #krumo (json_decode($detalle_curso->actividad_actual->variables_pregunta)); ?>
    <?php #krumo ($detalle_curso->actividad_actual->pregunta); ?>
    <?php #krumo ($detalle_curso->actividad_actual->tipo_pregunta); ?>
    <?php #krumo ($detalle_curso->actividad_actual->id_actividades_videos); ?>























    <section class="aula">
      <div class="aula_wrap clear">

        <div class="col1 clear">
          <div class="activity_title">
           <h3><?php echo $detalle_curso->actividad_actual->nombre_actividad; ?></h3>
         </div>
         <div class="activities">
          <?php ############ variable para saber si tengo o no videos en el sistema #################### ?>
          <?php $tiene_videos=0; ?> 

          <?php #krumo ($detalle_curso->actividades); ?>

          <?php $contador=0; ?>
          <?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>

            <?php ################################ <si es video> #######################################################?>
            <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
              <?php $tiene_videos=1; ?>
              <div style="<?php if ($contador==0) { echo "display:block;"; } else { echo "display:none;";  } ?>" class="vvideo video_main<?php echo $actividades_value->id_actividades; ?>" id="video<?php echo $actividades_value->id_actividades_barra; ?>">
                <div class="video_wrap">
                 <div id="player<?php echo $actividades_value->id_actividades; ?>"></div>
               </div>

               <?php ##obtengo si tiene pregunta rapida y si tiene respuestas de la pregunta rapida para que no la vuelva a repetir
               $variables_pregunta=json_decode($actividades_value->info_extra->variables_pregunta);
               $variables_respuestas=json_decode($actividades_value->info_extra->respuestas_usuario->respuestas);
               #krumo ($actividades_value->info_extra);
               if ($actividades_value->info_extra->tipo_pregunta!='') {
                $cuantas_correctas=0;
                if ($variables_pregunta) {
                  foreach ($variables_pregunta as $variables_preguntakey => $variables_preguntavalue) {
                    if ($variables_preguntavalue->correcta==1) {
                      $cuantas_correctas++;
                    }
                  }
                }
                ?>

                <div class="evaluacion_wrap pregunta_rapida" id="pregunta_rapida<?php echo $actividades_value->id_actividades_barra; ?>">
                  <?php if ($variables_respuestas==''): ?>  <?php #si no tiene respuestas en la pregunta rapida ?>
                    <div class="evaluacion_preg">
                      <p><?php echo $actividades_value->info_extra->pregunta; ?></p>


                      <?php $sinpreguntarapida=0; ?>
                      <?php switch ($actividades_value->info_extra->tipo_pregunta) {
                        case $pregunta_tipo_test:
                        ?>
                        <?php 
                        ## si es mayor a 1, es checkbox, si no, es radio
                        if ($cuantas_correctas>1) { echo '<form id="form'.$actividades_value->id_actividades_barra.'">';
                        foreach ($variables_pregunta as $variables_preguntakey => $variables_preguntavalue) {
                          ?>
                          <input type="checkbox" class="checkp<?php echo $actividades_value->id_actividades_barra; ?>" value="<?php echo $variables_preguntavalue->posible_respuesta; ?>" name="<?php echo amigable($actividades_value->info_extra->pregunta)."_".$variables_preguntakey; ; ?>" id="<?php echo amigable($actividades_value->info_extra->pregunta)."_".$variables_preguntakey; ?>"><span><?php echo $variables_preguntavalue->posible_respuesta; ?></span><br>
                          <?php } 
                          echo "</form>";
                        } else {  
                         echo '<form id="form'.$actividades_value->id_actividades_barra.'">';
                         foreach ($variables_pregunta as $variables_preguntakey => $variables_preguntavalue) { ?>
                         <input type="radio" class="radiop<?php echo $actividades_value->id_actividades_barra; ?>" value="<?php echo $variables_preguntavalue->posible_respuesta; ?>"  name="<?php echo amigable($actividades_value->info_extra->pregunta); ?>" id="<?php echo amigable($actividades_value->info_extra->pregunta); ?>"><span><?php echo $variables_preguntavalue->posible_respuesta; ?></span><br>
                         <?php } 
                         echo "</form>";
                       } ?>
                       <?php
                       break;

                       case $pregunta_elegir_de_una_lista:
                       echo '<form id="form'.$actividades_value->id_actividades_barra.'">';
                       ?>
                       <select id="<?php echo amigable($actividades_value->info_extra->pregunta); ?>" name="<?php echo amigable($actividades_value->info_extra->pregunta); ?>" class="list<?php echo $actividades_value->id_actividades_barra; ?>">
                        <?php foreach ($variables_pregunta as $variables_preguntakey => $variables_preguntavalue) { ?>
                        <option value="<?php echo amigable($variables_preguntavalue->posible_respuesta); ?>"><?php echo $variables_preguntavalue->posible_respuesta; ?></option>
                        <?php }  ?>
                      </select>
                      
                      <?php  
                      echo "</form>";  
                      break;
                      
                      case $pregunta_campo_de_texto:

                      echo '<form id="form'.$actividades_value->id_actividades_barra.'">';
                      ?>
                      <textarea class="textp<?php echo $actividades_value->id_actividades_barra; ?>" placeholder="Escribe tu respuesta" rows="10" cols="30" id="<?php echo amigable($actividades_value->info_extra->pregunta); ?>" name="<?php echo amigable($actividades_value->info_extra->pregunta); ?>"></textarea>
                      <?php       echo "</form>";
                      break;

                      ## en caso que no tenga pregunta rapida
                      default:
                      $sinpreguntarapida=1;
                      ?>
                       <?php /* ?> 
                      <div class="evaluacion_btn conti" style="display: block; margin-top: 107px;" id="evaluacion_btn_preg_cont<?php echo $actividades_value->id_actividades_barra; ?>" onclick="continuar(<?php echo $actividades_value->id_actividades_barra; ?>);">Continuar</div>
                      <?php */ ?>

                      <div class="evaluacion_btn" id="evaluacion_btn_preg<?php echo $actividades_value->id_actividades_barra; ?>" onclick="caja_puntos(<?php echo $motivo_puntos_por_actividad; ?>,<?php echo $puntos_por_actividad; ?>,<?php echo $actividades_value->id_actividades_barra; ?>);" id="evaluacion_btn_vid<?php echo $actividades_value->id_actividades; ?>">Continuar</div>

                      <?php
                      break;

                    } ?>

                  </div>
                  
                  <?php if ( $sinpreguntarapida==0): ?>
                    <?php ## boton de enviar respuesta de la pregunta rapida ?>
                    <div class="evaluacion_btn" id="evaluacion_btn_preg<?php echo $actividades_value->id_actividades_barra; ?>" onclick="caja_puntos(<?php echo $motivo_puntos_por_actividad; ?>,<?php echo $puntos_por_actividad; ?>,<?php echo $actividades_value->id_actividades_barra; ?>);" id="evaluacion_btn_vid<?php echo $actividades_value->id_actividades; ?>">Enviarx</div>
                  <?php endif; ?>

                  <div class="evaluacion_btn conti" id="evaluacion_btn_preg_cont<?php echo $actividades_value->id_actividades_barra; ?>" onclick="continuar(<?php echo $actividades_value->id_actividades_barra; ?>);">Continuar</div>

                <?php else: ?>
                 <div class="evaluacion_btn conti" style="display: block; margin-top: 107px;" id="evaluacion_btn_preg_cont<?php echo $actividades_value->id_actividades_barra; ?>" onclick="continuar(<?php echo $actividades_value->id_actividades_barra; ?>);">Continuar</div>
               <?php endif; ?>  <?php ##fin si no tiene respuestas en la pregunta rapida ?>

             </div>
             <?php } ?>

           </div>
         <?php endif ?>
         <?php ################################ </si es video> #######################################################?>




         <?php ################################ <si es evaluacion> #######################################################?>
         <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Evaluacion')): ?>

          <?php #krumo(($actividades_value->info_extra->num_oportunidades)); ?>

          <div style="<?php if ($contador==0) { echo "display:block;"; } else { echo "display:none;";  } ?>" class="evaluacion" id="evaluacion<?php echo $actividades_value->id_actividades_barra; ?>">
            <div class="evaluacion_wrap">

              <?php foreach (json_decode($actividades_value->info_extra->variables_pregunta) as $varpkey => $varpvalue) {
                $activar_evalx=0;

                ## evaluo que tenga habilitado el numero de oportunidades y tambien si es mayor a cero la cantidad de oportunidades que tenga
                #en el examen.
                
                if ($actividades_value->info_extra->num_oportunidades>0 && $actividades_value->info_extra->oportunidades>0) {
                  $activar_evalx=1;
                }
                 ## si está ilimitado, ponerlo en 1 tambien para activar el examen
                elseif ($actividades_value->info_extra->num_oportunidades=='ilimitatu')  { $activar_evalx=1; }


                # print_r($actividades_value->info_extra);
                 #echo $actividades_value->info_extra->num_oportunidades."<br>";
                 #echo $activar_evalx."<br><br><br><br>"; 


                if ($activar_evalx>0) {

                  switch ($varpvalue->tipo_pregunta) {
                    case $pregunta_tipo_test:
                    $cuantas_correctas_eval=0;

                    foreach (json_decode($varpvalue->variables_respuesta) as $tmpckey => $tmpcvalue) {
                      if ($tmpcvalue->correcta==1) {
                        $cuantas_correctas_eval++;
                      }

                    }

                    ?>
                    <?php 
                        ## si es mayor a 1, es checkbox, si no, es radio
                    if ($cuantas_correctas_eval>1) { echo '
                      <div class="evaluacion_preg"><p>'.$varpvalue->pregunta.'</p> <span style="display:none;">'.$varpvalue->id_competencias.'</span>
                        <form id="form'.$actividades_value->id_actividades_barra.'">';
                          foreach (json_decode($varpvalue->variables_respuesta) as $variables_preguntakey => $variables_preguntavalue) {
                            ?>
                            <input type="checkbox" class="checkp_v<?php echo $actividades_value->id_actividades_barra; ?>" value="<?php echo $variables_preguntavalue->opcion; ?>|<?php echo $variables_preguntavalue->retroalimentacion; ?>|<?php echo $variables_preguntavalue->correcta; ?>" name="<?php echo amigable($varpvalue->pregunta)."_".$variables_preguntakey; ; ?>" id="<?php echo amigable($varpvalue->pregunta)."_".$variables_preguntakey; ?>"><span><?php echo $variables_preguntavalue->opcion; ?></span><br>
                            <?php } 
                            echo "</form> </div>";
                          } else {  
                            echo '<div class="evaluacion_preg"><p>'.$varpvalue->pregunta.'</p> <span style="display:none;">'.$varpvalue->id_competencias.'</span> <form id="form'.$actividades_value->id_actividades_barra.'">';
                            foreach (json_decode($varpvalue->variables_respuesta) as $variables_preguntakey => $variables_preguntavalue) { ?>
                            <input type="radio" class="radiop_v<?php echo $actividades_value->id_actividades_barra; ?>" value="<?php echo $variables_preguntavalue->opcion; ?>|<?php echo $variables_preguntavalue->retroalimentacion; ?>|<?php echo $variables_preguntavalue->correcta; ?>" name="<?php echo amigable($varpvalue->pregunta); ?>" id="<?php echo amigable($varpvalue->pregunta); ?>"><span><?php echo $variables_preguntavalue->opcion; ?></span><br>
                            <?php } 
                            echo "</form></div>";
                          } ?>
                          <?php 
                          break;

                          case $pregunta_elegir_de_una_lista:
                          echo '<div class="evaluacion_preg"><p>'.$varpvalue->pregunta.'</p> <span style="display:none;">'.$varpvalue->id_competencias.'</span> <form id="form'.$actividades_value->id_actividades_barra.'">';
                          ?>
                          <select id="<?php echo amigable($varpvalue->pregunta); ?>" name="<?php echo amigable($varpvalue->pregunta); ?>" class="list_v<?php echo $actividades_value->id_actividades_barra; ?>">
                            <?php foreach (json_decode($varpvalue->variables_respuesta) as $variables_preguntakey => $variables_preguntavalue) { ?>
                            <option value="<?php echo amigable($variables_preguntavalue->opcion); ?>|<?php echo $variables_preguntavalue->retroalimentacion; ?>|<?php echo $variables_preguntavalue->correcta; ?>"><?php echo $variables_preguntavalue->opcion; ?></option>
                            <?php }  ?>
                          </select>

                          <?php  
                          echo "</form></div>";   
                          break;

                          case $pregunta_campo_de_texto:
                          $var_txtv=json_decode($varpvalue->variables_respuesta);
                          $var_txtv=$var_txtv[0];

                          echo '<div class="evaluacion_preg"><p>'.$varpvalue->pregunta.'</p><span style="display:none;">'.$varpvalue->id_competencias.'</span><form id="form'.$actividades_value->id_actividades_barra.'">';
                          ?>
                          <textarea class="textp_v<?php echo $actividades_value->id_actividades_barra; ?>" placeholder="<?php echo $var_txtv->texto; ?>" retro="<?php echo $var_txtv->retroalimentacion; ?>" rows="10" cols="30" id="<?php echo amigable($varpvalue->pregunta); ?>" name="<?php echo amigable($varpvalue->pregunta); ?>"></textarea>
                          <?php       echo "</form></div>"; 
                          break;
                       } ## fin switch

                      }   ## fin si tengo oportunidades 

            }  ##fin foreach de preguntas

            ?>

            <?php ## evaluo boton si es enviar o continuar dependiendo de las oportunidades que se tenga ?>
            <?php   if ($activar_evalx>0) { ?>
            <div class="evaluacion_btn evaluacion_btn_v" id="v<?php echo $actividades_value->id_actividades_barra; ?>v" onclick="send_eval(<?php echo $motivo_puntos_por_actividad; ?>,<?php echo $puntos_por_actividad; ?>,<?php echo $actividades_value->id_actividades_barra; ?>);">Enviar</div>
            <?php } else { ?>
            <div onclick="continuar(<?php echo $actividades_value->id_actividades_barra; ?>);" class="evaluacion_btn cont_resp_eval"> Continuar </div>
            <?php } ?>
          </div>
        </div>






        <div  class="evaluacion_r" style="<?php if ($contador==0) { echo "display:none;"; } else { echo "display:none;";  } ?>" id="respuesta<?php echo $actividades_value->id_actividades_barra; ?>">
          <div class="evaluacion_wrap">



            <h2>+25 puntos</h2>
            <ul class="clear" id="compes_li<?php echo $actividades_value->id_actividades_barra; ?>">

              <?php foreach ($detalle_curso->competencias_curso as $key => $value): ?>
                <li><p id="eva_50" style="border-top: 1pt solid #5fcf80;"><?php echo $value->nombre; ?></p></li>
              <?php endforeach ?>


            </ul>
            <p class="bien">{data}</p>
            <div class="retro"><span>{data}</span> </div>
            <p class="mal">{data}</p>

            

            <div onclick="reload_eval(<?php echo $actividades_value->id_actividades_barra; ?>);" class="volver"> Volver a intentar </div>

            <div class="evaluacion_btn cont_resp_eval" onclick="continuar(<?php echo $actividades_value->id_actividades_barra; ?>);">Continuar</div>


          </div>
        </div>



      <?php endif ?>
      <?php ################################ </si es evaluacion> #######################################################?>




      <?php ################################ <si es foro> #######################################################?>
      <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Foro')): ?>


        <?php #krumo($actividades_value); ?>

        <div style="<?php if ($contador==0) { echo "display:block;"; } else { echo "display:none;";  } ?>" class="discusion" id="discusion<?php echo $actividades_value->id_actividades_barra; ?>">
          <div class="discusion_wrap">
           <?php $instructor_var=$actividades_value->info_extra->creador_foro;  ?> 
           <?php 
           if (file_exists( FCPATH.'uploads/instructores/'.$instructor_var->foto))  {
            $foto_docente='uploads/instructores/'.$instructor_var->foto;
          }

          # si es un estudiante
          elseif (file_exists(FCPATH.'uploads/aprendices/'.$instructor_var->foto))  {
            $foto_docente='uploads/aprendices/'.$instructor_var->foto;

          }

          # si es un usuario de sistema
          elseif (file_exists(FCPATH.'uploads/usuarios/'.$instructor_var->foto))  {
            $foto_docente='uploads/usuarios/'.$instructor_var->foto;

          }
          #sabado
#echo "perro".$instructor_var->foto;
          ?>

          <div class="disc_block_A">
            <div class="disc_block_A_wrap clear">
              <div class="disc_block_A_col1">
                <img src="<?php echo base_url().$foto_docente; ?>" alt="">
                <h4><?php echo $instructor_var->nombres; ?> <?php echo $instructor_var->apellidos; ?></h4>

                <?php  #si es un docente
                if (file_exists( FCPATH.'uploads/instructores/'.$instructor_var->foto))  { ?>
                <h5><?php echo asignar_frase_diccionario ($detalle_curso->diccionario,'{docente}','Instructor',1); ?></h5>
                <?php } ?>

          <?php # si es un estudiante
          if (file_exists(FCPATH.'uploads/aprendices/'.$instructor_var->foto))  { ?>
          <h5><?php echo asignar_frase_diccionario ($detalle_curso->diccionario,'{estudiante}','Aprendiz',1); ?></h5>
          <?php } ?>

          <?php # si es un usuario de sistema
          if (file_exists(FCPATH.'uploads/usuarios/'.$instructor_var->foto))  { ?>
          <h5><?php echo asignar_frase_diccionario ($detalle_curso->diccionario,'{administrador}','Usuario',1); ?></h5>
          <?php  } ?>





          <?php #evaluo si puedo dar megusta o no puedo dar me gusta ?>
          <?php $if_megusta=0; $megustas_total_docente=0; ?>
          <?php foreach ($actividades_value->info_extra->me_encantas as $me_encantas_key => $me_encantas_value): ?>
            <?php if ($me_encantas_value->id_usuario_modificado==$this->encrypt->decode($this->session->userdata('id_usuario'))): ?>
              <?php $if_megusta=1; ?>
            <?php endif ?>
            <?php $megustas_total_docente++; ?>
          <?php endforeach ?>


          <a class="meencantar" docente="<?php echo $actividades_value->info_extra->id_usuario_modificado; ?>" id="<?php echo $actividades_value->id_actividades_barra; ?>" dhref="<?php echo base_url(); ?>cursos/dar_meencanta">
            <div class="<?php if ($if_megusta==0): ?>kudos <?php else: ?> kudos_off <?php endif ?>"><p class="meencanta_docente meencanta_docente<?php echo $actividades_value->id_actividades_barra; ?>"><?php echo $megustas_total_docente; ?></p></div>
          </a>






        </div>
        <div class="disc_block_A_col2">
          <span><?php echo $actividades_value->info_extra->nombre_actividad; ?></span>
          <p><?php echo $actividades_value->info_extra->contenido_foro; ?></p>
        </div>
      </div>
    </div> 
    <div class="disc_estudiantes">
      <?php foreach ($actividades_value->info_extra->mensajes_foro as $mensajes_foro_key => $mensajes_foro_value): ?>

        <?php 
        if (file_exists( FCPATH.'uploads/instructores/'.$mensajes_foro_value->foto_usuario))  { $foto_usuario='uploads/instructores/'.$mensajes_foro_value->foto_usuario; }
        else if (file_exists(FCPATH.'uploads/aprendices/'.$mensajes_foro_value->foto_usuario))  { $foto_usuario='uploads/aprendices/'.$mensajes_foro_value->foto_usuario; }
        else  { $foto_usuario='uploads/usuarios/'.$mensajes_foro_value->foto_usuario; }
        ?>

        <?php 
        ## nueva validacion de que si tiene un / es porque definitivamente no tiene una foto.
        $ultima_letra = substr($foto_usuario,-1 , 1); 
        if (  $ultima_letra=='/'  )  {
          $foto_usuario="html/site/img/sin_foto.png";
        } 
        ?>

        <div class="disc_block_B">
          <div class="disc_block_B_wrap clear">
            <div class="disc_block_B_col1 clear">
              <img src="<?php echo base_url(); ?><?php echo $foto_usuario; ?>" alt="">

              <div id="disc_status"><img src="<?php echo base_url(); ?>html/site/img/<?php echo $mensajes_foro_value->id_estatus; ?>.png"></div>
              <h4><?php echo $mensajes_foro_value->nombres; ?> <?php echo $mensajes_foro_value->apellidos; ?></h4>
              <?php #evaluo si puedo dar megusta o no puedo dar me gusta ?>
              <?php $if_megusta=0; ?>
              <?php foreach ($mensajes_foro_value->mencantas as $megustas_key => $megustas_value): ?>
                <?php if ($megustas_value->id_usuario_modificado==$this->encrypt->decode($this->session->userdata('id_usuario'))): ?>
                  <?php $if_megusta=1; ?>
                <?php endif ?>
              <?php endforeach ?>
              <a barr="<?php echo $actividades_value->id_actividades_barra; ?>" class="meencantar_estudiante" est="<?php echo $mensajes_foro_value->id_usuario_modificado; ?>" id="<?php echo $mensajes_foro_value->id_actividades_foro_mensajes; ?>" href="<?php echo base_url(); ?>cursos/dar_meencanta_estudiante">
                <div class="<?php if ($if_megusta==0): ?>kudos <?php else: ?> kudos_off <?php endif ?>"><p class="mencantas_estudiantes_todos" id="<?php echo $mensajes_foro_value->id_actividades_foro_mensajes; ?>meencanta_estudiante"><?php echo count ($mensajes_foro_value->mencantas); ?></p> </div>
              </a>

            </div>
            <div class="disc_block_B_col2">
              <p><?php echo $mensajes_foro_value->mensaje; ?></p>
            </div>
          </div>
        </div>

      <?php endforeach ?>
    </div>

    <div class="discusion_respuesta">
      <div class="discusion_respuesta_wrap">
        <textarea class="mensaje_foro" placeholder="Escribe tu respuesta" rows="10" cols="30" id="mensaje_foro" name="mensaje_foro"></textarea>
        <div class="counter_foro"></div>
        <h6>Tu mensaje ha sido enviado con éxito. Ahora indica las participaciones que te encantan.</h6>
        <a id="" class="send_foro" barra_foro="<?php echo $actividades_value->id_actividades_barra; ?>" href="#"><div class="discusion_btn"><p>Participar</p></div></a>
      </div>
    </div>








  </div>
</div>



<?php endif ?>
<?php ################################ </si es foro> #######################################################?>




<?php $contador++; ?>
<?php endforeach ?>

<div  id="crearmiforo"> 
  <div class="disc_block_A">



    <div class="disc_block_A_wrap clear">


      <?php #sabado ?>


      <div class="disc_block_A_col1">
        <img src="<?php echo base_url().$foto_docente; ?>" alt="">
        <h4><?php echo $instructor_var->nombres; ?> <?php echo $instructor_var->apellidos; ?></h4>
        <h5><?php echo asignar_frase_diccionario ($detalle_curso->diccionario,'{docente}','Instructores',1); ?></h5>

      </div>





      <div class="disc_block_A_col2">
        <span>Genera tu discusion instrucciones</span>
        <p>Escribe en el campo de texto una pregunta abierta para los demás participantes, de esa forma todos participarán en la discusion realizada.</p>
      </div>
    </div>





  </div>

  <div class="discusion_respuesta">
    <div class="discusion_respuesta_wrap">
      <textarea placeholder="Empieza tu discusion" rows="10" cols="30" id="miforo" name="miforo"></textarea>
      <h6>Tu discusion ha sido creada con éxito. Ahora tus imigos les encantara .</h6>
      <img alt="" src="html/site/img/kudos_icon.png">

      <a id="create_foro"> <div class="discusion_btn"><p>Crear</p></div></a>

    </div>
  </div>


</div>














</div> 



<?php #krumo ($detalle_curso->actividades); ?>




<section class="activity_bar">
  <div class="activity_bar_wrap clear">
    <div class="prev_btn"><img src="<?php echo base_url(); ?>html/site/img/prev.png" alt="prev"></div>

    <?php $contador=0; ?>

    <?php $tam=350;
    if (count((array)$detalle_curso->actividades) <31){ $tam=255;  }
    if (count((array)$detalle_curso->actividades) <30){ $tam=260;  }
    if (count((array)$detalle_curso->actividades) <29){ $tam=265;  }
    if (count((array)$detalle_curso->actividades) <28){ $tam=270;  }
    if (count((array)$detalle_curso->actividades) <27){ $tam=275;  }
    if (count((array)$detalle_curso->actividades) <26){ $tam=280;  }
    if (count((array)$detalle_curso->actividades) <25){ $tam=285;  }
    if (count((array)$detalle_curso->actividades) <24){ $tam=290;  }
    if (count((array)$detalle_curso->actividades) <23){ $tam=295;  }
    if (count((array)$detalle_curso->actividades) <22){ $tam=300;  }
    if (count((array)$detalle_curso->actividades) <21){ $tam=305;  }
    if (count((array)$detalle_curso->actividades) <20){ $tam=309;  }
    if (count((array)$detalle_curso->actividades) <19){ $tam=314;  }
    if (count((array)$detalle_curso->actividades) <18){ $tam=319;  }
    if (count((array)$detalle_curso->actividades) <17){ $tam=323;  }
    if (count((array)$detalle_curso->actividades) <16){ $tam=328;  }
    if (count((array)$detalle_curso->actividades) <15){ $tam=333;  }
    if (count((array)$detalle_curso->actividades) <14){ $tam=337;  }
    if (count((array)$detalle_curso->actividades) <13){ $tam=342;  }
    if (count((array)$detalle_curso->actividades) <12){ $tam=346;  }
    if (count((array)$detalle_curso->actividades) <11){ $tam=350;  }
    if (count((array)$detalle_curso->actividades) <10){ $tam=356;  }
    if (count((array)$detalle_curso->actividades) <9) { $tam=360;  }
    if (count((array)$detalle_curso->actividades) <8) { $tam=365;  }
    if (count((array)$detalle_curso->actividades) <7) { $tam=369;  }
    if (count((array)$detalle_curso->actividades) <6) { $tam=370;  }
    if (count((array)$detalle_curso->actividades) <5) { $tam=378;  }
    if (count((array)$detalle_curso->actividades) <4) { $tam=383;  }
    ?>

    <?php $tamano_block=round( ($tam)/count((array)$detalle_curso->actividades),10 ); ?>
    <?php #if ($tamano_block>$margen_error) { $tamano_block=$margen_error;  } ?>
    <style>
     .act_block {
      width: <?php echo $tamano_block; ?>px;
    }
  </style>


  <?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>
   <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
    <div type="video" <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { ?> next="ok" <?php } ?> class="act_block <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { echo "on"; } else { echo "off"; } ?>  <?php if ($contador==0) { ?>on act_actual<?php } ?>" id="act_btn_<?php echo $actividades_value->id_actividades_barra; ?>" data-actividad="<?php echo $actividades_value->info_extra->nombre_actividad; ?>"></div>
  <?php endif ?>
  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Evaluacion')): ?>
    <div type="eval" <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { ?> next="ok" <?php } ?> class="act_block <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { echo "on"; } else { echo "off"; } ?> <?php if ($contador==0) { ?>on act_actual<?php } ?>" id="act_btn_<?php echo $actividades_value->id_actividades_barra; ?>" data-actividad="<?php echo $actividades_value->info_extra->nombre_actividad; ?>"></div>
  <?php endif ?>
  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Foro')): ?>
    <div type="foro" <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { ?> next="ok" <?php } ?> class="act_block <?php if ( in_array($actividades_value->id_actividades_barra,$detalle_curso->actividades_vistas_arr) ) { echo "on"; } else { echo "off"; } ?> <?php if ($contador==0) { ?>on act_actual<?php } ?>" id="act_btn_<?php echo $actividades_value->id_actividades_barra; ?>" data-actividad="<?php echo $actividades_value->info_extra->nombre_actividad; ?>"></div>
  <?php endif ?>
  <?php $contador++; ?>
<?php endforeach ?>

<div class="next_btn"><img src="<?php echo base_url(); ?>html/site/img/next.png" alt="next"></div>                  
</div>  
<div class="tool_tip" total="<?php echo count((array)$detalle_curso->actividades); ?>">
  <div class="tool_tip_wrap">

  </div>
</div>       
</section>






</div>

<div class="col2">


  <div class="col2_wrap">
   <div class="modules_wrap">

     <ul class="clear">
       <?php $if_ver=0; $cont_if_ver=0; ?>
       <?php foreach ($detalle_curso->modulos as $modulos_key => $modulos_value): ?>

        <?php if ($miplan_curso_actual->id_tipo_planes==$this->config->item('Estandar') && $modulos_value->id_tipo_planes==$this->config->item('Premium')): ?>

        <?php else: ?>


         <a idmod="<?php echo $modulos_value->id_modulos; ?>" id="modd<?php echo $modulos_value->id_modulos; ?>" <?php if ($if_ver==1 && $modulos_key > $cont_if_ver) {   } else { ?>href="<?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $modulos_value->id_modulos; ?>/<?php echo $modulos_value->primera_actividad->id_actividades_barra; ?>/<?php echo $this->uri->segment(6); ?> "<?php } ?>>
           <li class="<?php if ($modulos_value->id_modulos==$this->uri->segment(4))  { echo " modulo_actual "; } if ( in_array($modulos_value->id_modulos,$detalle_curso->modulos_vistos_arr) ) { echo "modulo_on";  } else { echo "modulo_off"; $if_ver=1; $cont_if_ver=$modulos_key; } ?>"><?php echo $modulos_value->nombre_modulo; ?></li>
         </a>

       <?php endif ?>

     <?php endforeach ?>



     <?php ## modulo de premios que está en todo curso ?>


     <a id="mimodulopremio" style="<?php if ($mostrar_premio_video=='ok'): ?> display:block; <?php else: ?> display:none; <?php endif ?>" href="<?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $modulo_premios->id_modulos; ?>/<?php echo $primera_actividad_premio->id_actividades_barra; ?>/<?php echo $this->uri->segment(6); ?>">

       <li class="<?php if ($modulo_premios->id_modulos==$this->uri->segment(4))  { echo " modulo_actual "; } if ( in_array($modulo_premios->id_modulos,$detalle_curso->modulos_vistos_arr) ) { echo "modulo_premium_on"; } else { echo "modulo_premium"; } ?> modulo_premium"><?php echo $modulo_premios->nombre_modulo; ?></li>

     </a>


     <?php ##  <a href=""><li class="modulo_actual">Modulo 3</li></a> ?>
   </ul>



 </div>
 <div class="decor_line"></div>
 <div class="aula_btns clear">




   <a <?php if ( $mi_plan_actual==$this->config->item('Estandar'))  { ?> onclick=" alert ('Lo siento, debes ser usuario premium para acceder al contenido!'); return false;" <?php } ?> <?php if ( $mi_plan_actual==$this->config->item('Premium'))  { ?> href="tmp/<?php echo str_replace(".html", ".zip", $this->uri->segment(6)); ?>"<?php } ?>>
     <div class="download_btn">
      <div>                              
      </div>
      <p>Contenido Adicional</p>
    </div>
  </a>


  <div class="crear_discusion_btn" id="crearforito" style="display:none;">
    <div class="discusion_on">                              
    </div>
    <p>Crear Discusion</p></a>
  </div>




  <a <?php if ( $mi_plan_actual==$this->config->item('Estandar'))  { ?> onclick=" alert ('Lo siento, debes ser usuario premium para acceder a la clase en vivo!'); return false;" <?php } ?> <?php if ( $mi_plan_actual==$this->config->item('Premium')) { ?> href="#" <?php } ?>>
    <div class="envivo_btn">
      <div class="envivo_on">                              
      </div>
      <p>Clase en vivo</p>
    </div>
  </a>

  
</div>
</div>


<?php ## listo si tengo la opcion de crear un foro ?>





</div>
</div>
</section>




























<?php ## caja sorpresa (OK) ?>
<audio id="sound-1a">
  <source src="<?php echo base_url(); ?>html/site/sound/LoopSorpresaFinal.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>
<?php ## aplausos ?>
<audio id="sound-1b">
  <source src="<?php echo base_url(); ?>html/site/sound/crowd.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>

<?php ## Solo evaluacion (OK) ?>
<audio id="sound-1c">
  <source src="<?php echo base_url(); ?>html/site/sound/FinalQuiz.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>


<?php ## Solo certificado (OK) ?>
<audio id="sound-1d">
  <source src="<?php echo base_url(); ?>html/site/sound/Certificado.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>

<?php ## Solo medalla (OK) ?>
<audio id="sound-1e">
  <source src="<?php echo base_url(); ?>html/site/sound/GanarMedalla.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>

<?php ## perder puntos y bajar de estatus ?>
<audio id="sound-1f">
  <source src="<?php echo base_url(); ?>html/site/sound/PerderPuntos.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>


<?php ## no se ?>
<audio id="sound-1g">
  <source src="<?php echo base_url(); ?>html/site/sound/GanarPuntosSinAplauso.mp3"></source>
  Your browser isn't invited for super fun audio time.
</audio>



<?php $this->load->view('view_site_footer'); ?>
        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->







      <?php ################################ <si es video> #######################################################?>
      <?php if ($tiene_videos==1): ?>
        <script src="http://www.youtube.com/player_api"></script>
      <?php endif ?>
      <?php ################################ </si es video> #######################################################?>





      <script>
        $(document).ready(function(){

          var valorr_status= $('#proxsts').val();
          strstatus=$('#proxsts').val();
          var opstatus = strstatus.split("|");
          data="";
          jQuery.ajax({
            url:'<?php echo base_url(); ?>cursos/set_nuevostatus/<?php echo $this->uri->segment(3); ?>/'+opstatus[2]+'/'+opstatus[1],
            type: "post",
            data:({
              data:data
            }),
            ajaxSend:function(result){              
              console.log ("ajaxSend\n");
            },
            success:function(result){               
              console.log ("success\n");
              if (result!='error') {
               str=result;

        // alert (result);

        var op = str.split("|");
        <?php ## muestro efecto si cambié de estatus ?>
        $('.box4 > .premio_img > #surprise_result >img').attr('src',op[1]);
        $('.box4').css({'height':'290px'});
        $('.circle_wrap > img').attr('src',op[1]);
        $('.box4 > .motivo_medalla').html(op[4]);
        $('.box4 > .premio_img > #surprise_result > span').hide();
        $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
        $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
        $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
        $j('.backdrop, .box4').css('display', 'block');
        $j('#sound-1b').get(0).play();
        $j('#surprise_result4').css("display","block");

        <?php ## actualizo la variable actual que maneja el estatus del estudiante ?>
        $('#proxsts').val(op[0]+'|'+op[4]+'|'+op[5]+'|'+op[6]);

        <?php ##evaluo si soy campeon para habilitar el boton de crear foro ?>
        if (op[7]==<?php echo $this->config->item('Campeon') ?>) {
          $('#crearforito').show();
        }


      }
    },
    complete:function(result){              
      console.log ("complete\n");

    },
    beforeSend:function(result){                
      console.log ("beforeSend\n");
    },
    ajaxStop:function(result){              
      console.log ("ajaxStop\n");
    }

  });



$('#crearforito').click(function(event) {
 event.preventDefault();
 var thizz=$(this);

 if (thizz.find('div').hasClass('discusion_off')  ) {
  return false;
}


$('.activities > div').each(function(index, el) {
  $(this).css({display:hide});
  $(this).animate(getout);
});


$('#crearmiforo').css({display:see});
$('#crearmiforo').animate(getin);




});



<?php ### boton anterior para ir a la anterior actividad ?>
$('.prev_btn').click(function(event) {

  if ( $('.act_actual').prev('.act_block').length>0  )  {
    $('.act_actual').prev().click();  
  }

  else {
    if ($('.modulo_actual').parent().prev('a').children('.modulo_on').length>0 ) {
     $('.modulo_actual').parent().prev('a').children('.modulo_on').click();  
   }



 }

});


$('.next_btn').click(function(event) {


  if ( $('.act_actual').next('.act_block').length>0  )  {
   $('.act_actual').next().click();  
 }

 else {

  <?php ### valido es el ultimo modulo (modulo premio) para no hacer el efecto de la caja sorpresa ?>
  if ($('.modulo_actual').hasClass('modulo_premium')) { return false; }

  <?php ## muestro la caja sorpresa porque ya terminé con mi modulo, consulto de forma aleatoria el premio ?>

  var id_actividades_barra=Number($(this).prev().attr('id').replace('act_btn_',''));

  jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/caja_sorpresa/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>/'+id_actividades_barra,
    type: "post",
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){  
              //alert (result);
              console.log ("success\n");
              <?php #si no hubo error, hace el efecto en pantalla para mostrar el premio sorpresa ?>
              if (result!='error')  {


                <?php ##divido mis respuestas que ha retornado en el ajax para mostrarlo en la caja sorpresa ?>
                str=result;
                var respuestas = str.split("|");
                <?php ##asigno mis valores retornados en los elementos html correspondientes ?>

                <?php ### asigno el numero de la actividad barra a los botones de las redes sociales para guardar las notificaciones ?>
                $('#fblink').attr('barra',respuestas[7]); 
                $('#twlink').attr('barra',respuestas[7]); 

                <?php ##si el premio son puntos, actualizo los puntos que tengo de forma visual ?>
                if (respuestas[0]==<?php echo $this->config->item('tipos_premio_puntos'); ?>) {
                  <?php ##Actualizo mis puntos de forma visual?>
                  $('.mis_puntos').html(respuestas[8]);

                }


                <?php ##si es un logro, actualizo el listado de logros del sistema ?>
                if (respuestas[0]==<?php echo $this->config->item('tipos_premio_logro'); ?>) {
                  <?php ##muestro todos mis logros obtenidos en el curso ?>
                  $('.medal_container').html(respuestas[6]);
                }

                <?php ##si es una oportunidad de crear un foro, habilito el boton de crear foro para el usuario ?>
                if (respuestas[0]==<?php echo $this->config->item('tipos_premio_foro'); ?>) {

                  if (respuestas[6]=='mostrar_foro') {
                    $('#crearforito').show();
                    $('#crearforito > div').addClass('discusion_on').removeClass('discusion_off');
                  }

                }

                <?php ##si es un video, habilito el modulo de premios y muestro mi premio! ?>
                if (respuestas[0]==<?php echo $this->config->item('tipos_premio_video'); ?>) {
                 if (respuestas[6]=='mostrar_video') {
                  $('#mimodulopremio').show();
                }
              }

              $('.box > p > span').html(respuestas[3]);

              $('.box > .premio_img > #surprise_result').attr('src',respuestas[2]);

              $('.box > .share_block > .share_icons >li > a').eq(0).attr('href',respuestas[4]);
              $('.box > .share_block > .share_icons >li > a').eq(1).attr('href',respuestas[5]);



              $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
              $j('.box').animate({'opacity':'1.00'}, 300, 'linear');
              $j('.box').animate({'top':'20%'}, 1500, 'easeOutElastic');
              $j('.backdrop, .box').css('display', 'block');
              $j('#sound-1a').get(0).play();
              setTimeout(function(){
               $j('#surprise_box').hide();
               $j('#surprise_result').css("display","block");
             }, 2700);


              <?php ##Realizo el efecto para mostrar la caja sorpresa al usuario ?>



            }
            <?php #si hubo error es porque ya tiene el premio y solo continua con el siguiente modulo o curso ?> 
            else {


              if ( $('.modulo_actual').parent().next().attr('id')=='mimodulopremio' )  {
              <?php ### consulto por ajax si ya tiene todos los modulos realizados (vistos) para ver la posibilidad de generar el certificado
                    ### de lo contrario, mostrará un alerta informando que no ha terminado en su totalidad de los modulos y actividades. ?>

                    <?php ##pequeña validacion en ajax si es posible o no de obtener el certificado ?>
                    var data='';
                    <?php ## si soy plan estandar, no tengo derecho a imprimir el certificado. ?>
                    <?php if ( $mi_plan_actual==$this->config->item('Estandar'))  { ?> 

                      jQuery.ajax({
                        url:'<?php echo base_url(); ?>cursos/set_puntos_curso/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>',
                        type: "post",
                        data:({
                          data:data
                        }),
                        ajaxSend:function(result){              
                          console.log ("ajaxSend\n");
                        },
                        success:function(result){               
                          console.log ("success\n");
                          if (result!='error') {
                           str=result;
                           var mispuntos=Number($j('.mis_puntos').html());
                           mispuntos=Number(Number(mispuntos)+Number(str));
                           $j('.mis_puntos').html(mispuntos);

                           <?php ## muestro efecto de ganar puntos cuando termino el certificado solo version estandar ?>
                           var titulo_certificado=$('.encabezado_wrap > p').html();
                           var categoria_certificado=$('.encabezado_wrap > h6').html();
                           <?php ### contruyo el popup para el certificado del usuario ?>
                           $('.box4').css({'height':'325px'});
                           $('.box4 > .premio_img > #surprise_result >img').attr('src','html/site/img/icono_14.png');
                           $('.box4 > .motivo_medalla').html('Has finalizado y aprobado con éxito tu curso de  '+titulo_certificado+",ganaste "+str+" puntos por tu esfuerzo y dedicación.");
                           $('.box4 > .premio_img > #surprise_result > span').hide();
                           $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
                           $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
                           $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
                           $j('.backdrop, .box4').css('display', 'block');
                           $j('#sound-1d').get(0).play();
                           $j('#surprise_result4').css("display","block");




                         }

                         else {



                          <?php ## si sale error es porque ya tengo los puntos y debo mostrar el mensaje otra vez ?>
                          var titulo_certificado=$('.encabezado_wrap > p').html();
                          var categoria_certificado=$('.encabezado_wrap > h6').html();
                          <?php ### contruyo el popup para el certificado del usuario ?>
                          $('.box4').css({'height':'325px'});
                          $('.box4 > .premio_img > #surprise_result >img').attr('src','html/site/img/icono_14.png');
                          $('.box4 > .motivo_medalla').html('Has finalizado y aprobado con éxito tu curso de  '+titulo_certificado+".");
                          $('.box4 > .premio_img > #surprise_result > span').hide();
                          $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
                          $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
                          $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
                          $j('.backdrop, .box4').css('display', 'block');
                          $j('#sound-1d').get(0).play();
                          $j('#surprise_result4').css("display","block");




                        }




                      },
                      complete:function(result){              
                        console.log ("complete\n");

                      },
                      beforeSend:function(result){                
                        console.log ("beforeSend\n");
                      },
                      ajaxStop:function(result){              
                        console.log ("ajaxStop\n");
                      }

                    });




<?php } else { ?>
 <?php if ( $mi_plan_actual==$this->config->item('Premium'))  { ?> 

  jQuery.ajax({
    url:'<?php echo base_url(); ?>validar_certificado/<?php echo $this->uri->segment(3); ?>',
    type: "post",
    data:({
      data:data
    }),
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");

      if (result!='error') {
                         //str=result;
                         //var op = str.split("|");
                         <?php ## si retorno verdadero es porque es posible imprimir el certificado ?>
                         if (result=='true')  { 
                           var titulo_certificado=$('.encabezado_wrap > p').html();
                           var categoria_certificado=$('.encabezado_wrap > h6').html();
                           <?php ### contruyo el popup para el certificado del usuario ?>
                           $('.box4').css({'height':'325px'});
                           $('.box4 > .premio_img > #surprise_result >img').attr('src','html/site/img/icono_9.png');
                           $('.box4 > .motivo_medalla').html('Felicidades!, has obtenido el certificado de '+titulo_certificado+" de la categoría "+categoria_certificado+".<br>Link de descarga: <a target=\"_blank\" href=\"<?php echo base_url().'get_certificado/'.$this->uri->segment(3); ?>\"><li>Descargar certificado</li></a>");
                           $('.box4 > .premio_img > #surprise_result > span').hide();
                           $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
                           $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
                           $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
                           $j('.backdrop, .box4').css('display', 'block');
                           $j('#sound-1d').get(0).play();
                           $j('#surprise_result4').css("display","block");
                           $j('.circle_wrap > img').attr('src',op[1]);

                         }

                         else {
                          alert (result);
                        }


                      }

                      else {
                        alert ("Lo sentimos!, no has terminado la totalidad de modulos disponibles en el curso.");
                        return false;
                      }
                    },
                    complete:function(result){              
                      console.log ("complete\n");

                    },
                    beforeSend:function(result){                
                      console.log ("beforeSend\n");
                    },
                    ajaxStop:function(result){              
                      console.log ("ajaxStop\n");
                    }

                  });

<?php } ## fin si soy premium ?>
<?php } ## fin si soy estandar  ?>






<?php ##pequeña validacion en ajax si es posible o no de obtener el certificado ?>

return false;
}

else {

  if ($('#modd<?php echo $this->uri->segment(4) ?>').next().attr('href')!='')  {
    window.location="<?php echo base_url() ?>"+$('#modd<?php echo $this->uri->segment(4) ?>').next().attr('id');
  }

  else {
    window.location="<?php echo base_url() ?>"+$('#modd<?php echo $this->uri->segment(4) ?>').next().attr('href');
  }
  
}

}

},
complete:function(result){              
  console.log ("complete\n");

},
beforeSend:function(result){                
  console.log ("beforeSend\n");
},
ajaxStop:function(result){              
  console.log ("ajaxStop\n");
}

});



}



});

var see = "block";
var hide = "none";
var getin = {left:'8px'};
var getout = {left:'-600px'};



<?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>


  var activity_btn2 = $("#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>");
  activity_btn2.on('mouseenter', function(){
    $(".tool_tip_wrap").html($(this).data("actividad"));



  }).on('mouseleave',function(){
    $(".tool_tip_wrap").html(" ");
  });




  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
  var video<?php echo $actividades_value->id_actividades_barra; ?> = $("#video<?php echo $actividades_value->id_actividades_barra; ?>");
  var btn_video<?php echo $actividades_value->id_actividades_barra; ?> = $("#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>");
<?php endif ?>

<?php if ($actividades_value->id_tipo_actividades == $this->config->item('Evaluacion')): ?>
  var eval<?php echo $actividades_value->id_actividades_barra; ?> = $("#evaluacion<?php echo $actividades_value->id_actividades_barra; ?>");
  var btn_eval<?php echo $actividades_value->id_actividades_barra; ?> = $("#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>");
<?php endif ?>

<?php if ($actividades_value->id_tipo_actividades == $this->config->item('Foro')): ?>
  var btn_disc<?php echo $actividades_value->id_actividades_barra; ?> = $("#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>");
  var disc<?php echo $actividades_value->id_actividades_barra; ?> = $("#discusion<?php echo $actividades_value->id_actividades_barra; ?>");
  var answ<?php echo $actividades_value->id_actividades_barra; ?> = $("#respuesta<?php echo $actividades_value->id_actividades_barra; ?>");
<?php endif ?>

<?php endforeach ?>


<?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>

  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>


  $('#evaluacion_btn_vid<?php echo $actividades_value->id_actividades; ?>').click(function(event) {


  });



  btn_video<?php echo $actividades_value->id_actividades_barra; ?>.click(function(){

    if ($('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').prev().attr('type')=="foro") {
      $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').attr('next','ok');
    }


    if ( $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').attr('next')=='ok' ) {

      $('.activity_title h3').html($(this).data("actividad"));

      if (btn_video<?php echo $actividades_value->id_actividades_barra; ?>.prev().hasClass('off')) {
        return false;
      }


      $('.act_block').removeClass('act_actual');

      $('.evaluacion').css({display:hide});
      $('.evaluacion_r').css({display:hide});
      $('.evaluacion').animate(getout);

      $('.vvideo').css({display:hide}).removeClass('act_actual');
      $('.vvideo').animate(getout).removeClass('act_actual');

      $('.discusion').css({display:hide});
      $('.discusion').animate(getout);
      $('#crearmiforo').css({display:hide});
      $('#crearmiforo').animate(getout);

      video<?php echo $actividades_value->id_actividades_barra; ?>.css({display:see});
      video<?php echo $actividades_value->id_actividades_barra; ?>.animate(getin);  



//// aqui evento en ajax enviar el comando para guardarlo como visto la actividad

jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/set_visto/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $actividades_value->id_actividades_barra; ?>',
  type: "post",
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");
    $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').addClass('on').removeClass('off');
  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});



btn_video<?php echo $actividades_value->id_actividades_barra; ?>.addClass('act_actual');

}

else {
  return false;
}

});

<?php endif ?>


<?php if ($actividades_value->id_tipo_actividades == $this->config->item('Evaluacion')): ?>

  btn_eval<?php echo $actividades_value->id_actividades_barra; ?>.click(function(){

    if ($('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').prev().attr('type')=="foro") {
      $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').attr('next','ok');
    }
    var if_respuestas=<?php echo getif_respuesta_eval($this->uri->segment(3), $actividades_value->id_actividades_barra); ?>;

    if (if_respuestas!='-1') {
      $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').next().attr('next','ok');
    }


    if ( $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').attr('next')=='ok' ) {

      $('.activity_title h3').html($(this).data("actividad"));

      if (btn_eval<?php echo $actividades_value->id_actividades_barra; ?>.prev().hasClass('off')) {
        return false;
      }


      $('.act_block').removeClass('act_actual');

      $('.evaluacion').css({display:hide});
      $('.evaluacion_r').css({display:hide});
      $('.evaluacion').animate(getout);

      $('.vvideo').css({display:hide});
      $('.vvideo').animate(getout);

      $('.discusion').css({display:hide});
      $('.discusion').animate(getout);

      $('#crearmiforo').css({display:hide});
      $('#crearmiforo').animate(getout);


      eval<?php echo $actividades_value->id_actividades_barra; ?>.css({display:see});
      eval<?php echo $actividades_value->id_actividades_barra; ?>.animate(getin);

//// aqui evento en ajax enviar el comando para guardarlo como visto la actividad
jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/set_visto/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $actividades_value->id_actividades_barra; ?>',
  type: "post",
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");
    $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').addClass('on').removeClass('off');
  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

btn_eval<?php echo $actividades_value->id_actividades_barra; ?>.addClass('act_actual');

}

});

<?php endif ?>


<?php if ($actividades_value->id_tipo_actividades == $this->config->item('Foro')): ?>

  btn_disc<?php echo $actividades_value->id_actividades_barra; ?>.click(function(){


    if ($('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').hasClass('on') ) {
      $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').next().attr('next','ok');
    }


    if ( $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').attr('next')=='ok' ) {

      $('.activity_title h3').html($(this).data("actividad"));

      if (btn_disc<?php echo $actividades_value->id_actividades_barra; ?>.prev().hasClass('off')) {
        return false;
      }


      $('.act_block').removeClass('act_actual');

      $('.evaluacion').css({display:hide});
      $('.evaluacion').animate(getout);
      $('.evaluacion_r').css({display:hide});

      $('.vvideo').css({display:hide});
      $('.vvideo').animate(getout);

      $('.discusion').css({display:hide});
      $('.discusion').animate(getout);


      $('#crearmiforo').css({display:hide});
      $('#crearmiforo').animate(getout);


      disc<?php echo $actividades_value->id_actividades_barra; ?>.css({display:see});
      disc<?php echo $actividades_value->id_actividades_barra; ?>.animate(getin);


//// aqui evento en ajax enviar el comando para guardarlo como visto la actividad

jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/set_visto/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $actividades_value->id_actividades_barra; ?>',
  type: "post",
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");
    $('#act_btn_<?php echo $actividades_value->id_actividades_barra; ?>').addClass('on').removeClass('off');
  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

btn_disc<?php echo $actividades_value->id_actividades_barra; ?>.addClass('act_actual');

}

});

<?php endif ?>

<?php endforeach ?>












});
</script>

<script>
  <?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>
  <?php ################################ <si es video> #######################################################?>
  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
  var player<?php echo $actividades_value->id_actividades; ?>;
<?php endif ?>
<?php endforeach ?>


function onYouTubePlayerAPIReady() {
 <?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>
 <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
 <?php parse_str( parse_url( $actividades_value->info_extra->url_video, PHP_URL_QUERY ), $arrvideo ); ?>
 player = new YT.Player('player<?php echo $actividades_value->id_actividades; ?>', {
  height: '390',
  width: '640',
  videoId: '<?php echo $arrvideo["v"]; ?>',
  playerVars: {
    controls: 1,
    showinfo: 0 ,
    rel: 0,
  },
  events: {
    'onStateChange': onPlayerStateChange<?php echo $actividades_value->id_actividades; ?>
  }
});
<?php endif ?>
<?php endforeach ?>

}

<?php foreach ($detalle_curso->actividades as $actividades_key => $actividades_value): ?>
  <?php if ($actividades_value->id_tipo_actividades == $this->config->item('Video')): ?>
  function onPlayerStateChange<?php echo $actividades_value->id_actividades; ?>(event) {
   if(event.data === 0) {         
    $('#pregunta_rapida<?php echo $actividades_value->id_actividades_barra; ?>').show();
    $('#pregunta_rapida<?php echo $actividades_value->id_actividades_barra; ?>').parent().children('.video_wrap').hide();




  }

}






<?php endif ?>
<?php endforeach ?>




<?php ################################ </si es video> #######################################################?>


</script>


























<script>

  var $j = jQuery.noConflict();


  function send_eval(motivo,puntos,actividad_barra){

   data = new Object;
   var cont_v=0;
   var con=0;
   respuestas_totales_v={};
   var if_error=0;




   $('#evaluacion'+actividad_barra+" .evaluacion_wrap .evaluacion_preg").children('form').each(function(index, el) {


    var thiz=$(this);
    var pregunta=thiz.prev().prev().html();
    var id_competencias=thiz.prev().html();
    var cuantascheked=0;
    <?php #si tengo radios... ?>
    if ( thiz.children('input[type=radio]').length >0) {
     respuestas_v=[];
     respuestas_totales_v[cont_v] = {};
     respuestas_totales_v[cont_v]['pregunta']=pregunta;
     respuestas_totales_v[cont_v]['id_competencias']=id_competencias;
     respuestas_totales_v[cont_v]['tipo_pregunta']=<?php echo $pregunta_tipo_test; ?>;
     thiz.children('input[type=radio]').each(function(index2, el) {
       respuestas_v[index2] = {};
       str=$(this).val();
       var op = str.split("|");
       respuestas_v[index2]['opcion']=op[0];
       respuestas_v[index2]['retroalimentacion']=op[1];
       respuestas_v[index2]['correcta']=op[2];
       respuestas_totales_v[cont_v]['variables_respuesta']= respuestas_v; 
       if ($(this).prop("checked")==true)  {
        respuestas_v[index2]['seleccionada']="1";
        cuantascheked++;
      }
      else {
       respuestas_v[index2]['seleccionada']='0';
     }
   });

     <?php #evaluo si no checkeo nada ?>
     if (cuantascheked==0) {
      alert ("Diligencie todas las preguntas.");
      thiz.children('input[type=radio]').next().addClass('error_eval');
      thiz.children('input[type=radio]').focus();
      if_error=1;
      return false;
    }

  }



  <?php #si tengo lista... ?>
  if ( thiz.children('select').length >0) {
   respuestas_v=[];
   respuestas_totales_v[cont_v] = {};
   respuestas_totales_v[cont_v]['pregunta']=pregunta;
   respuestas_totales_v[cont_v]['id_competencias']=id_competencias;
   respuestas_totales_v[cont_v]['tipo_pregunta']=<?php echo $pregunta_elegir_de_una_lista; ?>;

   $("option", thiz).each(function(index2, el) {
     respuestas_v[index2] = {};
     str=$(this).val();
     var op = str.split("|");
     respuestas_v[index2]['opcion']=op[0];
     respuestas_v[index2]['retroalimentacion']=op[1];
     respuestas_v[index2]['correcta']=op[2];
     respuestas_totales_v[cont_v]['variables_respuesta']= respuestas_v; 

     if ($(this).prop("selected")==true)  {
      respuestas_v[index2]['seleccionada']="1";
    }
    else {
     respuestas_v[index2]['seleccionada']='0';
   }

 });

 }

 <?php #si tengo checkboxs... ?>
 if ( thiz.children('input[type=checkbox]').length >0) {
  respuestas_v={};
  respuestas_totales_v[cont_v] = {};
  respuestas_totales_v[cont_v]['pregunta']=pregunta;
  respuestas_totales_v[cont_v]['id_competencias']=id_competencias;
  respuestas_totales_v[cont_v]['tipo_pregunta']=<?php echo $pregunta_tipo_test; ?>;
  thiz.children('input[type=checkbox]').each(function(index2, el) {
   respuestas_v[index2] = {};
   str=$(this).val();
   var op = str.split("|");
   respuestas_v[index2]['opcion']=op[0];
   respuestas_v[index2]['retroalimentacion']=op[1];
   respuestas_v[index2]['correcta']=op[2];
   respuestas_totales_v[cont_v]['variables_respuesta']= respuestas_v; 

   if ($(this).prop('checked')==true)  {
     respuestas_v[index2]['seleccionada']="1";
     cuantascheked++;
   }
   else {
    respuestas_v[index2]['seleccionada']='0';
  }

});


  <?php #evaluo si no checkeo nada ?>
  if (cuantascheked==0) {
    alert ("Diligencie todas las preguntas.");
    thiz.children('input[type=checkbox]').next().addClass('error_eval');
    thiz.children('input[type=checkbox]').focus();
    if_error=1;
    return false;
  }

}

<?php #si tengo campos de texto... ?>
if ( thiz.children('textarea').length >0) {
 respuestas_v={};
 respuestas_totales_v[cont_v] = {};
 respuestas_totales_v[cont_v]['pregunta']=pregunta;
 respuestas_totales_v[cont_v]['id_competencias']=id_competencias;
 respuestas_totales_v[cont_v]['tipo_pregunta']=<?php echo $pregunta_campo_de_texto; ?>;
 respuestas_v[0] = {};
 respuestas_v[0]['texto']=thiz.children('textarea').attr('placeholder');
 respuestas_v[0]['retroalimentacion']=thiz.children('textarea').attr('retro');
 respuestas_v[0]['respuesta']=thiz.children('textarea').val();
 respuestas_totales_v[cont_v]['variables_respuesta']= respuestas_v; 


 if ( thiz.children('textarea').val()=='' ) {

  alert ("no deje campos vacíos!");
  thiz.children('textarea').addClass('error_eval_s');
  thiz.children('textarea').focus();
  if_error=1;
  return false;

}

}

cont_v++;

});

console.log(respuestas_totales_v);

data.respuesta=respuestas_totales_v;
data.tipo_pregunta="0";
<?php #si no hubo errores ?>
if (if_error==0) {



  <?php # Guardo la informacion en la base de datos ?>


  jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/set_puntos_pregunta_rapida_ev/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/'+motivo+'/'+puntos+'/'+actividad_barra,
    type: "post",
    data:({
      data:data
    }),
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){     
      if (result!='error') {
        console.log ("success\n");

        var datos = result.split("|");

        if (datos[1]!='')  {
          $('#compes_li'+actividad_barra).prev().html(datos[0]);
          $('#compes_li'+actividad_barra).html(datos[1]);
        }

        else {
         $('#respuesta'+actividad_barra+' > div  > h2').html(datos[0]);
         $('#compes_li'+actividad_barra).remove();
       }

       $('#compes_li'+actividad_barra).after(datos[2]);

       var mis_puntosx=Number($('.mis_puntos').html());
       var puntos_sumar=datos[0].replace("+","").replace(" puntos","");  
       $('.mis_puntos').html(datos[3]);
       $j('.actividad_eval h3').html(datos[0].replace(" puntos",""));


        //$('#evaluacion_btn_preg'+actividad_barra).hide();
        //$('#evaluacion_btn_preg_cont'+actividad_barra).show();

        //$j('.actividad_aprobada').animate({'opacity':'.90'}, 300, 'linear');
        //$j('.actividad_aprobada_wrap').animate({'opacity':'1.00'}, 300, 'linear');
        //$j('.actividad_aprobada_wrap').animate({'top':'30%'}, 2000, 'easeOutElastic');
        //$j('.actividad_aprobada').css('display', 'block');
        //$j('#sound-1b').get(0).play();


      } 

    },
    complete:function(result){              
      console.log ("complete\n");



      $j('.actividad_aprobada2').animate({'opacity':'.90'}, 300, 'linear');
      $j('.actividad_eval').animate({'opacity':'1.00'}, 300, 'linear');
      $j('.actividad_eval').animate({'top':'30%'}, 2000, 'easeOutElastic');
      $j('.actividad_aprobada2').css('display', 'block');
      $j('#sound-1b').get(0).play();




      $('#evaluacion'+actividad_barra).hide();
      $('#respuesta'+actividad_barra).show();

      <?php ##envio un pequeño ajax para consultar las oportunidades disponibles y las que he realizado ?>
      jQuery.ajax({
        url:'<?php echo base_url(); ?>cursos/get_oportunidades_ev/'+actividad_barra,
        type: "post",
        data:({
          data:data
        }),
        ajaxSend:function(result){              
          console.log ("ajaxSend\n");
        },
        success:function(result){ 

          var str=result;
          var rta = str.split("|");

          <?php #num_realizados >= num_oportunidades para la evaluacion y habilitar o no el botón de volver a intentar ?>

          if (rta[1]>=rta[0] && rta[0]!='') {
            $('#respuesta'+actividad_barra+" > .evaluacion_wrap > .volver").remove();
            $('#v'+actividad_barra+'v').remove();
          }
          else {
            if (rta[0]!='') {

              if (rta[0]!='ilimitatu')  {
               $('#respuesta'+actividad_barra+" > .evaluacion_wrap > .volver").html(" Volver a intentar ("+Number( Number(rta[0])-Number(rta[1]) )+") ");
             }
           }
           else {
             $('#respuesta'+actividad_barra+" > .evaluacion_wrap > .volver").html(" Volver a intentar ");
           }

         }

       },
       complete:function(result){              
        console.log ("complete\n");
      },
      beforeSend:function(result){                
        console.log ("beforeSend\n");
      },
      ajaxStop:function(result){              
        console.log ("ajaxStop\n");
      }

    });







},
beforeSend:function(result){                
  console.log ("beforeSend\n");

  $('#respuesta'+actividad_barra+" .evaluacion_wrap").find('p.bien').remove();  
  $('#respuesta'+actividad_barra+" .evaluacion_wrap").find('p.mal').remove();
  $('#respuesta'+actividad_barra+" .evaluacion_wrap").find('div.retro').remove();



},
ajaxStop:function(result){              
  console.log ("ajaxStop\n");
}

});
}

}

<?php ########################################## caja de puntos ############################################### ?>
function caja_puntos(motivo,puntos,actividad_barra) {

 data = new Object;

 <?php # es porque es tipo pregunta con radio ?>
 if ( $('#form'+actividad_barra).children('input[type=radio]').length>0) {
  data.tipo_pregunta=<?php echo $pregunta_tipo_test; ?>;
  data.respuesta=JSON.stringify($('.radiop'+actividad_barra+':checked').val());
}



<?php # es porque es tipo pregunta con checkbox ?>
else if ( $('#form'+actividad_barra).children('input[type=checkbox]').length>0) {
  var cuantascheked=0;
  data.tipo_pregunta=<?php echo $pregunta_tipo_test; ?>;
  var checkeds ={};
  $('.checkp'+actividad_barra).each(function(index, el) {
    if ($(this).prop('checked')==true) {  } else { $(this).val('null');  }
    checkeds[$(this).attr('name')]=$(this).val();

    if ($(this).prop('checked')==true)  {
     cuantascheked++;
   }
   else {

   }

 });

  data.respuesta=JSON.stringify(checkeds);
  console.log(checkeds);


  if (cuantascheked==0) {
   alert ("Diligencie todas las preguntas.");
   return false;
 }


}




<?php # es porque es tipo pregunta con select list ?>
else if ( $('#form'+actividad_barra).children('select').length>0) {
  data.tipo_pregunta=<?php echo $pregunta_elegir_de_una_lista; ?>;
  data.respuesta=JSON.stringify($('.list'+actividad_barra+' option:selected').val());
}



<?php # es porque es tipo pregunta con texto ?>
else if ( $('#form'+actividad_barra).children('textarea').length>0) {
  data.tipo_pregunta=<?php echo $pregunta_campo_de_texto; ?>;
  data.respuesta=JSON.stringify($('.textp'+actividad_barra).val());


}

<?php ### si no tiene pregunta rapida, continuo y guardo el punto ?>
else {
  data.respuesta='nadita';
}


<?php ### la pregunta rapida debe ser obligatoria para enviarla al sistema de respuestas de usuario ?>
if (data.respuesta==undefined) {
  alert ("Diligencie todas las preguntas.");
  return false;
}

<?php #borro el formulario de pregunta rapida para no volver a contestar ?>
$('#form'+actividad_barra).hide();

jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/set_puntos_pregunta_rapida/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/'+motivo+'/'+puntos+'/'+actividad_barra,
  type: "post",
  data:({
    data:data
  }),
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){     
    if (result!='error') {
      console.log ("success\n");

      $('#evaluacion_btn_preg'+actividad_barra).hide();
      $('#evaluacion_btn_preg_cont'+actividad_barra).show();
      $j('.actividad_aprobada').animate({'opacity':'.90'}, 300, 'linear');
      $j('.actividad_aprobada_wrap').animate({'opacity':'1.00'}, 300, 'linear');
      $j('.actividad_aprobada_wrap').animate({'top':'30%'}, 2000, 'easeOutElastic');
      $j('.actividad_aprobada').css('display', 'block');
      $j('#sound-1b').get(0).play();

      $('.actividad_eval h3').html('+'+puntos);

      var puntito=Number(puntos);

      $('.mis_puntos').html( Number( Number($('.mis_puntos').html())+Number(puntito)) );
      <?php ##doy permiso para que pueda ver la siguiente actividad ?>
      $("#act_btn_"+actividad_barra).next().attr('next','ok');

    }  else {
      <?php ## dejo que pueda continuar para avanzar en las actividades ?>
      $("#act_btn_"+actividad_barra).next().attr('next','ok');
      $('.next_btn').click();
    }

  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});





} 


function reload_eval (id_actividades_barra) {

  $('#respuesta'+id_actividades_barra).hide();


  <?php ##envio ajax para consultar las veces que puedo repetir el examen ?>




  $('#evaluacion'+id_actividades_barra).find('textarea').val('');
  $('#evaluacion'+id_actividades_barra).find('input[type=radio]').removeAttr('checked');
  $('#evaluacion'+id_actividades_barra).find('input[type=checkbox]').removeAttr('checked');
  $('#evaluacion'+id_actividades_barra).find("select option:selected").prop("selected", false);
  $('#evaluacion'+id_actividades_barra).show();

}



function continuar (id_actividades_barra) {

  <?php #evaluo por cada continuar si es la primera actividad realizada ?>
  data = new Object;
  data.pregunta=$('#pregunta').val();
  jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/if_first_actividad/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/'+id_actividades_barra,
    type: "post",
    data:({
      data:data
    }),
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      if (result!='error') {
       str=result;
       var op = str.split("|");
       $('.sp1').html(op[0]);
       $('.sp2').html(op[1]);
       $('.sp3').html(op[2]);
       $('.sp4').html(op[3]);
       $('.sp5').html('+'+op[0]);
       $('.mis_puntos').html(op[4]);
       $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
       $j('.box3').animate({'opacity':'1.00'}, 300, 'linear');
       $j('.box3').animate({'top':'20%'}, 1500, 'easeOutElastic');
       $j('.backdrop, .box3').css('display', 'block');
       $j('#sound-1b').get(0).play();
       $j('#surprise_result3').css("display","block");
     }

     $('#proxsts2').val(result);



   },
   complete:function(result){              
    console.log ("complete\n");




  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});






$('#act_btn_'+id_actividades_barra).next().attr('next','ok');
$('#act_btn_'+id_actividades_barra).next().click();
$('#evaluacion'+id_actividades_barra).hide();
//$('#respuesta'+id_actividades_barra).hide();
$('#respuesta'+id_actividades_barra+" > .evaluacion_wrap > .volver").hide();
}
<?php ########################################## caja de puntos ############################################### ?>


$( function() {

  $('.act_block').click(function(event) {
   event.preventDefault();

   if ($(this).prev().attr('id'))  {
     var idbarra=$(this).prev().attr('id').replace('act_btn_','');

     <?php ##### miro si tiene un logro sorpresa asignado en el curso y se lo regalo al estudiante ?>

     if ( $(this).attr('next')=='ok' ) {

       data = new Object;
       data.idbarra=idbarra;
       jQuery.ajax({
        url:'<?php echo base_url(); ?>cursos/getif_logro/'+idbarra+'/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>',
        type: "post",
        data:({
          data:data
        }),
        ajaxSend:function(result){              
          console.log ("ajaxSend\n");
        },
        success:function(result){               
          console.log ("success\n");
          if (result!='error') {
           str=result;
           var op = str.split("|");
           <?php ## muestro efecto de la medalla si la tengo en ésta actividad ?>
           $('.box4 > .premio_img > #surprise_result >img').attr('src',op[0]);
           $('.box4 > .motivo_medalla').html(op[1]);
           $('.box4 > .premio_img > #surprise_result > span').hide();
           $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
           $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
           $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
           $j('.backdrop, .box4').css('display', 'block');
           $j('#sound-1e').get(0).play();
           $j('#surprise_result4').css("display","block");
         }
       },
       complete:function(result){              
        console.log ("complete\n");
      },
      beforeSend:function(result){                
        console.log ("beforeSend\n");
      },
      ajaxStop:function(result){              
        console.log ("ajaxStop\n");
      }

    });


}


<?php ############################ pequeño ajax para saber si es hora de cambiar estatus ##############################################?>

var valorr_status= $('#proxsts').val();
strstatus=$('#proxsts2').val();
var opstatus = strstatus.split("|");



var mispuntosactual=$('h3.mis_puntos').html();

if (opstatus[3]==0 || opstatus[3]==undefined) {
  strstatus=$('#proxsts').val();
  var opstatus = strstatus.split("|");
}


<?php ## si no estoy todavia en el nivel maximo de estatus... ?>
if (opstatus[3]==0 || opstatus[3]==undefined) {

  <?php ## si es mayor o igual mis puntos al estatus proximo... ?>
  if (mispuntosactual>=opstatus[1]) {
    <?php # envio ajax para consultar y actualizar mi estado, trayendo el mensaje de alerta en pantalla y mostrar los cambios en pantalla ?>

    jQuery.ajax({
      url:'<?php echo base_url(); ?>cursos/set_nuevostatus/<?php echo $this->uri->segment(3); ?>/'+opstatus[2]+'/'+opstatus[1],
      type: "post",
      data:({
        data:data
      }),
      ajaxSend:function(result){              
        console.log ("ajaxSend\n");
      },
      success:function(result){               
        console.log ("success\n");
        if (result!='error') {
         str=result;

        // alert (result);

        var op = str.split("|");
        <?php ## muestro efecto si cambié de estatus ?>
        $('.box4 > .premio_img > #surprise_result >img').attr('src',op[1]);
        $('.box4').css({'height':'290px'});
        $('.circle_wrap > img').attr('src',op[1]);
        $('.box4 > .motivo_medalla').html(op[4]);
        $('.box4 > .premio_img > #surprise_result > span').hide();
        $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
        $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
        $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
        $j('.backdrop, .box4').css('display', 'block');
        $j('#sound-1b').get(0).play();
        $j('#surprise_result4').css("display","block");

        <?php ## actualizo la variable actual que maneja el estatus del estudiante ?>
        $('#proxsts').val(op[0]+'|'+op[4]+'|'+op[5]+'|'+op[6]);

        <?php ##evaluo si soy campeon para habilitar el boton de crear foro ?>
        if (op[7]==<?php echo $this->config->item('Campeon') ?>) {
          $('#crearforito').show();
        }


      }
    },
    complete:function(result){              
      console.log ("complete\n");

    },
    beforeSend:function(result){                
      console.log ("beforeSend\n");
    },
    ajaxStop:function(result){              
      console.log ("ajaxStop\n");
    }

  });


}

else {

}

}

<?php ############################ pequeño ajax para saber si es hora de cambiar estatus ##############################################?>









}




});




$("textarea").keyup(function(event) {
  if ( $(this).hasClass('error_eval_s') ) {
    $(this).removeClass('error_eval_s');
  }
});



$("input[type=radio]").click(function(event) {
  if ( $(this).next().hasClass('error_eval') ) {
   $("input[type=radio]").next().removeClass('error_eval');
 }
});

$("input[type=checkbox]").click(function(event) {
  if ( $(this).next().hasClass('error_eval') ) {
   $("input[type=checkbox]").next().removeClass('error_eval');
 }
});

<?php ##si tiene el premio de primer curso... ?>
<?php if ($tiene_primer_curso=='si'): ?> 

  $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
  $j('.box2').animate({'opacity':'1.00'}, 300, 'linear');
  $j('.box2').animate({'top':'20%'}, 1500, 'easeOutElastic');
  $j('.backdrop, .box2').css('display', 'block');
  $j('#sound-1b').get(0).play();
  $j('#surprise_result2').css("display","block");

<?php endif ?>



$j('.lightbox').click(function(){

  $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
  $j('.box').animate({'opacity':'1.00'}, 300, 'linear');
  $j('.box').animate({'top':'20%'}, 1500, 'easeOutElastic');
  $j('.backdrop, .box').css('display', 'block');
  $j('#sound-1a').get(0).play();
  setTimeout(function(){
   $j('#surprise_box').hide();
   $j('#surprise_result').css("display","block");
 }, 2700);

}); 

<?php ########################################## caja de puntos ############################################### ?>



$j('.close2').click(function(){

 $j('.box2').animate({'top':'-100%'}, 200, 'linear');
 pausatodo();
                $j('#sound-1b').currentTime = 0; // Reset time
                $j('.backdrop, .box2').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.backdrop, .box2').css('display', 'none');
                  $j('#surprise_result2').css("display","none");
                });  


              }); 



<?php ########################################## motivo primera actividad ############################################### ?>



$j('.close3').click(function(){

 $j('.box3').animate({'top':'-100%'}, 200, 'linear');
 pausatodo();

                $j('#sound-1b').currentTime = 0; // Reset time
                $j('.backdrop, .box3').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.backdrop, .box3').css('display', 'none');
                  $j('#surprise_result3').css("display","none");
                });  


              }); 
<?php ########################################## motivo primera actividad ############################################### ?>


<?php ########################################## ganar medalla cerrar efecto ############################################### ?>
$j('.close4').click(function(){

 $j('.box4').animate({'top':'-100%'}, 200, 'linear');

 pausatodo();

                $j('#sound-1b').currentTime = 0; // Reset time
                $j('.backdrop, .box4').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.backdrop, .box4').css('display', 'none');
                  $j('#surprise_result4').css("display","none");
                  $('.box4').css({'height':'280px'});
                });  


              }); 

<?php ########################################## ganar medalla cerrar efecto ############################################### ?>



$j('.close').click(function(){
  close_box();
  pausatodo();
}); 
$j('.backdrop').click(function(){
  close_box();
  close_box2();

  $j('.box2,.box3,.box4').animate({'top':'-100%'}, 200, 'linear');
  pausatodo();
                $j('#sound-1b').currentTime = 0; // Reset time
                $j('.backdrop, .box2, .box3, .box4').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.backdrop, .box2, .box3, .box4').css('display', 'none');
                  $j('#surprise_result2').css("display","none");
                });





              }); 



$j('.actividad_ok').click(function(){
  $j('.actividad_aprobada').animate({'opacity':'.90'}, 300, 'linear');
  $j('.actividad_aprobada_wrap').animate({'opacity':'1.00'}, 300, 'linear');
  $j('.actividad_aprobada_wrap').animate({'top':'30%'}, 2000, 'easeOutElastic');
  $j('.actividad_aprobada').css('display', 'block');
  $j('#sound-1b').get(0).play();

}); 


$j('.actividad_aprobada').click(function(){
  close_box2();


  <?php ######################### compruebo si es la primera actividad ############################## ?>


  <?php #evaluo por cada continuar si es la primera actividad realizada ?>
  data = new Object;
  data.pregunta=$('#pregunta').val();
  jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/if_first_actividad/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>',
    type: "post",
    data:({
      data:data
    }),
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      if (result!='error') {

       str=result;
       var op = str.split("|");

       $('.sp1').html(op[0]);
       $('.sp2').html(op[1]);
       $('.sp3').html(op[2]);
       $('.sp4').html(op[3]);
       $('.sp5').html('+'+op[0]);

       $('.mis_puntos').html(op[4]);

       $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
       $j('.box3').animate({'opacity':'1.00'}, 300, 'linear');
       $j('.box3').animate({'top':'20%'}, 1500, 'easeOutElastic');
       $j('.backdrop, .box3').css('display', 'block');
       $j('#sound-1b').get(0).play();
       $j('#surprise_result3').css("display","block");

     }


   },
   complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

<?php ######################### compruebo si es la primera actividad ############################## ?>





});


$j('.actividad_aprobada2').click(function(){

  $j('.actividad_eval').animate({'top':'-100%'}, 200, 'linear');
  $j('#sound-1b').get(0).pause();
  $j('#sound-1b').currentTime = 0; // Reset time

  $j('.actividad_aprobada2').animate({'opacity':'0'}, 300, 'linear', function(){
    $j('.actividad_aprobada2').css('display', 'none');
    $j('#sound-1c').get(0).play();
  });  




});




function close_box()
{   

  $j('.box').animate({'top':'-100%'}, 200, 'linear');
  pausatodo();
                $j('#sound-1a').currentTime = 0; // Reset time
                $j('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.backdrop, .box').css('display', 'none');
                  $j('#surprise_box').show();
                  $j('#surprise_result').css("display","none");
                });  

              }



              function close_box2()
              {   

                $j('.actividad_aprobada_wrap').animate({'top':'-100%'}, 200, 'linear');
                pausatodo();
                $j('#sound-1b').currentTime = 0; // Reset time

                $j('.actividad_aprobada').animate({'opacity':'0'}, 300, 'linear', function(){
                  $j('.actividad_aprobada').css('display', 'none');

                });  
              }



              $('#enviar_pregunta').click(function(event) {
                event.preventDefault();
                var thiz=$(this);
                data = new Object;
                data.pregunta=$('#pregunta').val();
                data.id_cursos=<?php echo $this->uri->segment(3); ?>;


                jQuery.ajax({
                  url:'<?php echo base_url(); ?>cursos/enviar_pregunta',
                  type: "post",
                  data:({
                    data:data
                  }),
                  ajaxSend:function(result){              
                    console.log ("ajaxSend\n");
                  },
                  success:function(result){               
                    console.log ("success\n");
                    if (result=='ok')  {
                      thiz.prev().fadeOut(1000);  thiz.fadeOut(1000); <?php ##oculto el campo de texto ?>
                      setTimeout(function(){ thiz.prev().prev().fadeIn(1000);}, 1000);  <?php ##muestro el mensaje de enviado! ?>
                      <?php ##oculto el mensaje de enviado!, muestro el campo de texto y el contador ?>
                      setTimeout(function(){ thiz.prev().prev().fadeOut(1000); thiz.fadeIn(1000);  thiz.prev().fadeIn(1000);   }, 5000);
                      thiz.prev().val('');
                    }
                    else {
                      alert (result);
                    }
                  },
                  complete:function(result){              
                    console.log ("complete\n");
                  },
                  beforeSend:function(result){                
                    console.log ("beforeSend\n");
                  },
                  ajaxStop:function(result){              
                    console.log ("ajaxStop\n");
                  }

                });



});












<?php #dar me gusta en el corazon a un docente ?>
$('.meencantar').click(function(event) {
 event.preventDefault();



 var thiz=$(this);
 data = new Object;
 data.op='darmegusta';
 data.id_usuario_docente=thiz.attr('docente');
 data.id_cursos="<?php echo $this->uri->segment(3); ?>";
 data.id_modulos="<?php echo $this->uri->segment(4); ?>";
 data.id_actividades=thiz.attr('id');


 jQuery.ajax({
  url:$(this).attr('dhref'),
  type: "post",
  data:({
    data:data
  }),

  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");


    $('.meencanta_docente').html(result);

    if ($('.meencanta_docente'+thiz.attr('id')).parent().hasClass('kudos'))  {
      $('.meencanta_docente'+thiz.attr('id')).parent().addClass('kudos_off').removeClass('kudos');
    }

    else {
      $('.meencanta_docente'+thiz.attr('id')).parent().addClass('kudos').removeClass('kudos_off');
    }

  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

});





<?php #if ($detalle_curso->tipo_actividad->id_tipo_actividades==2 && @$detalle_curso->actividad_actual->id_actividades_foro): ?>


 // var sortValue = 'mencantas_estudiantes_todos';



 <?php #dar me gusta en el corazon a un estudiante ?>
 $( ".meencantar_estudiante" ).live( "click", function(event) {
   event.preventDefault();
   var thiz=$(this);
   data = new Object;
   data.op='darmegusta_Est';
   data.id_usuario_estudiante=$(this).attr('est');
   data.id_cursos="<?php echo $this->uri->segment(3); ?>";
   data.id_modulos="<?php echo $this->uri->segment(4); ?>";
   data.id_actividades=thiz.attr('barr');
   data.id_actividades_mensaje=$(this).attr('id');

   jQuery.ajax({
    url:$(this).attr('href'),
    type: "post",
    data:({
      data:data
    }),

    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");

      var str1=result;
      var rtas = str1.split("|");
      <?php ## muestro que tengo una notificacion ?>
      if (rtas[1]==0)  {} else { $('.noti_numero').show().html(rtas[1]); }
      <?php ## muestro los puntos actuales que tengo en ese momento ?>
      $('.mis_puntos').show().html(rtas[2]);

      $('#'+data.id_actividades_mensaje+'meencanta_estudiante').html(rtas[0]);
      $('#'+data.id_actividades_mensaje+'meencanta_estudiante').parent().parent().parent().parent().parent().attr('data-sid',rtas[0]);
      $('#'+data.id_actividades_mensaje+'meencanta_estudiante').parent().parent().parent().parent().parent().attr('id',rtas[0]);

      if ($('#'+data.id_actividades_mensaje+'meencanta_estudiante').parent().hasClass('kudos'))  {
        $('#'+data.id_actividades_mensaje+'meencanta_estudiante').parent().addClass('kudos_off').removeClass('kudos');
      }

      else {
        $('#'+data.id_actividades_mensaje+'meencanta_estudiante').parent().addClass('kudos').removeClass('kudos_off');
      }



      var $container = $j('.disc_estudiantes').isotope({
        layoutMode: 'vertical',
    //sortBy: 'mencantas_estudiantes_todos', sortAscending : false,
    getSortData: {

      mencantas_estudiantes_todos: '.mencantas_estudiantes_todos parseInt',

    }
  });


      $container.isotope( 'reloadItems' ).isotope( { sortBy: 'mencantas_estudiantes_todos', sortAscending : false  } );
//   $container.isotope({ sortBy: 'mencantas_estudiantes_todos', sortAscending : false });



<?php ###  ejecuto un pequeño ajax para consultar las notificaciones ?>

jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/get_notificaciones_ajax',
  type: "post",
  data:({
    data:data
  }),
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){ 

    var str=result;
    var rta = str.split("|");

    <?php #actualizo el numero de notificaciones y tambien el listado de notificaciones ?>

    $('.notificaciones_wrap > ul').html(rta[0]);
    $('.noti_numero').html(rta[1]);

  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});



},
complete:function(result){              
  console.log ("complete\n");
},
beforeSend:function(result){                
  console.log ("beforeSend\n");
},
ajaxStop:function(result){              
  console.log ("ajaxStop\n");
}

});

});







<?php #crea un foro de discusion ?>
$('#create_foro').click(function(event) {
 event.preventDefault();
 var thiz=$(this);


 if ( thiz.prev().prev().prev().val()=='' )  {
  alert ("Por favor, escriba el mensaje a enviar");
  thiz.prev().prev().prev().focus();
  return false;

}

data = new Object;

data.mensaje=$('#miforo').val();
data.id_modulos="<?php echo $this->uri->segment(4); ?>";
data.id_cursos="<?php echo $this->uri->segment(3); ?>";
data.id_usuario="<?php echo $this->session->userdata('id_usuario'); ?>";
jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/createpost',
  type: "post",
  data:({
    data:data
  }),
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");
    
    alert (result);

    if (result!='error') {
      thiz.prev().prev().prev().fadeOut(2000);
      thiz.fadeOut(2000);
      setTimeout(function(){thiz.prev().fadeIn(1000); thiz.prev().prev().fadeIn(1000); }, 1000);
      setTimeout(function(){thiz.prev().fadeOut(2000); thiz.prev().prev().fadeOut(2000); thiz.prev().prev().prev().fadeIn(2000); }, 5000);
      if (result=='ok')  {  setTimeout(function(){  location.reload();  }, 6000);  }
    }

  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

});






<?php #enviar mensaje de usuario en el foro ?>
$('.send_foro').click(function(event) {
 event.preventDefault();
 var thiz=$(this);


 if ( thiz.prev().prev().prev().val()=='' )  {
  alert ("Por favor, escriba el mensaje a enviar");
  thiz.prev().prev().focus();
  return false;

}

data = new Object;

data.mensaje=thiz.prev().prev().prev().val();
data.id_actividades_barra=thiz.attr('barra_foro');
data.id_usuario="<?php echo $this->session->userdata('id_usuario'); ?>";
data.id_cursos="<?php echo $this->uri->segment(3); ?>";
jQuery.ajax({
  url:'<?php echo base_url(); ?>cursos/sendpost',
  type: "post",
  data:({
    data:data
  }),
  ajaxSend:function(result){              
    console.log ("ajaxSend\n");
  },
  success:function(result){               
    console.log ("success\n");

    if ( $('#discusion'+thiz.attr('barra_foro')+' > .discusion_wrap > .disc_estudiantes > .disc_block_B').length>0 )  { 
      $('#discusion'+thiz.attr('barra_foro')+' > .discusion_wrap > .disc_estudiantes > .disc_block_B').last().after(result);
    } 
    else { 
      $('#discusion'+thiz.attr('barra_foro')+' > .discusion_wrap > .disc_estudiantes ').html(result); 
    }
    thiz.prev().prev().prev().val(' ');


    if ( $('#discusion'+thiz.attr('barra_foro')+' > .discusion_wrap > .disc_estudiantes > .disc_block_B').length>0 )  {

      var $container = $j('.disc_estudiantes').isotope({
        layoutMode: 'vertical',
    //sortBy: 'mencantas_estudiantes_todos', sortAscending : false,
    getSortData: {
      mencantas_estudiantes_todos: '.mencantas_estudiantes_todos parseInt',
    }
  });

      $container.isotope( 'reloadItems' ).isotope( { sortBy: 'mencantas_estudiantes_todos', sortAscending : false  } );
    }


    thiz.prev().prev().prev().fadeOut(2000);  <?php ##oculto el campo de texto ?>
    thiz.prev().prev().fadeOut(2000);     <?php ##oculto el contador ?>
    setTimeout(function(){thiz.prev().fadeIn(2000);}, 1000);  <?php ##muestro el mensaje de enviado! ?>

    <?php ##oculto el mensaje de enviado!, muestro el campo de texto y el contador ?>
    setTimeout(function(){thiz.prev().fadeOut(2000); thiz.prev().prev().prev().fadeIn(2000); thiz.prev().prev().fadeIn(2000);  }, 7000);


  },
  complete:function(result){              
    console.log ("complete\n");
  },
  beforeSend:function(result){                
    console.log ("beforeSend\n");
  },
  ajaxStop:function(result){              
    console.log ("ajaxStop\n");
  }

});

});






<?php #endif ?>



$('.solocurso').removeClass('hider');

$('.mis_puntos').html("<?php echo $mis_puntos_actuales_curso_actual; ?>");


<?php ##funcion para dar puntos por compartir la informacion ?>
$('.sharerpoint').click(function(event) {
  var thiz=$(this);
  var barra=$(this).attr('barra');
  jQuery.ajax({
    url:"cursos/socialpoint/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/"+thiz.attr('id')+'/'+barra,
    type: "post",

    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      if (result!='error') {
        str=result;
        <?php ##aqui actualiza en el listado de notificaciones y aumenta el numero de notificaciones en el header ?>
        var respuestas = str.split("|");
        $('.notificaciones_wrap > ul').html(respuestas[0]);
        $('.noti_numero').html(respuestas[1]).show();
        $('.mis_puntos').html(respuestas[2]);
      }
    },
    complete:function(result){              
      console.log ("complete\n");
    },
    beforeSend:function(result){                
      console.log ("beforeSend\n");
    },
    ajaxStop:function(result){              
      console.log ("ajaxStop\n");
    }

  });


});

$('#twlink').click(function(event) {

});


});


<?php ### solo se ejecuta cuando se resta los puntos! al estudiante por falta de actividad ?>
<?php if (@$popup_resta_puntos=='ok'): ?>
  $('.box4 > .premio_img > #surprise_result >img').attr('src','html/site/img/icono_15.png');


  <?php if (@$baja_estatus_foto!='') { ?>  $('.circle_wrap > img').attr('src','<?php echo @$baja_estatus_foto; ?>'); <?php } ?>


         //$('.box4').css({'height':'290px'});
         $('.box4 > h3').html("<?php echo $titulo_resta_puntos; ?>");
         $('.box4 > .motivo_medalla').html("<?php echo $mensaje_resta_puntos; ?>");
         $('.box4 > .premio_img > #surprise_result > span').hide();
         $j('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
         $j('.box4').animate({'opacity':'1.00'}, 300, 'linear');
         $j('.box4').animate({'top':'20%'}, 1500, 'easeOutElastic');
         $j('.backdrop, .box4').css('display', 'block');
         $j('#sound-1f').get(0).play();
         $j('#surprise_result4').css("display","block");


       <?php endif; ?>
       <?php ### solo se ejecuta cuando se resta los puntos! al estudiante por falta de actividad ?>

       function pausatodo() {

        $j('#sound-1a').get(0).pause();
        $j('#sound-1b').get(0).pause();
        $j('#sound-1c').get(0).pause();
        $j('#sound-1d').get(0).pause();
        $j('#sound-1e').get(0).pause();
        $j('#sound-1f').get(0).pause();
        $j('#sound-1g').get(0).pause();

        $j('#sound-1a').currentTime = 0;
        $j('#sound-1b').currentTime = 0;
        $j('#sound-1c').currentTime = 0;
        $j('#sound-1d').currentTime = 0;
        $j('#sound-1e').currentTime = 0;
        $j('#sound-1f').currentTime = 0;
        $j('#sound-1g').currentTime = 0;

      }



      <?php ##evaluo si soy campeon para habilitar el boton de crear foro ?>
      if (<?php echo $detalle_curso->miestatus; ?>==<?php echo $this->config->item('Campeon') ?>) {
        $('#crearforito').show();

        if ( '<?php echo $foro_ya_creado_campeon; ?>'=='no') {

        }

        else {

          $('#crearforito > div').addClass('discusion_off').removeClass('discusion_on');
          $('#crearforito').unbind( "click" );
        }



      }

      else {
        <?php ##evaluo si tengo el premio de crear foro sin ser campeon ?>

        if ( '<?php echo $foro_ya_creado_campeon; ?>'=='no') {
          $('#crearforito').show();
        }

        else {

          $('#crearforito > div').addClass('discusion_off').removeClass('discusion_on');
          $('#crearforito').unbind( "click" );

        }



      }






    </script>
  </body>
  </html>
