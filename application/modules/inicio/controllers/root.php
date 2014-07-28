<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {



	/**
	Controlador de la aplicacion
	 **/


	var $variables = array();


	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
/**
Configuracion generica del modulo
**/
$this->variables=array('modulo'=>'noticias','id'=>'id_noticias','modelo'=>'model_noticias');

}




	public function index()
	{

		$this->load->view('root/view_inicio');
	}
}

