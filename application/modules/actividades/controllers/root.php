<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'actividades','id'=>'id_actividades','modelo'=>'model_actividades','llave'=>'{actividades}','carpeta'=>'actividades');
		$this->load->model($this->variables['modelo']);

#cargo los permisos del usuario actual segun el rol que se tenga
		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);

		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  
		if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 
	}

	public function index()
	{  /* Cargo listado de registros */
		$this->lista();
	}


	/* Funcion para generar preguntas */
	public function gen_preguntas($id_cursos=null,$id_modulos=null,$id_actividades_barra=null)
	{

		if (!$id_cursos)  { redirect( 'cursos/root'); }
		if (!$id_modulos)  { redirect( 'modulos/root/lista/'.$id_cursos); }

		$this->load->model('model_actividades');

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		# cargo titulo
		$data['titulo']="Generador de preguntas";
		#cargo carpeta por defecto
		$data['carpeta']=$variables['carpeta'];



		# traigo el listado de competencias
		

		$tmp=$this->model_actividades->listado_compe($id_cursos);



		$tmparr=array();
		#organizo las competencias remplazando la llave del array por el id de la competencia
		foreach ($tmp as $key => $value) {
			$tmparr[$value->id_competencias]=$value->nombre;
		}

		$data['competencias']=$tmparr;
		#limpio array 
		unset($tmparr);
		#traigo las preguntas que se tenga
		$data['preguntas_actividades']=$this->{$variables['modelo']}->get_actividad_url($id_actividades_barra);
		## cargo la vista de preguntas al estilo google
		$this->load->view('root/view_'.$variables['modulo'].'_google',$data);


	}





	/* Funcion para cargar listado de registros */
	public function lista($id_cursos,$id_modulos)
	{
		#si no tengo el id_curso ni el id_modulo, lo redirecciono a donde debe ir (seguridad por url)
		if (!$id_cursos)  { redirect( 'cursos/root'); }
		if (!$id_modulos)  { redirect( 'modulos/root/lista/'.$id_cursos); }
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];

		##obtengo el menu del usuario (menu administrable)
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		#cargo el titulo basado en un diccionario por modulo o por defecto el nombre del modulo
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],$variables['llave'],$variables['modulo'],2);
		#cargo carpeta por defecto del modulo
		$data['carpeta']=$variables['carpeta'];
		#traigo el listado de elementos del modulo como lista en una tabla
		$data['lista']=$this->{$variables['modelo']}->listado($id_cursos,$id_modulos);
		$actividad_dato="";

		#organizo listado de elementos del array traido desde base de datos
		foreach ($data['lista'] as $key => $value) {
			$actividad_dato=$this->{$variables['modelo']}->detalle($value->tabla_actividad,array('id_'.$value->tabla_actividad,$value->id_actividades));
			$data['lista'][$key]->datos_actividad=$actividad_dato;	
		}

		# titulos del listado de la tabla de informacion traida para msotrar en pantalla
		#$data['titulos']=array("Orden","ID","Categoria curso","Curso","Tipo actividad","Nombre actividad","Descripcion","Plan","Estado","Opciones");
		$data['titulos']=array("Tipo actividad","Nombre actividad","Estado","Opciones");
		
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	/* funcion nuevo registro */
	public function nuevo()
	{
		#cargo variables globales, diccionario y permisos de usuario sobre el modulo
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->helper($variables['modulo'].'_core');
		#asigno titulo segun diccionario o por defecto el nombre del modulo
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],$variables['llave'],$variables['modulo'],1);
		#carpeta por defecto del modulo
		$data['carpeta']=$variables['carpeta'];
		#traigo los menus por defecto habilitado al rol del usuario
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		##obtengo el tipo de actividades, los logros disponibles y los planes disponibles del sistema
		$data['tipo_actividades_lista']=$this->{$variables['modelo']}->get_tipo_actividades();
		$data['logros_lista']=$this->{$variables['modelo']}->get_logros();
		$data['planes_lista']=$this->{$variables['modelo']}->get_planes();
		#cargo la vista de nuevo registro
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}



