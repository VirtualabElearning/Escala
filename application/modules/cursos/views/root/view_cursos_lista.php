<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Listado de <?php echo $titulo; ?> - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>  
  <style>
    .label {
      font-size: 90%;
    }
  </style>
</head>

<body>

  <?php $this->load->view('view_root_header'); ?> 


  <!-- Main content starts -->

  <div class="content">

   <?php $this->load->view('view_root_menu'); ?> 


   <div class="mainbar">


    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-table"></i> Listado de <?php echo $titulo; ?></h2>

      <!-- Breadcrumb -->
      <div class="bread-crumb pull-right">
       <a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
       <!-- Divider -->
       <span class="divider">/</span> 
       <a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista" class="bread-current">Modulo <?php echo $titulo; ?></a>
     </div>

     <div class="clearfix"></div>

   </div>





   <div class="matter">
    <div class="container">
      <div class="row">

        <?php if (validation_errors()): ?>
          <div class="col-md-12">
            <div class="alert alert-warning">
             <?php echo validation_errors(); ?>
           </div>
         </div>
       <?php endif ?>
       <div class="col-md-12">
         <?php ## si es admin o master ?>
         <?php if ($this->session->userdata('id_roles')==1 || $this->session->userdata('id_roles')==4 ): ?>
           <a href="<?php echo $this->uri->segment(1); ?>/root/nuevo" class="btn btn-success btn-xs"><i class="fa"></i> Nuevo</a>
         <?php endif; ?>
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

              <!-- Table Page -->
              <div class="page-tables">
                <!-- Table -->
                <div class="table-responsive">








                  <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">


                    <thead>
                      <tr>
                        <?php foreach ($titulos as $key => $value): ?>
                          <th> <?php echo $value; ?> </th>
                        <?php endforeach ?>
                      </tr>
                    </thead>

                    <tbody>


                      <?php #krumo ($lista); ?>

                      <?php foreach ($lista as $key => $value): ?>

                        <tr id="<?php echo $value->id_cursos; ?>">
                        <?php /* ?>
                         <td><?php echo $value->orden; ?></td>
                         <td><?php echo $value->id_cursos; ?></td>
                         <?php */ ?>
                         <td><?php echo $value->nombre_categoria; ?></td>
                         <td><?php echo $value->titulo; ?></td>
                         <td><?php echo truncate ($value->Descripcion,50); ?></td>
                         <td><?php echo $value->instructores_asignados_nombre; ?></td>
                         <?php /* ?>
                         <td><?php echo $value->tipo_plan; ?></td>
                         <?php */ ?>

                         <td><?php if ($value->destacar==1)  { echo "Si"; } else { echo "No"; } ?></td>
                         <td><?php echo $value->estado_nombre; ?></td>
                         <td>  

                          <?php if (in_array($this->session->userdata('id_roles'), $if_modulos)) {  ?>
                          <a href="modulos/root/lista/<?php echo $value->id_cursos; ?>" class="btn btn-primary btn-xs"><i class="fa"></i> <?php echo asignar_frase_diccionario ($diccionario,'{modulo}','Módulos',2) ?> </a> 


                          <a href="calificaciones/root/lista_estudiantes/<?php echo $value->id_cursos; ?>" class="btn btn-success btn-xs"><i class="fa"></i> <?php echo asignar_frase_diccionario ($diccionario,'{estudiante}','Estudiante',2) ?> </a> 



                          



                          <?php } ?>

                          <?php ### si soy docente!!! ?> 
                          <?php if ($this->session->userdata('id_roles')==2 ): ?>
                            <?php $if_clase_vivo=if_class_vivo($this->session->userdata('id_usuario'),$value->id_cursos); ?>
                            <a href="#claseEnVivo" <?php if ($if_clase_vivo!=0 ): ?> id_c="<?php echo $if_clase_vivo; ?>"  <?php endif; ?> id="<?php echo $value->id_cursos; ?>" curso="<?php echo $value->titulo; ?>" data-toggle="modal" class="progra_envio btn btn-warning btn-xs"><i class="fa"></i>Clase en vivo</a> 


                            <?php ## aqui agrego etiqueta de que es necesario calificar al menos 1 de éste curso ?>
                            <?php $if_calif=if_calificar3($value->id_cursos); ?>
                            <?php if ($if_calif>0): ?>
                              <span class="label label-danger">Por calificar (<?php echo $if_calif; ?>)</span>
                            <?php endif ?>
                          <?php endif; ?>




                          <?php if (in_array($this->session->userdata('id_roles'), $if_competencias)) {  ?>
                          <a href="competencias/root/lista/<?php echo $value->id_cursos; ?>" class="btn btn-warning btn-xs"><i class="fa"></i>Competencias</a> 
                          <?php } ?>



                          <?php ## si es admin o master ?>
                          <?php if ($this->session->userdata('id_roles')==1 || $this->session->userdata('id_roles')==4 ): ?>
                            <a href="<?php echo $this->uri->segment(1); ?>/root/editar/<?php echo $value->id_cursos; ?>" class="btn btn-info btn-xs"><i class="fa"></i> Editar</a> 
                            <a href="#" id="<?php echo $value->id_cursos; ?>" class="btn btn-danger btn-xs lanzar_confirmacion"><i class="fa"></i> Borrar</a> </td>
                          <?php endif; ?>
                        </tr>

                      <?php endforeach ?>         

                    </tbody>
                    <tfoot>
                      <tr>
                        <?php foreach ($titulos as $key => $value): ?>
                          <th> <?php echo $value; ?> </th>
                        <?php endforeach ?>
                      </tr>
                    </tfoot>
                  </table>













                  <div class="clearfix"></div>
                </div>
              </div>
            </div>


          </div>
          <div class="widget-foot">
            <!-- Footer goes here -->
          </div>
        </div>
      </div>  

    </div>
  </div>
