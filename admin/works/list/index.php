<?php include "../../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');
	
	// Курс деректері
	$cours_id = $_GET['cours_id'];
	$cours_d = fun::cours($cours_id);
	if (!$cours_d) go('/admin/works/');
	
	// Пакетті тексеру
	$pack_id = $_GET['pack_id'];
	if ($pack_id) $pack_d = fun::pack($pack_id); else $pack_d = fun::pack_one_work($cours_id); $pack_id = $pack_d['id'];

	// sort
	$sort = $_GET['sort'];
	if (!$sort) $sort = 0;

	//  тексеру
	$lesson_id = $_GET['lesson_id'];
	if ($lesson_id) {
		$lesson_d = fun::lesson($lesson_id);
		$work_all = db::query("select * from home_work where lesson_id = '$lesson_id'");
	} else $work_all = db::query("select * from home_work where pack_id = '$pack_id'");

	// page number
	$page_result = mysqli_num_rows($work_all);
	$page = 1; if ($_GET['page'] && is_int(intval($_GET['page']))) $page = (int)$_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	$page = max(1, min((int)$page, (int)$page_all));
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	
	if ($sort == 1) {
		if ($lesson_id) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt asc limit $page_start, $page_age");
		else $work = db::query("select * from home_work where pack_id = '$pack_id' order by ins_dt asc limit $page_start, $page_age");
	} else {
		if ($lesson_id) $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit $page_start, $page_age");
		else $work = db::query("select * from home_work where pack_id = '$pack_id' order by ins_dt desc limit $page_start, $page_age");
	}


	// Сайттың баптаулары
	$menu_name = 'works';
	$pod_menu_name = 'item';
	$site_set['utop_nm'] = $lesson_d['number'].'. '.$lesson_d['name_'.$lang].' ('.$cours_d['name_'.$lang].') - үй жұмысы';
	$site_set['utop_bk'] = 'homework/admin/cours/?id='.$cours_id;
	$css = ['admin/cours', 'admin/item', 'admin/works'];
	// $js = [''];
