<?php include "../../../config/core_admin.php";

	// site setting
	$menu_name = 'faq';
	$site_set = [
      'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Авторлық құқық',
	];
	$css = ['user', 'faq'];
	$js = ['user'];

?>
<?php include "../../block/header.php"; ?>
<?php include "../../../all/about/faq/privacy_t.php"; ?>
<?php include "../../block/footer.php"; ?>