</div>
</div>

<!-- Matter ends -->

</div>

<!-- Mainbar ends -->        
<div class="clearfix"></div>

</div>
<!-- Content ends -->


<form id="borrar_form" action ="<?php echo $this->uri->segment(1); ?>/root/borrar" method="POST">
  <input type="hidden" name="id" id="id">
  <button class='btn btn-danger btn-xs' type="submit" name="borrar" value="borrar"><span class="fa fa-times"></span> Borrar </button>
</form>

<div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Borrar registro</h4>
      </div>
      <div class="modal-body">
        <p>Está seguro de borrar este registro?</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-primary" id="borrar">Confirmar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
       <label class="checkbox-inline">
        <input type="checkbox" name="seguro" id="seguro" value="">Estoy seguro de borrar la información. 
      </label>
    </div>
  </div>
</div>
</div>



<?php ###################################### MODAL PARA GENERAR CLASE EN VIVO ###################################### ?>

<div id="claseEnVivo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Generar Clase en Vivo <span><b></b></span></h4>
      </div>


      <div class="modal-body">
       <form enctype="multipart/form-data" role="form" class="form-horizontal" accept-charset="utf-8" method="post" action="#">               

        <div class="explicacion_c">Programa tu clase en vivo, ten en cuenta que solo es permitido una a la vez, después de haber finalizado ésta podrás programar la siguiente.</div>

         <div class="form-group">
          <label class="col-lg-2 control-label">Clase con</label>
          <div class="col-lg-9">
            <select name="clase_con" id="clase_con">
              <option value="">Seleccione...</option>
              <option value="1">Hangout</option>
              <option value="2">GoToWebinar</option>
            </select>
          </div>
        </div>   



        <div class="form-group">
          <label class="col-lg-2 control-label">Codigo/Url</label>
          <div class="col-lg-9">

            <div id="clas1" class="clases">
             <textarea placeholder="Ingrese el codigo/iframe del Hangout" rows="5" class="form-control" id="codigo_clase" name="codigo_clase"></textarea>
           </div>


           <div id="clas2" class="clases">
            <input type="text" placeholder="Ingrese la url de la clase en vivo" class="form-control " id="url_clase" value="" name="url_clase">
          </div>
        </div>
      </div>   





      <div class="form-group">
        <label class="col-lg-2 control-label">Temática de la clase</label>
        <div class="col-lg-9">
          <textarea placeholder="Ingrese la Temática de la clase" rows="5" class="form-control" id="mensaje" name="mensaje"></textarea>
          <div class="counter_mensanje"></div>
        </div>
      </div>  


      <div class="form-group">
        <label class="col-lg-2 control-label">Fecha de la clase en vivo</label>
        <div class="col-lg-9">
          <div id="datetimepicker1" class="input-append input-group dtpicker">
            <input data-format="yyyy-MM-dd" type="text" name="fecha_envio" id="fecha_envio" class="form-control">
            <span class="input-group-addon add-on">
              <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>       

      <div class="form-group">
        <label class="col-lg-2 control-label">Hora de la clase en vivo</label>
        <div class="col-lg-9">
         <div id="datetimepicker2" class="input-append input-group dtpicker">
          <input data-format="hh:mm:ss" name="hora_envio" id="hora_envio" class="form-control" type="text">
          <span class="input-group-addon add-on">
            <i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar"></i>
          </span>
        </div>
      </div>
    </div>   
  </form>
