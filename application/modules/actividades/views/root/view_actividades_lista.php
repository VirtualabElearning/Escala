<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Listado de <?php echo $titulo; ?> - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>
<body>

  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">

   <?php $this->load->view('view_root_menu'); ?> 

   <div class="mainbar">

    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-table"></i> Listado de <?php echo $titulo; ?></h2>
      <div class="bread-crumb pull-right">
        <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Inicio</a> 
        <span class="divider">/</span> 
        <a href="cursos/root/lista/<?php echo $this->uri->segment(3); ?>" class="bread-current">Cursos</a>
        <span class="divider">/</span> 
        <a href="modulos/root/lista/<?php echo $this->uri->segment(4); ?>" class="bread-current">Modulos</a>
      </div>

      <div class="clearfix"></div>

    </div>

    <div class="matter">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
           <a href="<?php echo $this->uri->segment(1); ?>/root/nuevo/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" class="btn btn-success btn-xs"><i class="fa"></i> Nuevo</a>
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
                <div class="page-tables">
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

                        <?php foreach ($lista as $key => $value): ?>

                         <?php ## solo si es video y si es master o admin puede crear pregunta rapida y video, si es un instructor no! ?>
                         <?php if ($value->id_tipo_actividades==1 ): ?> 
                           <?php if ($this->session->userdata('id_roles')==1 || $this->session->userdata('id_roles')==4 ): ?>

                            <tr id="<?php echo $value->id_actividades_barra; ?>">
                             <td><?php echo $value->orden; ?></td>
                             <td><?php echo $value->id_actividades_barra; ?></td>
                             <td><?php echo $value->nombre_categoria_curso; ?></td>
                             <td><?php echo $value->nombre_curso ; ?></td>
                             <td><?php echo $value->nombre_tipo_actividades; ?></td>
                             <td><?php echo $value->datos_actividad->nombre_actividad; ?></td>
                             <td><?php echo $value->datos_actividad->descripcion_actividad; ?></td>
                              <td><?php echo $value->datos_actividad->nombre; ?></td>
                             <td><?php echo $value->estado_nombre; ?></td>
                             <td>  
                              <a href="<?php echo $this->uri->segment(1); ?>/root/editar/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $value->id_actividades_barra; ?>" class="btn btn-info btn-xs"><i class="fa"></i> Editar</a> 
                              <a href="#" id="<?php echo $value->id_actividades_barra; ?>" class="btn btn-danger btn-xs lanzar_confirmacion"><i class="fa"></i> Borrar</a> </td>
                            </tr>

                          <?php endif; ?>
                        <?php else: ?>

                            <tr id="<?php echo $value->id_actividades_barra; ?>">
                             <td><?php echo $value->orden; ?></td>
                             <td><?php echo $value->id_actividades_barra; ?></td>
                             <td><?php echo $value->nombre_categoria_curso; ?></td>
                             <td><?php echo $value->nombre_curso ; ?></td>
                             <td><?php echo $value->nombre_tipo_actividades; ?></td>
                             <td><?php echo $value->datos_actividad->nombre_actividad; ?></td>
                             <td><?php echo $value->datos_actividad->descripcion_actividad; ?></td>
                              <td><?php echo $value->datos_actividad->nombre; ?></td>
                             <td><?php echo $value->estado_nombre; ?></td>
                             <td>  
                              <a href="<?php echo $this->uri->segment(1); ?>/root/editar/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $value->id_actividades_barra; ?>" class="btn btn-info btn-xs"><i class="fa"></i> Editar</a> 
                              <a href="#" id="<?php echo $value->id_actividades_barra; ?>" class="btn btn-danger btn-xs lanzar_confirmacion"><i class="fa"></i> Borrar</a> </td>
                            </tr>

                        <?php endif; ?>
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
          </div>
        </div>
      </div>  

    </div>
  </div>
</div>
</div>



</div>

        
<div class="clearfix"></div>

</div>

<form id="borrar_form" action ="<?php echo $this->uri->segment(1); ?>/root/borrar/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="POST">
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
     </div>
   </div>
 </div>
</div>

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
        url: '<?php echo $this->uri->segment(1); ?>/root/ordenar',
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
      $('#borrar_form').submit(); 
    });
  });

</script>
</body>
</html>