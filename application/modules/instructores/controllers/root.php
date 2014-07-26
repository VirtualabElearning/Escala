<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/**
	Controlador de la aplicacion
	 **/


	var $variables = array();


	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
/**
Configuracion generica del modulo
**/
$this->variables=array('modulo'=>'aprendices','id'=>'id_aprendices','modelo'=>'model_aprendices');

$this->load->model($this->variables['modelo']);

}


public function index()
{
	$this->lista();
}


public function lista()
{
	$variables = $this->variables;
	$data['titulo']=$variables['modulo'];
	$data['lista']=$this->{$variables['modelo']}->listado($variables['modulo'],'',array('orden','asc'));



	$data['titulos']=array("Orden","ID","Rol","Foto","Nombres","Apellidos","Identificacion","Correo","Estado","Opciones");
	$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
}



public function nuevo()
{
	$variables = $this->variables;
	$data['titulo']=$variables['modulo'];
	$data['lista']=$this->model_generico->listado($variables['modulo']);
	$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
}



public function guardar()
{
	$variables = $this->variables;
	$id=$this->input->post ('id');
	$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
	$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
	$this->form_validation->set_rules('identificacion', 'Identificacion', 'required|xss_clean');
	$this->form_validation->set_rules('correo', 'Correo', 'required|xss_clean');
	$this->form_validation->set_rules('id_roles', 'Rol', 'required|xss_clean');
	$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');
	$this->form_validation->set_rules('contrasena', 'contrasena', 'xss_clean');
	$this->form_validation->set_rules('resumen_de_perfil', 'resumen_de_perfil', 'xss_clean');

	if($this->form_validation->run() == FALSE)
	{ 

		#$this->editar($id);
		echo   $this->form_validation->display_errors();
		exit;
	}

	else {

		$data = array(
			'nombres' => $this->input->post ('nombres'),
			'apellidos' => $this->input->post ('apellidos'),
			'correo' => $this->input->post ('correo'),
			'identificacion' => $this->input->post ('identificacion'),
			'resumen_de_perfil' => $this->input->post ('resumen_de_perfil'),
			'id_roles' => $this->input->post ('id_roles'),
			'id_estados' => $this->input->post ('id_estados'),

			);

		if ($this->input->post ('contrasena')) {
			$data[$variables['contrasena']]=sha1($this->input->post ('contrasena'));

		}
		if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }


		$config['upload_path']   =   "uploads/".$variables['modulo']."/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2000";
		$config['max_height']    =   "2000";
		$config['remove_spaces']  = TRUE;
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload',$config);

		if ($_FILES['userfile']['tmp_name'])  {
			if(!$this->upload->do_upload())

			{

				#echo $this->upload->display_errors(); exit;
				#$this->editar($id,$this->upload->display_errors());
				#$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

			}

			else

			{

				$finfo=$this->upload->data();


				if ($this->input->post ('foto_antes'))  {
					@unlink('uploads/'.$variables['modulo'].'/'.$this->input->post ('foto_antes'));
				}


				$temp_ext=substr(strrchr($finfo['file_name'],'.'),1);
				$myphoto=str_replace(".".$temp_ext, "", $finfo['file_name']);


				$data['foto'] = $finfo['file_name'];


			}


		}


		$id=$this->model_generico->guardar($variables['modulo'],$data,$variables['id'],array($variables['id'],$id));

		if ( $this->input->post('redirect')  )  {
			redirect(base64_decode($this->input->post('redirect')));
		}

		else {
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/'.$id.'/guardado_ok';
			redirect($accion_url);
		}









	}



}


public function borrar()
{
	$variables = $this->variables;
	$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');

	$id=$this->input->post('id');

	$detalle=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
	@unlink('uploads/'.$variables['modulo'].'/'.$detalle->foto);


	$this->model_generico->borrar($variables['modulo'],array($variables['id']=>$this->input->post ('id')));
	$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/index/borrado_ok';
	redirect($accion_url);
}




public function editar($id,$error_extra=null,$redirect=null)
{
	$variables = $this->variables;
	$data['titulo']=$variables['modulo'];
	$data['detalle']=$this->model_generico->detalle($variables['modulo'],array($variables['id']=>$id));
	$data['roles']=$this->{$variables['modelo']}->get_roles();
	$data['error_extra']=$error_extra;
	$data['redirect']=$redirect;

	$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);

}



public function ordenar()
{
	$variables = $this->variables;
	$data = $this->input->post('data');
	$dataarray=explode (",",$data);
	foreach ($dataarray as $key => $value) {
		$this->model_generico->ordenar($variables['modulo'],array("orden"=>$key+1),array($variables['id'],$value));
	}

}











}

