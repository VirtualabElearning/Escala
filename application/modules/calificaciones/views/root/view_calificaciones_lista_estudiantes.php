<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Listado de <?php echo str_replace("_", " ", $titulo); ?> - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
   <?php $this->load->view('view_root_menu'); ?> 
   <div class="mainbar">
    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-table"></i> Listado de <?php echo str_replace("_", " ", $titulo); ?></h2>
      <div class="bread-crumb pull-right">
       <a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
       <span class="divider">/</span> 
       <a href="<?php echo base_url(); ?>cursos/root" class="bread-current">Lista de cursos</a>      </div>
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
<?php /* ?>
   <a href="<?php echo $this->uri->segment(1); ?>/root/nuevo" class="btn btn-success btn-xs"><i class="fa"></i> Nuevo</a>
   <?php */ ?>   

   <a href="<?php echo $this->uri->segment(1); ?>/root/exportar/<?php echo $this->uri->segment(4); ?>" class="btn btn-success btn-xs"><i class="fa"></i>Exportar todo</a>



   <div class="widget">
    <div class="widget-head">
      <div class="pull-left"><?php echo str_replace("_", " ", $titulo); ?></div>
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
                <?php #krumo ($lista); ?>
                <?php foreach ($lista as $key => $value): ?>

                  <tr id="<?php echo $value->id_cursos_asignados; ?>">

                   <?php if ($value->foto_estudiante): ?>
                    <td><img src="escalar.php?src=<?php echo base_url().'uploads/aprendices/'.$value->foto_estudiante; ?>&w=126&h=126&zc=1" alt=""></td>
                  <?php else: ?>
                    <td><img src="escalar.php?src=<?php echo base_url().'html/site/img/sin_foto.png';?>&w=126&h=126&zc=1" alt=""></td>
                  <?php endif ?>

                  <td><?php echo $value->identificacion; ?></td>
                  <td><?php echo $value->nombres; ?></td>
                  <td><?php echo $value->apellidos; ?></td>
                  <td><?php echo $value->correo; ?></td>

                  <td><?php echo get_porcentaje_usuario($value->id_usuarios,$value->id_cursos); ?>%</td>
                  <td><?php echo get_puntos_curso($value->id_usuarios,$value->id_cursos); ?></td>
                  <td><?php echo $value->nombre_estatus; ?></td>
                  <?php $if_calif=if_calificar2($value->id_usuarios,$value->id_cursos); ?>
                  <td><?php if ($if_calif==0) { echo "Si"; } if ($if_calif==1) { echo "No"; } ?></td>
                  <?php if ($this->session->userdata('id_roles')==$this->config->item('roles_master') || $this->session->userdata('id_roles')==$this->config->item('roles_administrador')) { ?>
                  <td><?php echo $value->nombre_plan; ?></td>
                  <?php } ?>

                  <?php if ($this->session->userdata('id_roles')==$this->config->item('roles_docente')) : ?>
                    <td> 
                     <?php if ($if_calif<1): ?>
                       <a href="<?php echo $this->uri->segment(1); ?>/root/evaluaciones/<?php echo $this->uri->segment(4); ?>/<?php echo $value->id_usuarios; ?>" class="btn btn-info btn-xs"><i class="fa"></i> Calificar</a> 
                     <?php else: ?>
                     <?php endif; ?>

                     <?php if (get_porcentaje_usuario($value->id_usuarios,$value->id_cursos)==100): ?>
                      <a target="_blank" href="get_certificado/<?php echo$value->id_cursos; ?>/<?php echo $value->id_usuarios; ?>" class="btn btn-success btn-xs"><i class="fa"></i> Generar certificado</a> 
                    <?php endif ?>
                  </td>
                <?php endif ?>

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
      $('#borrar_form').submit(); 
    });
  });

</script>
</body>
</html>