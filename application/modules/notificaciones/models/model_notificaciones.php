<?php
/* CLASE-MODELO DEL MODULO */

class Model_Notificaciones extends CI_Model{


	#funcion para obtener los cursos asignados del docente
	public function cursos_list_doc($id_usuarios) {
		$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));
		$this->db->like('cursos.instructores_asignados', '"'.$id_usuarios.'"'); 
		$query = $this->db->get('cursos');
		$resultados=$query->result();
		#echo $this->db->last_query();
		return $resultados;
	}




	#funcion para obtener los cursos asignados del docente
	public function get_estudiantes_curso($id_cursos) {
		$this->db->where('usuarios.id_estados',$this->config->item('estado_activo'));
		$this->db->where('usuarios.id_roles',3);  ## solo estudiantes
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$this->db->join('cursos_asignados', 'cursos_asignados.id_usuarios = usuarios.id_usuarios');	
		$query = $this->db->get('usuarios');
		$resultados=$query->result();
		#echo $this->db->last_query();
		return $resultados;
	}



	public function listado($tabla,$where=null,$order_by=null,$wherein=null){

		$this->db->select($tabla.".*,estados.nombre as estado_nombre, usuarios.nombres as nombre_usuario,usuarios.apellidos as apellidos_usuario,cursos.titulo as curso_titulo");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}

		if ($wherein) {
			$this->db->where_in($tabla.'.id_cursos', $wherein);
		}


		$this->db->join('usuarios', $tabla.'.id_usuarios = usuarios.id_usuarios');
		$this->db->join('cursos', $tabla.'.id_cursos = cursos.id_cursos');





			$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');

		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}





}