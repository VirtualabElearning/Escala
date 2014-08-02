<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/* Controlador de la aplicacion */

	var $variables = array();

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_usuario'))  {   redirect( 'login/root/iniciar_sesion/'.base64_encode(current_url()) );  }
		
		/* Configuracion generica del modulo */
		$this->variables=array('modulo'=>'actividades','id'=>'id_actividades','modelo'=>'model_actividades');
		$this->load->model($this->variables['modelo']);
	}

	public function index()
	{  /* Cargo listado de registros */
		$this->lista();
	}

	/* Funcion para cargar listado de registros */
	public function lista($id_cursos,$id_modulos)
	{

		if (!$id_cursos)  { redirect( 'cursos/root'); }
		if (!$id_modulos)  { redirect( 'modulos/root/lista/'.$id_cursos); }

		$variables = $this->variables;
		$data['titulo']=$variables['modulo'];
		$data['lista']=$this->{$variables['modelo']}->listado($id_cursos,$id_modulos);
		$actividad_dato="";

		#krumo ($data['lista']);

		foreach ($data['lista'] as $key => $value) {
			$actividad_dato=$this->{$variables['modelo']}->detalle($value->tabla_actividad,array('id_'.$value->tabla_actividad,$value->id_actividades));

			$data['lista'][$key]->datos_actividad=$actividad_dato;
			
		}



		#krumo ($data['lista']); 



		#exit;




		$data['titulos']=array("Orden","ID","Categoria curso","Curso","Tipo actividad","Nombre actividad","Descripcion","Estado","Opciones");
		$this->load->view('root/view_'.$variables['modulo'].'_lista',$data);
	}

	/* funcion nuevo registro */
	public function nuevo()
	{
		$variables = $this->variables;
		$this->load->helper($variables['modulo'].'_core');
		$data['titulo']=$variables['modulo'];

		$data['tipo_actividades_lista']=$this->{$variables['modelo']}->get_tipo_actividades();

		$this->load->view('root/view_'.$variables['modulo'].'_nuevo',$data);
	}




	public function guardar_respuestas () {

		$variables = $this->variables;
		$this->load->helper($variables['modulo'].'_core');
		$parametros = $this->input->post('envio');

		parse_str($parametros); 


# evaluo cual es la correcta de las opciones
		$opciones_respuesta=array();

		foreach ($respuesta as $key => $value) {
			if (@$correcta==$key)  { $rtmp='1'; } else { $rtmp='0'; }


			$opciones_respuesta[$key]=array('posible_respuesta'=>$respuesta[$key],'retroalimentacion'=>$retroalimentacion[$key],'correcta'=>$rtmp);


		}

#print_r ($respuesta);
#print_r ($retroalimentacion);
#print_r ($correcta_rta);
/*
		echo "\n\n";

		print_r($opciones_respuesta);
		echo "\n";

		echo "nombre_pregunta: ".$nombre_pregunta;
		echo "\n";
		echo "tipo_pregunta_opc: ".$tipo_pregunta_opc;
		echo "\n";
		echo "nom_activ: ".$nom_activ;
		echo "\n";
		echo "desc_acti: ".$desc_acti;
		echo "\n";



		echo "id_tipo_actividades_var: ".$id_tipo_actividades_var;
		echo "\n";
		echo "id_actividades_var: ".$id_actividades_var;
		echo "\n";
		echo "id_cursos_var: ".$id_cursos_var;
		echo "\n";
		echo "id_modulos_var: ".$id_modulos_var;
		echo "\n";
		echo "id_tipo_actividades_antes_var: ".$id_tipo_actividades_antes_var;
		echo "\n";
		echo "id_var: ".$id_var;
		echo "\n";
		echo "id_estados_var: ".$id_estados_var;    
		echo "\n";
*/
####################### analizo lo siguiente #################
#1. Que sea version editar y caso que tenga el mismo tipo de pregunta
#2. Que sea la version editar y caso que tenga diferente tipo pregunta, para eso:
#
#Borro la pregunta anterior, ingreso la nueva pregunta con los mismos datos casi y actualizo en actividades_barra
#el id de la actividad y el tipo, evaluar si tiene imagen, la borra e ingresa una nueva, si no, la ingresa.


## si es el mismo tipo, edito sin duda!



		if ($id_tipo_actividades_var==$id_tipo_actividades_antes_var)  {

### si es igual solo actualizo la actividad_evaluacion, barra y estado de las dos tablas



 // [envio] => respuesta%5B%5D=linux&retroalimentacion%5B%5D=sii&respuesta%5B%5D=Windows&retroalimentacion%5B%5D=ash+no!&correcta=1&nombre_pregunta=ed&tipo_pregunta_opc=1&nom_activ=Videotip&desc_acti=Nuevinooo&id_tipo_actividades_var=3&id_actividades_var=3&id_cursos_var=4&id_modulos_var=1&id_tipo_actividades_antes_var=3&id_var=2&id_estados_var=1


	## datos nuevos a insertar:
	#
			$nueva_actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_var));

			$data_nuevo=array('nombre_actividad'=>$nom_activ,'descripcion_actividad'=>$desc_acti,
				'pregunta'=>$nombre_pregunta,'tipo_pregunta'=>$tipo_pregunta_opc,'id_estados'=>$id_estados_var);


			$data_nuevo['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_nuevo['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data_nuevo['variables_pregunta']=json_encode($opciones_respuesta);

			# Actualizo la actividad (pregunta con sus posibles respuestas):
			$nuevo_id_actividad=$this->{$variables['modelo']}->guardar ($nueva_actividad->tabla_actividad,$data_nuevo,'id_'.$nueva_actividad->tabla_actividad,array('id_'.$nueva_actividad->tabla_actividad,$id_actividades_var));


			echo "Proceso realizado correctamente!";









		}



		else {

## CASO CUANDO ES UNA ACTIVIDAD DIFERENTE DE LAS PREGUNTAS! BORRO LA ANTERIOR, PONGO LA NUEVA

## consulto la tabla que debo borrar el dato:
			if ($id_tipo_actividades_antes_var)  {
			#consulto actividad anterior
				$actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_antes_var));
						## consulto la actividad actual
				$actividad_actual=$this->{$variables['modelo']}->detalle($actividad->tabla_actividad,array('id_'.$actividad->tabla_actividad,$id_actividades_var));
			}



