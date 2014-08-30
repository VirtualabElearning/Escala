<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publico extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('view_login');
	}



## vista de inicio de sesion
	public function registro()  {

		$this->load->view('publico/view_registro');
	}

## vista de inicio de sesion
	public function ingresar()  {

# si ya esta logeado, redirecciono el sistema
		if ($this->session->userdata('logeado')==1)  { redirect( 'cursos/mis_cursos' );  }
$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));


		$this->load->view('publico/view_ingresar',$data);
	}

	public function facebook()  {
		$this->load->model('model_login');

		try
		{
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled('Facebook'))
			{
				$service = $this->hybridauthlib->authenticate('Facebook');

				if ($service->isUserConnected())
				{
					$datos_perfil = $service->getUserProfile();


					$arr=array('user_social_key',md5($datos_perfil->identifier.'~'.$datos_perfil->firstName.'~'.$datos_perfil->lastName));
					
					$info_usuario = $this->model_login->get_info_usuario('usuarios', $arr );
					/* Si se ha realizado bn el login, debe cargar los datos en sesion y redireccionar a la parte de inicio, consultando la bd partiendo del correo. */

					/* Array de variables de sesion solo si existe datos en la consulta realizada */
					if ($info_usuario)  {
						$data = array(
							'id_usuario'=> $info_usuario->id_usuarios,
							'logeado' 	=> 1,
							'nombres' => $info_usuario->nombres,
							'apellidos' => $info_usuario->apellidos,
							'foto' => $info_usuario->foto,
							'identificacion' => $info_usuario->identificacion,
							'id_tipo_planes' => $info_usuario->id_tipo_planes,
							'correo' 	=> $info_usuario->correo,
							'id_roles' 	=> $info_usuario->id_roles,
							'id_estados' 	=> $info_usuario->id_estados,
							'nombre_rol' 	=> $info_usuario->nombre,
							);




						/* Guardo los datos en la variable sesion */
						$this->session->set_userdata($data);


					}

					/*  No existe el usuario en el sistema, se va a guardar  */
					else {










						$foto_nombre=md5($datos_perfil->identifier.date('Y-m-d H:m:s')).".jpg";
						$content = file_get_contents($datos_perfil->photoURL);
						file_put_contents('uploads/aprendices/'.$foto_nombre, $content);


						$data = array(
							'nombres' => $datos_perfil->firstName ,
							'apellidos' => $datos_perfil->lastName ,
							'profesion' => '',
							'id_tipo_planes' => '1',  
							'foto' => $foto_nombre,
							'correo' => $datos_perfil->email,
							'contrasena' => '',
							'identificacion' => '',
							'resumen_de_perfil' => $datos_perfil->description,
							'user_social_key' => md5($datos_perfil->identifier.'~'.$datos_perfil->firstName.'~'.$datos_perfil->lastName),
							'id_roles' => '3',
							'id_estados' => '1',
							'fecha_creado' => date('Y-m-d H:i:s',time()),
							'fecha_modificado' => date('Y-m-d H:i:s',time()),
							'id_usuario_creado' => '1',
							'id_usuario_modificado' => '1',
							);

						$id='';




						$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$id));


						if ($datos_perfil->email!='') {

						###############################ENVIO MENSAJE DE BIENVENIDA#############################################################

							$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));

							$array_claves=array('{nombres}'=>$datos_perfil->firstName,'{apellidos}'=>$datos_perfil->lastName,'{empresa}'=>$configuracion->nombre_sistema);

							envio_correo($array_claves,$configuracion->correo_contacto,$configuracion->nombre_contacto ,$datos_perfil->email,"Bienvenido al sistema",$datos_perfil->firstName.' '.$datos_perfil->lastName,site_url()."email_templates/plantilla_bienvenido_estudiante_fb.html",$this);

			            ######################################################################################################################

						}


						$arr=array('user_social_key',md5($datos_perfil->identifier.'~'.$datos_perfil->firstName.'~'.$datos_perfil->lastName));

						$info_usuario = $this->model_login->get_info_usuario('usuarios', $arr );
						/* Si se ha realizado bn el login, debe cargar los datos en sesion y redireccionar a la parte de inicio, consultando la bd partiendo del correo. */

						/* Array de variables de sesion solo si existe datos en la consulta realizada */
						if ($info_usuario)  {
							$data = array(
								'id_usuario'=> $info_usuario->id_usuarios,
								'logeado' 	=> 1,
								'nombres' => $info_usuario->nombres,
								'apellidos' => $info_usuario->apellidos,
								'foto' => $info_usuario->foto,
								'identificacion' => $info_usuario->identificacion,
								'id_tipo_planes' => $info_usuario->id_tipo_planes,
								'correo' 	=> $info_usuario->correo,
								'id_roles' 	=> $info_usuario->id_roles,
								'id_estados' 	=> $info_usuario->id_estados,
								'nombre_rol' 	=> $info_usuario->nombre,
								);


							/* Guardo los datos en la variable sesion */
							$this->session->set_userdata($data);
						}






					}



					/* redirecciono a la ventana de inicio o a donde me haya quedado la ultima vez */
					if (!$redirect)  { redirect( 'cursos/mis_cursos' ); }  else { redirect( $redirect ); }



				}
				else // no se pudo autenticar
				{
					echo "error";
					show_error('Cannot authenticate user');
				}
			}
			else // Este servicio no está habilitado
			{
				echo "error";
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



	/*  funcion validar  */
	public function validar(){


		/* aplico reglas en los campos del login (requerido,sin espacios,llamo una funcion extra para validacion en la bd) */
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|trim');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean|trim|callback_estudiante_check');
	#$this->form_validation->set_rules('redirect', 'Error URL', 'xss_clean|trim');
	#$redirect=base64_decode($this->input->post('redirect'));

		if ($this->form_validation->run() == FALSE){
			/* si hubo error lo retorno a la ventana nuevamente con el mensaje de error */
			$this->ingresar();

 #echo validation_errors();

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
				'foto' => $info_usuario->foto,
				'identificacion' => $info_usuario->identificacion,
				'id_tipo_planes' => $info_usuario->id_tipo_planes,
				'correo' 	=> $info_usuario->correo,
				'id_roles' 	=> $info_usuario->id_roles,
				'id_estados' 	=> $info_usuario->id_estados,
				'nombre_rol' 	=> $info_usuario->nombre,
				);


			/* Guardo los datos en variable de sesion */
			$this->session->set_userdata($data);
			/* Redirecciono a la ventana de inicio del sistema de administraciona  */

			if (!$redirect)  { redirect( 'cursos/mis_cursos' ); }  else { redirect( $redirect ); }

		}
	}


	public function estudiante_check(){
		$this->load->model('model_login');
		/* Evaluo en la funcion si existe, si la contrasena es correcta. */
		$result = $this->model_login->check_user( $this->input->post('correo'), sha1($this->input->post('contrasena')),3 );

		switch($result){
			case 'no-existe':
			/* 
			Muestro mensaje de error si el usuario o la contrasena es incorrecta
			 */
			$this->form_validation->set_message('estudiante_check', 'Nombre de usuario o contrase&ntilde;a incorrectos');
			return false;
			break;
			/* 
			El usuario está inactivo, quizas tenga el estado = 0
			 */
			case 'inactivo':
			$this->form_validation->set_message('estudiante_check', 'Este usuario se encuentra inactivo');
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



	/* Funcion cerrar sesion */
	public function salir()
	{
		$this->session->unset_userdata('id_usuario');
		$this->session->sess_destroy();
		redirect('/','refresh');

	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */