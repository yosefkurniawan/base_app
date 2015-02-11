<?php

class m_permission extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get permission list
    function get_all_permission() {
        $sql = "SELECT * FROM core_permission";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // get permission by role
    function get_permission_by_role($params) {
        $sql = "SELECT * FROM core_permission WHERE role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // get role menu
    function get_role_menu($params) {
        $sql = "SELECT * FROM core_permission WHERE role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // edit
    function edit_permission($params) {
        foreach ($params[1] as $key => $value) {
            $permission = "";
            for ($i = 1; $i <= 4; $i++) { 
                if (!empty($value[$i])) {
                    $permission .= "1";
                } else {
                    $permission .= "0";
                }
            }
            $data = array($params[0], $key, $permission);
            $sql = "INSERT INTO core_permission(role_id, menu_id, permission) VALUES(?,?,?)";
            $this->db->query($sql, $data);
        }
        return TRUE;
    }

    // delete
    function delete_permission($params) {
        $sql = "DELETE FROM core_permission WHERE role_id = ?";
        return $this->db->query($sql, $params);
    }

}
