<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class User extends Base {

	public function __construct() {
		// call the controller construct
		parent::__construct();
		
		// load model
		$this->load->model('base/setting/m_user');
		$this->load->model('base/setting/m_role');

		// active page
		$active['parent_active'] = "user";
		$active['child_active'] = "user";
		$this->session->set_userdata($active);	

		// breadcrumbs
		$this->breadcrumb->add('setting','base/setting/user');
	}

	public function index()
	{
		// user_auth
		$this->check_auth('R');

		// get user list
		$this->data['rs_user'] = $this->m_user->get_all_user();

		// prepare the page
		$this->page_content = "setting/user/list";
		$this->render_layout();
	}

	// add
	public function add() {
		// user_auth
		$this->check_auth('C');

		// menu
		$data['menu'] = $this->menu();
		// get role list
		$data['rs_role'] = $this->m_role->get_all_role();
		// user detail
		$data['user'] = $this->user;
		// load template
		$data['title']		  = "Setup User PinapleSAS";
		$data['layout'] = "setting/user/add";
		$this->load->view('base/backend/template', $data);
	}

	// add process
	public function add_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('role_id', 'Role', 'required|trim|xss_clean');
		$this->form_validation->set_rules('user_full_name', 'Full Name', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('user_name', 'Username', 'required|trim|xss_clean|max_length[100]|is_unique[core_user.user_name]');
		$this->form_validation->set_rules('user_pass', 'Description', 'required|trim|xss_clean|sha1');
		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('user_st', 'Status', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('user_full_name'), $this->input->post('user_address'), $this->input->post('user_birthday'), $this->input->post('user_contact'), $this->input->post('user_id'));


			if ($this->m_user->add_user_profile($params)) {
				// get last inserted id
				$last_id = $this->m_user->get_last_inserted_id();
				// insert account
				$params = array($last_id, $this->input->post('user_name'), $this->input->post('user_pass'), $this->input->post('user_email'), $this->input->post('user_st'), $this->input->post('user_id'));
				$this->m_user->add_user($params);
				// insert role user
				$this->m_user->add_role_user(array($this->input->post('role_id'), $last_id));

				echo "berhasil";
				// if user upload file
				if ($_FILES['userfile']['error'] != 4) {
					// file upload
					$config['upload_path']		= 'resource/doc/user/';
					$config['allowed_types']	= 'jpg';
					$config['max_size']			= '100';
					$config['max_width']		= '250';
					$config['max_height']		= '250';
					$config['file_name']		= $last_id . '.jpg';
					$this->load->library('upload', $config);
					// image processing
					if (!$this->upload->do_upload()) {
						$data['message'] = "Data successfully added, but " . str_replace("\n", "", $this->upload->display_errors());
					} else {
						// image processing
						$config['image_library']	= 'gd2';
						$config['source_image']		= 'resource/doc/user/' . $last_id . '.jpg';
						$config['new_image']		= 'resource/doc/user/thumb/';
						// $config['create_thumb']	= TRUE;
						$config['maintain_ratio']	= TRUE;
						$config['width']			= 100;
						$config['height']			= 100;
						// load image processing library
						$this->load->library('image_lib', $config);
						if (!$this->image_lib->resize()) {
							$data['message'] .= str_replace("\n", "", $this->upload->display_errors());
						} else {
							// update user picture
							$this->m_user->edit_user_picture(array($last_id . '.jpg', $last_id));
						}
					}
				}
			}
			$this->session->set_flashdata($data);
			redirect('setting/user');
		} else {
			$data = array(
				'message'			=> str_replace("\n", "", validation_errors()),
				'user_full_name'	=> $this->input->post('user_full_name'),
				'user_name'			=> $this->input->post('user_name'),
				'user_pass'			=> $this->input->post('user_pass'),
				'user_email'		=> $this->input->post('user_email'),
				'user_st'			=> $this->input->post('user_st')
			);
		}
		$this->session->set_flashdata($data);
		redirect('setting/user/add');
	}

	// edit
	public function edit_profile($user_slug = "") {
		// user_auth
		$this->check_auth('U');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get user list
		$data['result'] = $this->m_user->get_user_by_slug($user_slug);
		// load template
		$data['title']	= "Edit User PinapleSAS";
		$data['layout'] = "setting/user/edit_profile";
		$this->load->view('base/backend/template', $data);
	}

	// edit process
	public function edit_profile_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('users_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('user_full_name', 'Full Name', 'required|trim|xss_clean|max_length[100]');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('user_full_name'), $this->input->post('user_address'), $this->input->post('user_birthday'), $this->input->post('user_contact'), $this->input->post('users_id'));
			if ($this->m_user->edit_user_profile($params)) {
				$data['message'] = "Data successfully edited";
				// if user upload file
				if ($_FILES['userfile']['error'] != 4) {
					// file upload
					$config['upload_path']		= 'resource/doc/user/';
					$config['allowed_types']	= 'jpg';
					$config['overwrite']		= TRUE;
					$config['max_size']			= '100';
					$config['max_width']		= '250';
					$config['max_height']		= '250';
					$config['file_name']		= $this->input->post('users_id') . '.jpg';
					$this->load->library('upload', $config);
					// image processing
					if (!$this->upload->do_upload()) {
						$data['message'] = "Data successfully edited, but ";
					} else {
						// image processing
						$config['image_library']	= 'gd2';
						$config['source_image']		= 'resource/doc/user/' . $this->input->post('users_id') . '.jpg';
						$config['new_image']		= 'resource/doc/user/thumb/';
						// $config['create_thumb']	= TRUE;
						$config['maintain_ratio']	= TRUE;
						$config['width']			= 100;
						$config['height']			= 100;
						// load image processing library
						$this->load->library('image_lib', $config);
						if (!$this->image_lib->resize()) {
							$data['message'] .= str_replace("\n", "", $this->upload->display_errors());
						} else {
							// update user picture
							$this->m_user->edit_user_picture(array($this->input->post('users_id') . '.jpg', $this->input->post('users_id')));
						}
					}
				}
			}
			$this->session->set_flashdata($data);
			redirect('setting/user');
		} else {
			$data = array(
				'message'			=> str_replace("\n", "", validation_errors()),
				'user_full_name'	=> $this->input->post('user_full_name'),
				'user_address'		=> $this->input->post('user_address'),
				'user_birthday'		=> $this->input->post('user_birthday'),
				'user_contact'		=> $this->input->post('user_contact')
			);
		}
		echo json_encode($data);
		$this->session->set_flashdata($data);
		redirect('setting/user/edit_profile/' . $this->input->post('users_id'));
	}

	// edit
	public function edit_account($user_slug = "") {
		// user_auth
		$this->check_auth('U');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get role list
		$data['rs_role'] = $this->m_role->get_all_role();
		// get user list
		$data['result'] = $this->m_user->get_user_by_slug($user_slug);
		// load template
		$data['title']	= "Edit User PinapleSAS";
		$data['layout'] = "setting/user/edit_account";
		$this->load->view('base/backend/template', $data);
	}

	// edit process
	public function edit_account_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('users_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('role_id', 'Role', 'required|trim|xss_clean');
		$this->form_validation->set_rules('old_user_name', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('old_user_email', '', 'required|trim|xss_clean');
		// $this->form_validation->set_rules('old_role_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('user_name', 'Name', 'required|trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('user_st', 'Status', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->input->post('old_user_name') != $this->input->post('user_name')) {
				if ($this->m_user->user_name_validation(array($this->input->post('user_name'), $this->input->post('users_id')))) {
					$data['message'] = "Username already used";
					$this->session->set_flashdata($data);
					redirect('setting/user/edit_account/' . $this->input->post('users_id'));
				}
			}
			if ($this->input->post('old_user_email') != $this->input->post('user_email')) {
				if ($this->m_user->user_email_validation(array($this->input->post('user_email'), $this->input->post('users_id')))) {
					$data['message'] = "Email already used";
					$this->session->set_flashdata($data);
					redirect('setting/user/edit_account/' . $this->input->post('users_id'));
				}
			}
			if ($this->input->post('old_role_id') != $this->input->post('role_id')) {
				if ($this->m_user->role_user_validation(array($this->input->post('role_id'), $this->input->post('user_id')))) {
					$data['message'] = "User already have account for that role";
					$this->session->set_flashdata($data);
					redirect('setting/user/edit_account/' . $this->input->post('users_id'));
				}
			}
			// insert
			$params = array($this->input->post('user_name'), $this->input->post('user_email'), $this->input->post('user_st'), $this->input->post('users_id'));
			if ($this->m_user->edit_user_account($params)) {
				// edit role user
				$this->m_user->edit_role_user(array($this->input->post('role_id'), $this->input->post('old_role_id'), $this->input->post('users_id')));
				$data['message'] = "Data successfully edited";
			}
			$this->session->set_flashdata($data);
			redirect('setting/user');
		} else {
			$data = array(
				'message'		=> str_replace("\n", "", validation_errors()),
				'role_id'		=> $this->input->post('role_id'),
				'user_name'		=> $this->input->post('user_name'),
				'user_email'	=> $this->input->post('user_email'),
				'user_st'		=> $this->input->post('user_st')
			);
		}
		$this->session->set_flashdata($data);
		redirect('setting/user/edit_account/' . $this->input->post('users_id'));
	}

	// edit
	public function edit_password($user_slug = "") {
		// user_auth
		$this->check_auth('U');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get user list
		$data['result'] = $this->m_user->get_user_by_slug($user_slug);
		// load template
		$data['title'] = "Setting Password User PinapleSAS";
		$data['layout'] = "setting/user/edit_password";
		$this->load->view('base/backend/template', $data);
	}

	// edit process
	public function edit_password_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('users_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('old_user_pass', 'Old Password', 'required|trim|xss_clean|max_length[100]|sha1');
		$this->form_validation->set_rules('user_pass', 'Password', 'required|trim|xss_clean|max_length[100]|sha1');
		$this->form_validation->set_rules('retype_user_pass', 'Retype Password', 'required|trim|xss_clean|matches[user_pass]|max_length[100]|sha1');

		if ($this->form_validation->run() == TRUE) {
			if ($this->m_user->password_validation(array($this->input->post('old_user_pass'), $this->input->post('users_id')))) {
				// insert
				$params = array($this->input->post('user_pass'), $this->input->post('users_id'));
				if ($this->m_user->edit_user_pass($params)) {
					$data['message'] = "Password successfully edited";
				}
			} else {
				$data['message'] = "Sorry, incorrect old password";
			}
			$this->session->set_flashdata($data);
			redirect('setting/user/edit_password/' . $this->input->post('users_id'));
		} else {
			$data = array(
				'message'	=> str_replace("\n", "", validation_errors()),
				'role_pass'	=> $this->input->post('role_pass')
			);
		}
		$this->session->set_flashdata($data);
		redirect('setting/user/edit_password/' . $this->input->post('users_id'));
	}

	// delete
	public function delete($user_slug = "") {
		// user_auth
		$this->check_auth('D');

		// menu
		$data['menu'] = $this->menu();
		// user detail
		$data['user'] = $this->user;
		// get user list
		$data['result'] = $this->m_user->get_user_by_slug($user_slug);
		// load template
		$data['title'] = "Setting User PinapleSAS";
		$data['layout'] = "setting/user/delete";
		$this->load->view('base/backend/template', $data);
	}

	// delete process
	public function delete_process() {
		// form validation
		$this->form_validation->set_rules('user_id', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('users_id', '', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('users_id'));
			if ($this->m_user->delete_user($params)) {
				$this->m_user->delete_user_role($params);
				$this->m_user->delete_user_profile($params);
				$data['message'] = "Data successfully deleted";
				// unlink image and thumbnail
				unlink('resource/doc/user/' . $this->input->post('users_id') . '.jpg');
				unlink('resource/doc/user/thumb/' . $this->input->post('users_id') . '.jpg');
			}
			$this->session->set_flashdata($data);
			redirect('setting/user');
		} else {
			$data = array(
				'message'	=> str_replace("\n", "", validation_errors()),
			);
		}
		$this->session->set_flashdata($data);
		redirect('setting/user/delete/' . $this->input->post('users_id'));
	}

	// page title
	public function page_title() {
		$data['page_title'] = 'User';
		$this->session->set_userdata($data);
	}
}
