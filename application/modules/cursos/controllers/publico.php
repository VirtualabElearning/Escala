<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publico extends CI_Controller {

	/* Controlador de la aplicacion version publica */

	var $variables = array();
	public function __construct()
	{
		parent::__construct();

	}

	/* Cargo la pantalla de inicio */
	public function index()
	{

		$variables = $this->variables; 
		$this->load->model('model_cursos');
		
		## cargo los cursos destacados
		$data['cursos_lista']=$this->model_cursos->get_cursos_lista();

		## consulto cada curso su respectiva categoria

		foreach ($data['cursos_lista'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos_lista'][$key]->categoria_cursos=$tmp->nombre;
		}

##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$this->load->view('publico/view_cursos_lista',$data);

	}

	/* Buscar curso entre mis cursos */
	public function buscar_mis_cursos () {

		$this->form_validation->set_rules('buscar', 'Buscar', 'xss_clean');
		$palabra=$this->input->get('buscar');
		$variables = $this->variables; 
		$this->load->model('model_cursos');
		## cargo los cursos buscados
		$data['cursos_lista']=$this->model_cursos->get_cursos_lista('buscar',$palabra,$this->encrypt->decode($this->session->userdata('cursos_asignados')));
		## consulto cada curso su respectiva categoria
		foreach ($data['cursos_lista'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos_lista'][$key]->categoria_cursos=$tmp->nombre;
		}
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		$this->load->view('publico/view_cursos_mis_cursos',$data);

	}

	/* Cargo la pantalla de inicio */
	public function buscar()
	{
		$this->form_validation->set_rules('buscar', 'Buscar', 'xss_clean');
		$palabra=$this->input->get('buscar');
		$variables = $this->variables; 
		$this->load->model('model_cursos');
		## cargo los cursos buscados
		$data['cursos_lista']=$this->model_cursos->get_cursos_lista('buscar',$palabra);
		## consulto cada curso su respectiva categoria
		foreach ($data['cursos_lista'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos_lista'][$key]->categoria_cursos=$tmp->nombre;
		}

		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$this->load->view('publico/view_cursos_lista',$data);

	}





	/* buscar curso en automcompletado */
	public function buscar_curso()
	{

		$this->form_validation->set_rules('buscar', 'Buscar', 'xss_clean');

		$palabra=$this->input->get('buscar');
		
		$variables = $this->variables; 
		$this->load->model('model_cursos');
		

		## cargo los cursos buscados
		
		if ($palabra) {
			$data['cursos_lista']=$this->model_cursos->get_cursos_lista('buscar',$palabra);
		}
		$buscado=array();
		## consulto cada curso su respectiva categoria
		if ($data['cursos_lista'])  {
			foreach ($data['cursos_lista'] as $key => $value) {
				$buscado[]=$value->titulo;
			}
		}

		// seteo la cabecera como json
		header('Content-type: application/json; charset=utf-8');

      //imprimo el resultado como un json
		echo json_encode($buscado);

	}




	/* pantalla de mis cursos cuando me logeo */
	public function mis_cursos()
	{

		#krumo ($this->session->all_userdata());
		$variables = $this->variables; 
		$this->load->model('model_cursos');

		$mis_cursos=$this->model_cursos->get_cursos_estudiante_lista($this->encrypt->decode($this->session->userdata('id_usuario')));

		if ($mis_cursos) {
			foreach ($mis_cursos as $key => $value) {
				$mis_cursos_asignados[]=$value->id_cursos;
			}
		}

##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
		## cargo mis cursos
		$data['cursos_lista']=$this->model_cursos->get_mis_cursos_lista($mis_cursos_asignados);
		## consulto cada curso su respectiva categoria




		if ($data['cursos_lista']) {


			foreach ($data['cursos_lista'] as $key => $value) {
				$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
				$data['cursos_lista'][$key]->categoria_cursos=$tmp->nombre;
			}

		}

		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		$this->load->view('publico/view_cursos_mis_cursos',$data);

	}


## funcion para registrarme a un curso con solo dar clic
	public function registrarme_al_curso($id_cursos,$nombre_curso)
	{
		$htmtopp=$nombre_curso;

		$this->load->model('model_cursos');

		$primer_mod_activ=$this->model_cursos->get_modulo_activ($id_cursos);

		$nombre_del_curso=str_replace(".html", "", str_replace("-", " ", $nombre_curso));

		$mis_cursos_asignados_tmp=$this->model_generico->listado('cursos_asignados',array('cursos_asignados.id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))),array('orden','asc'));

		foreach ($mis_cursos_asignados_tmp as $miskey => $misvalue) {
			$mis_cursos_asignados[]=$misvalue->id_cursos_asignados;
		}




		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

			## valido si existe ese curso entre mis cursos
		if ( !@in_array($id_cursos, $mis_cursos_asignados)  )  { 

			
			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$detalle_curso=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));
			$tipo_plan=$this->model_generico->detalle('tipo_planes',array('id_tipo_planes'=>$detalle_curso->id_tipo_planes));

			#### guardo el curso gratis al estudiante en los cursos asignados
			$data_curso_asignar['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario'));
			$data_curso_asignar['id_cursos']=$id_cursos;
			$data_curso_asignar['id_estatus']=$this->config->item('Nuevo');
			$data_curso_asignar['id_tipo_planes']=$this->config->item('Estandar');
			$data_curso_asignar['id_estados']=$this->config->item('estado_activo');
			$data_curso_asignar['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario'));
			$data_curso_asignar['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));
			$data_curso_asignar['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_curso_asignar['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_curso_asignar['fecha_entrado']=date('Y-m-d H:i:s',time());  

			$id=$this->model_generico->guardar('cursos_asignados',$data_curso_asignar,'id_cursos_asignados',array('id_cursos_asignados',''));
			
			$miperfil=$this->model_generico->detalle('usuarios',array('id_usuarios'=> $this->encrypt->decode($this->session->userdata('id_usuario'))));

        ########################## AQUI FUNCION DE NOTIFICACION POR CORREO AL ADMIN Y AL USUARIO ###########################

			$array_claves=array('{nombres}'=>$this->encrypt->decode($this->session->userdata('nombres')),'{apellidos}'=>$this->encrypt->decode($this->session->userdata('apellidos')),
				'{empresa}'=>$configuracion->nombre_sistema,'{correo}'=>$this->encrypt->decode($this->session->userdata('correo')),
				'{base_url}'=>'http://virtualab.sem/Escala/','{foto}'=>'uploads/aprendices/'. $this->encrypt->decode($this->session->userdata('foto')),
				'{link_curso}'=>current_url(),'{tipo_plan}'=>utf8_decode($tipo_plan->nombre),'{nombre_curso}'=>utf8_decode($nombre_del_curso)  );

			#notifico al usuario de su nuevo registro en la web
			envio_correo($array_claves,$configuracion->correo_contacto,$configuracion->nombre_contacto ,$this->input->post ('correo'),"Registro realizado al curso ".$configuracion->nombre_sistema,$this->input->post ('nombres').' '.$this->input->post ('apellidos'),site_url()."email_templates/plantilla_registro_curso.html",$this);
			#notifico al administrador del nuevo registro de usuario
			envio_correo($array_claves,$this->input->post ('correo'),$this->input->post ('nombres').' '.$this->input->post ('apellidos') ,$configuracion->correo_contacto,"Nuevo registro al curso xxx en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_registro_curso.html",$this);



		} 


		
		## redirecciono inmediatamente al registrarme al curso		
		redirect('cursos/empezar/'.$id_cursos."/".$primer_mod_activ->id_modulos."/".$primer_mod_activ->id_actividades_barra."/".$htmtopp);
		#$this->detalle($id_cursos,$nombre_curso);



	}




## descripcion del curso
	public function detalle($id_cursos,$nombre_curso)
	{
		$this->load->model('model_cursos');
		$data['detalle_curso']=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));

## consulto los tipos de planes existentes en el sistema para traerlos con sus respectivos contenidos
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));


		$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$data['detalle_curso']->id_categoria_cursos));
		$data['detalle_curso']->categoria_cursos=$tmp->nombre;
		$instructores_asignados=json_decode($data['detalle_curso']->instructores_asignados);

##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));





		$instructores=$this->model_cursos->get_instructores_asignados($instructores_asignados);
		$data['detalle_curso']->instructores=$instructores;

		$modulos=$this->model_cursos->get_modulos($id_cursos);
		$data['detalle_curso']->modulos=$modulos;

		## si no estoy logeado, me redirecciona
		if ($this->session->userdata('logeado')!=1) {  redirect('ingresar/'.base64_encode(current_url()));  }

		## miro si ese curso estoy inscrito o no estoy inscrito
		$mis_cursos=$this->model_cursos->get_cursos_estudiante_lista($this->encrypt->decode($this->session->userdata('id_usuario')));

		foreach ($mis_cursos as $keyxxx => $valuexxx) {
			$miscursosx[]=$valuexxx->id_cursos;
		}

		$data['if_inscrito']=if_inscrito (   $data['detalle_curso']->id_cursos,$miscursosx  );


		## obtengo el primer modulo, primera actividad
		$data['primer_mod_activ']=$this->model_cursos->get_modulo_activ($id_cursos);


		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));

		$this->load->view('publico/view_cursos_descripcion',$data);

	}


	public function  tutorial ($id_cursos,$id_modulos,$id_actividades,$nombre_curso) {
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		$this->load->view('publico/view_cursos_tutorial',$data);


	}



##funcion para el ajax de actualizar el tutorial
	public function  update_tutorial () {
		$this->load->model('model_cursos');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$this->model_cursos->update_tutorial($id_usuarios);
	}




