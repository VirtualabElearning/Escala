<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
## funcion para traer los css,js,imagenes o cualquier tipo de formato al modulo especifico
class Color extends CI_Controller {

	function __construct() {

		parent::__construct();

		  header("Content-type: text/css; charset: UTF-8");
?>
/* ==========================================================================
    Color # 1 
   ======================== ================================================== */

.atributos,.light_blue,.curso_btn,.circle,.brand_line,.download_btn,.send_question,.current,.discusion_btn{
  background-color:#0f8dcd;
  color: #fff;
}

.light_blue:hover,.curso_btn:hover,.download_btn:hover,.send_question:hover,.discusion_btn:hover{
  background-color:#33adeb;
  color: #fff;
}
/* ==========================================================================
    Color # 1 TEXTO
   ======================== ================================================== */
.curso_des h2, .encabezado_wrap h6,.encabezado2_wrap h6,.col2_wrap h4,.pensum_block h2,.teacher_col2 h3,.perfil_col2 h3,.disc_block_A_col2 span{
  color:#0f8dcd;
}
/* ==========================================================================
    Color # 2
   ======================== ================================================== */
.color2,.encabezado,.encabezado2{
  background-color:#0c4a6e;
  color: #fff;
}

.color2:hover{
  background-color:#1c5e85;
  color: #fff;
}
/* ==========================================================================
    Color # 2 TEXTO
   ======================== ================================================== */
.dark_blue,nav ul li,.atributo_wrap h2,h4,.plan_wrap h3,.question_wrap h5{  
  color: #0c4a6e;
}
/* ==========================================================================
    Color # 3
   ======================== ================================================== */
/* ==========================================================================
    Color # 3 TEXTO
   ======================== ================================================== */
.desktop_nav a:link,.desktop_nav a:visited,.desktop_nav a:active,.atributo_wrap p, h5,.curso_des p,.testimonial_wrap p,.pepName h5,.pepName p,.col2_wrap p,.sus_col1 h3,.sus_col1 h4,.fecha,.sus_col2 h3,
.col2_wrap ul,.pensum_block p,.teacher_col2 h2,.teacher_col2 p,.login_wrap p,.perfil_col2 h6,.question_btn h6,.edit_block p, .editar_wrap a,.paginador_col2 ul li,.paginador_btn,.change_pic_col2 p,.forgot_pass,.disc_block_A_col1 h4,.disc_block_A_col1 h5,.disc_block_A_col2 p,.evaluacion_preg,.evaluacion_preg form span{
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
.ver_cursos{
  color:#fff;
  background-color:#f28d18;
}
.ver_cursos:hover{
  background-color:#ff9d2b;
}
/* ==========================================================================
    Color # 6 VERDE
   ======================== ================================================== */

.login_btn,.editar_btn,.evaluacion_btn{
  background-color:#5fcf80;
  color:#fff;
}

.login_btn:hover,.editar_btn:hover,.evaluacion_btn:hover{
  background-color:#76df95;
}


<?php
exit;	
	}
}

/* End of file assets.php */
/* Location: ./application/modules/actividades/controllers/assets.php */