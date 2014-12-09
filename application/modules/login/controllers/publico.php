<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);

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

##vista de suscripcion y saber que plan tengo
	public function suscripcion()  {


		if ($this->session->userdata('logeado')!=1) {  redirect('ingresar');  }

		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));
		

		$data['mis_cursos_suscripcion']=$this->model_generico->mis_cursos_suscripcion($this->encrypt->decode($this->session->userdata('id_usuario')));


	##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));

		$data['inbox']=$this->model_generico->listado('mensajes',array('mensajes.id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))),array('orden','asc'));



		$this->load->view('publico/view_suscripcion',$data);
	}




## vista de elegir plan para registro
	public function registro()  {
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));
		$this->load->view('publico/view_registro',$data);
	}


## carga la vista de registro del usuario
	public function registro_usuario($msg=null)  {
		$data=array();
		if ($msg!='')  {
			$data['mensaje']=$msg;
		}


		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));
		
		$this->load->view('publico/view_registro_usuario',$data);
	}

##funcion que lista las ciudades de Colombia
	public function ciudades() {
		$nombre=$this->input->get('term');

		$tmpciudades=$this->model_generico->get_ciudades($nombre);
		$arr_ciudades=array();
		foreach ($tmpciudades as $key => $value) {
			$arr_ciudades[]=$value->nombre;
		}

		echo json_encode($arr_ciudades);

	}



