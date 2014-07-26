<?php
/**
Esta es la clasde del modulo 
**/


class Model_Cursos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		if ($order_by) {
			$this->db->order_by('cursos.orden');
		}


		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}








}


