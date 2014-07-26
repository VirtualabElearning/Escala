    <div class="sidebar">
      <div class="sidebar-dropdown"><a href="inicio/root">Navegacion</a></div>


      <ul id="nav">

        <li <?php if ($this->uri->segment(1)=='inicio')  { ?> class="open" <?php } ?> ><a href="inicio/root"><i class="fa fa-home"></i> Principal</a>
        </li>




        <li class="has_sub <?php if ($this->uri->segment(1)=='contenidos' || $this->uri->segment(1)=='noticias')  { ?> open <?php } ?>">
          <a href="#"><i class="fa fa-file-o"></i> Contenidos web <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
          <ul <?php if ($this->uri->segment(1)=='contenidos' || $this->uri->segment(1)=='noticias')  { ?> style="display: block;" <?php } ?>>
            <li <?php if ($this->uri->segment(1)=='contenidos')  { ?> class="open" <?php } ?>><a href="contenidos/root">Contenidos</a></li>
            <li <?php if ($this->uri->segment(1)=='noticias')  { ?> class="open" <?php } ?>><a href="noticias/root">Noticias</a></li>
          </ul>
        </li> 

        <li class="has_sub <?php if ($this->uri->segment(1)=='usuarios' || $this->uri->segment(1)=='roles')  { ?> open <?php } ?>"><a href="#"><i class="fa fa-users"></i> Usuarios <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
          <ul>
            <li <?php if ($this->uri->segment(1)=='usuarios')  { ?> class="open" <?php } ?>><a href="usuarios/root">Lista de usuarios</a></li>
            <li <?php if ($this->uri->segment(1)=='instructores')  { ?> class="open" <?php } ?>><a href="instructores/root">Lista de instructores</a></li>
            <li <?php if ($this->uri->segment(1)=='aprendices')  { ?> class="open" <?php } ?>><a href="aprendices/root">Lista de aprendices</a></li>
            <li <?php if ($this->uri->segment(1)=='roles')  { ?> class="open" <?php } ?>><a href="roles/root">Lista de roles</a></li>
          </ul> 
        </li>       

<?php /* ?>

        <li class="has_sub <?php if ($this->uri->segment(1)=='cursos' || $this->uri->segment(1)=='estatus' || $this->uri->segment(1)=='logros' || $this->uri->segment(1)=='docentes' || $this->uri->segment(1)=='estudiantes' || $this->uri->segment(1)=='notas')  { ?> open <?php } ?>"><a href="#"><i class="fa fa-book"></i> Cursos <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
          <ul>
            <li <?php if ($this->uri->segment(1)=='logros')  { ?> class="open" <?php } ?>><a href="logros/root">Lista de logros</a></li>
            <li <?php if ($this->uri->segment(1)=='estatus')  { ?> class="open" <?php } ?>><a href="estatus/root">Lista de estatus</a></li>
            <li><a href="cursos/root">Lista de cursos</a></li>
          </ul> 
        </li>  


<?php */ ?>

        <li class="has_sub <?php if ($this->uri->segment(1)=='configuracion' || $this->uri->segment(1)=='tipo_planes' || $this->uri->segment(1)=='categoria_cursos' || $this->uri->segment(1)=='cursos')  { ?> open <?php } ?>">
          <a href="#"><i class="fa fa-file-o"></i> Sistema <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
          <ul <?php if ($this->uri->segment(1)=='configuracion' || $this->uri->segment(1)=='tipo_planes' || $this->uri->segment(1)=='categoria_cursos' || $this->uri->segment(1)=='cursos')  { ?> style="display: block;" <?php } ?>>
            <li <?php if ($this->uri->segment(1)=='configuracion')  { ?> class="open" <?php } ?>><a href="contenidos/root">Configuracion</a></li>
            <li <?php if ($this->uri->segment(1)=='tipo_planes')  { ?> class="open" <?php } ?>><a href="tipo_planes/root">Tipo de planes</a></li>
            <li <?php if ($this->uri->segment(1)=='categoria_cursos')  { ?> class="open" <?php } ?>><a href="categoria_cursos/root">Categoria de cursos</a></li>
            <li <?php if ($this->uri->segment(1)=='cursos')  { ?> class="open" <?php } ?>><a href="cursos/root">Lista de cursos</a></li>

          </ul>
        </li> 




      </ul>
    </div>
