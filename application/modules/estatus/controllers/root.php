<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'estatus','id'=>'id_estatus','modelo'=>'model_estatus');
	}

	public function index()
	{  /* Cargo listado de registros */
		$this->lista();
	}

	/* Funcion para cargar listado de registros */
	public function lista()
	{
		$variables = $this->variables;
		$data['titulo']=$variables['modulo'];
		$data['lista']=$this->model_generico->listado($variables['modulo'],'',array('orden','asc'));
		$data['titulos']=array("Orden","ID","Nombre estatus","Descripcion","Estado","Opciones");
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	/* funcion nuevo registro */
	public function nuevo()
	{
		$variables = $this->variables;
		$data['titulo']=$variables['modulo'];
		$data['lista']=$this->model_generico->listado($variables['modulo']);
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}

	/* Funcion guardar registro */
	public function guardar()
	{
		$variables = $this->variables;
		$id=$this->input->post ('id');
		/* Validacion de campos de formulario */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{ 

		#$this->editar($id);
			echo  validation_errors();
			exit;
		}

		else {
			/* Cargo datos a guardar */
			$data = array(
				'nombre' => $this->input->post ('nombre'),
				'descripcion' => $this->input->post ('descripcion'),
				'id_estados' => $this->input->post ('id_estados'),
				);

			/* Si tiene id, es porque es editar, guarda la fecha de modificacion, de lo contrario guarda la fecha de creacion con su respectivo usuario */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			/* Guardo el registro */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));
			/* Redirecciono */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
			redirect($accion_url);
		}
	}

	/* Funcion borrar registro */
	public function borrar()
	{
		$variables = $this->variables;
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		$id=$this->input->post('id');
		$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
		redirect($accion_url);
	}

	/*Funcion editar regitro  */
	public function editar($id,$error_extra=null)
	{
		$variables = $this->variables;
		$data['titulo']=$variables['modulo'];
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		$data['error_extra']=$error_extra;
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);
	}

	/* Funcion ordenar (funciona solo en listado de registros, con arrastras y soltar la fila de la tabla) */
	public function ordenar()
	{
		$variables = $this->variables;
		$data = $this->input->post('data');
		$dataarray=explode (",",$data);
		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}

}