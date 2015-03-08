<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules_model extends CI_Model {
	
	public function get_modules_list() {

		// $xml = simplexml_load_file(APPPATH . '/config/modules.xml');
		// $module_list = json_decode(json_encode($xml), TRUE);

		$sql_modul = "SELECT * FROM core_modules WHERE parent_id = 0 OR ISNULL(parent_id)";
		$modul = $this->db->query($sql_modul)->result_array();

		foreach ($modul as $key => $value) {
			$parent_id = $value['module_id'];
			$sql_submodul = "SELECT * FROM core_modules 
							WHERE parent_id != 0 AND !ISNULL(parent_id) 
							AND parent_id = $parent_id";
			$submodul = $this->db->query($sql_submodul)->result_array();

			$modul[$key]['sub_module'] = $submodul;
		}

		return $modul;
	}

	public function save() {
		$id 	= $this->input->post('id');
		$value 	= $this->input->post('value');

		$data = array(
			'module_st' => $value
		);
		
		$this->db->where('module_id', $id);
		return $this->db->update('core_modules', $data);
		

	}

}