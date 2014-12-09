<?php
/* CLASE-MODELO DEL MODULO */

class Model_mensajes extends CI_Model{




	public function listado($id_usuarios,$tabla,$where=null,$order_by=null){

		$this->db->select($tabla.".*,estados.nombre as estado_nombre,usuarios.*,cursos.*,".$tabla.".id_estados as estado_mensaje, usuarios.foto as foto_estudiante");
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




#funcion para obtener los cursos asignados del docente
	public function get_modulo($id_cursos) {
		$this->db->where('modulos.id_estados',$this->config->item('estado_activo'));
		$this->db->where('modulos.id_cursos',$id_cursos);
		$query = $this->db->get('modulos');
		$resultados=$query->row();
		return $resultados;
	}



#funcion para obtener los cursos asignados del docente
	public function get_activ_barra($id_modulos) {
		$this->db->where('actividades_barra.id_estados',$this->config->item('estado_activo'));
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		return $resultados;
	}



}