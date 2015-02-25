<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/base/controllers/base.php' );

class User extends Base {

    function __construct() {
        parent::__construct();

        $this->load->model('base/setting/user_model','user_model',TRUE);

        $this->breadcrumb->add('User Management');
    }

    public function index() {

        $this->data['submit_editor_url'] = base_url().'base/setting/user/submit';
        $this->data['getdatatables_url'] = base_url().'base/setting/user/getdatatables';

        // Prepare the page
        $this->page_title   = "Manajemen User";
        $this->page_content = "base/setting/user";
        $this->render_layout();

    }
     
    public function getdatatables() {
        $this->datatables->select('user_id,user_name,user_pass,user_key,user_email,user_full_name,user_address,user_birthday,user_picture,user_phone,user_st,dc,du,')
                        ->from('core_user');

        echo $this->datatables->generate();
    }

    public function submit() {
        $action = $this->input->post('action');
        
        if ($action == 'edit') {
            $this->user_model->update();
        }elseif ($action == 'create') {
            $this->user_model->save();
        }elseif ($action == 'remove') {
            $this->user_model->delete();
        }else{
            // nothing to do
        }

        $this->getdatatables();
    }

    public function get($user_id=null){
        if($user_id!==null){
            echo json_encode($this->core_userdb->get_one($user_id));
        }
    }

}