<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/*
	 Archivo de login para los Administradores del sistema
	 Donde se ejecuta la accion de recibir la informacion como
	 correo y contraseña, valida con la base de datos y luego redirecciona a la 
	 pantalla de inicio del Administrador.
	 */

	 public function __construct()
	 {
	 	parent::__construct();

	 	#if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/' );  }
	 	$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
	 	$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  



	 	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 

	 }

	 /*  Funcion principal del programa  */
	 public function index($url_redirect=null)
	 {




	 	if ($this->session->userdata('id_usuario'))  {   redirect( 'inicio/root' );  }

	 	$this->iniciar_sesion($url_redirect,'','');
	 }

	 /* funcion de iniciar sesion, valido token generico y aleatorio y lanzo la vista login  */

	 public function iniciar_sesion($url_redirect=null,$red_social=null,$mensaje_error=null){
	 	if ($this->session->userdata('id_usuario'))  {   redirect( base64_decode($this->uri->segment(4)) );  }
	 	$data['token'] = $this->token();
	 	$data['redirect']=$url_redirect;

	 	if ($url_redirect=='Facebook' || $url_redirect=='Twitter')  { $red_social=$url_redirect;  unset($url_redirect); }

	 	if (!$red_social)  {
	 		if ($mensaje_error)   { $data['error_extra']=$mensaje_error;   }
	 		$this->load->view('root/view_login',$data );
	 	}
	 	else{

	 		try
	 		{
	 			$this->load->library('HybridAuthLib');

	 			if ($this->hybridauthlib->providerEnabled($red_social))
	 			{
	 				$service = $this->hybridauthlib->authenticate($red_social);

	 				if ($service->isUserConnected())
	 				{
	 					$datos_perfil = $service->getUserProfile();

	 					/* si no hubo correo, no existe o no tiene... */
	 					if (!$datos_perfil->email)  {
	 						$this->session->unset_userdata('id_usuario');
	 						$this->session->sess_destroy();
	 						redirect( 'login/root/validar/'.base64_encode('Hubo un error con '.$red_social.', intenta con otra.') ); 
	 					}

	 					$arr=array('correo',$datos_perfil->email);
	 					$this->load->model('model_login');
	 					$info_usuario = $this->model_login->get_info_usuario('usuarios', $arr );
	 					/* Si se ha realizado bn el login, debe cargar los datos en sesion y redireccionar a la parte de inicio, consultando la bd partiendo del correo. */

	 					/* Array de variables de sesion solo si existe datos en la consulta realizada */
	 					if ($info_usuario)  {
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

	 						/* Guardo los datos en la variable sesion */
	 						$this->session->set_userdata($data);


	 					}
	 					/* redirecciono a la ventana de inicio o a donde me haya quedado la ultima vez */
	 					if (!$redirect)  { redirect( 'inicio/root' ); }  else { redirect( $redirect ); }



	 				}
				else // no se pudo autenticar
				{
					show_error('Cannot authenticate user');
				}
			}
			else // Este servicio no está habilitado
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
				case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			#log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}


	}
}

/*  funcion validar  */
public function validar($mensaje_error=null){
	/* aplico reglas en los campos del login (requerido,sin espacios,llamo una funcion extra para validacion en la bd) */
	$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|trim');
	$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean|trim|callback_username_check');
	$this->form_validation->set_rules('redirect', 'Error URL', 'xss_clean|trim');
	$redirect=base64_decode($this->input->post('redirect'));

	if ($this->form_validation->run() == FALSE){
		/* si hubo error lo retorno a la ventana nuevamente con el mensaje de error */
		$this->iniciar_sesion('','',$mensaje_error);
	} else {
		$arr=array('correo',$this->input->post('correo'));
		$this->load->model('model_login');
		/* cargo datos iniciales de usuario para guardarlos en variables de sesion */
		$info_usuario = $this->model_login->get_info_usuario('usuarios', $arr );


		/* array de los datos en sesion */
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

		/* Guardo los datos en variable de sesion */
		$this->session->set_userdata($data);
		/* Redirecciono a la ventana de inicio del sistema de administraciona  */

		if (!$redirect)  { redirect( 'inicio/root' ); }  else { redirect( $redirect ); }

	}
}



public function username_check(){
	$this->load->model('model_login');
	/* Evaluo en la funcion si existe, si la contrasena es correcta. */


	$result = $this->model_login->check_user( $this->input->post('correo'), sha1($this->input->post('contrasena')) );

	switch($result){
		case 'no-existe':
			/* 
			Muestro mensaje de error si el usuario o la contrasena es incorrecta
			 */
			$this->form_validation->set_message('username_check', 'Nombre de usuario o contraseña incorrectos');
			return false;
			break;
			/* 
			El usuario está inactivo, quizas tenga el estado = 0
			 */
			case 'inactivo':
			$this->form_validation->set_message('username_check', 'Este usuario se encuentra inactivo');
			return false;
			break;
			/*
			Retorno verdadero si el usuario existe para continuar con el logeo
			*/
			case 'activo':
			return true;
			break;
		}

	}

/*
Funcion que genera un dato aleatorio de seguridad basica en formulario de login
*/
public function token()
{
	$token = md5(uniqid(rand(),true));
	$this->session->set_userdata('token',$token);
	return $token;
}

/* Funcion cerrar sesion */
public function salir()
{
	$this->session->unset_userdata('id_usuario');
	$this->session->sess_destroy();
	redirect('login/root','refresh');

}

/* funcion ver perfil */
public function perfil($id_usuarios)
{

	$this->load->model('model_login');


	$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
	$data['titulo']=$variables['modulo'];


	$data['menus']=$this->model_generico->menus_root_categorias();
	foreach ($data['menus'] as $key => $value) {
		$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

	}
	
	$data['perfil'] = $this->model_login->detalle('usuarios',array('id_usuarios',$id_usuarios));
	$data['titulo']="perfil";
	$this->load->view('root/view_perfil',$data );

}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */