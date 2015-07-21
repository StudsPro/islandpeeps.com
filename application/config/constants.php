<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/// Google Login keys //////

define('APPS_REDIRECT_URI',		'http://server.freshreportsend.in/index.php/verifyuser');
define('APPS_CLIENT_ID',			'1095692654818-bpesmvb8h0mbjlgbvnekkqpvnnlfj0bm.apps.googleusercontent.com');
define('APPS_CLIENT_SECRET',			'zEXNKOQWgzZ_kOHG4-_7fpZE');

define('ITEM_PER_PAGE',			'10');


define('Hashed_Password' , 'KaiNilFuzon');

define('Notification_EmailFrom' , 'notifications@limousinerentalsingapore.com');

define('Notification_EmailFromName' , 'Limousinecars');

define('Mandrill_API_Key' , 'wgd6JZfjJOgoswwwcma5NA');

define('Mandrill_Message_URL' , 'https://mandrillapp.com/api/1.0/messages/send.json');
//define('UPLOAD_ROOT_PATH','D:/XAMPP/htdocs/limocar/library/upload/'); //offline

define('UPLOAD_ROOT_PATH','/var/www/html/island/library/upload/'); //offline
 
//define('UPLOAD_ROOT_PATH','/home/dollersc/public_html/hellogood/library/upload/'); //online
/* End of file constants.php */
/* Location: ./application/config/constants.php */



define('ROOT_FOLDER', '/new_admin_panel/');
define('ADMIN_FOLDER', 'admin');
define("BASE_URL", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER);
define("SITE_ABSPATH", $_SERVER['DOCUMENT_ROOT'].ROOT_FOLDER);	
define("SITE_UPLOADPATH", $_SERVER['DOCUMENT_ROOT'].ROOT_FOLDER.'library/upload/');	
//define("SITE_UPLOADPATH", '/home/studs/public_html/newbrandadmin/upload/');	

define("SITE_MEDIA", ROOT_FOLDER.'library/upload/');//ROOT_FOLDER.'upload/'	
define("SITE_GETUPLOADPATH", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'library/upload/');
//define("SITE_GETUPLOADPATH", 'http://islandpeeps.com/newbrandadmin/upload/');

//Website Path Settings
define("SITE_ADMIN_URL", BASE_URL .ADMIN_FOLDER.'/');
define("SITE_NAME", "Island Peeps");
define("SITE_IMAGEURL", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'images/');
define("SITE_CSSURL", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'css/');
define("SITE_JSURL", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'library/js/');
//define("SITE_EDITORPATH", 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'editor/');


//Admin Theen
define("SITE_ADMIN_THEEM_URL", BASE_URL.'admin_theem/');
define('ADMIN_THEEM_CSS', SITE_ADMIN_THEEM_URL.'css/');
define('ADMIN_THEEM_IMG', SITE_ADMIN_THEEM_URL.'img/');
define('ADMIN_THEEM_JS', SITE_ADMIN_THEEM_URL.'js/');

define("META_TITLE", "Island Peeps");
define("META_KEYWORDS", "Island Peeps");
define("META_DESCRIPTION", "Island Peeps");

// set country image size 
define("REGION_MAP", '1000');
define("REGION_FLAG", '1000');

define("REGION_IMAGE", '1000');
define("REGION_COVERIMAGE", '1000');