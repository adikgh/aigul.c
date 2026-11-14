<?php
	// Клиент кабинеті (/education/)

	require_once __DIR__.'/core.php';
	require_once __DIR__.'/smsc_api.php';

	$scss = ['anim', 'norm', 'education/main', 'aigul'];
	$sjs = ['norm', 'education/main'];

	$site_set['cl_wh'] = false;
	$site_set['form'] = false;

	// Қорғау: кабинеттің басқару бөлімдері тек админге ашық
	$_edu_script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
	if (!$user_right && preg_match('~^/education/(course/admin|course/homework/admin|course/item|club/admin|users|my/list\.php)~', $_edu_script)) {
		if (preg_match('~/(get|search)\.php$~', $_edu_script) || !empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			http_response_code(403);
			exit('none');
		}
		go($user_id ? '/education/my/' : '/education/sign.php');
	}
	// Кірмеген адам кабинет беттерін көрмейді (кіру беті мен оның сұраныстарынан басқа)
	if (!$user_id && !preg_match('~^/education/(sign\.php|get\.php|exit\.php|index\.php|acc/all/sign_)~', $_edu_script)) {
		if (preg_match('~/(get|search)\.php$~', $_edu_script) || !empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			http_response_code(403);
			exit('none');
		}
		go('/education/sign.php');
	}
