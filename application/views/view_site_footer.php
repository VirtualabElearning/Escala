<script>

  <?php if ($this->uri->segment(2)=='empezar') { ?>
    $(window).load(function() {
      <?php ### si el modulo anterior es nuevo , no lo he visto pero el actual si... ?>

      if ($('.modulo_actual').parent().prev().attr('href')==undefined ) {
        $('.modulo_actual').parent().prev().attr('href',$('.modulo_actual').parent().prev().attr('id'));
      }

    });

    <?php } ?>



    $(document).ready(function() {

      <?php ##funcion para ocultar el icono de notificaciones si no tiene ninguna ?>

      if ($('.inbox_numero').length>0) {
        if ($('.inbox_numero').html().trim()=='') {
          $('.inbox_numero').hide();
        }
      }

      <?php ## esto es para los mensajes del foro limitarlos a 500 caracteres ?>
      var caracteres = 500;
      $(".counter_foro").html("Te quedan <strong>"+  caracteres+"</strong> caracteres.");

      $(".miforocounter_foro").html("Te quedan <strong>"+  caracteres+"</strong> caracteres.");

      $(".mensaje_foro").keyup(function(){
        if($(this).val().length > caracteres){
          $(this).val($(this).val().substr(0, caracteres));
        }
        var quedan = caracteres -  $(this).val().length;
        $(this).next().html("Te quedan <strong>"+  quedan+"</strong> caracteres.");
        if(quedan <= 10)
        {
          $(this).next().css("color","red");
        }
        else
        {
          $(this).next().css("color","black");
        }
      });



      $("#miforo").keyup(function(){
        if($(this).val().length > caracteres){
          $(this).val($(this).val().substr(0, caracteres));
        }
        var quedan = caracteres -  $(this).val().length;
        $(this).next().html("Te quedan <strong>"+  quedan+"</strong> caracteres.");
        if(quedan <= 10)
        {
          $(this).next().css("color","red");
        }
        else
        {
          $(this).next().css("color","black");
        }
      });



      <?php ###envio ajax de puntos para mostrarlos en pantalla  ?>

      jQuery.ajax({
        url:'<?php echo base_url(); ?>get_puntos_actual_ajax/<?php echo $this->uri->segment(3); ?>',
        type: "post",
        ajaxSend:function(result){              
          console.log ("ajaxSend\n");
        },
        success:function(result){               
          console.log ("success\n");
          $('.mis_puntos').html(result);
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




      if ($('.mis_puntos').html()=='0') { $('.mis_puntos').hide(); }
      if ($('.noti_numero').html()=='0') { $('.noti_numero').hide(); }


  
      <?php if ($this->uri->segment(2)=='empezar') { ?>

//$('.modulo_actual').parent().prev().attr('idmod');
<?php ### si el modulo anterior es nuevo , no lo he visto pero el actual si... ?>
if ($('.modulo_actual').parent().prev().attr('href')=='' ) {
  $('.modulo_actual').parent().prev().attr('href',$('.modulo_actual').parent().prev().attr('idmod'));
}

<?php #### para quedar en el modulo o actividad que quedé la ultima vez cuando estaba en el curso ?>
      var idmod_antes=$('.modulo_actual').parent().attr('idmod');

      jQuery.ajax({
        url:'<?php echo base_url(); ?>cursos/if_visto_actividad_barra/'+idmod_antes+'/<?php echo $this->uri->segment(3); ?>',
        type: "post",
        ajaxSend:function(result){              
          console.log ("ajaxSend\n");
        },
        success:function(result){               
          console.log ("success\n");
          var str=result;
          var rs = str.split("|");

          if (rs[0]=='no') { 
            $('.modulo_actual').parent().prev().removeAttr('href');
             }

          $('#act_btn_'+rs[1]).click();  <?php ### para que se vaya a la ultima actividad en la cual quedó el estudiante. ?>

          if (rs[2]!='0' && rs[2]!='') {
            if ('<?php echo $this->uri->segment(4); ?>'!=rs[2]) {

              $('.modules_wrap ul a').each(function(index, el) {

                <?php if (!$this->input->get('click')): ?>

                if ( $(this).attr('idmod')==rs[2] ) {
                // window.location = "<?php echo base_url(); ?>"+$(this).attr('href');
               }
             <?php endif; ?>
           });

              $('#act_btn_'+rs[1]).click(); 

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
<?php  ?>

<?php } ?>

if ( $('.modulo_actual').parent().next().attr('id')!='mimodulopremio')  {
  $('.modulo_actual').parent().next().attr( 'id',$('.modulo_actual').parent().next().attr('href') );
}


if ($('div.on').length == $('.tool_tip').attr('total')) {
  if ( $('.modulo_actual').parent().next().attr('id')!='mimodulopremio')  {
    $('.modulo_actual').parent().next().attr('href',$('.modulo_actual').parent().next().attr('id'));
  }

}




else {
  $('.modulo_actual').parent().next().removeAttr('href');
}



$('.modulo_off').each(function(index, el) {

  if ($(this).attr('desactivarmod')==1 ) {
    $(this).parent().attr( 'id',$(this).parent().attr('href') );
    $(this).parent().removeAttr('href');
  }


});






$('.act_block').click(function(event) {

  if ( Number(Number($('div.on').length))  == $('.tool_tip').attr('total')) {
    $('.modulo_actual').parent().next().attr('href',$('.modulo_actual').parent().next().attr('id'));
  }

  else {
    $('.modulo_actual').parent().next().removeAttr('href');
  }


});



$('.profile_dark p').click(function(event) {
  event.preventDefault();

  $('.perfil_col1 img').click();

});


<?php if ($this->uri->segment(2)=='empezar') { ?>

  $( document ).on( "click", ".status_bar > img,.circle_wrap > img,.status_bar.solocurso.clear img,.avatar_infoblock_col1 > h3", function() {
    window.open("<?php echo base_url(); ?>explicacion"); 
  });

  <?php } ?>



  $("#btn").click(function(event) {

   jQuery.ajax({
    url:'<?php echo base_url()."obtener_estatus_barra/".$this->uri->segment(3); ?>',
    type: "post",
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      var str=result;

      var rs = str.split("|");

      $('.status_bar').html(rs[0]);
      $('.puntos_proximo').html(rs[1]);
      $('.mistatus').html(rs[2]);
      $('.count_logros').html(rs[3]);
      $('.mi_listado_logros').html(rs[4]);

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



  $("#btn2").click(function(event) {

   jQuery.ajax({
    url:'<?php echo base_url()."get_notificaciones_ajax_list"; ?>',
    type: "post",
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      var str=result;
      var rs = str.split("|");

      $('.notificaciones_wrap > ul').html(rs[0]);
      $('.noti_numero').html(rs[1]);

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





  $("#btn22").click(function(event) {

   jQuery.ajax({
    url:'<?php echo base_url()."get_inbox_ajax_list"; ?>',
    type: "post",
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){               
      console.log ("success\n");
      var str=result;
      var rs = str.split("|");

      $('.inbos_wrap > ul').html(rs[0]);
      if (rs[1]>0) { $('.inbox_numero').show();  }
      $('.inbox_numero').html(rs[1]);

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




  $('.sinaccesop').click(function(event) {

    if ( $(this).prev().attr('next')=='ok' )  {

    }

    else {

      if ( $(this).hasClass('sinaccesop') )  {
        event.preventDefault();
        var sinAcceso = "No tienes acceso a esta actividad aún";
        alert(sinAcceso);
        return false;
      }

    }


  });



});

</script>

<?php if ($this->uri->segment(2)=='empezar') { ?>
<style>
  .circle_wrap > img {
    cursor: pointer;
  }
</style>
<?php } ?>


<footer style='<?php if ($custom_sistema->image_footer!='') { ?> background-image: url("uploads/personalizacion_general/<?php echo $custom_sistema->image_footer; ?>"); <?php } else {?> background-color: <?php echo $custom_sistema->colores_sistema3; ?>; height: 180px; margin:38px 0 0 0; <?php } ?>' <?php if ($this->uri->segment(1)=='cursos' && $this->uri->segment(2)=='empezar'): ?> <?php else: ?> class="special_footer" <?php endif ?>>
  <div class="footer_wrap">
    <div class="social" style='<?php if ($custom_sistema->image_footer!='') { ?> <?php } else { ?> margin: 40px 0 0 0; <?php } ?>'>  
     <a target="_blank" href="<?php echo $custom_sistema->facebook_sistema; ?>"><img src="html/site/img/face_icon.png" alt="facebook"></a>
     <a target="_blank" href="<?php echo $custom_sistema->twitter_sistema; ?> "><img src="html/site/img/tweet_icon.png" alt="twitter"> </a>
   </div>
   

   <p>
    <?php foreach ($contenidos_footer as $key => $value): ?>
     <a href="contenidos/informacion/<?php echo $value->id_contenidos; ?>/<?php echo amigable($value->titulo); ?>.html"><?php echo $value->titulo; ?></a> | 
   <?php endforeach ?>
   <a href="contenidos/informacion/7/soporte.html">Soporte</a> | <a href="contenidos/contacto.html">Cont&aacute;ctenos</a><br/>
   <a href="contenidos/informacion/6/terminos-y-condiciones.html">Terminos y condiciones</a><br/>
   desarrollado por ©  <a title="<?php echo $custom_sistema->copyright_nombre; ?>" target="_blank" href="<?php echo $custom_sistema->copyright_url; ?>"><?php echo $custom_sistema->copyright_nombre; ?></a>
 </p>




</div>
</footer>