#empezar curso!

	public function empezar($id_cursos,$id_modulos,$id_actividades,$nombre_curso)
	{

		$this->load->model('model_cursos');

		if ($this->session->userdata('logeado')!=1) {  redirect('ingresar/'.base64_encode(current_url()));  }
		$data['detalle_curso']=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		if (!$id_cursos || !$id_modulos || !$id_actividades) {
#redirect($this->uri->segment(1).'/detalle/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
		}


##consulto si muestro o no el tutorial
		$tmp_tutorial=$this->model_cursos->get_if_tutorial($this->encrypt->decode($this->session->userdata('id_usuario')));

		if ($tmp_tutorial->mostrar_tutorial==0)  {

			$this->tutorial($id_cursos,$id_modulos,$id_actividades,$nombre_curso);

		}


		else {

	## consulto si es el primer curso que se registra para darle su medalla

			#$mis_cursos=$this->model_cursos->get_cursos($this->encrypt->decode($this->session->userdata('id_usuario')));


			$mis_cursos=$this->model_cursos->get_cursos_estudiante_lista($this->encrypt->decode($this->session->userdata('id_usuario')));

			foreach ($mis_cursos as $key => $value) {
				$mis_cursosxxxx[]=$value->id_cursos;
			}

## es su primer curso, agrego puntos por ser el primer curso
			if (count($mis_cursosxxxx)==1)  {


#consulto el primer estatus a tener y tambien consulto cuantos puntos le falta por tener para lograrlo, consulto puntos actuales del usuario

				$if_ya_tiene_los_puntos=$this->model_cursos->get_punto($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos,$this->config->item('motivo_puntos_primer_curso'));
				##evaluo si ya se le dieron puntor por ese motivo


				if ($if_ya_tiene_los_puntos) { }

				else { ## inserto los puntos ganados por isncribirse al primer curso
					$data['tiene_primer_curso']="si";
					$data['puntos_primer_curso_ganados']=$this->config->item('puntos_primer_curso');
					$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('puntos_primer_curso'),$this->config->item('motivo_puntos_primer_curso'));
				}

				$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
				$tmp=$mis_puntos_actuales_curso_actual[0];
				$data['mis_puntos_actuales_curso_actual']=$tmp->puntaje;
				$tmp='';
				$data['estatus_proximo']=$this->model_cursos->get_status ($this->config->item('Experto'));
				$data['minimo_faltante_a_experto']=$data['estatus_proximo']->minimo_puntos-$data['mis_puntos_actuales_curso_actual'];


			}
			else {
				$data['tiene_primer_curso']="no";
			}

			$data['puntos_por_actividad']=$this->config->item('puntos_por_actividad');
			$data['motivo_puntos_por_actividad']=$this->config->item('motivo_puntos_por_actividad');

			#tipo preguntas desde config/sistema.php
			$data['pregunta_tipo_test']=$this->config->item('pregunta_tipo_test');
			$data['pregunta_elegir_de_una_lista']=$this->config->item('pregunta_elegir_de_una_lista');
			$data['pregunta_campo_de_texto']=$this->config->item('pregunta_campo_de_texto');



## consulto los tipos de planes existentes en el sistema para traerlos con sus respectivos contenidos
			$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
			$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));


			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$data['detalle_curso']->id_categoria_cursos));
			$data['detalle_curso']->categoria_cursos=$tmp->nombre;
			$instructores_asignados=json_decode($data['detalle_curso']->instructores_asignados);

			##genero el listado de competencias del curso
			$data['detalle_curso']->competencias_curso=$this->model_cursos->listado_compe($id_cursos);


			##consulto mi estatus en el curso actual que estoy viendo:
			$tmpp_mis_cursos_asignados=$this->model_cursos->get_status_micurso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
			


			$data['detalle_curso']->miestatus=$tmpp_mis_cursos_asignados->id_estatus;
			$ttmp=$this->model_cursos->get_status($tmpp_mis_cursos_asignados->id_estatus);
			$data['detalle_curso']->miestatusnombre=$ttmp->nombre;
			




			#obtengo el instructor asignado al curso
			$instructores=$this->model_cursos->get_instructores_asignados($instructores_asignados);
			$data['detalle_curso']->instructores=$instructores;


		## traigo los modulos del curso en el que estoy
			$modulos=$this->model_cursos->get_modulos($id_cursos);
			$data['detalle_curso']->modulos=$modulos;


			## traigo el modulo para premios del curso
			$modulos_premios=$this->model_cursos->get_modulos_premios($id_cursos);
			$data['modulo_premios']=$modulos_premios;

				## ahora listo la primera actividad del modulo premio para ir directamente a la primer actividad al hacer click

			$primera_actividad_mod_premio=$this->model_cursos->get_first_actividad ($data['modulo_premios']->id_modulos);

			$data['primera_actividad_premio']=$primera_actividad_mod_premio;


		### listo aqui los premios que tenga de videos para mostrarlos en los modulos
			$mis_premios=$this->model_cursos-> get_if_premio_sorpresa ($id_cursos,'',$this->encrypt->decode($this->session->userdata('id_usuario')),"todo");
			

			#si tengo premio en este curso
			if  ( count($mis_premios)>0 )  {
				#si tengo premios

				foreach ($mis_premios as $ppkey => $ppvalue) {
					if ($ppvalue->id_tipos_premio==$this->config->item('tipos_premio_video')) {

						#si tengo premios de video
						$data['mostrar_premio_video']="ok";
					}
				}
			}


		## ahora listo la primera actividad de cada modulo para ir directamente a la primer actividad al hacer click
			foreach ($data['detalle_curso']->modulos as $modulos_key => $modulos_value) {
				$primera_actividad_mod=$this->model_cursos->get_first_actividad ($modulos_value->id_modulos);
				$data['detalle_curso']->modulos[$modulos_key]->primera_actividad=$primera_actividad_mod;
			}

			$mis_cursos=$this->model_cursos->get_cursos_estudiante_lista($this->encrypt->decode($this->session->userdata('id_usuario')));
			foreach ($mis_cursos as $keyyyy => $valueyyy) {
				$miscursos[]= $valueyyy->id_cursos;
			}

			## evaluo si realmente estoy inscrito en este curso
			if_mi_curso($data['detalle_curso']->id_cursos,$miscursos,'/mis_cursos');


			## evaluo si ya vi este modulo o hasta ahora entro a este modulo:
			$if_modulos_vistos=$this->model_cursos->get_modulos_vistos ($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));


			## si no he visto el modulo, lo marco como visto...
			if (count($if_modulos_vistos)==0)  {
				$if_modulos_vistos=$this->model_cursos->insertar_modulo_visto ($id_cursos,$id_modulos,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')));
			}

			## si ya he visto modulos anteriores o superiores , evaluo puntualmente este modulo si lo he visto o no.
			else {
				$if_modulo_visto=$this->model_cursos->get_modulo_visto ($id_cursos,$id_modulos,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario'))    );
				if (count($if_modulo_visto)==0)  {
					$if_modulos_vistos=$this->model_cursos->insertar_modulo_visto ($id_cursos,$id_modulos,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')));
				}
			}



			$if_modulos_vistos=$this->model_cursos->get_modulos_vistos ($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));


			foreach ($if_modulos_vistos as $key => $value) {
				$data['detalle_curso']->actividades_vistas_arr[]=$value->id_actividades;
			}


			$data['modulos_vistos']=$if_modulos_vistos;



			##consulto el diccionario de datos de la web
			$data['detalle_curso']->diccionario=$this->model_generico->diccionario();
			$tmp_actividades=$this->model_cursos->get_actividades($id_modulos);

			$arr_actividades=array();
			foreach ( $tmp_actividades as $tmp_actividades_key => $tmp_actividades_value) {
				#echo $tmp_actividades_value->id_actividades_barra;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_actividades_barra']=$tmp_actividades_value->id_actividades_barra;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_modulos']=$tmp_actividades_value->id_modulos;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_tipo_actividades']=$tmp_actividades_value->id_tipo_actividades;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_actividades'] =$tmp_actividades_value->id_actividades;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_estados'] =$tmp_actividades_value->id_estados;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['fecha_creado']=$tmp_actividades_value->fecha_creado;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['fecha_modificado']=$tmp_actividades_value->fecha_modificado;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_usuario_creado'] =$tmp_actividades_value->id_usuario_creado ;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_usuario_modificado']=$tmp_actividades_value->id_usuario_modificado ;
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['orden']=$tmp_actividades_value->orden;

				#informacion extra de la actividad puntualmente si es video, foro o evaluacion
				$tmp_activ=$this->model_cursos->get_actividad($id_modulos,$tmp_actividades_value->id_actividades_barra);
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']=$tmp_activ[2];

				#informacion extra si tiene respuestas de la pregunta rapida para no habilitarla
				$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->respuestas_usuario=$this->model_cursos->get_respuestas ($id_cursos,$tmp_actividades_value->id_modulos,$tmp_actividades_value->id_actividades_barra,$tmp_actividades_value->id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')) );

				##si es un foro, traigo todos comentarios que ha realizado los usuarios
				if ($tmp_actividades_value->id_tipo_actividades == $this->config->item('Foro')) {

					##obtengo la actividad actual del ciclo
					$tmpppxxx=$this->model_cursos->get_actividad($tmp_actividades_value->id_modulos,$tmp_actividades_value->id_actividades_barra);
					$activ_foro=$tmpppxxx[2];	

					$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->me_encantas=$this->model_cursos->get_megustas($tmp_actividades_value->id_actividades_barra,'',$activ_foro->id_usuario_modificado);

					$mensajes_foro=$this->model_cursos->get_mensajes_foro($activ_foro->id_actividades_foro);
					$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->mensajes_foro=$mensajes_foro;

					##obtengo los datos del creador del foro para mostrarlos en pantalla del foro
					$usuario=$this->model_cursos->get_docente($activ_foro->id_usuario_modificado);
					$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->creador_foro=$usuario;

					##obtengo los me gusta de cada usuario que haya dejado mensaje (Tambien organizar los mensajes por la cantidad de me gustas)
					$tmp_mensajes=array();
					foreach ($mensajes_foro as $mensajes_foro_key => $mensajes_foro_value) {
						$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->mensajes_foro[$mensajes_foro_key]->mencantas=$this->model_cursos->get_megustas($tmp_actividades_value->id_actividades_barra,$mensajes_foro_value->id_actividades_foro_mensajes,$mensajes_foro_value->id_usuario_modificado);
					}

					#krumo ($arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->mensajes_foro);
					#exit;


				}

				###si es una evaluacion miro si tiene la opcion de varias oportunidades, si las tiene, busco las oportunidades del estudiante actual
				if ($tmp_actividades_value->id_tipo_actividades == $this->config->item('Evaluacion')) {


					$tmpp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$tmp_actividades_value->id_actividades_barra));
					$id_actividades_evaluacionx=$tmpp->id_actividades;
					$tmp=$this->model_generico->detalle('actividades_evaluacion',array('id_actividades_evaluacion'=>$id_actividades_evaluacionx));
					$num_oportunidadesx=trim($tmp->num_oportunidades);	

					##si no son ilimitados
					if ($num_oportunidadesx!='')  {
						$num_realizadosx=$this->model_cursos->get_oportunidades_count($id_actividades_evaluacionx,$this->encrypt->decode($this->session->userdata('id_usuario')));
						$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->num_oportunidades=$num_oportunidadesx-$num_realizadosx;	
					}

					else {
						## asigno el valor "ilimitatu" para indicar de que es ilimitado y debo mostrar el formulario
						$arr_actividades[$tmp_actividades_value->id_actividades_barra]['info_extra']->num_oportunidades='ilimitatu';	
					}
				}
			}

			foreach ( $if_modulos_vistos as $if_modulos_vistos_key => $if_modulos_vistos_value) {

				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_modulos_vistos']=$if_modulos_vistos_value->id_modulos_vistos;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_cursos']=$if_modulos_vistos_value->id_cursos;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_modulos']=$if_modulos_vistos_value->id_modulos;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_actividades']=$if_modulos_vistos_value->id_actividades;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_usuarios']=$if_modulos_vistos_value->id_usuarios;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['fecha_creado']=$if_modulos_vistos_value->fecha_creado;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['fecha_modificado']=$if_modulos_vistos_value->fecha_modificado;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_usuario_creado']=$if_modulos_vistos_value->id_usuario_creado;
				$arr_actividades_vistas[$if_modulos_vistos_value->id_actividades]['id_usuario_modificado']=$if_modulos_vistos_value->id_usuario_modificado;
			}

			$data['detalle_curso']->actividades = json_decode(json_encode($arr_actividades), FALSE);
			$data['detalle_curso']->actividades_vistas=json_decode(json_encode($arr_actividades_vistas), FALSE);

			### obtengo los descargables del modulo  y genero el archivo comprimido
			$descargables=$this->model_cursos->get_descargables( $this->uri->segment(3) );

			if (!file_exists("./tmp"))  {
				if(!mkdir("./tmp", 0777, true)) {  die('Fallo al crear la carpeta temporal ');  }
			}

			$carpeta_usuario=amigable(str_replace(".html", "",$nombre_curso));

			if (!file_exists("./tmp/".$carpeta_usuario))  {

				if(!mkdir("./tmp/".$carpeta_usuario, 0777, true)) {
					die('Fallo al crear la carpeta temporal ');
				}
			}

			$archivos_a_zip=array();
			foreach ($descargables as $key => $value) {
				$antiguo="./uploads/descargables/".$value->archivo;
				$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $antiguo);

				if(!@mkdir("./tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo), 0777, true)) { }

					$nuevo="./tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo)."/".$value->nombre_descargable.".".$ext;
				$archivos_a_zip[]="tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo)."/".$value->nombre_descargable.".".$ext;

				if (!copy($antiguo, $nuevo)) {
					echo "Error al copiar $archivo...\n";
				}
			}

			$result = crea_zip($archivos_a_zip,'./tmp/'.$carpeta_usuario.'.zip','true');
			borrar_carpeta("./tmp/".$carpeta_usuario);
			$data['archivo_zip']='tmp/'.$carpeta_usuario.'.zip';

## obtengo el peso en MB
#$data['peso_zip']= round ( (filesize($data['archivo_zip']) * .0009765625) * .0009765625); 

 $data['peso_zip']=  @round ( @filesize($data['archivo_zip']) * .0009765625 ); // bytes a KB


## aqui funcion para quitar puntos y guardo una variable para mostrar mensaje que se le ha bajado puntos
## evaluar primero la diferencia en fecha de cuantos dias ha sido sin ingresar al curso, siempre y cuando no haya terminado 
## el curso , si es mayor a 5 dias, al sexto dia se quita 2 puntos, séptimo dia otros 2, y asi sucesivamente.
## si quitando puntos bajó de estatus, mostrar mensaje de que ha bajado de estatus y se actualiza el estatus que tiene en el curso


 $tmp_curso_actual_est=$this->model_cursos->get_logeo_curso($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));

## si el curso actual del estudiante está en modo activo...
 if ($tmp_curso_actual_est)  {

 	#krumo ($tmp_curso_actual_est);

 	#echo $tmp_curso_actual_est->fecha_entrado;

 	#echo "<br>";

 	#echo date('Y-m-d H:m:s');
 	#echo "<br>";
 	$fecha1 = new DateTime($tmp_curso_actual_est->fecha_entrado);
 	$fecha2 = new DateTime(date('Y-m-d H:m:s'));
 	$interval = $fecha1->diff($fecha2);
 	$dias=$interval->format('%a');

 	## si es mayor a x dias sin ingresar al sistema, se resta puntos por dia.
 	if ($dias>$this->config->item('dias_restar')) {

 		$a=0;
 		for ($i=$this->config->item('dias_restar'); $i <$dias ; $i++) { 
 			$a++;

 		}


 		$total_puntos_restar=$a*$this->config->item('puntos_resta');
 		$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),'-'.$total_puntos_restar,$this->config->item('motivo_resta_puntos_falta_actividad'),$id_actividades);
 		$data['popup_resta_puntos']="ok";
 		$data['titulo_resta_puntos']="¡Te extrañamos!";
 		$data['mensaje_resta_puntos']="Nos has obligado a restarte ".$total_puntos_restar." puntos por no ingresar desde hace ".$dias." días.";

 		$mis_puntos_actuales_curso_actuall=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
 		



 		$mis_puntos_actuales_curso_actual_c=$mis_puntos_actuales_curso_actuall[0];
 		$mis_puntos_actuales_curso_actual_c=$mis_puntos_actuales_curso_actual_c->puntaje;



 		## consulto mi estatus actual para evaluar si baje o no de estatus según los puntos que tenga en ese momento
 		$mistatus=$this->model_cursos->get_status_micurso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);


 		## Si mis puntos es menos que el nivel Campeon

 		if ($mis_puntos_actuales_curso_actual_c < $this->config->item('requerido_campeon') && $mistatus->id_estatus==$this->config->item('Campeon'))     { 
			## actualizo estatus del curso actual del estudiante por el de experto que es el anterior al campeon
 			$this->model_cursos->update_estatus($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('Experto'));
 			$estatus_anterior=$this->model_cursos->get_status ($this->config->item('Experto'));
			##activo variables para mostrar popup	
 			$data['baja_estatus_foto']="html/site/img/".$estatus_anterior->id_estatus.".png";
 			$data['mensaje_resta_puntos']="Nos has obligado a restarte ".$total_puntos_restar." puntos por no ingresar desde hace ".$dias." días, ahora bajaste de estatus a ".$estatus_anterior->nombre;
 		}


			## Si mis puntos es menos que el nivel experto
 		if ($mis_puntos_actuales_curso_actual_c < $this->config->item('requerido_experto')  && $mistatus->id_estatus==$this->config->item('Experto'))     { 
				##consulto mi estatus actual si es diferente, de ser asi... actualizo mi estatus por el que acabé de bajar!
 			if ($mistatus->id_estatus!=$this->config->item('Nuevo')) {
				## actualizo estatus del curso actual del estudiante
 				$this->model_cursos->update_estatus($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('Nuevo'));
 				$estatus_anterior=$this->model_cursos->get_status ($this->config->item('Nuevo'));
				##activo variables para mostrar popup	
 				$data['baja_estatus_foto']="html/site/img/".$estatus_anterior->id_estatus.".png";
 				$data['mensaje_resta_puntos']="Nos has obligado a restarte ".$total_puntos_restar." puntos por no ingresar desde hace ".$dias." días, ahora bajaste de estatus a ".$estatus_anterior->nombre;

 			}

 		}


 	}  ## fin si es mayor a x dias sin ingresar al sistema, se resta puntos por dia.


 }  ## fin  si el curso actual del estudiante está en modo activo...

 
 #exit;

