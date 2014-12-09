<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <base href="<?=base_url()?>" /> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/normalize.min.css">

  <?php $this->load->view('view_site_css_js'); ?>

</head>
<body> 
  <?php $this->load->view('view_site_header'); ?>

  


  <section class="encabezado2 clear">
    <div class="encabezado2_wrap">
      <h6>Subscripción</h6>
      <p>Respuesta de tu transacci&oacute;n</p>
      <div class="circle">
        <div class="circle_wrap">
          <img alt="" src="html/site/img/icono_19.png">
        </div>
      </div>
    </div>            
  </section>






  <section class="aula">
    <div class="aula_wrap clear">
      <?php
      $ApiKey=$this->config->item('llave_encripcion');

      $merchant_id=$_REQUEST['merchantId'];
      $referenceCode=$_REQUEST['referenceCode'];
      $TX_VALUE=$_REQUEST['TX_VALUE'];
      $New_value=number_format($TX_VALUE, 1, '.','');
//Se debe aproximar el valor siempre a un decimal.
      $currency=$_REQUEST['currency'];
      $transactionState=$_REQUEST['transactionState'];
      $firma_cadena= "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);//firma que generaron ustedes
$firma =$_REQUEST['signature'];//firma que envía nuestro sistema

$reference_pol=$_REQUEST['reference_pol'];
$cus=$_REQUEST['cus'];
$extra1=$_REQUEST['description'];
$pseBank=$_REQUEST['pseBank'];
$lapPaymentMethod=$_REQUEST['lapPaymentMethod'];
$transactionId=$_REQUEST['transactionId'];

## transaccion cuando falla
if($_REQUEST['transactionState'] == 6 && $_REQUEST['polResponseCode'] == 5)
  {$estadoTx = "Transacci&oacute;n fallida";}

### transaccion cuando es rechazado
else if($_REQUEST['transactionState'] == 6 && $_REQUEST['polResponseCode'] == 4)
  {$estadoTx = "Transacci&oacute;n rechazada";}

### transaccion cuando está pendiente
else if($_REQUEST['transactionState'] == 12 && $_REQUEST['polResponseCode'] == 9994)
  {$estadoTx = "Pendiente, Por favor revisar si el d&eacute;bito fue realizado en el Banco";}

##transaccion cuando es aprobado.
else if($_REQUEST['transactionState'] == 4 && $_REQUEST['polResponseCode'] == 1)
{
  $estadoTx = "Transacci&oacute;n aprobada";
}
else
  {$estadoTx=$_REQUEST['mensaje'];}
if(strtoupper($firma)==strtoupper($firmacreada)){//comparacion de las firmas para comprobar que los datos si vienen de PayU.
  ?>
  

  <?php if($_REQUEST['transactionState'] == 4 && $_REQUEST['polResponseCode'] == 1) { ?>
  <div  class="sus_col3">
    <h2> <?php echo $estadoTx; ?> </h2>
    <h3>Usuario Premium</h3>
    <h4>Tu suscripción fué exitosa.</h4>
  </div>

  <?php  ?>
  <?php ## mensaje fallido u otro mensaje negativo ?>
  <?php } else { ?>

  <div class="sus_col4">
    <h2><?php echo $estadoTx; ?> </h2>
    <h3>Usuario Premium</h3>
    <h4>Revisar la información proporcionada o contacta al area de soporte para solucionar cualquier inquietud.</h4>
  </div>

  <?php } ?>



<?php /* ?>

  <h2>Resumen Transacción</h2>
  <table style="width:40%; border-spacing:1;">
    <tr>
      <td>Estado de la transaccion</td>
      <td><?php echo $estadoTx; ?> </td>
    </tr>
    <tr>
      <tr>
        <td>ID de la transaccion</td>
        <td><?php echo $transactionId; ?> </td>
      </tr>
      <tr>
        <td>referencia de la venta </td>
        <td><?php echo $reference_pol; ?> </td> </tr>
        <tr>
          <td>Referencia de la transaccion </td>
          <td><?php echo $referenceCode; ?> </td>
        </tr>
        <tr>
          <?php
          if($banco_pse!=null){
            ?>
            <tr>
              <td>cus </td>
              <td><?php echo $cus; ?> </td>
            </tr>
            <tr>
              <td>Banco </td>
              <td><?php echo $pseBank; ?> </td>
            </tr>
            <?php
          }
          ?>
          <tr>
            <td>Valor total</td>
            <td>$<?php echo number_format($TX_VALUE); ?> </td>
          </tr>
          <tr>
            <td>moneda </td>
            <td><?php echo $currency; ?></td>
          </tr>
          <tr>
            <td>Descripción:</td>
            <td><?php echo ($extra1); ?></td>
          </tr>
          <tr>
            <td>Entidad:</td>
            <td><?php echo ($lapPaymentMethod); ?></td>
          </tr>

        </table>
        <?php */ ?>


        <?php if($_REQUEST['transactionState'] == 4 && $_REQUEST['polResponseCode'] == 1) { ?>
        <?php /* ?>
        <div onclick="window.print();" class="imprimir_recibo">Imprimir recibo</div>
        <?php */ ?>
        <a href="cursos/detalle/<?php echo $curso_comprado->id_cursos; ?>/<?php echo amigable($curso_comprado->titulo); ?>.html"> <div class="ver_curso">Ver curso</div> </a>  
        <?php  ?>

        <?php ## estados negativos de pago ?>
        <?php } else { ?>
        <a href="cursos/detalle/<?php echo $curso_a_comprar->id_cursos; ?>/<?php echo amigable($curso_comprado->titulo); ?>.html"> <div class="imprimir_recibo"> Volver a intentar </div> </a>
        <?php } ?>






        <?php
      } else {
        ?>
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="100%" scope="col"><h1>Error validando firma digital.</h1>
              <br />
            </tr>
          </table>
          <?php
        }
        ?>

      </div>

    </section>



    <?php $this->load->view('view_site_footer'); ?>

    <script>
      $(document).ready(function() {


      });

    </script>

  </body>
  </html>
