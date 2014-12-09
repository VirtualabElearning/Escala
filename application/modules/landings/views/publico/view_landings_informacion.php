<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 <base href="<?=base_url()?>" /> 
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo $contenido->titulo; ?>|<?php echo $custom_sistema->nombre_sistema; ?></title>
 <meta name="description" content="<?php echo $contenido->descripcion; ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php $this->load->view('view_site_css_js'); ?>

<style>
  
  #mensaje {

    height: 139px;
    margin-left: 8px;
    width: 274px;


     background: none repeat scroll 0 0 #fff;
    border: 0 none;
    border-radius: 2px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.35) inset, 0 1px 0 #fff;
    box-sizing: border-box;
    font-family: century;
    margin: 0 0 0 9px;
    padding: 7px 30px 7px 7px;
 


  }

</style>


</head>
<body>
 <?php $this->load->view('view_site_header'); ?>
 <div class="brand_line">Hello</div>




 <!--HEADER-->
 <div class="backdrop"></div>

 <div class="box_container">
  <div class="box">
    <div class="close">x</div>
    <div id="gracias">¡GRACIAS!</div>
    <p>Tu información ha sido enviada satisfactoriamente, ingresa a este link para conocer mas de nuestros servicios</p>
      <a href="cursos"> <div class="thanks_btn">Ver m&aacute;s</div></a>
  </div>
</div>


<section class="landing">
  <div class="landing_wrap clear">
   <div class="landing_col1">
     <h3><?php echo $contenido->titulo; ?></h3>
     <p> <?php echo $contenido->contenido; ?></p>
     <div class="video" id="video">
      <div class="video_wrap">

       <?php if ($contenido->url_video==''): ?>
        <img src="uploads/landings/<?php echo $contenido->foto; ?>" alt="<?php echo $contenido->titulo; ?>    ">
      <?php else: ?>
        <?php  parse_str( parse_url( $contenido->url_video, PHP_URL_QUERY ), $url_video );    ?>
        <iframe width="462" height="260" src="http://www.youtube.com/embed/<?php echo $url_video['v']; ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
      <?php endif ?>




    </div>
  </div>
</div>

<div class="landing_col2">
 <div class="landing_form">
   <?php $attributos=array('class'=>'form-horizontal','name'=>'form_generator','id'=>'form_generator'); ?>
   <?=form_open(base_url().'plataforma/validar.html',$attributos)?>

   <div class="name">
    <input type="text" placeholder="* Nombre" name="nombres" id="nombres" value="<?php echo $this->input->post('nombres'); ?>">   
    <?php echo form_error('nombres', '<div class="mensaje_error">', '</div>'); ?>                                 
  </div>
  <div class="name">
    <input type="text" placeholder="* Apellido" name="apellidos" id="apellidos" value="<?php echo $this->input->post('apellidos'); ?>">  
    <?php echo form_error('apellidos', '<div class="mensaje_error">', '</div>'); ?>                                  
  </div>
  <div class="pass">
    <input type="text" placeholder="* Email" name="correo" id="correo" value="<?php echo $this->input->post('correo'); ?>">
    <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?>

  </div>
  <div class="pass">
    <input type="text" placeholder="* Telefono" name="telefono" id="telefono" value="<?php echo $this->input->post('telefono'); ?>">
    <?php echo form_error('telefono', '<div class="mensaje_error">', '</div>'); ?>
  </div>


  <div class="pass">
  <textarea id="mensaje" cols="30" rows="10" placeholder="Escribe aqui tu mensaje" name="Escribe aqui tu mensaje"></textarea>
 </div>

 <?php if ($msg!=''): ?>
  <h6 style="display:block;"><?php echo $msg; ?></h6>
<?php else: ?>
  <a href="#" id="submit">  <div class="cta_btn"> Empezar</div> </a>
<?php endif ?>





<div class="newsletter clear">
  <p>Quiero recibir ofertas especiales</p><input type="checkbox" name="recibir_ofertas" id="recibir_ofertas" value="1" <?php if ($this->input->post('recibir_ofertas')): ?> checked <?php endif ?> >
</div>
<input type="hidden" name="id_contenidos" value="<?php if (!$this->uri->segment(3)) { echo $this->input->post('id_contenidos'); } else {  echo $this->uri->segment(3); } ?>">
<input type="hidden" name="url" value="<?php echo current_url(); ?>">
<input type="hidden" name="titulo_landing" value="<?php echo $contenido->titulo; ?>">  
<?php echo form_close(); ?>
</div>
</div>


</div>
</section>





<?php $this->load->view('view_site_footer'); ?>
<script>

  $(document).ready(function() {

    $('#submit').click(function(event){
      event.preventDefault();


      if ($('#nombres').val()=='') {
        alert ("Debes diligenciar el campo "+$('#nombres').attr('name')+" ¡Gracias!");
        $('#nombres').focus();
        return false;
      }

      if ($('#correo').val()=='') {
        alert ("Debes diligenciar el campo "+$('#correo').attr('name')+" ¡Gracias!");
        $('#correo').focus();
        return false;
      }

      expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if ( !expr.test($('#correo').val()) ) {
        alert("Error: La dirección de correo " + $('#correo').val() + " es incorrecta.");
        $('#correo').focus();
        return false;
      }

      if ($('#mensaje').val()=='') {
        alert ("EDebes diligenciar el campo "+$('#mensaje').attr('name')+" ¡Gracias!");
        $('#mensaje').focus();
        return false;
      }

      data = new Object;
      data.nombres=$('#nombres').val();
      data.apellidos=$('#apellidos').val();
      data.email=$('#correo').val();
      data.mensaje=$('#mensaje').val();

      if ($("#checkt").is(":checked")) { data.acepta='si'; }
      else { data.acepta='no';  }

      jQuery.ajax({
        url:'<?php echo base_url(); ?>landings/publico/sendajax',
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
        }

      });






    });


$('.lightbox').click(function(){
  $('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
  $('.box').animate({'opacity':'1.00'}, 300, 'linear');
  $('.box').animate({'top':'20%'}, 1500, 'easeOutElastic');
  $('.backdrop, .box').css('display', 'block');
  $('#sound-1a').get(0).play();
  setTimeout(function(){
   $('#surprise_box').hide();
   $('#surprise_result').css("display","block");
 }, 2700);

}); 
$('.close').click(function(){
  close_box();
}); 
$('.backdrop').click(function(){
  close_box();
}); 

$('.actividad_ok').click(function(){
  $('.actividad_aprobada').animate({'opacity':'.90'}, 300, 'linear');
  $('.actividad_aprobada_wrap').animate({'opacity':'1.00'}, 300, 'linear');
  $('.actividad_aprobada_wrap').animate({'top':'30%'}, 2000, 'easeOutElastic');
  $('.actividad_aprobada').css('display', 'block');
  $('#sound-1b').get(0).play();

}); 
$('.actividad_aprobada').click(function(){
  close_box2();
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


            <script>





            </script>


        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->
    </body>
    </html>