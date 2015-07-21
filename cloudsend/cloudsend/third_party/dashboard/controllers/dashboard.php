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

class Dashboard extends CWX_Controller {
	
    public function index() {
	$this->load->model('user/mUser');
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
	        
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('dash_title_dashboard'),
	    'site' => 'dashboard/index',
            
	    'diskfree' => disk_free_space( FCPATH ),
	    'disktotal' => disk_total_space( FCPATH ),
            
	    'files' => $this->mDashboard->latestFiles(),
            
            'regUserBar' => $this->mDashboard->regUsers( true ),
            'regUser' => $this->mDashboard->regUsers(),
            
            'totalFilesBar' => $this->mDashboard->regTotalFiles( true ),
            'totalFiles' => $this->mDashboard->regTotalFiles(),
            
            'totalFileSizeBar' => $this->mDashboard->regTotalFileSize( true ),
            'totalFileSize' => $this->mDashboard->regTotalFileSize(),
            
            'downFileSizeBar' => $this->mDashboard->downTotalFileSize( true ),
            'downFileSize' => $this->mDashboard->downTotalFileSize()
	);
    
	$this->load->view( 'master', $_data );
    
    }
    
    public function access() {
	$_data = array(
	    'title' => __('dash_title_restricted'),
	    'site' => 'dashboard/access'
	);
    
	$this->load->view( 'master', $_data );	
    }
    
}