## funcion de guardar respuestas de la pregunta rapida
	public function guardar_respuestas () {
		#funcion de guardar respuestas, cargo variables globales y diccionario del modulo 
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		#cargo archivo ayuda del modulo
		$this->load->helper($variables['modulo'].'_core');
		#cargo todas las variables de forma dinamica
		$parametros = $this->input->post('envio');
		#parseo los parametros GET de lo que trajo de forma dinamica los campos de las preguntas y posibles respuestas
		parse_str($parametros); 
		#evaluo cual es la correcta de las opciones
		$opciones_respuesta=array();



		#Empiezo a evaluar si las opciones seleccionadas son como respuestas correctas de la pregunta.
		foreach ($respuesta as $key => $value) {
			if (in_array($key, @$correcta))  { $rtmp='1'; } else { $rtmp='0'; }
			$opciones_respuesta[$key]=array('posible_respuesta'=>$respuesta[$key],'retroalimentacion'=>$retroalimentacion[$key],'correcta'=>$rtmp);
		}



####################### analizo lo siguiente #################
#1. Que sea version editar y caso que tenga el mismo tipo de pregunta
#2. Que sea la version editar y caso que tenga diferente tipo pregunta, para eso:
#
#Borro la pregunta anterior, ingreso la nueva pregunta con los mismos datos casi y actualizo en actividades_barra
#el id de la actividad y el tipo, evaluar si tiene imagen, la borra e ingresa una nueva, si no, la ingresa.


## si es el mismo tipo, edito sin duda!


		if ($id_tipo_actividades_var==$id_tipo_actividades_antes_var)  {

### si es igual solo actualizo la actividad_evaluacion, barra y estado de las dos tablas

	## datos nuevos a insertar:
			
			$nueva_actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_var));

			$data_nuevo=array('nombre_actividad'=>$nom_activ,'descripcion_actividad'=>$desc_acti,
				'pregunta'=>$nombre_pregunta,'tipo_pregunta'=>$tipo_pregunta_opc,'id_estados'=>$id_estados_var,'url_video'=>@$url_video_var);

			$data_nuevo['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_nuevo['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data_nuevo['variables_pregunta']=json_encode($opciones_respuesta);

			# Actualizo la actividad (pregunta con sus posibles respuestas):
			$nuevo_id_actividad=$this->{$variables['modelo']}->guardar ($nueva_actividad->tabla_actividad,$data_nuevo,'id_'.$nueva_actividad->tabla_actividad,array('id_'.$nueva_actividad->tabla_actividad,$id_actividades_var));
			echo "Proceso realizado correctamente!";
		}


		else {

## CASO CUANDO ES UNA ACTIVIDAD DIFERENTE DE LAS PREGUNTAS! BORRO LA ANTERIOR, PONGO LA NUEVA

## consulto la tabla que debo borrar el dato:
			if ($id_tipo_actividades_antes_var)  {
			    #consulto actividad anterior
				$actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_antes_var));
				## consulto la actividad actual
				$actividad_actual=$this->{$variables['modelo']}->detalle($actividad->tabla_actividad,array('id_'.$actividad->tabla_actividad,$id_actividades_var));
			}

#consulto nueva actividad
			$nueva_actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_var));

## solo pasa esto si existe una actividad anterior
			if ($id_tipo_actividades_antes_var)  {

# consulto campos pampos de la actividad anterior
				$campos = $this->db->field_data($actividad->tabla_actividad);
				$llave_primaria='';   $campo_foto='';
				# obtengo llave primeria y campo foto		
				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);
				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];
## Borro el dato de la tabla de la actividad
				$this->model_generico->borrar($actividad->tabla_actividad,array('id_'.$actividad->tabla_actividad=>$id_actividades_var));
				if ($campo_foto)  {
					@unlink('uploads/'.$actividad->tabla_actividad.'/'.$actividad_actual->{$campo_foto});	
				}
			}

			## datos nuevos a insertar:
			$data_nuevo=array('id_modulos'=>$id_modulos_var,'nombre_actividad'=>$nom_activ,'descripcion_actividad'=>$desc_acti,
				'pregunta'=>$nombre_pregunta,'tipo_pregunta'=>$tipo_pregunta_opc,'id_estados'=>$id_estados_var,'url_video'=>$url_video_var);
			$data_nuevo['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_nuevo['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data_nuevo['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_nuevo['id_usuario_creado']=$this->session->userdata('id_usuario');   
			$data_nuevo['variables_pregunta']=json_encode($opciones_respuesta);

# inserto la actividad nueva (pregunta con sus posibles respuestas):

			$nuevo_id_actividad=$this->{$variables['modelo']}->guardar ($nueva_actividad->tabla_actividad,$data_nuevo,'id_'.$nueva_actividad->tabla_actividad,'');
			$id=$id_var;
			$data_barra=array('id_tipo_actividades'=>$id_tipo_actividades_var,'id_estados'=>$id_estados_var,'id_actividades'=>$nuevo_id_actividad);
			
			if (trim($id)=='')  {
				$data_barra['fecha_creado']=date('Y-m-d H:i:s',time());  
				$data_barra['fecha_modificado']=date('Y-m-d H:i:s',time());  
				$data_barra['id_usuario_creado']=$this->session->userdata('id_usuario');  
				$data_barra['id_usuario_modificado']=$this->session->userdata('id_usuario');  
				$data_barra['id_modulos']=$id_modulos_var;  
			}

			$id=$this->model_generico->guardar('actividades_barra',$data_barra,'id_actividades_barra',array('id_actividades_barra',$id));
			echo "Proceso realizado exitosamente!";
		}




	}





## funcion de la actividad de evaluacion
	public function guardar_preguntas_coonrespuestas () {
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->helper($variables['modulo'].'_core');
		$this->load->model($variables['modelo']);
		$parametros = $this->input->post('envio');

		parse_str($parametros); 
		$opciones_respuesta=array();

		foreach ($num_pregunta as $num_pregunta_key => $num_pregunta_value) {

			$tmp_array=array();

			if ($pregunta[$num_pregunta_key] && $tipo_pregunta[$num_pregunta_key])  {
				$opciones_respuesta[$num_pregunta_value]['pregunta']=$pregunta[$num_pregunta_key];
				$opciones_respuesta[$num_pregunta_value]['tipo_pregunta']=$tipo_pregunta[$num_pregunta_key];	
				$opciones_respuesta[$num_pregunta_value]['id_competencias']=$id_competencias[$num_pregunta_key];
			}

			switch ( $tipo_pregunta[$num_pregunta_key] )  {

				case 1:  // casilla de verificacion
				foreach (${"txtop".($num_pregunta_value)} as $respuesta_key => $respuesta_value) {
					$rtmp='';
					if (@in_array($respuesta_key, @${"op".($num_pregunta_value)} ) ) { $rtmp='1'; } else { $rtmp='0'; }
					$tmp_array[]=array('opcion'=>$respuesta_value,'retroalimentacion'=>${"retrotxtop".($num_pregunta_value)}[$respuesta_key],'correcta'=>$rtmp);
				}
				break;


				case 2:  ///Elegir de una lista
				foreach (${"lista".($num_pregunta_value)} as $respuesta_key => $respuesta_value) {
					$rtmp='';
					if (@in_array($respuesta_key, @${"oplista".($num_pregunta_value)} ) )   { $rtmp='1'; } else { $rtmp='0'; }
					$tmp_array[]=array('opcion'=>$respuesta_value,'retroalimentacion'=>${"retrolista".($num_pregunta_value)}[$respuesta_key],'correcta'=>$rtmp);
				}
				break;


				case 3:   //Tipo test

				foreach (${"lista_option".($num_pregunta_value)} as $respuesta_key => $respuesta_value) {
					$rtmp='';
					if (  @${"radios".($num_pregunta_value)}[0] ==$respuesta_key )   {   $rtmp='1'; } else { $rtmp='0'; }
					$tmp_array[]=array('opcion'=>$respuesta_value,'retroalimentacion'=>${"retroradios".($num_pregunta_value)}[$respuesta_key],'correcta'=>$rtmp);
				}
				break;


				case 4:  // campo de texto
				foreach (${"campo_pregunta".($num_pregunta_value)} as $respuesta_key => $respuesta_value) {
					$rtmp='';
					$datos_actividadss=$this->{$variables['modelo']}->get_actividad_url ($id_actividades_barra);


					#$tmp_array[]=array('id'=>$num_pregunta_key.'|'.$datos_actividadss->{'id_'.$datos_actividadss->tabla_actividad}.'|'.$id_actividades_barra,'texto'=>$respuesta_value,'retroalimentacion'=>${"retrotexto".($num_pregunta_value)}[$respuesta_key]);
					$tmp_array[]=array('id_texto'=>${"id_texto".($num_pregunta_value)}[$respuesta_key],'texto'=>$respuesta_value,'retroalimentacion'=>${"retrotexto".($num_pregunta_value)}[$respuesta_key]);
				


				}

				break;

				default:  // no hace nada es vacio
				
				unset($tmp_array);

				break;

			}

			if (@$tmp_array)  {
				$opciones_respuesta[$num_pregunta_value]['variables_respuesta']=json_encode($tmp_array);		
			}
		}

		$datos_actividad=$this->{$variables['modelo']}->get_actividad_url ($id_actividades_barra);

		$data=array('variables_pregunta'=>json_encode($opciones_respuesta));


		if ($id_actividades_barra) { $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

		$id_actividad=$this->{$variables['modelo']}->guardar ($datos_actividad->tabla_actividad,$data,'id_'.$datos_actividad->tabla_actividad,array('id_'.$datos_actividad->tabla_actividad,$datos_actividad->{'id_'.$datos_actividad->tabla_actividad}));

		echo "Actualizado correctamente!   [".$id_actividad."] ";

	}


	/* Funcion guardar registro */
	public function guardar()
	{

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$id=$this->input->post ('id');
		$this->load->helper($variables['modulo'].'_core');
		/* Validacion de campos de formulario */
		$this->form_validation->set_rules('nombre_actividad', 'Nombre actividad', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion_actividad', 'Descripcion actividad', 'required|xss_clean');
		$this->form_validation->set_rules('id_logros', 'Logros', 'required|xss_clean');
		$this->form_validation->set_rules('id_tipo_planes', 'Plan', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar($this->input->post('id_cursos'),$this->input->post('id_modulos'),$id); } else { $this->nuevo();  }

			#echo validation_errors();
			#exit;

		}

		else {
			/* Cargo datos a guardar */
			$data = array(
				'nombre_actividad' => $this->input->post ('nombre_actividad'),
				'descripcion_actividad' => $this->input->post ('descripcion_actividad'),
				'id_logros' => $this->input->post ('id_logros'),
				'id_tipo_planes' => $this->input->post ('id_tipo_planes'),
				'id_estados' => $this->input->post ('id_estados'),
				);

			/* Si tiene id, es porque es editar, guarda la fecha de modificacion, de lo contrario guarda la fecha de creacion con su respectivo usuario */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			/* Guardo el registro */
			$tipo_actividades_detalle=$this->{$variables['modelo']}->get_tipo_actividades($this->input->post ('id_tipo_actividades'));

			## funcion que me organiza los campos personalizados por el tipo de acitividad
			$data=obtener_campos_post_actividad($this->input->post ('id_tipo_actividades'),$data,$this->input->post(),$this);
			unset($data['id_actividades']);


			## solo pasa esto si cambio de tipo de actividad, ingreso uno nuevo y borro el otro.
			if ($this->input->post('id_tipo_actividades_antes') && $this->input->post('id_tipo_actividades_antes')!=$this->input->post('id_tipo_actividades'))   {
				$tipo_actividades_detalle_antes=$this->{$variables['modelo']}->get_tipo_actividades($this->input->post ('id_tipo_actividades_antes'));

				$campos = $this->db->field_data($tipo_actividades_detalle_antes->tabla_actividad);

				$llave_primaria='';   $campo_foto='';
				# obtengo llave primeria y campo foto		
				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);

				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];

				$detalle_dato_borrar=$this->{$variables['modelo']}->detalle($tipo_actividades_detalle_antes->tabla_actividad, array($llave_primaria,$this->input->post('id_actividades'))   );

				$this->model_generico->borrar($tipo_actividades_detalle_antes->tabla_actividad,array('id_'.$tipo_actividades_detalle_antes->tabla_actividad=>$this->input->post('id_actividades')));
				if ($campo_foto)  {
					@unlink('uploads/'.$tipo_actividades_detalle_antes->tabla_actividad.'/'.$detalle_dato_borrar->{$campo_foto});

				}
				unset($id);
				unset($data['id_actividades']);
				$data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario'); 
				$id_acti=$this->model_generico->guardar($tipo_actividades_detalle->tabla_actividad,$data,'id_'.$tipo_actividades_detalle->tabla_actividad,array('id_'.$tipo_actividades_detalle->tabla_actividad,''));

			}

			else {



			## guardo primero el dato de la actividad y miro cual es el id:
				$campos = $this->db->field_data($tipo_actividades_detalle->tabla_actividad);

				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);
				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];
				if (@$id) { $data[$llave_primaria]=$this->input->post('id_actividades'); $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

				unset($data['id_actividades']);

				## si es campo de texto...
				if ($this->input->post('tipo_pregunta')==4)  {
					$data['variables_pregunta']="";
				}

				$id_acti=$this->model_generico->guardar($tipo_actividades_detalle->tabla_actividad,$data,'id_'.$tipo_actividades_detalle->tabla_actividad,array('id_'.$tipo_actividades_detalle->tabla_actividad,$this->input->post('id_actividades')));

			}

			$data['id_actividades']=$id_acti;
			$data['id_modulos']=$this->input->post('id_modulos');
			$data['id_tipo_actividades']=$this->input->post('id_tipo_actividades');
			$data['id_actividades_barra']=$this->input->post('id');
			unset($data['nombre_actividad']);
			unset($data['descripcion_actividad']);
			unset($data['id_logros']);
			unset($data['id_tipo_planes']);
			$data=eliminar_campos_actividad($this->input->post ('id_tipo_actividades'),$data);

			## guardo datos en la tabla barra

			$id=$this->input->post ('id');

			$id=$this->model_generico->guardar('actividades_barra',$data,'id_actividades_barra',array('id_actividades_barra',$id));

			/* Redirecciono */

			###  si es desde nueva pregunta, redirecciono para crear las posibles respuestas
			if ($this->input->post('redirecter_pretty')=='ok')  {
				$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/editar/'.$this->input->post ('id_cursos').'/'.$this->input->post ('id_modulos').'/'.$id.'/guardado_ok_redirect';
			}

			### si es modo editar y cambio de tipo de actividad
			elseif  ($this->input->post('redirecter_pretty_editar')=='ok')  {
				$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/editar/'.$this->input->post ('id_cursos').'/'.$this->input->post ('id_modulos').'/'.$id.'/guardado_ok_redirect';
			}

			else{
				$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$this->input->post ('id_cursos').'/'.$this->input->post ('id_modulos').'/'.$id.'/guardado_ok';

			}
			redirect($accion_url);
		}
	}

	/* Funcion borrar registro */
	public function borrar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		$id=$this->input->post('id');

		


		$this->load->helper($variables['modulo'].'_core');
		## consulto actividades barra para saber la actividad a borrar
		$actividades_barra=$this->{$variables['modelo']}->detalle2('actividades_barra',array('id_actividades_barra',$this->input->post ('id')));
		## tipo de actividad la que voy a borrar




		$tipo_actividades=$this->{$variables['modelo']}->detalle2('tipo_actividades',array('id_tipo_actividades',$actividades_barra->id_tipo_actividades));


		## consulto campos de la tabla de la actividad actual
		$campos = $this->db->field_data($tipo_actividades->tabla_actividad);

		$tmp=get_id_foto_campos($campos);
		$tmp=explode ("|",$tmp);
		## obtengo llave primaria y el campo foto si existe
		$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];

		// consulto la actividad actual
		$actividad_actual=$this->{$variables['modelo']}->detalle($tipo_actividades->tabla_actividad,array($llave_primaria,$actividades_barra->id_actividades));

		// borro la actividad actual
		$this->model_generico->borrar($tipo_actividades->tabla_actividad,array($llave_primaria=>$actividades_barra->id_actividades));

		## si existe foto, la borro del sistema
		if ($campo_foto)  {
			@unlink('uploads/'.$tipo_actividades->tabla_actividad.'/'.$actividad_actual->{$campo_foto});	
		}

		## borro la tabla de actividades barra para dejar limpio el sistema
		$this->model_generico->borrar('actividades_barra',array('id_actividades_barra'=>$this->input->post ('id')));
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/index/borrado_ok';
		redirect($accion_url);

	}

	/*Funcion editar regitro  */
	public function editar($id_cursos=null,$id_modulos=null,$id=null,$error_extra=null)
	{
		if (!$id_cursos) { $id_cursos=$this->input->post('id_cursos'); }
		if (!$id_modulos) { $id_cursos=$this->input->post('id_modulos'); }
		if (!$id) { $id_cursos=$this->input->post('id'); }

		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));
		}

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];
		$this->load->helper($variables['modulo'].'_core');
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],$variables['llave'],$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		$data['detalle']=$this->{$variables['modelo']}->detalle_editar($id);
		$data['tipo_actividades_lista']=$this->{$variables['modelo']}->get_tipo_actividades();
		$data['error_extra']=$error_extra;
		$data['logros_lista']=$this->{$variables['modelo']}->get_logros();
		$data['planes_lista']=$this->{$variables['modelo']}->get_planes();
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);
	}


	/* Consulta las respuestas en caso que las haya */
	public function consultar_posibles_respuestas()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->helper($variables['modulo'].'_core');
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],$variables['llave'],$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		$post=$this->input->post('data');
		#consulto el tipo de actividad, para saber la tabla:
		$tipo_actividades=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$post['id_tipo_actividades']));
		#consulto la pregunta
		$acitividad=$this->{$variables['modelo']}->detalle($tipo_actividades->tabla_actividad,array('id_'.$tipo_actividades->tabla_actividad,$post['id_actividades']));
		## muestro las posibles respuestas
		echo $acitividad->variables_pregunta;
	}

	/* Funcion ordenar (funciona solo en listado de registros, con arrastras y soltar la fila de la tabla) */
	public function ordenar()
	{
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data = $this->input->post('data');
		$dataarray=explode (",",$data);

		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar('actividades_barra',array("orden"=>$key+1),array('id_actividades_barra',$value));
		}
	}
}