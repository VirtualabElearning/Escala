<?php
/**
Esta es la clasde del modulo 
**/


class Model_Cursos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select("estados.nombre as estado_nombre,cursos.orden,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.descripcion,cursos.id_estados,cursos.instructores_asignados");

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->join('estados', 'cursos.id_estados = estados.id_estados');
		if ($order_by) {
			$this->db->order_by('cursos.orden');
		}


		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


	public function instructores_lista($id_instructores) {
if ($id_instructores)  {
		$this->db->select("instructores.nombres,instructores.apellidos,instructores.correo");
		


		$this->db->where_in('id_instructores', $id_instructores);

		$this->db->where('instructores.id_estados',1	);
		$this->db->order_by('instructores.orden');

		$query = $this->db->get('instructores');
	#echo  $this->db->last_query()."<br>";
		$resultados=$query->result();
		$retornar=array();
		foreach ($resultados as $key => $value) {
			$retornar[]=$value->nombres." ".$value->apellidos."[ ".$value->correo." ]";
		}

	$retorno=implode("<br>", $retornar);
	return $retorno;
} else {
	return false;
	}
}




}


