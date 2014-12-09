<?php
/**
Esta es la clasde del modulo 
**/


class Model_Cursos extends CI_Model{


	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select("tipo_planes.nombre as tipo_plan,estados.nombre as estado_nombre,cursos.orden,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados,tipo_planes.nombre as tipo_plan");

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

		$this->db->select("estados.nombre as estado_nombre,cursos.orden,cursos.destacar,cursos.id_cursos,categoria_cursos.nombre as nombre_categoria,cursos.titulo,cursos.Descripcion,cursos.id_estados,cursos.instructores_asignados,tipo_planes.nombre as tipo_plan");

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
			$this->db->where('usuarios.id_estados',$this->config->item('estado_activo'));
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
			$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));
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
		$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));

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
		$this->db->where('usuarios.id_estados',$this->config->item('estado_activo'));
		$this->db->where('usuarios.id_roles',2);
		$query = $this->db->get('usuarios');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


	public function get_modulos($id_cursos){

		$this->db->where('modulos.id_estados',$this->config->item('estado_activo'));
		$this->db->where('modulos.id_cursos',$id_cursos);
		$this->db->order_by('modulos.orden');
		$query = $this->db->get('modulos');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


#trae el modulo para premios de video
	public function get_modulos_premios($id_cursos){
		$this->db->where('modulos.id_estados',$this->config->item('estado_premio'));
		$this->db->where('modulos.id_cursos',$id_cursos);
		$this->db->order_by('modulos.orden');
		$query = $this->db->get('modulos');
		return $query->row();
	}



	public function get_modulos_vistos($id_cursos,$id_usuarios){

		$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$query = $this->db->get('modulos_vistos');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


## funcion para traer los modulos vistos del curso actual
	public function get_modulos_vistos_curso_actual($id_cursos,$id_usuarios){

		$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$this->db->group_by(array("id_modulos")); 
		$query = $this->db->get('modulos_vistos');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


##funcion para obtener el plan del curso que estoy viendo en este momento
	public function get_plan_curso($id_cursos,$id_usuarios,$id_estados=1){
		$this->db->select('cursos_asignados.id_tipo_planes');
		$this->db->where('cursos_asignados.id_estados',$id_estados);
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
		$query = $this->db->get('cursos_asignados');
		return $query->row();
	}


	public function get_modulo_visto($id_cursos,$id_modulos,$id_actividades,$id_usuarios){

		$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
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

		$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
		$this->db->where('modulos_vistos.id_modulos',$id_modulos);
		$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
		$query = $this->db->get('modulos_vistos');

		return $query->row();

	}



	public function get_actividad($id_modulos,$id_actividades){

		$this->db->where('actividades_barra.id_estados',$this->config->item('estado_activo'));
		$this->db->where('actividades_barra.id_actividades_barra',$id_actividades);
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		$this->db->where('tipo_actividades.id_estados',$this->config->item('estado_activo'));
		$this->db->where('tipo_actividades.id_tipo_actividades',$resultados->id_tipo_actividades);
		$query = $this->db->get('tipo_actividades');
		$resultados2=$query->row();
		$this->db->where($resultados2->tabla_actividad.'.id_estados',$this->config->item('estado_activo'));
		$this->db->where($resultados2->tabla_actividad.'.id_'.$resultados2->tabla_actividad,$resultados->id_actividades);
		$query = $this->db->get($resultados2->tabla_actividad);
		$resultados3=$query->row();
		$retorno=array($resultados,$resultados2,$resultados3);
		return ($retorno);
	}


## obtengo los descargables del modulo
	public function get_descargables($id_cursos){
		$this->db->where('descargables.id_estados',$this->config->item('estado_activo'));
		$this->db->join('modulos', 'modulos.id_modulos = descargables.id_modulos');
		$this->db->where('modulos.id_cursos',$id_cursos);
		$query = $this->db->get('descargables');
		$resultados=$query->result();
		return $resultados;

	}


	public function get_modulo_activ($id_cursos){
		$this->db->where('modulos.id_estados',$this->config->item('estado_activo'));
		$this->db->where('modulos.id_cursos',$id_cursos);
		$this->db->order_by('modulos.orden');
		$query = $this->db->get('modulos');
		$resultados=$query->row();

		$this->db->where('actividades_barra.id_estados',$this->config->item('estado_activo'));
		$this->db->where('actividades_barra.id_modulos',$resultados->id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		return $resultados;

	}



##obtengo el listado de actividades de un modulo
	public function get_actividades($id_modulos) {
		$this->db->where('actividades_barra.id_estados',$this->config->item('estado_activo'));
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->result();
		return ($resultados);
	}


##obtengo la primera actividad de un modulo
	public function get_first_actividad($id_modulos) {

		$this->db->where('actividades_barra.id_estados',$this->config->item('estado_activo'));
		$this->db->where('actividades_barra.id_modulos',$id_modulos);
		$this->db->order_by('actividades_barra.orden');
		$query = $this->db->get('actividades_barra');
		$resultados=$query->row();
		return ($resultados);
	}


##obtengo el listado de actividades de un modulo
	public function get_docente($id_usuarios) {
		$this->db->where('usuarios.id_estados',$this->config->item('estado_activo'));
		$this->db->select('usuarios.id_usuarios,usuarios.id_roles,usuarios.nombres,usuarios.apellidos,usuarios.foto,usuarios.correo,usuarios.identificacion,usuarios.resumen_de_perfil');
		$this->db->where('usuarios.id_usuarios',$id_usuarios);
		$query = $this->db->get('usuarios');
		$resultados=$query->row();
		return ($resultados);
	}


#obtengo los mensajes del foro en particular y su respectivo usuario
	public function get_mensajes_foro($id_actividades_foro,$id_cursos) {
		$this->db->where('actividades_foro_mensajes.id_estados',$this->config->item('estado_activo'));
		$this->db->select('actividades_foro_mensajes.*,usuarios.nombres,usuarios.apellidos,usuarios.correo,usuarios.foto as foto_usuario,estatus.nombre as nombre_estatus,cursos_asignados.id_estatus');
		$this->db->join('usuarios', 'actividades_foro_mensajes.id_usuario_modificado = usuarios.id_usuarios');
		$this->db->join('cursos_asignados', 'cursos_asignados.id_usuarios = usuarios.id_usuarios');
		$this->db->join('estatus', 'estatus.id_estatus = cursos_asignados.id_estatus');
		$this->db->where('actividades_foro_mensajes.id_actividades_foro',$id_actividades_foro);
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$this->db->order_by('actividades_foro_mensajes.orden', 'desc');
		$query = $this->db->get('actividades_foro_mensajes');

		$resultados=$query->result();
		#echo  $this->db->last_query()."<br>";
		return ($resultados);
	}
	


	public function get_megustas ($id_actividades,$id_actividades_foro_mensajes=null,$id_usuarios) {
		$this->db->where('actividades_foro_megusta.id_estados',$this->config->item('estado_activo'));
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
		$resultados=$query->result();
		#echo  $this->db->last_query()."<br>"; exit;
		#krumo ($resultados);

		return $resultados;

	}


	public function get_megustas_estudiante ($id_actividades,$id_actividades_foro_mensajes=null,$id_usuarios) {
		$this->db->where('actividades_foro_megusta.id_estados',$this->config->item('estado_activo'));
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

		if ($id_actividades_foro_mensajes!='') {
			if (is_numeric($id_actividades_foro_mensajes))   {
				$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes',$id_actividades_foro_mensajes);
			}
			else {
				## si tiene la letra d, es porque debe buscar los me gusta del docente en el post del foro
				if ($id_actividades_foro_mensajes=='d') {
					$this->db->where('actividades_foro_megusta.id_actividades_foro_mensajes','0');
				}
			}
		}
		
		$this->db->from('actividades_foro_megusta');
		$total=$this->db->count_all_results();
		#echo $this->db->last_query();

		return $total;
	}



##funcion si muestro o no el tutorial
	public function get_if_tutorial ($id_usuarios) {
		$this->db->select("mostrar_tutorial");
		$this->db->where('usuarios.id_usuarios',$id_usuarios);
		$query = $this->db->get('usuarios');
		return $query->row();
	}


#funcion para desactivar el tutorial en la cuenta del usuario
	public function update_tutorial ($id_usuarios) {
		$data=array("mostrar_tutorial"=>1);
		$this->db->where('id_usuarios', $id_usuarios);
		$this->db->update('usuarios', $data); 
	}




#funcion para actualizar la posicion de actividad del usuario
	public function update_posicion ($id_actividades_barra,$id_cursos,$id_modulos,$id_usuarios) {
		$data=array("posicion_actividad_barra"=>$id_actividades_barra,"posicion_modulo"=>$id_modulos);
		$this->db->where('id_usuarios', $id_usuarios);
		$this->db->where('id_cursos', $id_cursos);
		$this->db->update('cursos_asignados', $data); 

		#crear_log_txt('update_posicion.txt', $this->db->last_query());


	}



#funcion para actualizar la clase en vivo del curso creado
	public function update_clase_en_vivo ($id_cursos,$url_clase_en_vivo) {
		$data=array("url_clase_en_vivo"=>$url_clase_en_vivo);
		$this->db->where('id_cursos', $id_cursos);
		$this->db->update('cursos', $data); 
	}


	### obtengo la posicion del modulo y actividad actual
	public function get_posicion ($id_cursos,$id_usuarios) {
		$this->db->select("posicion_actividad_barra,posicion_modulo");
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
		$query = $this->db->get('cursos_asignados');
		return $query->row();
	}





	public function update_pos_mensaje ($id_actividad,$cant_megusta) {
		$data=array("orden"=>$cant_megusta);
		$this->db->where('id_actividades_foro_mensajes', $id_actividad);
		$this->db->update('actividades_foro_mensajes', $data); 
		

	}

##funcion de consultar cursos del usuario
	public function get_cursos ($id_usuarios) {
		$this->db->select("id_cursos_asignados");
		$this->db->where('usuarios.id_estados',$this->config->item('estado_activo'));
		$this->db->where('usuarios.id_usuarios',$id_usuarios);
		$query = $this->db->get('usuarios');
		$resultados=$query->row();
		$mis_cursos=json_decode($resultados->id_cursos_asignados);
		return $mis_cursos;
	}


##funcion de consultar cursos del usuario
	public function get_curso ($id_cursos) {
		$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));
		$this->db->where('cursos.id_cursos',$id_cursos);
		$query = $this->db->get('cursos');
		$resultados=$query->row();
		return $resultados;
	}


##funcion de consultar un logro
	public function get_logro ($id_logros) {
		$this->db->where('logros.id_estados',$this->config->item('estado_activo'));
		$this->db->where('logros.id_logros',$id_logros);
		$query = $this->db->get('logros');
		return $query->row();
	}


##funcion de consultar cuantos puntos del usuario tiene por el curso actual
	public function get_puntos_totales_en_curso ($id_usuarios,$id_cursos) {
		$this->db->select_sum('puntaje');
		$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
		$this->db->where('puntaje.id_usuarios',$id_usuarios);
		$this->db->where('puntaje.id_cursos',$id_cursos);
		$query = $this->db->get('puntaje');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}


## funcion para obtener los puntos por listado y por usuario y si es necesario por motivo 
	public function get_puntos ($id_usuarios,$id_cursos=null,$id_motivos=null) {

		$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
		$this->db->where('puntaje.id_usuarios',$id_usuarios);
		if ($id_cursos) {
			$this->db->where('puntaje.id_cursos',$id_cursos);
		}
		
		if ($id_motivos) {
			$this->db->where('puntaje.id_motivos',$id_motivos);
		}

		$query = $this->db->get('puntaje');
		#echo  $this->db->last_query()."<br>";
		return $query->result();
	}



## funcion para obtener los puntos por algun motivo o un listado de ello
	public function get_punto ($id_usuarios,$id_cursos,$id_motivos) {

		$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
		$this->db->where('puntaje.id_usuarios',$id_usuarios);
		$this->db->where('puntaje.id_cursos',$id_cursos);
		$this->db->where('puntaje.id_motivos',$id_motivos);
		$query = $this->db->get('puntaje');
		#echo  $this->db->last_query()."<br>";
		return $query->row();
	}



## funcion para obtener los puntos por algun motivo (solo para el foro de mensajes de estudiante)
	public function get_punto_var_extra ($id_usuarios,$id_cursos,$id_motivos,$variable_extra) {
		$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
		$this->db->where('puntaje.id_usuarios',$id_usuarios);
		$this->db->where('puntaje.id_cursos',$id_cursos);
		$this->db->where('puntaje.id_motivos',$id_motivos);
		$this->db->where('puntaje.variable_extra',$variable_extra);
		$query = $this->db->get('puntaje');
		#echo  $this->db->last_query()."<br>";
		return $query->row();
	}




##funcion de agregar puntos al usuario del curso
	public function add_puntos ($id_cursos,$id_modulos,$id_usuarios,$puntaje,$id_motivos,$id_actividades_barra=null,$update=null,$id_actividades_foro_mensajes=null) {
		$data=array('id_cursos'=>$id_cursos,'id_modulos'=>$id_modulos,'id_usuarios'=>$id_usuarios,'puntaje'=>$puntaje,'id_estados'=>$this->config->item('estado_activo'));
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$id_usuarios;  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$id_usuarios; 
		$data['id_motivos']=$id_motivos; 
		$data['variable_extra']=$id_actividades_foro_mensajes; 

		## si tengo la variable de la actividad, consulto antes de, si ya le habia asignado puntos a esa actividad puntual
		if ($id_actividades_barra) { 
			$this->db->where('puntaje.id_cursos',$id_cursos);
			$this->db->where('puntaje.id_modulos',$id_modulos);
			$this->db->where('puntaje.id_actividades_barra',$id_actividades_barra);
			$this->db->where('puntaje.id_usuarios',$id_usuarios);
			$this->db->where('puntaje.id_motivos',$id_motivos);
			$this->db->from('puntaje');
			if ($this->db->count_all_results()>0)  {
				if (!$update)  {
					return "error";
				}
				## si hay resultados y opcion de actualizar
				else {
					$this->db->where('puntaje.id_cursos',$id_cursos);
					$this->db->where('puntaje.id_modulos',$id_modulos);
					$this->db->where('puntaje.id_actividades_barra',$id_actividades_barra);
					$this->db->where('puntaje.id_usuarios',$id_usuarios);
					$this->db->where('puntaje.id_motivos',$id_motivos);
					$data['id_actividades_barra']=$id_actividades_barra;
					unset($data['fecha_creado']);
					unset($data['id_usuario_creado']);
					$this->db->update('puntaje', $data);

				}
			}
			else {
				$data['id_actividades_barra']=$id_actividades_barra;
				$this->db->insert('puntaje', $data);
				return "";
			}

		} else {

##si no tiene id_actividades_barra
			$this->db->where('puntaje.id_cursos',$id_cursos);
			$this->db->where('puntaje.id_modulos',$id_modulos);
			$this->db->where('puntaje.id_usuarios',$id_usuarios);
			$this->db->where('puntaje.id_motivos',$id_motivos);
			$this->db->from('puntaje');
			if ($this->db->count_all_results()>0)  {
				return "error";
			}
			else {
				$this->db->insert('puntaje', $data);
				return "";
			}
		}
	}


## funcion para actualizar puntos en caso que no se quieran agregarse como nuevo (caso para los porcentajes de los puntos de los me gusta de los mensajes del foro)
	public function update_puntos ($id_cursos,$id_modulos,$id_usuarios,$id_motivos,$id_actividades_barra,$variable_extra=null,$data) {
		$this->db->where('puntaje.id_cursos',$id_cursos);
		$this->db->where('puntaje.id_modulos',$id_modulos);
		$this->db->where('puntaje.id_usuarios',$id_usuarios);
		$this->db->where('puntaje.id_motivos',$id_motivos);
		if ($variable_extra) {
			$this->db->where('puntaje.variable_extra',$variable_extra);
		}
		$this->db->where('puntaje.id_actividades_barra',$id_actividades_barra);
		$this->db->update('puntaje', $data);
		return "ok";
	}


	##funcion para actualizar una notificacion existente para el proceso de foro
	public function update_notificacion ($variable_extra,$id_usuarios,$data) {
		$this->db->where('notificaciones.id_usuarios',$id_usuarios);
		$this->db->where('notificaciones.variable_extra',$variable_extra);
		$this->db->update('notificaciones', $data);
		#echo $this->db->last_query();
	#	crear_log_txt("sqlxz.txt",$this->db->last_query());
		return "ok";
	}




#function para agregar las respuestas del usuario segun actividad realizada
	public function add_respuesta ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$id_usuarios,$respuestas,$tipo_pregunta=null,$update=null) {
		$ccvdf='';
		$data=array('id_cursos'=>$id_cursos,'id_modulos'=>$id_modulos,'id_actividades_barra'=>$id_actividades_barra,'id_actividades'=>$id_actividades,
			'id_usuarios'=>$id_usuarios,'respuestas'=>$respuestas,'id_estados'=>$this->config->item('estado_activo'),'tipo_pregunta'=>$tipo_pregunta);
		$data['fecha_modificado']=date('Y-m-d H:i:s',time());  
		$data['id_usuario_modificado']=$id_usuarios;  
		$data['fecha_creado']=date('Y-m-d H:i:s',time()); 
		$data['id_usuario_creado']=$id_usuarios; 

		if (!$update) {
			$this->db->insert('actividades_respuestas_usuario', $data);
		} else {
			## si existe resultados y la opcion de actualizar, actualizo la informacion existente
			$this->db->where('actividades_respuestas_usuario.id_cursos',$id_cursos);
			$this->db->where('actividades_respuestas_usuario.id_modulos',$id_modulos);
			$this->db->where('actividades_respuestas_usuario.id_actividades',$id_actividades);
			$this->db->where('actividades_respuestas_usuario.id_usuarios',$id_usuarios);
			$this->db->where('actividades_respuestas_usuario.id_actividades_barra',$id_actividades_barra);
			$this->db->from('actividades_respuestas_usuario');
			$ccvdf=$this->db->count_all_results();
			
			if ($ccvdf>0)  {
				$this->db->where('id_cursos',$id_cursos);
				$this->db->where('id_modulos',$id_modulos);
				$this->db->where('id_actividades',$id_actividades);
				$this->db->where('id_usuarios',$id_usuarios);
				unset($data['fecha_creado']);
				unset($data['id_usuario_creado']);
				$this->db->update('actividades_respuestas_usuario', $data);
				#echo  $this->db->last_query()."\n\n";
			}


##si no existe, inserto
			else {
				$this->db->insert('actividades_respuestas_usuario', $data);
				#echo "x2x\n";
			}
		}
	}

##obtengo respuestas del usuario si es evaluacion o pregunta rapida.
	public function get_respuestas ($id_cursos,$id_modulos,$id_actividades_barra,$id_actividades,$id_usuarios) {
		$this->db->where('actividades_respuestas_usuario.id_cursos',$id_cursos);
		$this->db->where('actividades_respuestas_usuario.id_modulos',$id_modulos);
		$this->db->where('actividades_respuestas_usuario.id_actividades_barra',$id_actividades_barra);
		$this->db->where('actividades_respuestas_usuario.id_actividades',$id_actividades);
		$this->db->where('actividades_respuestas_usuario.id_usuarios',$id_usuarios);
		$query = $this->db->get('actividades_respuestas_usuario');
		return $query->row();
	}


##funcion para tener y consultar alguna notificacion del usuario actual, de la actividad actual, curso actual y modulo actual
	public function get_notificacion_usuario_curso ($id_cursos,$id_modulos,$id_actividades_barra,$id_usuarios,$variable_extra=null) {
		$this->db->where('notificaciones.id_cursos',$id_cursos);
		$this->db->where('notificaciones.id_modulos',$id_modulos);
		$this->db->where('notificaciones.id_actividades_barra',$id_actividades_barra);
		$this->db->where('notificaciones.id_usuarios',$id_usuarios);

		if ($variable_extra) {
			$this->db->where('notificaciones.variable_extra',$variable_extra);
		}

		$query = $this->db->get('notificaciones');
		return $query->row();
	}


##funcion de consultar estatus del usuario
	public function get_status ($id_estatus=null) {
		$this->db->where('estatus.id_estados',$this->config->item('estado_activo'));
		if ($id_estatus) {
			$this->db->where('estatus.id_estatus',$id_estatus);
			$query = $this->db->get('estatus');
			return $query->row();
		}
		else {
			$query = $this->db->get('estatus');
			return $query->result();
		}
		
	}



##funcion de consultar logros del usuario actual del curso actual
	public function get_mislogros ($id_cursos,$id_modulos,$id_usuarios,$id_logros_usuarios=null) {
		$this->db->where('logros_usuarios.id_estados',$this->config->item('estado_utilizado'));
		$this->db->where('logros_usuarios.id_usuarios',$id_usuarios);
		if ($id_logros_usuarios) {
			$this->db->where('logros_usuarios.id_logros_usuarios',$id_logros_usuarios);
			$query = $this->db->get('logros_usuarios');
			$retorno=$query->row();
			#echo  $this->db->last_query();
		}
		else {
			$query = $this->db->get('logros_usuarios');
			$retorno=$query->result();
			#echo  $this->db->last_query();
		}
		
		return $retorno;
	}


##funcion de consultar estatus actual del usuario en el curso
	public function get_status_micurso ($id_usuarios,$id_cursos) {
		$this->db->select('id_estatus');
		$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
		$this->db->where('cursos_asignados.id_cursos',$id_cursos);
		$query = $this->db->get('cursos_asignados');
		$resultados=$query->row();
		return $resultados;
	}


##funcion que actualiza el estado del curso actual del estudiante actual
	public function update_estado_curso_asignado($id_usuarios,$id_cursos,$data) {
		$this->db->where('cursos_asignados.id_usuarios', $id_usuarios);
		$this->db->where('cursos_asignados.id_cursos', $id_cursos);
		$this->db->update('cursos_asignados', $data); 

	}



##funcion de consultar mi foro creado en el curso y modulo actual
	public function get_mi_foro_creado ($id_usuarios,$id_cursos,$id_modulos) {
		$this->db->where('actividades_foro_usuarios.id_estados',$this->config->item('estado_utilizado'));
		$this->db->where('actividades_foro_usuarios.id_usuarios',$id_usuarios);
		$this->db->where('actividades_foro_usuarios.id_cursos',$id_cursos);
		$this->db->where('actividades_foro_usuarios.id_modulos',$id_modulos);
		$this->db->where(array('actividades_foro_usuarios.id_actividades_foro !='=> 0)); 
		$query = $this->db->get('actividades_foro_usuarios');
		$resultados=$query->row();
		return $resultados;
	}




##funcion listado para traer la lista de competencias segun curso
	public function listado_compe($id_cursos){
		$this->db->where('competencias.id_cursos',$id_cursos);
		$this->db->where('competencias.id_estados',$this->config->item('estado_activo'));
		$this->db->select('estados.nombre as estado_nombre,competencias.*');
		$this->db->join('estados','competencias.id_estados = estados.id_estados');
		$this->db->order_by('competencias.orden', 'asc');
		$query = $this->db->get('competencias');
		return $query->result();
	}

##obtengo la competencia
	public function get_compe($id_competencias){
		$this->db->where('competencias.id_competencias',$id_competencias);
		$this->db->where('competencias.id_estados',$this->config->item('estado_activo'));
		$query = $this->db->get('competencias');
		return $query->row();
	}

##obtengo un premio sorpresa de forma aleatoria para la caja sorpresa al terminar cada modulo de un cursos
#	public function get_premio_sorpresa($blacklist_video=null,$blacklist_foro=null,$blacklist_logro=null){

	public function get_premio_sorpresa($id_recompensas_aleatorias=null){
		$this->db->where('recompensas_aleatorias.id_estados',$this->config->item('estado_activo'));
		
		## esto hace que no se repita el premio
		if ($id_recompensas_aleatorias) { $this->db->where_not_in('recompensas_aleatorias.id_recompensas_aleatorias', $id_recompensas_aleatorias); }

		#$this->db->where('recompensas_aleatorias.id_recompensas_aleatorias',5);
        $this->db->order_by('id_recompensas_aleatorias', 'RANDOM');  #crk

        $this->db->limit(1);
        $query = $this->db->get('recompensas_aleatorias');
		#echo $this->db->last_query(); exit;

        #crear_log_txt("v_sql.txt",$this->db->last_query()."\n\n");
        return $query->row();
    }


##Consulto si ya tengo premio en este modulo de este curso
    public function get_if_premio_sorpresa($id_cursos=null,$id_modulos=null,$id_usuarios=null,$todo=null){
    	#$this->db->where('recompensas_aleatorias_usuarios.id_estados',$this->config->item('estado_utilizado'));
    	if ($id_cursos) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_cursos',$id_cursos);
    	}
    	if ($id_modulos) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_modulos',$id_modulos);
    	}

    	if ($id_usuarios) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_usuarios',$id_usuarios);
    	}

    	$query = $this->db->get('recompensas_aleatorias_usuarios');
    	if ($todo=="todo")  { $resultado=$query->result(); }
    	else { $resultado=$query->row(); }

		#echo $this->db->last_query();


    	return $resultado;
    }



    ##Consulto si un premio en particular  (foro!)
    public function get_premio_sorpresa_mio($id_cursos=null,$id_modulos=null,$id_usuarios=null,$id_tipos_premio=null,$id_estados){

    	if ($id_estados) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_estados',$id_estados);
    	}	
    	if ($id_cursos) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_cursos',$id_cursos);
    	}
    	if ($id_modulos) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_modulos',$id_modulos);
    	}

    	if ($id_usuarios) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_usuarios',$id_usuarios);
    	}

    	if ($id_tipos_premio) {
    		$this->db->where('recompensas_aleatorias_usuarios.id_tipos_premio',$id_tipos_premio);
    	}

    	$query = $this->db->get('recompensas_aleatorias_usuarios');


    	$resultado=$query->row(); 

    	#echo $this->db->last_query();

    	return $resultado; 
    }


    public function update_premio_sorpresa($id_recompensas_aleatorias_usuarios,$data) {
    	$this->db->where('recompensas_aleatorias_usuarios.id_recompensas_aleatorias_usuarios', $id_recompensas_aleatorias_usuarios);
    	$this->db->update('recompensas_aleatorias_usuarios', $data); 


    }


    public function if_first_actividad ($motivo_primera_actividad,$id_cursos,$id_modulos,$id_actividades_barra,$id_usuarios) {

    	$this->db->where('puntaje.id_cursos',$id_cursos);
    	$this->db->where('puntaje.id_usuarios',$id_usuarios);
    	$this->db->where('puntaje.id_motivos',$motivo_primera_actividad);
    	$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
    	$this->db->from('puntaje');
##si ya existe, retornamos -1
    	if ($this->db->count_all_results()>0)  {
    		return "-1";
    	}
#si no, es porque debemos evaluar si ya tiene 1 actividad en el sistema
    	else {

    		$this->db->where('modulos_vistos.id_cursos',$id_cursos);
    		$this->db->where('modulos_vistos.id_modulos',$id_modulos);
    		$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_activo'));
    		$this->db->from('modulos_vistos');

## si tiene mas de una, es porque ya vio mas de dos actividades
    		if ($this->db->count_all_results()>1)  {
    			return "-1";
    		} else {
### si no, entonces insertamos los puntos y doy aviso para mostrar la pantalla de primera actividad vista

    			return "1";
    		}
    	}
    }


