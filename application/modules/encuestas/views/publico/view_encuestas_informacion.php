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


 <!--HEADER-->
 <div class="backdrop"></div>

 <div class="box_container">
  <div class="box">
    <div class="close">x</div>
    <div id="gracias">¡GRACIAS!</div>
    <p>Tu información ha sido enviada satisfactoriamente, ingresa a este link para conocer mas de nuestros servicios</p>
   <a href="cursos"> <div class="thanks_btn">CONOCE MÁS CURSOS</div></a>
  </div>
</div>





<?php $this->load->view('view_site_header'); ?>
<section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Encuesta de Satisfacción</h6>
    <p>Por favor dejanos saber como podemos mejorar.</p>
    <div class="circle">
      <div class="circle_wrap">
        <img src="html/site/img/icono_10.png" alt="">
      </div>
    </div>
  </div>            
</section>
<?php #krumo ($detalle); ?>

<section class="encuesta">
  <div class="encuesta_wrap">


    <?php foreach ($detalle as $key => $value): ?>
      <?php if ($value->tipo_pregunta==1): ?>
       <div class="evaluacion_preg">
        <p><?php echo $value->pregunta; ?></p>
        <form action="">
          <?php foreach (json_decode($value->variables_pregunta) as $subkey => $subvalue): ?>
            <input class="radio" type="radio" id="p<?php echo $value->id_encuestas_detalle; ?>" name="p<?php echo $value->id_encuestas_detalle; ?>" value="<?php echo $subvalue; ?>"><span><?php echo $subvalue; ?></span>
          <?php endforeach ?>    
        </form>                                
      </div>
    <?php endif ?>


    <?php if ($value->tipo_pregunta==2): ?>
     <div class="evaluacion_preg">
      <p><?php echo $value->pregunta; ?></p>
      <form action="">
       <select class="select" name="p<?php echo $value->id_encuestas_detalle; ?>" id="p<?php echo $value->id_encuestas_detalle; ?>">
        <?php foreach (json_decode($value->variables_pregunta) as $subkey => $subvalue): ?> 
          <option value="<?php echo $subvalue; ?>"><?php echo $subvalue; ?></option>
        <?php endforeach ?>    
      </select>
    </form>                                
  </div>
<?php endif ?>



<?php if ($value->tipo_pregunta==3): ?>
  <div class="evaluacion_preg">
    <p><?php echo $value->pregunta; ?></p>
    <form action="">
     <textarea class="text" name="p<?php echo $value->id_encuestas_detalle; ?>" id="p<?php echo $value->id_encuestas_detalle; ?>" cols="30" rows="10" placeholder=""></textarea>
   </form>                                
 </div>
<?php endif ?>

<?php endforeach ?>

<form action="">
  <input type="hidden" id="id_cursos" name="id_cursos" value="<?php echo $this->uri->segment(4); ?>">
</form>

<div id="send_encuesta" class="evaluacion_btn">Responder</div>

</div>
</section>

<?php $this->load->view('view_site_footer'); ?>
        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->


      <script>

        jQuery(document).ready(function($) {


          jQuery('#send_encuesta').click(function(event) {
            event.preventDefault();

            data = new Object;
            var enviar=true;
            var thiz=jQuery('form')

            thiz.each(function(index, el) {

              if ( thiz.children().hasClass('radio') ) {
               var seleccionado=0;   
               thiz.children('input[type=radio]').each(function(index2, el) {
                if  (jQuery(this).prop("checked")==true)  { seleccionado=1;  }

              });

               if (seleccionado==0) {
                alert ("Diligencie todas las preguntas.");
                enviar=false;
                return false;
              }


            }


            if ( jQuery(this).children().hasClass('select') ) {

            }


            if ( jQuery(this).children().hasClass('text') ) {

            }


          });


            if (enviar==true)  {
              data= jQuery( '.encuesta_wrap form' ).serialize()
              jQuery.ajax({
                url:'<?php echo base_url(); ?>encuestas/publico/validar_encuesta/<?php echo $this->uri->segment(3); ?>',
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
                  $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
                  $('.box').animate({'opacity':'1.00'}, 300, 'linear');
                  $('.box').animate({'top':'20%'}, 1500, 'easeOutElastic');
                  $('.backdrop, .box').css('display', 'block');    
                } else {
                  alert (result);
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

}



});




$('.close').click(function(){
  close_box();
}); 
$('.backdrop').click(function(){
  close_box();
}); 



});

function close_box()
{   $('.box').animate({'top':'-100%'}, 200, 'linear');
               // $('#sound-1a').get(0).pause();
              //  $('#sound-1a').currentTime = 0; // Reset time
              $('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
                $('.backdrop, .box').css('display', 'none');
                $('#surprise_box').show();
                $('#surprise_result').css("display","none");
              });  
            }
            function close_box2()
            {   $('.actividad_aprobada_wrap').animate({'top':'-100%'}, 200, 'linear');
               // $('#sound-1b').get(0).pause();
                //$('#sound-1b').currentTime = 0; // Reset time
                $('.actividad_aprobada').animate({'opacity':'0'}, 300, 'linear', function(){
                  $('.actividad_aprobada').css('display', 'none');

                });  
              }


</script>


</body>
</html>