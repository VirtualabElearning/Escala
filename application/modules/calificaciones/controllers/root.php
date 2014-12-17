<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* CONTROLADOR DEL MODULO */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		/* configuracion generica del modulo */
		$this->variables=array('modulo'=>'calificaciones','id'=>'id_calificaciones','modelo'=>'model_calificaciones');
		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  
		if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root');  }   	
		$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 
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
		$data['titulos']=array("Orden","ID","Nombre","Descripcion","Estado","Opciones");
		/* Cargo vista de listado de informacion */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	public function lista_estudiantes ($id_cursos) {

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->model('model_calificaciones');
		$data['titulo']=$variables['modulo'];
		$id_usuarios=$this->session->userdata('id_usuario');
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}

		$miscursos_doc_tmp=$this->model_generico->cursos_list_doc($id_usuarios);
		foreach ($miscursos_doc_tmp as $key => $value) {
			$miscursos_doc[]=$value->id_cursos;
		}

		if ($this->session->userdata('id_roles')==$this->config->item('roles_master') || $this->session->userdata('id_roles')==$this->config->item('roles_administrador')) {
			$data['lista']=$this->model_calificaciones->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('usuarios.orden','asc'),$id_cursos);
			$data['titulos']=array("Foto","Identificación","Nombres","Apellidos","E-mail","Porcentaje de avance","Puntos",'Estatus',"¿Por calificar?","Tipo de plan");

		} else {
			$data['lista']=$this->model_calificaciones->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('usuarios.orden','asc'),$id_cursos,$this->config->item('Premium'));
			$data['titulos']=array("Foto","Identificación","Nombres","Apellidos","E-mail","Porcentaje de avance","Puntos",'Estatus',"¿Por calificar?","Opciones");
		}


		$this->load->view('root/view_'.$variables['modulo'].'_lista_estudiantes',$data);
	}


## funcion para exportar base de datos de alumnos
	public function exportar ($id_cursos) {

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->helper('csv');
		$this->load->model('model_calificaciones');


		$curso_detalle=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos  ));

		### si soy administrador
		#if ($this->session->userdata('id_roles')==$this->config->item('roles_master') || $this->session->userdata('id_roles')==$this->config->item('roles_administrador')) {


		if ($this->session->userdata('id_roles')==$this->config->item('roles_master') || $this->session->userdata('id_roles')==$this->config->item('roles_administrador')) {
			$lista_tmp=$this->model_calificaciones->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('usuarios.orden','asc'),$id_cursos);
			$lista[0]=array('Curso','Nombres','Apellidos','Correo','Porcentaje de avance','Puntos','Estatus','Tipo de plan');

		} else {
			$lista_tmp=$this->model_calificaciones->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('usuarios.orden','asc'),$id_cursos,$this->config->item('Premium'));
			$lista[0]=array('Curso','Nombres','Apellidos','Correo','Porcentaje de avance','Puntos','Estatus');

		}



			### detecto si tiene o no competencias en actividades de tipo evaluacion

			#krumo($lista_tmp); 

		$competenzias=array();
		foreach ($lista_tmp as $key => $value) {
			$tmp_compe=$this->model_calificaciones->get_competencias_eval($id_cursos,$value->id_usuarios);	

			foreach ($tmp_compe as $tmp_compe_key => $tmp_compe_value) {
				$competenzias[]=$tmp_compe_value['nombre_competencia'];
			}
		}


		$competenzias = array_unique($competenzias);
		foreach ($competenzias as $ckey => $cvalue) {
			$lista[0][]="Competencia ".$cvalue;
		}


		## preparo el array para exportar
		foreach ($lista_tmp as $key => $value) {
			if ($this->session->userdata('id_roles')==$this->config->item('roles_master') || $this->session->userdata('id_roles')==$this->config->item('roles_administrador')) {
				$lista[$key+1]=array(utf8_decode($curso_detalle->titulo),utf8_decode($value->nombres),utf8_decode($value->apellidos),$value->correo,get_porcentaje_usuario($value->id_usuarios,$id_cursos).'%',get_puntos_curso($value->id_usuarios,$id_cursos),utf8_decode($value->nombre_estatus),utf8_decode($value->nombre_plan));
			} else {
				$lista[$key+1]=array(utf8_decode($curso_detalle->titulo),utf8_decode($value->nombres),utf8_decode($value->apellidos),$value->correo,get_porcentaje_usuario($value->id_usuarios,$id_cursos).'%',get_puntos_curso($value->id_usuarios,$id_cursos),utf8_decode($value->nombre_estatus));
			}

			$tmp_compe=$this->model_calificaciones->get_competencias_eval($id_cursos,$value->id_usuarios);


			
			if ($value->id_usuarios==43)  {
					#krumo($tmp_compe); 
					#exit;
			}

			$totalcorrectas=0;
			$totalincorrectas=0;
			foreach ($tmp_compe as $tmp_compe_key => $tmp_compe_value) {

				@$tmp_compe_value['correctas']=@$tmp_compe_value['correctas']+0;
				@$tmp_compe_value['incorrectas']=@$tmp_compe_value['incorrectas']+0;
				$totalcorrectas=@$tmp_compe_value['correctas'];
				$totalincorrectas=@$tmp_compe_value['incorrectas'];
				$totalcompetencia=$totalcorrectas+$totalincorrectas;

					### regla de 3 simple para saber el porcentaje en competencias.
				if ($totalcompetencia!=0) {

					$total_correctas_competencia=round((100*$totalcorrectas)/$totalcompetencia);

				}
				else{
					$total_correctas_competencia=0;
				}


				$lista[$key+1][]=$total_correctas_competencia."%";




			}











		}

