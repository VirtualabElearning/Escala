<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Controlador de la aplicacion */
class Publico extends CI_Controller {

	/* variable para cargar los datos globales del modulo */
	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		/* Verifica si tiene login de usuario, si no, lo redirecciona a iniciar sesion. */
		#if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'contenidos','id'=>'id_contenidos','modelo'=>'model_contenidos');
	}

	public function index()
	{
		
		$this->informacion();
	}

	
	public function informacion($id_contenidos,$url)
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		
		$data['contenido']=$this->model_generico->detalle('contenidos',array('id_contenidos'=>$id_contenidos));

		if ($data['contenido']->url_personalizado!='') {  header('Location: '.$data['contenido']->url_personalizado); exit; }
		
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$this->load->view('publico/view_'.$variables['modulo'].'_informacion',$data);
	}


	public function contacto ($ok=null) {
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));

		if ($ok) { $data['ok']=$ok; }
##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$this->load->view('publico/view_'.$variables['modulo'].'_contacto',$data);
	}



	public function validar_contacto () {

		$this->form_validation->set_rules('nombres_completos', 'Nombres completos', 'required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'required|min_length[5]|valid_email|xss_clean');
		$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|min_length[5]|xss_clean');

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		
##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		if($this->form_validation->run() == FALSE)
		{ 
			$this->contacto ();

		}

		else {
			## envio correo electronico
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$array_claves=array('{nombres_completos}'=>$this->input->post('nombres_completos'),'{mensaje}'=>$this->input->post('mensaje'),'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$datos_perfil->email,'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'.$foto_nombre,'{correo_confirmar}'=>base64_encode($datos_perfil->email."|fb"));
			#envio el mensaje al administrador
			envio_correo($array_claves,$this->input->post('correo'),$this->input->post('nombres_completos'),$configuracion->correo_contacto,"Nuevo mensaje de contacto en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_contacto.html",$this);
			$this->contacto ("enviado");
		}




	}


##vista para mostrar los premios de la caja sorpresa
	public function mipremio ($texto,$imagen) {
		$data['mensaje']=base64_decode($texto);
		$data['imagen']=base64_decode($imagen);
		$this->load->view('publico/view_mipremio',$data);
	}


}