</div>
 
 <link href="<?=ADMIN_THEEM_CSS;?>font-awesome/font-awesome-icon.css" rel="stylesheet">      
      <footer id="footer">
        <div class="container-fluid"><?php echo date("Y");?> &copy; <i>ISLAND PEEPS</i> by <a href="http://studspro.com/" target="_blank">studspro.com</a></div>
      </footer>
    </div>
  <div id="uipro_right" class="uipro">
      <ul class="rightPanel">
        <li>
          <a href="<?=SITE_ADMIN_URL;?>profile/myprofile">
            <i class="icon-user"></i><span>My Profile</span>
          </a>
        </li>
        <li>
          <a href="<?=SITE_ADMIN_URL;?>imailboxs">
            <i class="icon-envelope"></i><span>Messages</span>
	  </a>
        </li>
        <li>
          <a href="<?=SITE_ADMIN_URL;?>dashboard/task">
	    <i class="icon-tasks"></i><span>Taks</span>
	  </a>
	</li>
      </ul>
      </div>
    
  </body>
  
</html>  
<script src="<?=ADMIN_THEEM_JS?>plugins/uipro.min.js"></script>
    <!-- jQuery slimScroll-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
    <script>
      window.jQuery.ui || document.write('<script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"><\/script>')
    </script>
    <!-- BEGIN THEME SWITCHER SCRIPTS-->
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <!-- END THEME SWITCHER SCRIPTS-->
     <script src="<?=ADMIN_THEEM_JS?>app.js"></script>
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
    
     <script src="<?=ADMIN_THEEM_JS;?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS;?>demo/dataTables.bootstrap.js"></script>
    <script src="<?=ADMIN_THEEM_JS;?>demo/tables.js"></script>
    <!--<script src="<?=ADMIN_THEEM_JS;?>demo/tables.js"></script> -->
    <script src="<?=ADMIN_THEEM_JS;?>dashboard.js"></script>
    <!-- END GENERAL SCRIPTS-->
    <!-- BEGIN CURRENT PAGE SCRIPTS-->
  <!---  <script src="<?=ADMIN_THEEM_JS?>plugins/flot/jquery.flot.js"></script>
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
    <script src="<?=ADMIN_THEEM_JS?>plugins/gmaps/gmaps.js"></script>  -->
    <!-- END CURRENT PAGE SCRIPTS c92LCZKa -->
   
 
 <script>
    var viewheight = $(window).height() - 100;
    //var viewheight = '605';
    $(function(){
          App.init();
        $(".Sidebarheight").slimScroll({
              height: viewheight,
        });
    });
   
  
 $(window).resize(function(){
    var viewheight1 = $(window).height() - 100;
    $(function(){
        $(".Sidebarheight").slimScroll({
              height: viewheight1,
            });
        })
    }); 
    
 </script>