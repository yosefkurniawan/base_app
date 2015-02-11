<?php

class m_portal extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get portal list
    function get_all_portal() {
        $sql = "SELECT * FROM core_portal";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // get portal by slug
    function get_portal_by_slug($params) {
        $sql = "SELECT * FROM core_portal WHERE portal_slug = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // add
    function add_portal($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "INSERT INTO core_portal(portal_name, portal_slug, portal_title, portal_desc, creator, dc) VALUES(?,?,?,?,?,'$tanggal')";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_portal($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_portal SET portal_name = ?, portal_slug = ?, portal_title = ?, portal_desc = ?, du = '$tanggal' WHERE portal_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete
    function delete_portal($params) {
        $sql = "DELETE FROM core_portal WHERE portal_id = ?";
        return $this->db->query($sql, $params);
    }

}
