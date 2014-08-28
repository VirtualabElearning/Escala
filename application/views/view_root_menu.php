   <?php #krumo ($diccionario); ?>
    <div class="sidebar">
      <div class="sidebar-dropdown"><a href="inicio/root">Navegacion</a></div>
      <ul id="nav">
        <li <?php if ($this->uri->segment(1)=='inicio')  { ?> class="open" <?php } ?> ><a href="inicio/root"><i class="fa fa-home"></i> Principal</a>
        </li>
        <?php foreach ($menus as $menus_key => $menus_value): ?>
         <?php $armenu=array(); ?>
         <?php if ($menus_value->submenus): ?>
           <?php foreach ($menus_value->submenus as $submenus_key => $submenus_value): ?>
            <?php if (in_array($this->session->userdata('id_roles'), json_decode($submenus_value->id_roles))) : ?>
             <?php $armenu[]=$submenus_value->carpeta; ?>
           <?php endif ?>
         <?php endforeach; ?>
         <?php if (count($armenu)>0): ?>
           <li class="has_sub <?php if (in_array($this->uri->segment(1), $armenu)) { ?> open <?php } ?>">
            <a href="#"><i class="fa fa-file-o"></i> <?php echo $menus_value->nombre; ?> <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul <?php if (in_array($this->uri->segment(1), $armenu)) { ?> style="display: block;" <?php } ?>>
             <?php foreach ($menus_value->submenus as $submenus_key => $submenus_value): ?>
              <?php if (in_array($this->session->userdata('id_roles'), json_decode($submenus_value->id_roles)) && $submenus_value->mostrar==1): ?>
               <li <?php if ($this->uri->segment(1)==$submenus_value->carpeta)  { ?> class="open" <?php } ?>><a href="<?php echo $submenus_value->carpeta; ?>/root"><?php echo asignar_frase_diccionario ($diccionario,$submenus_value->llave,$submenus_value->nombre,2); ?></a></li>
             <?php endif ?>
           <?php endforeach ?>
         </ul>
       </li> 
     <?php endif ?>
   <?php endif ?>
 <?php endforeach ?>
</ul>
</div>