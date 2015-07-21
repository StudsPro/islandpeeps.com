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

    <ul class="nav nav-tabs">
	<?php for( $i = 0; $i < count( $parts ); $i++ ): ?>
	<li<?php if( isset( $section ) && $section == $parts[$i] ) echo ' class="active"'; ?>><a href="<?php echo site_url( 'admin/settings?part='.$parts[$i] ) ?>"><?php echo __('set_nav_'.$parts[$i]) ?></a></li>
	<?php endfor; ?>
    </ul>
