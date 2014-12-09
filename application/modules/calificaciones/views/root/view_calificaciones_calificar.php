<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Editar registro) - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Editar registro)</h2>
        <div class="bread-crumb pull-right">
          <a href="inicio/root"><i class="fa fa-home"></i> Inicio</a> 
          <span class="divider">/</span> 
          <a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista" class="bread-current">Modulo <?php echo $titulo; ?></a>        </div>
          <div class="clearfix"></div>
        </div>
        <div class="matter">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
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

                   <?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
                   <?=form_open_multipart(base_url().$titulo.'/root/calificar_ahora/'.$this->uri->segment(4).'/'.$this->uri->segment(5),$attributos)?>

                   <?php #krumo ($preguntas_con_respuestas); ?>


                   <?php foreach ($preguntas_con_respuestas as $key => $value): ?>

                     <div class="padd">
                      <br />
                      <?php echo input_text ("Pregunta","pregunta","pregunta[]","Pregunta evaluacion",$value->pregunta); ?>
                      <?php echo form_error('nombre', '<div class="mensaje_error">', '</div>'); ?>
                      <?php echo textarea ("Respuesta","respuesta","respuesta[]","Respuesta del alumno",$value->variables_respuesta[0]->respuesta); ?>
                      <?php echo form_error('Descripcion', '<div class="mensaje_error">', '</div>'); ?>
                      <?php 
                      $opciones=array("1"=>"Correcta","0"=>"Incorrecta");
                      echo select ("Calificacion","estado_respuesta","estado_respuesta[]",$opciones); 
                      ?>
                      <input type="hidden" name="key_texto[]" id="key_texto" value="<?php echo $value->variables_respuesta[0]->id_texto; ?>">
                    </div>
                  <?php endforeach ?>

               
                  <input type="hidden" name="id_actividades" id="id_actividades" value="<?php echo $value->id_actividades; ?>">
                  <input type="hidden" name="id_actividades_barra" id="id_actividades_barra" value="<?php echo $value->id_actividades_barra; ?>">



                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6">
                      <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
                      <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/evaluaciones/".$this->uri->segment(4)."/".$this->uri->segment(5); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                    </div>
                  </div>
                  <?=form_close()?>

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
<?php $this->load->view('view_admin_footer'); ?>

<script>

  $(document).ready(function() {

    $('input').each(function(index, el) {
      $(this).attr('readonly',true);
    });

    $('textarea').each(function(index, el) {
      $(this).attr('readonly',true);
    });

  });

</script>


</body>
</html>