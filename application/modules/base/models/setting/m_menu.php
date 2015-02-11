<?php

class m_menu extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get all menu default
    function get_all_menu_default($params) {
        $sql = "SELECT * FROM core_menu";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // get all menu
    function get_all_menu($params) {
        $sql = "SELECT * FROM core_menu WHERE parent_id = 0 AND portal_id = ? ORDER BY menu_order ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $x = 0;
            foreach ($query->result_array() as $data) {
                $temp[$x] = array(
                    'menu_id'       => $data['menu_id'],
                    'portal_id'     => $data['portal_id'],
                    'parent_id'     => $data['parent_id'],
                    'menu_name'     => $data['menu_name']
                );
                $sql = "SELECT * FROM core_menu WHERE parent_id = ? ORDER BY menu_order ASC";
                $query = $this->db->query($sql, $data['menu_id']);
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $result) {
                        $temp[$x]['detail'][] = array(
                            'menu_id'       => $result['menu_id'],
                            'portal_id'     => $result['portal_id'],
                            'parent_id'     => $result['parent_id'],
                            'menu_name'     => $result['menu_name']
                        );
                    }
                }
                $x++;
            }
            return $temp;
        } else {
            return array();
        }
    }

    // get menu by portal
    function get_all_menu_by_portal($params) {
        $sql = "SELECT * FROM core_menu WHERE parent_id = 0 AND portal_id = ? ORDER BY menu_order ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $x = 0;
            foreach ($query->result_array() as $data) {
                $temp[$x] = array(
                    'menu_id'       => $data['menu_id'],
                    'portal_id'     => $data['portal_id'],
                    'parent_id'     => $data['parent_id'],
                    'menu_name'     => $data['menu_name'],
                    'menu_desc'     => $data['menu_desc'],
                    'menu_slug'     => $data['menu_slug'],
                    'menu_order'    => $data['menu_order']
                );
                $sql = "SELECT * FROM core_menu WHERE parent_id = ? ORDER BY menu_order ASC";
                $query = $this->db->query($sql, $data['menu_id']);
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $result) {
                        $temp[$x]['detail'][] = array(
                                'menu_id'       => $result['menu_id'],
                                'portal_id'     => $result['portal_id'],
                                'parent_id'     => $result['parent_id'],
                                'menu_name'     => $result['menu_name'],
                                'menu_desc'     => $result['menu_desc'],
                                'menu_slug'     => $result['menu_slug'],
                                'menu_order'    => $result['menu_order']
                        );
                    }
                }
                $x++;
            }
            return $temp;
        } else {
            return array();
        }
    }

    // get menu by portal role
    function get_all_menu_by_portal_role($params) {
        $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_url, a.menu_order, b.role_id, b.permission
            FROM core_menu a
            LEFT JOIN core_permission b ON b.menu_id = a.menu_id AND b.role_id = ?
            WHERE a.parent_id = 0 AND a.portal_id = ?
            ORDER BY a.menu_order";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $x = 0;
            foreach ($query->result_array() as $data) {
                $temp[$x] = array(
                    'menu_id'       => $data['menu_id'],
                    'portal_id'     => $data['portal_id'],
                    'parent_id'     => $data['parent_id'],
                    'menu_name'     => $data['menu_name'],
                    'permission'    => $data['permission']
                );
                $params = array($params[0], $data['menu_id']);
                $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_url, a.menu_order, b.role_id, b.permission
                    FROM core_menu a
                    LEFT JOIN core_permission b ON b.menu_id = a.menu_id AND b.role_id = ?
                    WHERE a.parent_id = ?
                    ORDER BY a.menu_order ASC";
                $query = $this->db->query($sql, $params);
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $result) {
                        $temp[$x]['detail'][] = array(
                                'menu_id'       => $result['menu_id'],
                                'portal_id'     => $result['portal_id'],
                                'parent_id'     => $result['parent_id'],
                                'menu_name'     => $result['menu_name'],
                                'permission'    => $result['permission']
                        );
                    }
                }
                $x++;
            }
            return $temp;
        } else {
            return array();
        }
    }

    // get menu by slug
    function get_menu_by_slug($params) {
        $sql = "SELECT * FROM core_menu WHERE menu_slug = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // add menu
    function add_menu($params) {
        $tanggal = date('Y-m-d h:i:s');        
        $sql = "INSERT INTO core_menu(portal_id, parent_id, menu_name, menu_slug, 
            menu_desc, menu_url, menu_order, menu_icon, creator, dc) 
        VALUES(?,?,?,?,?,?,?,?,?,'$tanggal')";
        return $this->db->query($sql, $params);
    }

    // edit menu
    function edit_menu($params) {
        $tanggal = date('Y-m-d h:i:s');
        $sql = "UPDATE core_menu SET parent_id = ?, menu_name = ?, menu_slug = ?, 
        menu_desc = ?, menu_url = ?, menu_order = ?, menu_icon = ?, du = '$tanggal' WHERE menu_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete menu
    function delete_menu($params) {
        $sql = "DELETE FROM core_menu WHERE menu_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete menu
    function delete_menu_permission($params) {
        $sql = "DELETE FROM core_permission WHERE menu_id = ?";
        return $this->db->query($sql, $params);
    }

}
