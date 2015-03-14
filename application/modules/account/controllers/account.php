<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Account extends Base {

	public function __construct() {
		// call the controller construct
		parent::__construct();

		// models
		$this->load->model('login_model');

		// global vars
		$this->body_class[] = "login";

	}

	public function index(){
		$session_user = $this->session->userdata('session_user');
		if ($session_user) {
			redirect($session_user['role_default_url']);
		}else{
			redirect(login_url());
		}
	}

	public function login(){

		// if user is logged in
		if (!empty($this->user)) {
			redirect(login_url());
		}

		// form validation
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|sha1|max_length[50]');
		
		if ($this->form_validation->run() == TRUE) {
			// if validation run
			if ($query = $this->login_model->login_validation(array($this->input->post('username'), $this->input->post('password')))) {
				
				// user log history
				$login_visit = $this->login_model->user_log_visit(array($query['user_id'], $_SERVER['REMOTE_ADDR']));
				
				// session register
				$query['login_visit'] = $login_visit;
				$this->session->set_userdata('session_user', $query);
				
				redirect($query['role_default_url']);
				
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
		$session = $this->session->userdata('session_user');
		$this->login_model->user_log_leave(array($session['user_id'], $session['login_visit']));
		
		// destroy the session
		$this->session->unset_userdata('session_user');

		// set message
		$this->message->addSuccess('You are successfully logged out.');
		$this->message->render();

		redirect('account/login/');
	}

}
