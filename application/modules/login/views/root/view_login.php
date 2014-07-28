<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?=base_url()?>" />   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login - Virtualab</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="html/admin/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="html/admin/css/font-awesome.min.css">
  <link href="html/admin/css/style.css" rel="stylesheet">
  <link href="html/admin/css/custom.css" rel="stylesheet">
  <script src="html/admin/js/respond.min.js"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="html/admin/img/favicon/favicon.png">
</head>

<body>

  <!-- Form area -->
  <div class="admin-form">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <!-- Widget starts -->
          <div class="widget worange">
            <!-- Widget head -->
            <div class="widget-head">
              <i class="fa fa-lock"></i> Iniciar sesión 
            </div>
            <div class="widget-content">
              <div class="padd">

                <div class="logo_app"><img src="html/admin/img/logo_app.jpg" alt=""></div>



<?php if (@$error_extra): ?>
  <div class="mensaje_error"><?php echo base64_decode($error_extra); ?></div>
<?php endif ?>



                <?php $attributos=array('class'=>'form-horizontal'); ?>
                <!-- Login form -->
                <?=form_open(base_url().'login/root/validar',$attributos)?>
                <!-- Email -->
                <div class="form-group">
                  <label class="control-label col-lg-3" for="inputEmail">Correo</label>
                  <div class="col-lg-9">
                    <input type="email" name="correo" autocomplete="off" class="form-control" id="inputEmail" placeholder="Email">
                    <?php echo form_error('correo', '<div class="mensaje_error">', '</div>'); ?>
                  </div>
                </div>
                <!-- Password -->
                <div class="form-group">
                  <label class="control-label col-lg-3" for="inputPassword">Contraseña</label>
                  <div class="col-lg-9">
                    <input type="password" name="contrasena" autocomplete="off" class="form-control" id="inputPassword" placeholder="Password">
                    <?php echo form_error('contrasena', '<div class="mensaje_error">', '</div>'); ?>
                  </div>
                </div>
                <!-- Remember me checkbox and sign in button -->
               <?php /* ?>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="recordar" id="recordar"> Recordar
                      </label>
                    </div>
                  </div>
                </div>
<?php */ ?>
                <div class="col-lg-9 col-lg-offset-3">
                  <button type="submit" class="btn btn-info btn-sm">Entrar</button>
                  <button type="reset" class="btn btn-default btn-sm">Reset</button>
                </div>
                <br />
<?php  ?>
<a href="<?php echo base_url().'login/root/iniciar_sesion/'.$this->uri->segment(4).'/' ?>Facebook">Entrar con Facebook</a><br />
<a href="<?php echo base_url().'login/root/iniciar_sesion/'.$this->uri->segment(4).'/' ?>Twitter">Entrar con Twitter</a><br />

                <?=form_hidden('redirect',$redirect)?>
                <?=form_hidden('token',$token)?>
                <?=form_close()?>







              </div>
            </div>


          </div>  
        </div>
      </div>
    </div> 
  </div>


  <!-- JS -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>