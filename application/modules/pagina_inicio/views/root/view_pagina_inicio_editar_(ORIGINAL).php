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


                  <h5>Atributos</h5>
                  <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#caja1">Atributo #1</a></li>
                    <li class=""><a data-toggle="tab" href="#caja2">Atributo #2</a></li>
                    <li><a data-toggle="tab" href="#caja3">Atributo #3</a></li>
                  </ul>


                  <div class="tab-content" id="myTabContent">

                    <div id="caja1" class="tab-pane fade active in">
                      <?php ######################################################  Atributo 1 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Atributo #1</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="atributo_image1" id="atributo_image1">
                          <div class="fileupload <?php if (@$detalle->atributo_foto1): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->atributo_foto1; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="atributo_userfile1" id="atributo_userfile1"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('atributo_image1', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  if ( $this->input->post('atributo_titulo1')) {   @$detalle->atributo_titulo1=$this->input->post('atributo_titulo1'); }    ?>
                      <?php echo input_text ("Titulo","atributo_titulo1","atributo_titulo1","Ingrese el titulo",@$detalle->atributo_titulo1,form_error('atributo_titulo1', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('atributo_contenido1')) {   @$detalle->atributo_contenido1=$this->input->post('atributo_contenido1'); }   ?>
                      <?php echo textarea ("Contenido","atributo_contenido1","atributo_contenido1",@$detalle->atributo_contenido1,form_error('atributo_contenido1', '<div class="mensaje_error">', '</div>')) ?>
                      <?php ######################################################  Atributo 1 ############################################################################################### ?>

                    </div>

                    <div id="caja2" class="tab-pane fade">

                      <?php ######################################################  Atributo 2 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Atributo #2</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="atributo_image2" id="atributo_image2">
                          <div class="fileupload <?php if (@$detalle->atributo_foto2): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->atributo_foto2; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="atributo_userfile2" id="atributo_userfile2"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('atributo_image2', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  if ( $this->input->post('atributo_titulo2')) {   @$detalle->atributo_titulo2=$this->input->post('atributo_titulo2'); }   ?>
                      <?php echo input_text ("Titulo","atributo_titulo2","atributo_titulo2","Ingrese el titulo",@$detalle->atributo_titulo2,form_error('atributo_titulo2', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('atributo_contenido2'))  {   @$detalle->atributo_contenido2=$this->input->post('atributo_contenido2'); }   ?>
                      <?php echo textarea ("Contenido","atributo_contenido2","atributo_contenido2",@$detalle->atributo_contenido2,form_error('atributo_contenido2', '<div class="mensaje_error">', '</div>')) ?>
                      <?php ######################################################  Atributo 2 ############################################################################################### ?>


                    </div>

                    <div id="caja3" class="tab-pane fade">


                      <?php ######################################################  Atributo 3 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Atributo #3</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="atributo_image3" id="atributo_image3">
                          <div class="fileupload <?php if (@$detalle->atributo_foto3): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->atributo_foto3; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile2" id="userfile2"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('atributo_image3', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  if ( $this->input->post('atributo_titulo3')) {   @$detalle->atributo_titulo3=$this->input->post('atributo_titulo3'); }    ?>
                      <?php echo input_text ("Titulo","atributo_titulo3","atributo_titulo3","Ingrese el titulo",@$detalle->atributo_titulo3,form_error('atributo_titulo3', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('atributo_contenido3')) {   @$detalle->atributo_contenido3=$this->input->post('atributo_contenido3'); }   ?>
                      <?php echo textarea ("Contenido","atributo_contenido3","atributo_contenido3",@$detalle->atributo_contenido3,form_error('atributo_contenido3', '<div class="mensaje_error">', '</div>')) ?>
                      <?php ######################################################  Atributo 3 ############################################################################################### ?>






                    </div>
                  </div>



                  <?php  if ( $this->input->post('boton_nombre')) {   @$detalle->boton_nombre=$this->input->post('boton_nombre'); }    ?>
                  <?php echo input_text ("Llamado a la acción","boton_nombre","boton_nombre","Ingrese el nombre del botón que tendrá en la web",@$detalle->boton_nombre,form_error('boton_nombre', '<div class="mensaje_error">', '</div>')); ?>
                  <?php  if ( $this->input->post('boton_url')) {   @$detalle->boton_url=$this->input->post('boton_url'); }    ?>
                  <?php echo input_text ("Url llamado a la acción","boton_url","boton_url","Ingrese la url donde debe ir al dar clic sobre el botón",@$detalle->boton_nombre,form_error('boton_url', '<div class="mensaje_error">', '</div>')); ?>



                  <?php  if ( $this->input->post('titulo_testimonios')) {   @$detalle->titulo_testimonios=$this->input->post('titulo_testimonios'); }  ?>
                  <?php echo input_text ("Título testimonios","titulo_testimonios","titulo_testimonios","Ingrese el título",@$detalle->titulo_testimonios,form_error('titulo_testimonios', '<div class="mensaje_error">', '</div>')); ?>
                  <?php  if ( $this->input->post('des_testimonios')) {   @$detalle->des_testimonios=$this->input->post('des_testimonios'); }   ?>
                  <?php echo textarea ("Descripción testimonios","des_testimonios","des_testimonios","Ingrese la Descripción",@$detalle->Descripcion,form_error('des_testimonios', '<div class="mensaje_error">', '</div>')); ?>













                  <h5>Testimonios</h5>
                  <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#testi1">Testimonio #1</a></li>
                    <li class=""><a data-toggle="tab" href="#testi2">Testimonio #2</a></li>
                    <li><a data-toggle="tab" href="#testi3">Testimonio #3</a></li>
                  </ul>


                  <div class="tab-content" id="myTabContent">

                    <div id="testi1" class="tab-pane fade active in">
                      <?php ######################################################  caja 1 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto testimonio 1</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="testi_image1" id="testi_image1">
                          <div class="fileupload <?php if (@$detalle->testimonio_foto1): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->testimonio_foto1; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile1" id="userfile1"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('testi_image1', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php  if ( $this->input->post('testi_nombres_completos1')) {   @$detalle->testi_nombres_completos1=$this->input->post('testi_nombres_completos1'); }    ?>
                      <?php echo input_text ("Nombres completos","testi_nombres_completos1","testi_nombres_completos1","Ingrese los nombres completos",@$detalle->testi_nombres_completos1,form_error('testi_nombres_completos1', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('testi_profesion1')) {   @$detalle->testi_profesion1=$this->input->post('testi_profesion1'); }    ?>
                      <?php echo input_text ("Profesión","testi_profesion1","testi_profesion1","Ingrese la Profesión",@$detalle->testi_profesion1,form_error('testi_profesion1', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('txt_testimonio1')) {   @$detalle->txt_testimonio1=$this->input->post('txt_testimonio1'); }    ?>
                      <?php echo textarea ("Texto testimonio","txt_testimonio1","txt_testimonio1",@$detalle->txt_testimonio1,form_error('txt_testimonio1', '<div class="mensaje_error">', '</div>')) ?>
                      <?php ######################################################  caja 1 ############################################################################################### ?>

                    </div>

                    <div id="testi2" class="tab-pane fade">

                      <?php ######################################################  caja 2 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto testimonio 2</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="testi_image2" id="testi_image2">
                          <div class="fileupload <?php if (@$detalle->testimonio_foto2): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->testimonio_foto2; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile2" id="userfile2"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('testi_image2', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>


                      <?php  if ( $this->input->post('testi_nombres_completos2')) {   @$detalle->testi_nombres_completos2=$this->input->post('testi_nombres_completos2'); }   ?>
                      <?php echo input_text ("Nombres completos","testi_nombres_completos2","testi_nombres_completos2","Ingrese los nombres completos",@$detalle->testi_nombres_completos2,form_error('testi_nombres_completos2', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('testi_profesion2')) {   @$detalle->testi_profesion2=$this->input->post('testi_profesion2'); }    ?>
                      <?php echo input_text ("Profesión","testi_profesion2","testi_profesion2","Ingrese la Profesión",@$detalle->testi_profesion2,form_error('testi_profesion2', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('txt_testimonio2')) {   @$detalle->txt_testimonio2=$this->input->post('txt_testimonio2'); }    ?>
                      <?php echo textarea ("Texto testimonio","txt_testimonio2","txt_testimonio2",@$detalle->txt_testimonio2,form_error('txt_testimonio2', '<div class="mensaje_error">', '</div>')) ?>

                      <?php ######################################################  caja 1 ############################################################################################### ?>


                    </div>

                    <div id="testi3" class="tab-pane fade">


                      <?php ######################################################  caja 2 ############################################################################################### ?>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Foto testimonio 3</label>
                        <div class="col-lg-5">
                          <input type="hidden" name="testi_image3" id="testi_image3">
                          <div class="fileupload <?php if (@$detalle->testimonio_foto3): ?> fileupload-exists <?php else : ?> fileupload-new <?php endif ?>" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
                              <img src="<?php echo base_url().'uploads/'.$titulo.'/'.@$detalle->testimonio_foto3; ?>" alt="img"/>
                            </div>
                            <div>
                              <span class="btn btn-file">
                                <span class="fileupload-exists">Cambiar</span>
                                <span class="fileupload-new">Seleccione imagen</span>         
                                <input type="file" value="uploads/resumen_de_perfil/2524e95f51cd37a6cef307ddffa86fcc.jpg" name="userfile2" id="userfile2"/>
                              </span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Borrar</a>

                              <?php echo  form_error('testi_image3', '<div class="mensaje_error">', '</div>'); ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php  if ( $this->input->post('testi_nombres_completos3')) {   @$detalle->testi_nombres_completos3=$this->input->post('testi_nombres_completos3'); }   ?>
                      <?php echo input_text ("Nombres completos","testi_nombres_completos3","testi_nombres_completos3","Ingrese los nombres completos",@$detalle->testi_nombres_completos3,form_error('testi_nombres_completos3', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('testi_profesion3')) {   @$detalle->testi_profesion3=$this->input->post('testi_profesion3'); }    ?>
                      <?php echo input_text ("Profesión","testi_profesion3","testi_profesion3","Ingrese la Profesión",@$detalle->testi_profesion3,form_error('testi_profesion3', '<div class="mensaje_error">', '</div>')); ?>
                      <?php  if ( $this->input->post('txt_testimonio3')) {   @$detalle->txt_testimonio3=$this->input->post('txt_testimonio3'); }    ?>
                      <?php echo textarea ("Texto testimonio","txt_testimonio3","txt_testimonio3",@$detalle->txt_testimonio3,form_error('txt_testimonio3', '<div class="mensaje_error">', '</div>')) ?>

                      <?php ######################################################  caja 1 ############################################################################################### ?>




                    </div>
                  </div>









                  <?php #echo input_text ("Titulo","titulo","titulo","Ingrese el titulo del contenido",@$detalle->titulo,form_error('titulo', '<div class="mensaje_error">', '</div>')); ?>
                  <?php #echo textarea ("Descripción","Descripcion","Descripcion","Ingrese la descripción del contenido",@$detalle->Descripcion,form_error('Descripcion', '<div class="mensaje_error">', '</div>')); ?>



                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-6">
                    <button type="submit" class="btn btn-sm btn-primary btnguardar">Guardar</button>
                    <a href="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2); ?>"><button type="button" class="btn btn-sm btn-warning btncancelar">Cancelar</button></a>
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