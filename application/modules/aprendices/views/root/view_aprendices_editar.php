  <!DOCTYPE html>
  <html lang="es">
  <base href="<?=base_url()?>" /> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Modulo <?php echo $titulo; ?> (Editar registro) - Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('view_admin_css_js'); ?>
  </head>

  <body>
    <?php /* Cargo la vista generica de header */ ?>
    <?php $this->load->view('view_root_header'); ?> 
    <div class="content">
      <?php /* Cargo menu generico */ ?>
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

                      <?php /* GENERO CAMPOS NECESARIOS PARA LA CREACION DEL FORMULARIO (consultar helpers/html_helper.php) */ ?>
                      <?php $attributos=array('class'=>'form-horizontal','role'=>'form'); ?>
                      <?=form_open_multipart(base_url().$carpeta.'/root/guardar',$attributos)?>

                      <?php foreach ($roles as $key => $value) {$data_roles[$value->id_roles]=$value->nombre; } ?>

                      <?php echo select ("Rol","id_roles","id_roles",$data_roles,$detalle->id_roles); ?>
                      <?php echo input_text ("Nombres","nombres","nombres","Ingrese los nombres",$detalle->nombres,form_error('nombres', '<div class="mensaje_error">', '</div>')); ?>
                      <?php echo input_text ("Apellidos","apellidos","apellidos","Ingrese los apellidos",$detalle->apellidos,form_error('apellidos', '<div class="mensaje_error">', '</div>')); ?>
                      <?php echo input_text ("Correo","correo","correo","Ingrese el correo",$detalle->correo,form_error('correo', '<div class="mensaje_error">', '</div>')); ?>
                      <?php echo password ("Contraseña","contrasena","contrasena","Ingrese la contraseña",'',form_error('contrasena', '<div class="mensaje_error">', '</div>')); ?>
                      <?php echo password ("Repetir contraseña","contrasena2","contrasena2","Repetir la contraseña",'',form_error('contrasena2', '<div class="mensaje_error">', '</div>')); ?>
                      <?php echo input_text ("Identificacion","identificacion","identificacion","Ingrese el numero de identificacion",$detalle->identificacion,form_error('identificacion', '<div class="mensaje_error">', '</div>')); ?>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="image" id="image" value="<?php echo base_url().'uploads/'.$carpeta.'/'.$detalle->foto; ?>">

                          <div class="fileupload <?php if ($detalle->foto): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>

                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$carpeta.'/'.$detalle->foto; ?>" alt="img"/>
                            </div>
<div class="explicacion_texto">Debe ser de 200x150</div>

                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="<?php echo $detalle->foto;  ?>" name="userfile" id="userfile"/>
                              </span>
                              <a href="#" class="btn fileupload-exists delete_photoxx" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('image', '<div class="mensaje_error">', '</div>'); ?>

                            </div>

                          </div>
                        </div>
                      </div>

                      <?php echo textarea ("Resumen de perfil","resumen_de_perfil","resumen_de_perfil","Ingrese un resumen de su resumen de perfil",$detalle->resumen_de_perfil); ?>
                      <div id="contador"></div>
                      <?php echo form_error('resumen_de_perfil', '<div class="mensaje_error">', '</div>'); ?>
                      <?php $opciones=array ();
                      foreach ($tipo_planes as $key => $value) {
                       $opciones[$value->id_tipo_planes]=$value->nombre ;
                     }
                    # echo select ("Tipo de plan","id_tipo_planes","id_tipo_planes",$opciones,$detalle->id_tipo_planes); 
                     
                     ?>
                     <input type="hidden" name="id_tipo_planes" id="id_tipo_planes" value="1">
                     <?php $opciones=array ();
                     foreach ($estatus as $key => $value) {
                      if ($value->id_estatus!=1) {
                       $opciones[$value->id_estatus]=$value->nombre ;
                     }
                   }
                   #echo select ("Estatus","id_estatus","id_estatus",$opciones,$detalle->id_estatus); 
                   ?>
                   <input type="hidden" name="id_estatus" id="id_estatus" value="5">





                   <?php $array_opc=array(); ?>
                   <?php $cursos_checked=json_decode($cursos_asignadoss); $checkeado=""; ?>

                   <?php 
                   $listxcursosasig=array();
                   if ($cursos_checked) {
                   foreach ($cursos_checked as $keyxxxx => $valuexxxx) {
                    $tmpxxp=explode ("|",$valuexxxx);
                    $listxcursosasig[]=$tmpxxp[0];
                    $xxestatus[]=$tmpxxp[1];
                    $xxplanes[]=$tmpxxp[2];
                  }
                  }
                  ?>


                  <?php 
                  /*
                  foreach ($cursos as $key => $value_cursos): ?>
                    <?php $checkeado=""; ?>
                    <?php if ( @in_array($value_cursos->id_cursos."",$listxcursosasig)) { $checkeado="checked"; }  ?>
                    <?php $array_opc['id_cursos_asignados[]|'.amigable($value_cursos->titulo).'|'.$data_value_cursos[0].'|'.$checkeado]="[$value_cursos->categoria_curso] ".$value_cursos->titulo; ?>
                  <?php endforeach  ?>
                  <?php 
                 # echo checkbox ('Cursos asignados',$array_opc,1,'');
                 */
                  ?>


                  <div class="form-group">
                    <label class="col-lg-2 control-label">Cursos asignados</label>
                    <div class="col-lg-5">
                     


 <?php foreach ($cursos as $key => $value_cursos): ?>
                    <?php $checkeado=""; ?>
                    <?php if ( @in_array($value_cursos->id_cursos."",$listxcursosasig)) { $checkeado="checked"; }  ?>
                    <?php #$array_opc['id_cursos_asignados[]|'.amigable($value_cursos->titulo).'|'.$data_value_cursos[0].'|'.$checkeado]="[$value_cursos->categoria_curso] ".$value_cursos->titulo; ?>
                  


                  <label class="checkbox-inline">
                        <input type="checkbox" value="<?php echo $value_cursos->id_cursos; ?>" <?php echo $checkeado; ?> id="<?php echo amigable($value_cursos->titulo); ?>" name="id_cursos_asignados[]">[<?php echo $value_cursos->categoria_curso; ?>] <?php echo $value_cursos->titulo; ?>
                        </label>

                        <br>


                  <?php endforeach  ?>
                  <?php 
                 # echo checkbox ('Cursos asignados',$array_opc,1,'');
                  ?>


                      
                      

                     

                        </div>
                      </div>



                      <?php 
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

<?php /* CARGO FOOTER GENERICO */ ?>
<?php $this->load->view('view_admin_footer'); ?>

</body>
</html>