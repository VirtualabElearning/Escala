<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?=base_url()?>" /> 
	<link rel="stylesheet" type="text/css" href="html/pdf/certificados/style.css" />
	<meta charset="utf-8">
</head>


<body>


  <form method="post" name="forma" id="forma" action="<?php echo $url_gateway; ?>">

      <?php  ?>
      <input type="hidden" name="prueba" value="<?php echo $prueba; ?>">
      <input name="merchantId" type="hidden" value="<?php echo $merchantId; ?>"/>
      <input name="accountId" type="hidden" value="500538"/>
      <input type="hidden" name="refVenta" value="<?php echo $refVenta ?>">
      <input type="hidden" name="valor" value="<?php echo $valor ?>">
      <input type="hidden" name="iva" value="<?php echo $iva; ?>">
      <input type="hidden" name="baseDevolucionIva" value="<?php echo $basevalor; ?>">
      <input type="hidden" name="moneda" value="<?php echo $moneda ?>">
      <input type="hidden" name="url_confirmacion" value="<?php echo base_url(); ?>pruebas/confirmacion">
      <input type="hidden" name="url_respuesta" value="<?php echo base_url(); ?>pruebas/respuesta">
      <input type="hidden" id="emailComprador" name="emailComprador" value="<?=$correo_comprador?>">
      <input type="hidden" name="firma" value="<?php echo $firma_codificada ?>">
      <input type="hidden" name="lng" value="<?php echo $lng ?>">
      <input type="hidden" name="descripcion" value="<?php echo $descripcion; ?>">
      <input id="extra1" name="extra1" type="hidden" value="<?php echo $extra1; ?>" >  <?php ### id_usuario ?>
      <input id="extra2" name="extra2" type="hidden" value="<?php echo $extra2; ?>" >  <?php ### curso ?>
      <input id="extra3" name="extra3" type="hidden" value="<?php echo $extra3; ?>" >  <?php ### correo ?>
      <?php  ?>

      <input type="submit" value="pagar" name="pagar" id="pagar">

  </form>


</body>
</html>