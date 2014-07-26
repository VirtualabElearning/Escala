<?php
/**
Esta es la clasde del modulo 
**/


class Model_Usuarios extends CI_Model{




public function listado($tabla,$where=null,$order_by=null){
	if ($where) {
		$this->db->where($where[0],$where[1]);
	}
$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
	if ($order_by) {
		$this->db->order_by('usuarios.orden');
	}


	$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
	return $query->result();
}

 

public function get_roles () {
$this->db->where("id_estados",1);
$this->db->order_by('roles.orden');
$query = $this->db->get("roles");
return $query->result();
}




}


