<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/**
	 Archivo de login para los adminsitradores del sistema
	 Donde se ejecuta la accion de recibir la informacion como
	 correo y contraseña, valida con la base de datos y luego redirecciona a la 
	 pantalla de inicio del adminsitrador.
	 **/


	 public function __construct()
	 {
	 	parent::__construct();
		//$this->load->database();
	 }


	/** 
	Funcion principal del programa 
	**/
	public function index($url_redirect=null)
	{

		if ($this->session->userdata('id_usuario'))  {   redirect( 'inicio/root' );  }

		$this->iniciar_sesion($url_redirect);
	}

	/** 
	funcion de iniciar sesion, valido token generico y aleatorio y lanzo la vista login 
	**/
	public function iniciar_sesion($url_redirect=null){
		$data['token'] = $this->token();
		$data['redirect']=$url_redirect;
		$this->load->view('root/view_login',$data );
	}

	/**  
	funcion validar  
	**/
	public function validar(){
		/** 
		 aplico reglas en los campos del login (requerido,sin espacios,llamo una funcion extra para validacion en la bd) 
		 **/
		 $this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|trim');
		 $this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean|trim|callback_username_check');
		 $this->form_validation->set_rules('redirect', 'Error URL', 'xss_clean|trim');
		 $redirect=base64_decode($this->input->post('redirect'));

		 if ($this->form_validation->run() == FALSE){
			/** 
			si hubo error lo retorno a la ventana nuevamente con el mensaje de error 
			**/
			$this->iniciar_sesion();
		} else {
			$arr=array('correo',$this->input->post('correo'));
			$this->load->model('model_login');
			/** 
			cargo datos iniciales de usuario para guardarlos en variables de sesion 
			**/
			$info_usuario = $this->model_login->get_info_usuario('usuarios', $arr );


			/** 
			array de los datos en sesion 
			**/
			$data = array(
				'id_usuario'=> $info_usuario->id_usuarios,
				'logeado' 	=> 1,
				'nombres' => $info_usuario->nombres,
				'apellidos' => $info_usuario->apellidos,
				'correo' 	=> $info_usuario->correo,
				'id_roles' 	=> $info_usuario->id_roles,
				'id_estados' 	=> $info_usuario->id_estados,
				'nombre_rol' 	=> $info_usuario->nombre,
				);

			/** 
			Guardo los datos en variable de sesion  
			**/
			$this->session->set_userdata($data);
			/** 
			Redirecciono a la ventana de inicio del sistema de administraciona 
			**/

			if (!$redirect)  { redirect( 'inicio/root' ); }  else { redirect( $redirect ); }
			


		}
	}


	public function username_check(){
		$this->load->model('model_login');
		/**
		Evaluo en la funcion si existe, si la contrasena es correcta.
		**/

		
		$result = $this->model_login->check_user( $this->input->post('correo'), sha1($this->input->post('contrasena')) );

		switch($result){
			case 'no-existe':
			/** 
			Muestro mensaje de error si el usuario o la contrasena es incorrecta
			 **/
			$this->form_validation->set_message('username_check', 'Nombre de usuario o contraseña incorrectos');
			return false;
			break;
			/** 
			El usuario está inactivo, quizas tenga el estado = 0
			 **/
			case 'inactivo':
			$this->form_validation->set_message('username_check', 'Este usuario se encuentra inactivo');
			return false;
			break;
			/**
			Retorno verdadero si el usuario existe para continuar con el logeo
			**/
			case 'activo':
			return true;
			break;
		}

	}

/**
Funcion que genera un dato aleatorio de seguridad basica en formulario de login
**/
public function token()
{
	$token = md5(uniqid(rand(),true));
	$this->session->set_userdata('token',$token);
	return $token;
}



public function salir()
{
	$this->session->unset_userdata('id_usuario');
	$this->session->sess_destroy();
	redirect('login/root','refresh');

}



public function perfil($id_usuarios)
{

$this->load->model('model_login');

$data['perfil'] = $this->model_login->detalle('usuarios',array('id_usuarios',$id_usuarios));


$data['titulo']="perfil";
$this->load->view('root/view_perfil',$data );

}





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */