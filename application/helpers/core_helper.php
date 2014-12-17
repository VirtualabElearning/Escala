<?php 

if (!function_exists('amigable')) {
	function amigable ($texto)  {
		
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');		
		$texto = str_replace ($find, $repl, $texto);

		$find = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');		
		$texto = str_replace ($find, $repl, $texto);

		$texto = strtolower($texto);

		$find = array(' ', '&', '\r\n', '\n', '+');
		$texto = str_replace ($find, '-', $texto);
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$texto = preg_replace ($find, $repl, $texto);
		return $texto; 
	}

}



if (!function_exists('asignar_frase_diccionario')) {
	function asignar_frase_diccionario ($diccionario,$llave,$default,$tipo=1)  {



		if (trim($llave)!='')    {

		    #singular
			if ($tipo==1)  {
				$data_frase=explode ("|",$diccionario[$llave]);
				$texto=$data_frase[0];

			}
            #plural
			if ($tipo==2)  {
				$data_frase=explode ("|",$diccionario[$llave]);
				$texto=$data_frase[1];
			}

		}

		else {
			
			$texto=$default;	
		}




		return $texto; 
	}

}


if (!function_exists('set_icon_archivo')) {
	function set_icon_archivo ($extension=null)  {
		
		$icon=$extension;
		$path = $extension;
		$ext = pathinfo($path, PATHINFO_EXTENSION);


		$imgs = array("jpg", "jpeg", "png", "gif", "bmp", "jpe", "tif", "tiff", "dib");
		if (!in_array($ext, $imgs)) {
			switch ($ext) {
				case 'doc':
				$icon="html/admin/img/archives/doc.png";
				break;

				case 'docx':
				$icon="html/admin/img/archives/doc.png";
				break;

				case 'xls':
				$icon="html/admin/img/archives/xls.png";
				break;

				case 'xlsx':
				$icon="html/admin/img/archives/xls.png";
				break;

				case 'ppt':
				$icon="html/admin/img/archives/ppt.png";
				break;

				case 'pptx':
				$icon="html/admin/img/archives/ppt.png";
				break;

				case 'pps':
				$icon="html/admin/img/archives/ppt.png";
				break;

				case 'ppsx':
				$icon="html/admin/img/archives/ppt.png";
				break;

				case 'txt':
				$icon="html/admin/img/archives/txt.png";
				break;

				case 'zip':
				$icon="html/admin/img/archives/zip.png";
				break;

				case 'rar':
				$icon="html/admin/img/archives/zip.png";
				break;

				case 'pdf':
				$icon="html/admin/img/archives/pdf.png";
				break;

				default:
				$icon="html/admin/img/archives/default.png";
				break;
			}

		}

		return $icon;
	}

}
if (!function_exists('envio_correo')) {

	function envio_correo ($array_claves,$from_mail,$from_name,$to_mail,$asunto,$to_name,$plantilla_correo,$thiz) {
		


		$content = file_get_contents( $plantilla_correo );
		foreach ($array_claves as $key => $value) {
			$content = str_replace($key, $value, $content);
		}


		$config['protocol']    = 'smtp';
		$config['smtp_host']    = $thiz->config->item('smtp_host');
		$config['smtp_port']    = $thiz->config->item('smtp_port');
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $thiz->config->item('correo_contacto');
		$config['smtp_pass']    = $thiz->config->item('clave_contacto');



		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
  	    $config['validation'] = TRUE; // bool whether to validate email or not          




  	    $config['mailtype'] = 'html';
  	    $thiz->load->library("email");
  	    $thiz->email->initialize($config);

  	    $thiz->email->from($from_mail, $from_name);
  	    $thiz->email->to($to_mail,$to_name);
  	    $thiz->email->subject($asunto);
  	    $thiz->email->message( $content );

		#echo $content; exit;
  	    $thiz->email->send();

  	    return true;

  	}

  }


## guarda la imagen en la carpeta indicada (origen,destino)
  if (!function_exists('save_image')) {
  	function save_image($inPath,$outPath)
  	{ 
  		$content = file_get_contents($inPath);
  		file_put_contents($outPath, $content);
  	}}

