<?php
/* CLASE-MODELO DEL MODULO */


class Model_Aprendices extends CI_Model{

	/* funcion personalizada de consultar un listado de informacion */
	public function listado($tabla,$where=null,$order_by=null){

		/* Si tiene parametros where sql */
		if ($where) {  $this->db->where($where[0],$where[1]); }
		
		/* Realizo un join a la tabla */


		$this->db->select($tabla.".*,estados.nombre as estado_nombre,roles.*,tipo_planes.nombre as nombre_plan");



		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$this->db->join('estados', 'usuarios.id_estados = estados.id_estados');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = usuarios.id_tipo_planes');
		/* Si es necesario ordenarlo */
		if ($order_by) {
			$this->db->order_by('usuarios.orden');
		}

		/* Obtengo la informacion */
		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";

		/* Retorno resultados de lo que consulté */
		return $query->result();
	}

	/*FUNCION OBTENER ROLES  */ 

	public function get_roles ($tabla=null) {
		if ($tabla) {
			$this->db->where("tabla",$tabla);	
		}
		$this->db->where("id_estados",1);
		$this->db->order_by('roles.orden');
		$query = $this->db->get("roles");
		return $query->result();
	}




##Consulto la cantidad de estudiantes inscritos al curso y al modulo visto
	public function get_cursos_estudiante($id_cursos,$id_usuarios){
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
		$this->db->where('cursos_asignados.id_estados',1);
		$query = $this->db->get('cursos_asignados');
		return $query->row();


	}




##Consulto la cantidad de estudiantes inscritos al curso y al modulo visto
	public function get_cursos_estudiante_lista($id_usuarios){
		$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
		$this->db->where('cursos_asignados.id_estados',1);
		$query = $this->db->get('cursos_asignados');
		return $query->result();


	}







}


