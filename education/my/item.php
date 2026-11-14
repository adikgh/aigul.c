<?php include "../../config/core_edu.php";

	$id = (int)@$_GET['id'];
	go('/education/course/?id='.$id);
