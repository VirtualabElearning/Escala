<script>

  $(document).ready(function() {

    <?php ##funcion para ocultar el icono de notificaciones si no tiene ninguna ?>
    if ($('.inbox_numero').html().trim()=='') {
      $('.inbox_numero').hide();
    }

    <?php ## esto es para los mensajes del foro limitarlos a 500 caracteres ?>
    var caracteres = 500;
    $(".counter_foro").html("Te quedan <strong>"+  caracteres+"</strong> caracteres.");
    

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


    <?php ## funcion para detectar si el modulo anterior fué o no visto ?>

    var idmod_antes=$('.modulo_actual').parent().prev().attr('idmod');

    jQuery.ajax({
      url:'<?php echo base_url(); ?>cursos/if_visto_actividad_barra/'+idmod_antes,
      type: "post",
      ajaxSend:function(result){              
        console.log ("ajaxSend\n");
      },
      success:function(result){               
        console.log ("success\n");

        if (result=='no') {     $('.modulo_actual').parent().prev().removeAttr('href'); }

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


    $( document ).on( "click", ".status_bar > img,.circle_wrap > img,.status_bar.solocurso.clear img,.avatar_infoblock_col1 > h3", function() {
      window.open("<?php echo base_url(); ?>explicacion"); 
    });





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




  });

</script>

<footer <?php if ($this->uri->segment(1)=='cursos' && $this->uri->segment(2)=='empezar'): ?> <?php else: ?> class="special_footer" <?php endif ?>>
  <div class="footer_wrap">
    <div class="social">  
     <a target="_blank" href="<?php echo $custom_sistema->facebook_sistema; ?>"><img src="html/site/img/face_icon.png" alt="facebook"></a>
     <a target="_blank" href="<?php echo $custom_sistema->twitter_sistema; ?> "><img src="html/site/img/tweet_icon.png" alt="twitter"> </a>
   </div>
   

   <p>
    <?php foreach ($contenidos_footer as $key => $value): ?>
     <a href="contenidos/informacion/<?php echo $value->id_contenidos; ?>/<?php echo amigable($value->titulo); ?>.html"><?php echo $value->titulo; ?></a> | 
   <?php endforeach ?>
   <a href="#">Soporte</a> | <a href="contenidos/contacto.html">Cont&aacute;ctenos</a><br/>
   <a href="contenidos/informacion/6/terminos-y-condiciones.html">Terminos y condiciones</a><br/>
   desarrollado por ©  <a title="<?php echo $custom_sistema->copyright_nombre; ?>" target="_blank" href="<?php echo $custom_sistema->copyright_url; ?>"><?php echo $custom_sistema->copyright_nombre; ?></a>
 </p>




</div>
</footer>