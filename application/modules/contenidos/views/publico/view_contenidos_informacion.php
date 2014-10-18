<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 <base href="<?=base_url()?>" /> 
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo $contenido->titulo; ?>|<?php echo $custom_sistema->nombre_sistema; ?></title>
 <meta name="description" content="<?php echo $contenido->descripcion; ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php $this->load->view('view_site_css_js'); ?>
</head>
<body>
 <?php $this->load->view('view_site_header'); ?>
 <div class="brand_line">Hello</div>

 <section class="nosotros">
    <div class="nosotros_wrap">
        <div class="nosotros_col1" <?php if (!$contenido->foto): ?> style="width:100%;" <?php endif ?>>
            <?php echo $contenido->contenido; ?>
        </div>

<?php if ($contenido->foto): ?>
        <div class="nosotros_col2">
                <img src="uploads/contenidos/<?php echo $contenido->foto; ?>" alt="<?php echo $contenido->titulo; ?>    ">
        </div>
<?php endif ?>
    </div>
</section>

<?php $this->load->view('view_site_footer'); ?>
        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
    -->
</body>
</html>
