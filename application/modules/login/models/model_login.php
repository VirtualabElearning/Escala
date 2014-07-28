<?php

class Model_login extends CI_Model{

	public function check_user( $username, $password ){



		$query = $this->db->get_where('usuarios', array('correo' => $username,'contrasena' => $password ) );



		if( $query->num_rows() > 0 ){

			if( $query->row()->id_estados == 0 ){
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
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$query = $this->db->get($tabla);
			#echo  $this->db->last_query()."<br>";
		#exit;

		return $query->row();
	}



	public function detalle($tabla,$where=null){

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->select('usuarios.id_usuarios,usuarios.nombres,usuarios.apellidos,usuarios.foto,usuarios.correo,usuarios.identificacion,usuarios.resumen_de_perfil,roles.nombre as nombre_rol,estados.nombre as nombre_estado');
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
        $this->db->join('estados', 'estados.id_estados = usuarios.id_estados');
		$query = $this->db->get($tabla);
		return $query->row();
	}






}


