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




}


