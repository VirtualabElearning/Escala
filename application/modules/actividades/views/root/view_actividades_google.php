<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?=base_url()?>" />   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Modulo <?php echo $titulo; ?> (Nuevo registro) - Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $this->load->view('view_admin_css_js'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/assets/css/actividades.css"> 
</head>
<body>
  <div class="content">
    <div class="matter">
      <div class="container">



        <div class="row">

         <div class="col-md-2"> </div>

         <div class="col-md-12">

          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Creacion de preguntas</div>

              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">

                <br>

                <form enctype="multipart/form-data" id="form_generator" role="form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo current_url(); ?>">                   



                  <ul id="dragx">

                    <?php ##si tiene preguntas ya realizadas, las cargo de forma dinamica ?>

                    <?php if ($preguntas_actividades->variables_pregunta!=''): ?>
                      <?php $listado_preguntas=json_decode($preguntas_actividades->variables_pregunta); ?>

                      <?php $contador_pregunta=1; ?>
                      <?php foreach ($listado_preguntas as $key => $value): ?>

                        <li class="mipregunta">
                          <div class="form-group dragt">
                            <?php if ($contador_pregunta==1): ?>
                              <h3 class="pregunta_number">Pregunta <span><?php echo $contador_pregunta; ?></span> <input type="hidden" name="num_pregunta[]" value="<?php echo $contador_pregunta; ?>"></h3>
                            <?php else: ?>
                             <h3 class="pregunta_number">Pregunta <span><?php echo $contador_pregunta; ?></span> <input type="hidden" name="num_pregunta[]" value="<?php echo $contador_pregunta; ?>"> <a class="btn btn-xs btn-default deleter_google-pregunta" href="#"><i class="fa fa-times"></i></a></h3>

                           <?php endif ?>

                           <label class="col-lg-2 control-label">Tipo de pregunta</label>
                           <div class="col-lg-3">
                             <select id="tipo_pregunta[]" name="tipo_pregunta[]" class="form-control selects">
                              <option value="">Seleccione</option>
                              <option <?php if ($value->tipo_pregunta==1): ?> selected <?php endif; ?> value="1">Tipo test</option>
                              <option <?php if ($value->tipo_pregunta==2): ?> selected <?php endif; ?> value="2">Elegir de una lista</option>
                              <?php /* ?>
                              <option <?php if ($value->tipo_pregunta==3): ?> selected <?php endif; ?> value="3">Tipo test</option>
                              <?php */  ?>
                              <option <?php if ($value->tipo_pregunta==4): ?> selected <?php endif; ?> value="4">Campo de texto</option>
                            </select>
                          </div> 

                          <div class="col-lg-9 prepregunta">
                            <label class="col-lg-2 control-label">Titulo de la pregunta</label><div class="col-lg-7 pregunta_titlex"><input type="text" name="pregunta[]" id="pregunta[]" class="form-control" value="<?php echo $value->pregunta; ?>" placeholder="Pregunta sin titulo"></div>
                          </div>

                          <div class="col-lg-9 competencia_class">
                            <label class="col-lg-2 control-label">Competencia!</label><div class="col-lg-7 pregunta_titlex">
                            <select id="id_competencias[]" name="id_competencias[]" class="form-control competencias_select">
                              <option value="">Seleccione</option>
                              <?php foreach ($competencias as $compe_key => $compe_value): ?>
                                <option <?php  if ($value->id_competencias==$compe_key){ ?> selected <?php } ?> value="<?php echo $compe_key; ?>"><?php echo $compe_value; ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>


                        <div class="custom_field col-lg-10">
                          <?php 
                          $variables_respuestas=json_decode(@$value->variables_respuesta);
                          switch ($value->tipo_pregunta) {
                            case '1':  // casillas de verificacion
                            ?>
                            <?php $variables_respuestas_contador=1; ?>
                            <?php if (@$variables_respuestas): ?>
                              <?php foreach ($variables_respuestas as $variables_respuestas_key => $variables_respuestas_value): ?>
                                <div class="chk-inputs">
                                  <div style="float:left;">
                                    <label class="checkbox">
                                      <input type="checkbox" <?php if ($variables_respuestas_value->correcta==1): ?> checked="true" <?php endif ?>  class="chekeador" name="op<?php echo $contador_pregunta; ?>[]" id="inlineCheckbox1">
                                    </label>
                                  </div>
                                  <input type="text" value="<?php echo $variables_respuestas_value->opcion; ?>" name="txtop<?php echo $contador_pregunta; ?>[]" class="form-control texter" placeholder="Opcion <?php echo $variables_respuestas_contador; ?>">  
                                  <input type="text" value="<?php echo $variables_respuestas_value->retroalimentacion; ?>" class="form-control retrotxtop" name="retrotxtop<?php echo $contador_pregunta; ?>[]" class="form-control texter" placeholder="Retroalimentacion <?php echo $variables_respuestas_contador; ?>"> 


                                  <?php if ($variables_respuestas_key>0): ?>
                                    <a href="#" class="btn btn-xs btn-default google-opt deleter_google"><i class="fa fa-times"></i></a>
                                  <?php endif ?>
                                </div> 
                                <?php $variables_respuestas_contador++; ?>
                              <?php endforeach ?>
                            <?php endif ?>


                            <div class="">
                              <div style="float:left;">
                                <label class="checkbox">
                                  <input type="checkbox" class="goster_check" disabled="true" id="inlineCheckbox1">
                                </label>
                              </div>
                              <input type="text" name="gostop" id="gostop" class="form-control ghost-input" placeholder="Clic para crear otra opción"> 
                            </div>

                            <?php                           
                            break;
                            case '2':  // Elegir de una lista
                            ?>

                            <?php $variables_respuestas_contador=1; ?>
                            <?php if (@$variables_respuestas): ?>
                              <?php foreach ($variables_respuestas as $variables_respuestas_key => $variables_respuestas_value): ?>
                                <div class="col-lg-7 lista-custom">  
                                  <label class="radio checklista">
                                    <input type="radio" <?php if ($variables_respuestas_value->correcta==1): ?> checked="true" <?php endif ?> class="chekeador" name="oplista<?php echo $contador_pregunta; ?>[]" id="radios_lista<?php echo $contador_pregunta; ?>_<?php echo $variables_respuestas_contador; ?>">
                                  </label>   
                                  <input type="text" placeholder="Opcion <?php echo $variables_respuestas_contador; ?>" value="<?php echo $variables_respuestas_value->opcion; ?>" class="form-control lista" id="lista[]"  name="lista<?php echo $contador_pregunta; ?>[]">   
                                  <input type="text" class="form-control retrolista" value="<?php echo $variables_respuestas_value->retroalimentacion; ?>" name="retrolista<?php echo $contador_pregunta; ?>[]" class="form-control texter" placeholder="Retroalimentacion <?php echo $variables_respuestas_contador; ?>">
                                  
                                  <?php if ($variables_respuestas_key>0): ?>
                                    <a href="#" class="btn btn-xs btn-default google-opt deleter_google"><i class="fa fa-times"></i></a>
                                  <?php endif ?>

                                </div>
                                <?php $variables_respuestas_contador++; ?>
                              <?php endforeach ?>
                            <?php endif ?>

                            <div class="col-lg-7">
                              <input type="text" placeholder="Clic para crear otra opción" class="form-control" id="lista-gost"  name="lista-gost[]">
                            </div>
                            <?php
                            break;

                            case '3':  // tipo test
                            ?>
                            <?php $variables_respuestas_contador=1; ?>
                            <?php if (@$variables_respuestas): ?>


                              <?php foreach (@$variables_respuestas as $variables_respuestas_key => $variables_respuestas_value): ?>

                                <div class="radio-lista"> 
                                 <div class="radio list-option-custom">
                                   <label>
                                     <input type="radio" <?php if ($variables_respuestas_value->correcta==1): ?> checked="true" <?php endif ?> value="<?php echo $variables_respuestas_contador; ?>" id="radios_test<?php echo $contador_pregunta; ?>_<?php echo $variables_respuestas_contador; ?>" name="radios<?php echo $contador_pregunta; ?>[]"></label> 

                                   </div>
                                   <div class="col-lg-7 lista-option-custom">
                                     <input type="text" placeholder="" value="<?php echo $variables_respuestas_value->opcion; ?>" class="form-control lista-option" id="lista_option<?php echo $contador_pregunta; ?>[]"  name="lista_option<?php echo $contador_pregunta; ?>[]">  
                                     <input type="text" value="<?php echo $variables_respuestas_value->retroalimentacion; ?>" class="form-control retroradios" name="retroradios<?php echo $contador_pregunta; ?>[]" class="form-control texter" placeholder="Retroalimentacion <?php echo $variables_respuestas_contador; ?>">
                                   </div>  

                                   <?php if ($variables_respuestas_key>0): ?>
                                    <a href="#" class="btn btn-xs btn-default deleter_google-lista-option"><i class="fa fa-times"></i></a>
                                  <?php endif ?>


                                </div> 
                                <?php $variables_respuestas_contador++; ?>
                              <?php endforeach ?>
                            <?php endif ?>

                            <div class="col-lg-7">
                             <input type="text" placeholder="Clic para crear otra opción" class="form-control" id="lista-option-gost"  name="lista-option-gost[]">
                           </div>
                           <?php
                           break;

                            case '4':  // Campo de texto
                            ?>
                            <?php $variables_respuestas_contador=1; ?>
                            <?php if (@$variables_respuestas): ?>


                              <?php foreach (@$variables_respuestas as $variables_respuestas_key => $variables_respuestas_value): ?>
                                <div class="col-lg-7">
                                  <input type="text" value="<?php echo $variables_respuestas_value->texto; ?>" placeholder="Campo sin titulo 1" class="form-control" id="campo_pregunta<?php echo $contador_pregunta; ?>[]"  name="campo_pregunta<?php echo $contador_pregunta; ?>[]">    
                                  <input type="text" value="<?php echo $variables_respuestas_value->retroalimentacion; ?>" class="form-control retrotexto" name="retrotexto<?php echo $contador_pregunta; ?>[]" class="form-control texter" placeholder="Retroalimentacion 1">        
                                </div>
                                <?php $variables_respuestas_contador++; ?>
                              <?php endforeach ?>
                            <?php endif ?>
                            <?php
                            break;

                            default:

                            break;
                          }
                          ?>                      
                        </div>

                      </div>   

                    </li>

                    <?php $contador_pregunta++; ?>

                  <?php endforeach ?>

                  <?php ## si no hay preguntas realizadas, cargo como si nada ?>
                <?php else: ?>

                  <li class="mipregunta">
                    <div class="form-group dragt">

                     <h3 class="pregunta_number">Pregunta <span>1</span> <input type="hidden" name="num_pregunta[]" value="1"> </h3>


                     <label class="col-lg-2 control-label">Tipo de pregunta</label>

                     <div class="col-lg-3">
                       <select id="tipo_pregunta[]" name="tipo_pregunta[]" class="form-control selects">
                        <option value="">Seleccione</option>
                        <option value="1">Tipo test</option>
                        <option value="2">Elegir de una lista</option>
                         <?php /* ?>
                        <option value="3">Tipo test</option>
                        <?php */ ?>
                        <option value="4">Campo de texto</option>
                      </select>
                    </div> 

                    <div class="col-lg-9 prepregunta">
                      <label class="col-lg-2 control-label">Titulo de la pregunta</label><div class="col-lg-7 pregunta_titlex"><input type="text" name="pregunta[]" id="pregunta[]" class="form-control" placeholder="Pregunta sin titulo"></div>
                    </div>

                    <div class="col-lg-9 competencia_class">
                      <label class="col-lg-2 control-label">Competencia</label><div class="col-lg-7 pregunta_titlex">
                      <select id="id_competencias[]" name="id_competencias[]" class="form-control competencias_select">
                        <option value="">Seleccione</option>
                        <?php foreach ($competencias as $compe_key => $compe_value): ?>
                          <option value="<?php echo $compe_key; ?>"><?php echo $compe_value; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="custom_field col-lg-10"></div>
                </div>   

              </li>

            <?php endif ?>


          </ul>

          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">

             <a class="clone_pregunta" href="#"> <button class="btn btn-sm btn-success"> Crear nueva pregunta</button> </a>
             <button class="btn btn-sm btn-primary btnguardar" type="submit">Guardar</button>
             <a onclick="window.parent.$.prettyPhoto.close();"><button class="btn btn-sm btn-warning btncancelar" type="button">Volver</button></a>
           </div>
         </div>

         <input type="hidden" name="id_cursos" id="id_cursos" value="<?php echo $this->uri->segment(4); ?>">
         <input type="hidden" name="id_modulos" id="id_modulos" value="<?php echo $this->uri->segment(5); ?>">
         <input type="hidden" name="id_actividades_barra" id="id_actividades_barra" value="<?php echo $this->uri->segment(6); ?>">

       </form>
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


