<?php include "../config/core_edu.php";

	// Бір кіру: админ → админ панель, клиент → жеке кабинет
	if (!$user_id) go('/education/sign.php');
	go(core::home());
