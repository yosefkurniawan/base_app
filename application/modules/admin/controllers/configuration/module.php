<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once( APPPATH . 'modules/admin/controllers/admin.php' );

class Module extends Admin {

    private $title      = 'Konfigurasi Modul';

    function __construct() {
        parent::__construct();

        // load models
        $this->model = $this->load->model('configuration/modules_model', 'modules_model', TRUE);

        // add breadcrumbs
        $this->breadcrumb->add($this->title);
    }

    public function index() {

        $this->data['modules_list'] = $this->modules_model->get_modules_list();
        $this->data['submit_url']   = base_url().$this->get_class_path().'/submit';

        // Prepare the page
        $this->page_title   = $this->title;
        $this->page_content = $this->get_module_path().'module';
        $this->render_layout();

    }
     
    public function submit() {

        if ($this->input->is_ajax_request()) {
            if ($this->modules_model->save()) {
                $this->message->addSuccess('Perubahan berhasil disimpan.');
                $result['message'] = $this->message->render_html();
                $result['success'] = true;
                echo json_encode($result);
            }else{
                $this->message->addError('Terjadi galat saat menyimpan perubahan. Silakan cobo lagi.');
                $result['message'] = $this->message->render_html();
                $result['success'] = false;
                echo json_encode($result);
            }
        }
    }

}