?>
<?php include "../../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="head_c">
				<h4><?=$cours_d['name_'.$lang]?> - үй жұмысы</h4>
			</div>

			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm">
						<div class="ucours_tmi">
							<i class="fal fa-sort ucours_tmic"></i>
							<span>Сұрыптау</span>
						</div>
						<div class="menu_c ucours_tma">
							<a class="menu_ci" href="?<?=http_build_query(array_merge($_GET, array("sort" => "0")))?>">
								<div class="menu_cin"><i class="fal fa-circle <?=($sort==0?'fa-dot-circle':'')?>"></i></div>
								<div class="menu_cih">Алдымен жаңаларын</div>
							</a>
							<a class="menu_ci" href="?<?=http_build_query(array_merge($_GET, array("sort" => "1")))?>">
								<div class="menu_cin"><i class="fal fa-circle <?=($sort==1?'fa-dot-circle':'')?>"></i></div>
								<div class="menu_cih">Алдымен бұрынғысын</div>
							</a>
						</div>
					</div>

					<?php $pack2 = db::query("select * from c_pack where cours_id = '$cours_id' and home_work = 1 order by number asc"); ?>
					<?php if (mysqli_num_rows($pack2) > 1): ?>
						<div class="ucours_tm ucours_tm_sel ucours_tm_sel2">
							<?php while ($pack_d = mysqli_fetch_assoc($pack2)): ?>
								<a class="ucours_tmi <?=($pack_id==$pack_d['id']?'ucours_tm_act':'')?>" href="?cours_id=<?=$cours_id?>&pack_id=<?=$pack_d['id']?>"><?=$pack_d['name_'.$lang]?></a>
							<?php endwhile ?>
						</div>
					<?php elseif (mysqli_num_rows($pack2) > 4): ?>  <?php endif ?>

					<div class="ucours_tm">
						<div class="ucours_tmi">Сабақ: <?=($lesson_id?$lesson_d['number'].' '.$lesson_d['name_'.$lang]:'Барлығы')?></div>
						<div class="menu_c ucours_tma">
							<a class="menu_ci <?=(!$lesson_id?'ucours_tm_act':'')?>" href="?cours_id=<?=$cours_id?><?=($_GET['pack_id']?'&pack_id='.$pack_id:'')?>">
								<div class="menu_cin"><i class="fal fa-square"></i></div>
								<div class="menu_cih">Барлығы</div>
							</a>
							<?php $lesson = db::query("select * from c_lesson where pack_id = '$pack_id' order by number asc"); ?>
							<?php if (mysqli_num_rows($lesson)): ?>
								<?php while ($lesson_d = mysqli_fetch_assoc($lesson)): ?>
									<?php if ($lesson_d['home_work']): ?>
										<a class="menu_ci <?=($lesson_id==$lesson_d['id']?'ucours_tm_act':'')?>" href="?<?=http_build_query(array_merge($_GET, array("lesson_id" => $lesson_d['id'])))?>">
											<div class="menu_cin"><i class="fal fa-square"></i></div>
											<div class="menu_cih"><?=$lesson_d['number']?>. <?=$lesson_d['name_'.$lang]?></div>
										</a>
									<?php endif ?>
								<?php endwhile ?>
							<?php endif ?>

						</div>
					</div>

				</div>
			</div>

			<div class="uc_u">
				<!-- <div class="form_im uc_us">
					<input type="text" placeholder="Іздеуді қолданыңыз" class="form_im_txt " />
					<i class="fal fa-search form_icon"></i>
				</div> -->
				<div class="uc_uh">
					<div class="uc_uhn">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_name">Аты-жөні</div>
						<?php if (!$lesson_id): ?> <div class="uc_uh_other">Сабақ</div> <?php endif ?>
						<div class="uc_uh_other">Соңғы жазба</div>
						<div class="uc_uh_other">Уақыты</div>
						<div class="uc_uh_right">Дәреже</div>
					</div>
				</div>
				
				<div class="">
					<div class="uc_uc">
						<?php if (mysqli_num_rows($work)): ?>
							<?php while ($work_d = mysqli_fetch_assoc($work)): ?>
								<?php $number++; $user_d = fun::user($work_d['user_id']); ?>
	
								<div class="uc_ui">
									<a class="uc_uil" href="../item/?id=<?=$work_d['id']?>">
										<div class="uc_ui_number"><?=$number?></div>
										<div class="uc_uiln" >
											<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>"><?=($user_d['logo']!=null?'':'<i class="fal fa-user"></i>')?></div>
											<div class="uc_uinu">
												<div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
												<div class="uc_ui_phone fr_phone"><?=($user_d['phone'] != null?$user_d['phone']:$user_d['mail'])?></div>
											</div>
										</div>
										<?php if (!$lesson_id): ?> <div class="uc_uin_other"><?=fun::lesson_name($work_d['lesson_id'], $lang)?></div> <?php endif ?>
										<div class="uc_uin_other uc_uin_other_txt"><?=(fun::work_item_desc($work_d['id']))['txt']?></div>
										<div class="uc_uin_other"><div class="uhwa_itcp"><div><?=date("d-m-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div></div>
										<div class="uc_ui_right"><?=(!$work_d['view_a']?'Жаңа':'')?></div>
									</a>
								</div>
							<?php endwhile ?>
						
						<?php else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>Ешкім жоқ</p></div> <?php endif ?>
	
					</div>

					<?php if ($page_all > 1): ?>
						<div class="uc_p">
							<?php if ($page > 1): ?> <a class="uc_pi" href="<?=$url_full?>&page=<?=$page-1?>"><i class="fal fa-long-arrow-left"></i></a> <?php endif ?>
							<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="<?=$url_full?>&page=1">1</a>
							<?php for ($pg = 2; $pg < $page_all; $pg++): ?>
								<?php if ($pg == $page - 1): ?>
									<?php if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <?php endif ?>
									<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url_full?>&page=<?=$pg?>"><?=$pg?></a>
								<?php endif ?>
								<?php if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url_full?>&page=<?=$pg?>"><?=$pg?></a> <?php endif ?>
								<?php if ($pg == $page + 1): ?>
									<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="<?=$url_full?>&page=<?=$pg?>"><?=$pg?></a>
									<?php if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <?php endif ?>
								<?php endif ?>
							<?php endfor ?>
							<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="<?=$url_full?>&page=<?=$page_all?>"><?=$page_all?></a>
							<?php if ($page < $page_all): ?> <a class="uc_pi" href="<?=$url_full?>&page=<?=$page+1?>"><i class="fal fa-long-arrow-right"></i></a> <?php endif ?>
						</div>
						<div class="ucours_tr uc_pb">
							<div class="ucours_trn">Бет: <?=$page?>/<?=$page_all?></div>
							<div class="ucours_trnc">
								<a class="ucours_trnci <?=($page>1?'':'ucours_trnci_ds')?>" href="<?=$url_full?>&page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a>
								<a class="ucours_trnci <?=($page<$page_all?'':'ucours_trnci_ds')?>" href="<?=$url_full?>&page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a>
							</div>
						</div>
					<?php endif ?>
				</div>

			</div>

		</div>
	</div>

<?php include "../../block/footer.php"; ?>