## valida el sistema de registro de usuario
	public function registro_usuario_validar () {

		#if ($this->input->post ('userfile')) { $this->session->set_userdata('foto_subida', $this->input->post ('userfile')); }

		/*configuracion basica para subir una foto*/
/*
		$config['upload_path']   =   "uploads/aprendices/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['file_name']  = md5($this->input->post ('correo')."~".date('Y-m-d'));
		$this->load->library('upload',$config);
*/
		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
	#	$this->form_validation->set_rules('identificacion', 'Identificacion', 'required|xss_clean|callback_check_identificacion');
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|callback_check_email');
	#	$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|xss_clean');
		$this->form_validation->set_rules('contrasena1', 'Contraseña', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contrasena2', 'Confirmar contraseña', 'trim|required|xss_clean|callback_check_pass_iguales['.$this->input->post('contrasena1').']');
	#	$this->form_validation->set_rules('userfile', 'Foto', 'callback_check_foto');

		$data = array(
			'nombres' => $this->input->post ('nombres'),
			'apellidos' => $this->input->post ('apellidos'),
			'correo' => $this->input->post ('correo'),
			/*	'identificacion' => $this->input->post ('identificacion'),  */
			/*	'ciudad' => $this->input->post ('ciudad'), */
			'id_tipo_planes' => 1,  /* plan gratis */
			'id_roles' => 3,    /* rol estudiante */
			'contrasena' => sha1($this->input->post ('contrasena1')),    
			'id_estatus' => 5, /* estatus nuevo */
			'id_estados' => 0, /* estado inactivo */
			);


		

		if($this->form_validation->run() == FALSE)
		{ 

## valido si cuando sale error valido la foto y borra la duplicada
/*			if ($this->input->post ('foto_subida')!=$this->input->post ('userfile'))  {
				if ($this->input->post ('foto_subida')!=''  && $this->input->post ('userfile')=='' )  {
					$data['foto'] = $foto_subida;
				} else {
					$data['foto'] = $this->input->post ('userfile');
					#@unlink('uploads/aprendices/'.$this->session->userdata('foto_subida'));
				}

			}
*/



			$this->registro_usuario();

		} 


		else {

			if ($this->input->post ('foto_subida')!=$this->input->post ('userfile'))  {
				if ($this->input->post ('foto_subida')!=''  && $this->input->post ('userfile')=='' )  {
					$data['foto'] = $foto_subida;
				} else {
					$data['foto'] = $this->input->post ('userfile');
					@unlink('uploads/aprendices/'.$foto_subida);
					
				}

			}



			$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data['id_usuario_modificado']=1;  
			$data['fecha_creado']=date('Y-m-d H:i:s',time());
			$data['id_usuario_creado']=1;   


			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',''));


			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$array_claves=array('{nombres}'=>$this->input->post ('nombres'),'{apellidos}'=>$this->input->post ('apellidos'),'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$this->input->post ('correo'),'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'. $data['foto'],'{ciudad}'=>$this->input->post ('ciudad'),'{identificacion}'=>$this->input->post ('identificacion'),'{correo_confirmar}'=>base64_encode($this->input->post ('correo')."|fr")  );
		#notifico al usuario de su nuevo registro en la web
			envio_correo($array_claves,$configuracion->correo_contacto,$configuracion->nombre_contacto ,$this->input->post ('correo'),"Bienvenido al sistema de ".$configuracion->nombre_sistema,$this->input->post ('nombres').' '.$this->input->post ('apellidos'),site_url()."email_templates/plantilla_bienvenido_estudiante_registro.html",$this);
		#notifico al administrador del nuevo registro de usuario
			envio_correo($array_claves,$this->input->post ('correo'),$this->input->post ('nombres').' '.$this->input->post ('apellidos') ,$configuracion->correo_contacto,"Nuevo registro por formulario en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_plantilla_bienvenido_estudiante_registro.html",$this);






			$this->session->unset_userdata('foto_subida');

			
			$this->registro_usuario("Solo te queda un &uacute;ltimo paso, te hemos enviado a <b>".$this->input->post ('correo')."</b> un mensaje para <b>verificar tu cuenta</b>, revisa en tu bandeja de entrada o en la secci&oacute;n de SPAM.");

			
#krumo($this->session->all_userdata()); 
		}






	}






## vista de inicio de sesion
	public function ingresar()  {

# si ya esta logeado, redirecciono el sistema
		if ($this->session->userdata('logeado')==1)  { redirect( 'cursos/mis_cursos' );  }
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$this->load->view('publico/view_ingresar',$data);
	}

	public function facebook($redirect=null)  {

		if ($redirect)  {  $redirect=base64_decode($redirect);  }
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

					#$arr=array('user_social_key',md5($datos_perfil->firstName.'~'.$datos_perfil->lastName.'~'.$datos_perfil->email));
					$arr=array('correo',$datos_perfil->email);

					$info_usuario = $this->model_login->get_info_usuario_estudiante('usuarios', $arr );

					/* Si se ha realizado bn el login, debe cargar los datos en sesion y redireccionar a la parte de inicio, consultando la bd partiendo del correo. */

					/* Array de variables de sesion solo si existe datos en la consulta realizada */
					if ($info_usuario)  {
						## verifico si debe actualiza clave o no.
						$if_update=0;
						if ($info_usuario->contrasena=='')  {  $if_update=1; }
						$data = array(
							'id_usuario'=> $this->encrypt->encode($info_usuario->id_usuarios),
							'logeado' 	=> 1,
							'nombres' => $this->encrypt->encode($info_usuario->nombres),
							'apellidos' => $this->encrypt->encode($info_usuario->apellidos),
							'foto' => $this->encrypt->encode($info_usuario->foto),
							'identificacion' => $this->encrypt->encode($info_usuario->identificacion), 
							'id_tipo_planes' => $this->encrypt->encode($info_usuario->id_tipo_planes),
							'correo' 	=> $this->encrypt->encode($info_usuario->correo),
							'id_roles' 	=> $this->encrypt->encode($info_usuario->id_roles),
							'id_estados' 	=> $this->encrypt->encode($info_usuario->id_estados),
							'nombre_rol' 	=> $this->encrypt->encode($info_usuario->nombre),
							'id_estatus' 	=> $this->encrypt->encode($info_usuario->id_estatus),
							'nombre_estatus' 	=> $this->encrypt->encode($info_usuario->nombre_estatus),
							'cursos_asignados' 	=> $this->encrypt->encode($info_usuario->id_cursos_asignados),
							'if_update' 	=> $if_update,
							);

/* Guardo los datos en la variable sesion */
$this->session->set_userdata($data);


}

/*  No existe el usuario en el sistema, se va a guardar  */
else {


	$foto_nombre=md5($datos_perfil->firstName.'~'.$datos_perfil->lastName.'~'.$datos_perfil->email).".jpg";
	
	save_image($datos_perfil->photoURL,'uploads/aprendices/'.$foto_nombre);



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
		'user_social_key' => md5($datos_perfil->firstName.'~'.$datos_perfil->lastName.'~'.$datos_perfil->email),
		'id_roles' => '3',
		'id_estados' => '0',
		'fecha_creado' => date('Y-m-d H:i:s',time()),
		'fecha_modificado' => date('Y-m-d H:i:s',time()),
		'id_usuario_creado' => '1',
		'id_usuario_modificado' => '1',
		);

	$id='';



	$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$id));


	if ($datos_perfil->email!='') {

						###############################ENVIO MENSAJE DE BIENVENIDA Y NOTIFICACION AL ADMINISTRADOR#############################################################

		$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));

		$array_claves=array('{nombres}'=>$datos_perfil->firstName,'{apellidos}'=>$datos_perfil->lastName,'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$datos_perfil->email,'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'.$foto_nombre,'{correo_confirmar}'=>base64_encode($datos_perfil->email."|fb"));

		#notifico al usuario de su nuevo registro en la web
		envio_correo($array_claves,$configuracion->correo_contacto,$configuracion->nombre_contacto ,$datos_perfil->email,"Bienvenido al sistema de ".$configuracion->nombre_sistema,$datos_perfil->firstName.' '.$datos_perfil->lastName,site_url()."email_templates/plantilla_bienvenido_estudiante_fb.html",$this);

		#notifico al administrador del nuevo registro de usuario
		envio_correo($array_claves,$datos_perfil->email,$datos_perfil->firstName.' '.$datos_perfil->lastName ,$configuracion->correo_contacto,"Nuevo registro por Facebook en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_plantilla_bienvenido_estudiante_fb.html",$this);



			            ######################################################################################################################

	}


	$arr=array('user_social_key', md5($datos_perfil->firstName.'~'.$datos_perfil->lastName.'~'.$datos_perfil->email));

	$info_usuario = $this->model_login->get_info_usuario_estudiante('usuarios', $arr );

	/* Si se ha realizado bn el login, debe cargar los datos en sesion y redireccionar a la parte de inicio, consultando la bd partiendo del correo. */

	/* Array de variables de sesion solo si existe datos en la consulta realizada */
	if ($info_usuario)  {
		## verifico si debe actualiza clave o no.
		$if_update=0;
		if ($info_usuario->contrasena=='')  {  $if_update=1; }



		$data = array(
			'id_usuario'=> $this->encrypt->encode($info_usuario->id_usuarios),
			'logeado' 	=>  1,
			'nombres' => $this->encrypt->encode($info_usuario->nombres),
			'apellidos' => $this->encrypt->encode($info_usuario->apellidos),
			'foto' => $this->encrypt->encode($info_usuario->foto),
			'identificacion' => $this->encrypt->encode($info_usuario->identificacion),
			'id_tipo_planes' => $this->encrypt->encode($info_usuario->id_tipo_planes),
			'correo' 	=> $this->encrypt->encode($info_usuario->correo),
			'id_roles' 	=> $this->encrypt->encode($info_usuario->id_roles),
			'id_estados' 	=> $this->encrypt->encode($info_usuario->id_estados),
			'nombre_rol' 	=> $this->encrypt->encode($info_usuario->nombre),
			'id_estatus' 	=> $this->encrypt->encode($info_usuario->id_estatus),
			'nombre_estatus' 	=> $this->encrypt->encode($info_usuario->nombre_estatus),
			'cursos_asignados' 	=> $this->encrypt->encode($info_usuario->id_cursos_asignados),
			'if_update' 	=> $if_update,
			);





		/* Guardo los datos en la variable sesion */
		$this->session->set_userdata($data);
	}






}



