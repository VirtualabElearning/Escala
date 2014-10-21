<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Responder mensaje) - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>
  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?> (Responder mensaje)</h2>
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
                      <?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
                      <?=form_open_multipart(base_url().$titulo.'/root/enviar',$attributos)?>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Usuario</label>
                        <div class="col-lg-5">
                          <input type="text" name="usuario" value="<?php echo $detalle->datos_usuario->nombres; ?> <?php echo $detalle->datos_usuario->apellidos; ?>" id="usuario" readonly="true" class="form-control " placeholder="">
                          <input type="hidden" name="id_usuarios" id="id_usuarios" value="<?php echo $detalle->datos_usuario->id_usuarios; ?>">
                        </div>
                      </div>

                      <?php echo form_error('nombre', '<div class="mensaje_error">', '</div>'); ?>
                      <?php echo textarea ("Mensaje","mensaje","mensaje","Ingresa tu mensaje",$detalle->mensaje); ?>
                      <?php echo form_error('mensaje', '<div class="mensaje_error">', '</div>'); ?>
                      <?php 
                      $opciones=array("8"=>"No le&iacute;do","9"=>"Le&iacute;do");
                      echo select ("Marcar este mensaje como","id_estados","id_estados",$opciones,$detalle->id_estados); 
                      ?>
                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-6">
                          <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
                          <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                        </div>
                      </div>
                      <?php if ($this->uri->segment(4)): ?>
                        <?=form_hidden('id',$this->uri->segment(4))?>
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
    </div>      
    <div class="clearfix"></div>
  </div>
  <?php $this->load->view('view_admin_footer'); ?>
</body>
</html>