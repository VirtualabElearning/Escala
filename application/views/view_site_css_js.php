<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="html/admin/img/favicon/favicon.png">
<link rel="stylesheet" href="html/site/css/normalize.min.css">
<link rel="stylesheet" href="html/site/css/main.css">
<?php /* ?>
<link rel="stylesheet" href="html/site/css/color.css">
<?php */ ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>color.css">
<link rel="stylesheet" href="html/site/css/custom.css">
<script src="html/site/js/vendor/modernizr-2.6.2.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="html/site/js/jquery-1.7.2.min.js">');</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>


<script src="html/site/js/html5.image.preview.min.js"></script>
<script type="text/javascript" src="html/site/js/functions.js"></script>
<script type="text/javascript" src="html/site/js/custom.js"></script>


<script>
	
	window.addEventListener("load", function(){
		var load_screen = document.getElementById("load_screen");
		document.body.removeChild(load_screen);
	});


</script>
<script type="text/javascript">
	
	$(document).ready(function(){
		setMenuActive(3);
	});

</script>

	<?php echo $custom_sistema->google_analytics; ?>

<style>

	@media screen and (min-width: 480px) and (max-width: 719px) {
		.logo {
			background-image: url("escalar.php?src=<?php echo base_url(); ?>uploads/personalizacion_general/<?php echo $custom_sistema->logo; ?>&h=80&w=80&amp;zc=1");
		}

	}
@media screen and (min-width: 20px) and (max-width: 479px) {
.logo {
			background-image: url("escalar.php?src=<?php echo base_url(); ?>uploads/personalizacion_general/<?php echo $custom_sistema->logo; ?>&h=80&w=80&amp;zc=1");
		}
}

</style>