<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);

/*  Configuracion del sistema a nivel de programacion  */


################################################# CONFIGURACION GENERAL DEL SISTEMA #######################################################
#puntos por ser primer curso
$config['puntos_primer_curso']	= '10';
#puntos motivo primera actividad vista
$config['puntos_primera_actividad_realizada']	= '10';
##puntos por cada actividad
$config['puntos_por_actividad']	= '1';
##puntos por evaluacion (maximo)
$config['maximo_puntos_evaluacion']	= '10';

#puntos por compartir en las redes sociales
$config['puntos_social']	= '2';

##puntos por finalizar el modulo
$config['puntos_finalizar_modulo']	= '5';

#puntos del 5 por ciento de me encanta del mensaje del estudiante
$config['puntos_5_porciento_megusta_mensaje_foro']	= '3';
#puntos del 10 por ciento de me encanta del mensaje del estudiante
$config['puntos_10_porciento_megusta_mensaje_foro']	= '5';
#puntos del 15 por ciento de me encanta del mensaje del estudiante
$config['puntos_15_porciento_megusta_mensaje_foro']	= '10';

## puntos por terminar el curso completo (plan estandar)
$config['puntos_terminar_curso_estandar']	= '20';

## cantidad de puntos a restar en el sistema
$config['puntos_resta']	= '2';

############################### ID'S DE LOS ESTATUS TABLA ESTATUS BUSCAR EN LA BASE DE DATOS ##############################################
$config['Nuevo']	= '5';
$config['Experto']	= '6';
$config['Campeon']	= '7';
############################### ID'S DE LOS TIPOS DE PLANES DEL SISTEMA ##############################################
$config['Estandar']	= '1';
$config['Premium']	= '2';


############################# ID'S DEL TIPO DE ACTIVIDADES, TABLA ACTIVIDADES BUSCAR EN LA BASE DE DATOS #####################################
$config['Video']	= '1';
$config['Foro']	= '2';
$config['Evaluacion']	= '3';
$config['Clases_en_vivo']	= '4';

############################  ID'S DE LOS MOTIVOS CUANDO GANA PUNTOS POR ALGO TABLA MOTIVOS BUSCAR EN LA BASE DE DATOS #######################
$config['motivo_puntos_primer_curso']	= '1';
$config['motivo_puntos_por_actividad']	= '2';
$config['motivo_primera_actividad_realizada']	= '3';
$config['motivo_5_porciento_megusta_mensaje_foro']	= '4';
$config['motivo_10_porciento_megusta_mensaje_foro']	= '5';
$config['motivo_15_porciento_megusta_mensaje_foro']	= '6';
$config['motivo_puntos_fb']	= '7';
$config['motivo_puntos_tw']	= '8';
$config['motivo_puntos_finalizar_modulo']= '9';
$config['motivo_puntos_ganar_premio_sorpresa']	= '10';
$config['motivo_puntos_terminar_curso_estandar']	= '11';
$config['motivo_resta_puntos_falta_actividad']	= '12';

############################  ID'S DEL TIPO PREGUNTA PARA EVALUACIONES Y PARA LAS PREGUNTAS RAPIDAS #######################
$config['pregunta_tipo_test']	= '1';
$config['pregunta_elegir_de_una_lista']	= '2';
$config['pregunta_campo_de_texto']	= '4';


############################  ID'S DEL TIPOS PREMIO PARA LAS CAJAS SORPRESAS #######################
$config['tipos_premio_puntos']= '1';
$config['tipos_premio_video']	= '2';
$config['tipos_premio_foro']	= '3';
$config['tipos_premio_logro']	= '4';

############################  ID'S DE LOS ESTADOS EN EL SISTEMA #######################
$config['estado_inactivo']= '0';
$config['estado_activo']	= '1';
$config['estado_realizado']	= '2';
$config['estado_sin_realizar']	= '4';
$config['estado_por_calificar']	= '5';
$config['estado_finalizado']	= '6';
$config['estado_utilizado']	= '7';
$config['estado_no_utilizado']	= '10';

$config['estado_leido']	= '9';
$config['estado_no_leido']	= '8';

$config['estado_premio']	= '11';
$config['estado_calificado']	= '12';
$config['estado_eliminado']	= '13';
$config['estado_pagado']	= '14';


############################  PUNTOS REQUERIDOS PARA CADA NIVEL (NUEVO,EXPERTO Y CAMPEON) #######################
$config['requerido_nuevo']	 = '0';
$config['requerido_experto'] = '50';
$config['requerido_campeon'] = '100';


## variable para restar los dias, si pasado de 5 dias nada que ingresa al curso, se resta puntos por dia que vaya pasando
$config['dias_restar']	= '5';


################################VARIABLES PARA REALIZACION DE PAGOS EN LINEA####################################################

#=======================DATOS DE PAGO DE PRUEBA =========================
#Numero de tarjeta: 4111111111111111
#Codigo seguridad:  123
#Fecha expiracion:  01/2017
#=======================DATOS DE PAGO DE PRUEBA =========================


$config['url_confirmacion']	= $this->base_url().'cursos/payu_respuesta';
$config['url_respuesta']	= $this->base_url().'cursos/payu_respuesta';
$config['lng']="es";
$config['iva']=0;
$config['basevalor']=0;
$config['moneda']="COP";

$config['prueba']=1;


###################### datos reales#######################################
$config['llave_encripcion']='1dobqfi0tneccuscdb2nu33quq';
$config['merchantId']= "514697";


###################### datos de prueba#######################################
$config['llave_encripcion']='6u39nqhq8ftd0hlvnjfs66eh8c';
$config['merchantId']= "500238";
$config['accountId']= "500538";




################################VARIABLES PARA REALIZACION DE PAGOS EN LINEA####################################################