<?php

class Base_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get display page id
    function get_display_page_id($params) {
        $menu_url = "IF(RIGHT(a.menu_url,1) = '/', IF(LEFT(a.menu_url,1) = '/', a.menu_url, CONCAT('/', a.menu_url)), CONCAT(IF(LEFT(a.menu_url,1) = '/', a.menu_url, CONCAT('/', a.menu_url)), '/'))";
        $sql = "SELECT a.menu_id, a.menu_name, $menu_url as menu_url
            FROM core_menu a
            WHERE $menu_url = '$params'";
        $query = $this->db->query($sql, $params);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    // get user auth
    function get_user_auth($params) {
        $sql = "SELECT *
            FROM core_permission
            WHERE role_id = ? AND menu_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
