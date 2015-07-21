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
<div class="container" id="dashboard">
    <div class="row" id="dashboardOverview">
	<div class="span12">
	    <div class="hero-unit">
		<h1><?php echo __('dash_head_forbidden') ?></h1>
		<p><?php echo __('dash_desc_forbidden') ?></p>
		<p>
		    <a class="btn" href="<?php echo site_url( 'admin/dashboard/index' ) ?>"><?php echo __('dash_link_overview') ?></a>
		</p>
	    </div>
	</div>	
    </div>    
</div>
