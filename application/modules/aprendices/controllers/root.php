<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* controlador de la aplicacion */

	var $variables = array();
	/* CONSTRUCTOR DEL CONTROLADOR DONDE CARGO VALORES INICIALES Y VALIDACIONES */
	public function __construct()
	{
		parent::__construct();
		/* Si no existe login de usuario lo redirecciona a la pagina de iniciar sesion, indicando donde debo volver una vez que haya iniciado sesion */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* configuracion generica del modulo programado */
		$this->variables=array('modulo'=>'aprendices','id'=>'id_aprendices','modelo'=>'model_aprendices','carpeta'=>'aprendices');

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  
		if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 
		
		/* Cargo el modelo de forma dinamica */
		$this->load->model($this->variables['modelo']);

		/* Configuracion global de subida de imagen */
		$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);

	}
	/* FUNCION POR DEFECTO */
	public function index()
	{
		/* Llamo a la funcion lista */
		$this->lista();
	}


	/*  Funcion para exportar todos los estudiantes  */
	public function exportar()
	{
		/* Llamo a la funcion lista */

		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->helper('csv');


		$lista_tmp=$this->{$variables['modelo']}->listado('usuarios',array('usuarios.id_roles',3),array('orden','asc'));
#encabezado del array
		$lista[0]=array('Nombres completos','Identificacion','Correo','Tipo plan','Estado');	

## preparo el array para exportar
		foreach ($lista_tmp as $key => $value) {
			$lista[$key+1]=array($value->nombres." ".$value->apellidos,$value->identificacion,$value->correo,utf8_decode($value->nombre_plan),$value->estado_nombre);


		}

		header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="' . asignar_frase_diccionario ($data['diccionario'],"{estudiante}",$variables['modulo'],2)."_".date('d-M-Y').'.csv' . '"');
		echo array_to_csv($lista);
		exit;

	}



	/* FUNCION LISTADO DE LA INFORMACION ALMACENADA EN LA TABLA */
	public function lista()
	{
		/* Muestro el listado de informacion partiendo de la tabla que pertenece este modulo */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['mispermisos']=$variables['mispermisos'];

		#$data['titulo']=$variables['modulo'];
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{estudiante}",$variables['modulo'],2);
		$data['carpeta']=$variables['carpeta'];

		/* Consulto la tabla de este modulo, con el parametro del nombre del modulo=tabla y si lleva orden. */
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['lista']=$this->{$variables['modelo']}->listado('usuarios',array('usuarios.id_roles',3),array('orden','asc'));

		/* Cargo los campos que necesito en el listado ( Solo las etiquetas header ) */
		$data['titulos']=array("Rol","Foto","Nombres","Apellidos","Identificacion","Correo","Estado","Opciones");

		/* Cargo la vista de forma dinamica */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
	public function check_foto()
	{
		if ($_FILES['userfile']['name'])  {
			if ($this->upload->do_upload('userfile'))
			{
				$upload_data    = $this->upload->data();
				$_POST['userfile'] = $upload_data['file_name'];
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				return false;
			}
		}
	}




	/* FUNCION NUEVO PARA INGRESARLE VALORES Y LUEGO GUARDARLO EN LA TABLA */
	public function nuevo()
	{  /* Cargo variables globales de configuracion del modulo */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre del modulo */
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{estudiante}",$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}


		$data['estatus']=$this->model_generico->listado('estatus',array('estatus.id_estados','1'),array('orden','asc'));
		$data['cursos']=$this->model_generico->listado('cursos',array('cursos.id_estados','1'),array('orden','asc'));
		foreach ($data['cursos'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos'][$key]->categoria_curso=$tmp->nombre;
		}




		/*  Cargo vista de ingresar un nuevo dato */
		$data['roles']=$this->{$variables['modelo']}->get_roles('aprendices');
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes','',array('orden','asc'));
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}



 ## checkeo si el correo ya existe.
	public function check_email () {


		$this->load->model('model_aprendices');
		/* Evaluo en la funcion si existe, si la contrasena es correcta. */
		$result = $this->model_aprendices->check_email( $this->input->post ('correo'),$this->input->post ('id') );

		switch($result){
			case 'existe':
			/* 
			Muestro mensaje de error si el existe.
			 */
			$this->form_validation->set_message('check_email', 'El correo '.$this->input->post('correo').' ya existe en el sistema, intente con otro.');
			return false;
			break;
			
			/*
			Retorno verdadero si la identificacion no existe
			*/
			case 'aceptable':
			return true;
			break;
		}

	}




	/* FUNCION GUARDAR INFORMACION A UNA TABLA */
	public function guardar()
	{
		/* Cargo variables globales de configuracion del modulo */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$this->load->model('model_aprendices');
		/* Asigno variable id */
		$id=$this->input->post ('id');
		/* Reglas basicas de los campos recibidos del formulario */
		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
		$this->form_validation->set_rules('identificacion', 'Identificacion', 'required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean|callback_check_email');
		$this->form_validation->set_rules('id_roles', 'Rol', 'required|xss_clean');
		$this->form_validation->set_rules('id_tipo_planes', 'Tipo de plan', 'required|xss_clean');



		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
		if ($this->input->post ('id'))  { 
			$this->form_validation->set_rules('contrasena', 'contrasena', 'xss_clean');
		} else {
			$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|xss_clean');
			$this->form_validation->set_rules('contrasena2', 'Repetir contraseña', 'required|xss_clean');
		}

		$this->form_validation->set_rules('resumen_de_perfil', 'resumen_de_perfil', 'xss_clean');
		$this->form_validation->set_rules('image', 'Foto', 'callback_check_foto');

		/* Si existe algun error en la validacion de los campos */
		if($this->form_validation->run() == FALSE)
		{ 

			if ($id)  { $this->editar($id); } else { $this->nuevo();  }

		}
		/* De lo contrario continuo con el proceso */
		else {
			/* asigno valores a un array para enviarlos al modelo */
			$data = array(
				'nombres' => $this->input->post ('nombres'),
				'apellidos' => $this->input->post ('apellidos'),
				'correo' => $this->input->post ('correo'),
				'identificacion' => $this->input->post ('identificacion'),
				'resumen_de_perfil' => $this->input->post ('resumen_de_perfil'),
				'id_roles' => $this->input->post ('id_roles'),
				'id_tipo_planes' => $this->input->post ('id_tipo_planes'),
				'id_estados' => $this->input->post ('id_estados'),
				'id_estatus' => $this->input->post ('id_estatus'),
				#'id_cursos_asignados' => json_encode($this->input->post ('id_cursos_asignados')),
				);

			if ($this->input->post ('contrasena')) {
				/* Si existe informacion de contraseña, la encripto */
				$data['contrasena']=sha1($this->input->post ('contrasena'));

			}
			/* si es actualizar, envia la fecha de actualizacion, de lo contrario envia fecha de creacion y actualizacion */
			if ($id) { $data['id_usuarios']=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			


			/* Si existe algun error, continua el programa */
			if ($_FILES['userfile']['tmp_name'])  {

				$finfo=$this->upload->data();

				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}

				/* obteno la extesion y nombre de la imagen */
				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$data['foto'] = $finfo['file_name'];
			}

			else {

				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post('image'))  { }   // si existe el post, no hace nada
					else {
						if ($this->input->post ('foto_antes'))  {
							@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
						}
						$data['foto'] = "";	
					}

				}




			/* Guardo la informacion a la base de datos retornando el id y redireccionando a la vista. */
			$id=$this->model_generico->guardar('usuarios',$data,'id_usuarios',array('id_usuarios',$id));




			#krumo ($this->input->post ('id_cursos_asignados')); exit;

			#BORRO LOS CURSOS NO ASIGNADOS DEL ESTUDIANTE
			$listtmp=$this->model_aprendices->get_cursos_estudiante_lista($id);

			foreach ($listtmp as $key => $value) {
				$list[]=$value->id_cursos."|".$value->id_cursos_asignados;
			}



#krumo ($this->input->post ('id_cursos_asignados'));
#exit;




##funcion para borrar los cursos no seleccionados
			if ($list) {
			foreach ($list as $key => $value) {
				$tmpxx=explode ("|",$value);

				if ( @!in_array($tmpxx[0], $this->input->post ('id_cursos_asignados')) ) {
					$this->model_generico->borrar('cursos_asignados',array('id_cursos_asignados'=>$tmpxx[1]));
					#echo "Borrado: ".$tmpxx[1];
				} 
				else {
					$list2[]=$tmpxx[0];
				}

			}
 }

if ($this->input->post ('id_cursos_asignados') ) {
	

			foreach ($this->input->post ('id_cursos_asignados') as $postkey => $postvalue) {
				##si no está entre la lista de los cursos asignados del estudiante...
				if ( @!in_array($postvalue, $list2) ) {

				## guardo los cursos asignados al estudiante
					/* asigno valores a un array para enviarlos al modelo */
					$data = array(
						'id_usuarios' => $id_usuarios_x=$id,
						'id_cursos' =>$postvalue,
						'id_estatus' => 5,
						'id_estados' => 1,
						'id_tipo_planes' => $this->input->post ('id_tipo_planes'),
						);

					$tmp=$this->model_aprendices->get_cursos_estudiante($id_cursos,$id_usuarios);

					if ($tmp->id_cursos_asignados) { $data['id_cursos_asignados']=$tmp->id_cursos_asignados; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }
					$id_cursos_asignadosx=$this->model_generico->guardar('cursos_asignados',$data,'id_cursos_asignados',array('id_cursos_asignados',$tmp->id_cursos_asignados));


				}


			}


}



			/* Si tiene un redireccionamiento de donde venia */
			if ( $this->input->post('redirect')  )  {
				redirect(base64_decode($this->input->post('redirect')));
			}

			/* por defecto retornar a la vista de listado*/
			else {
				$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
				redirect($accion_url);
			}

		}

	}

	/* FUNCION DE BORRAR UN DATO */
	public function borrar()
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Validacion basica del id */
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		/*Asigno valor a variable*/
		$id=$this->input->post('id');

		/* Consulto el detalle de la informacion basado en un id a una tabla asignada al modulo */
		$detalle=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$id));
		@unlink('uploads/'.$variables['modulo'].'/'.$detalle->foto);

		## borro los cursos asignados al estudiante

		$listtmp=$this->model_aprendices->get_cursos_estudiante_lista($this->input->post ('id'));
		foreach ($listtmp as $keyx => $valuex) {
			$this->model_generico->borrar('cursos_asignados',array('id_cursos_asignados'=>$valuex->id_cursos_asignados));
		}


		/* borro el dato de la tabla asignada */
		$this->model_generico->borrar('usuarios',array('id_usuarios'=>$this->input->post ('id')));






		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
		/* Redirecciono al listado */
		redirect($accion_url);
	}


	/* FUNCION EDITAR ALGUN DATO DE INFORMACION */

	public function editar($id,$error_extra=null,$redirect=null)
	{

		$this->load->model('model_aprendices');
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		$data['titulo']=asignar_frase_diccionario ($data['diccionario'],"{estudiante}",$variables['modulo'],1);
		$data['carpeta']=$variables['carpeta'];
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		/* cargo informacion para editar */
		$data['detalle']=$this->model_generico->detalle('usuarios',array('id_usuarios'=>$id));
		/* Obtengo los roles de usuario comunes */
		$data['roles']=$this->{$variables['modelo']}->get_roles('aprendices');
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));
		$data['estatus']=$this->model_generico->listado('estatus',array('estatus.id_estados','1'),array('orden','asc'));




		$data['cursos']=$this->model_generico->listado('cursos',array('cursos.id_estados','1'),array('orden','asc'));
		foreach ($data['cursos'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos'][$key]->categoria_curso=$tmp->nombre;
		}



##listo los cursos asignados al estudiante:

		$list=$this->model_aprendices->get_cursos_estudiante_lista($id);





		foreach ($list as $key => $value) {
			$cursos_asignados_tmp[]=$value->id_cursos."|".$value->id_estatus."|".$value->id_tipo_planes;
		}
		$data['cursos_asignadoss']=json_encode($cursos_asignados_tmp);

		/* si existe un mensaje de error extra, lo lleva guardado para mostrarlo despues */
		$data['error_extra']=$error_extra;
		$data['redirect']=$redirect;
		/* cargo la vista editar junto con la informacion buscada en la tabla con un id*/
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}


	/* FUNCION ORDENAR SEGUN EL LISTADO DE INFORMACION QUE EXISTA (ORDENA CON ARRASTRAR Y SOLTAR EN LA FILA DE LA TABLA EN EL LISTADO) */
	public function ordenar()
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Cargo orden de elementos recibidos por ajax */
		$data = $this->input->post('data');
		/* Divido los valores por coma y lo convierto en array */
		$dataarray=explode (",",$data);
		/* Realizo ciclo para guardar nuevo orden de la informacion */
		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar('usuarios',array("orden"=>$key+1),array('id_usuarios',$value));
		}

	}

}