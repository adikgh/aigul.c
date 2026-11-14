<?php include "../../../config/core_edu.php";

	// Бір ғана сабақ беті бар: /education/lesson/
	go('/education/lesson/?id='.(int)@$_GET['id']);
