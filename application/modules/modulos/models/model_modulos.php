<?php
/* CLASE-MODELO DEL MODULO */

class Model_Modulos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}


		$this->db->select($tabla.".*,tipo_planes.nombre,estados.nombre as estado_nombre");



		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = modulos.id_tipo_planes');
		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');
		if ($order_by) {
			$this->db->order_by($tabla.'.orden');
		}

		$query = $this->db->get($tabla);
		return $query->result();
	}



/** Funcion de ordenar **/
public function ordenar ($tabla,$data,$where,$id_cursos) {
	$this->db->where( $where[0],$where[1] );
	$this->db->where( 'id_cursos',$id_cursos );
	$this->db->update( $tabla, $data );
	#echo  $this->db->last_query()."<br>";
	return  true;
}


}