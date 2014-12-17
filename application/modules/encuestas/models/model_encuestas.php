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



	public function get_respuestas($id_encuestas,$id_cursos,$id_usuarios){
		$this->db->join('usuarios', 'encuestas_respuestas.id_usuarios = usuarios.id_usuarios');
		$this->db->join('cursos', 'encuestas_respuestas.id_cursos = cursos.id_cursos');
		$this->db->join('encuestas', 'encuestas_respuestas.id_encuestas = encuestas.id_encuestas');
		$this->db->join('encuestas_detalle', 'encuestas_respuestas.id_encuestas_detalle = encuestas_detalle.id_encuestas_detalle');
		$this->db->where('encuestas_respuestas.id_encuestas',$id_encuestas);
		$this->db->where('encuestas_respuestas.id_cursos',$id_cursos);
		$this->db->where('encuestas_respuestas.id_usuarios',$id_usuarios);
		$query = $this->db->get('encuestas_respuestas');
		$r=$query->result();
		#krumo ($this->db->last_query());
		return $r;
	}




	public function get_respuestas_lista_usuarios ($id_encuestas) {
		$this->db->where('encuestas_respuestas.id_encuestas',$id_encuestas);
		$this->db->join('usuarios', 'encuestas_respuestas.id_usuarios = usuarios.id_usuarios');
		$this->db->join('cursos', 'encuestas_respuestas.id_cursos = cursos.id_cursos');
		$this->db->join('encuestas', 'encuestas_respuestas.id_encuestas = encuestas.id_encuestas');
		$this->db->join('encuestas_detalle', 'encuestas_respuestas.id_encuestas_detalle = encuestas_detalle.id_encuestas_detalle');
		$this->db->group_by("encuestas_respuestas.id_cursos");
		$this->db->group_by("encuestas_respuestas.id_usuarios"); 

		$query = $this->db->get('encuestas_respuestas');
		$r=$query->result();
		#krumo ($this->db->last_query());
		return $r;
	}



public function get_respuestas_lista_usuarios_todos ($id_encuestas) {
		$this->db->where('encuestas_respuestas.id_encuestas',$id_encuestas);
		$this->db->join('usuarios', 'encuestas_respuestas.id_usuarios = usuarios.id_usuarios');
		$this->db->join('cursos', 'encuestas_respuestas.id_cursos = cursos.id_cursos');
		$this->db->join('encuestas', 'encuestas_respuestas.id_encuestas = encuestas.id_encuestas');
		$this->db->join('encuestas_detalle', 'encuestas_respuestas.id_encuestas_detalle = encuestas_detalle.id_encuestas_detalle');
		$this->db->order_by("cursos.id_cursos", "asc"); 
		$this->db->order_by("usuarios.id_usuarios", "asc");
		$query = $this->db->get('encuestas_respuestas');
		$r=$query->result();
		#krumo ($this->db->last_query());
		return $r;
	}




	public function get_preguntas($id_encuestas){
		$this->db->where('id_encuestas',$id_encuestas);
		$query = $this->db->get('encuestas_detalle');
		$r=$query->result();
		return $r;
	}

	public function get_total_respuestas ($id_encuestas,$id_encuestas_detalle) {
		$this->db->where('encuestas_respuestas.id_encuestas',$id_encuestas);
		$this->db->where('encuestas_detalle.id_encuestas_detalle',$id_encuestas_detalle);
		$this->db->join('encuestas_detalle', 'encuestas_respuestas.id_encuestas_detalle = encuestas_detalle.id_encuestas_detalle');
		$this->db->from('encuestas_respuestas');
		$r=$this->db->count_all_results();

		#krumo ($this->db->last_query());
		return $r;
	}


	public function get_encuesta_respondida ($id_encuestas) {
		$this->db->where('encuestas_respuestas.id_encuestas',$id_encuestas);
		$this->db->group_by("encuestas_respuestas.id_usuarios"); 
		$this->db->from('encuestas_respuestas');
		$r=$this->db->count_all_results();

		
		return $r;
	}


}