<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Portal_model extends CI_Model {

    // Start: customize CRUD parameters
    private $crud_table = 'core_portal';
    private $id         = 'portal_id';
    // End: customize CRUD parameters

    function __construct() {
        parent::__construct();
    }

    /* ========================================== */
    /* CRUD MAIN FUNCTIONS
    /* ========================================== */

    /* Get all */
    function get_all($limit=NULL, $uri=NULL) {

        if ($limit != NULL && $uri != NULL) {
            $result = $this->db->get($this->crud_table);
        }else{
            $result = $this->db->get($this->crud_table, $limit, $uri);
        }
        
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    
    /* Get one */
    function get_one($id) {
        $this->db->where($this->id, $id);
        $result = $this->db->get($this->crud_table);
        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /* Save new data */
    function save() {
        $inputs   = $this->input->post('data');

        // Start: customize parameters
        $data = array(
            'portal_name'   => $inputs['portal_name'],
            'portal_slug'   => $inputs['portal_slug'],
            'portal_title'  => $inputs['portal_title'],
            'portal_desc'   => $inputs['portal_desc'],
            'creator'       => $inputs['creator'],
            'dc'            => date('Y-m-d H:i:s')
        );
        // End: customize parameters
        
        if ($this->db->insert($this->crud_table, $data)) {
            // success
            $this->message->addSuccess('Data berhasil disimpan.');
            $result['success'] = true;
        }else{
            // error: unknown
            $this->message->addError('Terjadi galat saat menyimpan data.');
            $result['success'] = false;
        }
        
        $result['message'] = $this->message->render_html();
        return $result;
    }

    /* save edited data */
    function update() {
        $inputs   = $this->input->post('data');
        $id  = $this->input->post('id');

        // Start: customize parameters
        $data = array(
            'portal_name'   => $inputs['portal_name'],
            'portal_slug'   => $inputs['portal_slug'],
            'portal_title'  => $inputs['portal_title'],
            'portal_desc'   => $inputs['portal_desc'],
            'du'            => date('Y-m-d H:i:s')
        );
        // End: customize parameters

        $this->db->where($this->id, $id);
        if ($this->db->update($this->crud_table, $data)){
            // success
            $this->message->addSuccess('Data berhasil disimpan.');
            $result['message'] = $this->message->render_html();
            $result['success'] = true;
        }else{
            // error: unknown
            $this->message->addError('Terjadi galat saat menyimpan data.');
            $result['message'] = $this->message->render_html();
            $result['success'] = false;
        }

        return $result;
    }

    /* delete data */
    function delete() {
        $id  = $this->input->post('id');

        if (is_array($id)) {
            $count_success = 0;
            $count_failed = 0;
            $result = array();
            foreach ($id as $row) {
                $this->db->where($this->id, $row);
                if ($this->db->delete($this->crud_table)) {
                    $count_success++;
                }else{
                    $count_failed++;
                }
            }
            $result['deleted']      = $count_success;
            $result['not_deleted']  = $count_failed;

            if ($count_success > 0) {
                $this->message->addSuccess($count_success.' baris data berhasil dihapus.');
            }
            
            if ($count_failed > 0) {
                $this->message->addError($count_failed.' baris data gagal dihapus.');
            }

            $result['message'] = $this->message->render_html();
            return $result;
        }else{
            $this->db->where($this->id, $id);
            if ($this->db->delete($this->crud_table)) {
                // success
                $this->message->addSuccess('Data berhasil dihapus.');
                $result['message'] = $this->message->render_html();
                $result['success'] = true;
            }else{
                // error: unknown
                $this->message->addError('Terjadi galat saat menghapus data.');
                $result['message'] = $this->message->render_html();
                $result['success'] = false;
            }
            return $result;
        }
    }

}
?>
