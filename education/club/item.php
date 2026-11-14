<?php

	$id = $_GET['id'];
	$cat_id = $_GET['cat'];
	if ($cat_id == 1) go('/education/course/?id='.$id.'&back=club');
	elseif ($cat_id == 3) go('/education/course/?id='.$id.'&back=club');
	elseif ($cat_id == 2) go('/education/masterclass/?id='.$id.'&back=club');