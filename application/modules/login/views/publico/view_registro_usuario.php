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
  <?php $this->load->view('view_site_css_js'); ?>
  <link rel="stylesheet" href="login/assets/css/login.css"> 

  <script>
    $(function() {
//var ciudades = ["Aipe","Alban","Amaime","Andaluc\u00eda","Aratoca","Arcabuco","Arjona","Armenia","Armero","Barbosa","Barranquilla","Bayunca","Belencito","Bello","Bogot\u00e1","Bojaca","Bosa","Brice\u00f1o","Bucaramanga","Buenaventura","Buenos Aires","Buga","Buga La Grande","Caicedonia","Cajic\u00e1","Calarc\u00e1","Caldas","Cali","Caloto","Candelaria","Carmen de Bol\u00edvar","Cartagena","Cartago","Castilla","Caucasia","Cavasa","Cerete","Ch\u00eda","Chinauta","Chiquinquir\u00e1","Choconta","Cienaga","Circasia","Combita","Copacabana","Costa Rica","Cota","Cucaita","C\u00facuta","Dagua","Dosquebradas","Duitama","El Carmelo","El Cerrito","El Mu\u00f1a","El Placer","El Rosal","El Zulia","Engativ\u00e1","Envigado","Espinal","Facatativa","Flandes","Florida","Floridablanca","Fontib\u00f3n","Funza","Fusagasuga","Gachancip\u00e1","Gaira","Ginebra","Girardot","Gir\u00f3n","Guacar\u00ed","Guaduas","Guamo","Guarne","Guayavetal","Honda","Ibagu\u00e9","Ipiales","Itagui","Jamundi","La Calera","La Caro","La Ceja","La Dorada","La Estrella","La Paila","La Parada","La Tablaza","La Tebaida","La Uni\u00f3n","La Victoria","Lebrija","Loboguerrero","Los Patios","Madrid","Maicao","Malambo","Manizales","Marinilla","Mariquita","Medell\u00edn","Melgar","Mongui","Montenegro","Monter\u00eda","Mosquera","Natagaima","Neiva","Nemoc\u00f3n","Nobsa","Oiba","Ortigal","Paipa","Palmira","Pasto","Payande","Pereira","Piedecuesta","Piendamo","Pinchote","Planeta Rica","Popay\u00e1n","Pradera","Puente Piedra","Puente Quetame","Puerto Bogot\u00e1","Puerto Boyac\u00e1","Puerto Colombia","Puerto Salgar","Puerto Tejada","Purificaci\u00f3n","Quetame","Quimbaya","R\u00e1quira","Riohacha","Rionegro","Rodadero","Roldanillo","Rozo","Sabaneta","Salda\u00f1a","Samaca","San Antonio de Prado","San Crist\u00f3bal","San Gil","San Pedro","Santa Marta","Santa Rosa de Viterbo","Santander Quilichao","Sasaima","Sesquile","Sevilla","Sibat\u00e9","Silvania","Simijaca","Sincelejo","Soacha","Socorro","Sogamoso","Soledad","Sonso","Sopo","Suba","Subachoque","Susa","Sutamerch\u00e1n","Tabio","Taganga","Tenjo","Tibasosa","Tinjaca","Tocancipa","Tolemaida","Tul\u00faa","Tunia","Tunja","Turbaco","Ubat\u00e9","Usaqu\u00e9n","Usme","Valledupar","Ventaquemada","Vijes","Villa de Leiva","Villa del Rosario","Villa Gorgona","Villamaria","Villapinz\u00f3n","Villarica","Villavicencio","Villeta","Yotoco","Yumbo","Zarzal","Zipaquir\u00e1"];



$( "#ciudad" ).autocomplete({
  source: "<?php echo base_url().'ciudades'; ?>",
  minLength: 2,
});
});
</script>

</head>
<body> 
 <?php $this->load->view('view_site_header'); ?>
<?php /* ?>
 <section class="encabezado2 clear">
  <div class="encabezado2_wrap">
    <h6>Registro</h6>
    <p>Regístrate y disfruta de la web</p>
    
  </div>            
</section>
<?php */ ?>


<?php $attributos=array('name'=>'form-perfil','id'=>'form-perfil'); ?>
<?=form_open_multipart(base_url().'registro_usuario_validar',$attributos)?>


