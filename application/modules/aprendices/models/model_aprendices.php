<?php
/* CLASE-MODELO DEL MODULO */


class Model_Aprendices extends CI_Model{

	/* funcion personalizada de consultar un listado de informacion */
	public function listado($tabla,$where=null,$order_by=null){

		/* Si tiene parametros where sql */
		if ($where) {  $this->db->where($where[0],$where[1]); }
		
		/* Realizo un join a la tabla */
		$this->db->join('roles', 'roles.id_roles = aprendices.id_roles');

		/* Si es necesario ordenarlo */
		if ($order_by) {
			$this->db->order_by('aprendices.orden');
		}

		/* Obtengo la informacion */
		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";

		/* Retorno resultados de lo que consulté */
		return $query->result();
	}

	/*FUNCION OBTENER ROLES  */ 
	public function get_roles () {
		$this->db->where("id_estados",1);
		$this->db->order_by('roles.orden');
		$query = $this->db->get("roles");
		return $query->result();
	}




}