###----------------------------------------------------------------------------------------------------------------------------------



## esta funcion es para guardar la ultima vez que se logueó para asi mismo controlar en un cron, los dias y descontar los puntos necesarios para ello.
 $this->model_cursos->update_logeo($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')),date('Y-m-d H:i:s',time()));


##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
 $data['notificaciones']=$this->model_generico->get_notificaciones ($this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('estado_no_leido'),5);
 $data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('estado_no_leido'));

##function que me trae los modulos vistos del estudiante actual.
 $tmpmodulos_arr=$this->model_cursos->get_modulos_vistos_curso_actual($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));
 $arrxxxxx=array();
 foreach ($tmpmodulos_arr as $tmmpkey => $tmmpvalue) {
 	$arrxxxxx[]=$tmmpvalue->id_modulos;
 }

 $data['detalle_curso']->modulos_vistos_arr=$arrxxxxx;
 $data['miplan_curso_actual']=$this->model_cursos->get_plan_curso($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));


##===============================================obtengo mis logros del curso actual: ==========================================================
 $mis_logros_curso=$this->model_cursos->get_mislogros ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')));
 $tmplogros='';
## ahora empiezo a armar mi ciclo de logros
 foreach ($mis_logros_curso as $lkey => $lvalue) {
 	$tmplogro=$this->model_cursos->get_logro($lvalue->id_logros);
 	$tmplogros.='<img width="55" alt="'.$tmplogro->nombre.'" src="uploads/logros/'.$tmplogro->foto.'">';	
 }
 $data['mis_logros_curso']=$tmplogros;
##===================================================================================================================================================================



##============== obtengo si tengo el premio de crear un foro en el curso actual en estado no utilizado =======================


#pendiente


##============== obtengo si tengo el premio de crear un foro en el curso actual en estado no utilizado =======================



##============== obtengo los puntos proximos para mostrar el proximo estatus y detectar el cambio de estatus =======================
####consulto puntos actuales con los puntos requeridos a cada nivel
 $mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);

 $tmp=$mis_puntos_actuales_curso_actual[0];
 $mis_puntos_actuales_curso_actual=$tmp->puntaje;
 $tmp='';
			$niveldios=0; #3 para saber si ya superlo los puntos de campeon




			## nivel experto
			if ($mis_puntos_actuales_curso_actual < $this->config->item('requerido_experto'))     { 
				$estatus_proximo=$this->model_cursos->get_status ($this->config->item('Experto'));
				$estatus_id=$this->config->item('Experto');
				$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
			}

			else {

			## nivel campeon
				if ($mis_puntos_actuales_curso_actual < $this->config->item('requerido_campeon')) {
					$estatus_proximo=$this->model_cursos->get_status ($this->config->item('Campeon'));
					$estatus_id=$this->config->item('Campeon');
					$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
				}

				## ya subio a lo más alto
				else {
					$niveldios=1;
				}
			}

			#if ($niveldios==1) {
			#	$data3['mensaje']=" ".$mipremio_sorpresa->puntos." puntos por terminar el modulo.";
			#}

			#else {
			#	$data3['mensaje']=" ".$mipremio_sorpresa->puntos." puntos por terminar el modulo, te faltan ".$minimo_faltante_a_otro_nivel." puntos para ser ".$estatus_proximo->nombre."";
			#}	

			$data['datos_proximo_estatus']=$estatus_proximo->nombre."|".$estatus_proximo->minimo_puntos."|".$estatus_id."|".$niveldios;
##============== obtengo los puntos proximos para mostrar el proximo estatus y detectar el cambio de estatus =======================



			##obtengo mi plan del curso actual
			$miplan_curso_actual=$this->model_cursos->get_plan_curso($id_cursos,$this->encrypt->decode($this->session->userdata('id_usuario')));
			$data['mi_plan_actual']=$miplan_curso_actual->id_tipo_planes;



			####### obtengo la consulta de si poder crear otro foro en el mismo modulo actual siendo campeon ###########
			$tmp_estatus_mio_act_cur=$this->model_cursos->get_status_micurso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
			if ($tmp_estatus_mio_act_cur->id_estatus==$this->config->item('Campeon')) {
				$if_creado_foro=$this->model_cursos->get_mi_foro_creado ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos,$id_modulos);
				if ($if_creado_foro->id_actividades_foro_usuarios) { $data['foro_ya_creado_campeon']='si'; }
				else { $data['foro_ya_creado_campeon']='no'; }
			}



			if ($tmp_estatus_mio_act_cur->id_estatus!=$this->config->item('Campeon')) {
			### consulto si tengo premio disponible para crear foro en el modulo actual!! si no soy campeon!
				$tmp_premio_mio_foro=$this->model_cursos->get_premio_sorpresa_mio($post['id_cursos'],$post['id_modulos'],$id_usuarios,$this->config->item('tipos_premio_foro'),$this->config->item('estado_no_utilizado'));
				if ($tmp_premio_mio_foro->valor==1) {  $data['foro_ya_creado_campeon']='no'; } else {   }
			}

			$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
			$this->load->view('publico/view_cursos_empezar',$data);





		}


	}


	public function gen_estatus($id_cursos)
	{
		$this->load->model('model_cursos');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$datosbar=explode ("|",generar_estatus($id_cursos));

		$conta_logros=$this->model_cursos->getCountlogros($id_cursos,$id_usuarios);

		$list_logros=$this->model_cursos->getLogrosCurso($id_cursos,$id_usuarios);

		$html="";

		foreach ($list_logros as $lgkey => $lgvalue) {
			$html.='<img width="55" src="uploads/logros/'.$lgvalue->foto.'" alt="'.$lgvalue->nombre.'">';
		}


		echo  $datosbar[0]."|".$datosbar[1]."|".$datosbar[2]."|".$conta_logros."|".$html;



	}



	public function descargar($id_cursos,$id_modulos,$id_actividades_barra,$nombre_curso) {
		$this->load->model('model_cursos');
#krumo ($id_cursos,$id_modulos,$id_actividades_barra);

### obtengo los descargables del modulo  y genero el archivo comprimido
		$descargables=$this->model_cursos->get_descargables($id_cursos);

		if (!file_exists("./tmp"))  {

			if(!mkdir("./tmp", 0777, true)) {
				die('Fallo al crear la carpeta temporal ');
			}

		}

		$carpeta_usuario=str_replace(".html", "",$nombre_curso);

		if (!file_exists("./tmp/".$carpeta_usuario))  {

			if(!mkdir("./tmp/".$carpeta_usuario, 0777, true)) {
				die('Fallo al crear la carpeta temporal ');
			}

		}


		$archivos_a_zip=array();

		foreach ($descargables as $key => $value) {

			$antiguo="./uploads/descargables/".$value->archivo;
			$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $antiguo);
			if(!@mkdir("./tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo), 0777, true)) { }

				$nuevo="./tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo)."/".$value->nombre_descargable.".".$ext;
			$archivos_a_zip[]="tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo)."/".$value->nombre_descargable.".".$ext;

			if (!copy($antiguo, $nuevo)) {
				echo "Error al copiar $archivo...\n";
			}


		}


#echo "tmp/".$carpeta_usuario."/".amigable($value->nombre_modulo)."/"; exit;



		$result = crea_zip($archivos_a_zip,'./tmp/'.$carpeta_usuario.'.zip','true');

		borrar_carpeta("./tmp/".$carpeta_usuario);

		$file='/tmp/'.$carpeta_usuario.'.zip';
		$size = filesize('tmp/'.$carpeta_usuario.'.zip');
#echo $size;

		if (file_exists('tmp/'.$carpeta_usuario.'.zip')) {


			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.$carpeta_usuario.'.zip'.'"');
			header("Content-Length: \".$size.\"");
			readfile('tmp/'.$carpeta_usuario.'.zip');
		}

	}




##funcion para crear el foro de discusion por parte del usuario

	public function createpost()
	{


		$this->load->model('model_cursos');
		$post=$this->input->post('data');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));

		$tmp_estatus_mio=$this->model_cursos->get_status_micurso ($id_usuarios,$post['id_cursos']);

		## evaluo si soy campeon para tener la posibilidad de crear foro ó si me lo gané como premio. sabado

		$tmp_premio_mio_foro=$this->model_cursos->get_premio_sorpresa_mio($post['id_cursos'],$post['id_modulos'],$id_usuarios,$this->config->item('tipos_premio_foro'),$this->config->item('estado_no_utilizado'));

##valor==1  =  if_foro==1

