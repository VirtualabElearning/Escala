<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
## funcion para traer los css,js,imagenes o cualquier tipo de formato al modulo especifico
class Color extends CI_Controller {

	function __construct() {

		parent::__construct();

  $custom_sistema=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));

		  header("Content-type: text/css; charset: UTF-8");
?>

<?php if ($custom_sistema->fuente_general=='century'): ?>
@font-face {
    font-family: century;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHIC.eot?#iefix");
   
}
@font-face {
    font-family: century;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHIC.eot");

}
@font-face {
    font-family: century;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHIC.ttf");
    
}
@font-face {
    font-family: century;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHIC.woff");
 
}

@font-face {
    font-family: century_b;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICB.eot?#iefix");
  
}
@font-face {
    font-family: century_b;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICB.eot");
  
}
@font-face {
    font-family: century_b;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICB.ttf");

}
@font-face {
    font-family: century_b;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICB.woff");
    
}

@font-face {
    font-family: century_it;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICI.eot?#iefix");

}
@font-face {
    font-family: century_it;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICI.eot");
 
}
@font-face {
    font-family: century_it;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICI.ttf");

}
@font-face {
    font-family: century_it;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICI.woff");
   
}
@font-face {
    font-family: century_itb;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICBI.eot?#iefix");

}
@font-face {
    font-family: century_itb;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICBI.eot");

}
@font-face {
    font-family: century_itb;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICBI.ttf");
  
}
@font-face {
    font-family: century_itb;
    src: url("<?php echo base_url(); ?>html/site/css/fonts/GOTHICBI.woff");

}

<?php endif; ?>
@import url(http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $custom_sistema->fuente_general); ?>);

/* ==========================================================================
   FUENTE
   ======================== ================================================== */

body,html {
  font-family: '<?php echo $custom_sistema->fuente_general; ?>';  
}


h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 ,button, input, select, textarea,.filtro input[placeholder], [placeholder], [placeholder],.ver_cursos,.atributo_wrap p,.atributo_wrap h2,.atributos h3,.actualiza_tus_datos_wrap,.not_col2 h6 ,.not_col2 h5,.notificaciones_wrap h4,.inbos_wrap h4,.prof_av_col2 p,.profile_dark p,a,.send_question ,.question_wrap textarea,.question_btn h6,nav ul li,div#load_screen > div#loading,.question_btn h6,.disc_block_A_col2,.box2 p,.box3 p,.box4 p,.counter_foro,.miforocounter_foro,div#load_screen2 > div#loading {
  font-family: '<?php echo $custom_sistema->fuente_general; ?>';
}

<?php if ($custom_sistema->fuente_general=='century'): ?>

.perfil_col2 h6,.perfil_col2 h3,.noti_numero,.question_wrap h5,.question_wrap h6,.profile_dark h2,.prof_av_col2 h6,.status_txt p,.status_txt span,.avatar_infoblock,   .reporte_avatar ul,.ver_todos,.encabezado_wrap h6,.encabezado2_wrap h6,.filtro input,.modulos_title,.empezar_btn,.tutorial_inter_wrap h2,.pensum_block h2,.teacher_col2 h3,h4 ,.curso_des h2,.curso_des p,.sus_col1 h2,.sus_col1 h3,.sus_col2 h5,.sus_col2 h5 ,.fecha ,.sus_col3 h2 ,.sus_col3 h3,.imprimir_recibo, .ver_curso,.sus_col4 h2,.sus_col4 h3,.paginador_col2 ul li,.activity_title h3,.modules_wrap ul li p ,.aula_btns ul li p,.evaluacion_preg form select,.evaluacion_preg form span ,.evaluacion_btn,.volver,.evaluacion_wrap p.bien,.evaluacion_wrap p.mal,.evaluacion_wrap ul,.disc_block_A_col1 h4,.kudos p ,.disc_block_A_col2 span,.disc_block_B_col2 h4,.kudos p,.kudos_off p,.disc_block_B_col2 span ,.discusion_respuesta_wrap h6,.discusion_btn,.countinuar_btn,.plan_wrap h2,.plan_wrap h3 ,.plan_wrap ul li ,.premium_btn,.basic_btn,.login_wrap h3,.login_wrap h6,.contact_info,.forgot_pass h1,.forgot_pass h2,.nosotros_col1 h2,.nosotros_col1 h3,.landing h3,.cta_btn,.cta_btn_after,.cert_firma,.cert_block_wrap h3,.cert_btn,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,div#gracias,.thanks_btn,.box h4,#surprise_result span,.actividad_aprobada_wrap,.expl_txt h3,#expl_white li:nth-child(2), #expl_gray li:nth-child(2),.encabezado_wrap h6,.encabezado2_wrap h6,.filtro input,.landing_col1 h3,.box h3,.box h4,.actividad_aprobada_wrap,.noti_numero,.encabezado_wrap h6,.filtro input ,h4 ,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,.box h4,.noti_numero , .encabezado_wrap h6,.filtro input, h4,.empezar_btn,.disc_block_A_col1 h4,.disc_block_B_col1 h4 ,.numero_de_actividad_responsive,.evaluacion_wrap ul,.tutorial_inter_wrap h2,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,.box h4 {
  font-family: <?php echo $custom_sistema->fuente_general; ?>_b;
}

