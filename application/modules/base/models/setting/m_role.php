<?php

class m_role extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get role list
    function get_all_role() {
        $sql = "SELECT * FROM core_role";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // get role by slug
    function get_role_by_slug($params) {
        $sql = "SELECT * FROM core_role WHERE role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // add
    function add_role($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "INSERT INTO core_role(portal_id, role_name, role_desc, role_default_url, role_st, creator, dc) VALUES(?,?,?,?,?,?,'$tanggal')";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_role($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_role SET portal_id = ?, role_name = ?, role_desc = ?, role_default_url = ?, role_st = ?, du = '$tanggal' WHERE role_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete
    function delete_role($params) {
        $sql = "DELETE FROM core_role WHERE role_id = ?";
        return $this->db->query($sql, $params);
    }

}