</div>

<div class="modal-footer">
  <button type="button" id="cerrar_envio" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  <button type="button" class="btn btn-primary sender_envio" id="<?php echo $value->id_cursos; ?>">Programar y enviar</button>
</div>

</div>
</div>
</div>
<?php ###################################### MODAL PARA GENERAR CLASE EN VIVO ###################################### ?>



<?php $this->load->view('view_admin_footer'); ?>



<script>
  var fixHelper = function(e, ui) {
    ui.children().each(function() {
      $(this).width($(this).width());
    });
    return ui;
  };

  $("#data-table tbody").sortable({
    helper: fixHelper,
    update: function(event, ui) {
      $(".ajax-loader").show();
      var orden = $(this).sortable('toArray').toString();
      $.ajax({
        url: '<?php echo $this->uri->segment(1); ?>/root//ordenar',
        data: {"data": orden},
        type: 'post'
      }).done(function(data) {
      });
      $(".ajax-loader").hide();
    }
  }).disableSelection();


  $('.lanzar_confirmacion').on('click', function (e) {
    var idvar=$(this).attr('id');
    e.preventDefault();

    $('#confirm')
    .modal({ backdrop: 'static', keyboard: false })
    .one('click', '#borrar', function (e) {
      $('#id').val( idvar );


      if ($('#seguro').prop('checked')) { 
        $('#borrar_form').submit(); 
      }
      else {
        $('#borrar').next().click();
        return false;
      }


    });
  });





  $('#clase_con').on('change', function (event) {

    if ($(this).val()=='1')  {
      $('#clas1').show();
      $('#clas2').hide();
    }

    else {
      $('#clas2').show();
      $('#clas1').hide();
    }


  });



  $('.progra_envio').on('click', function (event) {

   event.preventDefault();
   $('.sender_envio').attr('id',$(this).attr('id'));

   $('#claseEnVivo .modal-title span b').html( '"'+$(this).attr('curso')+'"' );




   data = new Object;

   jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/root/getEnvio_Ajax/'+$('.sender_envio').attr('id'),
    type: "post",
    data:({
      data:data
    }),
    ajaxSend:function(result){              
      console.log ("ajaxSend\n");
    },
    success:function(result){      
      console.log ("success\n");
      str=result;
      var respuestas = str.split("|");

      if (respuestas[0]!='0') {

        if (respuestas[0]==1) {
          $("#clas2").show();
          $("#clas1").hide();
          $('#url_clase').val(respuestas[1]);
          $("#clase_con option[value='2']").attr('selected', 'selected');
        }
        else {
         $("#clas2").hide();
         $("#clas1").show(); 
         $('#codigo_clase').val(respuestas[1]);
         $("#clase_con option[value='1']").attr('selected', 'selected');
       }

       $('#mensaje').val(respuestas[6]);

       $("#id_estados option").filter(function() {
        return $(this).val() == respuestas[2]; 
      }).prop('selected', true);

       $('#fecha_envio').val(respuestas[3]);
       $('#hora_envio').val(respuestas[4]);
       $('.sender_envio').attr('id_c',respuestas[5]);

     }




   }



 });




});


$('.sender_envio').on('click', function (event) {
  event.preventDefault();
  data = new Object;
  
  if($('#clas1').css('display') == 'block'){
    $('#url_clase').val('');
    data.codigo_clase=$('#codigo_clase').val();
  }

  else {
    data.url_clase=$('#url_clase').val();
    $('#codigo_clase').val('');


  }


  data.mensaje=$('#mensaje').val();
  data.id_estados=$('#id_estados').val();
  data.fecha_envio=$('#fecha_envio').val();
  data.hora_envio=$('#hora_envio').val();
  data.id_cursos=$(this).attr('id');

  if ($(this).attr('id_c')>0) {
    data.id=$(this).attr('id_c');
  }

  jQuery.ajax({
    url:'<?php echo base_url(); ?>cursos/root/sendEnvio',
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
       alert ("Enviado correctamente!");  
       $('#cerrar_envio').click();
          // $('#claseEnVivo').modal('hide');
          $('#url_clase').val('');
          $('#mensaje').val('');
          $('#codigo_clase').val('');
          $('#id_estados').val('');
          $('#fecha_envio').val('');
          $('#hora_envio').val('');
        } else {
          alert (result);
          return false;
        }
      }

    });

});



$(document).ready(function() {

  var caracteres = 50;
  $(".counter_mensanje").html("Te quedan <strong>"+  caracteres+"</strong> caracteres.");





  $("#mensaje").keyup(function(){
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


});


</script>

</body>

</html>