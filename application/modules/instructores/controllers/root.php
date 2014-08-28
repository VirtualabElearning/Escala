<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */
	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		/* si no existe login de sesion, lo redirecciona para realziar dicha operacion */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		$this->variables=array('modulo'=>'instructores','id'=>'id_instructores','modelo'=>'model_instructores','carpeta'=>'instructores');
		$this->load->model($this->variables['modelo']);

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);
		if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 

		/** Variables de configuracion basicas de subir una foto */	
		$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);
	}


	/** Funcion por defecto */

	public function index()
	{
		$this->lista();
	}

	/* Funcion listado */
	public function lista()
	{
		/** Variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{docente}",$variables['modulo'],2);
		$data['carpeta']=$variables['carpeta'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/** Cargo listado de registros */
		$data['lista']=$this->{$variables['modelo']}->listado('usuarios',array('usuarios.id_roles','2'),array('orden','asc'));
		#krumo ($data['lista']); exit;
		$data['titulos']=array("Orden","ID","Rol","Foto","Nombres","Apellidos","Identificacion","Profesión","Correo","Estado","Opciones");
		/* Cargo vista para mostrar el listado de registros */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}


	/** [nuevo Funcion de nuevo registro] */
	public function nuevo()
	{
		/** cargo variables blogales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{docente}",$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		#$data['lista']=$this->model_generico->listado($variables['modulo']);
		$data['roles']=$this->{$variables['modelo']}->get_roles('instructores');
		#$data['lista_cursos']=$this->{$variables['modelo']}->get_cursos_disponibles();
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}


// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
	public function check_foto()
	{
		if ($_FILES['userfile']['name'])  {
			if ($this->upload->do_upload('userfile'))
			{
				$upload_data    = $this->upload->data();
				$_POST['userfile'] = $upload_data['file_name'];
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				return false;
			}
		}
	}

	/** [guarda registros] */
	public function guardar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$id=$this->input->post ('id');

		/** Valido los campos traidos del formulario */
		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
		$this->form_validation->set_rules('identificacion', 'Identificacion', 'required|xss_clean');
		$this->form_validation->set_rules('profesion', 'Profesión', 'required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean');
		$this->form_validation->set_rules('id_roles', 'Rol', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
		
		if ($this->input->post ('id'))  { 
			$this->form_validation->set_rules('contrasena', 'Contraseña', 'xss_clean');
		} else {
			$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean');
			$this->form_validation->set_rules('contrasena2', 'Repetir contraseña', 'required|xss_clean');
		}

		$this->form_validation->set_rules('resumen_de_perfil', 'resumen_de_perfil', 'xss_clean');
		$this->form_validation->set_rules('image', 'Foto', 'callback_check_foto');
		#$cursos_asignados=json_encode($this->input->post('cursos_asignados'));


		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar($id); } else { $this->nuevo();  }
		}

		else {
			/** Cargo los datos a guardar en un array */
			$data = array(
				'nombres' => $this->input->post ('nombres'),
				'apellidos' => $this->input->post ('apellidos'),
				'correo' => $this->input->post ('correo'),
				'identificacion' => $this->input->post ('identificacion'),
				'profesion' => $this->input->post ('profesion'),
				'resumen_de_perfil' => $this->input->post ('resumen_de_perfil'),
				'id_roles' => $this->input->post ('id_roles'),
				'id_estados' => $this->input->post ('id_estados'),
				#'cursos_asignados'=> $cursos_asignados,

				);

			if ($this->input->post ('contrasena')) {
				$data['contrasena']=sha1($this->input->post ('contrasena'));

			}

			/** Si tiene id, es porque es editar, debe guardar la fecha de modificacion y quien lo edito,de lo contrario quien lo creo y cuando lo creo */
			if ($id) { $data['id_usuarios']=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }


			/* Si existe algun error, continua el programa */
			if ($_FILES['userfile']['tmp_name'])  {

				$finfo=$this->upload->data();

				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}

				/* obteno la extesion y nombre de la imagen */
				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$data['foto'] = $finfo['file_name'];
			}

			else {

				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post('image'))  { }   // si existe el post, no hace nada
					else {
						if ($this->input->post ('foto_antes'))  {
							@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
						}
						$data['foto'] = "";	
					}

				}


			/* Guardo el registro */
			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$id));

			if ( $this->input->post('redirect')  )  {
				redirect(base64_decode($this->input->post('redirect')));
			}

			else {
				$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
				redirect($accion_url);
			}
		}

	}

	/* Funcion borrar registro */
	public function borrar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];




		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');

		$id=$this->input->post('id');

		$detalle=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$id));
		@unlink('uploads/'.$variables['modulo'].'/'.$detalle->foto);


		$this->model_generico->borrar('usuarios',array('id_usuarios'=>$this->input->post ('id')));
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
		redirect($accion_url);
	}


	/* Funcion editar registro */
	public function editar($id,$error_extra=null,$redirect=null)
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{docente}",$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['detalle']=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$id));
		$data['roles']=$this->{$variables['modelo']}->get_roles('instructores');
		$data['error_extra']=$error_extra;
		$data['redirect']=$redirect;
		#$data['lista_cursos']=$this->{$variables['modelo']}->get_cursos_disponibles();

/*
		foreach ($data['lista_cursos'] as $key => $value) {
			$data['lista_cursos'][$key]->categoria_curso=$this->{$variables['modelo']}->get_categoria_curso($value->id_categoria_cursos);
		}
*/

		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}

	/* funcion ordenar registros de un listado */
	public function ordenar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data = $this->input->post('data');
		$dataarray=explode (",",$data);
		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}











}

