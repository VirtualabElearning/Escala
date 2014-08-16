<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Errores extends CI_Controller {

	public function index()
	{
		
	}


public function enviar_error () {

$post=$this->input->post('data');

echo "Mensaje de error:\n".base64_decode($post['mensaje_error']);

echo "\n\n";

echo "VARIABLES DE SESION:\n";
print_r($this->session->all_userdata());
echo "\n\n";

echo "VARIABLES POST:\n";
print_r(json_decode($post['var_post']));
echo "\n\n";

echo "VARIABLES GET:\n";
print_r(json_decode($post['var_get']));
echo "\n\n";


echo "URL ACTUAL:\n".$post['url_actual'];
echo "\n\n";
echo "FECHA HORA DEL ERROR:\n";

echo date('Y-m-d H:i:s',time());



echo "\n\n";

}


}

/* End of file errores.php */
/* Location: ./application/controllers/errores.php */