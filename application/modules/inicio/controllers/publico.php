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
		$this->load->model('model_inicio');
		## cargo informacion inicial de la pagina home
		$data['inicio']=$this->model_generico->detalle('pagina_inicio',array('id_pagina_inicio'=>1));

		## cargo los cursos destacados
		$data['cursos_destacados']=$this->model_inicio->get_cursos_destacados();

		## consulto cada curso destacado su respectiva categoria
		foreach ($data['cursos_destacados'] as $key => $value) {
			$tmp=$this->model_generico->detalle('categoria_cursos',array('id_categoria_cursos'=>$value->id_categoria_cursos));
			$data['cursos_destacados'][$key]->categoria_cursos=$tmp->nombre;
		}

		## consulto los tipos de planes existentes en el sistema para traerlos con sus respectivos contenidos
		$data['tipo_planes']=$this->model_generico->listado('tipo_planes',array('tipo_planes.id_estados','1'),array('orden','asc'));

		$this->load->view('publico/view_inicio',$data);

	}

}