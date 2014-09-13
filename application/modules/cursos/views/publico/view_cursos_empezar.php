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
  <?php $this->load->view('view_site_css_js'); ?>

</head>
<body> 


  <?php $this->load->view('view_site_header'); ?>






  <a href="" id="btn3">
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
      <textarea name="" id="" cols="30" rows="10" placeholder="Escribe tu pregunta"></textarea>
      <div class="send_question">
        Enviar
      </div>
    </div>
  </section>

  <section class="encabezado clear">
    <div class="encabezado_wrap">
      <h6><?php echo $detalle_curso->categoria_cursos; ?></h6>
      <p><?php echo $detalle_curso->titulo; ?></p>
      <div class="circle">
        <div class="circle_wrap">
          <img src="html/site/img/<?php echo $this->encrypt->decode( $this->session->userdata('id_estatus') ); ?>.png" alt="">
        </div>
      </div>
    </div>            
  </section>

  <?php #krumo ($detalle_curso); ?>
  <?php $tamano_block=(81)/count((array)$detalle_curso->actividades); ?>
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
      <div class="col1">
        <div class="activity_title">
         <h3><?php echo $detalle_curso->actividad_actual->nombre_actividad; ?></h3>
       </div>

       <?php ########################################### si es un video ##############################?>
       <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==1 && @$detalle_curso->actividad_actual->id_actividades_videos): ?>
        <?php $id_actividad_actual=@$detalle_curso->actividad_actual->id_actividades_videos; ?>
         <div id="video_main" class="video">
          <div class="video_wrap">
            <div id="player"></div>
          </div>
        </div>
      <?php endif ?>


      <?php #####################################si tiene pregunta rapida, debe ser video ####################################?>
      <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==1 && $detalle_curso->actividad_actual->pregunta!='' && $detalle_curso->actividad_actual->variables_pregunta!=''): ?>
        <?php $posibles_respuestas_arr=json_decode($detalle_curso->actividad_actual->variables_pregunta); ?>

        <?php #krumo ( $posibles_respuestas_arr); ?>
        <?php $tipo_element_html=0; ?>
        <?php foreach ($posibles_respuestas_arr as $key => $value): ?>
          <?php if ($value->correcta==1): ?>
            <?php $tipo_element_html++; ?>
          <?php endif ?>
        <?php endforeach ?>

        <div class="evaluacion hiderx">
          <div class="evaluacion_wrap">
            <div class="evaluacion_preg">
              <p><?php echo $detalle_curso->actividad_actual->pregunta; ?></p>
              <form action="">


               <?php foreach ($posibles_respuestas_arr as $key => $value): ?>

                <?php if ($tipo_element_html>1): ?>
                  <input type="checkbox" value="<?php echo $value->posible_respuesta; ?>" name="sex"><span><?php echo $value->posible_respuesta; ?></span><br>
                <?php else: ?>
                  <input type="radio" value="<?php echo $value->posible_respuesta; ?>" name="sex"><span><?php echo $value->posible_respuesta; ?></span><br> 
                <?php endif ?>

              <?php endforeach ?>

            </form>                                
          </div>

          <div class="evaluacion_btn"> Responder </div>

        </div>
      </div>
    <?php endif ?>




    <?php ################################################### si es un foro ########################################################################?>
    <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==2 && @$detalle_curso->actividad_actual->id_actividades_foro): ?>