/* redirecciono a la ventana de inicio o a donde me haya quedado la ultima vez */
if (!$redirect)  { redirect( 'cursos' ); }  else { redirect( $redirect ); }



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

			echo "PAAAILA"; exit;
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				redirect( "ingresar" );
				if (isset($service))
				{
					#log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				echo "paila1";
				#show_error('User has cancelled the authentication or the provider refused the connection.');
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
			echo "paila2";
			#show_error('Error authenticating user.');
			redirect( "ingresar" );
		}






	}



	/*  funcion validar  */
	public function validar(){


		/* aplico reglas en los campos del login (requerido,sin espacios,llamo una funcion extra para validacion en la bd) */
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|trim');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean|trim|callback_estudiante_check');
	#$this->form_validation->set_rules('redirect', 'Error URL', 'xss_clean|trim');
		$redirect=base64_decode($this->input->post('redirect'));

		if ($this->form_validation->run() == FALSE){
			/* si hubo error lo retorno a la ventana nuevamente con el mensaje de error */
			$this->ingresar();

 #echo validation_errors();

		} else {
			$arr=array('correo',$this->input->post('correo'));
			$this->load->model('model_login');
			/* cargo datos iniciales de usuario para guardarlos en variables de sesion */
			$info_usuario = $this->model_login->get_info_usuario_estudiante('usuarios', $arr );


			/* Array de variables de sesion solo si existe datos en la consulta realizada */
			if ($info_usuario)  {
					## verifico si debe actualiza clave o no.
				$if_update=0;
				if ($info_usuario->contrasena=='')  {  $if_update=1; }
				$data = array(
					'id_usuario'=> $this->encrypt->encode($info_usuario->id_usuarios),
					'logeado' 	=>  1,
					'nombres' => $this->encrypt->encode($info_usuario->nombres),
					'apellidos' => $this->encrypt->encode($info_usuario->apellidos),
					'foto' => $this->encrypt->encode($info_usuario->foto),
					'identificacion' => $this->encrypt->encode($info_usuario->identificacion),
					'id_tipo_planes' => $this->encrypt->encode($info_usuario->id_tipo_planes),
					'correo' 	=> $this->encrypt->encode($info_usuario->correo),
					'id_roles' 	=> $this->encrypt->encode($info_usuario->id_roles),
					'id_estados' 	=> $this->encrypt->encode($info_usuario->id_estados),
					'nombre_rol' 	=> $this->encrypt->encode($info_usuario->nombre),
					'id_estatus' 	=> $this->encrypt->encode($info_usuario->id_estatus),
					'nombre_estatus' 	=> $this->encrypt->encode($info_usuario->nombre_estatus),
					'cursos_asignados' 	=> $this->encrypt->encode($info_usuario->id_cursos_asignados),
					'if_update' 	=> $if_update,
					);

/* Guardo los datos en la variable sesion */
$this->session->set_userdata($data);
}


/* Redirecciono a la ventana de inicio del sistema de administraciona  */

if (!$redirect)  { redirect( '/' ); }  else { redirect( $redirect ); }

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



	public function editar_perfil($msg=null)  {

		$data['mi_perfil']=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$this->encrypt->decode($this->session->userdata('id_usuario'))));
		
		if ($msg) {
			$data['mensaje']=$msg;
		}