#sabado



		if ($tmp_estatus_mio->id_estatus==$this->config->item('Campeon')) {

				##evaluo si ya habia creado foro (solo 1 por modulo! )
			$if_creado_foro=$this->model_cursos->get_mi_foro_creado ($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_cursos'],$post['id_modulos']);

			if (!$if_creado_foro->id_actividades_foro_usuarios) { 
				$data['id_modulos']=$post['id_modulos'];
				$data['nombre_actividad']=$post['mensaje'];
				$data['descripcion_actividad']=$post['mensaje'];
				$data['id_tipo_planes']=$this->config->item('Estandar');
				$data['contenido_foro']=$post['mensaje'];
				$data['id_estados']=1;
				$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
				$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
				$data['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
				$data['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

	##guardo el foro
				$id_actividades_foro=$this->model_generico->guardar('actividades_foro',$data,'id_actividades_foro',array('id_actividades_foro',''));


	##guardo la actividad en barra

				$data2['id_modulos']=$post['id_modulos'];
				$data2['id_tipo_actividades']=$this->config->item('Foro');
				$data2['id_actividades']=$id_actividades_foro;
				$data2['id_estados']=1;
				$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
				$data2['fecha_modificado']=date('Y-m-d H:i:s',time());
				$data2['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
				$data2['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

	#guardo en actividades barra
				$id_actividades_barra=$this->model_generico->guardar('actividades_barra',$data2,'id_actividades_barra',array('id_actividades_barra',''));


#guardo en actividades foro usuarios para no volver a crear el foro

				$data3['if_foro']=1;
				$data3['id_usuarios']=$this->encrypt->decode($post['id_usuario']);
				$data3['id_cursos']=$post['id_cursos'];
				$data3['id_modulos']=$post['id_modulos'];
				$data3['id_actividades_barra']=$id_actividades_barra;
				$data3['id_actividades_foro']=$id_actividades_foro;
				$data3['id_estados']=7;
				$data3['fecha_creado']=date('Y-m-d H:i:s',time()); 
				$data3['fecha_modificado']=date('Y-m-d H:i:s',time());
				$data3['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
				$data3['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

				$id_actividades_barra=$this->model_generico->guardar('actividades_foro_usuarios',$data3,'id_actividades_foro_usuarios',array('id_actividades_foro_usuarios',''));

				echo "ok";

 			} ## fin si no existe foro en mi curso y modulo actual como estudiante

 			else {
 				echo "error"; exit;
 			}






 		}

 		else {

 			## si no soy campeon!!!!  miro si puedo crear el foro!

 			if ($tmp_premio_mio_foro->valor==1) {

 			##actualizo el estado del premio sorpresa a utilizado
 				$data=array("id_estados"=>$this->config->item('estado_utilizado'));
 				$this->model_cursos->update_premio_sorpresa($tmp_premio_mio_foro->id_recompensas_aleatorias_usuarios,$data);

 				$data['id_modulos']=$post['id_modulos'];
 				$data['nombre_actividad']=$post['mensaje'];
 				$data['descripcion_actividad']=$post['mensaje'];
 				$data['id_tipo_planes']=$this->config->item('Estandar');
 				$data['contenido_foro']=$post['mensaje'];
 				$data['id_estados']=1;
 				$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
 				$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
 				$data['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
 				$data['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

	##guardo el foro
 				$id_actividades_foro=$this->model_generico->guardar('actividades_foro',$data,'id_actividades_foro',array('id_actividades_foro',''));


	##guardo la actividad en barra

 				$data2['id_modulos']=$post['id_modulos'];
 				$data2['id_tipo_actividades']=$this->config->item('Foro');
 				$data2['id_actividades']=$id_actividades_foro;
 				$data2['id_estados']=1;
 				$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
 				$data2['fecha_modificado']=date('Y-m-d H:i:s',time());
 				$data2['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
 				$data2['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

	#guardo en actividades barra
 				$id_actividades_barra=$this->model_generico->guardar('actividades_barra',$data2,'id_actividades_barra',array('id_actividades_barra',''));


#guardo en actividades foro usuarios para no volver a crear el foro

 				$data3['if_foro']=1;
 				$data3['id_usuarios']=$this->encrypt->decode($post['id_usuario']);
 				$data3['id_cursos']=$post['id_cursos'];
 				$data3['id_modulos']=$post['id_modulos'];
 				$data3['id_actividades_barra']=$id_actividades_barra;
 				$data3['id_actividades_foro']=$id_actividades_foro;
 				$data3['id_estados']=7;
 				$data3['fecha_creado']=date('Y-m-d H:i:s',time()); 
 				$data3['fecha_modificado']=date('Y-m-d H:i:s',time());
 				$data3['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
 				$data3['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  

 				$id_actividades_barra=$this->model_generico->guardar('actividades_foro_usuarios',$data3,'id_actividades_foro_usuarios',array('id_actividades_foro_usuarios',''));

 				echo "ok"; exit;






 			}






 			echo "error"; exit;
 		}

 	}




 	/* envia el mensaje del foro desde el usuario */
 	public function sendpost()
 	{
 		$this->load->model('model_cursos');
 		$post=$_POST['data'];
	##consulto la actividad de foro
 		$tmp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$post['id_actividades_barra']));
 		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
 		$data['id_usuario_modificado']=$this->encrypt->decode($post['id_usuario']);  
 		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
 		$data['id_usuario_creado']=$this->encrypt->decode($post['id_usuario']); 
 		$data['id_actividades_foro']=$tmp->id_actividades;
 		$data['mensaje']=$post['mensaje'];
 		$data['id_estados']=1;
	#guardo
 		$idpost=$this->model_generico->guardar_sin_orden('actividades_foro_mensajes',$data,'id_actividades_foro_mensajes',array('id_actividades_foro_mensajes',''));

 		$tmp_foro_insertado=$this->model_generico->detalle('actividades_foro_mensajes',array('id_actividades_foro_mensajes'=>$idpost));


 		$mistatus=$this->model_cursos->get_status_micurso ($this->encrypt->decode($post['id_usuario']),$post['id_cursos']);


 		$foto_perfil="uploads/aprendices/".$this->encrypt->decode($this->session->userdata('foto'));
 		if (  !file_exists($foto_perfil) || strlen($this->encrypt->decode($this->session->userdata('foto')))==0  )  {
 			$foto_perfil="html/site/img/sin_foto.png";
 		} 


 		$html='<div class="disc_block_B">
 		<div class="disc_block_B_wrap clear"><div class="disc_block_B_col1 clear"> 
 			<img src="'.$foto_perfil.'" alt="">
 			<div id="disc_status"><img src="html/site/img/'.$mistatus->id_estatus.'.png"></div>
 			<h4>'.$this->encrypt->decode($this->session->userdata("nombres")).' '.$this->encrypt->decode($this->session->userdata("apellidos")).'</h4>
 			<a barr="'.$post['id_actividades_barra'].'" class="meencantar_estudiante" est="'.$this->encrypt->decode($post['id_usuario']).'" id="'.$idpost.'" href="'.base_url().'cursos/dar_meencanta_estudiante"><div class="kudos"><p class="mencantas_estudiantes_todos" id="'.$idpost.'meencanta_estudiante">0</p> </div></a>
 		</div> 
 		<div class="disc_block_B_col2"><p>'.$tmp_foro_insertado->mensaje.'</p> </div>
 	</div>
 </div>';
 echo 	$html;

	#echo "OK";
}



##dar me encanta a la discusion 
public function dar_meencanta () {

	$this->load->model('model_cursos');
	$post=$_POST['data'];

		##inserto el megusta en la bd
	if ($post['op']=='darmegusta') {

		$data=array('id_cursos'=>$post['id_cursos'],'id_modulos'=>$post['id_modulos'],'id_actividades'=>$post['id_actividades'],'id_actividades_foro_mensajes'=>0,'id_usuarios'=>$post['id_usuario_docente'],'id_estados'=>1);
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

		##miro si ya le di me gusta , el d es porque debe buscar si le di  me gusta al post del docente
		$tmp_ifmegusta=$this->model_cursos->get_if_megusta($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_actividades'],'d');
		


		if ($tmp_ifmegusta==0)  {

			$id=$this->model_generico->guardar('actividades_foro_megusta',$data,'id_actividades_foro_megusta',array('id_actividades_foro_megusta',''));
		}
		else {

			$data_del=array('id_cursos'=>$post['id_cursos'],
				'id_modulos'=>$post['id_modulos'],
				'id_actividades'=>$post['id_actividades'],
				'id_usuarios'=>$post['id_usuario_docente'],
				'id_estados'=>1,
				'id_usuario_modificado'=>$this->encrypt->decode($this->session->userdata('id_usuario')));


			$id=$this->model_generico->borrar('actividades_foro_megusta',$data_del);
		}

		#obtengo los megusta del docente
		$megustas_docente=$this->model_cursos->get_megustas($post['id_actividades'],'',$post['id_usuario_docente']);

		#muestro la cantidad de me gusta al docente
		echo count($megustas_docente);

	}

}


##funcion de dar me encanta al mensaje del estudiante
public function dar_meencanta_estudiante () {

	$this->load->model('model_cursos');
	$post=$_POST['data'];
	$if_borrado=0;


	if ($post['op']=='darmegusta_Est') {

		$data=array('id_cursos'=>$post['id_cursos'],'id_modulos'=>$post['id_modulos'],'id_actividades'=>$post['id_actividades'],
			'id_actividades_foro_mensajes'=>$post['id_actividades_mensaje'],'id_usuarios'=>$post['id_usuario_estudiante'],'id_estados'=>1);
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

	#consulto el foro para saber el nombre del foro o actividad
		$tmp_foro_actualx=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$post['id_actividades']));
		$tmp_foro_actual=$this->model_generico->detalle('actividades_foro',array('id_actividades_foro'=>$tmp_foro_actualx->id_actividades));
		$nombre__foro=$tmp_foro_actual->nombre_actividad;

	##miro si ya le di me gusta
		$tmp_ifmegusta=$this->model_cursos->get_if_megusta($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_actividades'],$post['id_actividades_mensaje']);


		if ($tmp_ifmegusta==0)  {
			$id=$this->model_generico->guardar('actividades_foro_megusta',$data,'id_actividades_foro_megusta',array('id_actividades_foro_megusta',''));

		}

		else {

			$data_del=array('id_cursos'=>$post['id_cursos'],
				'id_modulos'=>$post['id_modulos'],
				'id_actividades'=>$post['id_actividades'],
				'id_usuarios'=>$post['id_usuario_estudiante'],
				'id_estados'=>1,
				'id_actividades_foro_mensajes'=>$post['id_actividades_mensaje'],
				'id_usuario_modificado'=>$this->encrypt->decode($this->session->userdata('id_usuario')));
			$id=$this->model_generico->borrar('actividades_foro_megusta',$data_del);
			$if_borrado=1;
		}
		
		#obtengo los megusta del estudiante
		$megustas_estudiante=$this->model_cursos->get_megustas_estudiante($post['id_actividades'],$post['id_actividades_mensaje'],$post['id_usuario_estudiante']);


		###### pasos para dar puntaje al mensaje de los que tenga me gusta: #########################################
		## 1. consulto cuantos estudiantes están inscritos al curso actual
		## 2. Evaluo el 5% de los que le han dado me encanta al mensaje, si corresponde al 5% doy puntos al estudiante quien hizo el mensaje
		## 3. Evaluo el 10% de los que le han dado me encanta al mensaje, si corresponde al 10% doy puntos al estudiante quien hizo el mensaje
		## 4. Evaluo el 15% de los que le han dado me encanta al mensaje, si corresponde al 10% doy puntos al estudiante quien hizo el mensaje
		## 5. Evaluo si ya tiene el 5% de los me gusta segun cantidad de estudiantes inscritos al curso, si no lo tiene doy puntos, si no, continua
		## 5. Evaluo si ya tiene el 10% de los me gusta segun cantidad de estudiantes inscritos al curso, si no lo tiene doy puntos, si no, continua
		## 5. Evaluo si ya tiene el 15% de los me gusta segun cantidad de estudiantes inscritos al curso, si no lo tiene doy puntos, si no, continua
		$total_estudiantes=$this->model_cursos->get_estudiantes_curso_count($post['id_cursos'],$this->config->item('estado_activo'));


		$_5ciento=round ( round ($total_estudiantes*5)/100 )."\n"; 
		$_10ciento=  round( round ($total_estudiantes*10)/100 )."\n"; 
		$_15ciento=  round( round ($total_estudiantes*15)/100 )."\n"; 
		$existe_puntos_var=0;

##despues de saber cuantos estudiantes promedio hay para cada evento (15%,10%,5%), empiezo a evaluar uno a uno si tiene esa cantidad igual para asignar puntos...
#echo count($megustas_estudiante)." : ".$_5ciento."\n\n";
		## si es igual a la cantidad requerida para dar puntos...
		if (count($megustas_estudiante)==$_5ciento && $if_borrado==0) {

			### valido que no tenga notificacion de ello

			##consulto si ya tengo los motivos con el estudiante del puntaje ganado por los me encanta

			$if_existe_noti_foro=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);

			if ($if_existe_noti_foro->id_usuarios==0 || $if_existe_noti_foro->id_usuarios=='') {
				#echo "vacio 5\n";
				$if_existe_noti_foro1=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);

				if ($if_existe_noti_foro1->id_usuarios==0 || $if_existe_noti_foro1->id_usuarios=='') {
					#echo "vacio 10\n";
					$if_existe_noti_foro2=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);

					if ($if_existe_noti_foro2->id_usuarios==0 || $if_existe_noti_foro2->id_usuarios=='') {
						#echo "vacio 15\n";
						
					}
					else {
						$existe_puntos_var=1;
						#echo "No vacio 5\n";
					}
				}

				else  {
					#echo "No vacio 10\n";
					$existe_puntos_var=1;
				}
			} 

			else {
				#echo "No vacio 15\n";
				$existe_puntos_var=1;
			}


			#echo $existe_puntos_var."\n";


			if ($existe_puntos_var==0) {

			#echo "Entro aqui 5%\n";
			###consulto si ya tengo éstos puntos del mensaje para no volverlo a agregar
				$if_mispuntos_ya=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('puntos_5_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje']);

				if ($if_mispuntos_ya->id_puntaje=='') {
					$resultado=$this->model_cursos->add_puntos ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('puntos_5_porciento_megusta_mensaje_foro'),$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades'],'',$post['id_actividades_mensaje']);
				##aqui guardar una notificacion al estudiante que se le ha dado puntos por la x cantidad de me gusta
					$data_notificaciones['id_usuarios']=$post['id_usuario_estudiante']; 
					$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_5_porciento_megusta_mensaje_foro')." puntos porque del 5% de la comunidad dió me encanta a tu participación en el foro ".$nombre__foro; 
					$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
					$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
					$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
					$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
					$data_notificaciones['id_actividades_barra']=$post['id_actividades']; 
					$data_notificaciones['id_cursos']= $post['id_cursos']; 
					$data_notificaciones['id_modulos']= $post['id_modulos']; 
				#Variable extra para no confundir las notificaciones cuando son varios mensajes en el mismo foro
					$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
					$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
					$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));
				}

			}


		}


#echo count($megustas_estudiante)." : ".$_10ciento."\n\n";

		## si es igual a la cantidad requerida para dar puntos...
		if (count($megustas_estudiante)==$_10ciento && $if_borrado==0) {

			$existe_puntos_var=0;
			$if_existe_noti_foro=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
			if ($if_existe_noti_foro->id_usuarios==0 || $if_existe_noti_foro->id_usuarios=='') {
				#echo "vacio 5\n";
				$if_existe_noti_foro1=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
				if ($if_existe_noti_foro1->id_usuarios==0 || $if_existe_noti_foro1->id_usuarios=='') {
					#echo "vacio 10\n";
					$if_existe_noti_foro2=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
					if ($if_existe_noti_foro2->id_usuarios==0 || $if_existe_noti_foro2->id_usuarios=='') {
						#echo "vacio 15\n";
					}
					else {
						$existe_puntos_var=1;
						#echo "No vacio 5\n";
					}
				}

				else  {
					#echo "No vacio 10\n";
					$existe_puntos_var=1;
				}
			} 

			else {
				#echo "No vacio 15\n";
				$existe_puntos_var=1;
			}








			#echo "Entro aqui 10%\n";
			###consulto si ya tengo éstos puntos del mensaje para no volverlo a agregar
			$if_mispuntos_ya=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje']);

			if ($if_mispuntos_ya->id_puntaje=='')  {

				##consulto si ya habia ganado el de $_5ciento, de ser asi actualizo puntaje y notificación, de lo contrario lo agrego como nuevo.
				$if_mispuntos=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje']);

				### si ya tengo los puntos de la opcion anterior, actualizo esos puntos y su respectiva notificacion
				if ($if_mispuntos->id_puntaje!='')
				{
					$data_puntos_update=array('puntaje'=>$this->config->item('puntos_10_porciento_megusta_mensaje_foro'),
						'id_motivos'=>$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),
						'id_estados'=>$this->config->item('estado_activo'),'id_usuarios'=>$post['id_usuario_estudiante'],
						'fecha_modificado'=>date('Y-m-d H:i:s',time()));

					$resultado=$this->model_cursos->update_puntos ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje'],$data_puntos_update) ;

      				#### consulto si ya tengo la notificacion de la actividad actual
					$minotificacion=$this->model_cursos->get_notificacion_usuario_curso ($post['id_cursos'],$post['id_modulos'],$post['id_actividades'],$post['id_usuario_estudiante'],$post['id_actividades_mensaje']);

					##aqui actualizar la notificacion al estudiante que se le ha dado puntos por la x cantidad de me gusta (si la borró, la crea, de lo contrario la actualiza)
					$data_notificaciones['id_usuarios']=$post['id_usuario_estudiante']; 
					$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_10_porciento_megusta_mensaje_foro')." puntos porque del 10% de la comunidad dió me encanta a tu participación en el foro ".$nombre__foro; 
					$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
					$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
					$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
					$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
					$data_notificaciones['id_actividades_barra']=$post['id_actividades']; 
					$data_notificaciones['id_cursos']= $post['id_cursos']; 
					$data_notificaciones['id_modulos']= $post['id_modulos']; 
					#Variable extra para no confundir las notificaciones cuando son varios mensajes en el mismo foro
					$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
					$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
					
					### AQUI VALIDAR SI YA TIENE EL MENSAJE DE NOTIFICACION, SI LO TIENE LO ACTUALIZA
					$dataupmensaje['id_estados']=$this->config->item('estado_no_leido');
					$dataupmensaje['mensaje']=$data_notificaciones['mensaje'];


					##consulto si existe la notificacion del estudiante realizado en el mensaje del foro, si no existe lo insertamos, de lo conttrario lo actualizamos
					$if_existe_noti_foro=$this->model_cursos->if_noti_foro_est($post['id_usuario_estudiante'],@$minotificacion->variable_extra);
					if ($if_existe_noti_foro==0) {
						$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));
					} else {
						$resultado=$this->model_cursos->update_notificacion(@$minotificacion->variable_extra,$post['id_usuario_estudiante'],$dataupmensaje);
					}
					#$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',@$minotificacion->id_notificaciones));


			} ## fin si es diferente de nada

			#de lo contrario, lo agrego como nuevo
			else {
				if ($existe_puntos_var==0) {
					$resultado=$this->model_cursos->add_puntos ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('puntos_10_porciento_megusta_mensaje_foro'),$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades'],'',$post['id_actividades_mensaje']);
				}

				##aqui guardar una notificacion al estudiante que se le ha dado puntos por la x cantidad de me gusta
				$data_notificaciones['id_usuarios']=$post['id_usuario_estudiante']; 
				$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_10_porciento_megusta_mensaje_foro')." puntos porque del 10% de la comunidad dió me encanta a tu participación en el foro ".$nombre__foro; 
				$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
				$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
				$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
				$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
				$data_notificaciones['id_actividades_barra']=$post['id_actividades']; 
				$data_notificaciones['id_cursos']= $post['id_cursos']; 
				$data_notificaciones['id_modulos']= $post['id_modulos']; 
				#Variable extra para no confundir las notificaciones cuando son varios mensajes en el mismo foro
				$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
				$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

				### AQUI VALIDAR SI YA TIENE EL MENSAJE DE NOTIFICACION, SI LO TIENE LO ACTUALIZA
				if ($existe_puntos_var==0) {
					$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));
				}
			}	##fin else	


}  ## fin si ya tengo los puntos de ésta opción















}  ## fin si mi premio es de 10 por ciento


#echo count($megustas_estudiante)." : ".$_15ciento."\n\n";


		## si es igual a la cantidad requerida para dar puntos...
if (count($megustas_estudiante)==$_15ciento && $if_borrado==0) {
#echo "Entro aqui 15%\n";

	$existe_puntos_var=0;
	$if_existe_noti_foro=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
	if ($if_existe_noti_foro->id_usuarios==0 || $if_existe_noti_foro->id_usuarios=='') {
		#echo "vacio 5\n";
		$if_existe_noti_foro1=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
		if ($if_existe_noti_foro1->id_usuarios==0 || $if_existe_noti_foro1->id_usuarios=='') {
			#echo "vacio 10\n";
			$if_existe_noti_foro2=$this->model_cursos->get_punto_var_extra ($post['id_usuario_estudiante'],$post['id_cursos'],$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),$post['id_actividades_mensaje']);
			if ($if_existe_noti_foro2->id_usuarios==0 || $if_existe_noti_foro2->id_usuarios=='') {
				#echo "vacio 15\n";
			}
			else {
				$existe_puntos_var=1;
				#echo "No vacio 5\n";
			}
		}
		else  {
			#echo "No vacio 10\n";
			$existe_puntos_var=1;
		}
	} 

	else {
		#echo "No vacio 15\n";
		$existe_puntos_var=1;
	}










	###consulto si ya tengo éstos puntos del mensaje para no volverlo a agregar
	$if_mispuntos_ya=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje']);

	if ($if_mispuntos_ya->id_puntaje=='') {

#echo "YUCA_15\n";
	##consulto si ya habia ganado el de $_5ciento, de ser asi actualizo puntaje y notificación, de lo contrario lo agrego como nuevo.
		$if_mispuntos=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades']);

		if ($if_mispuntos->id_puntaje=='')  {
			$if_mispuntos=$this->model_cursos->get_mispuntos_usuario ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_5_porciento_megusta_mensaje_foro'),$post['id_actividades']);
		}




			### si ya tengo los puntos de la opcion anterior, actualizo esos puntos y su respectiva notificacion
		if ($if_mispuntos->id_puntaje!='')
		{

			$data_puntos_update=array('puntaje'=>$this->config->item('puntos_15_porciento_megusta_mensaje_foro'),
				'id_motivos'=>$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),
				'id_estados'=>$this->config->item('estado_activo'),'id_usuarios'=>$post['id_usuario_estudiante'],
				'fecha_modificado'=>date('Y-m-d H:i:s',time()));

						##actualizo los puntos que me dieron por la opcion anterior
			$resultado=$this->model_cursos->update_puntos ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('motivo_10_porciento_megusta_mensaje_foro'),$post['id_actividades'],$post['id_actividades_mensaje'],$data_puntos_update) ;

      					 #### consulto si ya tengo la notificacion de la actividad actual (puede tener varias por multiples mensajes)
			$minotificacion=$this->model_cursos->get_notificacion_usuario_curso ($post['id_cursos'],$post['id_modulos'],$post['id_actividades'],$post['id_usuario_estudiante'],$post['id_actividades_mensaje']);

						##aqui actualizar la notificacion al estudiante que se le ha dado puntos por la x cantidad de me gusta (si la borró, la crea, de lo contrario la actualiza)
			$data_notificaciones['id_usuarios']=$post['id_usuario_estudiante']; 
			$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_15_porciento_megusta_mensaje_foro')." puntos porque del 15% de la comunidad dió me encanta a tu participación en el foro ".$nombre__foro;
			$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
			$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
			$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_notificaciones['id_actividades_barra']=$post['id_actividades']; 
			$data_notificaciones['id_cursos']= $post['id_cursos']; 
			$data_notificaciones['id_modulos']= $post['id_modulos']; 
						#Variable extra para no confundir las notificaciones cuando son varios mensajes en el mismo foro
			$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
			$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

			### AQUI VALIDAR SI YA TIENE EL MENSAJE DE NOTIFICACION, SI LO TIENE LO ACTUALIZA
			$dataupmensaje['id_estados']=$this->config->item('estado_no_leido');
			$dataupmensaje['mensaje']=$data_notificaciones['mensaje'];


					##consulto si existe la notificacion del estudiante realizado en el mensaje del foro, si no existe lo insertamos, de lo conttrario lo actualizamos
			$if_existe_noti_foro=$this->model_cursos->if_noti_foro_est($post['id_usuario_estudiante'],@$minotificacion->variable_extra);
			if ($if_existe_noti_foro==0) {
				$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));
			} else {
				$resultado=$this->model_cursos->update_notificacion(@$minotificacion->variable_extra,$post['id_usuario_estudiante'],$dataupmensaje);
			#$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',@$minotificacion->id_notificaciones));
			}

		}  ### fin si existe en el sistema para actualizarlo

					#de lo contrario, lo agrego como nuevo
		else {
			if ($existe_puntos_var==0) {
				$resultado=$this->model_cursos->add_puntos ($post['id_cursos'],$post['id_modulos'],$post['id_usuario_estudiante'],$this->config->item('puntos_15_porciento_megusta_mensaje_foro'),$this->config->item('motivo_15_porciento_megusta_mensaje_foro'),$post['id_actividades'],'',$post['id_actividades_mensaje']);
			}
			##aqui guardar una notificacion al estudiante que se le ha dado puntos por la x cantidad de me gusta
			$data_notificaciones['id_usuarios']=$post['id_usuario_estudiante']; 
			$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_15_porciento_megusta_mensaje_foro')." puntos por tu mensaje en el foro de ".$nombre__foro; 
			$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
			$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
			$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_notificaciones['id_actividades_barra']=$post['id_actividades']; 
			$data_notificaciones['id_cursos']= $post['id_cursos']; 
			$data_notificaciones['id_modulos']= $post['id_modulos']; 
			#Variable extra para no confundir las notificaciones cuando son varios mensajes en el mismo foro
			$data_notificaciones['variable_extra']= $post['id_actividades_mensaje']; 
			$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 


			### AQUI VALIDAR SI YA TIENE EL MENSAJE DE NOTIFICACION, SI LO TIENE LO ACTUALIZA
			$dataupmensaje['id_estados']=$this->config->item('estado_no_leido');
			$dataupmensaje['mensaje']=$data_notificaciones['mensaje'];
			#$resultado=$this->model_cursos->update_notificacion(@$minotificacion->variable_extra,$post['id_usuario_estudiante'],$dataupmensaje);

			if ($existe_puntos_var==0) {
				$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));
			}
		}  ## fin si no lo tiene para agregarlo como nuevo


} ## fin si ya tengo esta opcion de puntaje del mensaje de me encanta del usuario



}  ## fin si entro en la opción de más del 15 por ciento de me encanta de la comunidad


		###### pasos para dar puntaje al mensaje de los que tenga me gusta: #########################################