## compruebo si realmente estoy inscrito a ese curso, de lo contrario, redirecciono
  	if (!function_exists('if_mi_curso')) {
  		function if_mi_curso($id_cursos,$mis_cursos_asignados,$url=null)
  		{ 

  			foreach ($mis_cursos_asignados as $key => $value) {
  				$var=0;
  				
  				if ($value==$id_cursos)
  				{
  					$var="1";
  					break;
  				}
  			}


  			if ($var!=1) {	
  				if ($url) { redirect($url); }
  				else{ redirect('/'); }
  			}

  		}
  	}


#funcion que comprueba si estoy o no inscrito
  	if (!function_exists('if_inscrito')) {
  		function if_inscrito($id_cursos,$mis_cursos_asignados)
  		{

  			if ($mis_cursos_asignados) {


  				foreach ($mis_cursos_asignados as $key => $value) {
  					$var=0;


  					if ($value==$id_cursos)
  					{
  						$var="1";
  						break;
  					}


  				}
  			}


  			if ($var!=1) {	
  				return 0;
  			}

  			else {
  				return 1;
  			}



  		}

  	}

  	



  	if (!function_exists('crea_zip')) {
  		function crea_zip($archivos = array(),$destino = '',$remplazar = false) {

  			if(file_exists($destino) && !$remplazar) { return false; }

			#$archivos_validos = array();

  			if(is_array($archivos)) {

  				foreach($archivos as $archivo) {

  					if(file_exists($archivo)) {
  						$archivos_validos[] = $archivo;
  					}
  				}
  			}





  			if(count($archivos_validos)) {

  				$zip = new ZipArchive();
  				if($zip->open($destino,$remplazar ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
  					return false;
  				}

  				foreach($archivos_validos as $archivo1) {

					#$partes=explode ("/",$archivo1);
  					$archivo1_n=str_replace("tmp/", "", $archivo1);
					#$zip->addFile($archivo1,$partes[count($partes)-1]);
  					$zip->addFile($archivo1,$archivo1_n);
  				}


  				$zip->close();


  				return file_exists($destino);
  			}
  			else
  			{
  				return false;
  			}






  		}

  	}



  	if (!function_exists('borrar_carpeta')) {
  		function borrar_carpeta($path) {
  			return is_file($path) ?
  			@unlink($path) :
  			array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
  		}

  	}




  	if (!function_exists('generar_estatus')) {
  		function generar_estatus($id_cursos) {

  			$ci =& get_instance();
  			$ci->load->model('model_cursos');
	####consulto puntos actuales con los puntos requeridos a cada nivel
  			$mis_puntos_actuales_curso_actual=$ci->model_cursos->get_puntos_totales_en_curso ($ci->encrypt->decode($ci->session->userdata('id_usuario')),$id_cursos);

  			$tmp=$mis_puntos_actuales_curso_actual[0];
  			$mis_puntos_actuales_curso_actual=$tmp->puntaje;
  			$tmp='';
			$niveldios=0; #3 para saber si ya superlo los puntos de campeon
			## nivel experto

			$mistatus=$ci->model_cursos->get_status($ci->config->item('Nuevo'));

			## actualizo mi estatus en el curso!
			if ($mis_puntos_actuales_curso_actual>=$ci->config->item('requerido_experto')) {
				$ci->model_cursos->update_estatus($id_cursos,$ci->encrypt->decode($ci->session->userdata('id_usuario')),$ci->config->item('Experto'));
				$mistatus=$ci->model_cursos->get_status($ci->config->item('Experto'));

			}

			if ($mis_puntos_actuales_curso_actual>=$ci->config->item('requerido_campeon')) {
				$ci->model_cursos->update_estatus($id_cursos,$ci->encrypt->decode($ci->session->userdata('id_usuario')),$ci->config->item('Campeon'));
				$mistatus=$ci->model_cursos->get_status($ci->config->item('Campeon'));

			}



			if ($mis_puntos_actuales_curso_actual < $ci->config->item('requerido_experto'))     { 
				$estatus_proximo=$ci->model_cursos->get_status ($ci->config->item('Experto'));
				$requeridos=$ci->config->item('requerido_experto');
				$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
				$icono_actual="html/site/img/5.png";
				$icono_futuro="html/site/img/6.png";
			}
			else {
			## nivel campeon
				if ($mis_puntos_actuales_curso_actual < $ci->config->item('requerido_campeon')) {
					$estatus_proximo=$ci->model_cursos->get_status ($ci->config->item('Campeon'));
					$requeridos=$ci->config->item('requerido_campeon');
					$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
					$icono_actual="html/site/img/6.png";
					$icono_futuro="html/site/img/7.png";
				}
## ya subio a lo más alto
				else {
					$niveldios=1;
					$icono_actual="html/site/img/7.png";
					$icono_futuro="html/site/img/7.png";
					$requeridos=$ci->config->item('requerido_campeon');
				}

			}
			$puntos_grafica=8;
			$xxpunto=$requeridos/$puntos_grafica;
			



			if ($xxpunto!=0) {
				$cuantospuntos_on= round ($mis_puntos_actuales_curso_actual / $xxpunto);
			}
			#echo $cuantospuntos_on;
			$html_statusbar.='<img alt="" src="'.$icono_actual.'">';
			$html_statusbar.='<ul>';

			for ($i=1; $i <=$puntos_grafica; $i++) { 
				if ($i<=$cuantospuntos_on)  {
					$html_statusbar.='<li class="s_on"></li>';
				}
				else {
					if ($niveldios==1) { $html_statusbar.='<li class="s_on"></li>'; } else {
						$html_statusbar.='<li class="s_off"></li>';
					}
				}

			}

			$html_statusbar.='<img alt="" src="'.$icono_futuro.'">';

			return $html_statusbar."|".$requeridos."|".$mistatus->nombre;

			

		}



	}


	if (!function_exists('crear_log_txt')) {
		function crear_log_txt($archivo,$mensaje) {
			$ar=fopen($archivo,"a") or
			die("Problemas en la creacion");
			fputs($ar,$mensaje);
			fputs($ar,"\n");
			fputs($ar,"--------------------------------------------------------");
			fputs($ar,"\n\n");
			fclose($ar);
		}	
	}


	## funcion para saber si ya habia respondido el examen
	if (!function_exists('getif_respuesta_eval')) {
		function getif_respuesta_eval($id_cursos,$id_actividades_barra) {
			$ci =& get_instance();
			$ci->load->model('model_cursos');
			$id_usuarios=$ci->encrypt->decode($ci->session->userdata('id_usuario'));
			$resultado=$ci->model_cursos->getif_eval ($id_cursos,$id_usuarios,$id_actividades_barra);
			if ($resultado->id_actividades_barra) {
				return $resultado->id_actividades_barra;
			}	
			else {

				return -1;
			}
			

		}
	}



	if (!function_exists('truncate')) {
		function truncate($text, $chars = 100) {
			$text = $text." ";
			$text = substr($text,0,$chars);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text."...";
			return $text;
		}

	}


	if (!function_exists('fecha_texto')) {
		function fecha_texto($fecha) {

			$data_f=explode (" ",$fecha);
			$data_ffecha=explode ("-",$data_f[0]);	
			$arr_meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

			$fecha_nueva=$arr_meses[$data_ffecha[1]]." ".$data_ffecha[2];

			return $fecha_nueva;
		}

	}




	if (!function_exists('fecha_pdf')) {
		function fecha_pdf($fecha) {

			$data_f=explode (" ",$fecha);
			$data_ffecha=explode ("-",$data_f[0]);	
			$arr_meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

			$fecha_nueva="<b>".$data_ffecha[2]."</b> de <b>".$arr_meses[$data_ffecha[1]]."</b> de ".$data_ffecha[0];

			return $fecha_nueva;
		}

	}


	if (!function_exists('make_seed')) {
		function make_seed()
		{
			list($usec, $sec) = explode(' ', microtime());
			return (float) $sec + ((float) $usec * 100000);
		}

	}






		## funcion para saber si ya habia respondido el examen
	if (!function_exists('get_puntos_curso')) {
		function get_puntos_curso($id_usuarios,$id_cursos) {
			$ci =& get_instance();
			$ci->db->select_sum('puntaje.puntaje');
			$ci->db->where('puntaje.id_estados',$ci->config->item('estado_activo'));
			$ci->db->where('puntaje.id_usuarios', $id_usuarios); 
			$ci->db->where('puntaje.id_cursos', $id_cursos); 

			$query = $ci->db->get('puntaje');
			$resultados=$query->row();
			#echo $ci->db->last_query();
			return $resultados->puntaje;
			#krumo ($resultados);

		}

	}


	## funcion para saber el procentaje de avance en el curso
	if (!function_exists('get_porcentaje_usuario')) {
		function get_porcentaje_usuario($id_usuarios,$id_cursos) {
			$ci =& get_instance();
			##consulto los modulos del curso actual
			$ci->db->select('id_modulos');
			$ci->db->where('modulos.id_cursos', $id_cursos); 
			$ci->db->where('modulos.id_estados',$ci->config->item('estado_activo'));
			$query = $ci->db->get('modulos');
			$resultados=$query->result();
			$arr_id_modulos=array();
			foreach ($resultados as $key => $value) {
				$arr_id_modulos[]=$value->id_modulos;
			}


			### actividades totales del curso
			$ci->db->select('id_actividades_barra,actividades_barra.id_actividades,actividades_barra.id_tipo_actividades');
			$ci->db->join('usuarios', 'usuarios.id_usuarios=actividades_barra.id_usuario_creado');
			$arr_roles=array();
			$arr_roles[]=$ci->config->item('roles_master');	
			$arr_roles[]=$ci->config->item('roles_docente');	
			$arr_roles[]=$ci->config->item('roles_administrador');
			$ci->db->where_in('actividades_barra.id_modulos', $arr_id_modulos);
			$ci->db->where('actividades_barra.id_estados', $ci->config->item('estado_activo')); 
			$ci->db->where_in('usuarios.id_roles', $arr_roles);
			$query = $ci->db->get('actividades_barra');
			$actividades_totales_curso=$query->result();

			## actividades totales del usuario vistas del curso
			$ci->db->join('actividades_barra', 'actividades_barra.id_actividades_barra=modulos_vistos.id_actividades');
			$ci->db->join('usuarios', 'usuarios.id_usuarios=actividades_barra.id_usuario_creado');
			$ci->db->where_in('actividades_barra.id_modulos', $arr_id_modulos);
			$ci->db->where('modulos_vistos.id_estados', $ci->config->item('estado_realizado')); 
			$ci->db->where('actividades_barra.id_estados', $ci->config->item('estado_activo')); 
			$ci->db->where_in('usuarios.id_roles', $arr_roles);
			$ci->db->where('modulos_vistos.id_usuarios', $id_usuarios); 
			$query = $ci->db->get('modulos_vistos');
			$actividades_vistas_totales_curso=$query->result();



			$procentaje_avance=round ( (100*count($actividades_vistas_totales_curso) ) / count($actividades_totales_curso) );

			return $procentaje_avance;
		}




## funcion que me trae todas las evaluaciones realizadas con los campos de texto VS actividades realizadas del usuario y que no esté calificado
		if (!function_exists('get_evaluaciones_texto')) {
			function get_evaluaciones_texto($id_usuarios,$id_cursos) {
				$ci =& get_instance();

				$ci->db->where('actividades_respuestas_usuario.id_estados', $ci->config->item('estado_activo')); 
				$ci->db->where('actividades_respuestas_usuario.id_usuarios', $id_usuarios); 
				$ci->db->where('actividades_respuestas_usuario.id_cursos', $id_cursos);
				$ci->db->where('actividades_respuestas_usuario.tipo_pregunta', 0); 
				$query = $ci->db->get('actividades_respuestas_usuario');
				$respuestas_usuarios=$query->result();

				
				#krumo ($ci->db->last_query());

				$arr_preguntas_eval=array();

				#krumo ($respuestas_usuarios);
				foreach ($respuestas_usuarios as $key => $value) {

###################################  segmentacion de las respuestas de usuario ##########################################################

					$main=json_decode($value->respuestas);

					foreach ($main as $sub_key => $sub_value) {

						if ($sub_value->tipo_pregunta==4) {

							$sub_value->id_actividades=$value->id_actividades;
							$sub_value->id_actividades_barra=$value->id_actividades_barra;

							$ci->db->where('calificaciones.id_estados', $ci->config->item('estado_activo')); 
							$ci->db->where('calificaciones.key_texto', $sub_value->variables_respuesta[0]->id_texto); 
							$ci->db->where('calificaciones.id_usuarios', $id_usuarios); 
							$ci->db->where('calificaciones.id_cursos', $id_cursos); 
							$ci->db->where('calificaciones.id_actividades_barra', $value->id_actividades_barra); 
							$ci->db->where('calificaciones.id_actividades', $value->id_actividades); 
							$query = $ci->db->get('calificaciones');
							$if_calificado=$query->row();

							## si no existe, agrego en array los datos para mostrar las preguntas de las evaluaciones que debo calificar
							if (!$if_calificado) {
								$array_preguntas_por_calificar[]=$sub_value;
							}
							else {
								$sub_value->calificado='si';
								$array_preguntas_por_calificar[]=$sub_value;
							}

						}

					}


###################################  segmentacion de las respuestas de usuario ##########################################################


				}  ## fin foreach principal




				return $array_preguntas_por_calificar;





			}


		}










	}





### funcion para saber si habilitamos o no el boton de calificar  (En lista de evaluaciones)
	if (!function_exists('if_calificar')) {
		function if_calificar($id_usuarios,$id_cursos,$id_actividades_barra,$id_actividades) {
			$ci =& get_instance();
			$ci->db->where('calificaciones.id_usuarios', $id_usuarios); 
			$ci->db->where('calificaciones.id_cursos', $id_cursos);
			$ci->db->where('calificaciones.id_actividades_barra',  $id_actividades_barra);
			$ci->db->where('calificaciones.id_actividades',  $id_actividades); 
			$ci->db->where('calificaciones.id_estados', $ci->config->item('estado_activo')); 
			$query = $ci->db->get('calificaciones');
			$respuestas_usuarios=$query->row();
			#krumo ($ci->db->last_query());
			if ($respuestas_usuarios) { return 1; }
			else { return 0; }
			
		}



	}







### funcion para saber si habilitamos o no el boton de calificar   (En lista de estudiantes)
	if (!function_exists('if_calificar2')) {
		function if_calificar2($id_usuarios,$id_cursos) {
			$ci =& get_instance();
			### consulto si existe actividades de evaluacion del curso y si existe respuesta de usuario en esa actividad evaluacion
			$ci->db->where('modulos.id_cursos', $id_cursos); 
			$ci->db->where('actividades_respuestas_usuario.id_usuarios', $id_usuarios); 
			$ci->db->where('actividades_barra.id_tipo_actividades', 3); 
			$ci->db->join('actividades_evaluacion', 'actividades_evaluacion.id_modulos=modulos.id_modulos');
			$ci->db->join('actividades_barra', 'actividades_barra.id_actividades=actividades_evaluacion.id_actividades_evaluacion');	
			$ci->db->join('actividades_respuestas_usuario', 'actividades_respuestas_usuario.id_actividades_barra=actividades_barra.id_actividades_barra');

			$query = $ci->db->get('modulos');
			$respuestas_usuarios=$query->row();

			if (!$respuestas_usuarios) { return 1; exit; }

			### consulto ahora si ya fúe calificada la actividad evaluacion, si no... retorno para que se pueda calificar
			
			$tmp=json_decode($respuestas_usuarios->variables_pregunta );
			$tmp_array_key_texto=array();
			foreach ($tmp as $tmp_key => $tmp_value) {
				### si es un campo de texto, guardo el id_texto en un array para consultarlo en la tabla de calificaciones si existe 
				### si aparece mayor a 2 y calificado 1 , se considera como no calificado
				if ($tmp_value->tipo_pregunta==4) {
					$tmp_sub=json_decode($tmp_value->variables_respuesta);
					$tmp_sub=$tmp_sub[0];
					$tmp_array_key_texto[]=$tmp_sub->id_texto;
				}
			}

			$ci->db->where('calificaciones.id_cursos', $id_cursos); 
			$ci->db->where('calificaciones.id_usuarios', $id_usuarios); 
			$ci->db->where_in('key_texto', $tmp_array_key_texto);
			$query = $ci->db->get('calificaciones');
			$calificado_usuarios=$query->result();

			## si retorno 1 es porque ya califiqué ó no existe nada por calificar

			if ($calificado_usuarios) { return 1; }
			else { return 0; }
		}
	}







### funcion para saber si habilitamos o no el boton de calificar   (En lista de cursos)
	if (!function_exists('if_calificar3')) {
		function if_calificar3($id_cursos) {

			$ci =& get_instance();
			### consulto si existe actividades de evaluacion del curso y si existe respuesta de usuario en esa actividad evaluacion
			$ci->db->where('modulos.id_cursos', $id_cursos);
			$ci->db->where('cursos_asignados.id_tipo_planes', $ci->config->item('Premium')); 
			$ci->db->where('actividades_barra.id_tipo_actividades', 3); 
			$ci->db->join('actividades_evaluacion', 'actividades_evaluacion.id_modulos=modulos.id_modulos');
			$ci->db->join('actividades_barra', 'actividades_barra.id_actividades=actividades_evaluacion.id_actividades_evaluacion');	
			$ci->db->join('actividades_respuestas_usuario', 'actividades_respuestas_usuario.id_actividades_barra=actividades_barra.id_actividades_barra');
			$ci->db->join('usuarios', 'usuarios.id_usuarios=actividades_respuestas_usuario.id_usuarios');
			$ci->db->join('cursos_asignados', 'cursos_asignados.id_cursos=modulos.id_cursos and cursos_asignados.id_usuarios=usuarios.id_usuarios');

			$query = $ci->db->get('modulos');
			$respuestas_usuarios=$query->result();

			$id_usuarios_nocalificado_arr=array();

			## evaluo cual tiene ya calificado y cuales no.
			foreach ($respuestas_usuarios as $key => $value) {

				$ci->db->where('calificaciones.id_cursos', $id_cursos); 

				$ci->db->where('calificaciones.id_usuarios', $value->id_usuarios); 
				$ci->db->where('calificaciones.id_actividades_barra', $value->id_actividades_barra); 
				$ci->db->where('calificaciones.id_actividades', $value->id_actividades); 

				$query = $ci->db->get('calificaciones');
				$calificado_usuarios=$query->row();
				## si no está calificado...
				if (!$calificado_usuarios) {
					$id_usuarios_nocalificado_arr[]=$value->nombres;
				}
			}



			#retorno los NO Calificados
			return count($id_usuarios_nocalificado_arr);

		}

	}






### funcion para saber si habilitamos o no el boton de calificar
	if (!function_exists('get_est_curso_actual')) {
		function get_est_curso_actual($id_cursos) {
			$ci =& get_instance();
			$ci->db->where('cursos_asignados.id_tipo_planes', $ci->config->item('Premium'));
			$ci->db->where('cursos_asignados.id_cursos', $id_cursos);
			$ci->db->where('cursos_asignados.id_estados', $ci->config->item('estado_activo')); 
			$query = $ci->db->get('cursos_asignados');
			return $query->result();
		}
	}





### funcion para traer si existe clase en vivo del curso del docente actual
	if (!function_exists('if_class_vivo')) {
		function if_class_vivo($id_usuarios,$id_cursos) {
			$ci =& get_instance();
			$ci->db->where('programacion_envio.id_usuarios', $id_usuarios); 
			$ci->db->where('programacion_envio.id_cursos', $id_cursos);
			#$ci->db->where('programacion_envio.id_estados', $ci->config->item('estado_activo')); 
			$query = $ci->db->get('programacion_envio');
			$programacion_envio=$query->row();
			if ($programacion_envio) { return $programacion_envio->id_programacion_envio; }
			else { return 0; }
		}
	}





### funcion para traer si existe clase en vivo del curso del docente actual programado... realice el envio a todos los estudiantes del sistema.
	if (!function_exists('get_send_if_class_vivo')) {
		function get_send_if_class_vivo($id_cursos) {
			$ci =& get_instance();
			$ci->db->where('programacion_envio.id_cursos', $id_cursos);
			$ci->db->where('programacion_envio.id_estados', $ci->config->item('estado_activo')); 
			$query = $ci->db->get('programacion_envio');
			$programacion_envio=$query->row();
			$hora_actual= date('H:i:s',time());
			$fecha_actual=date('Y-m-d');


			if ($programacion_envio->id_programacion_envio) {



			## si la hora es menor o igual a la actual y si la fecha de programacion envio es menor a la actual...	
				#if ($programacion_envio->hora_envio <= $hora_actual  && $programacion_envio->fecha_envio <= $fecha_actual ) {

				### si es menor, realizo el proceso de notificacion a cada uno de los usuarios que se encuentren en el curso registrado
				### cambio el estado de la programacion envio a inactivo para que no vuelva a notificar
				#echo "es menor";

				## consulto los estudiantes registrados en el curso que no hayan finalizado el curso

				$ci->db->where('cursos_asignados.id_cursos', $id_cursos);
				$ci->db->where('cursos_asignados.id_estados', $ci->config->item('estado_activo')); 
				$ci->db->where('cursos_asignados.finalizado', $ci->config->item('estado_inactivo')); 
				$query = $ci->db->get('cursos_asignados');
				$resultado_estudiantes=$query->result();


				## obtengo informacion del curso actual
				$ci->db->where('cursos.id_cursos', $id_cursos);
				$ci->db->where('cursos.id_estados', $ci->config->item('estado_activo')); 
				$query = $ci->db->get('cursos');
				$resultado_cursos=$query->row();



				## obtengo el primer modulo que se tenga en el curso actual a notificar
				$ci->db->where('modulos.id_cursos', $id_cursos);
				$ci->db->where('modulos.id_estados', $ci->config->item('estado_activo')); 
				$ci->db->order_by("orden", "asc"); 
				$query = $ci->db->get('modulos');
				$resultado_modulo=$query->row();

					## obtengo la primera actividad del primer modulo del curso para notificar al estudiante

				$ci->db->where('actividades_barra.id_modulos', $resultado_modulo->id_modulos);
				$ci->db->where('actividades_barra.id_estados', $ci->config->item('estado_activo')); 
				$ci->db->order_by("orden", "asc"); 
				$query = $ci->db->get('actividades_barra');
				$resultado_actividades=$query->row();

					## envio notificaciones a cada uno de los usuarios inscritos en el curso	
				foreach ($resultado_estudiantes as $resultado_estudiantes_key => $resultado_estudiantes_value) {
					$data_notificaciones['id_usuarios']=$resultado_estudiantes_value->id_usuarios; 
					$data_notificaciones['mensaje']="[curso ".$resultado_cursos->titulo."] ".$programacion_envio->mensaje;
					$data_notificaciones['id_estados']=$ci->config->item('estado_no_leido'); 
					$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
					$data_notificaciones['id_usuario_modificado']=$resultado_estudiantes_value->id_usuarios;
					$data_notificaciones['id_usuario_creado']=$resultado_estudiantes_value->id_usuarios;
					$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
					$data_notificaciones['id_cursos']= $id_cursos; 
					$data_notificaciones['id_modulos']= $resultado_modulo->id_modulos; 
					$data_notificaciones['id_actividades_barra']=$resultado_actividades->id_actividades_barra; 
					$id_notificaciones=$ci->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));

				}  ## fin foreach



				#	}  ##  fin si la hora es menor o igual a la actual y si la fecha de programacion envio es menor a la actual...	


		#### actualizo el estado de la programacion envio a programar envio = NO
				$data_update=array("id_estados"=>0);
				$ci->db->where('id_programacion_envio', $programacion_envio->id_programacion_envio);
				$ci->db->update('programacion_envio', $data_update); 


		#### funcion que actualiza el campo de clase en vivo del curso para mostrar el link en el botón de clase en vivo.			
				$data_update_curso=array("url_clase_en_vivo"=>$programacion_envio->url_clase);
				$ci->db->where('id_cursos', $id_cursos);
				$ci->db->update('cursos', $data_update_curso); 

			}  ## fin si existe programacion envio

		}  ## fin funcion 
	}  ## fin si existe funcion


	if (!function_exists('oscurecerColor')) {

		function oscurecerColor($color, $cant){

			$rojo = substr($color,1,2);
			$verd = substr($color,3,2);
			$azul = substr($color,5,2);


			$introjo = hexdec($rojo);
			$intverd = hexdec($verd);
			$intazul = hexdec($azul);


			if($introjo-$cant>=0) $introjo = $introjo-$cant;
			if($intverd-$cant>=0) $intverd = $intverd-$cant;
			if($intazul-$cant>=0) $intazul = $intazul-$cant;


			$rojo = dechex($introjo);
			$verd = dechex($intverd);
			$azul = dechex($intazul);


			if(strlen($rojo)<2) $rojo = "0".$rojo;
			if(strlen($verd)<2) $verd = "0".$verd;
			if(strlen($azul)<2) $azul = "0".$azul;


			$oscuridad = "#".$rojo.$verd.$azul;


			return $oscuridad;
		}
	}



	if (!function_exists('aclararColor')) {

		function aclararColor($color, $cant){

			$rojo = substr($color,1,2);
			$verd = substr($color,3,2);
			$azul = substr($color,5,2);


			$introjo = hexdec($rojo);
			$intverd = hexdec($verd);
			$intazul = hexdec($azul);


			if($introjo-$cant<=0) $introjo = $introjo+$cant;
			if($intverd-$cant<=0) $intverd = $intverd+$cant;
			if($intazul-$cant<=0) $intazul = $intazul+$cant;


			$rojo = dechex($introjo);
			$verd = dechex($intverd);
			$azul = dechex($intazul);


			if(strlen($rojo)>2) $rojo = "0".$rojo;
			if(strlen($verd)>2) $verd = "0".$verd;
			if(strlen($azul)>2) $azul = "0".$azul;


			$oscuridad = "#".$rojo.$verd.$azul;


			return $oscuridad;
		}
	}




	if (!function_exists('tipo_pregunta_encuesta')) {
		function tipo_pregunta_encuesta($valor){
			switch ($valor) {
				case '1':
				$tipo_pregunta="Tipo test";
				break;

				case '2':
				$tipo_pregunta="Elegir de una lista";
				break;

				case '3':
				$tipo_pregunta="Campo de texto";
				break;

				default:
				$tipo_pregunta="Ninguno";
				break;
			}
			return $tipo_pregunta;
		}

	}



### funcion para saber de cada posible respuesta cuantos respondieron
	if (!function_exists('get_resp_est')) {
		function get_resp_est($id_encuestas_detalle,$respuesta) {
			$ci =& get_instance();
			$ci->db->where('encuestas_respuestas.id_encuestas_detalle', $id_encuestas_detalle); 
			$ci->db->where('encuestas_respuestas.respuesta', $respuesta); 
			#$query = $ci->db->get('encuestas_respuestas');
			#$r=$query->result();
			$ci->db->from('encuestas_respuestas');
			$r=$ci->db->count_all_results();
			return $r;
			
		}
	}