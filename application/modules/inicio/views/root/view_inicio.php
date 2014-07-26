<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?=base_url()?>" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Administrador - Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('view_admin_css_js'); ?>
</head>

<body>

<?php $this->load->view('view_root_header'); ?> 

<!-- Main content starts -->

<div class="content">

   
   <?php $this->load->view('view_root_menu'); ?>


<!-- Main bar -->
<div class="mainbar">

    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-home"></i> Administrador principal </h2>

      <!-- Breadcrumb -->
      <div class="bread-crumb pull-right">
          <a href="inicio/admin"><i class="fa fa-home"></i> Inicio</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="inicio/admin" class="bread-current">Administrador principal</a>
      </div>

      <div class="clearfix"></div>

  </div>
  <!-- Page heading ends -->



  <!-- Matter -->

  <div class="matter">
    <div class="container">

      <!-- Today status. jQuery Sparkline plugin used. -->



      <!-- Today status ends -->



      <!-- Chats, File upload and Recent Comments -->
      <div class="row">



        <div class="col-md-4">
            <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Ultimos Cursos creados</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
            </div>
            <div class="widget-content referrer">
              <!-- Widget content -->

              <table class="table table-striped table-bordered table-hover">
                <tr>
                  <th><center>#</center></th>
                  <th>Cursos</th>
                  <th>Inscritos</th>
              </tr>
              <tr>
                  <td><img src="html/admin/img/icons/chrome.png" alt="" /></td>
                      <td>Programacion web</td>
                      <td>10</td>
                  </tr> 
                  <tr>
                      <td><img src="html/admin/img/icons/firefox.png" alt="" /></td>
                          <td>Python desde cero</td>
                          <td>11</td>
                      </tr> 
                      <tr>
                          <td><img src="html/admin/img/icons/ie.png" alt="" /></td>
                              <td>Html5 con responsive</td>
                              <td>12</td>
                          </tr> 
                          <tr>
                              <td><img src="html/admin/img/icons/opera.png" alt="" /></td>
                                  <td>Css3 Avanzado nivel 3</td>
                                  <td>13</td>
                              </tr> 
                              <tr>
                                  <td><img src="html/admin/img/icons/safari.png" alt="" /></td>
                                      <td>PHP orientado a objetos</td>
                                      <td>14</td>
                                  </tr>                                                                    
                              </table>

                              <div class="widget-foot">
                              </div>
                          </div>
                      </div>
                  </div>





                  <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                          <div class="pull-left">Ultimos estudiantes registrados</div>
                          <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>  
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content referrer">
                      <!-- Widget content -->

                      <table class="table table-striped table-bordered table-hover ultimos-registrados">
                        <tr>
                          <th><center>#</center></th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Correo</th>

                      </tr>
                      <tr>
                          <td><i class="fa fa-user"></i></td>
                          <td>Edwin</td>
                          <td>Garzon</td>
                          <td>edwin.garzon@vitualab.co</td>
                      </tr> 
                      <tr>
                         <td><i class="fa fa-user"></i></td>
                          <td>Edwin</td>
                          <td>Garzon</td>
                          <td>edwin.garzon@vitualab.co</td>
                      </tr> 
                      <tr>
                        <td><i class="fa fa-user"></i></td>
                         <td>Edwin</td>
                         <td>Garzon</td>
                         <td>edwin.garzon@vitualab.co</td>
                     </tr> 
                     <tr>
                       <td><i class="fa fa-user"></i></td>
                       <td>Edwin</td>
                       <td>Garzon</td>
                       <td>edwin.garzon@vitualab.co</td>
                   </tr> 
                   <tr>
                     <td><i class="fa fa-user"></i></td>
                     <td>Edwin</td>
                     <td>Garzon</td>
                     <td>edwin.garzon@vitualab.co</td>
                 </tr>                                                                    
             </table>

             <div class="widget-foot">
             </div>
         </div>
     </div>
 </div>









 <div class="col-md-4">
    <div class="widget">
        <!-- Widget title -->
        <div class="widget-head">
          <div class="pull-left">Ultimos noticias creadas</div>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
        </div>  
        <div class="clearfix"></div>
    </div>
    <div class="widget-content referrer">
      <!-- Widget content -->

      <table class="table table-striped table-bordered table-hover">
        <tr>
          <th><center>#</center></th>
          <th>Titulo</th>
          <th>Descripcion</th>
          <th>Estado</th>

      </tr>
      <tr>
          <td><img src="html/admin/img/icons/chrome.png" alt="" /></td>
              <td>Lanzamiento oficial app web</td>
              <td>Aplicacion web sistema automatico excelente</td>
              <td>Activa</td>
          </tr> 
          <tr>
              <td><img src="html/admin/img/icons/firefox.png" alt="" /></td>
                <td>Lanzamiento oficial app web</td>
                <td>Aplicacion web sistema automatico excelente</td>
                <td>Activa</td>
            </tr> 
            <tr>
              <td><img src="html/admin/img/icons/ie.png" alt="" /></td>
                  <td>Lanzamiento oficial app web</td>
                  <td>Aplicacion web sistema automatico excelente</td>
                  <td>Activa</td>
              </tr> 
             
                                                                              
           </table>

           <div class="widget-foot">
           </div>
       </div>
   </div>
</div>








</div>



</div>


<div class="row">
    <div class="col-md-6">
      <div class="widget">
        <div class="widget-head">
        <div class="pull-left">Promedio de visitas diarias</div>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
        </div>  
        <div class="clearfix"></div>
    </div>
    <div class="widget-content">
      <div class="padd">

         <div id="bar-chart"></div>

     </div>
     <div class="widget-foot">
        <!-- Footer goes here -->
    </div>
</div>
</div> 
</div>
<div class="col-md-6">
  <div class="widget">
    <div class="widget-head">
      <div class="pull-left">Mensaje rapido a usuario</div>
      <div class="widget-icons pull-right">
        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
        <a href="#" class="wclose"><i class="fa fa-times"></i></a>
    </div>  
    <div class="clearfix"></div>
</div>
<div class="widget-content">
  <div class="padd">

      <div class="form quick-post">
      
          <form class="form-horizontal">
              

               <div class="form-group">
        <label class="control-label col-lg-2">Usuario</label>
        <div class="col-lg-5">                               
            <select class="form-control">
              <option value="">- Seleccone usuario -</option>
              <option value="1">Edwin Garzon</option>
              <option value="2">Camilo Lovera</option>
             
          </select>  
      </div>
  </div>      


              <div class="form-group">
                <label class="control-label col-lg-2" for="title">Asunto</label>
                <div class="col-lg-8"> 
                  <input type="text" class="form-control" id="title">
              </div>
          </div>   
         
          <div class="form-group">
            <label class="control-label col-lg-2" for="content">Content</label>
            <div class="col-lg-8">
              <textarea class="form-control" rows="5" id="content"></textarea>
          </div>
      </div>                           
     
             
  

<!-- Buttons -->
<div class="form-group">
   <!-- Buttons -->
   <div class="col-lg-offset-2 col-lg-6">
    <button type="submit" class="btn btn-sm btn-success">Enviar</button>
    <button type="reset" class="btn btn-sm btn-default">Reset</button>
</div>
</div>
</form>
</div>


</div>
<div class="widget-foot">
    <!-- Footer goes here -->
</div>
</div>
</div> 
</div>            
</div>  


</div>
</div>

<!-- Matter ends -->

</div>

<!-- Mainbar ends -->
<div class="clearfix"></div>

</div>
<!-- Content ends -->

<?php $this->load->view('view_admin_footer'); ?>

</body>

</html>