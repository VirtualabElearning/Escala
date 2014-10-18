<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Notificaciones</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('view_site_css_js'); ?>
  <link rel="stylesheet" href="login/assets/css/login.css"> 

</head>
<body>
 <?php $this->load->view('view_site_header'); ?>


   <section class="encabezado2 clear">
            <div class="encabezado2_wrap">
                <h6>Centro de notificaciones</h6>
                <p></p>
                <div class="circle">
                    <div class="circle_wrap">
                        <img src="html/site/img/icono_18.png" alt="">
                    </div>
                   
                </div>
            </div>            
        </section>     


 <section class="not_page">
  <div class="not_page_wrap">
    <?php $meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre") ?>

    <?php foreach ($notificaciones_todas as $notificaciones_todas_key => $notificaciones_todas_value): ?>

      <?php  
      $datetime=explode (" ",$notificaciones_todas_value->fecha_creado);
      $fecha=explode ("-",$datetime[0]);
      ?>
      <div class="not_block">
        <div class="not_block_wrap clear">

          <span class="closex deletenot" opx="3" id="<?php echo $notificaciones_todas_value->id_notificaciones; ?>">X</span>


          <div class="not_block_col1">
            <h4><?php echo $meses[$fecha[1]] ?> <?php echo $fecha[2]; ?></h4>
            <span><?php echo $datetime[1]; ?></span>
          </div>

          <?php  if ($notificaciones_todas_value->id_estados==$this->config->item('estado_leido')) { ?>
          <div class="not_block_col2 not_off clickernot" opx="2" id="<?php echo $notificaciones_todas_value->id_notificaciones; ?>">  


           <?php } else { ?>
           <div class="not_block_col2 clickernot" opx="1" id="<?php echo $notificaciones_todas_value->id_notificaciones; ?>">  
             <?php } ?>




           </div>
           <div class="not_block_col3">
            <p><?php echo $notificaciones_todas_value->mensaje; ?></p>
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

          <?php ##funcion para actualizar el estado del ajax a leído o no leído ?>

          $( ".deletenot" ).live( "click", function(event) {
            var opx=$(this).attr('opx');
            var thiz=$(this);

            jQuery.ajax({
              url:'<?php echo base_url(); ?>op_notificaciones/'+$(this).attr('id')+'/'+opx,
              type: "post",
              ajaxSend:function(result){              
                console.log ("ajaxSend\n");
              },
              success:function(result){ 
               console.log(result);              
               thiz.parent().parent().fadeOut(300, function() { thiz.parent().parent().remove(); });
               $('.noti_numero').html(result);
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





          $( ".clickernot" ).live( "click", function(event) {
            var opx=$(this).attr('opx');
            var thiz=$(this);

            jQuery.ajax({
              url:'<?php echo base_url(); ?>op_notificaciones/'+$(this).attr('id')+'/'+opx,
              type: "post",
              ajaxSend:function(result){              
                console.log ("ajaxSend\n");
              },
              success:function(result){ 
               console.log(result);
               $('.noti_numero').html(result);
               
               if (opx==1) {
                thiz.addClass('not_off');
                thiz.attr('opx',2);
              }
              else {
               thiz.removeClass('not_off');
               thiz.attr('opx',1);
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
