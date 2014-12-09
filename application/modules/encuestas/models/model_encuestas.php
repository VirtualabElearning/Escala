<?php
/* CLASE-MODELO DEL MODULO */

class Model_encuestas extends CI_Model{


public function get_respuesta($id_encuestas,$id_cursos,$id_encuestas_detalle,$id_usuarios){
	$this->db->select('respuesta,id_encuestas_respuestas');
	$this->db->where('id_encuestas',$id_encuestas);
	$this->db->where('id_cursos',$id_cursos);
	#$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));
	$this->db->where('id_encuestas_detalle',$id_encuestas_detalle);
	$this->db->where('id_usuarios',$id_usuarios);
	$query = $this->db->get('encuestas_respuestas');
	$r=$query->row();
	return $r;
}




}