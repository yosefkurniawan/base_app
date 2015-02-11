<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function __construct() {
		// call the controller construct
		parent::__construct();
	}

	public function error_404() {
		$this->load->view('base/error/404');
	}

	public function error_403() {
		$this->load->view('base/error/403');
	}

	public function error_500() {
		$this->load->view('base/error/500');
	}
}
