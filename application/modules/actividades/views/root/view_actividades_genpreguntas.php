<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?=base_url()?>" />   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo $titulo; ?> (Nuevo registro) - Adminsitrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



</head>
<style>

  .container {
    width: 100%;
  }
</style>
<body>

  <div class="content">
    <div class="matter">
      <div class="container">

        <a href="#" id="clone_preguntart" title="Generar nueva pregunta"><h2 class="pull-left"><i class="fa fa-question"></i> Generar nueva pregunta</h2></a>


        <div class="saveall">
          <a class="btn btn-info guardar_todo" href="#">Guardar todo</a>
        </div>


        <div class="row">
          <div class="col-md-12 list_preguntas">
           <?php $attributos=array('class'=>'form-horizontal','role'=>'form','id'=>'form_preguntas_modal'); ?>
           <?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>
           <?php #krumo ($detalle); ?>









           <div id="pregunta1" class="preguntas_lts">


            <div class="widget">
              <div class="widget-head">
                <div class="pull-left title_preguntap">Pregunta <span></span></div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <br />
                  
                  <div id="pta1" class="preguntas_lista">
                    <div class="col-lg-5">
                      <input type="text" class="form-control" rel="" name="pregunta[]" placeholder="Ingrese la Pregunta">
                    </div>
                    <div class="form-group">
                      <label class="col-lg-1 control-label">Tipo pregunta</label>
                      <div class="col-lg-4">
                        <select id="tipo_pregunta" rel="" name="tipo_pregunta[]" class="form-control"><option value="1">Selección múltiple</option><option value="2">Lista desplegable</option><option value="3">Campo de texto</option></select></div></div>
                      </div>
                    </div>
                  </div>


                  <hr>


                  <div class="cloneresp">
                    <a href="#" title="Generar nueva pregunta" class="clone_rta"><h4 class="pull-left"><i class="fa fa-copy"></i> Generar nueva respuesta</h4></a>
                  </div>


                  <div class="form-group rta_lista_preguntas">

                    <div id="rrta1" class="respuestas_lista_preguntas">
                      <div class="col-lg-5">
                        <input type="text" class="form-control" rel="respuesta" name="respuesta1[]" placeholder="Respuesta">
                      </div>

                      <div class="col-lg-5">
                        <input type="text" class="form-control" rel="retroalimentacion" name="retroalimentacion1[]" placeholder="Retroalimentacion">
                      </div>

                      <div class="col-lg-1 correctc">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" rel="correcta" name="correcta1[]" checked="true" class="opciones_correctas"> Correcta?
                        </label>
                      </div>  
                    </div>







                  </div>














                  <div class="widget-foot">
                  </div>
                </div>



              </div>


















              <?=form_close()?>
            </div>  




          </div>

          <div class="saveall">
            <a class="btn btn-info guardar_todo" href="#">Guardar todo</a>
          </div>


        </div>
      </div>






      <div class="clearfix"></div>

    </div>


    <script>

      $(document).on('click', '.opciones_correctas', function(event) {
        $('.opciones_correctas').each(function(index, el) {
          $(this).parent().removeClass('error_check');
        });
      });




      $(document).on('change', "select[name='tipo_pregunta[]']" , function(event) {
       event.preventDefault();




    
     });



      $(document).on('click', '.deleter_pregunta', function(event) {
       event.preventDefault();
       $(this).parent().parent().parent().parent().parent().remove();
     });

      $(document).on('click', '.deleter_rta', function(event) {
       event.preventDefault();
       $(this).parent().parent().remove();
     });

      $('#clone_preguntart').click(function(event) {
        event.preventDefault();
        var id_actual= Number( $("#id_actual").val() ) +1;
        $("#id_actual").val(id_actual);
        $("#pregunta1").clone().appendTo(".list_preguntas > form");
        $(".preguntas_lts").last().attr("id","pregunta"+id_actual);
        $(".preguntas_lts").last().find('.title_preguntap').append(' <div class="col-lg-1 del_icon"><a class="btn btn-xs btn-default deleter_pregunta" href="#"><i class="fa fa-times"></i></a></div>');



        $(".preguntas_lts").last().find('input').each(function(index, el) {
          if ($(this).attr('rel')!='')  {
            $(this).attr('name',$(this).attr('rel')+id_actual+'[]');
          }
        });


        $(".preguntas_lts").last().find('select').each(function(index, el) {
          if ($(this).attr('rel')!='')  {
            $(this).attr('name',$(this).attr('rel')+id_actual+'[]');
          }
        });




      });












      $(document).on('click', '.clone_rta', function(event) {
        event.preventDefault();
        var id_actual= Number( $(this).parent().next().children('.respuestas_lista_preguntas').length ) +1;
       // $("#id_actual").val(id_actual);
       $(this).parent().next().children('.respuestas_lista_preguntas').first().clone().appendTo(  $(this).parent().next('.rta_lista_preguntas')   );
       $(this).parent().next().children('.respuestas_lista_preguntas').last().attr("id","rrta"+id_actual);
       $(this).parent().next().children('.respuestas_lista_preguntas').last().append(' <div class="col-lg-1 del_icon"><a class="btn btn-xs btn-default deleter_rta" href="#"><i class="fa fa-times"></i></a></div>');
     });



      $('.guardar_todo').click(function(event) {
        event.preventDefault();
        var if_chekeado=0;



        $('.preguntas_lts').each(function(index, el) {
          var thisgrand=$(this);
          if_chekeado=0;


//alert ( thisgrand.children().children('.rta_lista_preguntas').children('.respuestas_lista_preguntas').children('.correctc').children('label').children('.opciones_correctas').attr('id'));


thisgrand.children().children('.rta_lista_preguntas').children('.respuestas_lista_preguntas').children('.correctc').children('label').children('.opciones_correctas').each(function(index, el) {


 if ($(this).is(':checked')) { if_chekeado=1;  $(this).val(index);  }

});


if (if_chekeado==0)  { 
  alert ("Tiene que seleccionar al menos una correcta"); 
  thisgrand.children().children('.rta_lista_preguntas').children('.respuestas_lista_preguntas').children('.correctc').children('label').addClass('error_check');
  return false;
}

});


        var tmp = $('#form_preguntas_modal').serialize();




        jQuery.ajax({
          type: 'POST',
          url:'actividades/root/guardar_preguntas_coonrespuestas',
          data: 'envio=' + encodeURIComponent(tmp),

          ajaxSend:function(result){        
            console.log ("ajaxSend\n");

          },
          success:function(result){       
            console.log ("success\n");
            alert (result);
   // $('#modal_respuestas').modal('hide');
    //location.reload(); 
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












</script>
<input type="hidden" name="id_actual"  id="id_actual"  value="1">
</body>
</html>