/*
		### si soy docente	
		} else {
			$lista_tmp=$this->model_calificaciones->listado($this->session->userdata('id_usuario'),$variables['modulo'],'',array('usuarios.orden','asc'),$id_cursos,$this->config->item('Premium'));
			

			$lista[0]=array('Curso','Nombres','Apellidos','Correo','Porcentaje de avance','Puntos','Estatus');	
			


				## preparo el array para exportar
			foreach ($lista_tmp as $key => $value) {
				$lista[$key+1]=array(utf8_decode($curso_detalle->titulo),utf8_decode($value->nombres),utf8_decode($value->apellidos),$value->correo,get_porcentaje_usuario($value->id_usuarios,$id_cursos).'%',get_puntos_curso($value->id_usuarios,$id_cursos),utf8_decode($value->nombre_estatus));
			}
		}
*/


		#krumo ($lista);
		#exit;

		header('Content-Type: application/csv');
		#header('Content-Disposition: attachement; filename="' . asignar_frase_diccionario ($data['diccionario'],"{estudiante}",'Estudiantes',2)."_".date('d-M-Y').'.csv' . '"');
		header('Content-Disposition: attachement; filename="calificaciones_'.amigable($curso_detalle->titulo).'.csv' . '"');

		echo array_to_csv($lista);
		exit;




	}




	##### funcion para mostrar el listado de evaluaciones del estudiante y del curso actual
	public function evaluaciones ($id_cursos,$id_usuarios) {

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->model('model_calificaciones');
		$data['titulo']=$variables['modulo'];
		#$id_usuarios=$this->session->userdata('id_usuario');
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}

		$data['titulos']=array("Nombre actividad","Calificar");
		$data['lista']=$this->model_calificaciones->listar_evaluaciones($id_cursos,$id_usuarios);
		$this->load->view('root/view_'.$variables['modulo'].'_lista_evaluaciones',$data);

	}


## funcion que trae las preguntas de evaluaciones a calificar
	public function calificar ($id_cursos,$id_usuarios) {

		## funcion que me trae las preguntas tipo texto con su respectiva respuesta para guardarla en el sistema
		$array_respuesta_pregunta=get_evaluaciones_texto($id_usuarios,$id_cursos);
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->model('model_calificaciones');
		$data['titulo']=$variables['modulo'];
		$id_usuarios=$this->session->userdata('id_usuario');
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}
		$data['preguntas_con_respuestas']=$array_respuesta_pregunta;
		$this->load->view('root/view_'.$variables['modulo'].'_calificar',$data);
	}



	public function calificar_ahora ($id_cursos,$id_usuarios) {


		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->model('model_calificaciones');
		$data['titulo']=$variables['modulo'];

		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}


		$this->load->model('model_calificaciones');


		$key_texto=$this->input->post('key_texto');
		$respuesta=$this->input->post('respuesta');
		$estado_respuesta=$this->input->post('estado_respuesta');
		$id=$this->input->post('id');



		$eval_detalle=$this->model_generico->detalle('actividades_evaluacion',array('id_actividades_evaluacion'=>$this->input->post('id_actividades')));

		foreach ($this->input->post('pregunta') as $key => $value) {
			$array_data=array();	
			$array_data['id_usuarios']=$id_usuarios;
			$array_data['id_cursos']=$id_cursos;
			$array_data['id_actividades_barra']=$this->input->post('id_actividades_barra');
			$array_data['id_actividades']=$this->input->post('id_actividades');
			$array_data['pregunta']=$value;
			$array_data['respuesta']=$respuesta[$key];
			$array_data['key_texto']=$key_texto[$key];
			$array_data['estado_respuesta']=$estado_respuesta[$key];
			$array_data['id_estados']=$this->config->item('estado_activo');
			$array_data['fecha_creado']=date('Y-m-d H:i:s',time());
			$array_data['fecha_modificado']=date('Y-m-d H:i:s',time());
			$array_data['id_usuario_creado']=$this->session->userdata('id_usuario');
			$array_data['id_usuario_modificado']=$this->session->userdata('id_usuario');
			##guardo la informacion
			$id_calificaciones=$this->model_generico->guardar('calificaciones',$array_data,'id_calificaciones',array('id_calificaciones',$id[$key]));


			## envio notificacion a estudiante de como fué la calificacion de su pregunta de la evaluacion que el realizó


			if ($estado_respuesta[$key]==1) {
				$if_mensajito="Correcta";
			}
			else {
				$if_mensajito="Incorrecta";
			}


			$data_notificaciones['mensaje']="Tu ".asignar_frase_diccionario ($data['diccionario'],'{docente}','Instructor',1)." ha calificado como ".$if_mensajito." la pregunta '".$value."' de la actividad ".$eval_detalle->nombre_actividad;
			$data_notificaciones['id_usuarios']=$id_usuarios; 
			$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
			$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_notificaciones['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_notificaciones['id_actividades_barra']=$this->input->post('id_actividades_barra'); 
			$data_notificaciones['id_cursos']= $id_cursos; 
			$data_notificaciones['id_modulos']= $eval_detalle->id_modulos; 
			#$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
			$data_notificaciones['id_usuario_creado']=$this->session->userdata('id_usuario'); 

			$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));



		}

			##redirecciono al listado de preguntas evaluacion del estudiante
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/evaluaciones/'.$id_cursos.'/'.$id_usuarios.'/guardado_ok';
		redirect($accion_url);

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