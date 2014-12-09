<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Controlador de la aplicacion */
class Root extends CI_Controller {

	/* variable para cargar los datos globales del modulo */
	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		/* Verifica si tiene login de usuario, si no, lo redirecciona a iniciar sesion. */
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'pagina_inicio','id'=>'id_pagina_inicio','modelo'=>'model_pagina_inicio');

		$mispermisos=$this->model_generico->mispermisos($this->session->userdata('id_roles'),$this->variables['modulo']);
		$this->variables['mispermisos']=json_decode($mispermisos->id_roles);  if (!in_array($this->session->userdata('id_roles'), $this->variables['mispermisos'])) {  redirect( 'inicio/root'); }   	$this->variables['diccionario']=$diccionario=$this->model_generico->diccionario(); 


	}

	public function index()
	{
		/* Funcion que lista los datos de la tabla asignada al modulo */
		$this->editar(1);
	}

	


// funcion para validar la foto (Solo valido cuando exista una foto, cuando no, no valido nada)
	public function check_foto($nombre_foto,$i)
	{

		if ($_FILES[$nombre_foto.$i]['tmp_name'])  {
			if ($this->upload->do_upload($nombre_foto.$i))
			{
				$upload_data    = $this->upload->data();
				$_POST[$nombre_foto.$i] = $upload_data['file_name'];
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_foto', $this->upload->display_errors());
				return false;
			}

		}

	}


	/* Funcion guardar  registro */
	public function guardar()
	{
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* variable id del registro (solo funciona cuando es editar) */
		$id=1;

		$cantidad_campos_atributos=3;
		$cantidad_campos_testimonios=3;

		/* Reglas de validacion basicas de los campos del formulario */

		$this->form_validation->set_rules('titulo', 'Titulo', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required|xss_clean');
		$this->form_validation->set_rules('keywords', 'Keywords', 'required|xss_clean');
		$this->form_validation->set_rules('slogan', 'Slogan', 'required|xss_clean');
		$this->form_validation->set_rules('titulo_destacados', 'Titulo destacados', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion_destacados', 'Descrición destacados', 'required|xss_clean');
       # $this->form_validation->set_rules('titulo_registrate', 'Titulo regístrate', 'required|xss_clean');



		for ($i=1; $i <=$cantidad_campos_atributos ; $i++) { 
			$this->form_validation->set_rules('atributo_titulo'.$i, 'Titulo atributo #'.$i, 'required|xss_clean');
			$this->form_validation->set_rules('atributo_contenido'.$i, 'Contenido atributo #'.$i, 'required|xss_clean');
			#atributo_userfile1
			$this->form_validation->set_rules('atributo_image'.$i, 'Foto', 'callback_check_foto[atributo_userfile,'.$i.']');
		}


		$this->form_validation->set_rules('boton_nombre', 'Nombre llamado a la acción', 'required|xss_clean');
		$this->form_validation->set_rules('boton_url', 'Url llamado a la acción', 'required|xss_clean');


		for ($i=1; $i <=$cantidad_campos_testimonios ; $i++) { 
			$this->form_validation->set_rules('testi_nombres_completos'.$i, 'Nombres completos', 'required|xss_clean');
			$this->form_validation->set_rules('testi_profesion'.$i, 'Profesión', 'required|xss_clean');
			$this->form_validation->set_rules('txt_testimonio'.$i, 'Contenido testimonio', 'required|xss_clean');
		}






		/* si existe alguna validacion que no pasa, las muestra en pantalla */
		if($this->form_validation->run() == FALSE)
		{ 
			$this->editar($id); 
	#echo "ERROR<br>";
			echo validation_errors();

		}

		else {


			for ($i=1; $i <=$cantidad_campos_atributos ; $i++) { 
				$atributo_titulo[]=array("atributo_titulo".$i=>$this->input->post('atributo_titulo'.$i));
			}
			for ($i=1; $i <=$cantidad_campos_atributos ; $i++) { 
				$atributo_contenido[]=array("atributo_contenido".$i=>$this->input->post('atributo_contenido'.$i));
			}


			for ($i=1; $i <=$cantidad_campos_atributos ; $i++) { 
				if($_FILES['atributo_userfile'.$i]['name']!=''){
					$config = array();
					/*configuracion basica para subir una foto*/
					$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
					$config['allowed_types'] =   "gif|jpg|jpeg|png";
					$config['max_size']      =   "50000";
					$config['max_width']     =   "20000";
					$config['max_height']    =   "20000";
					$config['remove_spaces']  = TRUE;
					$config['encrypt_name']  = TRUE;
					$this->load->library('upload');
					$this->upload->initialize($config); 
					if ( ! $this->upload->do_upload('atributo_userfile'.$i))
					{

					}   
					else
					{
						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];
						if ($this->input->post('atributo_image'.$i)!='*')  {
							@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('atributo_image'.$i));
						}
					}
				}

				else{
					if ($this->input->post ('atributo_image_tmp'.$i)!=$this->input->post ('atributo_image'.$i))  {
						@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('atributo_image_tmp'.$i));
					}




					if ($this->input->post ('atributo_image_tmp'.$i)!='')  {

						if ( file_exists('uploads/'.$variables['modulo'].'/'.$this->input->post ('atributo_image_tmp'.$i))  )  {
							$filename = $this->input->post ('atributo_image'.$i);
						}
						else { $filename="*";   }

					}
					else {  $filename="*";   }




				}

				$atributo_foto[]=array("atributo_foto".$i=>$filename);
			}





			/* Si existe algun error, continua el programa */
			if ($_FILES['userfile_banner']['tmp_name'])  {


				$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
				$config['allowed_types'] =   "gif|jpg|jpeg|png";
				$config['max_size']      =   "50000";
				$config['max_width']     =   "20000";
				$config['max_height']    =   "20000";
				$config['remove_spaces']  = TRUE;
				$config['encrypt_name']  = TRUE;
				$this->load->library('upload');
				$this->upload->initialize($config); 


				if ( ! $this->upload->do_upload('userfile_banner'))
				{

					echo $this->upload->display_errors(); exit;
				}
				else
				{
					$finfo=$this->upload->data();

				}

				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post ('foto_antes_banner'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes_banner'));
				}

				/* obteno la extesion y nombre de la imagen */
				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);
				$dataa['foto_banner'] = $finfo['file_name'];
			}

			else {
				/* si existia una foto antes, que la borre de la carpeta asignada */
				if ($this->input->post('image_banner'))  { $dataa['foto_banner'] = $this->input->post('image_banner');	  }   // si existe el post, no hace nada
				else {
					if ($this->input->post ('foto_antes_banner'))  {
						@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes_banner'));
					}
					$dataa['foto_banner'] = "";	
				}

			}





			$cajas=array("titulos"=>json_encode($atributo_titulo),"contenidos"=>json_encode($atributo_contenido),"atributo_fotos"=>json_encode($atributo_foto));

			$ver_cursos=array("boton_nombre"=>$this->input->post ('boton_nombre'),"boton_url"=>$this->input->post ('boton_url'));



			for ($i=1; $i <=$cantidad_campos_testimonios ; $i++) { 
				$testi_nombres_completos[]=array("testi_nombres_completos".$i=>$this->input->post('testi_nombres_completos'.$i));
			}
			for ($i=1; $i <=$cantidad_campos_testimonios ; $i++) { 
				$testi_profesion[]=array("testi_profesion".$i=>$this->input->post('testi_profesion'.$i));
			}
			for ($i=1; $i <=$cantidad_campos_testimonios ; $i++) { 
				$txt_testimonio[]=array("txt_testimonio".$i=>$this->input->post('txt_testimonio'.$i));
			}





			for ($i=1; $i <=$cantidad_campos_testimonios ; $i++) { 
				if($_FILES['testi_userfile'.$i]['name']!=''){
					$config = array();
					/*configuracion basica para subir una foto*/
					$config['upload_path']   =   "uploads/".$this->variables['modulo']."/";
					$config['allowed_types'] =   "gif|jpg|jpeg|png";
					$config['max_size']      =   "50000";
					$config['max_width']     =   "20000";
					$config['max_height']    =   "20000";
					$config['remove_spaces']  = TRUE;
					$config['encrypt_name']  = TRUE;
					$this->load->library('upload');
					$this->upload->initialize($config); 
					if ( ! $this->upload->do_upload('testi_userfile'.$i))
					{

					}   
					else
					{
						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];
						if ($this->input->post('testi_image'.$i)!='*')  {
							@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('testi_image'.$i));
						}
					}
				}

				else{
					if ($this->input->post ('testi_image_tmp'.$i)!=$this->input->post ('testi_image'.$i))  {
						@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('testi_image_tmp'.$i));
					}



					if ($this->input->post ('testi_image_tmp'.$i)!='')  {

						if ( file_exists('uploads/'.$variables['modulo'].'/'.$this->input->post ('testi_image_tmp'.$i))  )  {
							$filename = $this->input->post ('testi_image'.$i);
						}
						else { $filename="*";   }
					}
					else {  $filename="*";	}




				}

				$testi_foto[]=array("testi_foto".$i=>$filename);
			}





			$titulo_testimonios=array("titulo_testimonios"=>$this->input->post ('titulo_testimonios'),"des_testimonios"=>$this->input->post ('des_testimonios'));

			$testimonios=array("nombres_completos"=>json_encode($testi_nombres_completos),"profesion"=>json_encode($testi_profesion),"texto_testimonio"=>json_encode($txt_testimonio),"testi_fotos"=>json_encode($testi_foto));


			$tipo_planes=array(
				"planes_valores"=>json_encode($this->input->post('plan_valor')),    
				"lineas1"=>json_encode($this->input->post('linea1')),  
				"lineas2"=>json_encode($this->input->post('linea2')),  
				"lineas3"=>json_encode($this->input->post('linea3')),  
				"lineas4"=>json_encode($this->input->post('linea4')),  
				"id_planes"=>json_encode($this->input->post('id_plan')),
				"urls"=>json_encode($this->input->post('url'))

				);


			$data = array(
				'slogan' => $this->input->post('slogan'),
				'titulo' => $this->input->post('titulo'),
				'descripcion' => $this->input->post('descripcion'),
				'keywords' => $this->input->post('keywords'),
				'titulo_destacados' => $this->input->post('titulo_destacados'),
				'descripcion_destacados' => $this->input->post('descripcion_destacados'),
				'cajas' => json_encode($cajas),
				'ver_cursos' => json_encode($ver_cursos),
				'titulo_testimonios' => json_encode($titulo_testimonios),
				'testimonios' => json_encode($testimonios),
				'planes' => json_encode($tipo_planes),
				'titulo_registrate' => $this->input->post('titulo_registrate'),
				'foto_banner' => $dataa['foto_banner'] ,


				);



			/* si tiene id, es editar y me guarda la fecha de modificacion y quien lo modifico, de lo contrario quien lo creo y la fecha de creacion */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');    }

			$this->load->model($variables['modelo']);





			/* Guardo todos los registros a la base de datos */
			$id=$this->{$variables['modelo']}->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));



			/* Redirecciono al listado */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/guardar/ok';
			redirect($accion_url);
		}

	}



	/* Funcion editar */
	public function editar($id=1,$error_extra=null)
	{
		$id=1;
		/* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Titulo = nombre del modulo */
		$data['menus']=$this->model_generico->menus_root_categorias();
		foreach ($data['menus'] as $key => $value) {
			$data['menus'][$key]->submenus=$this->model_generico->menus_root($value->id_categorias_modulos_app,$this->session->userdata('id_roles'));

		}
		$data['titulo']=str_replace("_", " ", $variables['modulo']);
		/* Consulto el detalle del registro */
		$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));


		/* Si existe un error extra, lo carga en la variable */
		$data['error_extra']=$error_extra;
		/* Cargo la vista de editar */

		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));


		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

	}

	/* Funcion ordenar (aplica en el listado de registros a la hora de arrastrar y soltar) */
	public function ordenar()
	{ /* Cargo variables globales */
		$variables = $this->variables; $data['diccionario']=$this->variables['diccionario'];
		/* Cargo orden de los registros */
		$data = $this->input->post('data');
		/* Divido por coma, los registros a ordenar */
		$dataarray=explode (",",$data);
		foreach ($dataarray as $key => $value) {
			/* Guardo nuevo orden de cada uno de los registros */
			$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
		}

	}

}