.teacher_col2 p,.pepName p  {
    font-family: <?php echo $custom_sistema->fuente_general; ?>_it;
}

.teacher_col2 h2,.pepName h5,.teacher_col2 h2 ,.pepName h5 {
 font-family: <?php echo $custom_sistema->fuente_general; ?>_itb;
}

<?php else: ?>

.teacher_col2 h2,.pepName h5,.teacher_col2 h2 ,.pepName h5,.teacher_col2 p,.pepName p,.perfil_col2 h6,.perfil_col2 h3,.noti_numero,.question_wrap h5,.question_wrap h6,.profile_dark h2,.prof_av_col2 h6,.status_txt p,.status_txt span,.avatar_infoblock,   .reporte_avatar ul,.ver_todos,.encabezado_wrap h6,.encabezado2_wrap h6,.filtro input,.modulos_title,.empezar_btn,.tutorial_inter_wrap h2,.pensum_block h2,.teacher_col2 h3,h4 ,.curso_des h2,.curso_des p,.sus_col1 h2,.sus_col1 h3,.sus_col2 h5,.sus_col2 h5 ,.fecha ,.sus_col3 h2 ,.sus_col3 h3,.imprimir_recibo, .ver_curso,.sus_col4 h2,.sus_col4 h3,.paginador_col2 ul li,.activity_title h3,.modules_wrap ul li p ,.aula_btns ul li p,.evaluacion_preg form select,.evaluacion_preg form span ,.evaluacion_btn,.volver,.evaluacion_wrap p.bien,.evaluacion_wrap p.mal,.evaluacion_wrap ul,.disc_block_A_col1 h4,.kudos p ,.disc_block_A_col2 span,.disc_block_B_col2 h4,.kudos p,.kudos_off p,.disc_block_B_col2 span ,.discusion_respuesta_wrap h6,.discusion_btn,.countinuar_btn,.plan_wrap h2,.plan_wrap h3 ,.plan_wrap ul li ,.premium_btn,.basic_btn,.login_wrap h3,.login_wrap h6,.contact_info,.forgot_pass h1,.forgot_pass h2,.nosotros_col1 h2,.nosotros_col1 h3,.landing h3,.cta_btn,.cta_btn_after,.cert_firma,.cert_block_wrap h3,.cert_btn,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,div#gracias,.thanks_btn,.box h4,#surprise_result span,.actividad_aprobada_wrap,.expl_txt h3,#expl_white li:nth-child(2), #expl_gray li:nth-child(2),.encabezado_wrap h6,.encabezado2_wrap h6,.filtro input,.landing_col1 h3,.box h3,.box h4,.actividad_aprobada_wrap,.noti_numero,.encabezado_wrap h6,.filtro input ,h4 ,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,.box h4,.noti_numero , .encabezado_wrap h6,.filtro input, h4,.empezar_btn,.disc_block_A_col1 h4,.disc_block_B_col1 h4 ,.numero_de_actividad_responsive,.evaluacion_wrap ul,.tutorial_inter_wrap h2,.not_block_col1 h4,.inbox_col1 p,.inbox_col2,.box h3,.box h4,.ver_cursos,.atributo_wrap p,.atributo_wrap h2,.atributos h3,.actualiza_tus_datos_wrap,.not_col2 h6 ,.not_col2 h5,.notificaciones_wrap h4,.inbos_wrap h4,.prof_av_col2 p,.profile_dark p,a,.send_question ,.question_wrap textarea,.question_btn h6,nav ul li,div#load_screen > div#loading,.question_btn h6,.disc_block_A_col2,.box2 p,.box3 p,.box4 p,.counter_foro,.miforocounter_foro,div#load_screen2 > div#loading {
  font-family: '<?php echo $custom_sistema->fuente_general; ?>';
}

<?php endif; ?>

/* ==========================================================================
    Color # 1 
   ======================== ================================================== */

#primary-menu li:hover,#primary-menu ul li a.active,.navmovil li a.active,.atributos,.light_blue,.curso_btn,.circle,.brand_line,.download_btn,.send_question,.current,.discusion_btn,.module_actual,.modulo_actual,.volver, .cert_btn{
  background-color:<?php echo $custom_sistema->colores_sistema2; ?>;
  color: #fff;

}


