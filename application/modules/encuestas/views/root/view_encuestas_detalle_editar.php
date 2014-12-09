<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Preguntas) (Editar registro) - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Preguntas) (Editar registro)</h2>
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
                    <div class="padd">
                      <br />

                      <?php #krumo ($detalle); ?>

                      <?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
                      <?=form_open_multipart(base_url().$titulo.'/root/guardar_pregunta',$attributos)?>


                      <?php echo input_text ("Pregunta","nombre","nombre","Ingrese el nombre de la encuesta como referencia",$detalle->pregunta,form_error('nombre', '<div class="mensaje_error">', '</div>')); ?>
                      

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Tipo de pregunta</label>
                        <div class="col-lg-2">
                          <select id="tipo_pregunta" name="tipo_pregunta" class="form-control">
                            <option value="" selected>Seleccione</option>
                            <option value="1" <?php if ($detalle->tipo_pregunta==1) { echo "selected"; } ?>>Tipo test</option>
                            <option value="2" <?php if ($detalle->tipo_pregunta==2) { echo "selected"; } ?>>Elegir de una lista</option>
                            <option value="3" <?php if ($detalle->tipo_pregunta==3) { echo "selected"; } ?>>Campo de texto</option>
                          </select>
                          <?php echo form_error('tipo_pregunta', '<div class="mensaje_error">', '</div>'); ?>
                        </div>
                      </div>


                      <div class="opciones" style="<?php if ($detalle->tipo_pregunta==1 || $detalle->tipo_pregunta==2) { echo "display:block;"; } ?>">


                        <div class="test">
                          <div class="custom_field col-lg-7">
                           <?php if ($detalle->tipo_pregunta==1 || $detalle->tipo_pregunta==2) { ?>
                           <?php $variables_pregunta=json_decode($detalle->variables_pregunta); ?>
                           <?php foreach ($variables_pregunta as $key => $value): ?>
                            <div class="col-lg-3"></div>
                            <div class="chk-inputs col-lg-9 cloner1">
                            <input type="text" placeholder="Opcion 1" value="<?php echo $value; ?>" class="form-control texter" name="txtop1[]"> 
                            </div> 
                            <?php break; ?>
                          <?php endforeach ?>
                          <?php } else {?>

                          <div class="col-lg-3"></div>
                          <div class="chk-inputs col-lg-9 cloner1">
                            <input type="text" placeholder="Opcion 1" class="form-control texter" name="txtop1[]"> 
                          </div> 
                          <?php } ?>
                          <div class="cloned1">




                           <?php foreach ($variables_pregunta as $key => $value): ?>
                            <?php if ($key>0): ?>
                              <div class="col-lg-3"></div>
                              <div class="chk-inputs col-lg-9 clon1">
                                <input type="text" placeholder="Opcion <?php echo $key+1; ?>" value="<?php echo $value; ?>" class="form-control texter" name="txtop1[]"> 
                              <a class="btn btn-xs btn-default delete_cloned1"><i class="fa fa-times"></i></a></div>
                            <?php endif ?>
                          <?php endforeach ?>



                        </div>

                        <div class="col-lg-3"></div>


                        <div class="col-lg-9">
                          <div class="gosp">
                          </div>
                          <input type="text" placeholder="Clic para crear otra opción" class="form-control ghost-input" id="gostop1" name="gostop">
                        </div> 

                        <div class="col-lg-3"></div>


                        <div class="col-lg-1 cloner_btn">     
                        </div>
                      </div>
                    </div>






                  </div>


                  <?php 
                  $opciones=array("1"=>"Activo","0"=>"Inactivo");
                  echo select ("Estado","id_estados","id_estados",$opciones,$detalle->id_estados); 
                  ?>
                  <?php echo form_error('id_estados', '<div class="mensaje_error">', '</div>'); ?>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6">
                      <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
                      <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/"."preguntas"."/".$this->uri->segment(4); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                    </div>
                  </div>

                  <input type="hidden" name="id_encuestas" id="id_encuestas" value="<?php if ($this->uri->segment(4)!='') { echo $this->uri->segment(4); } else {  echo $this->input->post('id_encuestas'); } ?>">

                  <input type="hidden" name="id_encuestas_detalle" id="id_encuestas_detalle" value="<?php if ($this->uri->segment(5)!='') { echo $this->uri->segment(5); } else {  echo $this->input->post('id_encuestas_detalle'); } ?>">

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
</div>      
<div class="clearfix"></div>
</div>
<?php $this->load->view('view_admin_footer'); ?>

<script>


  jQuery(document).ready(function($) {

    jQuery(document).on('change', '#tipo_pregunta', function(event) {
      event.preventDefault();

      if ( jQuery(this).val()==1 ||  jQuery(this).val()==2 ) { jQuery('.opciones').show();  }  else {  jQuery('.opciones').hide();   }

    });




    jQuery(document).on('click', '#gostop1', function(event) {
      event.preventDefault();
      var thiz=jQuery(this);
      var conta=Number(jQuery('.cloned1 .clon1').length)+2;
      var codehtml='<div class="col-lg-3"></div><div class="chk-inputs col-lg-9 clon1"><div class="gosp"></div><input type="text" name="txtop1[]" class="form-control texter" placeholder="Opcion '+conta+'"> <a class="btn btn-xs btn-default delete_cloned1"><i class="fa fa-times"></i></a> </div>  ';
      jQuery('.cloned1').append(codehtml);

    });

    jQuery(document).on('click', '.delete_cloned1', function(event) {
      jQuery(this).parent().prev().remove();
      jQuery(this).parent().remove();
    });

  });

</script>





</body>
</html>