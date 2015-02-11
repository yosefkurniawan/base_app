<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Portal extends Base {
	public function __construct() {
		// call the controller construct
		parent::__construct();
		// load model
		$this->load->model('base/setting/m_portal');
		// load portal
		$this->load->helper('text');
		// page title
		$this->page_title();

		// active page
		$active['parent_active'] = "portal";
		$active['child_active'] = "portal";
		$this->session->set_userdata($active);	
	}

	public function index()
	{
		// user_auth
		$this->check_auth('R');

		// message
		$data['message'] = $this->session->flashdata('message');
		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get portal list
		$data['rs_portal'] = $this->m_portal->get_all_portal();

		// load template
		$data['layout'] = "setting/portal/list";
		$data['javascript'] = "setting/portal/javascript/list";
		$this->load->view('base/backend/template', $data);
	}

	// add
	public function add() {
		// user_auth
		$this->check_auth('C');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// load template

		$data['title'] = "Add Portal PinapleSAS";
		$data['layout'] = "setting/portal/add";
		$this->load->view('base/backend/template', $data);
	}

	// add process
	public function add_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_name', 'Name', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('portal_title', 'Title', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('portal_desc', 'Description', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('portal_name'), str_replace($this->char, "_", strtolower($this->input->post('portal_name'))), $this->input->post('portal_title'), $this->input->post('portal_desc'), $this->input->post('user_id'));
			if ($this->m_portal->add_portal($params)) {
				$data['message'] = "Data successfully added";
				$this->session->set_flashdata('message',"Data successfully added");
				redirect('setting/portal');
			}
		} else {
			$data = array(
				'message'		=> str_replace("\n", "", validation_errors()),
				'portal_name'	=> $this->input->post('portal_name'),
				'portal_title'	=> $this->input->post('portal_title'),
				'portal_desc'	=> $this->input->post('portal_desc')
			);
				$this->session->set_flashdata($data);
				redirect('setting/portal/add');
		}
	}

	// edit
	public function edit($portal_slug = "") {
		// user_auth
		$this->check_auth('U');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get portal list
		$data['result'] = $this->m_portal->get_portal_by_slug($portal_slug);
		// load template
		$data['title'] = "Edit Portal PinapleSAS";
		$data['layout'] = "setting/portal/edit";
		$this->load->view('base/backend/template', $data);
	}

	// edit process
	public function edit_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_slug', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_name', 'Name', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('portal_title', 'Title', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('portal_desc', 'Description', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('portal_name'), str_replace($this->char, "_", strtolower($this->input->post('portal_name'))), $this->input->post('portal_title'), $this->input->post('portal_desc'), $this->input->post('portal_id'));
			if ($this->m_portal->edit_portal($params)) {
				$data['message'] = "Data successfully edited";
			}
			$this->session->set_flashdata($data);
			redirect('setting/portal');
		} else {
			$data = array(
				'message'		=> str_replace("\n", "", validation_errors()),
				'portal_name'	=> $this->input->post('portal_name'),
				'portal_title'	=> $this->input->post('portal_title'),
				'portal_desc'	=> $this->input->post('portal_desc')
			);
			$this->session->set_flashdata($data);
			redirect('setting/portal/edit/' . $this->input->post('portal_slug'));
		}
	}

	// delete
	public function delete($portal_slug = "") {
		// user_auth
		$this->check_auth('D');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get portal list
		$data['result'] = $this->m_portal->get_portal_by_slug($portal_slug);
		// load template
		$data['title'] = "Delete Portal Area PinapleSAS";
		$data['layout'] = "setting/portal/delete";
		$this->load->view('base/backend/template', $data);
	}

	// delete process
	public function delete_process() {

		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('portal_slug', '', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('portal_id'));
			if ($this->m_portal->delete_portal($params)) {
				$data['message'] = "Data successfully deleted";
			}
			$this->session->set_flashdata($data);
			redirect('setting/portal');
		} else {
			$data = array(
				'message'		=> validation_errors()
			);
		}
		$this->session->set_flashdata($data);
		redirect('setting/portal/delete/' . $this->input->post('portal_slug'));
	}

	// page title
	public function page_title() {
		$data['page_title'] = 'Portal';
		$this->session->set_userdata($data);
	}
}