##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
$notificaciones_count=$this->model_generico->get_notificaciones_count ($this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('estado_no_leido'));

##funcion para cargar los puntos actuales que tengo en ese preciso momento
$mis_puntos_actuales_curso_actual_curs=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_cursos']);
$tmpcpy=$mis_puntos_actuales_curso_actual_curs[0];


#exit;
		#muestro la cantidad de me gusta del estudiante
echo count($megustas_estudiante)."|".$notificaciones_count."|".$tmpcpy->puntaje;

		##actualizo la posicion del mensaje del foro por la cantidad de me gusta que se tenga
$this->model_cursos->update_pos_mensaje($post['id_actividades_mensaje'],count($megustas_estudiante));



}

}






public function enviar_pregunta () {

	$post=$this->input->post('data');

	echo $post['pregunta'];

#envio mensaje al docente
#envio_correo($array_claves,$this->input->post ('correo'),$this->input->post ('nombres').' '.$this->input->post ('apellidos') ,$configuracion->correo_contacto,"Nuevo registro por formulario en ".$configuracion->nombre_sistema,$configuracion->nombre_contacto,site_url()."email_templates/notificacion_plantilla_bienvenido_estudiante_registro.html",$this);



}



##funcion para poner en visto la actividad
public function set_visto ($id_cursos,$id_modulos,$id_actividades_barra) {
	$this->load->model('model_cursos');

	$if_modulo_visto=$this->model_cursos->get_modulo_visto ($id_cursos,$id_modulos,$id_actividades_barra,$this->encrypt->decode($this->session->userdata('id_usuario'))    );
	if (count($if_modulo_visto)==0)  {
		$if_modulos_vistos=$this->model_cursos->insertar_modulo_visto ($id_cursos,$id_modulos,$id_actividades_barra,$this->encrypt->decode($this->session->userdata('id_usuario')));
	}
	echo $id_actividades_barra;
}

##funcion para poner en puntos
public function set_puntos ($id_cursos,$id_modulos,$id_motivos,$puntos,$id_actividades_barra=null) {
	$this->load->model('model_cursos');
	$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$puntos,$id_motivos,$id_actividades_barra);



}

##funcion para actualizar el listado de notificaciones del usuario en el momento de dar me gusta al mensaje el foro del estudiante.
public function get_notificaciones_ajax () {

	$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
	$notificaciones=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
	$notificaciones_count=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

	$html='';
	$meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"); 
	foreach ($notificaciones as $noti_key => $noti_value): 

		$datetime=explode (" ",$noti_value->fecha_creado);
	$fecha=explode ("-",$datetime[0]);


	$html.='<li class="clear">';
	$html.='<div class="not_col1">';
	$html.='</div>';
	$html.='<div class="not_col2">';
	$html.='<a target="_blank" href="'.base_url().'notificaciones/'.$noti_value->id_notificaciones.'">';
	$html.='<h5>'.substr($noti_value->mensaje, 0, 35)."...".'</h5>';
	$html.='<h6> '.$meses[$fecha[1]].' '.$fecha[2].', '.$datetime[1].'</h6>';
	$html.='</a>';
	$html.='</div>';
	$html.='</li>';

	endforeach; 


	echo $html."|".$notificaciones_count;

}



##funcion para poner en puntos por la actividad de pregunta rapida y guardo la respuesta de esa persona
public function set_puntos_pregunta_rapida ($id_cursos,$id_modulos,$id_motivos,$puntos,$id_actividades_barra=null) {
	$this->load->model('model_cursos');
	$post=$this->input->post('data');	

	$resultado=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$puntos,$id_motivos,$id_actividades_barra);

	#si no es clickeado por segunda vez... guardo mi respuesta de la pregunta rapida
	if ($resultado!='error') {

	##guardo respuesta del usuario
		if ($id_actividades_barra) {
			$tmp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$id_actividades_barra));
			$id_actividades=$tmp->id_actividades;

			## si tiene pregunta rapida, la guardo
			if ($post['respuesta']!='nadita') {
				$this->model_cursos->add_respuesta ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')),$post['respuesta'],$post['tipo_pregunta']);
			}
		}	
	}
	echo $resultado;
}



