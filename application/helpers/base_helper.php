<?php
/*
 * Description :
 * - This file contain base helper functions
 */

// get skin url (current theme)
function skin_url($path = '') {
	$CI =& get_instance();
	return base_url().'skin/'.$CI->config->item('theme').'/'.$path;
}

// get login url
function login_url() {
	return base_url().'account/login/';
}

// get logout url
function logout_url() {
	return base_url().'account/logout/';
}