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

  <?php

  if(strlen($_GET['ref_venta'])>0)
  {
    $salereference=$_GET['ref_venta'] ;
    $gatewayreference=$_GET['ref_pol'];
    $transactioncode=$_GET['estado_pol'];
    $msg=$_GET['mensaje'];
    $value=$_GET['valor'];
  }
  else
  {
    $salereference=$_GET['referenceCode'] ;
    $gatewayreference=$_GET['reference_pol'];
    $transactioncode=$_GET['transactionState'];
    $msg=$_GET['message'];
    $value=$_GET['TX_VALUE'];
  }


  if($_GET['lng']=="es")
  {
    $pagetitle="Confirmación del pago";
    $title="Su pago est&aacute; siendo confirmado para procesar su orden...";
    $datelabel="Fecha";
    $salereferencelabel="N&ordm; de Recibo";
    $gatewayreferencelabel="codigo pol";
    $transactionstatelabel="Estado de la Transaccion";
    $paymentmethodlabel="Forma de Pago";
    $typepaymentlabel="Medio de pago";
    $msglabel="Mensaje";
    $valuelabel="Valor";
    $lastmsg="Gracias por comprar con nosotros!";
    $redirectmsg="En unos momentos será redireccionado a la p&aacute;gina
    principal";
  }
  else
  {
    $pagetitle="Payment Confirmation";
    $title="Your payment is currently being confirmed to process your order...";
    $datelabel="Date";
    $salereferencelabel="Receipt N&ordm;";
    $gatewayreferencelabel="LAP Code";
    $transactionstatelabel="Transaction State";
    $paymentmethodlabel="Payment Type";
    $typepaymentlabel="Payment Method";
    $msglabel="message";
    $valuelabel="Total";
    $lastmsg="Thanks for your purchase!";
    $redirectmsg="In a moment you will be redirected to the homepage";
  }
  ?>




  <section id="pago">
    <div class="pago_wrap">










      <table width="970" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#0099FF">
          <th width="100%" scope="col"><h1 class="Estilo1"><? echo $pagetitle ?></h1><br />
            <tr bordercolor="#000000">

              <tr scope="col"><span class="Estilo5">
                <td><? echo $datelabel ?>: <?php echo(date("Y-m-d",strtotime("now"))); ?></td>
              </span></tr>
              <tr scope="col"><span class="Estilo5">
                <td><? echo $salereferencelabel ?> : <? echo $salereference ?></td>
              </span></tr>
              <tr scope="col"><span class="Estilo5">
                <td><? echo $gatewayreferencelabel ?> : <? echo $gatewayreference ?></td>
              </span></tr>
              <tr scope="col"><span class="Estilo5">
                <td><? echo $transactionstatelabel ?>: <?
                  switch($_GET['estado_pol'])
                  {
                    case 1: echo "Sin abrir";
                    break;
                    case 2: echo "Abierta";
                    break;
                    case 3: echo "Pagada";
                    break;
                    case 4: echo "Pagada y Abonada";
                    break;
                    case 5: echo "Cancelada";
                    break;
                    case 6: echo "Rechazada";
                    break;
                    case 7: echo "En validacion";
                    break;
                    case 8: echo "Reversada";
                    break;
                    case 9: echo "Reversada Fraudulenta";
                    break;
                    case 10: echo "Enviada Ent. Financiera";
                    break;
                    case 11: echo "Capturando datos tarjeta de credito";
                    break;
                    case 12: echo "Esperando confirmacion sistema PSE";
                    break;
                  }
                  switch($_GET['transactionState'])
                  {
                    case 2: echo "NEW";
                    break;
                    case 4: echo "APPROVED";

                  ###### AQUI MENSAJE DE QUE FUE APROBADO LA TRANSACCION O REGISTRO DE PAGO



                  ###### AQUI MENSAJE DE QUE FUE APROBADO LA TRANSACCION O REGISTRO DE PAGO
                    break;
                    case 5: echo "EXPIRED";
                    break;
                    case 6: echo "DECLINED";
                    break;
                    case 7: echo "PENDING";


                    break;
                  }
                  ?></td>
                </span></tr>
                <tr scope="col"><span class="Estilo5">
                  <td><? echo $paymentmethodlabel; ?>:
                    <?
                    switch($_GET['tipo_medio_pago'])
                    {
                      case 2: echo " Tarjeta de crédito";
                      break;
                      case 3: echo " Tarjeta de crédito Verified by VISA";
                      break;
                      case 4: echo " Cuentas corrientes y de ahorros PSE";
                      break;
                      case 7: echo " Pago En Efectivo";
                      break;
                      case 8: echo " Pago En Efectivo";
                      break;
                    }


                    switch($_GET['polPaymentMethodType'])
                    {
                      case 2: echo " Credit Card";
                      break;
                      case 3: echo " Credit Card Verified by VISA";
                      break;
                      case 4: echo " PSE savings accounts";
                      break;
                      case 7: echo " Cash Payment";
                      break;
                      case 8: echo " Cash Payment";
                      break;
                    }
                    ?> </td>
                  </span></tr>
                  <tr><!-- Es el medio de pago utilizado en el pago -->
                    <td><span class="Estilo5"><? echo $typepaymentlabel; ?>:
                      <?php
                      switch($_GET['medio_pago'])
                      {
                        case 250: echo "Visa";break;
                        case 251: echo "MasterCard";break;
                        case 252: echo "American Express";break;
                        case 253: echo "Diners";break;
                        case 254: echo "PSE (Proveedor de Servicios Electr&oacute;nicos)";break;
                        case 255: echo "Baloto";break;
                        case 131: echo "Oxxo";break;
//Pagos en Panama
                        case 221: echo "American Express";break;
                        case 222: echo "MasterCard";break;



                        case 220: echo "Visa";break;
//Pagos en Peru
                        case 100:echo "VíaBCP";break;
                      }
                      switch($_GET['polPaymentMethod'])
                      {
                        case 250: echo "Visa";break;
                        case 251: echo "MasterCard";break;
                        case 252: echo "American Express";break;
                        case 253: echo "Diners";break;
                        case 254: echo "PSE ";break;
                        case 255: echo "Baloto";break;
                        case 131: echo "Oxxo";break;
//Pagos en Panama
                        case 221: echo "American Express";break;
                        case 222: echo "MasterCard";break;
                        case 220: echo "Visa";break;
//Pagos en Peru
                        case 100:echo "VíaBCP";break;
                      }
                      ?></span>
                    </td>
                  </tr>
                  <tr scope="col"><span class="Estilo5">
                    <td><? echo $msglabel; ?>: <? echo $msg; ?></td>
                  </span></tr>
                  <tr scope="col"><span class="Estilo5">
                    <td><? echo $valuelabel; ?>: <? echo $value; ?></td>
                  </span></tr>
                </tr><td bgcolor="#0099FF"><br />
                <h1 align="center" class="Estilo1"><? echo $lastmsg; ?></h1>
                <div align="center"><br />
                  <span class="Estilo2"><? echo $redirectmsg; ?></span></div></td>
                </tr>
              </table>










            </div>

          </section>


          <?php $this->load->view('view_site_footer'); ?>

          <script>
            $(document).ready(function() {


            });

          </script>

        </body>
        </html>
