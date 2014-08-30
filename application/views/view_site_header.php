       <?php #krumo($this->session->all_userdata()); ?>
       <!--HEADER-->
       <header>
        <div class="header_wrap">
          <a title="<?php echo $custom_sistema->nombre_sistema; ?>" href="<?php echo base_url(); ?>">  <section class="logo"></section></a>
          <!--NAVEGACIÓN-->
          <nav class="mobile-hider">
            <ul class="clear">
             <a href="cursos"> <li>Cursos</li></a>

             <?php if ($this->session->userdata('logeado')==1): ?>
              <a href="salir_sistema"><li>Salir</li></a>
            <?php else: ?>
              <a href="ingresar"><li>Ingresar</li></a>
            <?php endif ?>  
   <?php if ($this->session->userdata('logeado')!=1): ?>
            <a href="registro"> <li class="light_blue">Registrarse</li></a>
               <?php endif ?>  
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

      </div>
    </header>
    <div class="fixed_header"> </div>