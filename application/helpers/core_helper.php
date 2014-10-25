<?php 

if (!function_exists('amigable')) {
	function amigable ($texto)  {
		$texto = strtolower($texto);
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$texto = str_replace ($find, $repl, $texto);
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