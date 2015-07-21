</div>
      <footer id="footer">
        <div class="container-fluid">2014 © <i>ISLAND PEEPS</i> by <a href="http://studspro.com/" target="_blank">studspro.com</a></div>
      </footer>
    </div>
  </body>
</html>  
    <!-- jQuery slimScroll-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
    <script>
      window.jQuery.ui || document.write('<script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"><\/script>')
    </script>
    <!-- BEGIN THEME SWITCHER SCRIPTS-->
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <!-- END THEME SWITCHER SCRIPTS-->
    <script src="<?=ADMIN_THEEM_JS?>sidebar.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>panels.js"></script>
    <!-- BEGIN GENERAL SCRIPTS-->
    <script>
      /*<![CDATA[*/
      $(function() {
        $(".social-sidebar").socialSidebar();
        $('.main').panels();
        $(".main a[href='#ignore']").click(function(e) {
          e.stopPropagation()
        });
      });
      $(document).on('click', '.navbar-super .navbar-super-fw', function(e) {
        e.stopPropagation()
      });
      /*]]>*/
    </script>
    <!-- END GENERAL SCRIPTS-->
    <!-- BEGIN CURRENT PAGE SCRIPTS-->
    <script src="<?=ADMIN_THEEM_JS?>plugins/flot/jquery.flot.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/flot/jquery.flot.selection.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jqvmap/jquery.vmap.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jqvmap/data/jquery.vmap.sampledata.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/justgage/lib/raphael.2.1.0.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/justgage/justgage.js"></script>
    <script src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/gmaps/gmaps.js"></script>
    <!-- END CURRENT PAGE SCRIPTS-->
 <script>
    var viewheight = $(window).height() - 40;
    $(function(){
        $(".Sidebarheight").slimScroll({
              height: viewheight,
        });
    });
  
   /*$(window).resize(function(){
    var viewheight1 = $(window).height() - 40;
    $(function(){
        $(".Sidebarheight").slimScroll({
              height: viewheight1,
            });
        })
    }); */
    
 </script>