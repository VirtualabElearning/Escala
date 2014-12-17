        <?php #krumo($this->session->all_userdata()); ?>
 <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

    <div class="conjtainer">
      <!-- Menu button for smallar screens -->
      <div class="navbar-header">
        <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
          <span>Menu</span>
        </button>
        <!-- Site name for smallar screens -->
        <a href="index.html" class="navbar-brand hidden-lg">Virtualab</a>
      </div>
      
      <?php #krumo($this->session->all_userdata()); ?>


      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <i class="fa fa-user"></i> <?php echo $this->session->userdata('nombres'); ?> <?php echo $this->session->userdata('apellidos'); ?> <b class="caret"></b>              
            </a>
            <ul class="dropdown-menu">
    <?php /* ?>
              <li><a href="login/root/perfil/<?php echo $this->session->userdata('id_usuario'); ?>"><i class="fa fa-user"></i> Perfil </a></li>
     <?php */ ?>   
          <?php /* ?>    <li><a href="#"><i class="fa fa-cogs"></i> Opciones</a></li> <?php */ ?>
              <li><a href="login/root/salir"><i class="fa fa-sign-out"></i> Salir</a></li>
            </ul>
          </li>
        </ul>
      </nav>




    </div>
  </div>


  <!-- Header start-->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="logo">
           <img src="html/admin/img/logo_app.jpg" alt="">
         </div>
       </div>
     </div>
   </div>
 </header>
 <!-- Header ends -->
