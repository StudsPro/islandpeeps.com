<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * CloudSend
 *
 * @package    CloudSend
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 * 
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */
?>
<?php if( !empty( mGlobal::getConfig('GOOGLE_ANALYTICS')->configVal ) ): ?>
<script type=”text/javascript”>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo mGlobal::getConfig('GOOGLE_ANALYTICS')->configVal ?>']);
  _gaq.push(['_gat._anonymizeIp']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php endif; ?>
<!-- Page rendered in {elapsed_time} seconds -->
</body>
</html>