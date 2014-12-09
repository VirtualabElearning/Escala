<?php
/* CLASE-MODELO DEL MODULO */

class Model_Calificaciones extends CI_Model{


	public function listado($id_usuarios,$tabla,$where=null,$order_by=null,$id_cursos,$tipo_plan=null){

		$tabla='cursos_asignados';

		$this->db->select($tabla.".*,estados.nombre as estado_nombre,usuarios.*,".$tabla.".id_estados as estado_mensaje, usuarios.foto as foto_estudiante,tipo_planes.nombre as nombre_plan,estatus.nombre as nombre_estatus");
		if ($where) {
			$this->db->where($where[0],$where[1]);
		}

		$this->db->where('usuarios.id_roles',$this->config->item('roles_estudiante'));
		$this->db->where('cursos.id_cursos',$id_cursos);
		if ($tipo_plan) {
			$this->db->where($tabla.'.id_tipo_planes',$this->config->item('Premium'));
		}

		$this->db->join('estatus', $tabla.'.id_estatus = estatus.id_estatus');
		$this->db->join('estados', $tabla.'.id_estados = estados.id_estados');
		$this->db->join('cursos', $tabla.'.id_cursos = cursos.id_cursos');
		$this->db->join('tipo_planes', $tabla.'.id_tipo_planes = tipo_planes.id_tipo_planes');


		#$this->db->join('calificaciones', $tabla.'.id_cursos = calificaciones.id_cursos and '.$tabla.'.id_cursos = calificaciones.id_cursos ','left');

		$this->db->join('usuarios', $tabla.'.id_usuario_creado = usuarios.id_usuarios');





		if ($order_by) {
			$this->db->order_by($order_by[0], $order_by[1]); 
		}

		$query = $this->db->get($tabla);
		#krumo ($this->db->last_query());
		return $query->result();
	}


	### funcion para obtener competencias y porcentajes de cada una
	public function get_competencias_eval($id_cursos,$id_usuarios) {

		$this->db->where('actividades_respuestas_usuario.id_cursos',$id_cursos);
		$this->db->where('actividades_respuestas_usuario.id_usuarios',$id_usuarios);
		$this->db->where('actividades_respuestas_usuario.tipo_pregunta',0);
		$this->db->join('actividades_evaluacion', 'actividades_respuestas_usuario.id_actividades = actividades_evaluacion.id_actividades_evaluacion');
		$query = $this->db->get('actividades_respuestas_usuario');
		$resultados=$query->result();
		$array_competencias_respuestas_analisis=array();
		

		if ($id_usuarios==43) {
			#krumo ($resultados);
			#exit; 
		}


		### lista las evaluaciones realizadas del usuario en el curso actual
		foreach ($resultados as $key => $value) {

			$variables_respuestatmp=json_decode($value->respuestas);
			$variables_preguntatmp=json_decode($value->variables_pregunta) ;
			


			if ($id_usuarios==43 && $key==1) {
				#krumo ($variables_respuestatmp); 
				#krumo ($variables_preguntatmp);
				#exit;
			}




			foreach ($variables_preguntatmp as $subkey => $subvalue) {
				$tmpcompe=$this->get_competencia($subvalue->id_competencias);





				if ($tmpcompe->id_competencias!='') {
					






					## si es tipo campo de texto, siempre son correctas
					if ($subvalue->tipo_pregunta==4) {
						$array_competencias_respuestas_analisis[$tmpcompe->id_competencias]['correctas']++;	
					}	
				### si no son tipo campo de texto, evaluo si fué o no correcta	
					else {
						##compruebo si puedo entrar al ciclo
						if ($variables_respuestatmp[$subkey-1]->variables_respuesta) {
							

							if ($id_usuarios==43 && $subvalue->id_competencias==16) {
							#	krumo ($variables_respuestatmp[$subkey-1]->variables_respuesta); 
							}


							foreach ($variables_respuestatmp[$subkey-1]->variables_respuesta as $subsubkey => $subsubvalue) {
							### si fué correcta
								if ($subsubvalue->correcta==1 && $subsubvalue->seleccionada==1) {
									$array_competencias_respuestas_analisis[$tmpcompe->id_competencias]['correctas']++;	
									break;
								}
							### si no es correcta, no almaceno nada en analisis pero si en total para evaluar de la totalidad, cuantas
							### fueron correctas y cuantas no.
								else {
									$array_competencias_respuestas_analisis[$tmpcompe->id_competencias]['incorrectas']++;	
									break;
								}
						} ### fin ciclo de respuestas	







					} ### fin si entro a ciclo

					}  ## fin si no es campo de texto
					
					$array_competencias_respuestas_analisis[$tmpcompe->id_competencias]['nombre_competencia']=$tmpcompe->nombre;





				} ### fin si id_competencia es diferente de nada






				### si no tiene competencia, no almaceno nada, se ignora la pregunta en el analisis
				else {

				}	
			}  ### fin ciclo de preguntas
		}  ## fin ciclo de respuestas de usuario de las evaluaciones del curso


		#exit;

		if ($id_usuarios==43) {
			#	krumo ($array_competencias_respuestas_analisis);
		#	exit;
		}




		return $array_competencias_respuestas_analisis;

	}

	### function para obtener la competencia de la evaluacion realizada
	public function get_competencia($id_competencias) {
		if ($id_competencias!='') {
			$this->db->where('competencias.id_competencias',$id_competencias);
			$query = $this->db->get('competencias');
			$resultado=$query->row();
		}
		else {
			$resultado="";
		}
		return $resultado;
	}


	public function listar_evaluaciones($id_cursos,$id_usuarios) {

		$this->db->where('actividades_respuestas_usuario.id_cursos',$id_cursos);
		$this->db->where('actividades_respuestas_usuario.id_usuarios',$id_usuarios);
		$this->db->where('actividades_respuestas_usuario.tipo_pregunta',0);
		$this->db->join('actividades_evaluacion', 'actividades_respuestas_usuario.id_actividades = actividades_evaluacion.id_actividades_evaluacion');
		$query = $this->db->get('actividades_respuestas_usuario');
		#krumo ($this->db->last_query());
		return $query->result();
	}



## funcion para guardar las calificaciones en el sistema
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





}