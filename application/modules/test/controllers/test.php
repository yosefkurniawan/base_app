<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Test extends Base {

	public function __construct() {
		// call the controller construct
		parent::__construct();

		// module class
		$this->body_class[] = "test-class";

		// module crumb
		$this->breadcrumb->add('Test', '/test'); // this will be a link
	}

	public function index(){

		// Start: Vars that must be stored in every single page

		/*
		 * Page Title, desc:
		 * - Page title be loaded on browser tab and <h1>
		 */
		$this->page_title 	= "Test Page Title";

		/*
		 * Breadcrumbs, desc:
		 * - set the breadcrumbs. Home is automatically added, you just need to add the module and the function
		 */
		$this->breadcrumb->add('Index'); // this won't be linked and will just be text

		/*
		 * The main content, desc:
		 * - Call the view for displaying as main content
		 */
		$this->page_content = "test/v_test";

		/*
		 * Body Classes, desc:
		 * - Give <body> class for identifying which modules is this.
		 * - can be more than one class.
		 * - can be a string or array
		 * - In this sample, body classes are given 2 times. 
		 		1. In __construct 	--> for identifying the loaded module
		 		2. In function 		--> for identifying the loaded function
		 */
		$this->body_class[] = "test-class-2";

		/*
		 * Finnally, render the page. desc:
		 * - You can put a template path param. If param is not set, it will render default layout.
		 */
		$this->render_layout();

		// End: Vars that must be stored in every single page

	}

}
