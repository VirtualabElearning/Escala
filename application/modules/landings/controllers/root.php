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
		$this->variables=array('modulo'=>'landings','id'=>'id_landings','modelo'=>'model_landings');

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 

		/*configuracion basica para subir una foto*/
		$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);
	}

	public function index()
	{
		/* Funcion que lista los datos de la tabla asignada al modulo */
		$this->lista();
	}

	/* Funcion listado de registros */
	public function lista()
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		 
		/* Titulo = nombre modulo */

		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}

		$data['titulo']=$variables['modulo'];




		/* Consulto el listado de la tabla asignada del modulo */
		$data['lista']=$this->model_generico->listado($variables['modulo'],'',array('orden','asc'));
		/* Muestro los campos necesarios para el listado */
		$data['titulos']=array("Orden","ID","Titulo","Descripcion","Url pagina","Estado","Opciones");
		/* Muestro al vista dinamica del listado */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}


	/* Funcion nuevo registro */
	public function nuevo()
	{	/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre modulo */
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['titulo']=$variables['modulo'];
		/*Cargo la vista de nuevo registro*/
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
			{    #echo $this->upload->display_errors(); exit;
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
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
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
		$this->form_validation->set_rules('contenido', 'Contenido', 'required');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
		$this->form_validation->set_rules('userfile', 'Foto', 'callback_check_foto');

		/* si existe alguna validacion que no pasa, las muestra en pantalla */
		if($this->form_validation->run() == FALSE)
		{  
			

			#echo validation_errors(); exit;
			

			if ($id)  { $this->editar($id); } else { $this->nuevo();  }

		}

		else {
			/* Guardo en un array los valores de los campos a guardar */
			$data = array(
				'titulo' => $this->input->post ('titulo'),
				'descripcion' => $this->input->post ('descripcion'),
				'contenido' => $this->input->post ('contenido'),
				'id_estados' => $this->input->post ('id_estados'),
				'url_video' => $this->input->post ('url_video'),
				);


			/* si tiene id, es editar y me guarda la fecha de modificacion y quien lo modifico, de lo contrario quien lo creo y la fecha de creacion */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			


			if ($_FILES['userfile']['tmp_name'])  {
				#echo "1"; exit;
				$finfo=$this->upload->data();
				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}

				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$data['foto'] = $finfo['file_name'];

			}

			else { #echo "2"; print_r($_FILES['userfile']); exit;
				## elimino la foto
				if ($this->input->post ('foto_antes')  && $this->input->post ('image')=='' )  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
					$data['foto'] = "";
				}
				## campo vacio de la foto
				
			}




			/* Guardo todos los registros a la base de datos */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));
			/* Redirecciono al listado */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
			redirect($accion_url);
		}

	}

	/* Funcion borrar registro */
	public function borrar()
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
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
		redirect($accion_url);
	}


	/* Funcion editar */
	public function editar($id,$error_extra=null)
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre del modulo */
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['titulo']=$variables['modulo'];
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