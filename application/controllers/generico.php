<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Generico extends CI_Controller {

	public function index()
	{
		echo "ok";
	}



## funcion que carga la vista de explicacion para el usuario
  public function explicacion () {

######################################### lineas de programacion debe estar en todas ####################################
    $data['notificaciones']=$this->model_generico->get_notificaciones ($id_usuarios,$this->config->item('estado_no_leido'),5);
    $data['notificaciones_count']=$this->model_generico->get_notificaciones_count ($id_usuarios,$this->config->item('estado_no_leido'));
    $data['custom_sistema']=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));
    $data['contenidos_footer']=$this->model_generico->get_contenidos_footer('contenidos',array('id_estados'=>1));
######################################### lineas de programacion debe estar en todas ####################################
    $this->load->view('view_explicacion',$data);

  }


###funcion para resetear puntaje,logros,notificaciones, videos usuarios, foro usuarios, caja sorpresas
  public function reset() {

#echo sha1("v_irtualab.co");

#exit;
   $this->db->empty_table('actividades_evaluacion_oportunidades'); 
   $this->db->empty_table('actividades_foro_megusta'); 
   $this->db->empty_table('actividades_foro_mensajes'); 
   $this->db->empty_table('actividades_foro_usuarios'); 
   $this->db->empty_table('actividades_respuestas_usuario'); 
   $this->db->empty_table('actividades_videos_usuarios'); 
   $this->db->empty_table('certificados'); 
   $this->db->empty_table('logros_usuarios'); 
   $this->db->empty_table('modulos_vistos'); 
   $this->db->empty_table('notificaciones'); 
   $this->db->empty_table('puntaje'); 
   $this->db->empty_table('recompensas_aleatorias_usuarios'); 
   $this->db->empty_table('pagos_realizados'); 
   $this->db->empty_table('mensajes'); 

   echo "Datos borrados!";

 }


}

/* End of file errores.php */
/* Location: ./application/controllers/errores.php */