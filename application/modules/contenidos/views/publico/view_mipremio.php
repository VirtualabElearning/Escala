<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 <base href="<?=base_url()?>" /> 
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title>¡He ganado un premio por hacer un curso en línea!</title>
 <meta name="description" content="<?php echo $mensaje; ?>">
<meta property="og:image" content="<?=base_url()?>html/site/img/icono_8.png" />
 <?php $this->load->view('view_site_css_js'); ?>
<script type="text/javascript">
<!--
function delayer(){
    window.location = ".<?php echo $url; ?>"
}
//-->
</script>
<style>
    
    div#load_screen2 {
    background: none repeat scroll 0 0 #fff;
    height: 1600px;
    opacity: 1;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 60;
    display:block;
}


div#load_screen2 > div#loading {
    background: url("<?=base_url()?>html/site/img/virtualab.png") no-repeat scroll 10px 15px rgba(0, 0, 0, 0);
    color: #0f8dcd;
    font-family: century;
    font-size: 16px;
    height: 120px;
    margin: 250px auto;
    position: relative;
    width: 120px;
}

#loading p {
    text-align: center;
}
</style>
</head>
<body onLoad="setTimeout('delayer()', 5000)">



<div id="load_screen2">
        <div id="loading">                
          <img alt="loading" src="html/site/img/loading.GIF">
          <p>Cargando, por favor espere...</p>
        </div>
      </div>

        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
    -->
</body>
</html>
