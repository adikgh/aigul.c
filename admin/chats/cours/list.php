<?php include "../../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$cours_id = $_GET['id'];
		$cours = db::query("select * from cours where id = '$cours_id'");
		if (mysqli_num_rows($cours)) {
			$cours_d = mysqli_fetch_assoc($cours);
			$category = fun::category($cours_d['category_id']);
			$autor = fun::autor($cours_d['autor_id']);
			// $bookmark = fun::bookmark($cours_d['id'], $user_id);
			
		} else go('/admin/');
	} else go('/admin/');
	

	$pack = db::query("select * from c_pack where cours_id = '$cours_id'");

	$lesson_id = $_GET['lesson_id'];
	$lesson_d = fun::lesson($lesson_id);


	// site setting
	$pod_menu_name = 'works';
	$site_set = [
		'utop_nm' => $lesson_d['number'].'. '.$lesson_d['name_'.$lang].' ('.$cours_d['name_'.$lang].') - үй жұмысы',
		'utop_bk' => 'works/',
	];
	$css = ['user', 'uitem', 'uhomework'];
	$js = ['user', 'admin'];

?>
<?php include "../../block/header.php"; ?>

	<div class="uitem">

		<!--  -->
		<div class="uhwa">
			<div class="uhwa_l">
				<div class="uhwa_c">
					<div class="uhwa_tn">Үй жұмыстардың тізімі:</div>

					<div class="uhwa_cb">
						<?php $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit 25"); ?>
						<?php if (mysqli_num_rows($work)): ?>
							<?php while ($work_d = mysqli_fetch_assoc($work)): ?>
								<?php $user_d = fun::user($work_d['user_id']); ?>
								<a class="uhwa_i" href="../item.php/?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&work_id=<?=$work_d['id']?>">
									<div class="uhwa_itm"><i class="fal fa-user"></i></div>
									<div class="uhwa_ic">
										<div class="uhwa_it">
											<div class="uhwa_itcn"><?=$user_d['name']?> <?=$user_d['surname']?></div>
											<div class="uhwa_itcp"><div><?php //=date("m-d-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
										</div>
										<div class="uhwa_iw">
											<div class="uhwa_iwc"><?=$work_d['txt']?></div>
										</div>
									</div>
								</a>
							<?php endwhile ?>
						<?php endif ?>
					</div>

				</div>

			</div>
		</div>
	</div>


<?php include "../../block/footer.php"; ?>