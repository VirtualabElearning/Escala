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
		$this->variables=array('modulo'=>'aprendices','id'=>'id_aprendices','modelo'=>'model_aprendices');

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

	/* FUNCION LISTADO DE LA INFORMACION ALMACENADA EN LA TABLA */
	public function lista()
	{
		/* Muestro el listado de informacion partiendo de la tabla que pertenece este modulo */
		$variables = $this->variables;

		$data['titulo']=$variables['modulo'];
		/* Consulto la tabla de este modulo, con el parametro del nombre del modulo=tabla y si lleva orden. */

		$data['lista']=$this->{$variables['modelo']}->listado($variables['modulo'],'',array('orden','asc'));

		/* Cargo los campos que necesito en el listado ( Solo las etiquetas header ) */
		$data['titulos']=array("Orden","ID","Rol","Foto","Nombres","Apellidos","Identificacion","Correo","Tipo plan","Estado","Opciones");

		/* Cargo la vista de forma dinamica */
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
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
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				return false;
			}
		}
	}




	/* FUNCION NUEVO PARA INGRESARLE VALORES Y LUEGO GUARDARLO EN LA TABLA */
	public function nuevo()
	{  /* Cargo variables globales de configuracion del modulo */
		$variables = $this->variables;
		/* Titulo = nombre del modulo */
		$data['titulo']=$variables['modulo'];
		/*  Cargo vista de ingresar un nuevo dato */
		$data['roles']=$this->{$variables['modelo']}->get_roles('aprendices');
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes','',array('orden','asc'));
		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}

	/* FUNCION GUARDAR INFORMACION A UNA TABLA */
	public function guardar()
	{
		/* Cargo variables globales de configuracion del modulo */
		$variables = $this->variables;

		/* Asigno variable id */
		$id=$this->input->post ('id');
		/* Reglas basicas de los campos recibidos del formulario */
		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
		$this->form_validation->set_rules('identificacion', 'Identificacion', 'required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean');
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

				);

			if ($this->input->post ('contrasena')) {
				/* Si existe informacion de contraseña, la encripto */
				$data['contrasena']=sha1($this->input->post ('contrasena'));

			}
			/* si es actualizar, envia la fecha de actualizacion, de lo contrario envia fecha de creacion y actualizacion */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			

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
				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}
				$data['foto'] = "";
			}





			/* Guardo la informacion a la base de datos retornando el id y redireccionando a la vista. */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));

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
		$variables = $this->variables;
		/* Validacion basica del id */
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		/*Asigno valor a variable*/
		$id=$this->input->post('id');

		/* Consulto el detalle de la informacion basado en un id a una tabla asignada al modulo */
		$detalle=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		@unlink('uploads/'.$variables['modulo'].'/'.$detalle->foto);

		/* borro el dato de la tabla asignada */
		$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
		/* Redirecciono al listado */
		redirect($accion_url);
	}


	/* FUNCION EDITAR ALGUN DATO DE INFORMACION */

	public function editar($id,$error_extra=null,$redirect=null)
	{
		$variables = $this->variables;
		$data['titulo']=$variables['modulo'];
		/* cargo informacion para editar */
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
		/* Obtengo los roles de usuario comunes */
		$data['roles']=$this->{$variables['modelo']}->get_roles('aprendices');
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes','',array('orden','asc'));
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
		$variables = $this->variables;
		/* Cargo orden de elementos recibidos por ajax */
		$data = $this->input->post('data');
		/* Divido los valores por coma y lo convierto en array */
		$dataarray=explode (",",$data);
		/* Realizo ciclo para guardar nuevo orden de la informacion */
		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}

}