##Consulto la cantidad de estudiantes inscritos al curso y al modulo visto
    public function get_estudiantes_curso_count($id_cursos,$id_estados){
    	$this->db->where('cursos_asignados.id_cursos',$id_cursos);
    	$this->db->where('cursos_asignados.id_estados',$id_estados);
    	$this->db->from('cursos_asignados');
    	$con=$this->db->count_all_results();
    	return $con;
    }


##Consulto la cantidad de oportunidades que he realizado en una evaluacion
    public function get_oportunidades_count($id_actividades_evaluacion,$id_usuarios){
    	$this->db->where('actividades_evaluacion_oportunidades.id_actividades_evaluacion',$id_actividades_evaluacion);
    	$this->db->where('actividades_evaluacion_oportunidades.id_usuarios',$id_usuarios);
    	$this->db->where('actividades_evaluacion_oportunidades.id_estados',$this->config->item('estado_activo'));
    	$this->db->from('actividades_evaluacion_oportunidades');
    	$con=$this->db->count_all_results();
    	return $con;
    }

##Consulto si ya habia echo el examen y ver habia ganado anteriormente
    public function get_if_examen($id_usuarios,$id_cursos,$id_modulos,$id_actividades_barra){
    	$this->db->where('puntaje.id_usuarios',$id_usuarios);
    	$this->db->where('puntaje.id_cursos',$id_cursos);
    	$this->db->where('puntaje.id_modulos',$id_modulos);
    	$this->db->where('puntaje.id_actividades_barra',$id_actividades_barra);
    	$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('puntaje');
    	return $query->row();
    }

