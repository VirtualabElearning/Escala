<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */

	var $variables = array();
	public function __construct()
	{
		parent::__construct();
		/* Si no existe login, redirecciono para que entre a iniciar sesion */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
	}


	/* Cargo la pantalla de inicio */
	public function index()
	{


		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}


		$this->load->view('root/view_inicio',$data);
	}
}

