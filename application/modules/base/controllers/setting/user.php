<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class User extends Base {

    // Start: customize CRUD parameters
    private $crud_for   = 'user';
    private $crud_table = 'core_user';
    private $controller_path   = 'base/setting/user';
    private $model_path        = 'base/setting/user_model';
    private $view_path         = 'base/setting/user';
    // End: customize CRUD parameters

    private $model_name;
    private $model;

    function __construct() {
        parent::__construct();

        // load models
        $this->model_name = array_pop(explode('/', $this->model_path));
        $this->model = $this->load->model($this->model_path, $this->model_name, TRUE);
        $this->load->model('base/setting/role_model', 'role_model', TRUE);

        // add breadcrumbs
        $this->breadcrumb->add('Manajemen '.ucwords($this->crud_for));
    }

    public function index() {

        $this->data['submit_editor_url'] = base_url().$this->controller_path.'/submit';
        $this->data['getdatatables_url'] = base_url().$this->controller_path.'/getdatatables';
        $this->data['crud_for']          = ucwords($this->crud_for);

        $this->data['role_list']         = $this->role_model->get_all();
        
        // Prepare the page
        $this->page_title   = "Manajemen ".ucwords($this->crud_for);
        $this->page_content = $this->view_path;
        $this->render_layout();

    }
     
    public function getdatatables() {
        $this->model->get_datatables();
        echo $this->datatables->generate();
    }

    public function submit() {
        $action = $this->input->post('action');
        
        if ($action == 'edit') {
            $result = $this->model->update();
        }elseif ($action == 'create') {
            $result = $this->model->save();
        }elseif ($action == 'remove') {
            $result = $this->model->delete();
        }else{
            // nothing to do
        }

        echo json_encode($result);
    }

    public function get($id=null){
        if($id!==null){
            echo json_encode($this->model->get_one($id));
        }
    }

}