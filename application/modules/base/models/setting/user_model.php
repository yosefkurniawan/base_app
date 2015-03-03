<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model {

    // Start: customize CRUD parameters
    private $crud_table = 'core_user';
    private $id         = 'user_id';
    // End: customize CRUD parameters

    function __construct() {
        parent::__construct();
    }

    /* ========================================== */
    /* CRUD MAIN FUNCTIONS
    /* ========================================== */

    /* Get all */
    function get_all($limit, $uri) {

        $result = $this->db->get($this->crud_table, $limit, $uri);
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
    // function save() {
    //     $inputs   = $this->input->post('data');

    //     // Start: customize parameters
    //     $data = array(
    //     // 'field' => 'input value',
    //     // ...
    //     );
    //     // End: customize parameters
        
    //     if ($this->db->insert($this->crud_table, $data)) {
    //         // success
    //         $this->message->addSuccess('Data berhasil disimpan.');
    //         $result['success'] = true;
    //     }else{
    //         // error: unknown
    //         $this->message->addError('Terjadi galat saat menyimpan data.');
    //         $result['success'] = false;
    //     }
        
    //     $result['message'] = $this->message->render_html();
    //     return $result;
    // }

    /* save edited data */
    // function update() {
    //     $inputs   = $this->input->post('data');
    //     $id  = $this->input->post('id');

    //     // Start: customize parameters
    //     $data = array(
    //     // 'field' => 'input value',
    //     // ...
    //     );
    //     // End: customize parameters

    //     $this->db->where($this->id, $id);
    //     if ($this->db->update($crud_table, $data)){
    //         // success
    //         $this->message->addSuccess('Data berhasil disimpan.');
    //         $result['message'] = $this->message->render_html();
    //         $result['success'] = true;
    //     }else{
    //         // error: unknown
    //         $this->message->addError('Terjadi galat saat menyimpan data.');
    //         $result['message'] = $this->message->render_html();
    //         $result['success'] = false;
    //     }

    //     return $result;
    // }

    /* delete data */
    // function delete() {
    //     $id  = $this->input->post('id');

    //     if (is_array($id)) {
    //         $count_success = 0;
    //         $count_failed = 0;
    //         $result = array();
    //         foreach ($id as $row) {
    //             $this->db->where($this->id, $row);
    //             if ($this->db->delete($this->crud_table)) {
    //                 $count_success++;
    //             }else{
    //                 $count_failed++;
    //             }
    //         }
    //         $result['deleted']      = $count_success;
    //         $result['not_deleted']  = $count_failed;

    //         if ($count_success > 0) {
    //             $this->message->addSuccess($count_success.' baris data berhasil dihapus.');
    //         }
            
    //         if ($count_failed > 0) {
    //             $this->message->addError($count_failed.' baris data gagal dihapus.');
    //         }

    //         $result['message'] = $this->message->render_html();
    //         return $result;
    //     }else{
    //         $this->db->where($this->id, $id);
    //         if ($this->db->delete($this->crud_table)) {
    //             // success
    //             $this->message->addSuccess('Data berhasil dihapus.');
    //             $result['message'] = $this->message->render_html();
    //             $result['success'] = true;
    //         }else{
    //             // error: unknown
    //             $this->message->addError('Terjadi galat saat menghapus data.');
    //             $result['message'] = $this->message->render_html();
    //             $result['success'] = false;
    //         }
    //         return $result;
    //     }
    // }

    /* ========================================== */
    /* CUSTOM FUNCTIONS
    /* ========================================== */

    /* get data by username */
    function get_one_by_username($username) {
        $this->db->where('user_name', $username);
        $result = $this->db->get($this->crud_table);
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /* get data by email */
    function get_one_by_email($email) {
        $this->db->where('user_email', $email);
        $result = $this->db->get($this->crud_table);
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /* Custom Save new data */
    function save() {
        $inputs   = $this->input->post('data');

        $check_username = $this->get_one_by_username($inputs['user_name']);
        $check_email    = $this->get_one_by_email($inputs['user_email']);

        if (!count($check_username) > 0) {
            if (!count($check_email) > 0 ) {
                $data = array(
                'user_name' => $inputs['user_name'],
                'user_pass' => sha1($inputs['user_pass']),
                'user_email' => $inputs['user_email'],
                'user_full_name' => $inputs['user_full_name'],
                'user_address' => $inputs['user_address'],
                'user_birthday' => date("Y-m-d", strtotime($inputs['user_birthday'])),
                'user_phone' => $inputs['user_phone'],
                'user_st' => (isset($inputs['user_st']) && $inputs['user_st'] == '1')? 'active' : 'inactive',
                'dc' => date('Y-m-d H:i:s'),
                );
                
                if ($this->db->insert($this->crud_table, $data)) {
                    // success
                    $this->message->addSuccess('Data has been inserted successfully.');
                    $result['success'] = true;
                }else{
                    // error: unknown
                    $this->message->addError('An error was occured while saving data.');
                    $result['success'] = false;
                }
                
                $result['message'] = $this->message->render_html();
                return $result;
            }else{
                // error: email exists already
                $this->message->addError('Sorry, email "'.$inputs['user_email'].'" already exists.');
                $result['message'] = $this->message->render_html();
                $result['success'] = false;
                return $result;
            }
        }else{
            // error: username exists already
            $this->message->addError('Sorry, username "'.$inputs['user_name'].'" already exists.');
            $result['message'] = $this->message->render_html();
            $result['success'] = false;
            return $result;
        }
    }

    /* Custom save edited data */
    function update() {
        $inputs   = $this->input->post('data');
        $id  = $this->input->post('id');

        $check_email    = $this->get_one_by_email($inputs['user_email']);
        $old_data       = $this->get_one($id); 
        if (!count($check_email) > 0 || $old_data['user_email'] == $inputs['user_email']) {   // if email doesn't exists & email is not changed
            $data = array(
            'user_email' => $inputs['user_email'],
            'user_full_name' => $inputs['user_full_name'],
            'user_address' => $inputs['user_address'],
            'user_birthday' => date("Y-m-d", strtotime($inputs['user_birthday'])),
            'user_phone' => $inputs['user_phone'],
            'user_st' => (isset($inputs['user_st']) && $inputs['user_st'] == '1')? 'active' : 'inactive',
            'du' => date('Y-m-d H:i:s'),
            );

            if (isset($inputs['change_password']) && $inputs['change_password'] == '1') {
                $data['user_pass'] = sha1($inputs['user_pass']);
            }

            $this->db->where($this->id, $id);
            if ($this->db->update($this->crud_table, $data)){
                // success
                $this->message->addSuccess('Data has been updated.');
                $result['message'] = $this->message->render_html();
                $result['success'] = true;
            }else{
                // error: unknown
                $this->message->addError('An error was occured while saving data.');
                $result['message'] = $this->message->render_html();
                $result['success'] = false;
            }

            return $result;
        }else{
            // error: email exists already
            $this->message->addError('Sorry, email "'.$inputs['user_email'].'" already exists.');
            $result['message'] = $this->message->render_html();
            $result['success'] = false;
            return $result;
        }
    }

    /* Custom delete data */
    /* Description :
     * - the data is not deleted, just change its status as deleted.
     */
    function delete() {
        $id  = $this->input->post('id');

        if (is_array($id)) {
            $count_success = 0;
            $count_failed = 0;
            $result = array();
            
            foreach ($id as $row) {
                $data = array(
                    'user_st' => 'deleted',
                );

                $this->db->where($this->id, $row);
                if ($this->db->update($this->crud_table, $data)){
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
            $data = array(
                'user_st' => 'deleted',
            );

            if ($this->db->update($this->crud_table, $data)) {
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
