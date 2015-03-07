<?php

class Base_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get parent menu
    function get_parent_menu($params) {
        if (!empty($params)) {
            $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_slug, a.menu_url, a.menu_order, a.menu_icon, b.portal_id, c.role_id, 
                SUBSTRING(f.permission,1,1)'inisubstring',
                CASE WHEN SUBSTRING(f.permission,1,1) = 1 THEN 'true' ELSE 'false' END as 'create',
                CASE WHEN SUBSTRING(f.permission,2,1) = 1 THEN 'true' ELSE 'false' END as 'read',
                CASE WHEN SUBSTRING(f.permission,3,1) = 1 THEN 'true' ELSE 'false' END as 'update',
                CASE WHEN SUBSTRING(f.permission,4,1) = 1 THEN 'true' ELSE 'false' END as 'delete'
                FROM core_menu a
                LEFT JOIN core_portal b ON b.portal_id = a.portal_id
                LEFT JOIN core_role c ON c.portal_id = b.portal_id
                LEFT JOIN core_role_user d ON d.role_id = c.role_id
                LEFT JOIN core_user e ON e.user_id = d.user_id
                LEFT JOIN core_permission f ON f.menu_id = a.menu_id AND f.role_id = d.role_id
                WHERE b.portal_id = ? AND c.role_id = ? AND a.parent_id = 0 AND a.menu_st = 'show'
                ORDER BY a.menu_order ASC";
            $query = $this->db->query($sql, $params);
            // echo '<pre>'; print_r($query->result_array());die;
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    // get child menu
    function get_child_menu($params) {
        if (!empty($params)) {
            $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_slug, a.menu_url, a.menu_order, a.menu_icon, b.portal_id, c.role_id, 
                CASE WHEN SUBSTRING(f.permission,1,1) = 1 THEN 'true' ELSE 'false' END as 'create',
                CASE WHEN SUBSTRING(f.permission,2,1) = 1 THEN 'true' ELSE 'false' END as 'read',
                CASE WHEN SUBSTRING(f.permission,3,1) = 1 THEN 'true' ELSE 'false' END as 'update',
                CASE WHEN SUBSTRING(f.permission,4,1) = 1 THEN 'true' ELSE 'false' END as 'delete'
                FROM core_menu a
                LEFT JOIN core_portal b ON b.portal_id = a.portal_id
                LEFT JOIN core_role c ON c.portal_id = b.portal_id
                LEFT JOIN core_role_user d ON d.role_id = c.role_id
                LEFT JOIN core_user e ON e.user_id = d.user_id
                LEFT JOIN core_permission f ON f.menu_id = a.menu_id AND f.role_id = d.role_id
                WHERE a.parent_id = ? AND d.role_id = ?
                -- GROUP BY a.menu_id
                ORDER BY menu_order ASC";
            $query = $this->db->query($sql, $params);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } else {
            return false;
        }
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
