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
 
 
class Uploads extends CWX_Controller {
    
    public function index() {
        require APPPATH.'libraries/csfolder.php';
	$this->load->model('categories/mCategories');
	
	$_imp = uniqid( 'imp_', true );
        $_folder = new csFolder();

	$this->session->set_userdata('importUnique',$_imp);

	$_data = array(
	    'site' => 'uploads/index',
	    'title' => __('up_title_uploads'),
	    'categories' => $this->mCategories->getCategories(),
            'folders' => $_folder->getSelect( 0, 1, NULL, 'filefolder[]', 'span2', '' )
	);	
		
        $this->load->view( 'master', $_data );
    }
    
    
    public function upload() {
        $this->load->helper("upload.class");

        $upload_handler = new UploadHandler();

        header('Pragma: no-cache');
        header('Vary: accept');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $upload_handler->delete();
                } else {
                    $upload_handler->post();
                }
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }

    }
    
    public function latest() {
	$this->load->model('user/mUser');
	$_latestID = $this->input->post('fileImportID');
	
	if( !isset( $_latestID ) || empty( $_latestID ) ) { 
	    $_latestID = $this->mUploads->latestImportID()->fileImportID;
	}
	
	$_data = array(
	    'title' => __('up_title_lastupload'),
	    'site' => 'uploads/latest',
	    'files' => $this->mUploads->latestFiles( $_latestID ),
	    'imports' => $this->mUploads->getImports(),
	    'latest' => $_latestID,
	    'users' => $this->mUser->getAllStdUser()
	);
    
	$this->load->view( 'master', $_data );	
    }
}