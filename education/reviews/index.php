<?php include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) go('/education/');

	// Сайттың баптаулары
	$menu_name = 'reviews';
	$site_set['utop_nm'] = 'Пікірлерім';
	// $css = [''];
	// $js = [''];
?>
<?php include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="ds_nr"><i class="fal fa-ghost"></i><p>Бұл бет жасалуда</p></div>

		</div>
	</div>

<?php include "../block/footer.php"; ?>