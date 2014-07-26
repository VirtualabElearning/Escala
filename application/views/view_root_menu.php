    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="inicio/root">Navegacion</a></div>

       
        <ul id="nav">
        
          <li <?php if ($this->uri->segment(1)=='inicio')  { ?> class="open" <?php } ?> ><a href="inicio/root"><i class="fa fa-home"></i> Principal</a>
      </li>




  <li class="has_sub <?php if ($this->uri->segment(1)=='contenidos' || $this->uri->segment(1)=='noticias')  { ?> open <?php } ?>">
    <a href="#"><i class="fa fa-file-o"></i> Contendos web <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
    <ul <?php if ($this->uri->segment(1)=='contenidos' || $this->uri->segment(1)=='noticias')  { ?> style="display: block;" <?php } ?>>
      <li <?php if ($this->uri->segment(1)=='contenidos')  { ?> class="open" <?php } ?>><a href="contenidos/root">Contenidos</a></li>
      <li <?php if ($this->uri->segment(1)=='noticias')  { ?> class="open" <?php } ?>><a href="noticias/root">Noticias</a></li>
  </ul>
</li> 
    
<li class="has_sub <?php if ($this->uri->segment(1)=='usuarios' || $this->uri->segment(1)=='roles')  { ?> open <?php } ?>"><a href="#"><i class="fa fa-users"></i> Usuarios <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
    <ul>
      <li <?php if ($this->uri->segment(1)=='usuarios')  { ?> class="open" <?php } ?>><a href="usuarios/root">Lista de usuarios</a></li>
      <li <?php if ($this->uri->segment(1)=='roles')  { ?> class="open" <?php } ?>><a href="roles/root">Roles de Usuario</a></li>
  </ul> 
</li>       



<li class="has_sub <?php if ($this->uri->segment(1)=='cursos' || $this->uri->segment(1)=='status' || $this->uri->segment(1)=='logros' || $this->uri->segment(1)=='docentes' || $this->uri->segment(1)=='estudiantes' || $this->uri->segment(1)=='notas')  { ?> open <?php } ?>"><a href="#"><i class="fa fa-book"></i> Cursos <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
    <ul>
      <li <?php if ($this->uri->segment(1)=='logros')  { ?> class="open" <?php } ?>><a href="logros/root">Lista de logros</a></li>
      <li <?php if ($this->uri->segment(1)=='status')  { ?> class="open" <?php } ?>><a href="status/root">Lista de status</a></li>
      <li><a href="cursos/root">Lista de cursos</a></li>
      <li><a href="docentes/root">Lista de docentes</a></li>
      <li><a href="estudiantes/root">Lista de estudiantes</a></li>
  </ul> 
</li>  



</ul>
</div>
