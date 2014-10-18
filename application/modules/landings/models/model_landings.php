<?php
/**
Esta es la clasde del modulo 
**/


class Model_Landings extends CI_Model{


## checkeo si el correo existe
	public function check_email( $email ){
		$extra=array('correo' => $email);
		$query = $this->db->get_where('landings_usuarios', $extra );
		if( $query->num_rows() > 0 ){
				# si existe no permite actualizar con la misma cedula
			return 'existe';
		} else {
			#si no existe la identificacion
			return 'aceptable';
		}
	}


}