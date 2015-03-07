<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Admin extends Base {

    function __construct() {
        parent::__construct();

        // module class
        $this->body_class[] = "admin";
    }

    public function index() {

        // Prepare the page
        $this->page_title   = "Dashboard";
        $this->page_content = "dashboard";
        $this->render_layout();

    }

}