##funcion para poner en puntos por la evaluacion y guardo las respuestas de esa persona (maximo_puntos_evaluacion)
public function set_puntos_pregunta_rapida_ev ($id_cursos,$id_modulos,$id_motivos,$puntos,$id_actividades_barra=null) {
	$this->load->model('model_cursos');
	$post=$this->input->post('data');	

	$respuestas=array();
	foreach ($post['respuesta'] as $key => $value) {
		$respuestas[$key+1]=$value;
	}


##evaluo puntaje y grafica!

	$resultados=array();


	$maximo_puntos=$this->config->item('maximo_puntos_evaluacion');

	$preguntaxpunto=$maximo_puntos/count($respuestas);

	$seleccionadas=0;



	foreach ($respuestas as $key => $value) {


		switch ($value['tipo_pregunta']) {
			case $this->config->item('pregunta_tipo_test'):
			$correctas=0;	

			foreach ($value['variables_respuesta'] as $skey => $svalue) {
				if ($svalue['correcta']==1) {
					$correctas++;	
				}
			}
##son checkbox
			if ($correctas>1) {

				$promedio_puntos=0;
				##divido el punto que equivale a una pregunta por la cantidad de posibles respuestas correctas
				$promedioxpunto=$preguntaxpunto/$correctas;
				$total_puntos_chk=0;
				$resultados[$key]['estado']="checkbox";
				foreach ($value['variables_respuesta'] as $skey => $svalue) {
				##si respondio bien
					$total_puntos_chk++;
					if ($svalue['correcta']==1 && $svalue['seleccionada']==1) {

						$promedio_puntos+=$promedioxpunto;	
						$resultados[$key]['sub_estado'][$skey]="bien";

						$resultados[$key]['retro'][$skey]=$svalue['retroalimentacion'];
						$resultados[$key]['opcion'][$skey]=$svalue['opcion'];

					}
					#si esta mal
					else {
						if ($svalue['seleccionada']==1)  {
							$promedio_puntos-=$promedioxpunto;	
							$resultados[$key]['sub_estado'][$skey]="mal";
							$resultados[$key]['retro'][$skey]=$svalue['retroalimentacion'];
							$resultados[$key]['opcion'][$skey]=$svalue['opcion'];
						}
					}

					$resultados[$key]['pregunta']=$value['pregunta'];
					$resultados[$key]['id_competencias']=$value['id_competencias'];

					if ($promedio_puntos<0) { $promedio_puntos=0; }
					$resultados[$key]['puntos']=$promedio_puntos;

				}




			}

#son radios
			else {

				foreach ($value['variables_respuesta'] as $skey => $svalue) {
				##si respondio bien


					if ($svalue['correcta']==1 && $svalue['seleccionada']==1) {
						$resultados[$key]['pregunta']=$value['pregunta'];
						$resultados[$key]['id_competencias']=$value['id_competencias'];
						$resultados[$key]['puntos']=$preguntaxpunto;
						$resultados[$key]['opcion']=$svalue['opcion'];
						$resultados[$key]['retro']=$svalue['retroalimentacion'];
						$resultados[$key]['estado']="bien";
						break;
					}

					#si esta mal

					else {
						$resultados[$key]['pregunta']=$value['pregunta'];
						$resultados[$key]['id_competencias']=$value['id_competencias'];
						$resultados[$key]['puntos']=0;
						$resultados[$key]['opcion']=$svalue['opcion'];
						$resultados[$key]['retro']=$svalue['retroalimentacion'];
						$resultados[$key]['estado']="mal";
					}


				}

			}


			break;


			case $this->config->item('pregunta_elegir_de_una_lista'):


			foreach ($value['variables_respuesta'] as $skey => $svalue) {
				##si respondio bien
				if ($svalue['correcta']==1 && $svalue['seleccionada']==1) {
					$resultados[$key]['pregunta']=$value['pregunta'];
					$resultados[$key]['id_competencias']=$value['id_competencias'];
					$resultados[$key]['puntos']=$preguntaxpunto;
					$resultados[$key]['opcion']=$svalue['opcion'];
					$resultados[$key]['retro']=$svalue['retroalimentacion'];
					$resultados[$key]['estado']="bien";
					break;
				}
					#si esta mal
				else {
					$resultados[$key]['pregunta']=$value['pregunta'];
					$resultados[$key]['id_competencias']=$value['id_competencias'];
					$resultados[$key]['puntos']=0;
					$resultados[$key]['opcion']=$svalue['opcion'];
					$resultados[$key]['retro']=$svalue['retroalimentacion'];
					$resultados[$key]['estado']="mal";
				}


			}


			break;

			case $this->config->item('pregunta_campo_de_texto'):


			foreach ($value['variables_respuesta'] as $skey => $svalue) {
				##si respondio bien
				$resultados[$key]['pregunta']=$value['pregunta'];
				$resultados[$key]['id_competencias']=$value['id_competencias'];
				$resultados[$key]['puntos']=$preguntaxpunto;
				$resultados[$key]['opcion']=$svalue['respuesta'];
				$resultados[$key]['retro']=$svalue['retroalimentacion'];
				$resultados[$key]['estado']="bien";
			}


			break;



		}





	}




	#echo "====================\n";
	#print_r($resultados);
	#echo "====================\n";
	#	exit;
	$total_puntos=0;
	$barra=100;
	$lis="";
	$barra_lis="";
	$barra_compe=array();
	$barra_compe_total=array();




	foreach ($resultados as $key_resultados => $value_resultados) {

## si es tipo checkbox podria tener varias respuestas
		if ($value_resultados['estado']=='checkbox') {

			foreach ($value_resultados['retro'] as $chkkey => $chkvalue) {

				$lis.='<p class="'.$value_resultados['sub_estado'][$chkkey].'">'.$key_resultados.' - '.$value_resultados['pregunta'].':  <b>'.str_replace("-", " ", $value_resultados['opcion'][$chkkey]).'</b></p><div class="retro"><span>'.$value_resultados['retro'][$chkkey].'</span> </div>';	


				if ($value_resultados['sub_estado'][$chkkey]=="bien") {
					if ($value_resultados['id_competencias']!='') {
						$barra_compe[$value_resultados['id_competencias']]+=1;	
						$barra_compe_total[$value_resultados['id_competencias']]++;	
					}
				}
				else {
					if ($value_resultados['id_competencias']!='') {
						$barra_compe[$value_resultados['id_competencias']]-=0;	
						$barra_compe_total[$value_resultados['id_competencias']]++;	
					}
				}




			}




		}  ##fin si es checkbox


		else {

			$lis.='<p class="'.$value_resultados['estado'].'">'.$key_resultados.' - '.$value_resultados['pregunta'].': <b>'.str_replace("-", " ", $value_resultados['opcion']).'</b> </p><div class="retro"><span>'.$value_resultados['retro'].'</span> </div>';	

			if ($value_resultados['estado']=="bien") {
				if ($value_resultados['id_competencias']!='') {
					$barra_compe[$value_resultados['id_competencias']]+=1;	
					$barra_compe_total[$value_resultados['id_competencias']]++;	
				}
			}
			else {
				if ($value_resultados['id_competencias']!='') {
					$barra_compe[$value_resultados['id_competencias']]-=0;	
					$barra_compe_total[$value_resultados['id_competencias']]++;	
				}
			}

			


		}  ## fin si no es checkbox


		$total_puntos=$total_puntos+$value_resultados['puntos'];


	}





	foreach ($barra_compe  as $key_c => $value_c) {
		$porpunto=0;
		if ($value_c>0) {
			$porpunto=($barra/$barra_compe_total[$key_c]);

		}

		$tmp_compex=$this->model_cursos->get_compe($key_c);

		if ($value_c>0) {
			$pt=@($porpunto*$value_c);
		}
		else {
			$pt=0;	
		}
		##si no tiene competencia, no agrego a la barra nada de nada.
		if ($tmp_compex->nombre!='') {
			$barra_lis.='<li><p style="border-top: '.($pt).'pt solid #5fcf80;" id="eva_50">'.$tmp_compex->nombre.'<br>'.round($pt).'%</p></li>';
		}

	}




	$resultado[0]="+".round($total_puntos)." puntos";
	$resultado[1]=$barra_lis;

	$resultado[2]=$lis;









#echo json_encode($respuestas);



##antes de actualizar puntos y preguntas, miro primero si ya habia echo el examen para ver si los puntos que me acabé de ganar son 
#mayores o menores para asi tomar la desición de actualizar o no.


#consulto el numero de oportunidades de un examen que yo haya realizado.


	
	$tmpp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$id_actividades_barra));
	$id_actividades=$tmpp->id_actividades;
	$tmp=$this->model_generico->detalle('actividades_evaluacion',array('id_actividades_evaluacion'=>$id_actividades));
	$num_oportunidades=trim($tmp->num_oportunidades);

	$oport['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario'));
	$oport['id_actividades_evaluacion']=$id_actividades;
	$oport['id_estados']=$this->config->item('estado_activo');
	$oport['fecha_creado']=date('Y-m-d H:i:s',time()); 
	$oport['fecha_modificado']=date('Y-m-d H:i:s',time());  
	$oport['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
	$oport['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

	$tmpifexamen=$this->model_cursos->get_if_examen($id_cursos,$id_modulos,$id_actividades_barra);
	#si ya he realizado el examen...
	if ($tmpifexamen->id_puntaje!='')  {
		##si el puntaje obtenido es mayor al que habia realizado antes...
		if ($tmpifexamen->puntaje < $total_puntos) {
			#### agrego los puntos del examen! (con opcion de actualizar si ya tiene puntos de esa actividad)
			$resultadop=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$total_puntos,$id_motivos,$id_actividades_barra,'update');	
		}

	}

#si no habia echo el examen antes, guardo mis puntos en el sistema de la evaluación realizada.
	else {
		$resultadop=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$total_puntos,$id_motivos,$id_actividades_barra,'update');	
	}

### guardo respuestas del examen del usuario

	##guardo respuesta del usuario
	if ($id_actividades_barra) {
		$tmp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$id_actividades_barra));
		$id_actividades=$tmp->id_actividades;
		
		## si ya he realizado el examen...
		if ($tmpifexamen->id_puntaje!='')  {
	##si tiene habilitado la opcion de limitar las oportunidades
			if ($num_oportunidades!='ilimitatu')  {	
					##si los puntos del examen anterior fué menor al examen actual...
				if ($tmpifexamen->puntaje < $total_puntos) {
					$this->model_cursos->add_respuesta ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')),json_encode($post['respuesta']),$post['tipo_pregunta'],'update');
				}
				else { ## si es mayor
				}

			}
			
			else { # si es ilimitado las oportunidades de evaluacion
				

				$this->model_cursos->add_respuesta ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')),json_encode($post['respuesta']),$post['tipo_pregunta'],'update');

			}



		}
		##si el examen lo realizo hasta ahora...
		else {

			$this->model_cursos->add_respuesta ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$this->encrypt->decode($this->session->userdata('id_usuario')),json_encode($post['respuesta']),$post['tipo_pregunta'],'update');
		}
	}	



	if ($num_oportunidades!='ilimitatu')  {	
		##guardo la oportunidad de hacer el examen 
		$id_actividades_evaluacion_oportunidades=$this->model_generico->guardar('actividades_evaluacion_oportunidades',$oport,'id_actividades_evaluacion_oportunidades',array('id_actividades_evaluacion_oportunidades',''));
	}

	$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
	$tmp=$mis_puntos_actuales_curso_actual[0];
	$data['mis_puntos_actuales_curso_actual']=$tmp->puntaje;
	echo $resultado[0]."|".$resultado[1]."|".$resultado[2]."|".($data['mis_puntos_actuales_curso_actual']);


}


## funcion para obtener por ajax las oportundidades que tengo con la evaluacion actual y las restantes para evaluar si puedo o no volver a realizar el examen.
public function get_oportunidades_ev ($id_actividades_barra) {
	$this->load->model('model_cursos');

#consulto el numero de oportunidades de un examen que yo haya realizado.
	$tmp=$this->model_generico->detalle('actividades_barra',array('id_actividades_barra'=>$id_actividades_barra));
	$id_actividades_evaluacion=$tmp->id_actividades;
	$tmp=$this->model_generico->detalle('actividades_evaluacion',array('id_actividades_evaluacion'=>$id_actividades_evaluacion));
	$num_oportunidades=trim($tmp->num_oportunidades);

#consulto las veces que he realizado el examen.
	$num_realizados=$this->model_cursos->get_oportunidades_count($id_actividades_evaluacion,$this->encrypt->decode($this->session->userdata('id_usuario')));

	echo $num_oportunidades."|".$num_realizados;

}

