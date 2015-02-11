<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
	protected $portal_id;
	protected $data;
	protected $breadcrumbs;
	protected $page_title;
	protected $page_content;
	protected $body_class;
	protected $user;
	protected $messages;
	protected $js;
	protected $css;

	public function __construct() {

		// call the controller construct
		parent::__construct();
		
		// load model
		$this->load->model('base/m_base');

		// reset the breadcrumbs
		$this->breadcrumbs_init();

		// get user session
		$this->get_user_login();

		// menu		
		$this->menu();

		// global msg
		$this->global_msg_init();

	}

	public function breadcrumbs_init() {
		/*
		 * Descripsion:
		 * Full reference for breadcrumbs is at /libaries/Breadcrumbs.php
		 */

		$this->breadcrumb->clear();
		$this->breadcrumb->add('Dashboard','account/ashboard/');
		$this->breadcrumb->change_link(' / ');
	}

	public function render_layout($layout_path = '') {

		// prepare all vars
		$this->data['body_class'] 	= ($this->body_class)? $this->body_class : '';
		$this->data['breadcrumbs'] 	= $this->breadcrumbs;
		$this->data['page_title'] 	= $this->page_title;
		$this->data['page_content'] = $this->page_content;
		$this->data['user'] 		= $this->user;
		$this->data['messages'] 	= $this->messages;
		$this->data['js'] 			= $this->js;
		$this->data['css'] 			= $this->css;

		if ($layout_path == '') {
			$this->load->view('base/page/layout', $this->data);
		}else{
			$this->load->view($layout_path, $this->data);
		}
	}

	public function menu() {

		$menu = array();

		$level_0 	= $this->m_base->get_parent_menu(array($this->portal_id, $this->user['role_id']));

		if ($level_0) {
			$menu 	= $level_0;
			
			// get menu level 1
			foreach ($level_0 as $key_level_0 => $level_0_value) {
				$menu[$key_level_0]['child_level_1'] = array();

				if ($level_1 = $this->m_base->get_child_menu(array($level_0_value['menu_id'], $this->user['role_id']))) {
					$menu[$key_level_0]['child_level_1'] = $level_1;

					// get menu level 2
					foreach ($level_1 as $key_level_1 => $level_1_value) {
						$menu[$key_level_0]['child_level_1'][$key_level_1]['child_level_2'] = array();
						
						if ($level_2 = $this->m_base->get_child_menu(array($level_1_value['menu_id'], $this->user['role_id']))) {
							$menu[$key_level_0]['child_level_1'][$key_level_1]['child_level_2'] = $level_2;
						}
					};
				}
			}
		}

		$this->data['menu'] = $menu;
	}

	// get user login
	protected function get_user_login() {
		
		// get user login
		$session = $this->session->userdata('session_user');
		
		if ($session) {
			$this->user 		= $session;
			$this->portal_id 	= $session['portal_id'];
		} else {
			if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/account/login' && $_SERVER['PATH_INFO'] != '/account/login/') {
				$this->message->addError('Sorry, you\'re not logged in.');
				$this->message->render();
				redirect('account/login/');
			}
		}
	}

	protected function check_auth($auth) {
		
		$params = $_SERVER['PATH_INFO'];
		if (substr($params, 0, 1) != '/') {
			$params = '/'.$params;
		}
		if (substr($params, strlen($params)-1, strlen($params)) != '/') {
			$params = $params.'/';
		}

		// get display page id
		if ($result = $this->m_base->get_display_page_id($params)) {
			// get user auth
			$params = array($this->user['role_id'], $result['menu_id']);
			$role = $this->m_base->get_user_auth($params);
			$this->role = array('C' => substr($role['permission'], 0, 1), 'R' => substr($role['permission'], 1, 1), 'U' => substr($role['permission'], 2, 1), 'D' => substr($role['permission'], 3, 1));
			if ($this->role[$auth] != '1' || empty($auth)) {
				redirect('base/error/error_403');
			}
		}
	}

	protected function global_msg_init() {
		$this->messages = $this->session->flashdata('messages');
	}

}
