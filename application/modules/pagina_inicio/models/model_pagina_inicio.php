<?php
/**
Esta es la clasde del modulo 
**/


class Model_Pagina_inicio extends CI_Model{






public function guardar ($tabla,$data,$idname=null,$where=null) {

	$id_retorno='';
	if (@$where[1]) {
		$this->db->where($where[0],$where[1]);
		$this->db->update($tabla, $data);

#echo  $this->db->last_query()."<br>";

		$id_retorno=$where[1];

	}
	else {
		$this->db->insert($tabla, $data);
		$id_retorno=$this->db->insert_id();
		$this->db->where(array($idname=>$id_retorno));
		#$this->db->update($tabla, array('orden'=>$id_retorno));

	}
	return  $id_retorno;
}






}


