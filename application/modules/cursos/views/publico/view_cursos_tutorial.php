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
  <link rel="stylesheet" href="css/normalize.min.css">

  <?php $this->load->view('view_site_css_js'); ?>

</head>
<body> 
  <?php $this->load->view('view_site_header'); ?>


  <section id="tutorial">
    <div class="tutorial_wrap">
      <div class="tutorial_inter">
        <div class="tutorial_inter_wrap">
          <h2 id="slide_title">Te damos la bienvenida a tu primer curso</h2>
          <p id="slide_txt">Este es el lugar donde disfrutarás de tu experiencia de aprendizaje Online</p>
          <div class="tutorial_btns clear">
            <div class="tut_balls">
              <div class="tut_ball one">                                    
              </div>
              <div class="tut_ball two">                                    
              </div>
              <div class="tut_ball three">                                    
              </div>
              <div class="tut_ball four">                                    
              </div>
              <div class="tut_ball five">                                    
              </div>
            </div>
            <div class="tut_btn" id="uno">
             Entendido
           </div>
           <div class="tut_btn tb_off" id="dos">
             Entendido
           </div>
           <div class="tut_btn tb_off" id="tres">
             Entendido
           </div>
           <div class="tut_btn tb_off" id="cuatro">
             Entendido
           </div>
           <a href="cursos/empezar/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>"><div class="tut_btn tb_off" id="cinco">Empezar</div></a>
         </div>
       </div>
     </div>
     <div class="tut_slider">
      <div class="tut_slider_wrap">
        <div id="slide1"></div>
        <div id="slide2"></div>
        <div id="slide3"></div>
        <div id="slide4"></div>
        <div id="slide5"></div>
      </div>
    </div>
  </div>            
</section>


<?php $this->load->view('view_site_footer'); ?>

<script>
  $(document).ready(function() {

    $('#dos').click(function(event) {
      event.preventDefault();

      jQuery.ajax({
        url:"<?php echo base_url(); ?>cursos/update-tutorial",
        type: "post",
        ajaxSend:function(result){              
          console.log ("ajaxSend\n");
        },
        success:function(result){               
          console.log ("success\n");
        },
        complete:function(result){              
          console.log ("complete\n");
        },
        beforeSend:function(result){                
          console.log ("beforeSend\n");
        },
        ajaxStop:function(result){              
          console.log ("ajaxStop\n");
        }

      });

    });

  });

</script>

</body>
</html>
