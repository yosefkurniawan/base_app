<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class Role extends Base {

    // Start: customize CRUD parameters
    private $crud_for   = 'role';
    private $crud_table = 'core_role';
    private $controller_path   = 'base/setting/role';
    private $model_path        = 'base/setting/role_model';
    private $view_path         = 'base/setting/role';
    // End: customize CRUD parameters

    private $model_name;
    private $model;

    function __construct() {
        parent::__construct();

        // load models
        $this->model_name = array_pop(explode('/', $this->model_path));
        $this->model = $this->load->model($this->model_path, $this->model_name, TRUE);
        $this->load->model('base/setting/portal_model', 'portal_model', TRUE);
        $this->load->model('base/setting/menu_model', 'menu_model', TRUE);

        // add breadcrumbs
        $this->breadcrumb->add('Manajemen '.ucwords($this->crud_for));
    }

    /* ========================================== */
    /* CRUD MAIN FUNCTIONS
    /* ========================================== */

    public function index() {

        $this->data['submit_editor_url'] = base_url().$this->controller_path.'/submit';
        $this->data['getdatatables_url'] = base_url().$this->controller_path.'/getdatatables';
        $this->data['crud_for']          = ucwords($this->crud_for);
        
        $this->data['portal_list']       = $this->portal_model->get_all();
        
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

    /* ========================================== */
    /* CUSTOM FUNCTIONS
    /* ========================================== */

    public function get_permission_by_role($role_id=NULL) {
        
        if($this->is_ajax()) {
            $role_id = $this->input->get('role_id');
        }

        $permission = array();
        
        if ($role_id) {
            $permission = $this->model->get_permission_by_role($role_id);
        }
        
        $html = $this->template_permission_form($permission);

        // check ajax
        if($this->is_ajax()) {
            echo $html;
        }else{
            return $html;
        }
    }

    private function template_permission_form($permission=NULL) {
        $html = '';
        
        if (empty($permission)) {
            $permission = $this->menu_model->get_all();
        }

        foreach ($permission as $key => $value) {
            if (isset($value['permission'])) {
                $c = ($value['permission'][0])? 'checked': '';
                $r = ($value['permission'][1])? 'checked': '';
                $u = ($value['permission'][2])? 'checked': '';
                $d = ($value['permission'][3])? 'checked': '';
            }else{
                $c = '';
                $r = '';
                $u = '';
                $d = '';
            }

            $html .= '<tr>
                        <td>
                            '.$value['menu_name'].'
                        </td>
                        <td>
                            <div class="option-group field text-center">
                                <label class="option option-primary mn">
                                    <input type="hidden" value="0" name="permission['.$value['menu_id'].'][c]">
                                    <input type="checkbox" name="permission['.$value['menu_id'].'][c]" value="1" '. $c .'>
                                    <span class="checkbox mn"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="option-group field text-center">
                                <label class="option option-primary mn">
                                    <input type="hidden" value="0" name="permission['.$value['menu_id'].'][r]">
                                    <input type="checkbox" name="permission['.$value['menu_id'].'][r]" value="1" '. $r .'>
                                    <span class="checkbox mn"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="option-group field text-center">
                                <label class="option option-primary mn">
                                    <input type="hidden" value="0" name="permission['.$value['menu_id'].'][u]">
                                    <input type="checkbox" name="permission['.$value['menu_id'].'][u]" value="1" '. $u .'>
                                    <span class="checkbox mn"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="option-group field text-center">
                                <label class="option option-primary mn">
                                    <input type="hidden" value="0" name="permission['.$value['menu_id'].'][d]">
                                    <input type="checkbox" name="permission['.$value['menu_id'].'][d]" value="1" '. $d .'>
                                    <span class="checkbox mn"></span>
                                </label>
                            </div>
                        </td>
                    </tr>';
            
        }
        
        return $html;
    }
}