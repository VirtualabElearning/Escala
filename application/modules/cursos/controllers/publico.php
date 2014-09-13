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







		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
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
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
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

		$mis_cursos= json_decode($this->encrypt->decode(  $this->session->userdata('cursos_asignados') )) ;

if ($mis_cursos) {
	
	foreach ($mis_cursos as $key => $value) {
			$data_mis_cursos=explode ("~",$value);
			$mis_cursos_asignados[]=$data_mis_cursos[0];


		}
}
	
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
		$this->load->view('publico/view_cursos_mis_cursos',$data);

	}


## funcion para registrarme a un curso con solo dar clic
	public function registrarme_al_curso($id_cursos,$nombre_curso)
	{
		$nombre_del_curso=str_replace(".html", "", str_replace("-", " ", $nombre_curso));
	
		$miperfil=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$this->encrypt->decode($this->session->userdata('id_usuario'))));

		$cursos_asignados=json_decode($miperfil->id_cursos_asignados);



## valido si existe ese curso entre mis cursos
		if ( !@in_array($id_cursos, $cursos_asignados)  )  { 

			$cursos_asignados[]=$id_cursos;
			$data['id_cursos_asignados']=json_encode($cursos_asignados);
			

			$configuracion=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
			$detalle_curso=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));

			$tipo_plan=$this->model_generico->detalle('tipo_planes',array('id_tipo_planes'=>$detalle_curso->id_tipo_planes));


			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$this->encrypt->decode($this->session->userdata('id_usuario'))));
			
			$this->session->set_userdata('cursos_asignados', $this->encrypt->encode(  json_encode($cursos_asignados)   ));
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



		$this->detalle($id_cursos,$nombre_curso);
		

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


		$instructores=$this->model_cursos->get_instructores_asignados($instructores_asignados);
		$data['detalle_curso']->instructores=$instructores;

		$modulos=$this->model_cursos->get_modulos($id_cursos);
		$data['detalle_curso']->modulos=$modulos;


		## si no estoy logeado, me redirecciona
		if ($this->session->userdata('logeado')!=1) {  redirect('ingresar/'.base64_encode(current_url()));  }

		## miro si ese curso estoy inscrito o no estoy inscrito
		$data['if_inscrito']=if_inscrito (   $data['detalle_curso']->id_cursos,json_decode($this->encrypt->decode( $this->session->userdata('cursos_asignados') ))  );


		## obtengo el primer modulo, primera actividad
		$data['primer_mod_activ']=$this->model_cursos->get_modulo_activ($id_cursos);




		$this->load->view('publico/view_cursos_descripcion',$data);

	}








#empezar curso!

	public function empezar($id_cursos,$id_modulos,$id_actividades,$nombre_curso)
	{
		$this->load->model('model_cursos');
		$data['detalle_curso']=$this->model_generico->detalle('cursos',array('id_cursos'=>$id_cursos));

		if (!$id_cursos || !$id_modulos || !$id_actividades) {
#redirect($this->uri->segment(1).'/detalle/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
		}




## consulto los tipos de planes existentes en el sistema para traerlos con sus respectivos contenidos
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));


		$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$data['detalle_curso']->id_categoria_cursos));
		$data['detalle_curso']->categoria_cursos=$tmp->nombre;
		$instructores_asignados=json_decode($data['detalle_curso']->instructores_asignados);


		$instructores=$this->model_cursos->get_instructores_asignados($instructores_asignados);
		$data['detalle_curso']->instructores=$instructores;


		## traigo los modulos del curso en el que estoy
		$modulos=$this->model_cursos->get_modulos($id_cursos);
		$data['detalle_curso']->modulos=$modulos;


		## ahora listo la primera actividad de cada modulo para ir directamente a la primer actividad al hacer click
		foreach ($data['detalle_curso']->modulos as $modulos_key => $modulos_value) {
			$primera_actividad_mod=$this->model_cursos->get_first_actividad ($modulos_value->id_modulos);
			$data['detalle_curso']->modulos[$modulos_key]->primera_actividad=$primera_actividad_mod;
		}




