<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $uri) {

        $result = $this->db->get('core_user', $limit, $uri);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    
    function get_one($user_id) {
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('core_user');
        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    function save() {
        $inputs   = $this->input->post('data');
        
        $data = array(
        'user_name' => $inputs['user_name'],
        'user_pass' => md5($inputs['user_pass']),
        'user_email' => $inputs['user_email'],
        'user_full_name' => $inputs['user_full_name'],
        'user_address' => $inputs['user_address'],
        'user_birthday' => $inputs['user_birthday'],
        'user_phone' => $inputs['user_phone'],
        'user_st' => (isset($inputs['user_st']) && $inputs['user_st'] == '1')? 'active' : 'inactive',
        'dc' => date('Y-m-d'),
        );

        return $this->db->insert('core_user', $data);
    }

    function update() {
        $inputs   = $this->input->post('data');
        $user_id  = $this->input->post('id');

        $data = array(
        'user_id' => $user_id,
        'user_name' => $inputs['user_name'],
        'user_pass' => $inputs['user_pass'],
        'user_email' => $inputs['user_email'],
        'user_full_name' => $inputs['user_full_name'],
        'user_address' => $inputs['user_address'],
        'user_birthday' => $inputs['user_birthday'],
        'user_phone' => $inputs['user_phone'],
        'user_st' => $inputs['user_st'],
        'du' => date('Y-m-d'),
        );
        $this->db->where('user_id', $user_id);
        return $this->db->update('core_user', $data);
    }

    function delete() {
        $user_id  = $this->input->post('id');
        
        foreach ($user_id as $row) {
            $this->db->where('user_id', $row);
            return $this->db->delete('core_user');
        }
    }

}
?>
