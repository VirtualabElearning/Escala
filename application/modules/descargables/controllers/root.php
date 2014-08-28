<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Controlador de la aplicacion */
class Root extends CI_Controller {

	/* variable para cargar los datos globales del modulo */
	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		/* Verifica si tiene login de usuario, si no, lo redirecciona a iniciar sesion. */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'descargables','id'=>'id_descargables','modelo'=>'model_descargables');


		/*configuracion basica para subir una foto*/
		$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png|zip|rar|doc|docx|ppt|pptx|xls|xlsx|txt|rtf|doc|pps|ppsx|pdf";
		$config['max_size']      =   "10000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);


		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  
		if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 

		
	}

	public function index($id_modulos=null)
	{
		/* Funcion que lista los datos de la tabla asignada al modulo */
		$this->lista($id_modulos);
	}

	/* Funcion listado de registros */
	public function lista($id_modulos=null)
	{ /* Cargo variables globales */
		if (!$id_modulos)  { redirect( 'modulos/root'); }
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];

		/* Titulo = nombre modulo */
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['titulo']=$variables['modulo'];
		/* Consulto el listado de la tabla asignada del modulo */
		$data['lista']=$this->model_generico->listado($variables['modulo'],array('id_modulos',$id_modulos),array('orden','asc'));
		/* Muestro los campos necesarios para el listado */
		$data['titulos']=array("Orden","ID","Nombre","Descripcion","Archivo","Estado","Opciones");
		/* Muestro al vista dinamica del listado */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}


	/* Funcion nuevo registro */
	public function nuevo()
	{	/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre modulo */
		$data['titulo']=$variables['modulo'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/*Cargo la vista de nuevo registro*/
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}

// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
	public function check_archivo()
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
				$this->form_validation->set_message('check_archivo', $this->upload->display_errors());
				return false;
			}

		}

	}


	/* Funcion guardar  registro */
	public function guardar()
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* variable id del registro (solo funciona cuando es editar) */
		$id=$this->input->post ('id');
		/* Reglas de validacion basicas de los campos del formulario */
		$this->form_validation->set_rules('nombre_descargable', 'Titulo', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion_descargable', 'Descripci&oacute;n', 'required');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
		$this->form_validation->set_rules('image', 'Archivo', 'callback_check_archivo');

		/* si existe alguna validacion que no pasa, las muestra en pantalla */
		if($this->form_validation->run() == FALSE)
		{ 
			if ($id)  { $this->editar($id); } else { $this->nuevo();  }

		}

		else {
			/* Guardo en un array los valores de los campos a guardar */
			$data = array(
				'nombre_descargable' => $this->input->post ('nombre_descargable'),
				'descripcion_descargable' => $this->input->post ('descripcion_descargable'),
				'id_estados' => $this->input->post ('id_estados'),
				'id_modulos' => $this->input->post ('id_modulos'),
				);


			/* si tiene id, es editar y me guarda la fecha de modificacion y quien lo modifico, de lo contrario quien lo creo y la fecha de creacion */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			

			if ($_FILES['userfile']['tmp_name'])  {

				{
					/* subo la foto */
					$finfo=$this->upload->data();

					/* Si existe la foto antes, la borra y sube la nueva */
					if ($this->input->post ('archivo_antes'))  {
						@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('archivo_antes'));

					}

					/* obtengo nombre de la foto y la extension */
					$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
					$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
					$data['archivo'] = $finfo['file_name'];
				}

			}
			else {
				## elimino la foto
				if ($this->input->post ('archivo_antes') !=$this->input->post ('image'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('archivo_antes'));
					## campo vacio de la foto
					$data['archivo'] = "";
				}
				
			}

			/* Guardo todos los registros a la base de datos */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));
			/* Redirecciono al listado */

			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$this->input->post('id_modulos').'/'.$id.'/guardado_ok';
			

			redirect($accion_url);
		}

	}

	/* Funcion borrar registro */
	public function borrar($id_modulos=null)
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Reglas basicas del id */
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		/* guardo el dato en una variable */
		$id=$this->input->post('id');
		/* Consulto el detalle del registo */
		$detalle=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		/* Borro la foto si existe */
		@unlink('uploads/'.$variables['modulo'].'/'.$detalle->foto);

		/* Borro el registro que consulté */
		$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
		/* Redirecciono */
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$id_modulos.'/borrado_ok';
		redirect($accion_url);
	}


	/* Funcion editar */
	public function editar($id,$error_extra=null)
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre del modulo */
		$data['titulo']=$variables['modulo'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Consulto el detalle del registro */
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		/* Si existe un error extra, lo carga en la variable */
		$data['error_extra']=$error_extra;
		/* Cargo la vista de editar */
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}

	/* Funcion ordenar (aplica en el listado de registros a la hora de arrastrar y soltar) */
	public function ordenar()
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Cargo orden de los registros */
		$data = $this->input->post('data');
		/* Divido por coma, los registros a ordenar */
		$dataarray=explode (",",$data);
		foreach ($dataarray as $key => $value) {
			/* Guardo nuevo orden de cada uno de los registros */
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}

}