#consulto nueva actividad
			$nueva_actividad=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$id_tipo_actividades_var));




## solo pasa esto si existe una actividad anterior
			if ($id_tipo_actividades_antes_var)  {

# consulto campos pampos de la actividad anterior
				$campos = $this->db->field_data($actividad->tabla_actividad);

				$llave_primaria='';   $campo_foto='';
				# obtengo llave primeria y campo foto		
				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);

				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];

## Borro el dato de la tabla de la actividad
				$this->model_generico->borrar($actividad->tabla_actividad,array('id_'.$actividad->tabla_actividad=>$id_actividades_var));
				if ($campo_foto)  {
					@unlink('uploads/'.$actividad->tabla_actividad.'/'.$actividad_actual->{$campo_foto});	
				}
			}


			## datos nuevos a insertar:
			$data_nuevo=array('id_modulos'=>$id_modulos_var,'nombre_actividad'=>$nom_activ,'descripcion_actividad'=>$desc_acti,
				'pregunta'=>$nombre_pregunta,'tipo_pregunta'=>$tipo_pregunta_opc,'id_estados'=>$id_estados_var);

			$data_nuevo['fecha_modificado']=date('Y-m-d H:i:s',time());  
			$data_nuevo['id_usuario_modificado']=$this->session->userdata('id_usuario');  
			$data_nuevo['fecha_creado']=date('Y-m-d H:i:s',time()); 
			$data_nuevo['id_usuario_creado']=$this->session->userdata('id_usuario');   
			$data_nuevo['variables_pregunta']=json_encode($opciones_respuesta);

