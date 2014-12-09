<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* CONTROLADOR DEL MODULO */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* configuracion generica del modulo */
		$this->variables=array('modulo'=>'mensajes','id'=>'id_mensajes','modelo'=>'model_mensajes');

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
		$this->load->model('model_mensajes');

		$data['titulo']=$variables['modulo'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Llamo ala funcion generica para traer el listado de informacion del modulo */
		$data['lista']=$this->model_mensajes->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('mensajes.orden','asc'));
		/* Envio header de la tabla de los campos que necesito mostrar */
		$data['titulos']=array("Orden","ID","Foto","Nombres","Apellidos","Curso","Mensaje","Estado","Opciones");
		/* Cargo vista de listado de informacion */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	/* FUNCION NUEVO DATO */
	public function nuevo()
	{
		/* Cargo variables globales del modulo*/
		$this->load->model('model_mensajes');
		$id_usuarios=$this->session->userdata('id_usuario');
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* Titulo = nombre del modulo */
		$data['titulo']=$variables['modulo'];


		## cargo los cursos asignados al docente.
		$miscursos_doc=$this->model_mensajes->cursos_list_doc($id_usuarios);

		#krumo ($miscursos_doc); exit;

		$data['mis_cursos']=$miscursos_doc;

		/* Cargo vista del modulo */
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}


	## funcion para traer a todos los estudiantes de un curso determinado.
	function get_estudiantes_curso ($id_cursos) {
		$this->load->model('model_mensajes');
		$estudiantes_lista=$this->model_mensajes->get_estudiantes_curso($id_cursos);
		$html="";

		foreach ($estudiantes_lista as $key => $value) {
		#	$html.='<option value="'.$value->id_usuarios.'">'.$value->identificacion.'  | '.$value->nombres.' '.$value->apellidos.'</option>';
			$html.='<option value="'.$value->id_usuarios.'">'.$value->nombres.' '.$value->apellidos.'</option>';


		}


		echo $html;

	}



	/* FUNCION GUARDAR INFORMACION */
	public function guardar()

	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];

		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=$this->input->post ('id');

		/* Validaciones  basicas de lo que voy a editar */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('Descripcion', 'Descripcion', 'required|xss_clean');
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
				'Descripcion' => $this->input->post ('Descripcion'),
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


#### funcion para enviar mensaje masivo a todos los estudiantes
	public function enviar_masivo (){
		$this->load->model('model_mensajes');
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$id=$this->input->post ('id');
		$id_cursos=$this->input->post ('id_cursos');

		$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|xss_clean');
		$this->form_validation->set_rules('id_cursos', 'cursos', 'required|xss_clean');

		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 
			redirect("inicio/root/index/formv/".base64_encode(validation_errors()));

		}

		else {

			$estudiantes_cursos=$this->model_mensajes->get_estudiantes_curso($id_cursos);

			### consulto primero modulo, primer actividad barra del curso por defecto
			$primer_modulo=$this->model_mensajes->get_modulo($id_cursos);
			$primer_activ_barra=$this->model_mensajes->get_activ_barra($primer_modulo->id_modulos);


			if (@$estudiantes_cursos) {

				foreach ( $estudiantes_cursos as $key => $value) {

					/* Asigno en array los valores de los campos llegados por el formulario */
					$data = array(
						'id_usuarios' => $value->id_usuarios,
						'mensaje' => $this->input->post ('mensaje'),
						'id_estados' => $this->config->item('estado_no_leido'),
						'id_cursos' => $id_cursos,
						'id_modulos' => $primer_modulo->id_modulos,
						'id_actividades_barra' => $primer_activ_barra->id_actividades_barra,
						'id_mensajes_parent' => $id,
						);

					$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
					$data['id_usuario_modificado']=$this->session->userdata('id_usuario');  
					$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
					$data['id_usuario_modificado']=$this->session->userdata('id_usuario'); 
					$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
					$data['id_usuario_creado']=$this->session->userdata('id_usuario'); 


					$id_mensajes=$this->model_generico->guardar('mensajes',$data,'id_mensajes',array('id_mensajes',""));
				}
				redirect("inicio/root/index/frmok/".base64_encode("Mensaje enviado"));
			}

			## no existe ningun estudiante en el curso
			else{
				echo "no hay estudiantes";
			}



		}


	}



## funcion para responder el mensaje del estudiante que ha escrito a su docente
	public function enviar()

	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];

		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=$this->input->post ('id');

		/* Validaciones  basicas de lo que voy a enviar el mensaje */
		$this->form_validation->set_rules('id_usuarios', 'id_usuarios', 'required|xss_clean');
		$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');





		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 

#echo $id."<br>";
#		echo validation_errors(); exit;


		if ($id)  { $this->responder($id); /*echo validation_errors(); */ } else { $this->nuevo();  }

	}

	else {
		/* Asigno en array los valores de los campos llegados por el formulario */
		$data = array(
			'id_usuarios' => $this->input->post ('id_usuarios'),
			'mensaje' => $this->input->post ('mensaje'),
			'id_estados' => $this->config->item('estado_no_leido'),
			'id_cursos' => $this->input->post ('id_cursos'),
			'id_modulos' => $this->input->post ('id_modulos'),
			'id_actividades_barra' => $this->input->post ('id_actividades_barra'),
			'id_mensajes_parent' => $id,
			);

		/* Si tiene id, es porque es de editar y guarda la fecha de modificacion, de lo contrario, guarda fecha modificado y creado */
		if ($id) { 
				#$data[$variables['id']]=$id; 
			$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_modificado']=$this->session->userdata('id_usuario'); 
			$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_creado']=$this->session->userdata('id_usuario'); 

		}  

			## es porque es un mensaje directo
		else {
			$data['id_cursos'] = $this->input->post ('id_cursos');
			$data['id_usuarios'] = $this->input->post ('id_usuarios');
			$data['mensaje'] = $this->input->post ('mensaje');
			$data['id_estados'] = $this->input->post ('id_estados');
			
			$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data['fecha_modificado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_modificado']=$this->session->userdata('id_usuario'); 
			$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data['id_usuario_creado']=$this->session->userdata('id_usuario'); 

		}

		/* Guardo el mensaje al usuario como no leido */



		$idx=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],""));

			##actualizo el mensaje del estudiante según estado seleccionado por el docente
		if ($id) {
			$data2 = array('id_estados' => $this->input->post ('id_estados'));
			$id=$this->model_generico->guardar($variables['modulo'],$data2,$variables['id'],array($variables['id'],$id));
		}


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



public function leido ($id_mensajes,$id_estados) {
	$this->load->model('model_mensajes');
	$data=array();
	if ($id_estados==$this->config->item('estado_no_leido')) {
		$data['id_estados']=$this->config->item('estado_leido');
	}
	else {
		$data['id_estados']=$this->config->item('estado_no_leido');
	}

	$this->model_mensajes->update_mensaje_estado($id_mensajes,$data);

	redirect($this->uri->segment(1)."/".$this->uri->segment(2));

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



/*FUNCION RESPONDER */
public function responder($id,$error_extra=null)
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


	$data['detalle']->datos_usuario=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$data['detalle']->id_usuario_creado));





	/*En caso de algun error extra, lo llevo a la vista para cargarlo*/
	$data['error_extra']=$error_extra;
	/*Llamo a la vista de edicion*/
	$this->load->view('root/view_'.$variables['modulo'].'_responder',$data);

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