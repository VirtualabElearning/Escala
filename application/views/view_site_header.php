       <?php #krumo($this->session->all_userdata()); ?>
       <div id="load_screen">
        <div id="loading">                
          <img src="html/site/img/loading.GIF" alt="loading">
          <p>Cargando Plataforma</p>
        </div>
      </div>
      <!--HEADER-->
      <header>
        <div class="header_wrap">
          <a title="<?php echo $custom_sistema->nombre_sistema; ?>" href="<?php echo base_url(); ?>"> 
           <section class="logo mobile-hider"> 
             <img src="html/site/img/logo.jpg" alt="logo">                   
           </section>
         </a>

         <!--NAVEGACIÓN-->


         <?php if ($this->session->userdata('logeado')!=1): ?>

          <nav class="mobile-hider">
            <ul class="clear">
             <a href="cursos"> <li>Cursos</li></a>
             <a href="ingresar"><li>Ingresar</li></a>
             <a href="registro_usuario"> <li class="light_blue">Registrarse</li></a>
           </ul>  
         </nav>

         <div class="header-nav mobile-visible">
          <div class="content-full clear">
            <div class="navigation">
              <div id="primary-menu">
                <div class="menu-icon" id="pull"><a href="#"></a></div>
                <ul>
                  <li><a href="cursos" class="menu-entry" id="menu1">Cursos</a></li>
                  <li><a href="ingresar" class="menu-entry" id="menu2">Ingresar</a></li>
                  <li><a href="registro" class="menu-entry" id="menu3">Registrarse</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>



      <?php if ($this->session->userdata('logeado')==1): ?>


        <nav class="desktop_nav">
          <ul class="clear">
           <li class="mobile-hider"><a href="cursos" class="menu-entry" id="menu1">Cursos</a></li>
           <li class="mobile-hider"><a class="menu-entry" href="mis_cursos">Mis Cursos</a> </li>
           <li><a class="menu-entry" href="#"><div class="inbox_btn"> <img alt="inbox" src="html/site/img/inbox_icon.png"></div></a></li>
           <li><a id="btn2" class="menu-entry">
            <div class="noti_btn">
              <img alt="notificaciones" src="html/site/img/noti_icon.png">
              <div class="noti_numero">7</div>
            </div>
          </a>
        </li>
        <li>
          <a id="btn" class="menu-entry" href="#">
            <div class="perfil_btn clear">
              <div class="perfil_col1">
                <img alt="<?php echo $this->encrypt->decode($this->session->userdata('nombres')); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?>" src="uploads/aprendices/<?php echo $this->encrypt->decode( $this->session->userdata('foto') ); ?>">                                        
              </div>
              <div id="btn" class="perfil_col2">
                <h3 class="puntos">175</h3>
              </div>

            </div>
          </a>
        </li>
      </ul>  
    </nav>





    <div class="header-nav mobile-visible">
      <div class="content-full clear">
        <div class="navigation">
          <div id="primary-menu">
            <div id="pull" class="menu-icon"><a href="#"></a></div>
            <ul>
              <li><a id="menu1" class="menu-entry" href="cursos">Cursos</a></li>
              <li><a id="menu2" class="menu-entry" href="mis_cursos">Mis cursos</a></li>
              <li><a id="menu3" class="menu-entry" href="salir_sistema">Salir</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>
</div>
</header>
<div class="fixed_header"> </div>




<?php if ($this->session->userdata('logeado')==1 && $this->session->userdata('if_update')==1): ?>
  <a href="login/editar_perfil/fb">
    <section class="actualiza_tus_datos">
      <div class="actualiza_tus_datos_wrap">
        <p><?php echo $this->encrypt->decode($this->session->userdata('nombres')); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?> Por favor actualiza tus datos incluyendo la contraseña, haciendo clic aquí</p>
      </div>
    </section>
  </a>
<?php endif; ?>



<section class="profile">
  <div class="profile_wrap">
    <div class="profile_dark">  
      <p>Cerrar</p>                  
    </div>  
    <div class="profile_avatar">
      <div class="profile_avatar_wrap clear">
        <div class="prof_av_col1">
          <img alt="<?php echo $this->session->userdata('nombres'); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?>" src="uploads/aprendices/<?php echo $this->encrypt->decode($this->session->userdata('foto')); ?>">
        </div>
        <div class="prof_av_col2">
          <h6><?php echo $this->encrypt->decode($this->session->userdata('correo')); ?></h6>
          <p><?php echo $this->encrypt->decode($this->session->userdata('nombres')); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?></p>
        </div>
      </div>
      <div class="avatar_infoblock clear">
        <div class="avatar_infoblock_col1">
          <h3>Estatus</h3>
        </div>
        <div class="avatar_infoblock_col2">
          <p><?php echo $this->encrypt->decode( $this->session->userdata('nombre_estatus') ); ?></p>
        </div>
      </div>
      <div class="avatar_infoblock clear">
        <div class="avatar_infoblock_col1">
          <h3>Puntaje</h3>
        </div>
        <div class="avatar_infoblock_col2">
          <p>173</p>
        </div>
      </div>
      <div class="avatar_infoblock clear">
        <div class="avatar_infoblock_col1">
          <h3>Logros</h3>
        </div>
        <div class="avatar_infoblock_col2">
          <p>9</p>
        </div>
      </div>
      <div class="medal_container clear">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
        <img alt="medal" src="html/site/img/medal.png">
      </div>
    </div>
    <div class="profile_btns">
      <ul class="clear">
        <a href="login/editar_perfil"><li>Editar Perfil</li></a>
        <a href="cursos/mis_certificados"><li>Certificados</li></a>
        <a href="login/suscripcion"><li class="profile_third_btn">Suscripción</li></a>
      </ul>
    </div>
    <div class="profile_dark">  
      <a href="salir_sistema">  <h2>Cerrar Sesion</h2>    </a>            
    </div>              
  </div>
</section>




<section class="notificaciones" style="display: block;">
  <div class="notificaciones_wrap">
    <h4>Notificaciones</h4>
    <ul>
      <li class="clear">
        <div class="not_col1">

        </div>
        <div class="not_col2">
          <h5>Dolor sit amet, consectetur adipisicing...</h5>
          <h6>Agosto 04, 10 am</h6>
        </div>
      </li>
      <li class="clear">
        <div class="not_col1">

        </div>
        <div class="not_col2">
          <h5>Dolor sit amet, consectetur adipisicing...</h5>
          <h6>Agosto 04, 10 am</h6>
        </div>
      </li>
      <li class="clear">
        <div class="not_col1">

        </div>
        <div class="not_col2">
          <h5>Dolor sit amet, consectetur adipisicing...</h5>
          <h6>Agosto 04, 10 am</h6>
        </div>
      </li>
      <li class="clear">
        <div class="not_col1">

        </div>
        <div class="not_col2">
          <h5>Dolor sit amet, consectetur adipisicing...</h5>
          <h6>Agosto 04, 10 am</h6>
        </div>
      </li>
    </ul>
  </div>
</section>


