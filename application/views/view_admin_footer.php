

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Copyright info -->
        <p class="copy">Copyright &copy; 2014 | <a href="#">Virtualab</a> </p>
      </div>x
    </div>
  </div>
</footer>   

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->



<?php /* ?>

<script type="text/javascript" src="html/admin/nivo/jquery-1.9.0.min.js"></script>
<?php */ ?>


<script src="html/admin/js/jquery.js"></script> 



<script src="html/admin/js/bootstrap.min.js"></script> <!-- Bootstrap -->
<script src="html/admin/js/jquery-ui-1.10.4.custom.min.js"></script> <!-- jQuery UI -->
<script src="html/admin/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="html/admin/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="html/admin/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
<script src="html/admin/js/jquery.slimscroll.min.js"></script> <!-- jQuery Slim Scroll -->
<script src="html/admin/js/jquery.dataTables.min.js"></script> <!-- Data tables -->
<script src="html/admin/js/bootstrap-fileupload.js"></script>

<!-- jQuery Flot -->


<?php if ($this->uri->segment(1)=='inicio'): ?>
  <script src="html/admin/js/excanvas.min.js"></script>
  <script src="html/admin/js/jquery.flot.js"></script>
  <script src="html/admin/js/jquery.flot.resize.js"></script>
  <script src="html/admin/js/jquery.flot.pie.js"></script>
  <script src="html/admin/js/jquery.flot.stack.js"></script>
<?php endif; ?>

<!-- jQuery Notification - Noty -->
<script src="html/admin/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="html/admin/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="html/admin/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="html/admin/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="html/admin/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="html/admin/js/sparklines.js"></script> <!-- Sparklines -->
<script src="html/admin/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="html/admin/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="html/admin/js/jquery.onoff.min.js"></script> <!-- Bootstrap Toggle -->
<script src="html/admin/js/filter.js"></script> <!-- Filter for support page -->
<script src="html/admin/js/custom.js"></script> <!-- Custom codes -->
<script src="html/admin/js/charts.js"></script> <!-- Charts & Graphs -->



<script type="text/javascript" src="html/admin/nivo/jquery.nivo.slider.pack.js"></script>

<script type="text/javascript">
  $(window).load(function() {
    if ($('#slider_docente').length>0  ) {
  


$('#slider_docente').nivoSlider({
    effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'
    slices: 15,                     // For slice animations
    boxCols: 8,                     // For box animations
    boxRows: 4,                     // For box animations
    animSpeed: 500,                 // Slide transition speed
    pauseTime: 9000,                // How long each slide will show
    startSlide: 0,                  // Set starting Slide (0 index)
    directionNav: true,             // Next & Prev navigation
    controlNav: false,               // 1,2,3... navigation
    controlNavThumbs: false,        // Use thumbnails for Control Nav
    pauseOnHover: true,             // Stop animation while hovering
    manualAdvance: false,           // Force manual transitions
    prevText: 'Prev',               // Prev directionNav text
    nextText: 'Next',               // Next directionNav text
    randomStart: false,             // Start on a random slide
    beforeChange: function(){},     // Triggers before a slide transition
    afterChange: function(){},      // Triggers after a slide transition
    slideshowEnd: function(){},     // Triggers after all slides have been shown
    lastSlide: function(){},        // Triggers when last slide is shown
    afterLoad: function(){}         // Triggers when slider has loaded
});


}


  });
</script>

<!-- Script for this page -->
<script type="text/javascript">
  $(function () {



 //$('th').eq(0).hide();
 //$('th').eq(1).hide();


 //$('tfoot tr th').eq(0).hide();
 //$('tfoot tr th').eq(1).hide();

    $('input[type=file]').fileupload();

    <?php if ($this->uri->segment(1)=='inicio'): ?>
    /*   GRAFICA DEL HOME   */

    var d1 = [];
    for (var i = 0; i <= 20; i += 1)
      d1.push([i, parseInt(Math.random() * 30)]);
    /* 2,3,4,5,6,7,8,9 */

    var d2 = [];
    for (var i = 0; i <= 20; i += 1)
      d2.push([i, parseInt(Math.random() * 30)]);
    /* 2,3,4,5,6,7,8,9 */

    var stack = 0, bars = true, lines = false, steps = false;


    function plotWithOptions() {
      $.plot($("#bar-chart"), [ d1, d2 ], {
        series: {
          stack: stack,
          lines: { show: lines, fill: true, steps: steps },
          bars: { show: bars, barWidth: 0.8 }
        },
        grid: {
          borderWidth: 0, hoverable: true, color: "#777"
        },
        colors: ["#ff6c24", "#ff2424"],
        bars: {
          show: true,
          lineWidth: 0,
          fill: true,
          fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
        }
      });
    }


    plotWithOptions();

    /*   GRAFICA DEL HOME   */
  <?php endif; ?>




});





</script>