.curso_btn:hover{
  background-color: <?php echo aclararColor($custom_sistema->colores_sistema2, 50); ?> !important; 
}



.active_btn {
    border-bottom: 3pt solid <?php echo $custom_sistema->colores_sistema1; ?>;
    color: <?php echo $custom_sistema->colores_sistema1; ?> !important;
}


#primary-menu li a{
   color: <?php echo $custom_sistema->colores_sistema1; ?> !important;
}

.nosotros_col1 h2,.encabezado_wrap h6,.encabezado2_wrap h6,.curso_des h2 {
    color: <?php echo $custom_sistema->colores_sistema2; ?> !important;
}

.filtro input {
border: 2pt solid <?php echo $custom_sistema->colores_sistema2; ?>;
}



.circle {
border: <?php echo $custom_sistema->colores_sistema2; ?> 5pt solid;
}


.light_blue:hover,.curso_btn:hover,.download_btn:hover,.send_question:hover,.discusion_btn:hover,.module_actual:hover,.volver:hover,.cert_btn:hover{
  background-color:#33adeb;
  color: #fff;
}
/* ==========================================================================
    Color # 1 TEXTO
   ======================== ================================================== */
.explicacion_c,.col2_wrap h4,.pensum_block h2,.teacher_col2 h3,.perfil_col2 h3,.disc_block_A_col2 span,.landing_col1 h3,.inbox_curso, .inbox_actividad,.box h3,.evaluacion_wrap h2,.landing h3,div#gracias{
  color:<?php echo $custom_sistema->colores_sistema1; ?>;
}


/* ==========================================================================
    Color # 2
   ======================== ================================================== */
.color2,.encabezado,.encabezado2,.nosotros_col1{
  background-color:<?php echo $custom_sistema->colores_sistema1; ?>;
  color: #fff;
}

.color2:hover{
  background-color:#1c5e85;
  color: #fff;
}
/* ==========================================================================
    Color # 2 TEXTO
   ======================== ================================================== */
.dark_blue,nav ul li,.atributo_wrap h2,h4,.plan_wrap h3,.question_wrap h5,.question_wrap h6,.discusion_respuesta_wrap h6,.login_wrap h3,.login_wrap h6,.contact_info{  
  color: <?php echo $custom_sistema->colores_sistema1; ?>;
}
/* ==========================================================================
    Color # 3
   ======================== ================================================== */
/* ==========================================================================
    Color # 3 TEXTO
   ======================== ================================================== */
.desktop_nav a:link,.desktop_nav a:visited,.desktop_nav a:active,.atributo_wrap p, h5,.curso_des p,.testimonial_wrap p,.pepName h5,.pepName p,.sus_col1 h3,.sus_col1 h4,.fecha,.sus_col2 h3,.explicacion_wrap,
.col2_wrap ul,.pensum_block p,.teacher_col2 h2,.teacher_col2 p,.login_wrap p,.perfil_col2 h6,.question_btn h6,.edit_block p, .editar_wrap a,.paginador_col2 ul li,.paginador_btn,.change_pic_col2 p,.forgot_pass,.disc_block_A_col1 h4,.disc_block_A_col1 h5,.disc_block_A_col2 p,.evaluacion_preg,.evaluacion_preg form span,.tutorial_inter_wrap h2,.landing_col1 p,.not_block_col3 p,.evaluacion_wrap ul li p{
  color:#575756;
}
/* ==========================================================================
    Color # 4
   ======================== ================================================== */
.filtro input,.login_wrap input{
  background-color: #fff;
}
/* ==========================================================================
    Color # 4 TEXTO
   ======================== ================================================== */
.encabezado_wrap p,.empezar_btn,.facebook_btn{
  color:#fff;
}
/* ==========================================================================
    Color # 5 VER CURSOS BTN
   ======================== ================================================== */
.ver_cursos,.cta_btn{
  color:#fff;
  background-color:#f28d18;
}
.ver_cursos:hover,.cta_btn:hover{
  background-color:#ff9d2b;
}
/* ==========================================================================
    Color # 6 VERDE
   ======================== ================================================== */

.login_btn,.editar_btn,.evaluacion_btn,.tut_btn,.cta_btn_after,.thanks_btn,.imprimir_recibo,.ver_curso,.countinuar_btn{
  background-color: #5fcf80;
  color:#fff;
}

.login_btn:hover,.editar_btn:hover,.evaluacion_btn:hover,.tut_btn:hover,.cta_btn_after:hover,.thanks_btn:hover,.imprimir_recibo:hover,.ver_curso:hover,.countinuar_btn:hover{
  background-color:#76df95;
}



<?php
exit;	
	}
}

/* End of file assets.php */
/* Location: ./application/modules/actividades/controllers/assets.php */


 