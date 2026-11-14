<!DOCTYPE html>
<html lang="<?=$lang?>" id="html" class="html">
<head>

	<?php $menu = mysqli_fetch_array(db::query("select * from `site_menu` where name = '$menu_name' and type = 'main'")); ?>
	<?php include 'head.php' ?>
	<?php include 'link.php'; ?>

</head>
<body id="body" class="body">

	<?php // if ($site_set['preloader'] == true) include "preloader.php"; ?>
	
	<?php include "menu.php"; ?>