##funcion para obtener un premio sorpresa de forma aleatoria, lo inserto de una vez y marco como ya premio asignado en el modulo del curso
public function caja_sorpresa ($id_cursos,$id_modulos,$id_actividades_barra) {


	$this->load->model('model_cursos');

##consulto cuantos premios aleatorios tengo y definir cuales no debe volver a aparecer  (no repetir el mismo video, foro o logro)....

	$mis_premios_ganados_sorpresa=$this->model_cursos->get_recompensas_curso_usuarios($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);

	$blacklist_video=array();
	$blacklist_foro=array();
	$blacklist_logro=array();
	$id_tipos_premios=array();
	$blacklist=array();

	## agrego a lista negra todo premio que sea diferente de puntos (video,foro y logro)
	foreach ($mis_premios_ganados_sorpresa as $mis_premios_ganados_sorpresa_key => $mis_premios_ganados_sorpresa_value) {
		if ($mis_premios_ganados_sorpresa_value->id_tipos_premio!=$this->config->item('tipos_premio_puntos'))  {
			$blacklist[]=$mis_premios_ganados_sorpresa_value->id_recompensas_aleatorias;
		}
	}

#consulto si ya tengo premio en este modulo y en este curso...
	$if_mipremio_sorpresa=$this->model_cursos->get_if_premio_sorpresa($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')));

#print_r ($blacklist); exit;
#echo $id_cursos.":".$id_modulos.":".$id_actividades_barra;
#exit;



	if (!$if_mipremio_sorpresa)  {
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data['id_cursos']=$id_cursos;
		$data['id_modulos']=$id_modulos;

		##obtengo los valores de mi premio sorpresa de forma aleatoria
		$mipremio_sorpresa=$this->model_cursos->get_premio_sorpresa($blacklist);


		$data['id_recompensas_aleatorias']=$mipremio_sorpresa->id_recompensas_aleatorias;
		##asigno mi premio sorpresa en la tabla y muestro mi premio en pantalla

		$curso_info=$this->model_cursos->get_curso($id_cursos);

		#si el premio son de puntos...
		if ($mipremio_sorpresa->puntos!='0') {
			$data['valor']=$mipremio_sorpresa->puntos;
			$data['id_tipos_premio']=$this->config->item('tipos_premio_puntos');
			$data['id_estados']=$this->config->item('estado_utilizado');  ## estado utilizado del premio (cuando son puntos, se utiliza de forma inmediata)
			$data3['valor']=$mipremio_sorpresa->puntos;   ### para mostrar en el efecto de caja sorpresa!
			$data3['imagen']="html/site/img/icono_8.png";  ### para mostrar en el efecto de caja sorpresa!
			$data3['id_tipos_premio']=$this->config->item('tipos_premio_puntos');  ### para mostrar en el efecto de caja sorpresa!
			

			#Agrego puntos por obtener este premio
			$resultado=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$mipremio_sorpresa->puntos,$this->config->item('motivo_puntos_ganar_premio_sorpresa'),'','');

			$data3['mensaje']=" ".$mipremio_sorpresa->puntos." puntos";
			
			$data3['fblink']= 'http://www.facebook.com/sharer.php?u='.base_url().'mipremio/'.base64_encode("¡Amigos! he ganado ".$mipremio_sorpresa->puntos." puntos, en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			#$data3['twlink']= base_url().'mipremio/'.base64_encode($mipremio_sorpresa->puntos."¡Amigos! he ganado ".$mipremio_sorpresa->puntos." puntos, en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			$data3['twlink']= 'https://twitter.com/intent/tweet?text=¡Amigos! he ganado '.$mipremio_sorpresa->puntos.' puntos, en mi curso online de '.$curso_info->titulo.'. :)&url='.base_url().'&hashtags=VL';
			##https://twitter.com/intent/tweet?text=PUT TEXT HERE &url=https://www.google.com&hashtags=android



}


		#si el premio es de video...
if ($mipremio_sorpresa->id_actividades_videos!='0') {
			$data['id_estados']=$this->config->item('estado_utilizado');  ## tengo un video activo y utilizado en el curso para verlo cuando yo quiera  
			$data['id_tipos_premio']=$this->config->item('tipos_premio_video');
			$data['valor']=$mipremio_sorpresa->id_actividades_videos;

			#consulto el video para saber el nombre y mostrarlo en pantalla del efecto de la caja sorpresa
			$tmp=$this->model_generico->detalle('actividades_videos',array('id_actividades_videos'=>$mipremio_sorpresa->id_actividades_videos));

			## inserto el video entre mis videos ganados para verlos y activar el modulo de premios del curso actual
			$data2['id_actividades_videos']=$mipremio_sorpresa->id_actividades_videos;
			$data2['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario'));
			$data2['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data2['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
			$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data2['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
			$data2['id_cursos']=$id_cursos;
			$data2['id_modulos']=$id_modulos;
			$data2['id_estados']=$this->config->item('estado_activo');
			
			$id_actividades_videos_usuarios=$this->model_generico->guardar('actividades_videos_usuarios',$data2,'id_actividades_videos_usuarios',array('id_actividades_videos_usuarios',''));


			$data3['valor']=$mipremio_sorpresa->id_actividades_videos;   ### para mostrar en el efecto de caja sorpresa!
			$data3['imagen']="html/site/img/icono_8.png";  ### para mostrar en el efecto de caja sorpresa!
			$data3['id_tipos_premio']=$this->config->item('tipos_premio_video');  ### para mostrar en el efecto de caja sorpresa!
			$data3['mensaje']=" el privilegio de ver el video ".$tmp->nombre_actividad."";
			$data3['fblink']= 'http://www.facebook.com/sharer.php?u='.base_url().'mipremio/'.base64_encode("¡Amigos! he ganado el privilegio de ver el video ".$tmp->nombre_actividad." , en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			#$data3['twlink']= base_url().'mipremio/'.base64_encode("¡Amigos! he ganado el privilegio de ver el video ".$tmp->nombre_actividad." , en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			$data3['twlink']= 'https://twitter.com/intent/tweet?text=¡Amigos! he ganado el privilegio de ver el video '.$tmp->nombre_actividad.', en mi curso online de '.$curso_info->titulo.'. :)&url='.base_url()."&hashtags=VL";
			##https://twitter.com/intent/tweet?text=PUT TEXT HERE &url=https://www.google.com&hashtags=android

$data3['extra']="mostrar_video";	

}


		#si el premio es de crear un foro...
if ($mipremio_sorpresa->if_foro !='0') {
	$data['id_estados']=$this->config->item('estado_no_utilizado'); 
	$data['id_tipos_premio']=$this->config->item('tipos_premio_foro');
	$data['valor']=$mipremio_sorpresa->if_foro;


	$data2['if_foro']=$mipremio_sorpresa->if_foro;
	$data2['id_actividades_barra']=$id_actividades_barra;


	$data2['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario'));
	$data2['id_estados']=$this->config->item('estado_no_utilizado'); 
	$data2['fecha_modificado']=date('Y-m-d H:i:s',time());  
	$data2['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
	$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
	$data2['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
	$data2['id_cursos']=$id_cursos;
	$data2['id_modulos']=$id_modulos;

	#$id_logro=$this->model_generico->guardar('actividades_foro_usuarios',$data2,'id_actividades_foro_usuarios',array('id_actividades_foro_usuarios',''));
#sabado
			$data3['valor']=$mipremio_sorpresa->if_foro;   ### para mostrar en el efecto de caja sorpresa!
			$data3['imagen']="html/site/img/icono_8.png";  ### para mostrar en el efecto de caja sorpresa!
			$data3['id_tipos_premio']=$this->config->item('tipos_premio_foro');  ### para mostrar en el efecto de caja sorpresa!
			$data3['mensaje']=" la oportunidad de crear un foro de discusión en el curso ".$curso_info->titulo;
			$data3['fblink']= 'http://www.facebook.com/sharer.php?u='.base_url().'mipremio/'.base64_encode("¡Amigos! he ganado la oportunidad de crear un foro de discusión, en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			#$data3['twlink']= base_url().'mipremio/'.base64_encode("¡Amigos! he ganado la oportunidad de crear un foro de discusión, en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			$data3['twlink']= 'https://twitter.com/intent/tweet?text=¡Amigos! he ganado la oportunidad de crear un foro de discusión, en mi curso online de '.$curso_info->titulo.'. :)&url='.base_url().'&hashtags=VL';

$data3['extra']="mostrar_foro";	


}


		#si el premio es un logro...
if ($mipremio_sorpresa->id_logros!='0') {
			$data['id_estados']=$this->config->item('estado_utilizado');  ## se crea de forma inmediata el logro en el curso actual del estudiante y lo inserto en mi lista de logros también
			$data['id_tipos_premio']=$this->config->item('tipos_premio_logro');
			$data['valor']=$mipremio_sorpresa->id_logros;

			$data2['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data2['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
			$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data2['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
			$data2['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
			$data2['id_cursos']=$id_cursos;
			$data2['id_modulos']=$id_modulos;
			$data2['id_logros']=$mipremio_sorpresa->id_logros;
			$data2['id_estados']=$this->config->item('estado_utilizado');

			$id_logro=$this->model_generico->guardar('logros_usuarios',$data2,'id_logros_usuarios',array('id_logros_usuarios',''));



			##consulto la imagen de logro para mostrarlo en pantalla
			$tmp=$this->model_generico->detalle('logros',array('id_logros'=>$mipremio_sorpresa->id_logros));
			$data3['valor']=$mipremio_sorpresa->id_logros;   ### para mostrar en el efecto de caja sorpresa!
			$data3['imagen']="html/site/img/icono_8.png";  ### para mostrar en el efecto de caja sorpresa!
			$data3['id_tipos_premio']=$this->config->item('tipos_premio_logro');  ### para mostrar en el efecto de caja sorpresa!
			$data3['mensaje']=" la medalla de ".$tmp->nombre."";
			$data3['fblink']= 'http://www.facebook.com/sharer.php?u='.base_url().'mipremio/'.base64_encode("¡Amigos! he ganado la medalla de ".$tmp->nombre.", en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			#$data3['twlink']= base_url().'mipremio/'.base64_encode("¡Amigos! he ganado la medalla de ".$tmp->nombre.", en mi curso online de ".$curso_info->titulo.". Entren y aprendan todos :) #VL")."/".base64_encode(base_url().$data3['imagen']);
			$data3['twlink']= 'https://twitter.com/intent/tweet?text=¡Amigos! he ganado la medalla de '.$tmp->nombre.', en mi curso online de '.$curso_info->titulo.'. :)&url='.base_url().'&hashtags=VL';
			##https://twitter.com/intent/tweet?text=PUT TEXT HERE &url=https://www.google.com&hashtags=android


			#obtengo el listado de todos mis logros en el curso actual	
$mis_logros=$this->model_cursos->get_mislogros ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')));
$data3['extra']="";	

			## ahora empiezo a armar mi ciclo de logros
foreach ($mis_logros as $lkey => $lvalue) {
	$tmplogro=$this->model_cursos->get_logro($lvalue->id_logros);
	$data3['extra'].='<img alt="'.$tmplogro->nombre.'" width="55" src="uploads/logros/'.$tmplogro->foto.'">';	
}


}


			#### guardo los puntos por finalizar modulo
$resultado=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('puntos_finalizar_modulo'),$this->config->item('motivo_puntos_finalizar_modulo'),'','');
$data3['mensaje'].=", además ganaste ".$this->config->item('puntos_finalizar_modulo')." puntos extra por finalizar el modulo";


			####consulto puntos actuales con los puntos requeridos a cada nivel
$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);

$tmp=$mis_puntos_actuales_curso_actual[0];
$mis_puntos_actuales_curso_actual=$tmp->puntaje;
$tmp='';
			$niveldios=0; #3 para saber si ya superlo los puntos de campeon

			## nivel experto
			if ($mis_puntos_actuales_curso_actual < $this->config->item('requerido_experto'))     { 
				$estatus_proximo=$this->model_cursos->get_status ($this->config->item('Experto'));
				$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
			}

			else {

			## nivel campeon
				if ($mis_puntos_actuales_curso_actual < $this->config->item('requerido_campeon')) {
					$estatus_proximo=$this->model_cursos->get_status ($this->config->item('Campeon'));
					$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
				}


## ya subio a lo más alto
				else {
					$niveldios=1;
				}

			}

			if ($niveldios==1) {
				## no agrego nada ni hago nada para el mensaje
			}

			else {
				$data3['mensaje'].=", te faltan ".$minimo_faltante_a_otro_nivel." puntos para ser ".$estatus_proximo->nombre."";
			}	

			$data3['extra2']=$mis_puntos_actuales_curso_actual;	

#############################################################3









		#guardo mi premio sorpresa
			$id_premio_sorpresa=$this->model_generico->guardar('recompensas_aleatorias_usuarios',$data,'id_recompensas_aleatorias_usuarios',array('id_recompensas_aleatorias_usuarios',''));

		##muestro en pantalla cada valor para hacer el efecto de la caja sorpresa
			echo $data3['id_tipos_premio']."|".$data3['valor']."|".$data3['imagen']."|".$data3['mensaje']."|".$data3['fblink']."|".$data3['twlink']."|".$data3['extra']."|".$id_actividades_barra."|".$data3['extra2'];


		}

#si ya tengo premio, retorno error para continuar con el proceso
		else {

			echo "error";
			exit;

		}

	}


##funcion para dar puntos por compartir en facebook o twitter
	public function socialpoint ($id_cursos,$id_modulos,$social,$id_actividades_barra) {

		$this->load->model('model_cursos');
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data['id_cursos']=$id_cursos;
		$data['id_modulos']=$id_modulos;
		if ($social=='fblink') {

			$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_social')." puntos compartir en facebook."; 
			$resultado=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('puntos_social'),$this->config->item('motivo_puntos_fb'),'','');
		}
		else {
			$data_notificaciones['mensaje']="Has ganado ".$this->config->item('puntos_social')." puntos compartir en twitter."; 
			$resultado=$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('puntos_social'),$this->config->item('motivo_puntos_tw'),'','');
		}

		$data_notificaciones['id_estados']=$this->config->item('estado_no_leido'); 
		$data_notificaciones['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data_notificaciones['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data_notificaciones['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data_notificaciones['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data_notificaciones['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
		$data_notificaciones['id_actividades_barra']=$id_actividades_barra;
		$data_notificaciones['id_cursos']=$id_cursos;
		$data_notificaciones['id_modulos']=$id_modulos;


## si es diferente de error, inserto como una notificacion, consulto y retorno los valores de conteo de notificaciones y el listado
		if ($resultado!='error') {

##aqui guardar una notificacion al estudiante de los punto ganados por compartir
			$id_notificaciones=$this->model_generico->guardar('notificaciones',$data_notificaciones,'id_notificaciones',array('id_notificaciones',''));

##funcion para cargar el conteo de las notificaciones y el listado de notificaciones para cargarlas en ajax
			$notificaciones=$this->model_generico->get_notificaciones ($this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('estado_no_leido'),5);
			$notificaciones_count=$this->model_generico->get_notificaciones_count ($this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('estado_no_leido'));


			$meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

			$html1="";
			foreach ($notificaciones as $noti_key => $noti_value):

				$datetime=explode (" ",$noti_value->fecha_creado);
			$fecha=explode ("-",$datetime[0]);
			$html1.='<li class="clear">';
			$html1.='<div class="not_col1">';
			$html1.='</div>';
			$html1.='<div class="not_col2">';
			$html1.='<a target="_blank" href="'.base_url().'notificaciones/'.$noti_value->id_notificaciones.'">';
			$html1.='<h5>'.substr($noti_value->mensaje, 0, 35)."...".'</h5>';
			$html1.='<h6>'.$meses[$fecha[1]].' '.$fecha[2].', '.$datetime[1].'</h6>';
			$html1.='</a>';
			$html1.='</div>';
			$html1.='</li>';

			endforeach;

		##consulto mis puntos actuales para actualizarlo por ajax
			$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
			$tmp=$mis_puntos_actuales_curso_actual[0];
			$mis_puntos_actuales_curso_actual=$tmp->puntaje;


			echo $html1."|".$notificaciones_count."|".$mis_puntos_actuales_curso_actual;
		}

		else {
			echo $resultado;
		}

	}



	function get_puntos_actual_ajax($id_cursos) {
		$this->load->model('model_cursos');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
		$tmp=$mis_puntos_actuales_curso_actual[0];
		echo $tmp->puntaje;
	}


##funcion para saber si es primera actividad realizada
	public function if_first_actividad ($id_cursos,$id_modulos,$id_actividades_barra) {
		$this->load->model('model_cursos');

#consulto si ya tiene actividades vistas (mas de dos), si no... es porque es la primera actividad vista y doy puntos por eso, lo guardo con el motivo para dar control de ello.

		$if_mostrar_aviso_primera_actividad=$this->model_cursos->if_first_actividad($this->config->item('motivo_primera_actividad_realizada'),$id_cursos,$id_modulos,$id_actividades_barra,$this->encrypt->decode($this->session->userdata('id_usuario')));

## si es primera actividad (confirmado en la base de datos)
		if ($if_mostrar_aviso_primera_actividad==1) {

			$data['puntos_primera_actividad_realizada']=$this->config->item('puntos_primera_actividad_realizada');
			$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')),$this->config->item('puntos_primera_actividad_realizada'),$this->config->item('motivo_primera_actividad_realizada'),$id_actividades_barra,'');

		##puntos actuales en el curso actual (cuando es primera actividad vista, obvio debe pasar a Experto antes de Campeon)
			$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
			$tmp=$mis_puntos_actuales_curso_actual[0];
			$data['mis_puntos_actuales_curso_actual']=$tmp->puntaje;
			$tmp='';
			$data['estatus_proximo']=$this->model_cursos->get_status ($this->config->item('Experto'));
			$data['minimo_faltante_a_experto']=$data['estatus_proximo']->minimo_puntos-$data['mis_puntos_actuales_curso_actual'];
			echo $data['puntos_primera_actividad_realizada']."|".$data['minimo_faltante_a_experto']."|".$data['estatus_proximo']->nombre."|realizar la primera actividad|".$data['mis_puntos_actuales_curso_actual'];
		}

		else {
			echo "error";
		}

		exit;

	}



	public function getif_logro ($id_actividades_barra,$id_cursos,$id_modulos) {

		$this->load->model('model_cursos');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
## consulto por el numero de la actividad barra el id_actividad de la actividad correspondiente junto con la tabla que corresponda
## para saber si tiene o no asignado un logro, si lo tiene, consulto el id_logro para relacionarlo con mi listado de logros

		$id_logros_actividad=$this->model_cursos->get_id_actividad_con_tabla ($id_actividades_barra);

		if ($id_logros_actividad!='' && $id_logros_actividad!=0) {	

	### consulto primero si ya tengo dicho logro en mi cuenta del curso actual
			$milogro=$this->model_cursos->get_logro_usuario ($id_logros_actividad,$id_usuarios,$id_cursos);

			if ($milogro->id_logros_usuarios=='') {

		## si no la tengo consulto el logro para insertar y mostrarlo en pantalla

				$logro_ganado=$this->model_cursos->get_logro ($id_logros_actividad);

		## si no la tengo la inserto en mi listado de logros
				$data2['id_cursos']=$id_cursos;
				$data2['id_modulos']=$id_modulos;
				$data2['id_logros']=$id_logros_actividad;
				$data2['id_usuarios']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
				$data2['id_estados']=$this->config->item('estado_utilizado');
				$data2['fecha_creado']=date('Y-m-d H:i:s',time()); 
				$data2['fecha_modificado']=date('Y-m-d H:i:s',time());  
				$data2['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 
				$data2['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
				$id_logro=$this->model_generico->guardar('logros_usuarios',$data2,'id_logros_usuarios',array('id_logros_usuarios',''));

				echo "uploads/logros/".$logro_ganado->foto."|Ganaste la medalla de ".$logro_ganado->nombre.".";
			}

			else {
## si ya tengo el logro, muestro error
				echo "error";	
			}
		}


		else {
## si no tiene logro asignado a la actividad, muestro error
			echo "error";
		}



	}



### funcion para evaluar si el modulo anterior fué visto o no por medio del ajax
	public function if_visto_actividad_barra ($id_modulos) {

		$this->load->model('model_cursos');
		$if_datosmod=$this->model_cursos->get_mod_visto($id_modulos,$this->encrypt->decode($this->session->userdata('id_usuario')));


### si existe informacion , es porque ya fué visto
		if ($if_datosmod->id_modulos) 
		{
			echo "si";
		}	


		else {
			echo "no";
		}




	}





### funcion que se ejecuta para cambiar de estatus y mostrar mensaje en pantalla
	public function set_nuevostatus ($id_cursos,$id_estatus_proximo,$puntos_estatus_proximo) {

		$this->load->model('model_cursos');
		$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));
		$niveldios=0;

		$tmp_estatus_mio=$this->model_cursos->get_status_micurso ($id_usuarios,$id_cursos);


	## consulto mis puntos actuales en el sistema
		$mis_puntos_actuales_curso_actual=$this->model_cursos->get_puntos_totales_en_curso ($this->encrypt->decode($this->session->userdata('id_usuario')),$id_cursos);
		$tmp=$mis_puntos_actuales_curso_actual[0];
		$mis_puntos_actuales_curso_actual=$tmp->puntaje;

		## nivel experto ,valuo si realmente debo actualizar mi estatus a experto
		if ($mis_puntos_actuales_curso_actual >= $this->config->item('requerido_experto')  &&  $mis_puntos_actuales_curso_actual < $this->config->item('requerido_campeon'))  { 
		$estatus_actual=$this->model_cursos->get_status ($this->config->item('Experto'));  #obtengo el estatus ganado
		$estatus_proximo=$this->model_cursos->get_status ($this->config->item('Campeon'));  ## obtengo el proximo estatus
		$estatus_id=$this->config->item('Experto');  ## id del estatus actual
		$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
			#actualizo el estatus que tengo en ese momento.
		$this->model_cursos->update_estatus($id_cursos,$id_usuarios,$estatus_id);
		$mensaje="Has completado los puntos necesarios para ser un usuario ".$estatus_actual->nombre."  te falta ".$minimo_faltante_a_otro_nivel." puntos para ser ".$estatus_proximo->nombre.".<br>Ahora podrás disfrutar de <a target='_blank' href='http://virtualab.sem/Escala/explicacion'>estos beneficios</a>.";

	}

	else {
			## nivel campeon,valuo si realmente debo actualizar mi estatus a Campeon
		if ($mis_puntos_actuales_curso_actual >= $this->config->item('requerido_campeon')) {

			## consulto mi estatus actual del curso
			$id_estatus_actual_curso=$this->model_cursos->get_status_micurso ($id_usuarios,$id_cursos);

			## evaluo si tadavia no soy campeon
			if ($id_estatus_actual_curso->id_estatus!=$this->config->item('Campeon'))   {
				$estatus_actual=$this->model_cursos->get_status ($this->config->item('Campeon'));
				$estatus_id=$this->config->item('Campeon');
				$minimo_faltante_a_otro_nivel=$estatus_proximo->minimo_puntos-$mis_puntos_actuales_curso_actual;
				#actualizo el estatus que tengo en ese momento.
				$this->model_cursos->update_estatus($id_cursos,$id_usuarios,$estatus_id);
				$mensaje="Has completado los puntos necesarios para ser un usuario ".$estatus_actual->nombre.", ahora podrás disfrutar de <a target='_blank' href='http://virtualab.sem/Escala/explicacion'>estos beneficios</a>";
			}
			else {
				## muestro error para que no haga nada porque ya soy campeon, el maximo estatus del curso
				echo "error";
				exit;
			}
		}

		else {
			## ya subio a lo más alto
			if ($mis_puntos_actuales_curso_actual > $this->config->item('requerido_campeon')) {
				$niveldios=1;
			}
			## delo contrario soy nuevo y no he llegado al puntaje maximo para subir al estatus nuevo
			else {
				echo "error";
				exit;
			}
		}
	}




	$tmp_estatus_mio_ya=$this->model_cursos->get_status_micurso ($id_usuarios,$id_cursos);

	if ($estatus_actual->nombre && $tmp_estatus_mio->id_estatus!=$estatus_id) {
	## retorno esta cadena de datos para mostrarlos en pantalla de una forma correcta
		echo $estatus_proximo->nombre."|html/site/img/".$estatus_id.".png|".$minimo_faltante_a_otro_nivel."|".$estatus_proximo->minimo_puntos."|".$mensaje."|".$estatus_id."|".$niveldios."|".$tmp_estatus_mio_ya->id_estatus;
	}

	else {
		echo "error";
		exit;
	}


}

##pequeña funcion para el ajax , valida si puedo o no obtener el certificado, de paso lo guardo en mi listado de certificados para
##cargarlos en mi listado de certificados

public function validar_certificado ($id_cursos) {

	$this->load->model('model_cursos');
	$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));

##obtengo los modulos del curso actual (premium y estandar)
	$modulos_curso=$this->model_cursos->get_modulos_curso($id_cursos);


	$array_id_modulos=array();
	
	##obtengo mi plan del curso actual
	$miplan_curso_actual=$this->model_cursos->get_plan_curso($id_cursos,$id_usuarios);
	$miplan_curso_actual=$miplan_curso_actual->id_tipo_planes;

	foreach ($modulos_curso as $modulos_curso_key => $modulos_curso_value) {
		## si soy plan estandar...
		if ($this->config->item('Estandar')==$miplan_curso_actual)  {
			if ($modulos_curso_value->id_tipo_planes==$this->config->item('Estandar'))  {
				$array_id_modulos[]=$modulos_curso_value->id_modulos;
			}
		}

		##si soy premium
		if ($this->config->item('Premium')==$miplan_curso_actual)  {
			$array_id_modulos[]=$modulos_curso_value->id_modulos;
		}
	}

	##total modulos del curso (si soy premium o estandar)
	$total_modulos=count($array_id_modulos);




	##realizo la busqueda de los modulos realizados según id de todos los modulos del curso
	$modulos_curso_realizados=$this->model_cursos->get_modulos_curso_realizados($id_usuarios,$array_id_modulos);
	$total_modulos_realizados=count($modulos_curso_realizados);

	##comparo si tienen la misma cantidad de modulos, de lo contrario es porque no he terminado en su totalidad de modulos realizados

	if ($total_modulos==$total_modulos_realizados)  {
	##retorno verdadero si es posible generar el certificado

		#### guardo en mi listado de certificados para que lo pueda descargar.


		echo "true";
	}

	else {
	## si la cantidad de modulos vistos es mayor a la cantidad de modulos disponibles es porque ha pasado un error!
		if ($total_modulos<$total_modulos_realizados)  {
			echo "error_supremo:    ".$total_modulos." : ".$total_modulos_realizados;
			print_r($array_id_modulos);
		}

		else {
		### es porque la cantidad de modulos vistos es menor a la cantidad de modulos por realizar (no ha terminado el curso!)
			echo "error";
		}


	}



}


### funcion que se encarga de dar link de descarga del certificado validando que tenga todos los modulos realizados del curso actual
public function get_certificado ($id_cursos) {

	$this->load->model('model_cursos');
	$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));


##obtengo los modulos del curso actual 
	$modulos_curso=$this->model_cursos->get_modulos_curso($id_cursos);
##total modulos del curso
	$total_modulos=count($modulos_curso);




	$array_id_modulos=array();
	
	##obtengo mi plan del curso actual
	$miplan_curso_actual=$this->model_cursos->get_plan_curso($id_cursos,$id_usuarios);
	$miplan_curso_actual=$miplan_curso_actual->id_tipo_planes;

	foreach ($modulos_curso as $modulos_curso_key => $modulos_curso_value) {
		## si soy plan estandar...
		if ($this->config->item('Estandar')==$miplan_curso_actual)  {
			if ($modulos_curso_value->id_tipo_planes==$this->config->item('Estandar'))  {
				$array_id_modulos[]=$modulos_curso_value->id_modulos;
			}
		}

		##si soy premium
		if ($this->config->item('Premium')==$miplan_curso_actual)  {
			$array_id_modulos[]=$modulos_curso_value->id_modulos;
		}
	}

	##total modulos del curso (si soy premium o estandar)
	$total_modulos=count($array_id_modulos);



	##realizo la busqueda de los modulos realizados según id de todos los modulos del curso
	$modulos_curso_realizados=$this->model_cursos->get_modulos_curso_realizados($id_usuarios,$array_id_modulos);
	$total_modulos_realizados=count($modulos_curso_realizados);

	##comparo si tienen la misma cantidad de modulos, de lo contrario es porque no he terminado en su totalidad de modulos realizados

	if ($total_modulos==$total_modulos_realizados)  {

	### inserto la informacion del certificado para poderlo visualizar en el modulo perfil del usuario los certificados obtenidos


	## realizo la programacion del PDF a descargar, retornando una vista del certificado a realizar en formato PDF al vuelo

		############################  datos del estudiante para pasarlos al certificado #######################################
		$nombres=$this->encrypt->decode($this->session->userdata('nombres'));
		$apellidos=$this->encrypt->decode($this->session->userdata('apellidos'));	
		$identificacion=$this->encrypt->decode($this->session->userdata('identificacion'));	
		############################  datos del estudiante para pasarlos al certificado #######################################


		######################## consulto los datos del curso para pasarlos al certificado #####################################
		$mi_curso_actual=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));

		### variable que envia los datos para el certificado
		$data='';

		$this->gen_certificado ("certificado_curso_".$mi_curso_actual->titulo,$data);

	}



}





##funcion para generar el certificado del curso del usuario actual.
public function gen_certificado ($archivo,$data) {

	$this->load->model('model_cursos');
	$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));





	$pdfFilePath = FCPATH."/downloads/$archivo.pdf";

	ini_set('memory_limit','32M');
   $html=$this->load->view('prueba_certificado', $data,TRUE); // realizo un render con la información para mostrarla en pantalla


   $this->load->library('pdf');
   $this->pdf->fontpath = 'html/pdf/certificados/fonts/'; 

   $pdf = $this->pdf->load();
   # $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 

   $stylesheet = file_get_contents('html/pdf/certificados/style.css');
   $pdf->WriteHTML($stylesheet,1);
   $pdf->WriteHTML($html); 
   $pdf->Output($pdfFilePath, 'F'); 
 #$pdf->Output(); 
   
   if (file_exists($pdfFilePath)) {
   	header('Content-type: application/force-download');
   	header('Content-Disposition: attachment; filename='.$archivo.'.pdf');
   	readfile($pdfFilePath);

   }





}



