<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo $titulo; ?> (Editar registro) - Adminsitrador</title>
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
          <a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/<?php echo $this->uri->segment(2); ?>/lista" class="bread-current">Modulo <?php echo $titulo; ?></a>
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

                    <?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
                    <?=form_open_multipart(base_url().$titulo.'/root/guardar',$attributos)?>
                    <?php #krumo ($categoria_cursos); ?>
                    <?php 
                    foreach ($categoria_cursos as $key => $value) {
                      $opciones[$value->id_categoria_cursos]=$value->nombre;
                    }
                    ?>
                    <?php echo select ('Categoria cursos','id_categoria_cursos','id_categoria_cursos',$opciones,$detalle->id_categoria_cursos);
                    ?>
                    <?php echo input_text ("Titulo","titulo","titulo","Ingrese el titulo del curso",$detalle->titulo,form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo textarea ("Resumen del curso","descripcion","descripcion","Ingrese el resumen del curso",$detalle->descripcion,form_error('descripcion', '<div class="mensaje_error">', '</div>')); ?>
                    <div id="contador"></div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Foto</label>
                      <div class="col-lg-5">

                        <input type="hidden" name="image" id="image">
                        <div class="fileupload <?php if ($detalle->foto): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                          </div>

                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            

                          </div>

                          <div>
                            <span class="btn btn-file">
                              <span class="fileupload-exists">Cambiar</span>
                              <span class="fileupload-new">Seleccione imagen</span>         
                              <input type="file" value="" name="userfile" id="userfile"/>
                            </span>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>
                            <?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>
                          </div>

                        </div>
                      </div>
                    </div>
                    <?php echo editor ("Objetivos de parendizaje","objetivos_aprendizaje","objetivos_aprendizaje",$detalle->objetivos_aprendizaje,form_error('objetivos_aprendizaje', '<div class="mensaje_error">', '</div>')) ?>
                    <?php echo editor ("Prerrequisitos","prerrequisitos","prerrequisitos",$detalle->prerrequisitos,form_error('prerrequisitos', '<div class="mensaje_error">', '</div>')) ?>
                    <?php echo editor ("Contenidos del curso","contenido","contenido",$detalle->contenido,form_error('contenido', '<div class="mensaje_error">', '</div>')) ?>
                    
                    <?php $array_opc=array(); ?>
                    <?php $cursos_checked=json_decode($detalle->instructores_asignados); $checkeado=""; ?>
                    <?php foreach ($instructores_lista as $key => $value_instructores): ?>
                      <?php $checkeado=""; ?>
                      <?php if ( @in_array($value_instructores->id_instructores,$cursos_checked)) { $checkeado="checked"; }  ?>
                      <?php $array_opc['instructores_asignados[]|'.amigable($value_instructores->nombres." ".$value_instructores->apellidos ).'|'.$value_instructores->id_instructores.'|'.$checkeado]=$value_instructores->nombres." ".$value_instructores->apellidos." [ ".$value_instructores->correo." ] "; ?>
                    <?php endforeach  ?>
                    <?php 
                    echo checkbox ('Instructores asignados',$array_opc,1,''); ?><?php 
                    $opciones=array("1"=>"Activo","0"=>"Inactivo");
                    echo select ("Estado","id_estados","id_estados",$opciones,$detalle->id_estados); 
                    ?>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-6">
                        <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
                        <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
                      </div>
                    </div>

                    <?php if ($this->input->post('id')): ?>
                      <?=form_hidden('id',$this->input->post('id'))?>
                      <?=form_hidden('foto_antes',$detalle->foto)?>
                    <?php endif; ?>

                    <?php if ($this->uri->segment(4)): ?>
                      <?=form_hidden('id',$this->uri->segment(4))?>
                      <?=form_hidden('foto_antes',$detalle->foto)?>
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