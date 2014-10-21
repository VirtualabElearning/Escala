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


  <div id="load_screen">
    <div id="loading">                
      <img alt="loading" src="html/site/img/loading.GIF">
      <p>Cargando proceso de pago...</p>
    </div>
  </div>

  <form method="post" name="forma" id="forma" action="<?php echo $url_gateway; ?>">

  <?php  ?>
    <input type="hidden" name="prueba" value="<?php echo $prueba; ?>">
      <input name="merchantId" type="hidden" value="<?php echo $merchantId; ?>"/>

      <?php /* ?>
     <input name="accountId" type="hidden" value="<?php echo $accountId; ?>"/>
      <?php */ ?>
      
    <input type="hidden" name="refVenta" value="<?php echo $refVenta ?>">
    <input type="hidden" name="valor" value="<?php echo $valor ?>">
    <input type="hidden" name="iva" value="<?php echo $iva; ?>">
    <input type="hidden" name="baseDevolucionIva" value="<?php echo $basevalor; ?>">
    <input type="hidden" name="moneda" value="<?php echo $moneda ?>">
    <input type="hidden" name="url_confirmacion" value="<?php echo $url_confirmacion ?>">
    <input type="hidden" name="url_respuesta" value="<?php echo $url_respuesta?>">
    <input type="hidden" id="emailComprador" name="emailComprador" value="<?=$correo_comprador?>">
    <input type="hidden" name="firma" value="<?php echo $firma_codificada ?>">
    <input type="hidden" name="lng" value="<?php echo $lng ?>">
    <input type="hidden" name="descripcion" value="<?php echo $descripcion; ?>">
    <input id="extra1" name="extra1" type="hidden" value="<?php echo $extra1; ?>" >  <?php ### id_usuario ?>
    <input id="extra2" name="extra2" type="hidden" value="<?php echo $extra2; ?>" >  <?php ### curso ?>
    <input id="extra3" name="extra3" type="hidden" value="<?php echo $extra3; ?>" >  <?php ### correo ?>
<?php  ?>

</form>
    <script>
      $(document).ready(function() {
        $('#forma').submit();
      });
    </script>



</body>
</html>
