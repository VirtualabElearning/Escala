<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */

	var $variables = array();
	public function __construct()
	{
		parent::__construct();
		/* Si no existe login, redirecciono para que entre a iniciar sesion */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 	
	}


	/* Cargo la pantalla de inicio */
	public function index()
	{
		$variables = $this->variables; 
		$data['diccionario']=$this->variables['diccionario'];
		$this->load->model('model_inicio');
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}


       #krumo($this->session->all_userdata());


		### docente
		if ($this->session->userdata('id_roles')==2) {
			
 			## consulto los mensajes del docente
			$mensajes_lista=$this->model_inicio->get_mensajes_docente($this->session->userdata('id_usuario'));
			$data['mensajes_count']=count($mensajes_lista);
			$data['mensajes']=$mensajes_lista;

			$this->load->view('root/view_inicio_docente',$data);
		}

		else {
			$this->load->view('root/view_inicio',$data);	
		}







	}
}

