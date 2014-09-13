<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Pruebas extends CI_Controller {

	public function index()
	{
		echo "ok";
	}


  public function enviar_mail () {

    $array_claves=array('{nombres}'=>'Edwin','{apellidos}'=>'Garzon','{empresa}'=>'Escala','{correo}'=>'edwin.garzon@virtualab.co','{base_url}'=>'http://campusescala.com');

    envio_correo($array_claves,'webmaster@virtualab.co','webmaster virtualab','edwin.garzon@virtualab.co',"Bienvenido al sistema de ".'Escala','Edwin'.' '.'Garzon',site_url()."email_templates/plantilla_bienvenido_estudiante_fb.html",$this);
    echo "envio ok";


  }


  public function pdf () {


    $data='';

    $archivo="Pruebas";

    $pdfFilePath = FCPATH."/downloads/$archivo.pdf";

    ini_set('memory_limit','32M');
   $html=$this->load->view('prueba_certificado', $data,TRUE); // render the view into HTML


   $this->load->library('pdf');
   $this->pdf->fontpath = 'html/pdf/certificados/fonts/'; 




   $pdf = $this->pdf->load();
   # $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 


   $stylesheet = file_get_contents('html/pdf/certificados/style.css');
   $pdf->WriteHTML($stylesheet,1);
   $pdf->WriteHTML($html); 
   $pdf->Output($pdfFilePath, 'F'); 
 #$pdf->Output(); 


   if (file_exists($pdfFilePath)) {
     header('Content-type: application/force-download');
     header('Content-Disposition: attachment; filename='.date('Y-m-d_s').'.pdf');
     readfile($pdfFilePath);

   }





 }


}

/* End of file errores.php */
/* Location: ./application/controllers/errores.php */