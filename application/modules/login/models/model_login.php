<?php

class Model_login extends CI_Model{



	public function check_user( $username, $password,$id_roles=null ){

		$extra=array('correo' => $username,'contrasena' => $password );

		if ($id_roles) { $extra['id_roles']=$id_roles; }


		$query = $this->db->get_where('usuarios', $extra );



		if( $query->num_rows() > 0 ){

			if( $query->row()->id_estados == 0 ){
				return 'inactivo';
			} else{
				return 'activo';
			}

		} else {
			return 'no-existe';
		}
	}




## checkeo si el correo existe
	public function check_email( $email ){

		$extra=array('correo' => $email);
		$query = $this->db->get_where('usuarios', $extra );
		if( $query->num_rows() > 0 ){
				# si existe no permite actualizar con la misma cedula
			return 'existe';
		} else {
			#si no existe la identificacion
			return 'aceptable';
		}
	}


## checkeo si el correo existe (solo estudiantes)
	public function check_email_estudiante( $email ){

		$extra=array('correo' => $email,'id_roles'=>3 );
		$query = $this->db->get_where('usuarios', $extra );
		if( $query->num_rows() > 0 ){
				# si existe no permite actualizar con la misma cedula
			return 'existe';
		} else {
			#si no existe la identificacion
			return 'aceptable';
		}
	}


	#funcion para detectar si existe o no la identificacion
	public function check_user_identificacion( $identificacion ){

		$extra=array('identificacion' => $identificacion);

		
		$query = $this->db->get_where('usuarios', $extra );



		if( $query->num_rows() > 0 ){
				# si existe no permite actualizar con la misma cedula
			return 'existe';
			
		} else {
			#si no existe la identificacion
			return 'aceptable';
		}
	}






	public function get_info_usuario($tabla,$where){
		$this->db->where($where[0],$where[1]);
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$query = $this->db->get($tabla);
			#echo  $this->db->last_query()."<br>";
		#exit;
		return $query->row();
	}





	public function get_info_usuario_estudiante($tabla,$where){

		$this->db->select('usuarios.*,roles.*,estatus.id_estatus,estatus.nombre as nombre_estatus');
		$this->db->where($where[0],$where[1]);
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$this->db->join('estatus', 'estatus.id_estatus = usuarios.id_estatus');
		$query = $this->db->get($tabla);


		return $query->row();
	}


	public function detalle($tabla,$where=null){

		if ($where) {
			$this->db->where($where[0],$where[1]);
		}
		$this->db->select('usuarios.id_usuarios,usuarios.nombres,usuarios.apellidos,usuarios.foto,usuarios.correo,usuarios.identificacion,usuarios.resumen_de_perfil,roles.nombre as nombre_rol,estados.nombre as nombre_estado');
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$this->db->join('estados', 'estados.id_estados = usuarios.id_estados');
		$query = $this->db->get($tabla);
		return $query->row();
	}



	public function guardar_user_social ($data) {
		$this->db->insert('usuarios', $data); 
	}



	public function confirmar_email ($email) {
		$data=array('id_estados'=>1);
		$this->db->where('correo', $email);
		$this->db->update('usuarios', $data); 



		$this->db->select('usuarios.*,roles.*,estatus.id_estatus,estatus.nombre as nombre_estatus');
		$this->db->where('correo',$email);
		$this->db->where('roles.id_roles',3);
		$this->db->join('roles', 'roles.id_roles = usuarios.id_roles');
		$this->db->join('estatus', 'estatus.id_estatus = usuarios.id_estatus');
		$query = $this->db->get('usuarios');


		return $query->row();


	}




	##Actalizo el estado de la notificacion como leída
	public function update_notificacion_leida($id_notificaciones){
		$data=array("notificaciones.id_estados"=>$this->config->item('estado_leido'));
		$this->db->where('notificaciones.id_notificaciones', $id_notificaciones);
		$this->db->where('notificaciones.id_estados', $this->config->item('estado_no_leido'));
		$this->db->update('notificaciones', $data); 
		return true;

	}


	##Actalizo el estado de la notificacion como no leída
	public function update_notificacion_no_leida($id_notificaciones){
		$data=array("notificaciones.id_estados"=>$this->config->item('estado_no_leido'));
		$this->db->where('notificaciones.id_notificaciones', $id_notificaciones);
		$this->db->where('notificaciones.id_estados', $this->config->item('estado_leido'));
		$this->db->update('notificaciones', $data); 
		return true;

	}


	##funcion para borrar la notificacion seleccionada
	public function delete_notificacion ($id_notificaciones) {
		$this->db->delete('notificaciones', array('notificaciones.id_notificaciones' => $id_notificaciones)); 
		return true;
	}











	##Actalizo el estado de la notificacion como leída
	public function update_inbox_leida($id_mensajes){
		$data=array("mensajes.id_estados"=>$this->config->item('estado_leido'));
		$this->db->where('mensajes.id_mensajes', $id_mensajes);
		$this->db->where('mensajes.id_estados', $this->config->item('estado_no_leido'));
		$this->db->update('mensajes', $data); 
		return true;

	}


	##Actalizo el estado de la notificacion como no leída
	public function update_inbox_no_leida($id_mensajes){
		$data=array("mensajes.id_estados"=>$this->config->item('estado_no_leido'));
		$this->db->where('mensajes.id_mensajes', $id_mensajes);
		$this->db->where('mensajes.id_estados', $this->config->item('estado_leido'));
		$this->db->update('mensajes', $data); 
		return true;

	}


	##funcion para borrar la notificacion seleccionada
	public function delete_inbox ($id_mensajes) {
		$this->db->delete('mensajes', array('mensajes.id_mensajes' => $id_mensajes)); 
		return true;
	}






}