## evaluo si realmente estoy inscrito en este curso
		if_mi_curso($data['detalle_curso']->id_cursos,json_decode($this->encrypt->decode( $this->session->userdata('cursos_asignados') )),'/mis_cursos');


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
			$data['detalle_curso']->modulos_vistos_arr[]=$value->id_modulos;
		}


		$data['modulos_vistos']=$if_modulos_vistos;



### ahora voy a traer la informacion de la actividad actual!


		$actividad_actual_arr=$this->model_cursos->get_actividad($id_modulos,$id_actividades);
		$tipo_actividad=$actividad_actual_arr[0];





		$data['detalle_curso']->actividad_actual=$actividad_actual_arr[2];

		$data['detalle_curso']->tipo_actividad=$actividad_actual_arr[1];

		$data['detalle_curso']->actividad_barra=$actividad_actual_arr[0];

		$data['detalle_curso']->tipo_actividad_actual=$tipo_actividad->id_tipo_actividades;

		## si es un foro, consulto los datos del facilitador o docente
		if ($tipo_actividad->id_tipo_actividades==2)  {
			$docente=$this->model_cursos->get_docente($data['detalle_curso']->actividad_actual->id_usuario_modificado);
			$data['detalle_curso']->actividad_actual->docente=$docente;

			$mensajes_foro=$this->model_cursos->get_mensajes_foro($data['detalle_curso']->actividad_actual->id_actividades_foro);







			$data['detalle_curso']->actividad_actual->mensajes_foro=$mensajes_foro;

			$data['detalle_curso']->actividad_actual->docente->megustas=$this->model_cursos->get_megustas($this->uri->segment(5),'',$data['detalle_curso']->actividad_actual->id_usuario_modificado);


			## me gustas de todos los mensajes de los estudiantes
			foreach ($data['detalle_curso']->actividad_actual->mensajes_foro as $mensajes_foro_key => $mensajes_foro_value) {
				$data['detalle_curso']->actividad_actual->mensajes_foro[$mensajes_foro_key]->megustas=$this->model_cursos->get_megustas($this->uri->segment(5),$mensajes_foro_value->id_actividades_foro_mensajes,$mensajes_foro_value->id_usuario_modificado);
			}


			


		}


	#	krumo ($data['detalle_curso']->actividad_actual->mensajes_foro);

		##consulto el diccionario de datos de la web
		$data['detalle_curso']->diccionario=$this->model_generico->diccionario();


		$tmp_actividades=$this->model_cursos->get_actividades($id_modulos);

		$arr_actividades=array();
		foreach ( $tmp_actividades as $tmp_actividades_key => $tmp_actividades_value) {
		#echo $tmp_actividades_value->id_actividades_barra;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_actividades_barra']=$tmp_actividades_value->id_actividades_barra;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_modulos']=$tmp_actividades_value->id_modulos;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_tipo_actividades']=$tmp_actividades_value->id_tipo_actividades;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_actividades'] =$tmp_actividades_value->id_actividades ;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_estados'] =$tmp_actividades_value->id_estados ;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['fecha_creado']=$tmp_actividades_value->fecha_creado;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['fecha_modificado']=$tmp_actividades_value->fecha_modificado;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_usuario_creado'] =$tmp_actividades_value->id_usuario_creado ;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['id_usuario_modificado']=$tmp_actividades_value->id_usuario_modificado ;
			$arr_actividades[$tmp_actividades_value->id_actividades_barra]['orden']=$tmp_actividades_value->orden;

		}
		#$data['detalle_curso']->actividades=$arr_actividades;

#$data['detalle_curso']->actividades=$arr_actividades;

