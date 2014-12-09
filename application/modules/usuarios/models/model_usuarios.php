<?php
/**
Esta es la clasde del modulo 
**/


class Model_Usuarios extends CI_Model{




## checkeo si el correo existe
	public function check_email_usuario( $email,$id_usuarios ){

		$extra=array('correo' => $email);
		$query = $this->db->get_where('usuarios', $extra );
		if( $query->num_rows() > 0 ){
				# si existe no permite actualizar con la misma cedula
					##verifico si tiene el mismo id_usuarios...
			$resultado=$query->row();
			if ($resultado->id_usuarios==$id_usuarios) { return 'aceptable'; } else {
				return 'existe';
			}
		} else {
			#si no existe la identificacion
			return 'aceptable';
		}
	}



	public function listado($tabla,$where=null,$order_by=null){
		$this->db->select($tabla.".*,estados.nombre as estado_nombre,roles.*");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$id_roleszx = array('1', '4');
		$this->db->where_in('usuarios.id_roles', $id_roleszx);
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$this->db->join('estados', 'usuarios.id_estados = estados.id_estados');
		if ($order_by) {
			$this->db->order_by('usuarios.orden');
		}


		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}

	

	public function get_roles ($tabla=null) {
		if ($tabla) {
			$this->db->where("tabla",$tabla);	
		}
		$this->db->where("id_estados",1);
		$this->db->order_by('roles.orden');
		$query = $this->db->get("roles");
		return $query->result();
	}




}