<?php $id_actividad_actual=@$detalle_curso->actividad_actual->id_actividades_foro; ?>
      <div class="discusion">
        <div class="discusion_wrap">
          <div class="disc_block_A">
            <div class="disc_block_A_wrap clear">
              <div class="disc_block_A_col1">

               <?php 

               if (file_exists( FCPATH.'uploads/instructores/'.$detalle_curso->actividad_actual->docente->foto))  {

                $foto_docente='uploads/instructores/'.$detalle_curso->actividad_actual->docente->foto;

              }

              else{

                if (file_exists(FCPATH.'uploads/usuarios/'.$detalle_curso->actividad_actual->docente->foto))  {

                  $foto_docente='uploads/usuarios/'.$detalle_curso->actividad_actual->docente->foto;

                }



              }

              ?>

              <img alt="" src="<?php echo base_url(); ?>escalar.php?src=<?php echo base_url().$foto_docente; ?>&w=113&h=113&zc=1">


              <h4><?php echo $detalle_curso->actividad_actual->docente->nombres; ?> <?php echo $detalle_curso->actividad_actual->docente->apellidos; ?></h4>
              <h5><?php echo asignar_frase_diccionario ($detalle_curso->diccionario,'{docente}','Instructores',1); ?></h5>
              
              <?php #evaluo si puedo dar megusta o no puedo dar me gusta ?>
              <?php $if_megusta=0; ?>
              <?php foreach ($detalle_curso->actividad_actual->docente->megustas as $megustas_key => $megustas_value): ?>
                <?php if ($megustas_value->id_usuario_modificado==$this->encrypt->decode($this->session->userdata('id_usuario'))): ?>
                  <?php $if_megusta=1; ?>
                <?php endif ?>
              <?php endforeach ?>


              <?php if ($if_megusta==0): ?> <a id="megustar" href="<?php echo base_url(); ?>cursos/dar_megusta"><?php endif ?>
              <div class="kudos"><p class="megusta_docente"><?php echo count($detalle_curso->actividad_actual->docente->megustas); ?></p></div>
              <?php if ($if_megusta==0): ?></a><?php endif ?>

            </div>
            <div class="disc_block_A_col2">

             <p> <?php echo $detalle_curso->actividad_actual->contenido_foro; ?> </p>
           </div>
         </div>
       </div>



       <?php foreach ($detalle_curso->actividad_actual->mensajes_foro as $mensajes_key => $mensajes_value): ?>

        <?php 
        if (file_exists( FCPATH.'uploads/instructores/'.$mensajes_value->foto_usuario))  { $foto_usuario='uploads/instructores/'.$mensajes_value->foto_usuario; }
        else if (file_exists(FCPATH.'uploads/aprendices/'.$mensajes_value->foto_usuario))  { $foto_usuario='uploads/aprendices/'.$mensajes_value->foto_usuario; }
        else  { $foto_usuario='uploads/usuarios/'.$mensajes_value->foto_usuario; }
        ?>

        <div class="disc_block_B">
          <div class="disc_block_B_wrap clear">
            <div class="disc_block_B_col1">
              <img alt="" src="<?php echo $foto_usuario; ?>">
              <h4><?php echo $mensajes_value->nombres ?> <?php echo $mensajes_value->apellidos ?></h4>
              <h5><?php echo $mensajes_value->nombre_estatus ?></h5>


              <?php #evaluo si puedo dar megusta o no puedo dar me gusta ?>
              <?php $if_megusta=0; ?>
              <?php foreach ($mensajes_value->megustas as $megustas_key => $megustas_value): ?>
                <?php if ($megustas_value->id_usuario_modificado==$this->encrypt->decode($this->session->userdata('id_usuario'))): ?>
                  <?php $if_megusta=1; ?>
                <?php endif ?>
              <?php endforeach ?>


              <?php if ($if_megusta==0): ?> <a class="megustar_estudiante" est="<?php echo $mensajes_value->id_usuario_modificado; ?>" id="<?php echo $mensajes_value->id_actividades_foro_mensajes; ?>" href="<?php echo base_url(); ?>cursos/dar_megusta_estudiante"><?php endif ?>
              <div class="kudos"><p id="<?php echo $mensajes_value->id_actividades_foro_mensajes; ?>megusta_estudiante"><?php echo count ($mensajes_value->megustas); ?></p> </div>
              <?php if ($if_megusta==0): ?></a><?php endif ?>


            </div> 
            <div class="disc_block_B_col2">
              <p><?php echo $mensajes_value->mensaje ?></p>
            </div>
          </div>
        </div>
      <?php endforeach ?>








      <div class="discusion_respuesta">
        <div class="discusion_respuesta_wrap">
          <textarea placeholder="Escribe tu respuesta" rows="10" cols="30" id="mensaje_foro" name="mensaje_foro"></textarea>
          <a id="send_foro" href="#"><div class="discusion_btn"><p>Participar</p></div></a>
        </div>
      </div>

    </div>
  </div> 






<?php endif ?>






<section class="activity_bar">
  <div class="activity_bar_wrap clear">
    <a href=""><div class="prev_btn"><img src="html/site/img/prev.png" alt="prev"></div></a>
<?php $ons=0; $vons=0; ?>
    <?php foreach ($detalle_curso->actividades as $key => $value): ?>

     <a id="act<?php echo $value->id_actividades_barra; ?>" class="actividades_disponibles" href="<?php echo $this->uri->segment(1) ?>/<?php echo $this->uri->segment(2) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $value->id_actividades_barra; ?>/<?php echo $this->uri->segment(6); ?>">
       <div style="width: <?php echo $tamano_block; ?>%;" class="act_block <?php if ($detalle_curso->actividades->$key->id_actividades_barra==$detalle_curso->actividades_vistas->$key->id_actividades) { ?>on<?php $ons++; } else { ?>off<?php } ?>  <?php if ($value->id_actividades==$id_actividad_actual): ?>  act_actual <?php endif; ?>  "></div>
     </a>
     <?php ## debo evaluar la cantidad de actividades con las vistas para habilitar o no el siguiente modulo ?>
     <?php $vons++; ?>
   <?php endforeach ?>

   <a href=""><div class="next_btn"><img src="html/site/img/next.png" alt="next"></div></a>

 </div>         
</section>
</div>




<div class="col2">
  <div class="col2_wrap">


   <div class="modules_wrap">

