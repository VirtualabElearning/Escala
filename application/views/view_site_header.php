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
             <img src="escalar.php?src=<?php echo base_url(); ?>uploads/personalizacion_general/<?php echo $custom_sistema->logo; ?>&amp;h=110&amp;zc=1" alt="logo">                   
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
              <div class="noti_numero"><?php echo $notificaciones_count; ?></div>
            </div>
          </a>
        </li>
        <li>
          <a id="btn" class="menu-entry" href="#">
            <div class="perfil_btn clear">
              <div class="perfil_col1">

                <?php ## evaluo si no tiene foto de perfil
                $foto_perfil="uploads/aprendices/".$this->encrypt->decode($this->session->userdata('foto'));
                if (  !file_exists($foto_perfil) || strlen($this->encrypt->decode($this->session->userdata('foto')))==0  )  {
                  $foto_perfil="html/site/img/sin_foto.png";
                } 
                ?>
                <img alt="<?php echo $this->encrypt->decode($this->session->userdata('nombres')); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?>" src="<?php echo $foto_perfil; ?>">                                        
              </div>
              <div id="btn" class="perfil_col2">
                <h3 class="puntos mis_puntos">0</h3>
                <?php #$data_estatus_proximo=explode("|", $datos_proximo_estatus); 

                ?>
                <input type="hidden" id="proxsts" value="<?php echo ($datos_proximo_estatus); ?>">  
                <input type="hidden" id="proxsts2">  
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

<?php if ($this->session->userdata('logeado')==1): ?>

  <section class="profile">
    <div class="profile_wrap">
      <div class="profile_dark">  
        <p>Cerrar</p>                  
      </div>  
      <div class="profile_avatar">
        <div class="profile_avatar_wrap clear">
          <div class="prof_av_col1">
          <?php ## evaluo si no tiene foto de perfil
                $foto_perfil="uploads/aprendices/".$this->encrypt->decode($this->session->userdata('foto'));
                if (  !file_exists($foto_perfil) || strlen($this->encrypt->decode($this->session->userdata('foto')))==0  )  {
                  $foto_perfil="html/site/img/sin_foto.png";
                } 
                ?>
          <img alt="<?php echo $this->session->userdata('nombres'); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?>" src="<?php echo $foto_perfil; ?>">
        </div>
        <div class="prof_av_col2">
          <h6><?php echo $this->encrypt->decode($this->session->userdata('correo')); ?></h6>
          <p><?php echo $this->encrypt->decode($this->session->userdata('nombres')); ?> <?php echo $this->encrypt->decode($this->session->userdata('apellidos')); ?></p>
        </div>
      </div>


      <div class="status_bar hider solocurso clear">
       {barra}
     </div>
     <div class="status_txt hider solocurso clear">
      <p class="mis_puntos">0</p>
      <span class="puntos_proximo">{0}</span>
    </div>

    <div class="avatar_infoblock clear hider solocurso">
      <div class="avatar_infoblock_col1">
        <h3>Estatus</h3>
      </div>
      <div class="avatar_infoblock_col2 ">
        <p class="mistatus"><?php echo @$detalle_curso->miestatusnombre; ?></p>
      </div>
    </div>
    <div class="avatar_infoblock clear hider solocurso">
      <div class="avatar_infoblock_col1">
        <h3>Puntaje</h3>
      </div>
      <div class="avatar_infoblock_col2">
        <p class="mis_puntos">0</p>
      </div>
    </div>
    <div class="avatar_infoblock clear hider solocurso">
      <div class="avatar_infoblock_col1">
        <h3>Logros</h3>
      </div>
      <div class="avatar_infoblock_col2">
        <p class="count_logros">0</p>
      </div>
    </div>

    <div class="medal_container clear mi_listado_logros hider solocurso">

     <?php echo $mis_logros_curso; ?>

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


<div class="notificaciones_container">

  <section class="notificaciones" style="display: block;">
    <div class="notificaciones_wrap">
      <h4>Notificaciones</h4>
      <ul>

        <?php $meses=array("0"=>"","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre") ?>
        <?php foreach ($notificaciones as $noti_key => $noti_value): ?>
          <?php  
          $datetime=explode (" ",$noti_value->fecha_creado);
          $fecha=explode ("-",$datetime[0]);
          ?>

          <li class="clear">
            <div class="not_col1">
            </div>
            <div class="not_col2">
             <a href="<?php echo base_url(); ?>notificaciones/<?php echo $noti_value->id_notificaciones; ?>">
               <h5><?php echo  substr($noti_value->mensaje, 0, 35)."..."; ?></h5>
               <h6> <?php echo $meses[$fecha[1]] ?> <?php echo $fecha[2]; ?>, <?php echo $datetime[1]; ?></h6>
             </a>
           </div>
         </li>

       <?php endforeach ?>

     </ul>
   </div>
 </section>
</div>

<?php endif; ?>