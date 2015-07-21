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
<div class="container" id="errornotfound">
    <div class="row" id="notfound">
	<div class="span12">
	    <div class="hero-unit">
		<h1><?php echo __('front_head_error') ?></h1>
		<p><?php echo __('front_desc_error') ?></p>
	    </div>
	</div>	
    </div>    
</div>
<script type="text/javascript">
$(document).ready(function() {    
    <?php if( file_exists( FCPATH.'data'.DS.'backgrounds'.DS.'default_1.4.jpg' ) ) : ?>
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/default_1.4.jpg' ) ?>' } ]
    });
    <?php endif; ?>    
});  
</script>