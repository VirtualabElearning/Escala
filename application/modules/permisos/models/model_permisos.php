<?php
/**
Esta es la clasde del modulo 
**/


class Model_Permisos extends CI_Model{



	public function listado($tabla,$where=null,$order_by=null){

		$this->db->select($tabla.".*,estados.nombre as estado_nombre,modulos_app.nombre as nombre_modulo");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}

		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');
    #$this->db->join('roles', 'roles.id_roles = '.$tabla.'.id_roles');
		$this->db->join('modulos_app', 'modulos_app.id_modulos_app = '.$tabla.'.id_modulos_app');


		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);

		$resultados=$query->result();

		foreach ($resultados as $key => $value) {

			$id_rolesx=json_decode($value->id_roles);
			$this->db->where_in('id_roles',  $id_rolesx);
			$query = $this->db->get("roles");
			$resultados_roles=$query->result();
			$mis_roles=array();
			foreach ($resultados_roles as $roles_key => $roles_value) {
				$mis_roles[]=$roles_value->nombre;
			}

			$resultados[$key]->roles_permitidos=implode(", ", $mis_roles);
		}




		return $resultados;
	}




	public function get_roles ()  {

	}



	public function get_modulos ()  {

	}







}