# inserto la actividad nueva (pregunta con sus posibles respuestas):
			$nuevo_id_actividad=$this->{$variables['modelo']}->guardar ($nueva_actividad->tabla_actividad,$data_nuevo,'id_'.$nueva_actividad->tabla_actividad,'');




			$id=$id_var;


			$data_barra=array('id_tipo_actividades'=>$id_tipo_actividades_var,'id_estados'=>$id_estados_var,'id_actividades'=>$nuevo_id_actividad);
			


			if (trim($id)=='')  {
				$data_barra['fecha_creado']=date('Y-m-d H:i:s',time());  
				$data_barra['fecha_modificado']=date('Y-m-d H:i:s',time());  
				$data_barra['id_usuario_creado']=$this->session->userdata('id_usuario');  
				$data_barra['id_usuario_modificado']=$this->session->userdata('id_usuario');  
				$data_barra['id_modulos']=$id_modulos_var;  


			}


			$id=$this->model_generico->guardar('actividades_barra',$data_barra,'id_actividades_barra',array('id_actividades_barra',$id));
			echo "Proceso realizado exitosamente!";

			

		}








	}





	/* Funcion guardar registro */
	public function guardar()
	{

		$variables = $this->variables;
		$id=$this->input->post ('id');
		$this->load->helper($variables['modulo'].'_core');
		/* Validacion de campos de formulario */
		$this->form_validation->set_rules('nombre_actividad', 'Nombre', 'required|xss_clean');
		$this->form_validation->set_rules('descripcion_actividad', 'Descripcion', 'required|xss_clean');
		$this->form_validation->set_rules('id_estados', 'Estado', 'required|xss_clean');








		if($this->form_validation->run() == FALSE)
		{ 

			if ($id) {
				$this->editar($id);
			} else {
				$this->nuevo($id);

			}
			#echo validation_errors();
			#exit;

		}

		else {
			/* Cargo datos a guardar */
			$data = array(
				'nombre_actividad' => $this->input->post ('nombre_actividad'),
				'descripcion_actividad' => $this->input->post ('descripcion_actividad'),
				'id_estados' => $this->input->post ('id_estados'),
				);

			/* Si tiene id, es porque es editar, guarda la fecha de modificacion, de lo contrario guarda la fecha de creacion con su respectivo usuario */
			if ($id) { $data[$variables['id']]=$id; $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

			/* Guardo el registro */


			$tipo_actividades_detalle=$this->{$variables['modelo']}->get_tipo_actividades($this->input->post ('id_tipo_actividades'));




## funcion que me organiza los campos personalizados por el tipo de acitividad
			$data=obtener_campos_post_actividad($this->input->post ('id_tipo_actividades'),$data,$this->input->post(),$this);
			unset($data['id_actividades']);




## solo pasa esto si cambio de tipo de actividad, ingreso uno nuevo y borro el otro.
			if ($this->input->post('id_tipo_actividades_antes') && $this->input->post('id_tipo_actividades_antes')!=$this->input->post('id_tipo_actividades'))   {
				$tipo_actividades_detalle_antes=$this->{$variables['modelo']}->get_tipo_actividades($this->input->post ('id_tipo_actividades_antes'));

				$campos = $this->db->field_data($tipo_actividades_detalle_antes->tabla_actividad);

				$llave_primaria='';   $campo_foto='';
				# obtengo llave primeria y campo foto		
				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);

				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];

				$detalle_dato_borrar=$this->{$variables['modelo']}->detalle($tipo_actividades_detalle_antes->tabla_actividad, array($llave_primaria,$this->input->post('id_actividades'))   );

				$this->model_generico->borrar($tipo_actividades_detalle_antes->tabla_actividad,array('id_'.$tipo_actividades_detalle_antes->tabla_actividad=>$this->input->post('id_actividades')));
				if ($campo_foto)  {
					@unlink('uploads/'.$tipo_actividades_detalle_antes->tabla_actividad.'/'.$detalle_dato_borrar->{$campo_foto});

				}
				unset($id);

				unset($data['id_actividades']);


				$data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario'); 


				$id_acti=$this->model_generico->guardar($tipo_actividades_detalle->tabla_actividad,$data,'id_'.$tipo_actividades_detalle->tabla_actividad,array('id_'.$tipo_actividades_detalle->tabla_actividad,''));


			}

			else {

## guardo primero el dato de la actividad y miro cual es el id:
				$campos = $this->db->field_data($tipo_actividades_detalle->tabla_actividad);

				$tmp=get_id_foto_campos($campos);
				$tmp=explode ("|",$tmp);
				$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];
				if (@$id) { $data[$llave_primaria]=$this->input->post('id_actividades'); $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  } else {  $data['fecha_modificado']=date('Y-m-d H:i:s',time());  $data['id_usuario_modificado']=$this->session->userdata('id_usuario');  $data['fecha_creado']=date('Y-m-d H:i:s',time()); $data['id_usuario_creado']=$this->session->userdata('id_usuario');   }

				unset($data['id_actividades']);

				


				$id_acti=$this->model_generico->guardar($tipo_actividades_detalle->tabla_actividad,$data,'id_'.$tipo_actividades_detalle->tabla_actividad,array('id_'.$tipo_actividades_detalle->tabla_actividad,$this->input->post('id_actividades')));

			}



			$data['id_actividades']=$id_acti;
			$data['id_modulos']=$this->input->post('id_modulos');
			$data['id_tipo_actividades']=$this->input->post('id_tipo_actividades');
			$data['id_actividades_barra']=$this->input->post('id');
			unset($data['nombre_actividad']);
			unset($data['descripcion_actividad']);
			$data=eliminar_campos_actividad($this->input->post ('id_tipo_actividades'),$data);

			#krumo ($data);


