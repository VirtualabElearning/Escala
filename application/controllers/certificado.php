<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
## funcion para traer los css,js,imagenes o cualquier tipo de formato al modulo especifico
class Certificado extends CI_Controller {

  function __construct() {

    parent::__construct();

  $custom_sistema=$this->model_generico->detalle('personalizacion_general',array('id_personalizacion_general'=>1));


      header("Content-type: text/css; charset: UTF-8");
?>
body {
 color: #575756;
 font-family: Arial;
 text-align: center;
}

.wrapper {
   color: #575756;
   height: 300px;
   margin: 0 auto;
   padding: 10px 40px 40px;
   text-align: center;
   width: 950px;
}
 
.main {
 border: 1pt solid #777777;  
 margin-top: 60%;
 position: relative;

}


.Escuela, .certifica, .duracion {
    font-size: 124px;
    margin-top: 5px;
}

.divnombres {
    margin-top: 120px;
}

.centered {
    left: 21%;
    position: relative;
    top: 30%;
}

.logopdf{
  position: relative;
  width: 80px;
  margin-left: 85%;
}

.Escuela{
    font-size: 18px;
    margin-left: 1px;
    margin-right: 6%;
}

.licencia{
 font-size: 10px;
 margin: 0 0 15px;
 margin-right: 30px;
}

.certifica {
    margin: 0 0 15px;
}
.Escuela, .certifica, .identificado, .duracion {
    font-size: 19px;
}

.linea1{
    border-bottom: 1pt solid #575756;
    width: 82%;
    margin-left: 10%;
}

.campo1 {
    text-align: center;
}

.capa1 {
  margin-left: 137px;
}

.linea2 {
    border-bottom: 1pt solid #575756;
    width: 22%;
    margin-left: 44%;
    margin-top: 0%;
}

.cedula{
   margin-top: -25px;
   margin-left: 45%;
   width: 140px;
}

.identificado{
    text-align: none;
    margin-top: 10px;
    margin-left: 10%;
}

.cert_firma{
    margin-top: 8%;
    font-size: 11px;
    margin-right: 51%;
}

.linea3{
   border-bottom: 1pt solid #575756; 
   margin-left: 28%;
   width: 170px;
}


.footer_pdf {
   background-position: top 10px;
   background-position: left 10px;
   background-repeat: no-repeat;
   height: 145px;
   width: 900px;
   margin-top: -54px;
   border: none;
   <?php if ($custom_sistema->image_footer!='') { ?> background-image: url("uploads/personalizacion_general/<?php echo $custom_sistema->image_footer; ?>"); <?php } else {?> background-color: <?php echo $custom_sistema->colores_sistema3; ?>; margin-top:1px; <?php } ?>
}






<?php
exit; 
  }
}

/* End of file assets.php */
/* Location: ./application/modules/actividades/controllers/assets.php */


 