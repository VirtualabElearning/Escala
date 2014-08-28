<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Pruebas extends CI_Controller {

	public function index()
	{
		echo "ok";
	}


public function pdf () {



$data='';
$this->load->view('prueba_certificado',$data);

}


}

/* End of file errores.php */
/* Location: ./application/controllers/errores.php */