##Consulto la cantidad de estudiantes inscritos al curso y al modulo visto
    public function get_cursos_estudiante($id_cursos,$id_usuarios){
    	$this->db->where('cursos_asignados.id_cursos',$id_cursos);
    	$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
    	$this->db->where('cursos_asignados.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('cursos_asignados');
    	return $query->row();
    }


##Consulto los cursos asignados al estudiante
    public function get_cursos_estudiante_lista($id_usuarios){
    	$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
    	$this->db->where('cursos_asignados.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('cursos_asignados');
    	return $query->result();
    }

##Consulto los cursos asignados al estudiante
    public function update_logeo($id_cursos,$id_usuarios,$fecha_logeo){
    	$data=array("fecha_entrado"=>$fecha_logeo);
    	$this->db->where('cursos_asignados.id_cursos', $id_cursos);
    	$this->db->where('cursos_asignados.id_usuarios', $id_usuarios);
    	$this->db->update('cursos_asignados', $data); 
    	return true;
    }


    ##Consulto los cursos asignados al estudiante
    public function get_logeo_curso($id_cursos,$id_usuarios){
    	$this->db->where('cursos_asignados.id_cursos',$id_cursos);
    	$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
    	$this->db->where('cursos_asignados.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('cursos_asignados');
    	$res=$query->row();
    	#echo $this->db->last_query();
    	return $res;
    }


##Actualizo mi estatus
    public function update_estatus($id_cursos,$id_usuarios,$id_estatus){
    	$data=array("fecha_modificado"=>date('Y-m-d H:i:s',time()),"id_estatus"=>$id_estatus);
    	$this->db->where('cursos_asignados.id_usuarios', $id_usuarios);
    	$this->db->where('cursos_asignados.id_cursos', $id_cursos);
    	$this->db->update('cursos_asignados', $data); 
    	return true;

    }

##Consulto mis logros para mostrarlos en ajax (solo el contador)
    public function getCountlogros($id_cursos,$id_usuarios){
    	
    	$this->db->where('logros_usuarios.id_cursos',$id_cursos);
    	$this->db->where('logros_usuarios.id_usuarios',$id_usuarios);

    	/*
    	$this->db->select('foto');
    	
    	$this->db->where('logros_usuarios.id_estados',$this->config->item('estado_utilizado'));
    	$this->db->join('logros', 'logros.id_logros = logros_usuarios.id_logros');
    	$query = $this->db->get('logros_usuarios');
    	*/
    	$this->db->from('logros_usuarios');
    	$con=$this->db->count_all_results();
    	#echo $this->db->last_query(); 
    	return $con;
    }

##Consulto mis logros para mostrarlos en ajax (listado)
    public function getLogrosCurso($id_cursos,$id_usuarios) {
    	$this->db->select('logros.foto,logros.nombre');
    	$this->db->where('logros_usuarios.id_cursos',$id_cursos);
    	$this->db->where('logros_usuarios.id_usuarios',$id_usuarios);
    	$this->db->where('logros_usuarios.id_estados',$this->config->item('estado_utilizado'));
    	$this->db->join('logros', 'logros.id_logros = logros_usuarios.id_logros');
    	$query = $this->db->get('logros_usuarios');
    	return $query->result();
    }

	##funcion de consultar un logro en mi listado de logros del curso actual
    public function get_logro_usuario ($id_logros,$id_usuarios,$id_cursos) {
    	if ($id_logros!='' && $id_logros!=0)  {
    		$this->db->where('logros_usuarios.id_estados',$this->config->item('estado_utilizado'));
    		$this->db->where('logros_usuarios.id_logros',$id_logros);
    		$this->db->where('logros_usuarios.id_cursos',$id_cursos);
    		$this->db->where('logros_usuarios.id_usuarios',$id_usuarios);
    		$query = $this->db->get('logros_usuarios');
    		return $query->row();
    	}
    	else {
    		return "";
    	}
    }

	##funcion de consultar un logro en mi listado de logros del curso actual
    public function get_id_actividad_con_tabla ($id_actividades_barra) {
    	$this->db->select('actividades_barra.id_actividades,tipo_actividades.tabla_actividad');
    	$this->db->join('tipo_actividades', 'tipo_actividades.id_tipo_actividades = actividades_barra.id_tipo_actividades');
    	$this->db->where('actividades_barra.id_actividades_barra',$id_actividades_barra);
    	$query = $this->db->get('actividades_barra');
    	$resultados=$query->row();
    	#echo  $this->db->last_query();
    	$this->db->where($resultados->tabla_actividad.'.id_'.$resultados->tabla_actividad,$resultados->id_actividades);
    	$query = $this->db->get($resultados->tabla_actividad);
    	$resultados2=$query->row();
    	return $resultados2->id_logros;
    }

	##funcion de consultar puntos si ya los tengo (para los me gusta de los estudiantes y ver si ya tiene los puntos de me gusta con porcentaje)
    public function get_mispuntos_usuario ($id_cursos,$id_modulos,$id_usuarios,$id_motivos,$id_actividades_barra,$variable_extra=null) {
    	$this->db->where('puntaje.id_cursos',$id_cursos);
    	$this->db->where('puntaje.id_modulos',$id_modulos);
    	$this->db->where('puntaje.id_actividades_barra',$id_actividades_barra);
    	$this->db->where('puntaje.id_usuarios',$id_usuarios);
    	$this->db->where('puntaje.id_motivos',$id_motivos);

    	if ($variable_extra) {
    		$this->db->where('puntaje.variable_extra',$variable_extra);
    	}

    	$this->db->where('puntaje.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('puntaje');
    	#echo $this->db->last_query(); 
    	return $query->row();
    }


##funcion de consultar mis premios aleatorios que he obtenido con la caja sopresa
    public function get_recompensas_curso_usuarios ($id_usuarios,$id_cursos) {
    	$this->db->where('recompensas_aleatorias_usuarios.id_usuarios',$id_usuarios);
    	$this->db->where('recompensas_aleatorias_usuarios.id_cursos',$id_cursos);
    	$query = $this->db->get('recompensas_aleatorias_usuarios');
    	$resultados=$query->result();
    	return $resultados;
    }




## funcion para traer y saber si el modulo ya fué visto al menos una vez
    public function get_mod_visto($id_modulos,$id_usuarios){
    	$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
    	$this->db->where('modulos_vistos.id_modulos',$id_modulos);
    	$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
    	$query = $this->db->get('modulos_vistos');
    	return $query->row();
    }




## funcion para traer los premios de crear foro si lo tengo
    public function get_premio_foro($id_modulos,$id_usuarios){
    	$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
    	$this->db->where('modulos_vistos.id_modulos',$id_modulos);
    	$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
    	$query = $this->db->get('modulos_vistos');
    	return $query->row();
    }


    ## funcion que consulta unicamente los modulos del curso (sin el modulo de premios)
    public function get_modulos_curso ($id_cursos) {
    	$this->db->where('modulos.id_estados',$this->config->item('estado_activo'));
    	$this->db->where('modulos.id_cursos',$id_cursos);
    	$query = $this->db->get('modulos');
    	$resultados=$query->result();
    	return $resultados;
    }



#$this->db->join('modulos', 'cursos.id_cursos = certificados.id_cursos');




    

    ### funcion para obtener los modulos realizados del curso actual y del usuario actual
    public function get_modulos_curso_realizados ($id_usuarios,$id_modulos_lista) {
    	$this->db->where_in('modulos_vistos.id_modulos', $id_modulos_lista);
    	$this->db->where('modulos_vistos.id_usuarios',$id_usuarios);
    	$this->db->where('modulos_vistos.id_estados',$this->config->item('estado_realizado'));
    	

    	$this->db->group_by(array("id_modulos")); 

    	$query = $this->db->get('modulos_vistos');
    	$resultados=$query->result();
    	#echo $this->db->last_query();
    	return $resultados;
    }


    public function if_noti_foro_est($id_usuarios,$variable_extra) {
    	$this->db->where('notificaciones.variable_extra',$variable_extra);
    	$this->db->where('notificaciones.id_usuarios',$id_usuarios);
    	$this->db->from('notificaciones');
    	return $this->db->count_all_results();
    }



    ## funcion que consulta unicamente los modulos del curso (sin el modulo de premios)
    public function get_certificado ($id_usuarios,$id_cursos) {
    	$this->db->where('certificados.id_estados',$this->config->item('estado_activo'));
    	$this->db->where('certificados.id_cursos',$id_cursos);
    	$this->db->where('certificados.id_usuarios',$id_usuarios);
    	$query = $this->db->get('certificados');
    	$resultados=$query->row();
    	return $resultados;
    }




 ## funcion que consulta unicamente los modulos del curso (sin el modulo de premios)
    public function get_certificados ($id_usuarios) {
    	$this->db->select("certificados.*,cursos.*,certificados.fecha_creado as fecha_cert_creado");
    	$this->db->where('certificados.id_estados',$this->config->item('estado_activo'));
    	$this->db->join('cursos', 'cursos.id_cursos = certificados.id_cursos');
    	$this->db->where('certificados.id_usuarios',$id_usuarios);
    	$query = $this->db->get('certificados');
    	$resultados=$query->result();
    	return $resultados;
    }



 ## funcion que consulta unicamente los modulos del curso (sin el modulo de premios)
    public function getif_eval ($id_cursos,$id_usuarios,$id_actividades_barra) {
    	$this->db->where('actividades_respuestas_usuario.id_cursos',$id_cursos);
    	$this->db->where('actividades_respuestas_usuario.id_usuarios',$id_usuarios);
    	$this->db->where('actividades_respuestas_usuario.id_actividades_barra',$id_actividades_barra);
    	$query = $this->db->get('actividades_respuestas_usuario');
    	$resultados=$query->row();
    	return $resultados;
    }




 ## funcion que consulta si ya esta pago o no el curso
    public function get_if_curso_pago ($id_cursos,$id_usuarios) {
    	$this->db->where('pagos_realizados.id_cursos',$id_cursos);
    	$this->db->where('pagos_realizados.id_usuarios',$id_usuarios);
    	$this->db->where('pagos_realizados.id_estados',$this->config->item('estado_pagado'));
    	$query = $this->db->get('pagos_realizados');
    	$resultados=$query->row();
    	#echo $this->db->last_query();
    	return $resultados;
    }





 ## funcion que consulta si estoy inscrito al curso
    public function get_curso_usuario ($id_cursos,$id_usuarios) {
    	$this->db->where('cursos_asignados.id_cursos',$id_cursos);
    	$this->db->where('cursos_asignados.id_usuarios',$id_usuarios);
    	$this->db->where('cursos_asignados.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('cursos_asignados');
    	$resultados=$query->row();
    	return $resultados;
    }


 ## funcion que consulta la clase en vivo programada
    public function get_clase_vivo ($id_cursos,$id_usuarios) {
    	$this->db->where('programacion_envio.id_cursos',$id_cursos);
    	$this->db->where('programacion_envio.id_usuarios',$id_usuarios);
    	#$this->db->where('programacion_envio.id_estados',$this->config->item('estado_activo'));
    	$query = $this->db->get('programacion_envio');
    	$programacion_envio=$query->row();

    	$this->db->where('cursos.id_cursos',$id_cursos);
    	$query = $this->db->get('cursos');
    	$cursos=$query->row();

    	return array('programacion_envio'=>$programacion_envio,'curso'=>$cursos);
    }

 ## funcion para saber si existe una clase en vivo del docente
    public function get_clase_vivo_if ($id_cursos,$id_usuarios) {
    	$this->db->where('programacion_envio.id_cursos',$id_cursos);
    	$this->db->where('programacion_envio.id_usuarios',$id_usuarios);
    	$query = $this->db->get('programacion_envio');
    	$programacion_envio=$query->row();
    	return $programacion_envio;
    }



 ## funcion para saber si existe una clase en vivo del curso
    public function get_clase_vivo_curso ($id_cursos) {
    	$this->db->where('programacion_envio.id_cursos',$id_cursos);
    	$query = $this->db->get('programacion_envio');
    	$programacion_envio=$query->row();
    	return $programacion_envio;
    }



    public function delmensajeforo ($id_usuarios,$id_actividades_foro_mensajes) {
    	$this->db->delete('actividades_foro_mensajes', array('id_actividades_foro_mensajes' => $id_actividades_foro_mensajes,'id_usuario_modificado' => $id_usuarios)); 
    }





    public function variables_clase_en_vivo($id_cursos,$url_clase,$codigo_clase){

		## consulto los estudiantes registrados en el curso que no hayan finalizado el curso
    	$this->db->where('cursos_asignados.id_cursos', $id_cursos);
    	$this->db->where('cursos_asignados.id_estados', $this->config->item('estado_activo')); 
    	#$this->db->where('cursos_asignados.finalizado', $this->config->item('estado_inactivo')); 
    	$query = $this->db->get('cursos_asignados');
    	$resultado_estudiantes=$query->result();




		## obtengo informacion del curso actual
    	$this->db->where('cursos.id_cursos', $id_cursos);
    	$this->db->where('cursos.id_estados', $this->config->item('estado_activo')); 
    	$query = $this->db->get('cursos');
    	$resultado_cursos=$query->row();






		## obtengo el primer modulo que se tenga en el curso actual a notificar
    	$this->db->where('modulos.id_cursos', $id_cursos);
    	$this->db->where('modulos.id_estados', $this->config->item('estado_activo')); 
    	$this->db->order_by("orden", "asc"); 
    	$query = $this->db->get('modulos');
    	$resultado_modulo=$query->row();





		## obtengo la primera actividad del primer modulo del curso para notificar al estudiante
    	$this->db->where('actividades_barra.id_modulos', $resultado_modulo->id_modulos);
    	$this->db->where('actividades_barra.id_estados', $this->config->item('estado_activo')); 
    	$this->db->order_by("orden", "asc"); 
    	$query = $this->db->get('actividades_barra');
    	$resultado_actividades=$query->row();





    	## actualizo el curso con el link de la clase en vivo o el codigo iframe de la clase en vivo
    	$data_update_curso=array("url_clase_en_vivo"=>$url_clase,'codigo_clase'=>$codigo_clase);
    	$this->db->where('id_cursos', $id_cursos);
    	$this->db->update('cursos', $data_update_curso); 

/*
    	print_r ($resultado_estudiantes);
    	print_r ($resultado_cursos);
    	print_r ($resultado_modulo);
    	print_r ($resultado_actividades);
    	echo "-----------------------------------";
    	exit;
*/




    	$arr_x=array('var1'=>$resultado_estudiantes,'var2'=>$resultado_cursos,'var3'=>$resultado_modulo,'var4'=>$resultado_actividades);
    	return $arr_x;
    	#return $resultado_estudiantes."|".$resultado_cursos."|".$resultado_modulo."|".$resultado_actividades;

    }







}