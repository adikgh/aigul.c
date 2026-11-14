<!DOCTYPE html>
<html lang="<?=$lang?>" id="html" class="html" ver="<?=$ver?>">
<head>

	<?php $menu = mysqli_fetch_array(db::query("select * from `site_menu` where name = '$menu_name' and type = 'edu'")); ?>
	<?php include dirname(__FILE__).'/../../block/head.php'; ?>
	<?php include dirname(__FILE__).'/../../block/link.php'; ?>

</head>
<body id="body" class="body">

	<?php // include "preloader.php"; ?>
	
	<?php include "menu.php"; ?>