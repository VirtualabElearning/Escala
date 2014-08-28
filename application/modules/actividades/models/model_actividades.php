<?php

class Model_Actividades extends CI_Model{



	public function listado($id_cursos,$id_modulos){


		$this->db->where('cursos.id_cursos',$id_cursos);

		$this->db->where('modulos.id_modulos',$id_modulos);


	#$data['titulos']=array("Orden","ID","Tipo actividad","Nombre actividad","Descripcion","Estado","Opciones");
		$this->db->select('estados.nombre as estado_nombre,actividades_barra.id_estados,actividades_barra.orden,actividades_barra.id_actividades_barra,actividades_barra.id_actividades,actividades_barra.id_tipo_actividades,actividades_barra.id_modulos,nombre_tipo_actividades,tabla_actividad,modulos.nombre_modulo,cursos.titulo as nombre_curso,categoria_cursos.nombre as nombre_categoria_curso');
		$this->db->join('tipo_actividades', 'tipo_actividades.id_tipo_actividades = actividades_barra.id_tipo_actividades');

		$this->db->join('modulos', 'modulos.id_modulos = actividades_barra.id_modulos');
		$this->db->join('cursos', 'modulos.id_cursos = cursos.id_cursos');
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->join('estados','actividades_barra.id_estados = estados.id_estados');
		$this->db->order_by('actividades_barra.orden', 'asc');
		$query = $this->db->get('actividades_barra');
	#echo  $this->db->last_query()."<br>";
		return $query->result();
	}



	public function detalle_editar($id){

		$this->db->select('actividades_barra.id_estados,actividades_barra.orden,actividades_barra.id_actividades_barra,actividades_barra.id_actividades,actividades_barra.id_tipo_actividades,actividades_barra.id_modulos,nombre_tipo_actividades,tabla_actividad');
		$this->db->join('tipo_actividades', 'tipo_actividades.id_tipo_actividades = actividades_barra.id_tipo_actividades');

		$this->db->where('id_actividades_barra',$id); 
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		$actividad_dato=$this->detalle($resultados->tabla_actividad,array('id_'.$resultados->tabla_actividad,$resultados->id_actividades));
		$resultados->datos_actividad=$actividad_dato;

		return $resultados;
	}


	public function get_tipo_actividades($id_tipo_actividades=null){
		$this->db->where('id_estados',1);
		if ($id_tipo_actividades) {
			$this->db->where('id_tipo_actividades',$id_tipo_actividades); 
		}
		$this->db->order_by('tipo_actividades.orden', 'asc');
		$query = $this->db->get('tipo_actividades');
		if ($id_tipo_actividades) {
			return $query->row();
		}
		else {
			return $query->result();
		}
	}





	public function detalle($tabla,$where=null){

#$this->db->select("");
	$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = '.$tabla.'.id_tipo_planes');



		if (@$where[1]) {
			$this->db->where($where[0],$where[1]);
		}
		$query = $this->db->get($tabla);
		#echo  "<br>".$this->db->last_query()."<br>";
		return $query->row();
	}



	public function guardar ($tabla,$data,$idname=null,$where=null) {

		$id_retorno='';
		if (@$where[1]) {
			$this->db->where($where[0],$where[1]);
			$this->db->update($tabla, $data);


			$id_retorno=$where[1];

		}
		else {
			$this->db->insert($tabla, $data);
			$id_retorno=$this->db->insert_id();
			$this->db->where(array($idname=>$id_retorno));
			$this->db->update($tabla, array('orden'=>$id_retorno));

		}
		return  $id_retorno;
	}



	public function borrar($tabla,$where) {
		$this->db->delete($tabla, $where);
		return 'ok';
	}



	public function ordenar ($tabla,$data,$where) {
		$this->db->where( $where[0],$where[1] );
		$this->db->update( $tabla, $data );
	#echo  $this->db->last_query()."<br>";
		return  true;
	}




	public function get_actividad_url($id_actividades_barra) {

		$this->db->select('id_tipo_actividades,id_modulos,id_actividades');
		$this->db->where('id_actividades_barra',$id_actividades_barra); 
		$query = $this->db->get('actividades_barra');
		$r1=$query->row();

		$this->db->select('tabla_actividad');
		$this->db->where('id_tipo_actividades',$r1->id_tipo_actividades); 
		$query = $this->db->get('tipo_actividades');
		$r2=$query->row();

		$this->db->where('id_'.$r2->tabla_actividad,$r1->id_actividades); 
		$query = $this->db->get($r2->tabla_actividad);
		$r3=$query->row();

		$r3->tabla_actividad=$r2->tabla_actividad;

		return $r3;

	}


public function get_logros() {
		$this->db->select('logros.id_logros,logros.nombre');
		$this->db->where('id_estados',1); 
		$query = $this->db->get('logros');
		return $query->result();

}


public function get_planes() {
		$this->db->select('tipo_planes.id_tipo_planes,tipo_planes.nombre');
		$this->db->where('id_estados',1); 
		$query = $this->db->get('tipo_planes');
		return $query->result();

}



}