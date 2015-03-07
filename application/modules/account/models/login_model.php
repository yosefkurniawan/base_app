<?php

class Login_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // login validtion
    function login_validation($params) {

        $sql = "SELECT a.user_id, d.role_id, d.role_default_url, e.portal_id, a.user_st, a.user_name, a.user_email
            FROM core_user a
            LEFT JOIN core_role_user c ON c.user_id = a.user_id
            LEFT JOIN core_role d ON d.role_id = c.role_id
            LEFT JOIN core_portal e ON e.portal_id = d.portal_id
            WHERE a.user_name = ? AND a.user_pass = ?";

        $query = $this->db->query($sql, $params);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // user Log visit
    function user_log_visit($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "INSERT INTO core_user_log(user_id, ip_address, visit_date) VALUES(?, ?, '$tanggal')";
        if ($this->db->query($sql, $params)) {
            return $tanggal;
        }else{
            return NULL;
        }
    }

    // user Log leave
    function user_log_leave($params) {($params);
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_user_log SET leave_date = '$tanggal' WHERE user_id = ? AND visit_date = ?";
        return $this->db->query($sql, $params);
    }

}
