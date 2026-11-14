<?php include "../../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');

	if ($_GET['type'] == 'club') $cours = db::query("select * from c_sub_item");
	else $cours = db::query("select * from cours where	home_work = 1");

	// Сайттың баптаулары
	$menu_name = 'test';
	$site_set = [
		'utop_bk' => '/',
		'utop_nm' => 'Тесттер',
	];
	$css = ['user', 'uhomework'];
	$js = ['user'];
?>
<?php include "../../block/header.php"; ?>



<?php include "../../block/footer.php"; ?>