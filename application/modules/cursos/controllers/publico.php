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

		$this->load->view('publico/view_cursos_lista',$data);

	}




	/* Cargo la pantalla de inicio */
	public function buscar()
	{

		$this->form_validation->set_rules('buscar', 'Buscar', 'xss_clean');


		$palabra=$this->input->get('buscar');
		


		$variables = $this->variables; 
		$this->load->model('model_cursos');
		

		## cargo los cursos buscados
		$data['cursos_lista']=$this->model_cursos->get_cursos_lista($palabra);

		## consulto cada curso su respectiva categoria
		foreach ($data['cursos_lista'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos_lista'][$key]->categoria_cursos=$tmp->nombre;
		}

		$this->load->view('publico/view_cursos_lista',$data);

	}








}