######################################### lineas de programacion debe estar en todas ####################################
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
######################################### lineas de programacion debe estar en todas ####################################


####################### consulto si puedo editar mi perfil (Solo lo permite una sola vez) ###############################
		




		$this->load->view('publico/view_editar_perfil',$data);
	}




	public function check_foto()
	{
		if ($_FILES['userfile']['tmp_name'])  {
			if ($this->upload->do_upload('userfile'))
			{
				$upload_data    = $this->upload->data();
				$_POST['userfile'] = $upload_data['file_name'];
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				echo $this->upload->display_errors();
				return false;
			}
		}

	}



## checkeo si el correo ya existe.
	public function check_email () {


		$this->load->model('model_login');
		/* Evaluo en la funcion si existe, si la contrasena es correcta. */
		$result = $this->model_login->check_email( $this->input->post ('correo') );

		switch($result){
			case 'existe':
			/* 
			Muestro mensaje de error si el existe.
			 */
			$this->form_validation->set_message('check_email', 'El correo '.$this->input->post('correo').' ya existe en el sistema, intente con otro.');
			return false;
			break;
			
			/*
			Retorno verdadero si la identificacion no existe
			*/
			case 'aceptable':
			return true;
			break;
		}

	}



## checkeo si la identificacion ya existe.
	public function check_identificacion () {

		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));

		$this->load->model('model_login');
		/* Evaluo en la funcion si existe, si la contrasena es correcta. */
		$result = $this->model_login->check_user_identificacion( $this->input->post ('identificacion'),$id_usuarios );

		switch($result){
			case 'existe':
			/* 
			Muestro mensaje de error si la identicacion existe.
			 */
			$this->form_validation->set_message('check_identificacion', 'La identificacion '.$this->input->post('identificacion').' ya existe en el sistema, intente con otra.');
			return false;
			break;
			
			/*
			Retorno verdadero si la identificacion no existe
			*/
			case 'aceptable':
			return true;
			break;
		}



	}

	public function  actualizar_perfil($if_fb=null){

		$this->load->model('model_login');
		/*configuracion basica para subir una foto*/
		$config['upload_path']   =   "uploads/aprendices/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);

		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');

		if ($if_fb) {
			$this->form_validation->set_rules('identificacion', 'Identificación', 'required|xss_clean|callback_check_identificacion');
			#$this->form_validation->set_rules('identificacion', 'Identificación', 'required|xss_clean');
		}

		else {
			#$this->form_validation->set_rules('identificacion', 'Identificación', 'required|xss_clean');
			$this->form_validation->set_rules('identificacion', 'Identificación', 'required|xss_clean|callback_check_identificacion');
		}

		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|xss_clean');
		$this->form_validation->set_rules('userfile', 'Foto', 'callback_check_foto');

		if($this->form_validation->run() == FALSE)
		{ 
			$this->editar_perfil($if_fb);
		} 


		else {
			$data = array(
				'nombres' => $this->input->post ('nombres'),
				'apellidos' => $this->input->post ('apellidos'),
				'correo' => $this->input->post ('correo'),
				'identificacion' => $this->input->post ('identificacion'),
				'ciudad' => $this->input->post ('ciudad'),
				'cambiar_info' => 1,
				);

			if ($this->input->post ('foto_antes')!=$this->input->post ('userfile'))  {
				if ($this->input->post ('foto_antes')!=''  && $this->input->post ('userfile')=='' )  {
				} else {
					$data['foto'] = $this->input->post ('userfile');
					@unlink($this->input->post ('foto_antes'));
					$this->session->set_userdata('foto', $this->encrypt->encode($this->input->post ('userfile')));
				}

			}

			else {    }

				$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))   ));
			
			##despues de actualizar, actualizo los datos de session actual del usuario
			$arr=array('id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario')));
			
			/* cargo datos iniciales de usuario para guardarlos en variables de sesion */
			$info_usuario = $this->model_login->get_info_usuario_estudiante('usuarios', $arr );

			$data = array(
				'id_usuario'=> $this->encrypt->encode($info_usuario->id_usuarios),
				'logeado' 	=>  1,
				'nombres' => $this->encrypt->encode($info_usuario->nombres),
				'apellidos' => $this->encrypt->encode($info_usuario->apellidos),
				'foto' => $this->encrypt->encode($info_usuario->foto),
				'identificacion' => $this->encrypt->encode($info_usuario->identificacion),
				'id_tipo_planes' => $this->encrypt->encode($info_usuario->id_tipo_planes),
				'correo' 	=> $this->encrypt->encode($info_usuario->correo),
				'id_roles' 	=> $this->encrypt->encode($info_usuario->id_roles),
				'id_estados' 	=> $this->encrypt->encode($info_usuario->id_estados),
				'nombre_rol' 	=> $this->encrypt->encode($info_usuario->nombre),
				'id_estatus' 	=> $this->encrypt->encode($info_usuario->id_estatus),
				'nombre_estatus' 	=> $this->encrypt->encode($info_usuario->nombre_estatus),
				'cursos_asignados' 	=> $this->encrypt->encode($info_usuario->id_cursos_asignados),
				'if_update' 	=> $if_update,
				);

			/* Guardo los datos en la variable sesion */
			$this->session->set_userdata($data);

			$this->editar_perfil("¡Actualizado correctamente!");

			

		}






	}





