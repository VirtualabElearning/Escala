<?php
/* CLASE-MODELO DEL MODULO */

class Model_Pagos_realizados extends CI_Model{


/**
Funcion que genera el listado de una tabla
**/
public function listado($tabla,$where=null,$order_by=null){

	$this->db->select($tabla.".*,estados.nombre as estado_nombre,usuarios.*,cursos.*");
	if ($where) {
		$this->db->where($where[0],$where[1]);
	}

	$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');

	$this->db->join('usuarios', $tabla.'.id_usuarios = usuarios.id_usuarios');
	#$this->db->join('usuarios', $tabla.'.id_usuarios = usuarios.id_usuarios');
	$this->db->join('cursos', $tabla.'.id_cursos = cursos.id_cursos');


	if ($order_by) {
		$this->db->order_by($order_by[0], $order_by[1]); 
	}

	$query = $this->db->get($tabla);
	#krumo ($this->db->last_query());
	return $query->result();
}




}