#krumo ($data['detalle_curso']->actividades);



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
#$data['detalle_curso']->actividades_no_vistas=json_decode(json_encode(array_diff_key($arr_actividades, $arr_actividades_vistas)), FALSE);





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



 $this->load->view('publico/view_cursos_empezar',$data);

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






/* envia el mensaje del foro desde el usuario */
public function sendpost()
{
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
	$id=$this->model_generico->guardar('actividades_foro_mensajes',$data,'id_actividades_foro_mensajes',array('id_actividades_foro_mensajes',''));

	$tmp_foro_insertado=$this->model_generico->detalle('actividades_foro_mensajes',array('id_actividades_foro_mensajes'=>$id));





	$html='<div class="disc_block_B">
	<div class="disc_block_B_wrap clear"><div class="disc_block_B_col1"> <img src="uploads/aprendices/'.$this->encrypt->decode($this->session->userdata('foto')).'" alt="">
		<h4>'.$this->encrypt->decode($this->session->userdata("nombres")).' '.$this->encrypt->decode($this->session->userdata("apellidos")).'</h4>
		<h5>'.$this->encrypt->decode($this->session->userdata("nombre_estatus")).'</h5>
		<div class="kudos"><p>0</p>
		</div>
	</div> 
	<div class="disc_block_B_col2"><p>'.$tmp_foro_insertado->mensaje.'</p> </div>
</div>
</div>';
echo 	$html;
	#echo "OK";
}




public function dar_megusta () {

	$this->load->model('model_cursos');
	$post=$_POST['data'];

		##inserto el megusta en la bd
	if ($post['op']=='darmegusta') {

		$data=array('id_cursos'=>$post['id_cursos'],'id_modulos'=>$post['id_modulos'],'id_actividades'=>$post['id_actividades'],'id_actividades_foro_mensajes'=>0,'id_usuarios'=>$post['id_usuario_docente'],'id_estados'=>1);
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 

		##miro si ya le di me gusta
		$tmp_ifmegusta=$this->model_cursos->get_if_megusta($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_actividades']);
		if (count($tmp_ifmegusta)==0)  {
			$id=$this->model_generico->guardar('actividades_foro_megusta',$data,'id_actividades_foro_megusta',array('id_actividades_foro_megusta',''));
		}

		#obtengo los megusta del docente
		$megustas_docente=$this->model_cursos->get_megustas($post['id_actividades'],'',$post['id_usuario_docente']);

		#muestro la cantidad de me gusta al docente
		echo count($megustas_docente);

	}

}



public function dar_megusta_estudiante () {

	$this->load->model('model_cursos');
	$post=$_POST['data'];

	if ($post['op']=='darmegusta_Est') {

		$data=array('id_cursos'=>$post['id_cursos'],'id_modulos'=>$post['id_modulos'],'id_actividades'=>$post['id_actividades'],
			'id_actividades_foro_mensajes'=>$post['id_actividades_mensaje'],'id_usuarios'=>$post['id_usuario_estudiante'],'id_estados'=>1);
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$this->encrypt->decode($this->session->userdata('id_usuario'));  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$this->encrypt->decode($this->session->userdata('id_usuario')); 





	##miro si ya le di me gusta
		$tmp_ifmegusta=$this->model_cursos->get_if_megusta($this->encrypt->decode($this->session->userdata('id_usuario')),$post['id_actividades'],$post['id_actividades_mensaje']);
		if (count($tmp_ifmegusta)==0)  {

			$id=$this->model_generico->guardar('actividades_foro_megusta',$data,'id_actividades_foro_megusta',array('id_actividades_foro_megusta',''));
		}

		#obtengo los megusta del estudiante
		$megustas_docente=$this->model_cursos->get_megustas_estudiante($post['id_actividades'],$post['id_actividades_mensaje'],$post['id_usuario_estudiante']);

		#muestro la cantidad de me gusta al docente
		echo count($megustas_docente);





	}

}





}