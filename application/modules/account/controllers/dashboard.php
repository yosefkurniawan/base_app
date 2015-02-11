<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Dashboard extends Base {

	public function __construct() {
		// call the controller construct
		parent::__construct();

		// module class
		$this->body_class[] = "Dashboard";

	}

	public function index(){

		// Prepare the page
		$this->page_title 	= "Dashboard";
		$this->page_content = "dashboard";
		$this->render_layout();

	}

}
