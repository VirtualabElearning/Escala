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
	public function index($funcion=null,$mensaje=null)
	
	{
		$mensaje_p='';
		$mensaje_ok='';
		## error en el form
		if ($funcion=='formv') {
			$mensaje_p=base64_decode($mensaje);	
		}

		if ($funcion=='frmok') {
			$mensaje_ok=base64_decode($mensaje);	
		}


		$data['mensaje_p']=$mensaje_p;
		$data['mensaje_ok']=$mensaje_ok;


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
			$id_usuarios=$this->session->userdata('id_usuario');	
 			## consulto los mensajes del docente
			$mensajes_lista=$this->model_inicio->get_mensajes_docente($this->session->userdata('id_usuario'));
			$data['mensajes_count']=count($mensajes_lista);
			$data['mensajes']=$mensajes_lista;







			$miscursos_doc=$this->model_inicio->cursos_list_doc($id_usuarios);
			$data['mis_cursos']=$miscursos_doc;
			$this->load->view('root/view_inicio_docente',$data);
		}

		else {
			$this->load->view('root/view_inicio',$data);	
		}







	}
}

