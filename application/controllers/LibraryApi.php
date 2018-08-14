<?php
//use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @category   FrontPortal
* @package    Portal
* @author     Abu Nawim <nawim@atilimited.net>
* @copyright  2015 ATI Limited Development Group
*/
require(APPPATH.'/libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;
//require('/../libraries/REST_Controller.php');
//require('/REST_Controller.php');

class LibraryApi extends REST_Controller
{
	

	  /*
	  * @methodName allItemInfo
	  * @access
	  * @param  none
	  * @author Abu Nawim <nawim@atilimited.net>
	  * @return 
	  */


	  public function allItemInfo(){
	  	header('Content-Type: application/json');
		$allItemData=$this->db->query("select * from lib_item")->result();
		// $this->response($this->db->get('books')->result());
		$this->response($allItemData);

		//return 
		//set_output($allItemData); 
		//var_dump(json_encode($allItemData));
		//var_dump($allItemData);
	}


}