<?php if (!class_exists("core")) { http_response_code(404); exit; } ?><?php

	$id = $_GET['id'];
	$cat_id = $_GET['cat'];
	go('/admin/');