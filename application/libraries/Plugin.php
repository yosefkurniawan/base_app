<?php
/**
 *
 * Plugin (CSS & JS) for CodeIgniter
 *
 * Author     : Jojo
 * Date       : 2015-02-11
 * Description: 
 * - This class is used to call all neccesary plugins
 *
 */

class Plugin {
  	public $plugin		= array();
  	public $plugin_js  	= '';
  	public $plugin_css  = '';

  	// $plugin_name is delimited with comma
	public add($plugin_name) {
		$_plugins = explode(',', $plugin_name);
		foreach ($_plugins as $plugin) {
			$plugin = trim($plugin);
		}

		$this->plugin = $_plugins;
	}

	public get_plugin_js() {
		foreach ($this->plugin as $plugin) {
			switch ($plugin) {
				case 'datatable':
					$this->plugin_js .= 
					break;
				
				default:
					# code...
					break;
			}
		}
	}