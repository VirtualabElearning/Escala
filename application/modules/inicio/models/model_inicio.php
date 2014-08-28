<?php

class Model_inicio extends CI_Model{

	public function check_user( $username, $password ){

		$query = $this->db->get_where('tbl_usuarios', array('usuario' => $username,'contrasena' => $password ) );

		if( $query->num_rows() > 0 ){

			if( $query->row()->estado == 0 ){
				return 'inactivo';
			} else{
				return 'activo';
			}

		} else {
			return 'no-existe';
		}
	}

	public function get_info_usuario($tabla,$where){
		$this->db->where($where[0],$where[1]);
		$this->db->join('tbl_roles', 'tbl_roles.id_roles = tbl_usuarios.id_roles');
		$query = $this->db->get($tabla);

		return $query->row();
	}


	public function get_cursos_destacados(){
		$this->db->select ('tipo_planes.nombre as tipo_plan,tipo_planes.id_tipo_planes,cursos.*');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
		$this->db->where('cursos.id_estados',1);
		$this->db->where('cursos.destacar',1);
		$query = $this->db->get('cursos');
		return $query->result();
	}






}