<div id="plantilla_pregunta" style="display:none;">

  <div class="form-group dragt">

   <h3 class="pregunta_number">Pregunta <span>  </span> <input type="hidden" name="num_pregunta[]"> </h3>

   <label class="col-lg-3 control-label">Tipo de pregunta</label>

   <div class="col-lg-2">
    <select class="form-control selects" name="tipo_pregunta[]" id="tipo_pregunta[]">
      <option value="">Seleccione</option>
      <option value="1">Tipo test</option>
      <option value="2">Elegir de una lista</option>
<?php /* ?>
      <option value="3">Tipo test</option>
      <?php */ ?>   
      <option value="4">Campo de texto</option>
    </select>
  </div> 

  <div class="col-lg-9 prepregunta">
    <label class="col-lg-2 control-label">Titulo de la pregunta</label><div class="col-lg-7 pregunta_titlex"><input type="text" placeholder="Pregunta sin titulo" class="form-control" id="pregunta[]" name="pregunta[]"></div>
  </div>

  <div class="col-lg-9 competencia_class">
    <label class="col-lg-2 control-label">Competencia</label><div class="col-lg-7 pregunta_titlex">
    <select id="id_competencias[]" name="id_competencias[]" class="form-control competencias_select">
      <option value="">Seleccione</option>
      <?php foreach ($competencias as $compe_key => $compe_value): ?>
        <option value="<?php echo $compe_key; ?>"><?php echo $compe_value; ?></option>
      <?php endforeach ?>
    </select>
  </div>
</div>

<div class="custom_field col-lg-10"></div>
</div>   

</div>
<script src="html/admin/js/jquery-ui-1.10.4.custom.min.js"></script> 
<script src="html/admin/js/jquery.prettyPhoto.js"></script> 
<script src="html/admin/js/jquery.slimscroll.min.js"></script> 
<script src="html/admin/js/bootstrap-fileupload.js"></script>

<script src="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>/assets/js/actividades.js"></script>
</body>
</html>