## funcion para mostrar mis certificados que tengo actualmente
public function mis_certificados () {
	$this->load->model('model_cursos');
	##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
	$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
	$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
	$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
	$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
	$this->load->view('publico/view_mis_certificados',$data);
}



### doy puntos por terminar el curso (solo estandar)
public function set_puntos_curso ($id_cursos,$id_modulos) {
	$this->load->model('model_cursos');
	$id_usuarios=$this->encrypt->decode($this->session->userdata('id_usuario'));


	##obtengo mi plan del curso actual
	$miplan_curso_actual=$this->model_cursos->get_plan_curso($id_cursos,$id_usuarios);


## si es plan estandar...
	if ($miplan_curso_actual->id_tipo_planes==$this->config->item('Estandar'))
	{


		$if_ya_tiene_los_puntos=$this->model_cursos->get_punto($id_usuarios,$id_cursos,$this->config->item('motivo_puntos_terminar_curso_estandar'));
				##evaluo si ya se le dieron puntor por ese motivo


		if ($if_ya_tiene_los_puntos) { echo "error"; exit; }

				else { ## inserto los puntos ganados por terminar el curso
					$data['tiene_primer_curso']="si";
					$data['puntos_primer_curso_ganados']=$this->config->item('motivo_puntos_terminar_curso_estandar');
					$this->model_cursos->add_puntos ($id_cursos,$id_modulos,$id_usuarios,$this->config->item('puntos_terminar_curso_estandar'),$this->config->item('motivo_puntos_terminar_curso_estandar'));
				}

				echo $this->config->item('puntos_terminar_curso_estandar');

			}  ## fin si es plan estandar

			else {
				echo "error"; exit; ## no es estandar y no se le dá puntos
			}


		}





	}