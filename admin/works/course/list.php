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
		} else go('/admin/works/');
	} else go('/admin/works/');

	$pack = db::query("select * from c_pack where cours_id = '$cours_id'");

	$lesson_id = $_GET['lesson_id'];
	$lesson_d = fun::lesson($lesson_id);


	// filter user all
	if ($_GET['on'] == 1) $work_all = db::query("select * from user where `right` is null and locked is null");
	elseif ($_GET['off'] == 1) $work_all = db::query("select * from user where `right` is null and locked is not null");
	else $work_all = db::query("select * from home_work where lesson_id = '$lesson_id'");
	$page_result = mysqli_num_rows($work_all);

	// page number
	$page = 1; if ($_GET['page'] && is_int(intval($_GET['page']))) $page = (int)$_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	$page = max(1, min((int)$page, (int)$page_all));
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	// filter cours
	if ($_GET['on'] == 1) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");
	elseif ($_GET['off'] == 1) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");
	else $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");


	// Сайттың баптаулары
	$menu_name = 'works';
	$pod_menu_name = 'item';
	$site_set['utop_nm'] = $lesson_d['number'].'. '.$lesson_d['name_'.$lang].' ('.$cours_d['name_'.$lang].') - үй жұмысы';
	$site_set['utop_bk'] = 'homework/admin/cours/?id='.$cours_id;
	$css = ['admin/item', 'admin/works'];
	// $js = [''];
?>
<?php include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="uhwa">
				<div class="uhwa_l">
					<div class="uhwa_c">
						<div class="uhwa_tn">Үй жұмыстардың тізімі:</div>

						<div class="uhwa_cb">
							<?php if (mysqli_num_rows($work)): ?>
								<?php while ($work_d = mysqli_fetch_assoc($work)): ?>
									<?php $user_d = fun::user($work_d['user_id']); ?>
									<a class="uhwa_i" href="../item.php?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&work_id=<?=$work_d['id']?>">
										<div class="uhwa_itm"><i class="fal fa-user"></i></div>
										<div class="uhwa_ic">
											<div class="uhwa_it">
												<div class="uhwa_itcn">
													<?php if ($user_d['name'] && $user_d['name'] != 'USER'): ?> <?=$user_d['name']?> <?=$user_d['surname']?> / <?php endif ?>
													<?=$user_d['phone']?>
												</div>
												<div class="uhwa_itcp"><div><?=date("d-m-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
											</div>
											<div class="uhwa_iw">
												<div class="uhwa_iwc"><?=$work_d['txt']?></div>
											</div>
										</div>
									</a>
								<?php endwhile ?>
							<?php endif ?>
						</div>

						<?php if ($page_all > 1): ?>
							<div class="uc_p">
								<?php if ($page > 1): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page-1?>"><i class="fal fa-long-arrow-left"></i></a> <?php endif ?>
								<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=1">1</a>
								<?php for ($pg = 2; $pg < $page_all; $pg++): ?>
									<?php if ($pg == $page - 1): ?>
										<?php if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <?php endif ?>
										<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a>
									<?php endif ?>
									<?php if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a> <?php endif ?>
									<?php if ($pg == $page + 1): ?>
										<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$pg?>"><?=$pg?></a>
										<?php if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <?php endif ?>
									<?php endif ?>
								<?php endfor ?>
								<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page_all?>"><?=$page_all?></a>
								<?php if ($page < $page_all): ?> <a class="uc_pi" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page+1?>"><i class="fal fa-long-arrow-right"></i></a> <?php endif ?>
							</div>
							<div class="ucours_tr uc_pb">
								<div class="ucours_trn">Бет: <?=$page?>/<?=$page_all?></div>
								<div class="ucours_trnc">
									<a class="ucours_trnci <?=($page>1?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a>
									<a class="ucours_trnci <?=($page<$page_all?'':'ucours_trnci_ds')?>" href="<?=$url?>?id=<?=$cours_id?>&lesson_id=<?=$lesson_id?>&page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a>
								</div>
							</div>
						<?php endif ?>

					</div>

				</div>
			</div>

		</div>
	</div>

<?php include "../../block/footer.php"; ?>