## checkeo si el correo ya existe.
	public function check_email_if_existe () {
		$this->load->model('model_login');
		/* Evaluo en la funcion si existe, si la contrasena es correcta. */
		$result = $this->model_login->check_email_estudiante( $this->input->post ('correo') );
		switch($result){
			case 'existe':
			/* 
			Retorno verdadero
			 */
			return true;
			break;
			/*
			Retorno aceptable si no existe (re-utilizacion de funcion)
			*/

			case 'aceptable':
			$this->form_validation->set_message('check_email_if_existe', 'El correo '.$this->input->post('correo').' no existe en el sistema, intente con otro.');
			return false;
			break;
		}
	}


	public function olvide_contrasena ($msg=null) {
		$data=array();
		if ($msg) {  $data['mensaje']=$msg;  }
		
		######################################### lineas de programacion debe estar en todas ####################################
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
######################################### lineas de programacion debe estar en todas ####################################

		$this->load->view('publico/view_olvide_contrasena',$data);
	}


	public function validar_olvide_contrasena () {

## valido el correo que exista en el sistema
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|callback_check_email_if_existe');

		if($this->form_validation->run() == FALSE)
		{ 
			$this->olvide_contrasena();

		}

		else {
		### envio mensaje de correo para reestablecer la contraseña , la url está encriptada	
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$datos_perfil_estudiante=$this->model_generico->detalle('usuarios',array('correo'=>$this->input->post('correo')));
			$array_claves=array('{nombres}'=>$datos_perfil_estudiante->nombres,'{apellidos}'=>$datos_perfil_estudiante->apellidos,'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$datos_perfil_estudiante->correo,'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'.$foto_nombre,'{correo_confirmar}'=>base64_encode($datos_perfil_estudiante->correo."|recover"));
		#envio mensaje al usuario de que debe cambiar la clave de acceso de su cuenta
			
			envio_correo($array_claves,$configuracion->correo_contacto,$configuracion->nombre_contacto ,$datos_perfil_estudiante->correo,"Cambiar contraseña de acceso en ".$configuracion->nombre_sistema,$datos_perfil_estudiante->nombres.' '.$datos_perfil_estudiante->apellidos,site_url()."email_templates/recuperar_contrasena.html",$this);

			

		######################################################################################################################
			$msg="enviado";
			$this->olvide_contrasena($msg);
		}

	}



	##pagina para recuperar clave
	public function recuperar_contrasena($trama) {
		if ($trama) {
			$trama=base64_decode($trama);

			$data_trama=explode("|", $trama);

			## si es recupaerar clave
			if ($data_trama[1]=='recover') {
######################################### lineas de programacion debe estar en todas ####################################
				$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
				$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
				$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
				$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
######################################### lineas de programacion debe estar en todas ####################################
				$data['correo']=$data_trama[0];
				$this->load->view('publico/view_cambiar_clave_recover',$data);
			}
## si no.. es un error
			else {
				$this->olvide_contrasena();
			}
		}

		else {
			$this->olvide_contrasena();
		}
	}

##funcion para cambiar la clave de acceso del usuario estudiante
	public function validar_recuperar_contrasena () {

##valido claves
		$this->form_validation->set_rules('contrasena1', 'Contraseña', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contrasena2', 'Confirmar contraseña', 'trim|required|xss_clean|callback_check_pass_iguales['.$this->input->post('contrasena1').']');


		if($this->form_validation->run() == FALSE)
		{ 
			$this->recuperar_contrasena($this->input->post('trama'));
		}

		else {
			
			## realizo el proceso de cambiar la clave de acceso del usuario
			$data['contrasena']=sha1($this->input->post ('contrasena1'));
			$correo_est=$this->encrypt->decode( $this->input->post('pid') );
			#$correo_est="gauriel@msn.com";


			$datos_perfil_estudiante=$this->model_generico->detalle('usuarios',array('correo'=>$correo_est));




			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$datos_perfil_estudiante->id_usuarios));
			#$this->olvide_contrasena("Actualizado correctamente!");
			redirect( '/' );


		}


	}


	public function cambiar_clave ($msg=null) {
		$data=array();
		if ($msg) {  $data['mensaje']=$msg;  }
		
		######################################### lineas de programacion debe estar en todas ####################################
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
######################################### lineas de programacion debe estar en todas ####################################

		$this->load->view('publico/view_cambiar_clave',$data);
	}


	function check_pass_iguales($contrasena2,$contrasena1)
	{

		if ($contrasena2=='' || $contrasena1 =='')  {
			$this->form_validation->set_message('check_pass_iguales', 'Los campos no deben estar vacíos');
			return false;   
		}

		else if ($contrasena2 <> $contrasena1)
		{
			$this->form_validation->set_message('check_pass_iguales', 'Las dos contraseñas no son iguales');

			return false;       
		}
		else
		{
			return true;
		}
	}



	function check_pass_bd($contrasena1)
	{
		##consulto en la base de datos la clave que tiene actualmente para compararla con la que ingresó
		$data_estudiante=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$this->encrypt->decode($this->session->userdata('id_usuario'))));

		if ($data_estudiante->contrasena <> sha1($contrasena1))
		{
			$this->form_validation->set_message('check_pass_bd', 'La contraseña anterior es incorrecta.');
			return false;       
		}
		else
		{
			return true;
		}

	}



	public function  actualizar_clave(){


		if ( $this->session->userdata('if_update')!=1 ) {
			$this->form_validation->set_rules('contrasena_anterior', 'Contraseña anterior', 'required|xss_clean|callback_check_pass_bd');
		}
		
		$this->form_validation->set_rules('contrasena1', 'Contraseña', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contrasena2', 'Confirmar contraseña', 'trim|required|xss_clean|callback_check_pass_iguales['.$this->input->post('contrasena1').']');


		$data['contrasena']=sha1($this->input->post ('contrasena1'));
		$data['id_estados']=1;


		if($this->form_validation->run() == FALSE)
		{ 
			# echo validation_errors();
			$this->cambiar_clave();
		} 


		else {
			$this->session->set_userdata('if_update', 0);
			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))   ));
			$this->cambiar_clave("Actualizado correctamente!");
		}


	}



	public function confirmar ($mail) {

		$this->load->model('model_login');

		$data=explode ("|",base64_decode($mail));


# si es facebook o por formulario
		if ($data[1]=='fr' || $data[1]=='fb')  {
	#cambio de estado al usuario
			$info_usuario=$this->model_login->confirmar_email($data[0]);

## en actualiza perfil agregar actualizado correctamente y aqui agregar mensaje de confirmado correctamente

			$if_update=0;
			if ($info_usuario->contrasena=='')  {  $if_update=1; }
			$data_ses = array(
				'id_usuario'=> $this->encrypt->encode($info_usuario->id_usuarios),
				'logeado' 	=>  1,
				'nombres' => $this->encrypt->encode($info_usuario->nombres),
				'apellidos' => $this->encrypt->encode($info_usuario->apellidos),
				'foto' => $this->encrypt->encode($info_usuario->foto),
				'identificacion' => $this->encrypt->encode($info_usuario->identificacion),
				'id_tipo_planes' => $this->encrypt->encode($info_usuario->id_tipo_planes),
				'correo' 	=> $this->encrypt->encode($info_usuario->correo),
				'id_roles' 	=> $this->encrypt->encode($info_usuario->id_roles),
				'id_estados' 	=> $this->encrypt->encode($info_usuario->id_estados),
				'nombre_rol' 	=> $this->encrypt->encode($info_usuario->nombre),
				'id_estatus' 	=> $this->encrypt->encode($info_usuario->id_estatus),
				'nombre_estatus' 	=> $this->encrypt->encode($info_usuario->nombre_estatus),
				'cursos_asignados' 	=> $this->encrypt->encode($info_usuario->id_cursos_asignados),
				'if_update' 	=> $if_update,
				);


			/* Guardo los datos en la variable sesion */
			$this->session->set_userdata($data_ses);




			$this->editar_perfil("¡Bienvenido!,ya haces parte de la comunidad. :), actualiza tus datos.");


		}
	}


