<?php include "../config/core_admin.php";

	// Бөлек админ кіруі жоқ: бәрі бір беттен кіреді
	if ($user_id) go('/admin/');
	go('/education/sign.php');
