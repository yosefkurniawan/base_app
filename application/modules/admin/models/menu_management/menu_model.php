<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    // Start: customize CRUD parameters
    private $table = 'core_menu';
    private $id         = 'menu_id';
    // End: customize CRUD parameters

    function __construct() {
        parent::__construct();
    }

    /* Save new data */
    function save() {
        $inputs = $this->input->post();
        $data = $inputs;
        unset($data['action']);
        unset($data['menu_id']);

        $data['menu_order'] = $this->get_new_order($data['parent_id']);

        // get latest order number of current parent
        if ($this->db->insert($this->table, $data)) {
            // success
            $this->message->addSuccess('Data berhasil disimpan.');
            $result['success'] = true;
        }else{
            // error: unknown
            $this->message->addError('Terjadi galat saat menyimpan data.');
            $result['success'] = false;
        }
        
        $result['message'] = $this->message->render();
        return $result;
    }

    /* save edited data */
    function update() {
        $inputs = $this->input->post();
        $id     = $inputs['menu_id'];
        $data = $inputs;
        unset($data['action']);
        unset($data['menu_id']);

        // get menu
        $old_data       = $this->get_menu($id);
        $old_parent_id  = $old_data->parent_id;

        if ($old_parent_id != $data['parent_id']) {
            $data['menu_order'] = $this->get_new_order($data['parent_id']);
        }

        $this->db->where($this->id, $id);
        if ($this->db->update($this->table, $data)){
            // success
            $this->message->addSuccess('Data berhasil disimpan.');
            $result['success'] = true;
        }else{
            // error: unknown
            $this->message->addError('Terjadi galat saat menyimpan data.');
            $result['success'] = false;
        }

        $result['message'] = $this->message->render();
        return $result;
    }

    /* delete data */
    function delete() {
        $id  = $this->input->post('id');

        $this->db->where($this->id, $id);
        $this->db->or_where('parent_id', $id); 
        if ($this->db->delete($this->table)) {
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
                WHERE b.portal_id = ? AND c.role_id = ? AND a.parent_id = 0 AND a.menu_st = 'active'
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
                AND a.menu_st = 'active'
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


    // get parent menu with no filter
    function get_parent_menu_all() {
        $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_slug, a.menu_url, a.menu_order, a.menu_icon, b.portal_id
            FROM core_menu a
            LEFT JOIN core_portal b ON b.portal_id = a.portal_id
            WHERE a.parent_id = 0
            ORDER BY a.menu_order ASC";
        $query = $this->db->query($sql);
        // echo '<pre>'; print_r($query->result_array());die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // get child menu with no filter
    function get_child_menu_all($params) {
        $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_slug, a.menu_url, a.menu_order, a.menu_icon, b.portal_id
            FROM core_menu a
            LEFT JOIN core_portal b ON b.portal_id = a.portal_id
            WHERE a.parent_id = ?
            ORDER BY menu_order ASC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // get all menu in flat array
    function get_all() {
        $sql = "SELECT a.menu_id, a.portal_id, a.parent_id, a.menu_name, a.menu_slug, a.menu_url, a.menu_order, a.menu_icon, b.portal_id
            FROM core_menu a
            LEFT JOIN core_menu ab ON a.parent_id = ab.menu_id
            LEFT JOIN core_portal b ON b.portal_id = a.portal_id
            ORDER BY menu_order ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // submit new order
    function submit_order() {
        $data       = $this->input->post('data');
        $this->save_order_iteration($data, 0);
    }

    private function save_order_iteration($data, $parent_id) {
        
        foreach ($data as $key => $value) {
            $new_menu_order = $key + 1;
            $new_parent_id = $parent_id;

            $this->db->where('menu_id', $value['key']);
            $this->db->update($this->table, array('parent_id'=>$parent_id,'menu_order'=>$new_menu_order));

            if (isset($value['children'][0])) {
                $this->save_order_iteration($value['children'],$value['key']);
            }
        }

        return $result;
    }

    private function get_menu_depth($array, $n = 0) {
        $max_depth = 1;
        foreach ($array as $value) {
            if (isset($value['children'][0])) {
                $depth = $this->get_menu_depth($value['children']) + 1;
                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }
        return $max_depth;
    }

    // get order number by id
    function get_order($id) {
        $this->db->where('menu_id', $id);
        $res = $this->db->get($this->table);
        if ($res->num_rows() > 0) {
            return $res->row()->menu_order;
        }else{
            return 'root';
        }
    }

    // get new order number
    function get_new_order($parent_id) {
        $sql = "SELECT MAX(menu_order)+1 as new_order FROM core_menu
        WHERE parent_id = $parent_id";

        $query = $this->db->query($sql);
        return $query->row()->new_order;
    }

    // get a menu
    function get_menu($menu_id) {
        $this->db->where('menu_id', $menu_id);
        $res = $this->db->get($this->table);
        if ($res->num_rows() > 0) {
            return $res->row();
        }else{
            return array();
        }
    }
}
?>
