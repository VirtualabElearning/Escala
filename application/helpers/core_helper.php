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