#vista de notificaciones
	public function notificaciones () {
		
		if ($this->session->userdata('logeado')!=1)  { redirect( '/' );  }

		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['notificaciones_todas']=$this->model_generico->get_notificaciones ($id_usuarios);
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));
		$this->load->view('publico/view_notificaciones',$data);

	}

##opciones de funcion de las notificaciones
	public function op_notificaciones($id_notificaciones,$opcion) {
		$this->load->model('model_login');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));

##marcarla como leida la notificacion
		if ($opcion==1) {
			$this->model_login->update_notificacion_leida($id_notificaciones);
		}

		##marcarla como no leida la notificacion
		if ($opcion==2) {
			$this->model_login->update_notificacion_no_leida($id_notificaciones);
		}

##eliminar la notificacion
		if ($opcion==3) {
			$this->model_login->delete_notificacion($id_notificaciones);
		}

			#consulto la cantidad de notificaciones
		$notificaciones_count=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		echo $notificaciones_count;


	}


##funcion para obtener el listado de notificaciones con ajax
	public function get_notificaciones_ajax_list () {
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$notificaciones=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$notificaciones_count=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$html='';
		$meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"); 
		foreach ($notificaciones as $noti_key => $noti_value): 

			$datetime=explode (" ",$noti_value->fecha_creado);
		$fecha=explode ("-",$datetime[0]);

		$html.='<li class="clear">';
		$html.='<div class="not_col1">';
		$html.='</div>';
		$html.='<div class="not_col2">';
		$html.='<a target="_blank" href="'.base_url().'notificaciones_user/'.$noti_value->id_notificaciones.'">';
		$html.='<h5>'.substr($noti_value->mensaje, 0, 35)."...".'</h5>';
		$html.='<h6> '.$meses[$fecha[1]].' '.$fecha[2].', '.$datetime[1].'</h6>';
		$html.='</a>';
		$html.='</div>';
		$html.='</li>';
		endforeach; 
		echo $html."|".$notificaciones_count;
	}




