<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* CONTROLADOR DEL MODULO */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* configuracion generica del modulo */
		$this->variables=array('modulo'=>'encuestas','id'=>'id_encuestas','modelo'=>'model_encuestas');

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
		$data['titulos']=array("Nombre","Descripción","Estado","Opciones");
		/* Cargo vista de listado de informacion */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}




	/* FUNCION LISTA PARA TRAER EL LISTADO DE INFORMACION DE LA TABLA ASIGNADA AL MODULO */
	public function preguntas($id_encuestas)
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
		$data['lista']=$this->model_generico->listado('encuestas_detalle',array('id_encuestas',$this->uri->segment(4)),array('encuestas_detalle.orden','asc'));
		/* Envio header de la tabla de los campos que necesito mostrar */
		$data['titulos']=array("Pregunta","Tipo de pregunta","Estado","Opciones");
		/* Cargo vista de listado de informacion */
		$this->load->view('root/view_'.$variables['modulo'].'_detalle_lista',$data);
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

		/* Cargo vista del modulo */
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}



	/* FUNCION NUEVO DATO */
	public function nueva_pregunta()
	{
		/* Cargo variables globales del modulo*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Titulo = nombre del modulo */
		$data['titulo']=$variables['modulo'];

		/* Cargo vista del modulo */
		$this->load->view('root/view_'.$variables['modulo'].'_detalle_nuevo',$data);
	}



	/* FUNCION GUARDAR INFORMACION */
	public function guardar()

	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];

		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=$this->input->post ('id');

		/* Validaciones  basicas de lo que voy a editar */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');

		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar($id); } else { $this->nuevo();  }
			
		}

		else {
			/* Asigno en array los valores de los campos llegados por el formulario */
			$data = array(
				'nombre' => $this->input->post ('nombre'),
				'descripcion' => $this->input->post ('descripcion'),
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



	public function guardar_pregunta () {

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=$this->input->post ('id_encuestas_detalle');


		/* Validaciones  basicas de lo que voy a editar */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('tipo_pregunta', 'tipo pregunta', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
		$this->form_validation->set_rules('id_encuestas', 'Encuesta', 'required|xss_clean');


		

		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar_pregunta($id); } else { $this->nueva_pregunta();  }
			
		}

		else {

			$data = array(
				'pregunta' => $this->input->post ('nombre'),
				'tipo_pregunta' => $this->input->post ('tipo_pregunta'),
				'id_estados' => $this->input->post ('id_estados'),
				'id_encuestas' => $this->input->post ('id_encuestas'),
				);

			if ($this->input->post ('tipo_pregunta')==1 || $this->input->post ('tipo_pregunta')==2) {
				$data['variables_pregunta'] = json_encode($this->input->post ('txtop1'));
			}
			else{
				$data['variables_pregunta'] ="";
			}



			if ($id) { $data['id_encuestas_detalle']=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }



			/* Guardo la informacion */
			$id=$this->model_generico->guardar('encuestas_detalle',$data,'id_encuestas_detalle',array('id_encuestas_detalle',$id));

			/* Redirecciono al listado */
			$accion_url=base_url().'encuestas/root/preguntas/'.$this->input->post('id_encuestas').'/'.$id.'/guardado_ok';
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



	/* FUNCION BORRAR */
	public function borrar_pregunta($id_encuestas)
	{

		#echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/preguntas/'.$id_encuestas.'/borrado_ok'; exit;
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
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
			$this->model_generico->borrar('encuestas_detalle',array('id_encuestas_detalle'=>$this->input->post ('id')));
			/*Preparo redireccion al listado de informacion del modulo*/
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/preguntas/'.$id_encuestas.'/borrado_ok';
			redirect($accion_url);
		}

		
	}



	/*FUNCION EDITAR */
	public function editar($id,$error_extra=null)
	{
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=$variables['modulo'];
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

	/*FUNCION EDITAR */
	public function editar_pregunta($id_encuestas,$id_encuestas_detalle,$error_extra=null)
	{
		/*Cargo variables globales*/
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=$variables['modulo'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}
		/*LLamo funcion para cargar informacion detalle para editarlo*/
		$data['detalle']=$this->model_generico->detalle('encuestas_detalle',array('id_encuestas_detalle'=>$id_encuestas_detalle));
		/*En caso de algun error extra, lo llevo a la vista para cargarlo*/
		$data['error_extra']=$error_extra;
		/*Llamo a la vista de edicion*/
		$this->load->view('root/view_'.$variables['modulo'].'_detalle_editar',$data);

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


	/*FUNCION ORDENAR PARA EL LISTADO (ordena con arrastrar y soltar filas de la tabla de listado)*/
	public function ordenar_preguntas()
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
			$this->model_generico->ordenar('encuestas_detalle',array("orden"=>$key+1),array('id_encuestas_detalle',$value));
		}

	}



}