<?php

class Model_Generico extends CI_Model{

/**
Funcion que genera el listado de una tabla
**/
public function listado($tabla,$where=null,$order_by=null){

	$this->db->select($tabla.".*,estados.nombre as estado_nombre");
	if ($where) {
		$this->db->where($where[0],$where[1]);
	}

	$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');

	if ($order_by) {
		$this->db->order_by($order_by[0], $order_by[1]); 
	}

	$query = $this->db->get($tabla);
	#krumo ($this->db->last_query());
	return $query->result();
}



public function get_encuestas_respuestas($id_cursos,$id_usuarios){
	$this->db->where('id_cursos',$id_cursos);
	$this->db->where('id_usuarios',$id_usuarios);
	$query = $this->db->get("encuestas_respuestas");
	return $query->result();
}





/**
Funcion que carga el detalle de un dato de cualquier tabla
**/
public function detalle($tabla,$where=null){

	if ($where) { $this->db->where($where); }
	
	$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
	return $query->row();
}


public function get_contenidos_footer($tabla,$where=null){

	if ($where) { $this->db->where($where); }
	$this->db->where('habilitar_en_footer',1); 
	$query = $this->db->get($tabla);
	#echo  $this->db->last_query()."<br>";
	return $query->result();
}




/**
Funcion guardar con parametros de :  Nombre tabla, datos a guardar, nombre del id, el id si es en caso de actualizar.
**/
public function guardar ($tabla,$data,$idname=null,$where=null) {

	$id_retorno='';
	if (@$where[1]) {
		$this->db->where($where[0],$where[1]);
		$this->db->update($tabla, $data);

#echo  $this->db->last_query()."<br>";

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






public function guardar_sin_orden ($tabla,$data,$idname=null,$where=null) {

	$id_retorno='';
	if (@$where[1]) {
		$this->db->where($where[0],$where[1]);
		$this->db->update($tabla, $data);

#echo  $this->db->last_query()."<br>";

		$id_retorno=$where[1];

	}
	else {
		$this->db->insert($tabla, $data);
		$id_retorno=$this->db->insert_id();
		#$this->db->where(array($idname=>$id_retorno));
		#$this->db->update($tabla, array('orden'=>$id_retorno));

	}
	return  $id_retorno;
}




/** Funcion de borrar un elemento de la base de datos **/
public function borrar($tabla,$where) {
	$this->db->delete($tabla, $where);
		#echo  $this->db->last_query()."<br>";
	return 'ok';
}



/** Funcion de ordenar **/
public function ordenar ($tabla,$data,$where) {
	$this->db->where( $where[0],$where[1] );
	$this->db->update( $tabla, $data );
	#echo  $this->db->last_query()."<br>";
	return  true;
}




/** Funcion de permisos de usuario **/
public function mispermisos ($id_roles,$carpeta) {
	#$this->db->where( "permisos.id_roles",$id_roles );
	$this->db->where( "modulos_app.carpeta",$carpeta );
	$this->db->join('modulos_app', 'modulos_app.id_modulos_app = permisos.id_modulos_app');
	$query = $this->db->get("permisos");
	#echo  $this->db->last_query()."<br>";
	return $query->row();
}



public function diccionario () {
	$this->db->where( "diccionario.id_estados",1 );
	$query = $this->db->get("diccionario");

	$resultados=$query->result();
	$arr_dic=array();

	foreach ($resultados as $key => $value) {
		$arr_dic[$value->llave]=$value->singular."|".$value->plural;
	}
	return $arr_dic;
}


public function menus_root_categorias () {

	#$this->db->where( "permisos.id_roles",$id_roles );
	#$this->db->where( "modulos_app.carpeta",$carpeta );
	#$this->db->join('modulos_app', 'modulos_app.id_modulos_app = permisos.id_modulos_app');
	$query = $this->db->get("categorias_modulos_app");
	return $query->result();

}

##funcion que trae las ciudades
public function get_ciudades ($nombre=null) {

	#$this->db->where( "permisos.id_roles",$id_roles );
	#$this->db->where( "modulos_app.carpeta",$carpeta );
	#$this->db->join('modulos_app', 'modulos_app.id_modulos_app = permisos.id_modulos_app');
	$this->db->select('nombre');
	$this->db->like('nombre', $nombre); 
	$query = $this->db->get("ciudades");
	return $query->result();

}



public function menus_root ($id_categorias_modulos_app,$id_roles) {

	#$this->db->where( "permisos.id_roles",$id_roles );
	$this->db->where( "categorias_modulos_app.id_categorias_modulos_app",$id_categorias_modulos_app );
	$this->db->where( "permisos.id_estados",1 );
	$this->db->where( "modulos_app.id_estados",1 );
	$this->db->where( "categorias_modulos_app.id_estados",1 );
	$this->db->join('modulos_app', 'modulos_app.id_categorias_modulos_app = categorias_modulos_app.id_categorias_modulos_app');
	$this->db->join('permisos', 'permisos.id_modulos_app=modulos_app.id_modulos_app');
	$query = $this->db->get("categorias_modulos_app");
	return $query->result();

}




##funcion que trae las notificaciones
public function get_notificaciones ($id_usuarios,$id_estados=null,$limit=null) {
	if ($limit) { $this->db->limit($limit); }
	if ($id_estados) { $this->db->where( "notificaciones.id_estados",$id_estados ); }
	$this->db->order_by("notificaciones.fecha_creado", "desc"); 
	$this->db->where( "notificaciones.id_usuarios",$id_usuarios ); 
	$query = $this->db->get("notificaciones");
	return $query->result();
}



##funcion que trae las notificaciones
public function get_notificaciones_count ($id_usuarios,$id_estados=null,$limit=null) {
	if ($limit) { $this->db->limit($limit); }
	if ($id_estados) { $this->db->where( "notificaciones.id_estados",$id_estados ); }
	$this->db->where( "notificaciones.id_usuarios",$id_usuarios ); 
	
	$this->db->order_by("notificaciones.fecha_creado", "desc"); 
	$this->db->from('notificaciones');
	$con=$this->db->count_all_results();
	return $con;

}



##funcion que trae los mensajes
public function get_mensajes ($id_usuarios,$id_estados=null,$limit=null) {
	if ($limit) { $this->db->limit($limit); }
	if ($id_estados) { $this->db->where( "mensajes.id_estados",$id_estados ); }
	$this->db->order_by("mensajes.fecha_creado", "desc"); 
	$this->db->where( "mensajes.id_usuarios",$id_usuarios ); 
	$query = $this->db->get("mensajes");
	return $query->result();

}



##funcion que trae las inbox count
public function get_mensajes_count ($id_usuarios,$id_estados=null,$limit=null) {
	if ($limit) { $this->db->limit($limit); }
	if ($id_estados) { $this->db->where( "mensajes.id_estados",$id_estados ); }
	$this->db->where( "mensajes.id_usuarios",$id_usuarios ); 
	$this->db->order_by("mensajes.fecha_creado", "desc"); 
	$this->db->from('mensajes');
	$con=$this->db->count_all_results();
	return $con;
}

## muestro los cursos que tengo suscripcion
public function mis_cursos_suscripcion ($id_usuarios) {
	
	$this->db->select('cursos.*,pagos_realizados.*,cursos_asignados.*,pagos_realizados.fecha_creado as fecha_pago');
	$this->db->join('cursos', 'cursos_asignados.id_cursos = cursos.id_cursos');
	$this->db->join('pagos_realizados', 'pagos_realizados.id_cursos = cursos.id_cursos and pagos_realizados.id_usuarios=cursos_asignados.id_usuarios', 'left');
	$this->db->order_by("cursos_asignados.orden", "desc"); 
	$this->db->where( "cursos_asignados.id_usuarios",$id_usuarios ); 
	#$this->db->where( "cursos_asignados.id_tipo_planes",$this->config->item('Premium') );
	$query = $this->db->get("cursos_asignados");
	$resu=$query->result();

	#krumo ($this->db->last_query());

	return $resu;

}



## funcion para tener la pregunta del mensaje
public function get_pregunta_mensaje ($id_mensajes) {
	$this->db->where('mensajes.id_mensajes',$id_mensajes);
	$query = $this->db->get('mensajes');
	$resultados=$query->row();
	return $resultados;
}



#funcion para obtener los cursos asignados del docente
public function cursos_list_doc($id_usuarios) {
	$this->db->where('cursos.id_estados',$this->config->item('estado_activo'));
	$this->db->like('cursos.instructores_asignados', '"'.$id_usuarios.'"'); 
	$query = $this->db->get('cursos');
	$resultados=$query->result();
		#krumo ($this->db->last_query());
	return $resultados;
}




}