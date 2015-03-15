<?php
/*
 * CRUD controller template
 *
 * Description:
 * - Some parts need to be customized to make it work:
 *      1. Class name
 *      2. CRUD parameters
 *
 */
?>

<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Class_name extends Base {

    // Start: customize CRUD parameters
    private $crud_table = '<table_name>';
    // End: customize CRUD parameters

    private $crud_for;
    private $model_name;
    private $model;
    private $controller_path;
    private $model_path;
    private $view_path;

    function __construct() {
        parent::__construct();

        // check permission
        $this->check_auth('R'); 

        // set vars (can be customized)
        $this->crud_for         = $this->router->fetch_class();
        $this->controller_path  = $this->get_class_path();
        $this->model_path       = $this->get_class_path().'_model';
        $this->view_path        = $this->get_class_path();

        // load models
        $this->model_name = array_pop(explode('/', $this->model_path));
        $this->model = $this->load->model($this->model_path, $this->model_name, TRUE);

        // add breadcrumbs
        $this->breadcrumb->add('Manajemen '.ucwords($this->crud_for));
    }

    public function index() {

        $this->data['submit_editor_url'] = base_url().$this->controller_path.'/submit';
        $this->data['getdatatables_url'] = base_url().$this->controller_path.'/getdatatables';
        $this->data['crud_for']          = ucwords($this->crud_for);

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
            if($this->check_auth('U')) // check permission
                $result = $this->model->update();
            else
                $result = $this->get_auth_error();
        }elseif ($action == 'create') {
            if($this->check_auth('C')) // check permission
                $result = $this->model->save();
            else
                $result = $this->get_auth_error();
        }elseif ($action == 'remove') {
            if($this->check_auth('D')) // check permission
                $result = $this->model->delete();
            else
                $result = $this->get_auth_error();
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