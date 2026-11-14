<?php
	// Админ панель (/admin/)

	require_once __DIR__.'/core.php';
	require_once __DIR__.'/smsc_api.php';

	// Админ құқығы жоқ қолданушы админ панельде «кірмеген» болып саналады
	if (!$user_right) {
		$user = array();
		$user_id = null;
		$user_super_right = null;
	}

	$site_set = [
		'analitics' => false,
		'header' => true,
		'menu' => true,
		'utop' => true,
		'um_menu' => true,
		'swiper' => false,
		'plyr' => false,
		'aos' => false,
		'autosize' => false,
		'mheader' => false,
	];
	$scss = ['norm', 'admin/main', 'aigul', 'aigul_admin'];
	$sjs = ['norm', 'admin/main'];
	$css = []; $js = [];

	// Қорғау: админ құқығы жоқ адам админ панельдің ешбір бетін (get.php-ді де) аша алмайды
	$_adm_script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
	if (!$user_id && !in_array($_adm_script, ['/admin/sign.php', '/admin/exit.php', '/admin/index.php'])) {
		if (preg_match('~/(get|search)\.php$~', $_adm_script) || !empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			http_response_code(403);
			exit('none');
		}
		go('/education/sign.php');
	}
