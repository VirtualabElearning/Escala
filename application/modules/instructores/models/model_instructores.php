<?php
/**
Esta es la clasde del modulo 
**/


class Model_Instructores extends CI_Model{




	public function listado($tabla,$where=null,$order_by=null){
		
		$this->db->select('estados.nombre as estado_nombre,usuarios.orden,usuarios.profesion,usuarios.id_usuarios,roles.nombre,usuarios.foto,usuarios.nombres,usuarios.apellidos,usuarios.identificacion,usuarios.correo,usuarios.id_estados');

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
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



	public function get_cursos_disponibles () {
		$this->db->where("id_estados",1);
		$this->db->order_by('cursos.orden');
		$query = $this->db->get("cursos");
		return $query->result();
	}



	public function get_categoria_curso ($id_categoria_cursos) {
		$this->db->select("nombre as nombre_curso");
		$this->db->where("id_estados",1);
		$this->db->where("id_categoria_cursos",$id_categoria_cursos);
		$query = $this->db->get("categoria_cursos");
		$resultado = $query->row();

		return $resultado->nombre_curso;

	}




}


