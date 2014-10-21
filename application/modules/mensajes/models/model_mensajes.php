<?php
/* CLASE-MODELO DEL MODULO */

class Model_mensajes extends CI_Model{




	public function listado($id_usuarios,$tabla,$where=null,$order_by=null){

		$this->db->select($tabla.".*,estados.nombre as estado_nombre,usuarios.*,cursos.*,".$tabla.".id_estados as estado_mensaje");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}

		$this->db->where($tabla.'.id_usuarios',$id_usuarios);

		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');
		$this->db->join('cursos', $tabla.'.id_cursos = cursos.id_cursos');
		$this->db->join('usuarios', $tabla.'.id_usuario_creado = usuarios.id_usuarios');


		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);

		return $query->result();
	}



	public function update_mensaje_estado ($id_mensajes,$data) {
		$this->db->where('id_mensajes', $id_mensajes);
		$this->db->update('mensajes', $data); 
		return true;
	}


}