##funcion para obtener el listado de inbox con ajax
	public function get_inbox_ajax_list () {
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$mensajes=$this->model_generico->get_mensajes ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$mensajes_count=$this->model_generico->get_mensajes_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$html='';
		$meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"); 
		foreach ($mensajes as $mensa_key => $mensa_value): 
			$datetime=explode (" ",$mensa_value->fecha_creado);
		$fecha=explode ("-",$datetime[0]);
		$html.='<li class="clear">';
		$html.='<div class="inb_col1">';
		$html.='</div>';
		$html.='<div class="not_col2">';
		$html.='<a target="_blank" href="'.base_url().'inbox/'.$mensa_value->id_mensajes.'">';
		$html.='<h5>'.substr($mensa_value->mensaje, 0, 35)."...".'</h5>';
		$html.='<h6> '.$meses[$fecha[1]].' '.$fecha[2].', '.$datetime[1].'</h6>';
		$html.='</a>';
		$html.='</div>';
		$html.='</li>';
		endforeach; 
		echo $html."|".$mensajes_count;
	}


## funcion que carga los mensajes de entrada del estudiante actual 
	public function inbox ($id_mensajes=null) {

		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		
		## funcion para mostrar los mensajes del estudiante.
		$data['inbox_list']=$this->model_generico->get_mensajes ($id_usuarios,'','');
		


		foreach ($data['inbox_list'] as $key => $value) {
			$data['inbox_list'][$key]->pregunta=$this->model_generico->get_pregunta_mensaje ($value->id_mensajes_parent);
		}



		foreach ($data['inbox_list'] as $key => $value) {
			$data['inbox_list'][$key]->docente=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$value->id_usuario_creado));
		}


		foreach ($data['inbox_list'] as $key => $value) {
			$data['inbox_list'][$key]->curso=$this->model_generico->detalle('cursos',array('id_cursos'=>$value->id_cursos));
		}


		foreach ($data['inbox_list'] as $key => $value) {
			if ($value->id_modulos!=0) {
				$data['inbox_list'][$key]->modulo=$this->model_generico->detalle('modulos',array('id_modulos'=>$value->id_modulos));
			}	
		}


		foreach ($data['inbox_list'] as $key => $value) {
			if ($value->id_actividades_barra) {
				$actividad_barra_tmp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$value->id_actividades_barra));
				$tipo_actividad_tmp=$this->model_generico->detalle('tipo_actividades',array('id_tipo_actividades'=>$actividad_barra_tmp->id_tipo_actividades));
				$data['inbox_list'][$key]->actividad=$this->model_generico->detalle($tipo_actividad_tmp->tabla_actividad,array('id_'.$tipo_actividad_tmp->tabla_actividad=>$actividad_barra_tmp->id_actividades));
			}	

		}







		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));

		$data['inbox']=$this->model_generico->listado('mensajes',array('mensajes.id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))),array('orden','asc'));


		$this->load->view('publico/view_inbox',$data);
	}




##opciones de funcion de las notificaciones
	public function op_inbox($id_notificaciones,$opcion) {
		$this->load->model('model_login');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));

##marcarla como no leida la notificacion
		if ($opcion==1) {
			$this->model_login->update_inbox_no_leida($id_notificaciones);
		}

		##marcarla como leida la notificacion
		if ($opcion==2) {
			
			$this->model_login->update_inbox_leida($id_notificaciones);
		}

##eliminar la notificacion
		if ($opcion==3) {
			$this->model_login->delete_inbox($id_notificaciones);
		}

			#consulto la cantidad de notificaciones
		$inbox_count=$this->model_generico->get_mensajes ($id_usuarios,$this->config->item('estado_no_leido'));
		echo count($inbox_count);


	}










}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */