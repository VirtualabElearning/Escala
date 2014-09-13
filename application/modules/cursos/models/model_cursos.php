<?php
/**
Esta es la clasde del modulo 
**/


class Model_Cursos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select("tipo_planes.nombre as tipo_plan,cursos.maximo_estudiantes,estados.nombre as estado_nombre,cursos.orden,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados,tipo_planes.nombre as tipo_plan");

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

		$this->db->select("estados.nombre as estado_nombre,cursos.orden,cursos.maximo_estudiantes,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados,tipo_planes.nombre as tipo_plan");

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



	public function get_mis_cursos_lista($mis_cursos){

		if ($mis_cursos) {
			
			$this->db->select ('tipo_planes.nombre as tipo_plan,tipo_planes.id_tipo_planes,cursos.*');
			$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
			$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');


			$this->db->where_in('cursos.id_cursos', $mis_cursos);
			$this->db->where('cursos.id_estados',1);



		#$this->db->where('cursos.destacar',1);
			$query = $this->db->get('cursos');
		#echo  $this->db->last_query()."<br>";
			return $query->result();
		}
		else {

			return false;

		}

	}


	public function get_cursos_lista($op=null,$palabra=null,$cursos_asignados=null){


		$this->db->select ('tipo_planes.nombre as tipo_plan,tipo_planes.id_tipo_planes,cursos.*');
		$this->db->join('tipo_planes', 'tipo_planes.id_tipo_planes = cursos.id_tipo_planes');
		$this->db->join('categoria_cursos', 'categoria_cursos.id_categoria_cursos = cursos.id_categoria_cursos');
		$this->db->where('cursos.id_estados',1);

		if ($cursos_asignados!='')  {
			$this->db->where_in('cursos.id_cursos', json_decode($cursos_asignados));
		}


		if ($palabra!='' && $op=='buscar')  {
			$this->db->like('cursos.titulo', $palabra); 
			#$this->db->or_like('cursos.descripcion', $palabra); 
			$this->db->or_like('categoria_cursos.nombre', $palabra); 		
		}




		#$this->db->where('cursos.destacar',1);
		$query = $this->db->get('cursos');
		return $query->result();
	}




	public function get_instructores_asignados($instructores){
		$this->db->where_in('usuarios.id_usuarios', $instructores);
		$this->db->where('usuarios.id_estados',1);
		$this->db->where('usuarios.id_roles',2);
		$query = $this->db->get('usuarios');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


	public function get_modulos($id_cursos){

		$this->db->where('modulos.id_estados',1);
		$this->db->where('modulos.id_cursos',$id_cursos);
		$this->db->order_by('modulos.orden');
		$query = $this->db->get('modulos');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}





	public function get_modulos_vistos($id_cursos,$id_usuarios){

		$this->db->where('modulos_vistos.id_estados',2);
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$query = $this->db->get('modulos_vistos');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}




	public function get_modulo_visto($id_cursos,$id_modulos,$id_actividades,$id_usuarios){

		$this->db->where('modulos_vistos.id_estados',2);
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$this->db->where('modulos_vistos.id_modulos',$id_modulos);
		$this->db->where('modulos_vistos.id_actividades',$id_actividades);
		$query = $this->db->get('modulos_vistos');
		#echo  $this->db->last_query()."<br>";
		return $query->row();
	}


## inserto el modulo visto y lo consulto
	public function insertar_modulo_visto($id_cursos,$id_modulos,$id_actividades_barra,$id_usuarios){

		$data=array('id_cursos'=>$id_cursos,'id_modulos'=>$id_modulos,'id_actividades'=>$id_actividades_barra,'id_usuarios'=>$id_usuarios,'id_estados'=>2);

		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$id_usuarios;  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$id_usuarios; 
		$this->db->insert('modulos_vistos', $data);


		$this->db->where('modulos_vistos.id_estados',2);
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_modulos',$id_modulos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$query = $this->db->get('modulos_vistos');

		return $query->row();

	}






	public function get_actividad($id_modulos,$id_actividades){

		$this->db->where('actividades_barra.id_estados',1);
		$this->db->where('actividades_barra.id_actividades_barra',$id_actividades);
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();

		$this->db->where('tipo_actividades.id_estados',1);
		$this->db->where('tipo_actividades.id_tipo_actividades',$resultados->id_tipo_actividades);
		$query = $this->db->get('tipo_actividades');
		$resultados2=$query->row();


		$this->db->where($resultados2->tabla_actividad.'.id_estados',1);
		$this->db->where($resultados2->tabla_actividad.'.id_'.$resultados2->tabla_actividad,$resultados->id_actividades);
		$query = $this->db->get($resultados2->tabla_actividad);
		
		$resultados3=$query->row();





		$retorno=array($resultados,$resultados2,$resultados3);
		return ($retorno);
	}


## obtengo los descargables del modulo
	public function get_descargables($id_cursos){
		$this->db->where('descargables.id_estados',1);
		$this->db->join('modulos', 'modulos.id_modulos = descargables.id_modulos');
		$this->db->where('modulos.id_cursos',$id_cursos);
		$query = $this->db->get('descargables');
		$resultados=$query->result();
		return $resultados;

	}



	public function get_modulo_activ($id_cursos){
		$this->db->where('modulos.id_estados',1);
		$this->db->where('modulos.id_cursos',$id_cursos);
		$this->db->order_by('modulos.orden');
		$query = $this->db->get('modulos');
		$resultados=$query->row();


		$this->db->where('actividades_barra.id_estados',1);
		$this->db->where('actividades_barra.id_modulos',$resultados->id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();


		return $resultados;

	}



##obtengo el listado de actividades de un modulo
	public function get_actividades($id_modulos) {

		$this->db->where('actividades_barra.id_estados',1);
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->result();
		return ($resultados);
	}



##obtengo la primera actividad de un modulo
	public function get_first_actividad($id_modulos) {

		$this->db->where('actividades_barra.id_estados',1);
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		return ($resultados);
	}





##obtengo el listado de actividades de un modulo
	public function get_docente($id_usuarios) {
		$this->db->where('usuarios.id_estados',1);
		$this->db->select('usuarios.nombres,usuarios.apellidos,usuarios.foto,usuarios.correo,usuarios.identificacion,usuarios.resumen_de_perfil');
		$this->db->where('usuarios.id_usuarios',$id_usuarios);
		$query = $this->db->get('usuarios');
		$resultados=$query->row();
		return ($resultados);
	}


#obtengo los mensajes del foro en particular y su respectivo usuario
	public function get_mensajes_foro($id_actividades_foro) {
		$this->db->where('actividades_foro_mensajes.id_estados',1);
		$this->db->select('actividades_foro_mensajes.*,usuarios.nombres,usuarios.apellidos,usuarios.correo,usuarios.foto as foto_usuario,estatus.nombre as nombre_estatus');
		$this->db->join('usuarios', 'actividades_foro_mensajes.id_usuario_modificado = usuarios.id_usuarios');
		$this->db->join('estatus', 'estatus.id_estatus = usuarios.id_estatus');

		$this->db->where('actividades_foro_mensajes.id_actividades_foro',$id_actividades_foro);
		$query = $this->db->get('actividades_foro_mensajes');
		$resultados=$query->result();
		#echo  $this->db->last_query()."<br>";
		return ($resultados);
	}
	


	public function get_megustas ($id_actividades,$id_actividades_foro_mensajes=null,$id_usuarios) {
		$this->db->where('actividades_foro_megusta.id_estados',1);
		$this->db->where('actividades_foro_megusta.id_actividades',$id_actividades);
		##esta condicion es por si depronto es un estudiante el me gusta del mensaje
		if ($id_actividades_foro_mensajes) {
			$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes',$id_actividades_foro_mensajes);
		}
		else {

			$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes',0);
		}

		$this->db->where('actividades_foro_megusta.id_usuarios',$id_usuarios);
		$query = $this->db->get('actividades_foro_megusta');
		return $query->result();

	}



	public function get_megustas_estudiante ($id_actividades,$id_actividades_foro_mensajes=null,$id_usuarios) {
		$this->db->where('actividades_foro_megusta.id_estados',1);
		$this->db->where('actividades_foro_megusta.id_actividades',$id_actividades);
		##esta condicion es por si depronto es un estudiante el me gusta del mensaje
		if ($id_actividades_foro_mensajes) {
			$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes',$id_actividades_foro_mensajes);
		}
		

		$this->db->where('actividades_foro_megusta.id_usuarios',$id_usuarios);
		$query = $this->db->get('actividades_foro_megusta');
		return $query->result();

	}


##para poder validar si ya le di me gusta o no
	public function get_if_megusta ($id_usuario_modificado,$id_actividades,$id_actividades_foro_mensajes=null) {
		$this->db->where('actividades_foro_megusta.id_usuario_modificado',$id_usuario_modificado);
		$this->db->where('actividades_foro_megusta.id_actividades',$id_actividades);

		if ($id_actividades_foro_mensajes) {
			$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes',$id_actividades_foro_mensajes);
		}
		$query = $this->db->get('actividades_foro_megusta');
		return $query->row();
	}



/*
	public function get_estudiantes_inscritos($id_cursos){

		$this->db->where('usuarios.id_estados',1);
		$query = $this->db->get('usuarios');

		$resultados=$query->result();

		foreach ($resultados as $key => $value) {
			krumo (json_decode($value->id_cursos_asignados));
		}

		exit;

		return $query->result();
	}
*/






}


