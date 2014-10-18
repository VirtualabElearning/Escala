<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publico extends CI_Controller {

	/* Controlador de la aplicacion version publica */

	var $variables = array();
	public function __construct()
	{
		parent::__construct();

	}

	/* Cargo la pantalla de inicio */
	public function index($msg=null)
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
		$data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
		$data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
		##funcion para cargar el conteo de las notificaciones y el listado de notificaciones
		$data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
		$data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));

		if ($msg!='') { $data['mensaje_inicio']=$msg; }


		$this->load->view('publico/view_inicio',$data);

	}

}