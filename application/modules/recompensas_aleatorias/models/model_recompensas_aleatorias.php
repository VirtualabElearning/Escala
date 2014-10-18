<?php
/* CLASE-MODELO DEL MODULO */

class Model_Recompensas_aleatorias extends CI_Model{

	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select($tabla.".*,estados.nombre as nombre_estado,actividades_videos.nombre_actividad as nombre_video ,logros.nombre as nombre_logro");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}

		$this->db->join('actividades_videos', $tabla.'.id_actividades_videos = actividades_videos.id_actividades_videos', 'left');
		#$this->db->join('actividades_foro', $tabla.'.id_actividades_foro = actividades_foro.id_actividades_foro', 'left');
		$this->db->join('logros', $tabla.'.id_logros = logros.id_logros', 'left');

		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');

		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);
		
		return $query->result();
	}



}