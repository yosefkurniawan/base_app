<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/admin/controllers/admin.php' );

class Menu extends Admin {

    // Start: customize CRUD parameters
    private $crud_table 	= 'core_menu';
    private $portal_table 	= 'core_portal';
    // End: customize CRUD parameters

    private $crud_for;
    private $model_name;
    private $model;
    private $controller_path;
    private $model_path;
    private $view_path;

    function __construct() {
        parent::__construct();

        // set vars (can be customized)
        $this->crud_for         = $this->router->fetch_class();
        $this->controller_path  = $this->get_class_path();
        $this->model_path       = $this->get_class_path().'_model';
        $this->view_path        = $this->get_class_path();

        // load models
        $this->model_name = array_pop(explode('/', $this->model_path));
        $this->model = $this->load->model($this->model_path, $this->model_name, TRUE);
        $this->load->model('admin/user_management/portal_model', 'portal_model', TRUE);

        // add breadcrumbs
        $this->breadcrumb->add('Manajemen '.ucwords($this->crud_for));
    }

    public function index() {

        $this->data['submit_editor_url'] = base_url().$this->controller_path.'/submit';
        $this->data['crud_for'] 	= ucwords($this->crud_for);
        $this->data['portal_list']	= $this->portal_model->get_all();
        $this->data['menu_list_all']= $this->get_all_menu_tree();

        // Prepare the page
        $this->default_msg_placing = false;
        $this->content_class= "table-layout";
        $this->page_title   = "Manajemen ".ucwords($this->crud_for);
        $this->page_content = $this->view_path;
        $this->render_layout();

    }
     
    public function get_all_menu_tree() {
        $menu = array();

		$level_0 	= $this->model->get_parent_menu_all();

		if ($level_0) {
			$menu 	= $level_0;
			
			// get menu level 1
			foreach ($level_0 as $key_level_0 => $level_0_value) {
				$menu[$key_level_0]['child_level_1'] = array();

				if ($level_1 = $this->model->get_child_menu_all(array($level_0_value['menu_id']))) {
					$menu[$key_level_0]['child_level_1'] = $level_1;

					// get menu level 2
					foreach ($level_1 as $key_level_1 => $level_1_value) {
						$menu[$key_level_0]['child_level_1'][$key_level_1]['child_level_2'] = array();
						
						if ($level_2 = $this->model->get_child_menu_all(array($level_1_value['menu_id']))) {
							$menu[$key_level_0]['child_level_1'][$key_level_1]['child_level_2'] = $level_2;
						}
					};
				}
			}
		}
		return $menu;
    }

    public function get_menu() {
    	$menu_id = $this->input->get('menu_id');

    	if ($this->input->is_ajax_request()) {
    		$data = $this->model->get_menu($menu_id);

    		echo json_encode($data);
    	}
    	return false;
    }

    public function submit() {
        $action = $this->input->post('action');
        
        if ($action == 'edit') {
            $result = $this->model->update();
            $this->session->set_flashdata('show_form',true);
            redirect($this->get_class_path());
        }elseif ($action == 'create') {
            $result = $this->model->save();
            $this->session->set_flashdata('show_form',true);
            redirect($this->get_class_path());
        }elseif ($action == 'remove') {
            $result = $this->model->delete();
        }else{
            // nothing to do
        }

        echo json_encode($result);
    }

    public function submit_order() {
    	if ($this->input->is_ajax_request()) {
    		$this->model->submit_order();
    	}
    	
    }

    public function get($id=null){
        if($id!==null){
            echo json_encode($this->model->get_one($id));
        }
    }

}