<section class="editar">

  <div class="editar_wrap">
    <a href="facebook_login/<?php echo $this->uri->segment(2); ?>"> <div class="facebook_btn">Registro con Facebook</div></a>
    
<?php /* ?>
    <div class="change_pic">
      <div class="change_pic_wrap clear">
        <div class="change_pic_col1 imagePreview">
          <img src="uploads/aprendices/<?php echo $this->input->post('userfile'); ?>" alt="">
        </div>
        <a id="cambia_foto" href="#"> <div class="change_pic_col2"> <p>Subir foto</p></div> </a>
        <input type="file" name="userfile" value="" id="userfile" onchange="previewImage(this,[256],4);" />
        <input type="hidden" name="foto_subida" value="<?php echo $this->session->userdata('foto_subida'); ?>">
      </div>
    </div>
    <?php */ ?>


    <div class="edit_block">
      <p>Nombre</p>
      <input type="text" placeholder="* Nombre" name="nombres" id="nombres" value="<?php if ($mensaje=='')  { echo $this->input->post('nombres'); } ?>"> 
      <?php echo form_error('nombres', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>

    <div class="edit_block">
      <p>Apellido</p>
      <input type="text" placeholder="* Apellido" name="apellidos" id="apellidos" value="<?php if ($mensaje=='')  {echo $this->input->post('apellidos'); } ?>">
      <?php echo form_error('apellidos', '<div class="mensaje_error">', '</div>'); ?> 
    </div>

    <div class="edit_block">
      <p>Email</p>
      <input type="text" placeholder="* email" name="correo" id="correo" value="<?php if ($mensaje=='')  { echo $this->input->post('correo'); } ?>">
      <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?> 
    </div>

<?php /* ?>
    <div class="edit_block">
      <p>Ciudad</p>
      <input type="text" placeholder="* Ciudad" name="ciudad" id="ciudad" value="<?php if ($mensaje=='')  { echo $this->input->post('ciudad');  } ?>"> 
      <?php echo form_error('ciudad', '<div class="mensaje_error">', '</div>'); ?>                       
    </div>

    <div class="edit_block">
      <p>Identificaci&oacute;n</p>
      <input type="text" placeholder="* Identificaci&oacute;n" name="identificacion" id="identificacion" value="<?php if ($mensaje=='')  { echo $this->input->post('identificacion'); } ?>">                        
      <?php echo form_error('identificacion', '<div class="mensaje_error">', '</div>'); ?> 
    </div>
    <?php */ ?>


    <div class="edit_block">
      <p>Contrase&ntilde;a</p>
      <input type="password" placeholder="* Contrase&ntilde;a" name="contrasena1" id="contrasena1" value="">                        
      <?php echo form_error('contrasena1', '<div class="mensaje_error">', '</div>'); ?> 
    </div>


    <div class="edit_block">
      <p>Confirmar Contrase&ntilde;a</p>
      <input type="password" placeholder="* Confirmar Contrase&ntilde;a" name="contrasena2" id="contrasena2" value="">                        
      <?php echo form_error('contrasena2', '<div class="mensaje_error">', '</div>'); ?> 
    </div>


    <?php #echo  form_error('userfile', '<div class="mensaje_error error_foto">', '</div>'); ?>

    <?php if ($mensaje): ?>
      <div class="titulo_registro">Verifica tu cuenta</div>
      <div style="margin: 8px; padding: 10px;"><?php echo $mensaje; ?></div>

<style>
  .editar_wrap a, .editar_wrap .edit_block { display: none; }
</style>

    <?php endif ?>


    <a href="#" id="submit"><div class="editar_btn">Registrarse </div> </a>



  </section>

  <?=form_close()?>


  <?php $this->load->view('view_site_footer'); ?>

  <style>
    #userfile {
      display: none;
    }

    .imagePreview p {
      display:none;
    }

    .error_foto{

    }
  </style>

  <script>

    $(document).ready(function() {

      $('#cambia_foto').click(function(event) {
        event.preventDefault();
        $('#userfile').click();
      });

      $('#submit').click(function(event) {
        event.preventDefault();


        if ($('#correo').val()=='')  {
          alert ("Por favor, escribe tu correo");
          return false;

        }

        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ( !expr.test($('#correo').val()) )  {
          alert("Error: La dirección de correo " + $('#correo').val() + " es incorrecta.");
          return false;
        }

        $('#form-perfil').submit();
      });

    });

  </script>

        <!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
      -->

    </body>
    </html>


