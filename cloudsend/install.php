<?php
/**
 * codingking.co
 *
 * @package    codingking.co installer
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 */

error_reporting(0);
session_start();

define('INSTALLER',true);
define('BASEPATH',true);

if( file_exists( 'cloudsend/config/config.php' ) OR file_exists( 'cloudsend/config/database.php' ) ) {
    die( 'CloudSend: Installer not necessary.' );
}

require 'cloudsend/helpers/project_helper.php';

if( !isset( $_GET['step'] ) ) {
    $_step = 'welcome';
} else {
    $_step = $_GET['step'];
}
$_head = true;
if( isset( $_GET['nohead'] ) ) $_head = false;
if( $_head ):
?>
<?php require 'install/includes/header.php'; ?>
   <div id="install">
        <div class="inner" id="steps">
		<img src="http://www.codingking.co/wp-content/uploads/2013/03/logo.png" />
                <h2 class="title fr">CloudSend Installer</h2>
<?php endif; ?>		
		<?php require 'install/includes/'.$_step.'.php'; ?>	
<?php if( $_head ): ?>
        </div>
	<p>&nbsp;</p>
	<div id="navigation" class="inner"><?php echo $_links ?></div>
    </div>
<?php require 'install/includes/footer.php'; ?>
<?php endif; ?>