<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo str_replace("_", " ", $titulo); ?> - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
  <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url(); ?>html/plugins/colorpicker/css/colorpicker.css" />
</head>

<body>
  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo str_replace("_", " ", $titulo); ?></h2>
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
                      <?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>
                      <?php echo input_text ("Nombre del sistema","nombre_sistema","nombre_sistema","Ingrese el nombre del sistema",$detalle->nombre_sistema); ?>
                      <?php echo form_error('nombre_sistema', '<div class="mensaje_error">', '</div>'); ?>
                      <?php echo textarea ("Descripci&oacute;n del sistema","descripcion_sistema","descripcion_sistema","Ingrese la descripci&oacute;n del sistema",$detalle->descripcion_sistema); ?>
                      <?php echo form_error('descripcion_sistema', '<div class="mensaje_error">', '</div>'); ?>

                      <?php echo textarea ("Keywords del sistema","keywords_sistema","keywords_sistema","Ingrese los keywords del sistema",$detalle->keywords_sistema); ?>
                      <?php echo form_error('keywords_sistema', '<div class="mensaje_error">', '</div>'); ?>



                      <div class="form-group">
                        <label class="col-lg-2 control-label">Logo</label>
                        <div class="col-lg-5">
                          <input type="hidden" id="image" name="image" value="<?php echo $detalle->logo; ?>">
                          <input type="hidden" name="foto_antes" value="<?php echo $detalle->logo; ?>">


                          <div class="fileupload <?php if ($detalle->logo): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>

                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.$detalle->logo; ?>" alt="img"/>
                            </div>

                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="logo" id="logo"/>
                              </span>
                              <a href="#" class="btn fileupload-exists delete_photoxx" data-dismiss="fileupload">Borrar</a>
                              <?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="form-group">
                        <label class="col-lg-2 control-label">Color1</label>
                        <div class="col-lg-5">
                          <div id="colores_sistema1" class="color_fondo"><div style="background-color: <?php echo $detalle->colores_sistema1; ?>;"></div></div>
                          <input type="hidden" name="colores_sistema1" id="colores_sistema1_input" value="<?php echo $detalle->colores_sistema1; ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-lg-2 control-label">Color2</label>
                        <div class="col-lg-5">
                          <div id="colores_sistema2" class="color_fondo"><div style="background-color: <?php echo $detalle->colores_sistema2; ?>;"></div></div>
                          <input type="hidden" name="colores_sistema2" id="colores_sistema2_input" value="<?php echo $detalle->colores_sistema2; ?>">
                        </div>
                      </div>



                      <div class="form-group">
                        <label class="col-lg-2 control-label">Color3</label>
                        <div class="col-lg-5">
                          <div id="colores_sistema3" class="color_fondo"><div style="background-color: <?php echo $detalle->colores_sistema3; ?>;"></div></div>
                          <input type="hidden" name="colores_sistema3" id="colores_sistema3_input" value="<?php echo $detalle->colores_sistema3; ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-lg-2 control-label">Color4</label>
                        <div class="col-lg-5">
                          <div id="colores_sistema4" class="color_fondo"><div style="background-color: <?php echo $detalle->colores_sistema4; ?>;"></div></div>
                          <input type="hidden" name="colores_sistema4" id="colores_sistema4_input"  value="<?php echo $detalle->colores_sistema4; ?>">
                        </div>
                      </div>


                      <?php echo input_text ("Facebook URL","facebook_sistema","facebook_sistema","",$detalle->facebook_sistema,form_error('facebook_sistema', '<div class="mensaje_error">', '</div>')); ?>

                      <?php echo input_text ("Twitter URL","twitter_sistema","twitter_sistema","",$detalle->twitter_sistema,form_error('twitter_sistema', '<div class="mensaje_error">', '</div>')); ?>

                      <?php echo input_text ("Copyright nombre","copyright_nombre","copyright_nombre","",$detalle->copyright_nombre,form_error('copyright_nombre', '<div class="mensaje_error">', '</div>')); ?>

                      <?php echo input_text ("Copyright Url","copyright_url","copyright_url","",$detalle->copyright_url,form_error('copyright_url', '<div class="mensaje_error">', '</div>')); ?>







                      <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-6">
                          <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
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
  <script type="text/javascript" src="<?php echo base_url(); ?>html/plugins/colorpicker/js/colorpicker.js"></script>
  <script>



   $('#colores_sistema1').ColorPicker({
    color: '#0000ff',
    onShow: function (colpkr) {
      $(colpkr).fadeIn(500);
      return false;
    },
    onHide: function (colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function (hsb, hex, rgb) {
      $('#colores_sistema1 div').css('backgroundColor', '#' + hex);
      $('#colores_sistema1_input').val('#' + hex);

    }
  });



   $('#colores_sistema2').ColorPicker({
    color: '#0000ff',
    onShow: function (colpkr) {
      $(colpkr).fadeIn(500);
      return false;
    },
    onHide: function (colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function (hsb, hex, rgb) {
      $('#colores_sistema2 div').css('backgroundColor', '#' + hex);
      $('#colores_sistema2_input').val('#' + hex);
    }
  });





   $('#colores_sistema3').ColorPicker({
    color: '#0000ff',
    onShow: function (colpkr) {
      $(colpkr).fadeIn(500);
      return false;
    },
    onHide: function (colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function (hsb, hex, rgb) {
      $('#colores_sistema3 div').css('backgroundColor', '#' + hex);
      $('#colores_sistema3_input').val('#' + hex);
    }
  });



   $('#colores_sistema4').ColorPicker({
    color: '#0000ff',
    onShow: function (colpkr) {
      $(colpkr).fadeIn(500);
      return false;
    },
    onHide: function (colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function (hsb, hex, rgb) {
      $('#colores_sistema4 div').css('backgroundColor', '#' + hex);
      $('#colores_sistema4_input').val('#' + hex);
    }
  });




 </script>

 <style>

.fileupload-preview.fileupload-exists.thumbnail > img {
    width: 80px;
}


  .colorpicker {
    z-index: 10000;
  }

</style>

</body>
</html>