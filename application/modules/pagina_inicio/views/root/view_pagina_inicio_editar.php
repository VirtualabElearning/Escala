<!DOCTYPE html>
<html lang="es">
<base href="<?=base_url()?>" /> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo $titulo; ?> - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
</head>
<body>

  <?php $this->load->view('view_root_header'); ?> 
  <div class="content">
    <?php $this->load->view('view_root_menu'); ?> 
    <div class="mainbar">

      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-table"></i>Modulo <?php echo $titulo; ?> </h2>
        <div class="bread-crumb pull-right">
         <a href="inicio/root"><i class="fa fa-home"></i>Inicio</a> 
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
                  <?=form_open_multipart(base_url().str_replace(" ", "_", $titulo).'/root/guardar',$attributos)?>
                 
                  <?php echo input_text ("Título","titulo","titulo","Ingrese el titulo de la pagina de inicio",@$detalle->titulo,form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>

                 <?php echo textarea ("Descripción","descripcion","descripcion","Ingrese la descripción de la pagina de inicio",@$detalle->descripcion,form_error("descripcion", '<div class="mensaje_error">', '</div>')) ?>

                 <?php echo textarea ("Keywords","keywords","keywords","Ingrese los keywords de la pagina de inicio",@$detalle->keywords,form_error("keywords", '<div class="mensaje_error">', '</div>')) ?>


                  <?php echo input_text ("Slogan","slogan","slogan","Ingrese el slogan que tendrá en la web",@$detalle->slogan,form_error('slogan', '<div class="mensaje_error">', '</div>')); ?>


                  <h5>Atributos</h5>


                  <?php $titulo=str_replace(" ", "_", $titulo); ?>

                  <ul class="nav nav-tabs" id="myTab">
                    <?php foreach (json_decode(json_decode($detalle->cajas)->titulos) as $key => $value): ?>
                      <li <?php if ($key==0): ?> class="active" <?php endif ?> ><a data-toggle="tab" href="#caja<?php echo $key+1; ?>">Atributo #<?php echo $key+1; ?></a></li>
                    <?php endforeach ?>
                  </ul>


                  <div class="tab-content" id="myTabContent">
                    <?php foreach (json_decode(json_decode($detalle->cajas)->titulos) as $cajas_key => $cajas_value): ?>
                      <div id="caja<?php echo $cajas_key+1; ?>" class="tab-pane fade <?php if ($cajas_key==0)  { ?> active in <?php } ?>">

                        <?php ######################################################  Atributo N° ############################################################################################### ?>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Foto Atributo #<?php echo ($cajas_key+1); ?></label>
                          <div class="col-lg-5">
                            <input type="hidden" value="<?php echo @json_decode(json_decode($detalle->cajas)->atributo_fotos)[$cajas_key]->{"atributo_foto".($cajas_key+1)} ?>" name="atributo_image<?php echo ($cajas_key+1); ?>" id="atributo_image<?php echo ($cajas_key+1); ?>">
                            <input type="hidden" value="<?php echo @json_decode(json_decode($detalle->cajas)->atributo_fotos)[$cajas_key]->{"atributo_foto".($cajas_key+1)} ?>" name="atributo_image_tmp<?php echo ($cajas_key+1); ?>" id="atributo_image_tmp<?php echo ($cajas_key+1); ?>">

                            <div class="fileupload <?php if ( @json_decode(json_decode($detalle->cajas)->atributo_fotos)[$cajas_key]->{"atributo_foto".($cajas_key+1)} !='*'): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                                <img src="<?php echo base_url().'uploads/'.$titulo.'/'.json_decode(json_decode($detalle->cajas)->atributo_fotos)[$cajas_key]->{"atributo_foto".($cajas_key+1)} ; ?>" alt="img"/>
                              </div>
                              <div>
                                <span class="btn btn-file">
                                  <span class="fileupload-exists">Cambiar</span>
                                  <span class="fileupload-new">Seleccione imagen</span>         
                                  <input type="file" name="atributo_userfile<?php echo ($cajas_key+1); ?>" id="atributo_userfile<?php echo ($cajas_key+1); ?>"/>
                                </span>
                                <a href="#" class="btn fileupload-exists delete_atrib_foto" id="<?php echo ($cajas_key+1); ?>" data-dismiss="fileupload">Borrar</a>
                                <?php echo  form_error('atributo_image'.($cajas_key+1), '<div class="mensaje_error">', '</div>'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php  if ( $this->input->post("atributo_titulo".($cajas_key+1))) {   @$cajas_value->{"atributo_titulo".($cajas_key+1)}=$this->input->post("atributo_titulo".($cajas_key+1)); }    ?>
                        <?php echo input_text ("Titulo","atributo_titulo".($cajas_key+1),"atributo_titulo".($cajas_key+1),"Ingrese el titulo",@$cajas_value->{"atributo_titulo".($cajas_key+1)},form_error("atributo_titulo".($cajas_key+1), '<div class="mensaje_error">', '</div>')); ?>

                        <?php  if ( $this->input->post("atributo_contenido".($cajas_key+1))) {   $contenido=$this->input->post("atributo_contenido".($cajas_key+1)); }   ?>
                        <?php 
                        $contenido=json_decode(json_decode($detalle->cajas)->contenidos)[$cajas_key]->{"atributo_contenido".($cajas_key+1)};  
                        ?>
                        <?php echo textarea ("Contenido","atributo_contenido".($cajas_key+1),"atributo_contenido".($cajas_key+1),"",$contenido,form_error("atributo_contenido".($cajas_key+1), '<div class="mensaje_error">', '</div>')) ?>

                        <?php ######################################################  Atributo 1 ############################################################################################### ?>

                      </div>

                    <?php endforeach ?>                  

                  </div>


                  <?php @$detalle->boton_nombre=json_decode($detalle->ver_cursos)->boton_nombre; ?>
                  <?php  if ( $this->input->post('boton_nombre')) {   @$detalle->boton_nombre=$this->input->post('boton_nombre'); }    ?>
                  <?php echo input_text ("Llamado a la acción","boton_nombre","boton_nombre","Ingrese el nombre del botón que tendrá en la web",@$detalle->boton_nombre,form_error('boton_nombre', '<div class="mensaje_error">', '</div>')); ?>

                  <?php @$detalle->boton_url=json_decode($detalle->ver_cursos)->boton_url; ?>
                  <?php  if ( $this->input->post('boton_url')) {   @$detalle->boton_url=$this->input->post('boton_url'); }    ?>
                  <?php echo input_text ("Url llamado a la acción","boton_url","boton_url","Ingrese la url donde debe ir al dar clic sobre el botón",@$detalle->boton_url,form_error('boton_url', '<div class="mensaje_error">', '</div>')); ?>

                  <?php echo input_text ("Titulo destacados","titulo_destacados","titulo_destacados","Ingrese el titulo de la sección destacados",@$detalle->titulo_destacados,form_error('titulo_destacados', '<div class="mensaje_error">', '</div>')); ?>
                  <?php echo textarea ("Descripción destacados","descripcion_destacados","descripcion_destacados","Ingrese la Descripción",@$detalle->descripcion_destacados,form_error('descripcion_destacados', '<div class="mensaje_error">', '</div>')); ?>

                  <?php @$detalle->des_testimonios=json_decode($detalle->titulo_testimonios)->des_testimonios; ?>
                  <?php @$detalle->titulo_testimonios=json_decode($detalle->titulo_testimonios)->titulo_testimonios; ?>
                  <?php  if ( $this->input->post('titulo_testimonios')) {   @$detalle->titulo_testimonios=$this->input->post('titulo_testimonios'); }  ?>
                  
                  <?php echo input_text ("Título testimonios","titulo_testimonios","titulo_testimonios","Ingrese el título",@$detalle->titulo_testimonios,form_error('titulo_testimonios', '<div class="mensaje_error">', '</div>')); ?>
                  <?php  if ( $this->input->post('des_testimonios')) {   @$detalle->des_testimonios=$this->input->post('des_testimonios'); }   ?>
                  <?php echo textarea ("Descripción testimonios","des_testimonios","des_testimonios","Ingrese la Descripción",@$detalle->des_testimonios,form_error('des_testimonios', '<div class="mensaje_error">', '</div>')); ?>

                   <?php echo input_text ("Titulo registrate","titulo_registrate","titulo_registrate","Ingrese el titulo de regístrate",@$detalle->titulo_registrate,form_error('titulo_registrate', '<div class="mensaje_error">', '</div>')); ?>


              
                  <ul id="myTab" class="nav nav-tabs">
                    <?php foreach ($tipo_planes as $key => $value): ?>
                      <li <?php if ($key==0)  { ?>class="active"<?php } ?>><a href="#<?php echo amigable($value->nombre."_".$value->id_tipo_planes); ?>" data-toggle="tab"><?php echo $value->nombre; ?></a></li>
                    <?php endforeach ?>
                  </ul>


                  <div class="tab-content" id="myTabContent">

                    <?php foreach ($tipo_planes as $key => $value): ?>
                      <div class="tab-pane fade <?php if ($key==0)  { ?> active in <?php } ?>" id="<?php echo amigable($value->nombre."_".$value->id_tipo_planes); ?>">                                          
                        <?php echo input_text ("Valor","plan_valor[]","plan_valor[]","Ingrese el valor",@json_decode(json_decode($detalle->planes)->planes_valores)[$key],form_error('valor', '<div class="mensaje_error">', '</div>')); ?>
                      
                        <?php echo input_text ("Linea 1","linea1[]","linea1[]","Ingrese el texto de la linea 1",@json_decode(json_decode($detalle->planes)->lineas1)[$key],form_error('linea1', '<div class="mensaje_error">', '</div>')); ?>
                        <?php echo input_text ("Linea 2","linea2[]","linea2[]","Ingrese el texto de la linea 2",@json_decode(json_decode($detalle->planes)->lineas2)[$key],form_error('linea2', '<div class="mensaje_error">', '</div>')); ?>
                        <?php echo input_text ("Linea 3","linea3[]","linea3[]","Ingrese el texto de la linea 3",@json_decode(json_decode($detalle->planes)->lineas3)[$key],form_error('linea1', '<div class="mensaje_error">', '</div>')); ?>
                        <?php echo input_text ("Linea 4","linea4[]","linea4[]","Ingrese el texto de la linea 4",@json_decode(json_decode($detalle->planes)->lineas4)[$key],form_error('linea1', '<div class="mensaje_error">', '</div>')); ?>
                        <?php echo input_text ("Url","url[]","url[]","Ingrese al url",@json_decode(json_decode($detalle->planes)->urls)[$key],form_error('url', '<div class="mensaje_error">', '</div>')); ?>
                        <input type="hidden" id="" name="id_plan[]" value="<?php echo $value->id_tipo_planes; ?>">
                      </div>
                    <?php endforeach ?>
                  </div>


                  <h5>Testimonios</h5>
                  <ul class="nav nav-tabs" id="myTab">
                    <?php foreach (json_decode(json_decode($detalle->testimonios)->nombres_completos) as $testi_key => $testi_value): ?>
                      <li <?php if ($testi_key==0): ?> class="active" <?php endif ?> ><a data-toggle="tab" href="#testi<?php echo $testi_key+1; ?>">Testimonio #<?php echo $testi_key+1; ?></a></li>
                    <?php endforeach ?>
                  </ul>


                  <div class="tab-content" id="myTabContent">

                    <?php foreach (json_decode(json_decode($detalle->testimonios)->nombres_completos) as $testi_key => $testi_value): ?>

                      <div id="testi<?php echo $testi_key+1; ?>" class="tab-pane fade <?php if ($testi_key==0)  { ?> active in <?php } ?>">

                        <?php ######################################################  caja 1 ############################################################################################### ?>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Foto testimonio 1</label>
                          <div class="col-lg-5">
                            <input type="hidden" value="<?php echo @json_decode(json_decode($detalle->testimonios)->testi_fotos)[$testi_key]->{"testi_foto".($testi_key+1)} ?>" name="testi_image<?php echo ($testi_key+1); ?>" id="testi_image<?php echo ($testi_key+1); ?>">
                            <input type="hidden" value="<?php echo @json_decode(json_decode($detalle->testimonios)->testi_fotos)[$testi_key]->{"testi_foto".($testi_key+1)} ?>" name="testi_image_tmp<?php echo ($testi_key+1); ?>" id="testi_image_tmp<?php echo ($testi_key+1); ?>">

                            <div class="fileupload <?php if (@json_decode(json_decode($detalle->testimonios)->testi_fotos)[$testi_key]->{"testi_foto".($testi_key+1)}!="*"): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                                <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@json_decode(json_decode($detalle->testimonios)->testi_fotos)[$testi_key]->{"testi_foto".($testi_key+1)}; ?>" alt="img"/>
                              </div>
                              <div>
                                <span class="btn btn-file">
                                  <span class="fileupload-exists">Cambiar</span>
                                  <span class="fileupload-new">Seleccione imagen</span>         
                                  <input type="file" value="<?php echo @json_decode(json_decode($detalle->testimonios)->testi_fotos)[$testi_key]->{"testi_foto".($testi_key+1)}; ?>" name="testi_userfile<?php echo ($testi_key+1); ?>" id="userfile<?php echo ($testi_key+1); ?>"/>
                                </span>
                                <a href="#" class="btn fileupload-exists delete_testi_foto" id="<?php echo ($testi_key+1); ?>" data-dismiss="fileupload">Borrar</a>
                                <?php echo  form_error('testi_image'.($testi_key+1), '<div class="mensaje_error">', '</div>'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php  @$detalle->{"testi_nombres_completos".($testi_key+1)}=json_decode(json_decode($detalle->testimonios)->nombres_completos)[$testi_key]->{"testi_nombres_completos".($testi_key+1)}; ?>
                        <?php  if ( $this->input->post('testi_nombres_completos'.($testi_key+1))) {   @$detalle->{"testi_nombres_completos".($testi_key+1)}=$this->input->post('testi_nombres_completos'.($testi_key+1)); }    ?>
                        <?php echo input_text ("Nombres completos","testi_nombres_completos".($testi_key+1),"testi_nombres_completos".($testi_key+1),"Ingrese los nombres completos",@$detalle->{"testi_nombres_completos".($testi_key+1)},form_error('testi_nombres_completos'.($testi_key+1), '<div class="mensaje_error">', '</div>')); ?>


                        <?php  @$detalle->{"testi_profesion".($testi_key+1)}= json_decode(json_decode($detalle->testimonios)->profesion)[$testi_key]->{"testi_profesion".($testi_key+1)}; ?>
                        <?php  if ( $this->input->post('testi_profesion'.($testi_key+1))) {   @$detalle->{"testi_profesion".($testi_key+1)}=$this->input->post('testi_profesion'.($testi_key+1)); }    ?>
                        <?php echo input_text ("Profesión","testi_profesion".($testi_key+1),"testi_profesion".($testi_key+1),"Ingrese la Profesión",@$detalle->{"testi_profesion".($testi_key+1)},form_error('testi_profesion'.($testi_key+1), '<div class="mensaje_error">', '</div>')); ?>

                        <?php  @$detalle->{"txt_testimonio".($testi_key+1)}= json_decode(json_decode($detalle->testimonios)->texto_testimonio)[$testi_key]->{"txt_testimonio".($testi_key+1)}; ?>
                        <?php  if ( $this->input->post('txt_testimonio'.($testi_key+1))) {   @$detalle->{"txt_testimonio".($testi_key+1)}=$this->input->post('txt_testimonio'.($testi_key+1)); }    ?>
                        <?php echo textarea ("Texto testimonio","txt_testimonio".($testi_key+1),"txt_testimonio".($testi_key+1),"",@$detalle->{"txt_testimonio".($testi_key+1)},form_error('txt_testimonio'.($testi_key+1), '<div class="mensaje_error">', '</div>')) ?>
                        <?php ######################################################  caja 1 ############################################################################################### ?>

                      </div>
                    <?php endforeach ?>                  

                  </div>




                  <?php #echo input_text ("Titulo","titulo","titulo","Ingrese el titulo del contenido",@$detalle->titulo,form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>
                  <?php #echo textarea ("Descripción","Descripcion","Descripcion","Ingrese la descripción del contenido",@$detalle->Descripcion,form_error('Descripcion', '<div class="mensaje_error">', '</div>')); ?>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6">
                      <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>

                    </div>
                  </div>
                  <?php if ($this->input->post('id')): ?>
                    <?=form_hidden('id',$this->input->post('id'))?>
                  <?php endif ?>

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