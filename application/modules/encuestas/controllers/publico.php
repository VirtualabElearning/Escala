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
		$this->variables=array('modulo'=>'encuestas','id'=>'id_encuestas','modelo'=>'model_encuestas');
	}

	public function index()
	{
		$this->informacion();
	}

	
	public function informacion($id_encuestas,$id_cursos)
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		
		if ($this->session->userdata('logeado')!=1) {  redirect('registro_usuario');  }

### verifico si ya habia llenado la encuesta...


		$data['detalle_respuestas']=$this->model_generico->listado('encuestas_respuestas',array('id_encuestas',$id_encuestas,'id_cursos',$id_cursos),array('encuestas_respuestas.orden','asc'));


		if (count($data['detalle_respuestas'])>0) { $this->informacion_editar($id_encuestas,$id_cursos); }

		else {

			$data['detalle']=$this->model_generico->listado('encuestas_detalle',array('id_encuestas',$id_encuestas),array('encuestas_detalle.orden','asc'));
			$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
			$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
			$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
			$this->load->view('publico/view_'.$variables['modulo'].'_informacion',$data);
		}

	}




	public function informacion_editar($id_encuestas,$id_cursos)
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->model('model_encuestas');
		if ($this->session->userdata('logeado')!=1) {  redirect('registro_usuario');  }

		#$data['detalle_respuestas']=$this->model_generico->listado('encuestas_respuestas',array('id_encuestas',$id_encuestas,'id_cursos',$id_cursos),array('encuestas_respuestas.orden','asc'));
		$data['detalle']=$this->model_generico->listado('encuestas_detalle',array('id_encuestas',$id_encuestas),array('encuestas_detalle.orden','asc'));
		

		foreach ($data['detalle'] as $key => $value) {
			$tmp=$this->model_encuestas->get_respuesta($id_encuestas,$id_cursos,$value->id_encuestas_detalle,$this->encrypt->decode($this->session->userdata('id_usuario')));
			$data['detalle'][$key]->respuesta=$tmp->respuesta;
			$data['detalle'][$key]->id_encuestas_respuestas=$tmp->id_encuestas_respuestas;
		}

		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$this->load->view('publico/view_'.$variables['modulo'].'_editar_informacion',$data);
	}



	public function validar_encuesta ($id_encuestas) {

		$postt=$this->input->post('data');
		parse_str($postt, $post);
		$datos_id=array();

		foreach ($post as $key => $value) {
			if ($key!='id_cursos') {

				$id_encuestas_detalle=str_replace("p", "", $key);

				$data=array('id_encuestas_detalle'=>$id_encuestas_detalle,'id_encuestas'=>$id_encuestas,
					'respuesta'=>$value,
					'id_usuarios'=>$this->encrypt->decode($this->session->userdata('id_usuario')),
					'id_cursos'=>$post['id_cursos'],
					'id_estados'=>$this->config->item('estado_activo') );	

				if ($id) { 
					$data['id_encuestas_respuestas']=$id; 
					$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
					$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
				} 

				else {  
					$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
					$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
					$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
					$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
				}

				$this->model_generico->guardar('encuestas_respuestas',$data,'id_encuestas_respuestas',array('id_encuestas_respuestas',$id));
			}
		}

		echo "ok";
		exit;
		

/*

## envio correo electronico
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$array_claves=array('{nombres_completos}'=>$this->input->post('nombres_completos'),'{mensaje}'=>$this->input->post('mensaje'),'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$datos_perfil->email,'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'.$foto_nombre,'{correo_confirmar}'=>base64_encode($datos_perfil->email."|fb"));
			#envio el mensaje al administrador
			envio_correo($array_claves,$this->input->post('correo'),$this->input->post('nombres_completos'),$configuracion->correo_contacto,"Nuevo mensaje de contacto en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_contacto.html",$this);
			$this->contacto ("enviado");
*/


		}




		public function validar_encuesta_editar ($id_encuestas) {

			$postt=$this->input->post('data');
			parse_str($postt, $post);
			$datos_id=array();

			$rtas=explode (",",$post['rtas']);
			$conta=0;

			
			foreach ($post as $key => $value) {
				if ($key!='id_cursos' && $key!='rtas') {

					$id_encuestas_detalle=str_replace("p", "", $key);	

					$id=$rtas[$conta];
					

					$data=array('id_encuestas_detalle'=>$id_encuestas_detalle,'id_encuestas'=>$id_encuestas,
						'respuesta'=>$value,
						'id_usuarios'=>$this->encrypt->decode($this->session->userdata('id_usuario')),
						'id_cursos'=>$post['id_cursos'],
						'id_estados'=>$this->config->item('estado_activo') );	




					if ($id) { 
						$data['id_encuestas_respuestas']=$id; 
						$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
						$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
					} 

					else {  
						$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
						$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
						$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
						$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
					}

					#print_r($data);
					$this->model_generico->guardar('encuestas_respuestas',$data,'id_encuestas_respuestas',array('id_encuestas_respuestas',$id));
					$conta++;
				}
			}


		echo "ok";
		exit;

/*

## envio correo electronico
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$array_claves=array('{nombres_completos}'=>$this->input->post('nombres_completos'),'{mensaje}'=>$this->input->post('mensaje'),'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$datos_perfil->email,'{base_url}'=>$configuracion->base_url,'{foto}'=>'uploads/aprendices/'.$foto_nombre,'{correo_confirmar}'=>base64_encode($datos_perfil->email."|fb"));
			#envio el mensaje al administrador
			envio_correo($array_claves,$this->input->post('correo'),$this->input->post('nombres_completos'),$configuracion->correo_contacto,"Nuevo mensaje de contacto en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_contacto.html",$this);
			$this->contacto ("enviado");
*/


		}





	}