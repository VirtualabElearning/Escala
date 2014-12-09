<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?=base_url()?>" />   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title>Modulo <?php echo $titulo; ?> (Editar registro) - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>

  <?php $this->load->view('view_root_header'); ?> 

  <div class="content">

    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">

      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i> Modulo <?php echo $titulo; ?> (Editar registro)</h2>
        <div class="bread-crumb pull-right">
          <a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
          <span class="divider">/</span> 
          <a href="cursos/root/lista/<?php echo $this->uri->segment(4); ?>" class="bread-current">Cursos</a>
          <span class="divider">/</span> 
          <a href="modulos/root/lista/<?php echo $this->uri->segment(5); ?>" class="bread-current">Modulos</a>
          <span class="divider">/</span> 
          <a href="<?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" class="bread-current">Actividades</a>

          
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="matter">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><?php echo $titulo; ?></div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">

                    <br />

                    <?php $attributos=array('class'=>'form-horizontal','role'=>'form','id'=>'form_editar_actividad'); ?>
                    <?=form_open_multipart(base_url().$carpeta.'/root/guardar',$attributos)?>
                    <?php echo input_text ("Nombre ".asignar_frase_diccionario ($diccionario,'{actividades}','Actividad',1),"nombre_actividad","nombre_actividad","Ingrese el nombre",$detalle->datos_actividad->nombre_actividad,form_error('nombre_actividad', '<div class="mensaje_error">', '</div>')); ?>
                    <input type="hidden" name="descripcion_actividad" id="descripcion_actividad" value="descripcion">
                    <?php #echo textarea ("Descripción ".asignar_frase_diccionario ($diccionario,'{actividades}','Actividad',1),"descripcion_actividad","descripcion_actividad","Ingrese la descripción",$detalle->datos_actividad->descripcion_actividad,form_error('descripcion_actividad', '<div class="mensaje_error">', '</div>')); ?>
                    <?php 
                    $opciones=array("0"=>"Ninguno");
                    foreach ($logros_lista as $key => $value) {
                      $opciones[$value->id_logros]=$value->nombre;
                    }
                    echo select ("Logro","id_logros","id_logros",$opciones,$detalle->datos_actividad->id_logros); 
                    ?>

                    <?php  $opciones=array();
                    foreach ($planes_lista as $key => $value) {
                      $opciones[$value->id_tipo_planes]=$value->nombre;
                    }
                    echo select ("Plan","id_tipo_planes","id_tipo_planes",$opciones,$detalle->datos_actividad->id_tipo_planes); 
                    ?>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Opciones personalizadas</label>
                      <div class="col-lg-10">

                       <ul id="myTab" class="nav nav-tabs">
                        <?php foreach ($tipo_actividades_lista as $key => $actividades_value): ?>

                          <?php ## solo si es video y si es master o admin puede crear pregunta rapida y video, si es un instructor no! ?>
                          <?php if ($actividades_value->id_tipo_actividades==1 ): ?>
                            <?php if ($this->session->userdata('id_roles')==1 || $this->session->userdata('id_roles')==4 ): ?>

                              <li <?php if ($detalle->id_tipo_actividades==$actividades_value->id_tipo_actividades): ?>  class="active" <?php endif; ?>><a class="tipo_actividades" id="<?php echo $actividades_value->id_tipo_actividades; ?>" href="#<?php echo amigable($actividades_value->nombre_tipo_actividades); ?>" data-toggle="tab"><?php echo ($actividades_value->nombre_tipo_actividades); ?></a></li>
                            <?php endif ?>

                          <?php else: ?>
                            <li <?php if ($detalle->id_tipo_actividades==$actividades_value->id_tipo_actividades): ?>  class="active" <?php endif; ?>><a class="tipo_actividades" id="<?php echo $actividades_value->id_tipo_actividades; ?>" href="#<?php echo amigable($actividades_value->nombre_tipo_actividades); ?>" data-toggle="tab"><?php echo ($actividades_value->nombre_tipo_actividades); ?></a></li>
                          <?php endif ?>
                        <?php endforeach ?>
                      </ul>

                      <div id="myTabContent" class="tab-content">
                       <?php foreach ($tipo_actividades_lista as $key => $actividades_value): ?>
                         <div class="tab-pane fade in <?php if ($detalle->id_tipo_actividades==$actividades_value->id_tipo_actividades): ?> active <?php endif; ?>" id="<?php echo amigable($actividades_value->nombre_tipo_actividades); ?>">
                          <?php ## solo si es video y si es master o admin puede crear pregunta rapida y video, si es un instructor no! ?>
                          <?php if ($actividades_value->id_tipo_actividades==1 ): ?> 
                           <?php if ($this->session->userdata('id_roles')==1 || $this->session->userdata('id_roles')==4 ): ?>
                            <?php echo  generar_campos_actividad($actividades_value->id_tipo_actividades,$detalle->id_actividades,$detalle->tabla_actividad,$detalle->datos_actividad,$detalle->id_modulos,$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6)); ?>
                          <?php endif ?>

                        <?php else: ?>
                          <?php echo  generar_campos_actividad($actividades_value->id_tipo_actividades,$detalle->id_actividades,$detalle->tabla_actividad,$detalle->datos_actividad,$detalle->id_modulos,$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6)); ?>
                        <?php endif ?>

                      </div>
                    <?php endforeach ?>
                  </div>
                </div>

              </div>

              <?php 
              $opciones=array("1"=>"Activo","0"=>"Inactivo");
              echo select ("Estado","id_estados","id_estados",$opciones,$detalle->id_estados); 
              ?>

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-6">
                  <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>

                  <?php if ($this->uri->segment(4)): ?>
                    <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>/lista/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                  <?php endif ?>

                  <?php if ($this->input->post('id')): ?>
                    <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>/lista/<?php echo $this->input->post('id_cursos'); ?>/<?php echo $this->input->post('id_modulos'); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                  <?php endif ?>

                </div>
              </div>

              <?php if ($this->input->post('id')): ?>
                <?=form_hidden('id',$this->input->post('id'))?>
                <?=form_hidden('id_modulos',$this->input->post('id_modulos'))?>
                <?=form_hidden('id_cursos',$this->input->post('id_cursos'))?>
                <?=form_hidden('id_actividades',$detalle->id_actividades)?>
                <?=form_hidden('id_tipo_actividades',$detalle->id_tipo_actividades)?>
                <?=form_hidden('id_tipo_actividades_antes',$detalle->id_tipo_actividades)?>
                <?=form_hidden('id_modulos',$detalle->id_modulos)?>
              <?php endif; ?>

              <?php if ($this->uri->segment(4)): ?>
               <?=form_hidden('id',$this->uri->segment(6))?>
               <?=form_hidden('id_modulos',$this->uri->segment(5))?>
               <?=form_hidden('id_cursos',$this->uri->segment(4))?>
               <?=form_hidden('id_actividades',$detalle->id_actividades)?>
               <?=form_hidden('id_tipo_actividades',$detalle->id_tipo_actividades)?>
               <?=form_hidden('id_tipo_actividades_antes',$detalle->id_tipo_actividades)?>
               <?=form_hidden('id_modulos',$detalle->id_modulos)?>
             <?php endif ?>

             <?=form_close()?>

           </div>
         </div>
         <div class="widget-foot">
         </div>
       </div>
     </div>  

   </div>
 </div>
</div>
</div>

<div class="clearfix"></div>

</div>

<?php $this->load->view('view_admin_footer'); ?>
<script> 
  $(document).ready(function() {


    <?php if (  $this->uri->segment(7)=='guardado_ok_redirect'  ) :?>
    $("#add_preguntas_click").bind('click');
    $("#add_preguntas_click").click();
  <?php endif; ?>


  $('.tipo_actividades').click(function(event) {
    $( "input[name='id_tipo_actividades']" ).val( $(this).attr('id') );
  });

  $( "select[name='tipo_pregunta']" ).parent().attr('class','col-lg-4');
  $( "select[name='tipo_pregunta']" ).parent().after('<div class="col-lg-2"> <a id="add_respuestas" data-toggle="modal" href="#modal_respuestas"><button class="btn btn-sm btn-info" type="button">Agregar respuestas</button></a></div>');

// si es campo de texto
if ($('div.active #tipo_pregunta option:selected').val()==4 || $(this).val()==0)  {
 $('#add_respuestas').hide();
}

$( "select[name='tipo_pregunta']" ).change(function(event) {
 event.preventDefault();

 if ($(this).val()==4 || $(this).val()==0)  {
   $(this).parent().next().children('#add_respuestas').hide();
 }
 else {
  $(this).parent().next().children('#add_respuestas').show();
}
});


$('#add_preguntas').click(function(event) {
  event.preventDefault(); 
/// si no son iguales, borro la que esta y meto una nueva con otro tipo de actividad (Fix para preguntas multiples)
if ($( "input[name='id_tipo_actividades']").val()!=$( "input[name='id_tipo_actividades_antes']").val() )  {

  var r = confirm("Esta seguro de crear preguntas?, esto cambiará de forma inmediata el tipo de pregunta sin vuelta atrás.");
  if (r == true) {

    if ( $('#nombre_actividad').val()=='' ) {
     $("#add_preguntas_click").unbind('click');
     alert ("Por favor, escriba el nombre de la actividad!");
     return false;
   }

   if ( $('#Descripcion_actividad').val()=='' ) {
     $("#add_preguntas_click").unbind('click');
     alert ("Por favor, escriba la Descripcion de la actividad!");
     return false;
   }

   $('form').append('<input type="hidden" name="redirecter_pretty_editar" value="ok" />');
   $('.btnguardar').click();

 } else {
   return false;
 }

}

else {
  $("#add_preguntas_click").bind('click');
  $("#add_preguntas_click").click();
}

});




$('#add_respuestas').click(function(event) {
 event.preventDefault();

 $('#nombre_pregunta').val( $('#pregunta').val() );
 $('#tipo_pregunta_opc').val( $('#tipo_pregunta').val() );
 $('#nom_activ').val( $('#nombre_actividad').val() );
 $('#desc_acti').val( $('#Descripcion_actividad').val() );
 $('#id_tipo_actividades_var').val( $( "input[name='id_tipo_actividades']").val());
 $('#id_actividades_var').val( $( "input[name='id_actividades']").val());
 $('#id_cursos_var').val( $( "input[name='id_cursos']" ).val());
 $('#id_modulos_var').val( $( "input[name='id_modulos']" ).val());
 $('#id_tipo_actividades_antes_var').val( $( "input[name='id_tipo_actividades_antes']").val());
 $('#id_var').val( $( "input[name='id']" ).val());
 $('#id_estados_var').val( $('#id_estados').val());
// si es tipo video, le envio el video
if ( $('#id_tipo_actividades_var').val()==1)  {
  $('#url_video_var').val($('#url_video').val());
}

if ( $('#tipo_pregunta').val()==2 )  {
  $('.opciones_correctas').each(function(index, el) {
    $(this).attr('type','radio');

  });

}


if ( $('#tipo_pregunta').val()==1 )  {
  $('.opciones_correctas').each(function(index, el) {
    $(this).attr('type','checkbox');
  });

}


if ($('#id_tipo_actividades_antes_var').val()==$( "input[name='id_tipo_actividades']").val())  {

  data = new Object;
  data.id_tipo_actividades = $( "input[name='id_tipo_actividades']").val();
  data.id_actividades =$( "input[name='id_actividades']").val();

  jQuery.ajax({
    type: 'POST',
    url:'actividades/root/consultar_posibles_respuestas',
    data:({
      data:data
    }),

    ajaxSend:function(result){        
      console.log ("ajaxSend\n");
    },
    success:function(result){       
      console.log ("success\n");
      var json = $.parseJSON(result);

// ciclo primero para crear elementos
$.each(json, function(i,item){

  var id_actual=Number(i+1);

// si existe no hago nada
if ( $('#rta'+parseInt(Number(i+1))).length>0 )  {


}
// si no, clono e ingreso valores
else {
  $("#id_actual").val(id_actual);
  $("#rta0").clone().appendTo(".rta_lista");
  $(".rta_lista > div").last().attr("id","rta"+id_actual);
  $(".rta_lista > div").last().show();
  $(".rta_lista > div").last().addClass('respuestas_lista');

  $(".respuestas_lista").last().attr("id","rta"+id_actual);
  $('#rta'+id_actual+' > div >input').val(item.posible_respuesta);
  $('#rta'+id_actual+' > div >input').attr('placeholder','Opcion '+Number(id_actual));
  $('#rta'+id_actual+' > div').next().children().val(item.retroalimentacion);
  $('#rta'+id_actual+' > div').next().children().attr('placeholder','Retroalimentacion '+Number(id_actual));

}

});

console.log(json);
// ciclo para asignar valores a los elementos creados
$.each(json, function(i,item){
  var id_actual=Number(i+1);
// si existe el elemento, ingreso valores
if ( $('#rta'+parseInt(Number(i+1))).length>0 )  {
 $('#rta'+id_actual+' >div >input').val(item.posible_respuesta);
 $('#rta'+id_actual+' >div').next().children().val(item.retroalimentacion);
 if (item.correcta==1)  { 
 // si es radiobutton
 if ($('#tipo_pregunta_opc').val()==2)   {    
   $('#rta'+id_actual+' > div').next().children().children('.opciones_correctas').click();
 }

 $('#rta'+id_actual+' > div').next().children().children('.opciones_correctas').attr("checked", true);
} 

else {
  $('#rta'+id_actual+' > div').next().children().children('.opciones_correctas').attr("checked", false);
}

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

}

});



$('.btnguardar').click(function(event) {
 event.preventDefault();
 $('.tab-pane').each(function(index, el) {
  if ( $(this).hasClass('active') )  { }
    else { $(this).remove(); }
});

 $('#form_editar_actividad').submit();

});

$('.clone').click(function(event) {

 event.preventDefault();
 $("#id_actual").val( $('.respuestas_lista').length );


 var id_actual=$("#id_actual").val();
 var id_actual_num=parseInt(id_actual);
 id_actual_num++;
 $("#id_actual").val(id_actual_num);
 $("#rta0").clone().appendTo(".rta_lista");
 $(".rta_lista > div").last().attr("id","rta"+id_actual_num);

 $(".rta_lista > div").last().show();
 $(".rta_lista > div").last().addClass('respuestas_lista');

 $('#rta'+id_actual_num+' > div >input').attr('placeholder','Opcion '+Number(id_actual_num));
 $('#rta'+id_actual_num+' > div').next().children().attr('placeholder','Retroalimentacion '+Number(id_actual_num));


});


$(document).on('click', '.deleter', function(event) {
 event.preventDefault();
 $(this).parent().parent().remove();
});


$('.guardar_respuestas').click(function(event) {
 event.preventDefault();
 var if_chekeado=0;
 $('.opciones_correctas').each(function(index, el) {
   var $this = $(this);

   if (this.checked) { if_chekeado=1;  $(this).val(index);  }

 });


 if (if_chekeado==0 && ($('#tipo_pregunta_opc').val()==1 || $('#tipo_pregunta_opc').val()==2|| $('#tipo_pregunta_opc').val()==3) )  {  alert ("Debe indicar al menos una que sea correcta!"); return false;  }

 var tmp = $('#forma_modal_resp').serialize();


 jQuery.ajax({
  type: 'POST',
  url:'actividades/root/guardar_respuestas',
  data: 'envio=' + encodeURIComponent(tmp),

  ajaxSend:function(result){        
    console.log ("ajaxSend\n");

  },
  success:function(result){       
    console.log ("success\n");
    alert (result);
    $('#modal_respuestas').modal('hide');
    location.reload(); 
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


<div id="modal_respuestas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal_resps">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Lista de respuestas</h4>
      </div>
      <div class="modal-body">

        <form id="forma_modal_resp" role="form" class="form-horizontal">

          <div class="form-group rta_lista">

            <div id="rta1" class="respuestas_lista col-lg-11">
              <div class="col-lg-5">
                <input type="text" placeholder="Opcion 1" name="respuesta[]" class="form-control respuestaclass">
              </div>

              <div class="col-lg-5">
                <input type="text" placeholder="Retroalimentacion 1" name="retroalimentacion[]" class="form-control retroclass">
              </div>

              <div class="col-lg-1 correctc">
                <label class="checkbox-inline">
                  <input type="checkbox" class="opciones_correctas" name="correcta[]" id="inlineCheckbox1"> Correcta?
                </label>
              </div>  
            </div>

          </div>

          <input type="hidden" id="id_actual" value="1">
          <input type="hidden" id="nombre_pregunta" name="nombre_pregunta">
          <input type="hidden" id="tipo_pregunta_opc" name="tipo_pregunta_opc">
          <input type="hidden" id="nom_activ" name="nom_activ">
          <input type="hidden" id="desc_acti" name="desc_acti">
          <input type="hidden" id="id_tipo_actividades_var" name="id_tipo_actividades_var">
          <input type="hidden" id="id_actividades_var" name="id_actividades_var">
          <input type="hidden" id="id_cursos_var" name="id_cursos_var">
          <input type="hidden" id="id_modulos_var" name="id_modulos_var">
          <input type="hidden" id="id_tipo_actividades_antes_var" name="id_tipo_actividades_antes_var">
          <input type="hidden" id="id_var" name="id_var">
          <input type="hidden" id="id_estados_var" name="id_estados_var">
          <input type="hidden" id="url_video_var" name="url_video_var">
        </form>

        <div class="col-lg-1 clonx">     
          <div class="btn-group">
           <a href="#" class="clone">  <button class="btn btn-xs btn-default"><i class="fa fa-copy"></i> </button> </a>

         </div>
       </div>


     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
      <button type="button" class="btn btn-primary guardar_respuestas">Guardar respuestas</button>
    </div>
  </div>
</div>
</div>


<div id="rta0" class=" col-lg-11" style="display:none;">
  <div class="col-lg-5">
    <input type="text" placeholder="Opcion " name="respuesta[]" class="form-control respuestaclass">
  </div>

  <div class="col-lg-5">
    <input type="text" placeholder="Retroalimentacion" name="retroalimentacion[]" class="retroclass form-control">
  </div>

  <div class="col-lg-1 correctc">
    <label class="checkbox-inline">
      <input type="checkbox" class="opciones_correctas" name="correcta[]" id="inlineCheckbox1"> Correcta?
    </label>
  </div>  

  <div class="col-lg-1 "><a class="btn btn-xs btn-default deleter" href="#"><i class="fa fa-times"></i></a></div>

</div>

</body>
</html>