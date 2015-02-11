<?php

class m_user extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insert_id();
    }

    // get user list
    function get_all_user() {
        $sql = "SELECT a.*
            FROM core_user a";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // get user by slug
    function get_user_by_slug($params) {
        $sql = "SELECT a.*
            FROM core_user a
            LEFT JOIN core_role_user c ON c.user_id = a.user_id
            WHERE a.user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // user name validation
    function user_name_validation($params) {
        $sql = "SELECT *
            FROM core_user
            WHERE user_name = ? AND user_id != ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return array();
        }
    }

    // user email validation
    function user_email_validation($params) {
        $sql = "SELECT *
            FROM core_user
            WHERE user_email = ? AND user_id != ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return array();
        }
    }

    // passwrod validation
    function password_validation($params) {
        $sql = "SELECT *
            FROM core_user
            WHERE user_pass = ? AND user_id != ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return array();
        }
    }

    // role user validation
    function role_user_validation($params) {
        $sql = "SELECT *
            FROM core_role_user
            WHERE role_id = ? AND user_id != ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return array();
        }
    }

    // add
    function add_user_profile($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "INSERT INTO core_user(user_full_name, user_address, user_birthday, user_number, creator, dc) VALUES(?,?,?,?,?,'$tanggal')";
        return $this->db->query($sql, $params);
    }

    // add
    function add_user($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "INSERT INTO core_user(user_id, user_name, user_pass, user_email, user_st, creator, dc) VALUES(?,?,?,?,?,?,'$tanggal')";
        return $this->db->query($sql, $params);
    }

    // add
    function add_role_user($params) {
        $sql = "INSERT INTO core_role_user(role_id, user_id) VALUES(?,?)";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_user_profile($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_user SET user_full_name = ?, user_address = ?, user_birthday = ?, user_number = ?, du = '$tanggal' WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_user_picture($params) {
        $sql = "UPDATE core_user SET user_picture = ? WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_user_account($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_user SET user_name = ?, user_email = ?, user_st = ?, du = '$tanggal' WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_role_user($params) {
        $sql = "UPDATE core_role_user SET role_id = ? WHERE role_id = ? AND user_id = ?";
        return $this->db->query($sql, $params);
    }

    // edit
    function edit_user_pass($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_user SET user_pass = ?, du = '$tanggal' WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete
    function delete_user($params) {
        $sql = "DELETE FROM core_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    function delete_user_profile($params) {
        $sql = "DELETE FROM core_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    function delete_user_role($params) {
        $sql = "DELETE FROM core_role_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

}
