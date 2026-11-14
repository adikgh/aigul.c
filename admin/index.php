<?php include "../config/core_admin.php";

	// Админ панельге тек админ құқығы барлар кіреді, кіру беті ортақ
	if (!$user_id) go('/education/sign.php');
	go('/admin/list/');
