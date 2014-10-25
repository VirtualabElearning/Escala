<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Centro de mensajes</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('view_site_css_js'); ?>
  <link rel="stylesheet" href="login/assets/css/login.css"> 

</head>
<body>
 <?php $this->load->view('view_site_header'); ?>


 <section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Centro de Mensajes</h6>
    <p>Para escribir un mensaje al facilitador, hazlo <br> directo en el curso.</p>
    <div class="circle">
      <div class="circle_wrap">
        <img src="html/site/img/icono_18.png" alt="">
      </div>

    </div>
  </div>            
</section>     


<?php #krumo ($inbox_list); ?>

<section class="inbox">
  <div class="inbox_wrap">


    <?php foreach ($inbox_list as $key => $value): ?>

      <div class="inbox_block">
        <div class="inbox_block_wrap clear">
          <span opx="3" id="<?php echo $value->id_mensajes; ?>" class="closex delete_inbox">X</span>




          <?php  if ($value->id_estados==$this->config->item('estado_leido')) { ?>
          <div opx="2" id="<?php echo $value->id_mensajes; ?>" class="not_block_col2 clicker_inbox">  </div>
          <?php } else { ?>
          <div opx="1" id="<?php echo $value->id_mensajes; ?>" class="not_block_col2 not_off clicker_inbox">  </div>
          <?php } ?>




          <div class="inbox_col1">
            <img src="uploads/instructores/<?php echo $value->docente->foto; ?>" alt=""> 
            <p><?php echo $value->docente->nombres; ?> <?php echo $value->docente->apellidos; ?></p> 
            <h2>Experto</h2>                            
          </div>
          <div class="inbox_col2">
            <div class="inbox_date">
              <?php echo fecha_texto ($value->fecha_creado); ?>
            </div>
            <div class="inbox_curso">
              <?php echo $value->curso->titulo; ?>
            </div>
            <div class="inbox_actividad">
              <?php if ($value->modulo->nombre_modulo!=''): ?>
               <?php echo $value->modulo->nombre_modulo; ?>: <?php echo $value->actividad->nombre_actividad; ?>
             <?php endif ?>
           </div>
         </div>
         <div class="inbox_col3">

            <div class="cursiv"><?php echo $value->pregunta->mensaje; ?></div>

          <p><?php echo $value->mensaje; ?></p>
                        <?php /* ?>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Escribe tu respuesta"></textarea>
                        <div class="evaluacion_btn">Responder</div>
                        <?php */ ?>
                      </div>
                    </div>
                  </div>

                <?php endforeach ?>



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


         $( ".delete_inbox" ).live( "click", function(event) {
          var opx=$(this).attr('opx');
          var thiz=$(this);

          jQuery.ajax({
            url:'<?php echo base_url(); ?>op_inbox/'+$(this).attr('id')+'/'+opx,
            type: "post",
            ajaxSend:function(result){              
              console.log ("ajaxSend\n");
            },
            success:function(result){ 
             console.log(result);              
             thiz.parent().parent().fadeOut(300, function() { thiz.parent().parent().remove(); });
             $('.inbox_numero').html(result);
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





         $( ".clicker_inbox" ).live( "click", function(event) {
          var opx=$(this).attr('opx');
          var thiz=$(this);

          jQuery.ajax({
            url:'<?php echo base_url(); ?>op_inbox/'+$(this).attr('id')+'/'+opx,
            type: "post",
            ajaxSend:function(result){              
              console.log ("ajaxSend\n");
            },
            success:function(result){ 
             console.log(result);
             if (result==0) { $('.inbox_numero').hide(); } else {
               $('.inbox_numero').html(result);
               $('.inbox_numero').show();
             }
             if (opx==2) {
              thiz.addClass('not_off');
              thiz.attr('opx',1);
            }
            else {
             thiz.removeClass('not_off');
             thiz.attr('opx',2);
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














}); 


</script>


</body>
</html>
