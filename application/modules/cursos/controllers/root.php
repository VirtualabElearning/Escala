	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Root extends CI_Controller {

		/* Controlador de la aplicacion  */


		var $variables = array();


		public function __construct()
		{
			parent::__construct();
			if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
			
			/* Configuracion generica del modulo */
			$this->variables=array('modulo'=>'cursos','id'=>'id_cursos','modelo'=>'model_cursos');
			$this->load->model($this->variables['modelo']);

			$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
			$config['allowed_types'] =   "gif|jpg|jpeg|png";
			$config['max_size']      =   "5000";
			$config['max_width']     =   "2000";
			$config['max_height']    =   "2000";
			$config['remove_spaces']  = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload',$config);

			$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
			$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 

		}


		public function index()
		{
			$this->lista();
		}


		public function lista()
		{
			$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
			$data['titulo']=$variables['modulo'];
			
			$data['mispermisos']=$variables['mispermisos'];
			$trmp=$this->model_generico->mispermisos($this->session->userdata('id_roles'),'descargables');	
			

			$trmp=$this->model_generico->mispermisos($this->session->userdata('id_roles'),'modulos');	
			$data['if_modulos']=json_decode($trmp->id_roles);

			$trmp=$this->model_generico->mispermisos($this->session->userdata('id_competencias'),'competencias');	
			$data['if_competencias']=json_decode($trmp->id_roles);

			 ## si soy un instructor, traigo solo los cursos que me pertenece
			if ($this->session->userdata('id_roles')==2)  {
				$data['lista']=$this->{$variables['modelo']}->listado_mios($variables['modulo'],'',array('orden','asc'));
			}
			else{
				$data['lista']=$this->{$variables['modelo']}->listado($variables['modulo'],'',array('orden','asc'));
			}
			

			$data['menus']=$this->model_generico->menus_root_categorias();
			foreach ($data['menus'] as $key => $value) {
				$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

			}

			foreach ($data['lista'] as $key => $value) {
				unset($data['lista'][$key]->instructores_asignados_nombre);
				$data['lista'][$key]->instructores_asignados_nombre=$this->{$variables['modelo']}->instructores_lista(json_decode($value->instructores_asignados));
			}





			$data['titulos']=array("Orden","ID","Categoria curso","Nombre","Resumen del curso","instructores asignados","Tipo plan","Maximo estudiantes","Destacado?","Estado","Opciones");
			$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
		}



		public function nuevo()
		{
			$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
			$data['titulo']=$variables['modulo'];
			$data['menus']=$this->model_generico->menus_root_categorias();
			foreach ($data['menus'] as $key => $value) {
				$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

			}
			$data['lista']=$this->model_generico->listado($variables['modulo']);
			$data['categoria_cursos']=$this->model_generico->listado('categoria_cursos','',array('orden','asc'));
			$data['instructores_lista']=$this->{$variables['modelo']}->listado_instructores('usuarios',array('usuarios.id_estados',1),array('orden','asc'));
			$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));

			$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
		}



// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
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
					return false;
				}

			}

		}


		public function guardar()
		{
			$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
			$id=$this->input->post ('id');
			$this->form_validation->set_rules('titulo', 'Titulo', 'required|xss_clean');
			$this->form_validation->set_rules('descripcion', 'Resumen del curso', 'required|xss_clean');
			$this->form_validation->set_rules('contenido', 'Contenido', 'required');
			$this->form_validation->set_rules('prerrequisitos', 'Prerrequisitos', 'required');
			$this->form_validation->set_rules('objetivos_aprendizaje', 'Objetivos de aprendizaje', 'required');
			$this->form_validation->set_rules('destacar', 'Destacar', 'required|xss_clean');
			$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
			$this->form_validation->set_rules('id_categoria_cursos', 'Categoria cursos', 'required|xss_clean');
			$this->form_validation->set_rules('id_tipo_planes', 'Tipo plan', 'required|xss_clean');

			


			$this->form_validation->set_rules('instructores_asignados', 'Instructores asignados', 'required|xss_clean');
			$this->form_validation->set_rules('image', 'Foto', 'callback_check_foto');

			if($this->form_validation->run() == FALSE)
			{ 

			if ($id)  { $this->editar($id); } else { $this->nuevo();    /*echo validation_errors();*/   }

		}

		else {
			$instructores_asignados=json_encode($this->input->post('instructores_asignados'));
			$data = array(
				'titulo' => $this->input->post ('titulo'),
				'descripcion' => $this->input->post ('descripcion'),
				'objetivos_aprendizaje' => $this->input->post ('objetivos_aprendizaje'),
				'prerrequisitos' => $this->input->post ('prerrequisitos'),
				'contenido' => $this->input->post ('contenido'),
				'id_categoria_cursos' => $this->input->post ('id_categoria_cursos'),
				'destacar' => $this->input->post ('destacar'),
				'id_tipo_planes' => $this->input->post ('id_tipo_planes'),
				'id_estados' => $this->input->post ('id_estados'),
				'video' => $this->input->post ('video'),
				'instructores_asignados'=> $instructores_asignados,
				);



			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }




			if ($_FILES['userfile']['tmp_name'])  {
				
				$finfo=$this->upload->data();
				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}

				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$data['foto'] = $finfo['file_name'];

			}


			else {
				## elimino la foto
				if ($this->input->post ('foto_antes') && $this->input->post('image')=='' )  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				## campo vacio de la foto
					$data['foto'] = "";
				}

				
			}


			$id=$this->model_generico->guardar('cursos',$data,$variables['id'],array($variables['id'],$id));
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
			redirect($accion_url);
		}
	}



// funcion para validar datos en cascada
	public function check_validador($id)
	{
		/* consulto en cascada si hay datos para asi evitar error entre llaves foraneas */
		$if_detalle=$this->model_generico->listado('modulos',array('id_cursos',$id));

		if (count ($if_detalle)==0)  {
			return true;
		}
		else {
			foreach ($if_detalle as $key => $value) {
				$cursos[]=$value->nombre_modulo;
			}
			$this->form_validation->set_message('check_validador', 'Existe modulos en este curso <b>('.implode(",", $cursos).')</b>, borrelos primero');
			return false;
		}

	}





	public function borrar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean|callback_check_validador');

		$id=$this->input->post('id');

		$detalle=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		@unlink('uploads/cursos/'.$detalle->foto);

		if ($this->form_validation->run() == FALSE)
		{
			$this->lista();
		}
		else
		{
			$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
			redirect($accion_url);
		}


	}

	public function editar($id,$error_extra=null)
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=$variables['modulo'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		$data['error_extra']=$error_extra;
		$data['categoria_cursos']=$this->model_generico->listado('categoria_cursos',array('categoria_cursos.id_estados','1'),array('orden','asc'));
		$data['instructores_lista']=$this->{$variables['modelo']}->listado_instructores('usuarios',array('usuarios.id_estados',1),array('orden','asc'));
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));

		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}

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
