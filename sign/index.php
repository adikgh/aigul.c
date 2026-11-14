<?php
	// Қысқа сілтеме: /sign/ → кіру беті
	header('Location: /education/sign.php' . (!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : ''));
	exit();