## guardo datos en la tabla barra

			$id=$this->input->post ('id');


			#krumo ($data);  exit;


			$id=$this->model_generico->guardar('actividades_barra',$data,'id_actividades_barra',array('id_actividades_barra',$id));




			/* Redirecciono */
			$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$this->input->post ('id_cursos').'/'.$this->input->post ('id_modulos').'/'.$id.'/guardado_ok';
			redirect($accion_url);
		}
	}

	/* Funcion borrar registro */
	public function borrar()
	{
		$variables = $this->variables;
		$this->form_validation->set_rules('id', 'Id', 'required|xss_clean');
		$id=$this->input->post('id');
		$this->load->helper($variables['modulo'].'_core');
		## consulto actividades barra para saber la actividad a borrar
		$actividades_barra=$this->{$variables['modelo']}->detalle('actividades_barra',array('id_actividades_barra',$this->input->post ('id')));
		## tipo de actividad la que voy a borrar
		$tipo_actividades=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$actividades_barra->id_tipo_actividades));


		## consulto campos de la tabla de la actividad actual
		$campos = $this->db->field_data($tipo_actividades->tabla_actividad);

		$tmp=get_id_foto_campos($campos);
		$tmp=explode ("|",$tmp);
		## obtengo llave primaria y el campo foto si existe
		$llave_primaria=$tmp[0];  $campo_foto=$tmp[1];

		// consulto la actividad actual
		$actividad_actual=$this->{$variables['modelo']}->detalle($tipo_actividades->tabla_actividad,array($llave_primaria,$actividades_barra->id_actividades));

		// borro la actividad actual
		$this->model_generico->borrar($tipo_actividades->tabla_actividad,array($llave_primaria=>$actividades_barra->id_actividades));

		## si existe foto, la borro del sistema
		if ($campo_foto)  {
			@unlink('uploads/'.$tipo_actividades->tabla_actividad.'/'.$actividad_actual->{$campo_foto});	
		}


		## borro la tabla de actividades barra para dejar limpio el sistema
		$this->model_generico->borrar('actividades_barra',array('id_actividades_barra'=>$this->input->post ('id')));
		$accion_url=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/lista/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/index/borrado_ok';
		

		redirect($accion_url);






	}

	/*Funcion editar regitro  */
	public function editar($id_cursos,$id_modulos,$id,$error_extra=null)
	{

		$variables = $this->variables;
		$this->load->helper($variables['modulo'].'_core');
		$data['titulo']=$variables['modulo'];
		$data['detalle']=$this->{$variables['modelo']}->detalle_editar($id);
		$data['tipo_actividades_lista']=$this->{$variables['modelo']}->get_tipo_actividades();
		$data['error_extra']=$error_extra;
		$this->load->view('root/view_'.$variables['modulo'].'_editar',$data);
	}



	/* Consulta las respuestas en caso que las haya */
	public function consultar_posibles_respuestas()
	{

		$variables = $this->variables;
		$this->load->helper($variables['modulo'].'_core');
		$data['titulo']=$variables['modulo'];
		
		$post=$this->input->post('data');
		


		#echo $post['id_tipo_actividades'];
		#echo "\n";
		#echo $post['id_actividades'];

#consulto el tipo de actividad, para saber la tabla:
		$tipo_actividades=$this->{$variables['modelo']}->detalle('tipo_actividades',array('id_tipo_actividades',$post['id_tipo_actividades']));

#consulto la pregunta
		$acitividad=$this->{$variables['modelo']}->detalle($tipo_actividades->tabla_actividad,array('id_'.$tipo_actividades->tabla_actividad,$post['id_actividades']));

## muestro las posibles respuestas
		echo $acitividad->variables_pregunta;
		
		
	}




	/* Funcion ordenar (funciona solo en listado de registros, con arrastras y soltar la fila de la tabla) */
	public function ordenar()
	{
		$variables = $this->variables;
		$data = $this->input->post('data');
		$dataarray=explode (",",$data);



		foreach ($dataarray as $key => $value) {
			$this->model_generico->ordenar('actividades_barra',array("orden"=>$key+1),array('id_actividades_barra',$value));

		}

	}

}