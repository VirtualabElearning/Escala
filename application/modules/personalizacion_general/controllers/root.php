<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* CONTROLADOR DEL MODULO */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* configuracion generica del modulo */
		$this->variables=array('modulo'=>'personalizacion_general','id'=>'id_personalizacion_general','modelo'=>'model_personalizacion_general');

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 


		/*configuracion basica para subir una foto*/
		$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);


	}

	/* funcion por defecto del controlador */
	public function index()
	{ /* llamo a la funcion lista para traer el listado de informacion */
		$this->personalizacion_general(1);
	}


// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
	public function check_foto()
	{
		if ($_FILES['logo']['tmp_name'])  {
			if ($this->upload->do_upload('logo'))
			{
				$upload_data    = $this->upload->data();
				$_POST['logo'] = $upload_data['file_name'];
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				return false;
			}
		}
	}



	/*FUNCION GENERAL personalizacion general del sistema */
	public function personalizacion_general($id,$error_extra=null)
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




	/* FUNCION GUARDAR INFORMACION */
	public function guardar()

	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];

		/* asigno variable id de lo que voy  aguardar (solo si es modo editar) */
		$id=1;


#krumo ($this->input->post());

		/* Validaciones  basicas de lo que voy a editar */
		$this->form_validation->set_rules('nombre_sistema', 'Nombre sistema', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion_sistema', 'Descripción sistema', 'required|xss_clean');
		$this->form_validation->set_rules('keywords_sistema', 'Keywords sistema', 'xss_clean');
		$this->form_validation->set_rules('colores_sistema1', 'Color 1', 'required|xss_clean');
		$this->form_validation->set_rules('colores_sistema2', 'Color 2', 'required|xss_clean');
		$this->form_validation->set_rules('colores_sistema3', 'Color 3', 'required|xss_clean');
		$this->form_validation->set_rules('colores_sistema4', 'Color 4', 'required|xss_clean');
		$this->form_validation->set_rules('facebook_sistema', 'Facebook', 'required|xss_clean');
		$this->form_validation->set_rules('twitter_sistema', 'Twitter', 'required|xss_clean');
		$this->form_validation->set_rules('copyright_nombre', 'Copyright nombre', 'required|xss_clean');
		$this->form_validation->set_rules('copyright_url', 'Copyright URL', 'required|xss_clean');
		$this->form_validation->set_rules('image', 'Foto', 'callback_check_foto');


		/* Si existe error en las validaciones, los muestra */
		if($this->form_validation->run() == FALSE)
		{ 

		 $this->personalizacion_general($id); 
		  echo validation_errors();
			
		}

		else {
			/* Asigno en array los valores de los campos llegados por el formulario */
			$data = array(
				'nombre_sistema' => $this->input->post ('nombre_sistema'),
				'descripcion_sistema' => $this->input->post ('descripcion_sistema'),
				'keywords_sistema' => $this->input->post ('keywords_sistema'),
				'colores_sistema1' => $this->input->post ('colores_sistema1'),
				'colores_sistema2' => $this->input->post ('colores_sistema2'),
				'colores_sistema3' => $this->input->post ('colores_sistema3'),
				'colores_sistema4' => $this->input->post ('colores_sistema4'),
				'facebook_sistema' => $this->input->post ('facebook_sistema'),
				'twitter_sistema' => $this->input->post ('twitter_sistema'),
				'copyright_nombre' => $this->input->post ('copyright_nombre'),
				'copyright_url' => $this->input->post ('copyright_url'),

				);

			/* Si tiene id, es porque es de editar y guarda la fecha de modificacion, de lo contrario, guarda fecha modificado y creado */
			#if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }



			if ($_FILES['logo']['tmp_name'])  {
				
				$finfo=$this->upload->data();
				if ($this->input->post ('image')<>$this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}

				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$data['logo'] = $finfo['file_name'];

			}

			else {
				## elimino la foto
				if ($this->input->post ('image')=='')  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
			$data['logo'] = "";
				}
				
				
			}




			/* Guardo la informacion */
			$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));

			/* Redirecciono al listado */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/personalizacion_general/'.$id.'/guardado_ok';
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









}