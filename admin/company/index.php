<?php include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');

	// Сайттың баптаулары
	$menu_name = 'company';
	// $site_set = [
	// 	'header' => 'user',
	// 	'footer' => 'false',
	// 	'ublock' => 'true',
	// 	'utop_nm' => 'Сұрақ-жауап (aнкета)',
   //    'um_menu' => 'true',
	// ];
	$css = ['admin/acc'];
	// $js = [];
?>
<?php include "../block/header.php"; ?>

	

<?php include "../block/footer.php"; ?>