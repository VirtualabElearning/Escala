<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* CONTROLADOR DEL MODULO */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* configuracion generica del modulo */
		$this->variables=array('modulo'=>'diccionario','id'=>'id_diccionario','modelo'=>'model_diccionario');

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 



	}

	/* funcion por defecto del controlador */
	public function index()
	{ /* llamo a la funcion lista para traer el listado de informacion */
		$this->lista();
	}

	/* FUNCION LISTA PARA TRAER EL LISTADO DE INFORMACION DE LA TABLA ASIGNADA AL MODULO */
	public function lista()
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		


		$data['titulo']=$variables['modulo'];



		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Llamo ala funcion generica para traer el listado de informacion del modulo */
		$data['lista']=$this->model_generico->listado($variables['modulo'],'',array('orden','asc'));
		/* Envio header de la tabla de los campos que necesito mostrar */
		$data['titulos']=array("Orden","ID","Singular","Plural","Llave","Estado","Opciones");
		/* Cargo vista de listado de informacion */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	/* FUNCION NUEVO DATO */
	public function nuevo()
	{
		/* Cargo variables globales del modulo*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Titulo = nombre del modulo */
		$data['titulo']=$variables['modulo'];
		$data['diccionario']=$this->variables['diccionario'];


		/* Cargo vista del modulo */
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}

	/* FUNCION GUARDAR INFORMACION */
	public function guardar()

	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['diccionario']=$this->variables['diccionario'];
		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=$this->input->post ('id');

		/* Validaciones  basicas de lo que voy a editar */
		$this->form_validation->set_rules('singular', 'Singular', 'required|xss_clean');
		$this->form_validation->set_rules('plural', 'Plural', 'required|xss_clean');
		$this->form_validation->set_rules('llave', 'Llave', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');

		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar($id); } else { $this->nuevo();  }
			
		}

		else {
			/* Asigno en array los valores de los campos llegados por el formulario */
			$data = array(
				'singular' => $this->input->post ('singular'),
				'plural' => $this->input->post ('plural'),
				'llave' => $this->input->post ('llave'),
				'id_estados' => $this->input->post ('id_estados'),
				);

			/* Si tiene id, es porque es de editar y guarda la fecha de modificacion, de lo contrario, guarda fecha modificado y creado */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			/* Guardo la informacion */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));

			/* Redirecciono al listado */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
			redirect($accion_url);
		}
	}


// funcion para validar datos en cascada
	public function check_validador($id)
	{
		/* consulto en cascada si hay datos para asi evitar error entre llaves foraneas */
		$if_detalle=$this->model_generico->listado('cursos',array('id_categoria_cursos',$id));
		#krumo ($if_detalle);
		if (count ($if_detalle)==0)  {

			return true;
		}
		else {

			foreach ($if_detalle as $key => $value) {
				$cursos[]=$value->titulo;
			}

			$this->form_validation->set_message('check_validador', 'Existe cursos en esta categoria <b>('.implode(",", $cursos).')</b>, borrelos primero');
			return false;
		}

	}





	/* FUNCION BORRAR */
	public function borrar()
	{
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['diccionario']=$this->variables['diccionario'];
		/* Validacion basica del id */
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean|callback_check_validador');

		/*Asigno valor del id a una variable*/
		$id=$this->input->post('id');
		/*Llamo funcion borrar */
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->lista();
		}
		else
		{
			$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
			/*Preparo redireccion al listado de informacion del modulo*/
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
			redirect($accion_url);
		}

		
	}

	/*FUNCION EDITAR */
	public function editar($id,$error_extra=null)
	{
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=$variables['modulo'];
		$data['diccionario']=$this->variables['diccionario'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/*LLamo funcion para cargar informacion detalle para editarlo*/
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		/*En caso de algun error extra, lo llevo a la vista para cargarlo*/
		$data['error_extra']=$error_extra;
		/*Llamo a la vista de edicion*/
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}

	/*FUNCION ORDENAR PARA EL LISTADO (ordena con arrastrar y soltar filas de la tabla de listado)*/
	public function ordenar()
	{
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/*Cargo orden de listas*/
		$data = $this->input->post('data');
		/*Separo el orden traido por la coma*/
		$dataarray=explode (",",$data);
		/* por medio de un ciclo, empezar a actualizar el nuevo orden */
		foreach ($dataarray as $key => $value) {
			/* Actualizo nuevo orden de cada uno de los elementos */
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}

}