<?php 

if (!function_exists('generar_campos_actividad')) {
	function generar_campos_actividad ($id_tipo_actividades,$id_actividad,$tabla_actividad,$datos_actividad,$id_modulos,$id_cursos,$id_modulos,$id_actividades_barra)  {
		

		#echo "id_tipo_actividades :{$id_tipo_actividades} <br>";
		#echo "id_actividad :{$id_actividad} <br>";
		#echo "tabla_actividad :{$tabla_actividad} <br>";
		#echo "id_modulos :{$id_modulos} <br>";

		switch ($id_tipo_actividades)  {

				case '1':  # video

				echo input_text_actividades ("Url del video","url_video","url_video","Ingrese la url del video (Url youtube completa)",@$datos_actividad->url_video );
				echo input_text_actividades ("Pregunta","pregunta","pregunta","Ingrese la pregunta",@$datos_actividad->pregunta );
				echo hidden_actividades('id_actividades_videos','id_actividades_videos',@$datos_actividad->id_actividades_videos);
				$opciones=array('1'=>'Tipo test','2'=>'Elegir de una lista','4'=>'Campo de texto');
				echo select_actividades ("Tipo pregunta","tipo_pregunta","tipo_pregunta",$opciones,@$datos_actividad->tipo_pregunta );
				break;





				case '2':  # foro
				$error=form_error('image', '<div class="mensaje_error">', '</div>');
				echo hidden_actividades('id_actividades_foro','id_actividades_videos',@$datos_actividad->id_actividades_foro);
				echo editor_actividades ("Discusión","contenido_foro","contenido_foro","Ingrese el contenido del foro",@$datos_actividad->contenido_foro );
				echo input_foto_actividades ('Foto','actividades_foro',@$datos_actividad->foto,$error);
				



				break;

				case '3':  # evaluacion
/*
echo $id_tipo_actividades;
echo "<br>";
echo $id_actividad;
echo "<br>";
echo $tabla_actividad;
echo "<br>";
echo "<br>";
echo $id_cursos."<br>";
echo $id_modulos."<br>";
echo $id_actividades_barra."<br>";
*/


echo gen_preguntas($id_cursos,$id_modulos,$id_actividades_barra);


break;


				case '4':  # clases en vivo


				break;
			}





		}

	}



	if (!function_exists('obtener_campos_post_actividad')) {
		function obtener_campos_post_actividad ($id_tipo_actividades,$data,$post,$thiz)  {

			switch ($id_tipo_actividades)  {


				case '1':  # video

				$data['url_video']=$post['url_video'];
				$data['id_actividades_videos']=@$post['id_actividades_videos'];
				$data['id_modulos']=@$post['id_modulos'];
				$data['pregunta']=@$post['pregunta'];
				$data['tipo_pregunta']=@$post['tipo_pregunta'];
				if ($data['tipo_pregunta']==3)  { $data['variables_pregunta']=''; }
				break;


				case '2':  # foro

				$data['contenido_foro']=$post['contenido_foro'];
				$data['id_actividades_foro']=@$post['id_actividades_foro'];
				$data['id_modulos']=@$post['id_modulos'];


				/*configuracion basica para subir una foto*/
				$config['upload_path']   =   "uploads/actividades_foro/";
				$config['allowed_types'] =   "gif|jpg|jpeg|png";
				$config['max_size']      =   "5000";
				$config['max_width']     =   "2000";
				$config['max_height']    =   "2000";
				$config['remove_spaces']  = TRUE;
				$config['encrypt_name']  = TRUE;
				$thiz->load->library('upload',$config);

				if ($_FILES['userfile']['tmp_name'])  {
					if(!$thiz->upload->do_upload())

					{

				#echo $this->upload->display_errors(); exit;
				#$this->editar($id,$this->upload->display_errors());
				#$this->load->view('admin/view_'.$variables['modulo'].'_editar',$data);

					}

					else

					{

						/* subo la foto */
						$finfo=$thiz->upload->data();

						/* Si existe la foto antes, la borra y sube la nueva */
						if (@$post['foto_antes'])  {
							@unlink('uploads/actividades_foro/'.$post['foto_antes']);
						}

						/* obtengo nombre de la foto y la extension */
						$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
						$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
						$data['foto'] = $finfo['file_name'];



					}

				}
				else {


						if (   $post['image']   )  { }   // si existe el post, no hace nada
						else {
							if ($post['foto_antes'])  {
								@unlink('uploads/actividades_foro/'.$post['foto_antes']);
							}
							$data['foto'] = "";	
						}

					}
					break;



				case '3':  # evaluacion

				
				//$data['url_video']=$post['url_video'];
				$data['id_actividades_evaluacion']=@$post['id_actividades_evaluacion'];
				$data['id_modulos']=@$post['id_modulos'];
				#$data['pregunta']=@$post['pregunta'];
				#$data['tipo_pregunta']=@$post['tipo_pregunta'];
				#if ($data['tipo_pregunta']==3)  { $data['variables_pregunta']=''; }

				break;


				case '4':  # clases en vivo


				break;
			}

			return $data;


		}

	}




	if (!function_exists('eliminar_campos_actividad')) {
		function eliminar_campos_actividad ($id_tipo_actividades,$data)  {

			switch ($id_tipo_actividades)  {


				case '1':  # video

				unset($data['url_video']);
				unset($data['id_actividades_videos']);
				unset($data['tipo_pregunta']);
				unset($data['variables_pregunta']);
				unset($data['pregunta']);	
				break;


				case '2':  # foro

				unset($data['contenido_foro']);
				unset($data['id_actividades_foro']);
				unset($data['foto']);

				break;



				case '3':  # evaluacion
				unset($data['id_actividades_evaluacion']);
				unset($data['tipo_pregunta']);
				unset($data['pregunta']);			

				break;


				case '4':  # clases en vivo


				break;
			}

			return $data;


		}

	}






	if (!function_exists('input_text_actividades')) {
		function input_text_actividades ($texto,$id,$nombre,$placeholder,$valor=null)  {
			$html = '<div class="form-group">
			<label class="col-lg-1 control-label">'.$texto.'</label>
			<div class="col-lg-5"><input type="text" name="'.$nombre.'" value="'.$valor.'" id="'.$id.'" class="form-control" placeholder="'.$placeholder.'">
			</div></div>';
			return $html;
		}

	}



	if (!function_exists('select_actividades')) {
		function select_actividades ($texto,$id,$nombre,$opciones,$valor=null)  {
			$html = '<div class="form-group">
			<label class="col-lg-1 control-label">'.$texto.'</label>
			<div class="col-lg-2">
				<select class="form-control" name="'.$nombre.'" id="'.$id.'">';
					foreach ($opciones as $key => $value) {
						$html.= '<option value="'.$key.'"';  
						if ($key==$valor) {  $html.="selected";  }
						$html.='>'.$value.'</option>';
					}
					$html.='</select></div></div>';

					return $html;
				}
			}




			if (!function_exists('get_id_foto_campos')) {
				function get_id_foto_campos ($campos)  {
					$llave_primaria='';
					$campo_foto='';
					foreach ($campos as $campo) {  if ($campo->type =='mediumtext')  {  $campo_foto=$campo->name;  }   if ($campo->primary_key==1)  {  $llave_primaria=$campo->name;  }  } 
					return  $llave_primaria."|".$campo_foto;

				}

			}




			if (!function_exists('editor_actividades')) {
				function editor_actividades ($texto,$id,$nombre,$placeholder,$valor=null)  {
					$html = ' <div class="form-group">
					<label class="col-lg-1 control-label">'.$texto.'</label>
					<div class="col-lg-6">
						<textarea class="cleditor" id="'.$id.'" name="'.$nombre.'" placeholder="'.$placeholder.'">'.$valor.'</textarea>
					</div>
				</div> ';
				return $html;
			}

		}

		if (!function_exists('input_foto_actividades')) {

			function input_foto_actividades ($texto,$carpeta,$valor=null,$error_extra=null)  {

				$html = '<div class="form-group">
				<label class="col-lg-1 control-label">'.$texto.'</label>
				<div class="col-lg-5">
					<input type="hidden" name="image" id="image" value="'.base_url().'uploads/'.$carpeta.'/'.$valor.'">

					<div class="fileupload'; 
					if ($valor):  
						$html.=' fileupload-exists ';
					else :  $html.=' fileupload-new ';  
					endif;  
					$html.='" data-provides="fileupload">

					<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA" alt="img"/>
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">            
						<img src="'.base_url().'uploads/'.$carpeta.'/'.$valor.'" alt="img"/>
					</div>
					<div>
						<span class="btn btn-file">
							<span class="fileupload-exists">Cambiar</span>
							<span class="fileupload-new">Seleccione imagen</span>         
							<input type="file" value="" name="userfile" id="userfile"/>
						</span>
						<a href="#" class="btn fileupload-exists delete_photoxx" data-dismiss="fileupload">Borrar</a>';
						if ($error_extra):
							$html.='<div class="mensaje_error"> '.$error_extra.'</div>';
						endif;
						$html.='</div></div></div></div>';
						if ($valor) {
							$html.='<input type="hidden" name="foto_antes" id="foto_antes" value="'.$valor.'">';
						}
						return  $html; 

					}

				}








				if (!function_exists('hidden_actividades')) {
					function hidden_actividades ($id,$nombre,$value)  {
						$html ='<input type="hidden" name="'.$nombre.'" id="'.$id.'" value="'.$value.'">';
						return $html;
					}

				}