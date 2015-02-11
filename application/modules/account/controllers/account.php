<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Account extends Base {

	public function __construct() {
		// call the controller construct
		parent::__construct();

		// models
		$this->load->model('m_login');

		// global vars
		$this->body_class[] = "login";

	}

	public function index(){
		redirect('account/dashboard/');
	}

	public function login(){

		// if user is logged in
		if (!empty($this->user)) {
			redirect('account/dashboard/');
		}

		// form validation
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|sha1|max_length[50]');
		
		if ($this->form_validation->run() == TRUE) {
			// if validation run
			if ($query = $this->m_login->login_validation(array($this->input->post('username'), $this->input->post('password')))) {
				
				// user log history
				$this->m_login->user_log_visit(array($query['user_id'], $_SERVER['REMOTE_ADDR']));
				
				// session register
				$this->session->set_userdata('session_user', $query);
				
				redirect('account/dashboard/');
				
			} else {
				$this->message->addError('Sorry, we can\'t find your account.');
				$this->message->render();
				redirect('account/login/');
			}
		}

		$this->data['form_action'] = base_url().'account/login/';

		// Prepare the page
		$this->page_title 	= "Login";
		$this->render_layout('login');

	}

	public function logout() {
		// log history
		$session = $this->session->userdata('session_admin');
		$this->m_login->user_log_leave($session['user_id']);
		
		// destroy the session
		$this->session->unset_userdata('session_user');

		// set message
		$this->message->addSuccess('You are successfully logged out.');
		$this->message->render();

		redirect('account/login/');
	}

}
