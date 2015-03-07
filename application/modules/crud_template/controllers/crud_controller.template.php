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
    private $crud_for   = '<Crud_for_what>';
    private $crud_table = '<table_name>';
    private $controller_path   = '<controller_path>';
    private $model_path        = '<model_path>';
    private $view_path         = '<view_path>';
    // End: customize CRUD parameters

    private $model_name;
    private $model;

    function __construct() {
        parent::__construct();

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