<!-- $ons."| ".$vons  -->

    <ul class="clear">
      <?php foreach ($detalle_curso->modulos as $modulos_key => $modulos_value): ?>
       <a href="<?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $modulos_value->id_modulos; ?>/<?php echo $modulos_value->primera_actividad->id_actividades_barra; ?>/<?php echo $this->uri->segment(6); ?>">
         <li class="<?php if ( in_array($modulos_value->id_modulos,$detalle_curso->modulos_vistos_arr) ) { echo "module_on"; } else { echo "module_off"; } ?>"><?php echo $modulos_value->nombre_modulo; ?></li>
       </a>
     <?php endforeach ?>
   </ul>

<?php echo ":::".$ons."| ".$vons; ?>
 </div>
 <div class="decor_line"></div>
 <div class="aula_btns clear">
  <a href="tmp/<?php echo str_replace(".html", ".zip", $this->uri->segment(6)); ?>">
    <div class="download_btn">
      <h5>Descargar</h5>
      <p>Tamaño <?php echo $peso_zip; ?> KB  .zip   </p>
    </div>
  </a>
  <div class="envivo_btn">
    <div class="envivo_on">

    </div>
    <p>Clase en vivo</p>
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

      <?php ## si el tipo de actividad es video, activamos esta programacion para la pregunta rapida ?>



      <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==1 && @$detalle_curso->actividad_actual->id_actividades_videos): ?>

        <?php parse_str( parse_url( $detalle_curso->actividad_actual->url_video, PHP_URL_QUERY ), $arrvideo ); ?>

        <script src="http://www.youtube.com/player_api"></script>
      <?php endif ?>
      <script>
        <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==1 && @$detalle_curso->actividad_actual->id_actividades_videos): ?>

        var player;
        function onYouTubePlayerAPIReady() {
          player = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: '<?php echo $arrvideo["v"]; ?>',
            events: {
              'onReady': onPlayerReady,
              'onStateChange': onPlayerStateChange
            }
          });
        }

        function onPlayerReady(event) {
        //event.target.playVideo();
      }


      function onPlayerStateChange(event) {        
        if(event.data === 0) {            

            //alert('finalizado!');

            $('.evaluacion').show();
            $('#video_main').hide();

          }
        }

      <?php endif ?>


      $(document).ready(function() {

       <?php if ($detalle_curso->tipo_actividad->id_tipo_actividades==2 && @$detalle_curso->actividad_actual->id_actividades_foro): ?>

       <?php #dar me gusta en el corazon a un estudiante ?>
       $('.megustar_estudiante').click(function(event) {
         event.preventDefault();
         var thiz=$(this);
         data = new Object;
         data.op='darmegusta_Est';
         data.id_usuario_estudiante=$(this).attr('est');
         data.id_cursos="<?php echo $this->uri->segment(3); ?>";
         data.id_modulos="<?php echo $this->uri->segment(4); ?>";
         data.id_actividades="<?php echo $this->uri->segment(5); ?>";
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
            $('#'+data.id_actividades_mensaje+'megusta_estudiante').html(result);
            thiz.unbind( "click" );
            thiz.removeAttr('href');
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
$('#megustar').click(function(event) {
 event.preventDefault();
 var thiz=$(this);
 data = new Object;
 data.op='darmegusta';
 data.id_usuario_docente="<?php echo $detalle_curso->id_usuario_modificado; ?>";
 data.id_cursos="<?php echo $this->uri->segment(3); ?>";
 data.id_modulos="<?php echo $this->uri->segment(4); ?>";
 data.id_actividades="<?php echo $this->uri->segment(5); ?>";


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
    $('.megusta_docente').html(result);
    $('.megusta_docente').parent().parent().unbind( "click" );
    $('.megusta_docente').parent().parent().removeAttr('href');
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
$('#send_foro').click(function(event) {
 event.preventDefault();

 if ( $('#mensaje_foro').val()=='' )  {
  alert ("Por favor, escriba el mensaje a enviar");
  $('#mensaje_foro').focus();
  return false;

}

data = new Object;

data.mensaje=$('#mensaje_foro').val();
data.id_actividades_barra="<?php echo $this->uri->segment(5); ?>";
data.id_usuario="<?php echo $this->session->userdata('id_usuario'); ?>";
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
    $('.disc_block_B').last().after(result);
    $('#mensaje_foro').val(' ');
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


<?php endif ?>







  






$('.prev_btn').click(function(event) {
  event.preventDefault();
  <?php ## si es el primer elemento, no hace nada ?>


  if ( $('#act<?php echo $this->uri->segment(5); ?>').prev().attr('href')=='' ){
    return false;
  }
  <?php ## si no, entonces lo redirecciona a la anterior ?>
  else {
   window.location.href =  $('#act<?php echo $this->uri->segment(5); ?>').prev().attr('href'); 
 }


});


$('.next_btn').click(function(event) {

  event.preventDefault();
  <?php ## si es el primer elemento, no hace nada ?>
  if ($('#act<?php echo $this->uri->segment(5); ?>').next().attr('href')==''){
    return false;
  }
  <?php ## si no, entonces lo redirecciona a la anterior ?>
  else {
    window.location.href =  $('#act<?php echo $this->uri->segment(5); ?>').next().attr('href'); 

  }




});



});



</script>




</body>
</html>
