<?php
/**
Esta es la clasde del modulo 
**/


class Model_Cursos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select("tipo_planes.nombre as tipo_plan,estados.nombre as estado_nombre,cursos.orden,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados");

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
		$this->db->join('estados', 'cursos.id_estados = estados.id_estados');
		if ($order_by) {
			$this->db->order_by('cursos.orden');
		}


		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


	public function listado_mios($tabla,$where=null,$order_by=null){

		$this->db->select("estados.nombre as estado_nombre,cursos.orden,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados");

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->join('estados', 'cursos.id_estados = estados.id_estados');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
		if ($order_by) {
			$this->db->order_by('cursos.orden');
		}




		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		$resultados = $query->result();

		foreach ($resultados as $key => $value) {

			$instructores_asignados=json_decode($value->instructores_asignados);

			if ( !in_array($this->session->userdata('id_usuario'), $instructores_asignados) ) {
				unset($resultados[$key]);
			}


		}


		return $resultados;


	}




	public function instructores_lista($id_instructores) {
		if ($id_instructores)  {
			$this->db->select("usuarios.nombres,usuarios.apellidos,usuarios.correo");



			$this->db->where_in('id_usuarios', $id_instructores);

			$this->db->where('usuarios.id_estados',1	);
			$this->db->where('id_roles',2);
			$this->db->order_by('usuarios.orden');

			$query = $this->db->get('usuarios');
	#echo  $this->db->last_query()."<br>";
			$resultados=$query->result();
			$retornar=array();
			foreach ($resultados as $key => $value) {
				$retornar[]=$value->nombres." ".$value->apellidos."[ ".$value->correo." ]";
			}

			$retorno=implode("<br>", $retornar);
			return $retorno;
		} else {
			return false;
		}
	}







	public function listado_instructores($tabla,$where=null,$order_by=null){

		$this->db->select($tabla.".*,estados.nombre as estado_nombre");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->where('id_roles',2);
		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');

		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}






	public function get_cursos_lista($palabra=null){
		$this->db->select ('tipo_planes.nombre as tipo_plan,tipo_planes.id_tipo_planes,cursos.*');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->where('cursos.id_estados',1);


		if ($palabra!='')  {
			$this->db->like('cursos.titulo', $palabra); 
			#$this->db->or_like('cursos.descripcion', $palabra); 
			$this->db->or_like('categoria_cursos.nombre', $palabra); 		
		}


		#$this->db->where('cursos.destacar',1);
		$query = $this->db->get('cursos');
		return $query->result();
	}






}


