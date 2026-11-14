<?php include "../../config/core_edu.php";
	
	// Қолданушыны тексеру
	if (!$user_id) go('/education/');

	// Курс деректері
	$sub_id = 1;
	$sub = db::query("select * from c_sub where id = '$sub_id'");
	$sub = mysqli_fetch_assoc($sub);

	// Жазылымды тексеру
	$buy = fun::sub_buy2($sub_id, $user_id);

   // Сайттың баптаулары
	$menu_name = 'club';
	$site_set['utop_nm'] = $sub['name_'.$lang];
	$site_set['utop_bk'] = 'sub/';
	$site_set['um_menu'] = true;
	$css = ['education/main', 'education/cours', 'education/uitem', 'education/club/main'];
	$js = ['education/main'];

	// 
	// if ($buy == 0) go('/club/');
	if ($buy == 0) go('/');

	// 
	$item = db::query("select * from c_sub_item where sub_id = '$sub_id' order by number asc");
	if ($buy != 0 && $buy['open'] != 1) db::query("update `c_sub_buy` set open = 1 where user_id = '$user_id'");

	// 
	$pod_menu_name = 'plan';
	$site_set['utop_nm'] = $sub['name_'.$lang];
	$site_set['utop_bk'] = '';
?>
<?php include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="head_c">
				<h3>Менің клубым</h3>
			</div>

			<?php // include "iheader.php"; ?>

			<!-- <div class="sb_mes1">
				<div class="sb_mes1i">
					<?php include "all/thinking-face.php"; ?>	
				</div>
				<div class="sb_mes1c">
					<div class="sb_mes1ch">Қолдау клубына қош келдіңіз, <span><?=$user['name']?></span> <?=($user['sex']==2?'ханым':'мырза')?>.</div>
					<div class="sb_mes1cp">Біздің телеграм чатымызға қосылып, өзара әңгіме-дүкен құруға болады. <a href="https://t.me/+UY2bOVO-bM5jMTcy">(сілтеме)</a></div>
					<div class="sb_mes1cp">Клуб сабақтары негізінен осы сайтта өтеді.</div>
					<div class="sb_mes1cp">Сонымен қатар қосымша эфирлер үшін инстаграмдағы жабық парақшаға тіркеліңіз. Ол жерге алдымен хат жазамыз. Клубқа тіркелген тел номеріңіз бен атыңыз. Содан соң ғана запрос жібересіз. Дұрыс жасамасаңыз парақшаға қабылданбай қаласыз. <a href="https://instagram.com/damu_club_2022">(сілтеме)</a></div>
					<div class="sb_mes1cp">Егер түсініксіз мәселелер болса төмендегі чатқа жазыңыз</div>
				</div>
			</div> -->

			<!--  -->
			<?php if (mysqli_num_rows($item)): ?>
				<div class="uc_d">
					<?php while ($item_d = mysqli_fetch_assoc($item)): ?>
						<?php if ($item_d['cours_id']) $item_d = array_merge($item_d, fun::cours($item_d['cours_id'])); ?>

						<div class="uc_di">
							<a class="uc_dio <?=(!$item_d['sub_open']?'uc_di_lock':'')?>" <?=(!$item_d['sub_open']?'':'href="item.php?id='.$item_d['id'].'&cat='.$item_d['category_id'].'"')?>>
								<div class="uc_di_img">
									<div class="uc_di_imgc lazy_img" data-src="/assets/uploads/course/<?=$item_d['img']?>"></div>
									<div class="uc_dip">
										<?php if ($item_d['sub_new']): ?><div class="uc_dipi uc_dipi_new">Жаңа</div><?php endif ?>
										<?php if ($item_d['category_id']): ?><div class="uc_dipi"><?=fun::category_name($item_d['category_id'], $lang)?></div><?php endif ?>
										<?php if ($item_d['bonus']): ?><div class="uc_dipi uc_dipi_bonus">Бонус</div><?php endif ?>
									</div>
									<?php if (!$item_d['sub_open']): ?>
										<?php if ($item_d['sub_soon']): ?>
											<div class="uc_di_imgs">Жуырда</div>
										<?php else: ?>
											<div class="uc_di_imgs"><i class="fal fa-lock"></i></div>
										<?php endif ?>
									<?php endif ?>
								</div>
								<div class="uc_dic">
									<?php if ($item_d['format_txt_'.$lang] || $item_d['start_txt_'.$lang] || $item_d['start_dt']): ?>
										<div class="uc_dicm">
											<?php if ($item_d['start_dt'] || $item_d['start_txt_'.$lang]): ?>
												<div class="uc_dicmi"><i class="fal fa-calendar-alt"></i>
													<?php if ($item_d['start_dt']): ?><span>Басталуы: <?=(new DateTime($item_d['start_dt']))->format('d/m/y')?></span>
													<?php else: ?><span><?=$item_d['start_txt_'.$lang]?></span><?php endif ?>
												</div>
											<?php endif ?>
											<?php if ($item_d['format_txt_'.$lang]): ?>
												<div class="uc_dicmi"><i class="fal fa-map-pin"></i><span><?=$item_d['format_txt_'.$lang]?></span></div>
											<?php endif ?>
										</div>
									<?php endif ?>
									<div class="uc_dih"><?=$item_d['name_'.$lang]?></div>
									<div class="uc_din">
										<?php if ($item_d['sub_open']): ?>
										<?php else: ?>
											<div class="uc_did2">
												<?php $autor = fun::autor($item_d['autor_id']); ?>
												<div class="uc_did2_i lazy_img" data-src="/assets/uploads/users/<?=$autor['logo']?>"></div>
												<div class="uc_did2_c">
													<div><?=$autor['name']?></div>
													<?php if (@$autor['specialist_'.$lang]): ?>
														<p><?=$autor['specialist_'.$lang]?></p>
													<?php endif ?>
												</div>
											</div>
										<?php endif ?>
										<?php if ($item_d['sub_open']): ?>
											<div class="btn btn_back uc_din_bcm">
												<span>Бастау</span>
												<i class="fal fa-long-arrow-right"></i>
											</div>
										<?php else: ?>
											<!-- <div class="btn btn_cm btn_dd">
												<i class="fal fa-long-arrow-right"></i>
											</div> -->
										<?php endif ?>
									</div>
								</div>
							</a>
						</div>

					<?php endwhile ?>
				</div>
			<?php endif ?>

		</div>
	</div>

<?php include "../block/footer.php"; ?>