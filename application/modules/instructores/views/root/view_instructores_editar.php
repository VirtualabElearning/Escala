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
                    <?php foreach ($roles as $key => $value) {$data_roles[$value->id_roles]=$value->nombre; } ?>
                    <?php echo select ("Rol","id_roles","id_roles",$data_roles,$detalle->id_roles); ?>
                    <?php echo input_text ("Nombres","nombres","nombres","Ingrese los nombres",$detalle->nombres,form_error('nombres', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo input_text ("Apellidos","apellidos","apellidos","Ingrese los apellidos",$detalle->apellidos,form_error('apellidos', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo input_text ("Correo","correo","correo","Ingrese el correo",$detalle->correo,form_error('correo', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo password ("Contraseña","contrasena","contrasena","Escriba la contraseña",'',form_error('contrasena', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo password ("Repetir Contraseña","contrasena2","contrasena2","Repetir la contraseña",'',form_error('contrasena2', '<div class="mensaje_error">', '</div>')); ?>
                    <?php echo input_text ("Identificacion","identificacion","identificacion","Ingrese el numero de identificacion",$detalle->identificacion,form_error('identificacion', '<div class="mensaje_error">', '</div>')); ?>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Foto</label>
                      <div class="col-lg-5">
                        <input type="hidden" name="image">
                        <div class="fileupload <?php if ($detalle->foto): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                          </div>
                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                            <img src="<?php echo base_url().'uploads/'.$titulo.'/'.$detalle->foto; ?>" alt="img"/>
                          </div>
                          <div>
                            <span class="btn btn-file">
                              <span class="fileupload-exists">Cambiar</span>
                              <span class="fileupload-new">Seleccione imagen</span>         
                              <input type="file" value="uploads/perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile" id="userfile"/>
                            </span>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>
                            <?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php echo textarea ("Resumen de perfil","resumen_de_perfil","resumen_de_perfil","Ingrese un resumen de su resumen de perfil",$detalle->resumen_de_perfil,form_error('resumen_de_perfil', '<div class="mensaje_error">', '</div>')); ?>
                    <div id="contador"></div>
                    <?php #$array_opc=array(); ?>
                    <?php #$cursos_checked=json_decode($detalle->cursos_asignados); $checkeado=""; ?>
                    <?php #foreach ($lista_cursos as $key => $value_cursos): ?>
                      <?php #$checkeado=""; ?>
                      <?php #if ( @in_array($value_cursos->id_cursos,$cursos_checked)) { $checkeado="checked"; }  ?>
                      <?php #$array_opc['cursos_asignados[]|'.amigable($value_cursos->titulo).'|'.$value_cursos->id_cursos.'|'.$checkeado]=$value_cursos->titulo." [".$value_cursos->categoria_curso."] "; ?>
                    <?php #endforeach ?>
                    <?php 
                   # echo checkbox ('Cursos asignados',$array_opc,1,'');
                    $opciones=array("1"=>"Activo","0"=>"Inactivo");
                    echo select ("Estado","id_estados","id_estados",$opciones,$detalle->id_estados); 
                    ?>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-6">
                       <button type="button" class="guardar_usuario_clic btn btn-sm btn-primary">Guardar</button>
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
                  <?=form_hidden('redirect',@$redirect)?>
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