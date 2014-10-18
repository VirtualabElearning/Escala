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
		$this->variables=array('modulo'=>'landings','id'=>'id_landings','modelo'=>'model_landings');
	}

	public function index()
	{
		
		$this->informacion();
	}

	
	public function informacion($id_contenidos,$url,$msg=null)
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		
		$data['contenido']=$this->model_generico->detalle('landings',array('id_landings'=>$id_contenidos));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		if ($msg) {	 $data['msg']=$msg;   }
		$this->load->view('publico/view_'.$variables['modulo'].'_informacion',$data);
	}


	public function check_email () {


		$this->load->model('model_landings');

		$result = $this->model_landings->check_email( $this->input->post ('correo') );

		switch($result){
			case 'existe':

			$this->form_validation->set_message('check_email', 'El correo '.$this->input->post('correo').' ya existe en el sistema, intente con otro.');
			return false;
			break;
			
			case 'aceptable':
			return true;
			break;
		}



	}


	public function validar_landings () {

		$this->form_validation->set_rules('nombres', 'Nombres', 'required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'required|min_length[5]|valid_email|xss_clean|callback_check_email');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required|min_length[7]|numeric|xss_clean');

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		

		if($this->form_validation->run() == FALSE)
		{ 
			$this->informacion ($this->input->post('id_contenidos'),$this->uri->segment(4));
		}

		else {
			## envio correo electronico
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$array_claves=array('{telefono}'=>$this->input->post('telefono'),'{correo}'=>$this->input->post('correo'),'{nombres_completos}'=>$this->input->post('nombres')." ".$this->input->post('apellidos'),'{empresa}'=>$configuracion->nombre_sistema,'{base_url}'=>$configuracion->base_url);
			#envio el mensaje al administrador
			envio_correo($array_claves,$this->input->post('correo'),$this->input->post('nombres')." ".$this->input->post('apellidos'),$configuracion->correo_contacto,"Nuevo mensaje de contacto desde landing en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_contacto_landing.html",$this);
			

			#guardo la informacion en la base de datos 
			$data_guardar['nombres']=$this->input->post('nombres'); 
			$data_guardar['apellidos']=$this->input->post('apellidos'); 
			$data_guardar['telefono']=$this->input->post('telefono'); 
			$data_guardar['correo']=$this->input->post('correo'); 
			$data_guardar['recibir_ofertas']=$this->input->post('recibir_ofertas'); 
			$data_guardar['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_guardar['id_usuario_modificado']=1; 
			$data_guardar['fecha_creado']=date('Y-m-d H:i:s',time());
			$data_guardar['id_usuario_creado']=1;  
			$data_guardar['id_estados']=1;   
			$data_guardar['id_landings']=$this->input->post('id_contenidos');   

			$id=$this->model_generico->guardar('landings_usuarios',$data_guardar,'id_landings_usuarios',array('id_landings_usuarios',''));


			$this->informacion ($this->input->post('id_contenidos'),$this->input->post('url'),"Tu mensaje ha sido enviado satisfactoriamente");

		}




	}




}