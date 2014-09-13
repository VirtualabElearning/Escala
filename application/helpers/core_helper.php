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
			if (!in_array($id_cursos, $mis_cursos_asignados)) {	
				if ($url) { redirect($url); }
				else{ redirect('/'); }
			}
		}
	}


#funcion que comprueba si estoy o no inscrito
	if (!function_exists('if_inscrito')) {
		function if_inscrito($id_cursos,$mis_cursos_asignados)
		{


			if (!@in_array($id_cursos, $mis_cursos_asignados)) {	
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