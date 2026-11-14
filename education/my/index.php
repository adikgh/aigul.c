<?php include "../../config/core_edu.php";

	// Қолданушыны тексеру
	if (!$user_id) go('/education/');
	if ($user_right) go('/admin/');
	
	// 
	fun::buy_end_off($user_id);
	
	
	$sub_buy = db::query("select * from c_sub_buy where user_id = '$user_id' and off is null");

	$buy = db::query("select * from c_buy where user_id = '$user_id' and cours_id is not null and off is null ORDER BY ins_dt DESC");
	$buy_off = db::query("select * from c_buy where user_id = '$user_id' and cours_id is not null and off = 1 ORDER BY ins_dt DESC");
	// $item = db::query("select * from c_sub_item where sub_id = '$sub_id' order by number asc");


	// Белсенді курстар бойынша нақты прогресс: көрген сабақ / барлық сабақ
	$active = []; $total_done = 0; $total_all = 0; $min_days = null;
	while ($b = mysqli_fetch_assoc($buy)) {
		$c = fun::cours($b['cours_id']); if (!$c) continue;
		$cid = (int)$b['cours_id']; $pid = (int)$b['pack_id'];
		$where = $pid ? "b.pack_id = '$pid'" : "p.cours_id = '$cid'";
		$ls = db::query("select l.id, l.name_kz, l.number, (select count(*) from c_buy_lesson v where v.lesson_id = l.id and v.user_id = '$user_id' and v.lesson_end = 1) as seen
			from c_lesson l join c_block b on b.id = l.block_id join c_pack p on p.id = b.pack_id
			where $where and (l.arh is null or l.arh = 0) order by b.number asc, l.number asc");
		$all = 0; $done = 0; $next = null;
		while ($l = mysqli_fetch_assoc($ls)) { $all++; if ($l['seen']) $done++; elseif (!$next) $next = $l; }
		$days = $b['end_dt'] ? max(0, (int)floor((strtotime($b['end_dt']) - time()) / 86400)) : null;
		if ($days !== null && ($min_days === null || $days < $min_days)) $min_days = $days;
		$total_done += $done; $total_all += $all;
		$active[] = ['c' => $c, 'b' => $b, 'all' => $all, 'done' => $done, 'next' => $next, 'days' => $days, 'pr' => $all ? round($done * 100 / $all) : 0];
	}
	$total_pr = $total_all ? round($total_done * 100 / $total_all) : 0;
	$continue = null; foreach ($active as $a) if ($a['next']) { $continue = $a; break; }

	// Сатып алынбаған өнімдер — ұсыныс
	$rec = db::query("select * from cours where offer = 1 and id not in (select cours_id from c_buy where user_id = '$user_id' and cours_id is not null) order by number asc limit 3");

	// Сәлемдесу және күн ойы
	$hr = (int)date('G');
	$hello = $hr < 12 ? 'Қайырлы таң' : ($hr < 18 ? 'Қайырлы күн' : 'Қайырлы кеш');
	$quotes = ['Бейсанадан санаға көтерілгенде барлық нәрсенің шешімі пайда болады.', 'Өміріңіз өзгерсін десеңіз, алдымен ойыңызды өзгертіңіз.', 'Сенің қолыңнан бәрі келеді. Тек сол нәрсені жасауға өзіңе рұқсат бер.', 'Мәселенің шешімі көбіне сыртта емес, ішімізде.', 'Өзіңді бар қалпыңда қабылдау — өзгерістің бірінші қадамы.'];
	$quote = $quotes[(int)date('z') % count($quotes)];

	// Сайттың баптаулары
	$menu_name = 'my';
	$site_set['utop_nm'] = 'Менің кабинетім';
	$site_set['um_menu'] = true;
	$site_set['ut_l'] = false;
	$css = ['education/cours', 'aigul_cab'];
?>
<?php include "../block/header.php"; ?>

	<div class="cb">
		<div class="bl_c">

			<!-- сәлемдесу -->
			<div class="cb_hero">
				<div class="cb_hero_t">
					<div class="cb_k"><?=date('d.m.Y')?> · жеке кеңістігіңіз</div>
					<h1><?=$hello?>, <?=e($user['name'])?></h1>
					<p>«<?=$quote?>»</p>
					<?php if ($continue): ?>
						<a class="cb_btn" href="/education/course/lesson/?id=<?=$continue['next']['id']?>">Оқуды жалғастыру <i class="fal fa-arrow-right"></i></a>
					<?php else: ?>
						<a class="cb_btn" href="/#products">Бағдарлама таңдау <i class="fal fa-arrow-right"></i></a>
					<?php endif ?>
				</div>
				<div class="cb_ring" style="--p:<?=$total_pr?>">
					<div><b><?=$total_pr?>%</b><span>жалпы прогресс</span></div>
				</div>
			</div>

			<!-- көрсеткіштер -->
			<div class="cb_kpi">
				<div><i class="fal fa-layer-group"></i><b><?=count($active)?></b><span>белсенді бағдарлама</span></div>
				<div><i class="fal fa-check-circle"></i><b><?=$total_done?></b><span>өтілген сабақ</span></div>
				<div><i class="fal fa-book-open"></i><b><?=max(0, $total_all - $total_done)?></b><span>қалған сабақ</span></div>
				<div><i class="fal fa-hourglass-half"></i><b><?=($min_days === null ? '∞' : $min_days)?></b><span>күн қолжетімді</span></div>
			</div>

			<!-- менің бағдарламаларым -->
			<div class="cb_h"><h2>Менің бағдарламаларым</h2><a href="/#products">Каталог <i class="fal fa-arrow-right"></i></a></div>
			<?php if (!count($active) && !mysqli_num_rows($sub_buy)): ?>
				<div class="cb_empty">
					<i class="fal fa-seedling"></i>
					<h3>Әзірге бағдарлама жоқ</h3>
					<p>Өзіңізге жақын тақырыпты таңдаңыз. Сатып алған соң сабақтар осы жерде ашылады.</p>
					<a class="cb_btn cb_btn_d" href="/#quiz">Өзіме сай бағдарламаны табу</a>
				</div>
			<?php else: ?>
				<div class="cb_list">
					<?php foreach ($active as $a): ?>
						<div class="cb_c">
							<a class="cb_cv" href="/education/course/?id=<?=$a['c']['id']?>" style="background-image:url('/assets/uploads/cours/<?=e($a['c']['img'])?>')">
								<span><?=e(fun::category_name($a['c']['category_id'], $lang))?></span>
							</a>
							<div class="cb_cb">
								<a href="/education/course/?id=<?=$a['c']['id']?>"><h3><?=e($a['c']['name_'.$lang])?></h3></a>
								<div class="cb_pm"><span><?=$a['done']?> / <?=$a['all']?> сабақ</span><b><?=$a['pr']?>%</b></div>
								<div class="cb_pb"><i style="width:<?=$a['pr']?>%"></i></div>
								<div class="cb_cf">
									<?php if ($a['next']): ?>
										<a class="cb_next" href="/education/course/lesson/?id=<?=$a['next']['id']?>"><small>Келесі сабақ</small><b><?=e($a['next']['name_kz'])?></b><i class="fal fa-play"></i></a>
									<?php elseif ($a['all']): ?>
										<div class="cb_next cb_done"><small>Құттықтаймыз!</small><b>Барлық сабақ өтілді</b><i class="fal fa-check"></i></div>
									<?php endif ?>
									<?php if ($a['days'] !== null): ?><div class="cb_days"><i class="fal fa-clock"></i> <?=$a['days']?> күн қалды</div><?php endif ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>

					<?php if (mysqli_num_rows($sub_buy)): ?>
						<?php $club = fun::sub(1); ?>
						<a class="cb_c cb_club" href="/education/club/">
							<div class="cb_cv" style="background-image:url('/assets/uploads/cours/<?=e($club['img'])?>')"><span>Клуб</span></div>
							<div class="cb_cb">
								<h3><?=e($club['name_'.$lang])?></h3>
								<p>Топтық эфирлер, медитациялар және қолдау чаты.</p>
								<div class="cb_next"><small>Клубқа өту</small><b>Жаңа материалдар</b><i class="fal fa-arrow-right"></i></div>
							</div>
						</a>
					<?php endif ?>
				</div>
			<?php endif ?>

			<!-- ұсыныстар және көмек -->
			<div class="cb_two">
				<div>
					<?php if (mysqli_num_rows($rec)): ?>
						<div class="cb_h"><h2>Сізге ұсынамыз</h2></div>
						<div class="cb_rec">
							<?php while ($r = mysqli_fetch_assoc($rec)): ?>
								<a class="cb_ri" href="/cours/item.php?id=<?=$r['id']?>">
									<div class="cb_ri_im" style="background-image:url('/assets/uploads/cours/<?=e($r['img'])?>')"></div>
									<div><b><?=e($r['name_kz'])?></b><small><?=e($r['add_name_kz'])?> · <?=number_format((int)$r['price'], 0, '.', ' ')?> ₸</small></div>
									<i class="fal fa-arrow-right"></i>
								</a>
							<?php endwhile ?>
						</div>
					<?php endif ?>
				</div>
				<div>
					<div class="cb_h"><h2>Көмек керек пе?</h2></div>
					<div class="cb_help">
						<a href="https://wa.me/<?=$site['whatsapp']?>" target="_blank"><i class="fab fa-whatsapp"></i><div><b>Қолдау қызметі</b><small>Сабақ ашылмаса, жазыңыз</small></div></a>
						<a href="https://wa.me/<?=$site['whatsapp']?>?text=<?=rawurlencode('Сәлеметсіз бе! Жеке терапияға жазылғым келеді.')?>" target="_blank"><i class="fal fa-leaf"></i><div><b>Жеке терапия</b><small>Айгүл Асқармен онлайн / оффлайн</small></div></a>
						<a href="/education/acc/"><i class="fal fa-user"></i><div><b>Профиль</b><small>Аты-жөні, телефон, құпия сөз</small></div></a>
					</div>
				</div>
			</div>

			<?php if (mysqli_num_rows($buy_off)): ?>
				<div class="cb_h"><h2>Қолжетімділігі аяқталған</h2></div>
				<div class="cb_off">
					<?php while ($b = mysqli_fetch_assoc($buy_off)): ?>
						<?php $c = fun::cours($b['cours_id']); if (!$c) continue; ?>
						<div class="cb_oi">
							<i class="fal fa-lock"></i>
							<div><b><?=e($c['name_'.$lang])?></b><small><?=($b['end_dt'] ? date('d.m.Y', strtotime($b['end_dt'])).' аяқталды' : 'Аяқталды')?></small></div>
							<a href="https://wa.me/<?=$site['whatsapp']?>?text=<?=rawurlencode('Сәлеметсіз бе! «'.$c['name_kz'].'» курсын ұзартқым келеді.')?>" target="_blank">Ұзарту</a>
						</div>
					<?php endwhile ?>
				</div>
			<?php endif ?>

		</div>
	</div>

<?php include "../block/footer.php"; ?>

	<?php if ($user['name'] == 'Қолданушы' || $user['name'] == 'USER' || $user['name'] == 'Test'): ?>
		<div class="pop_bl user_name_edit_block pop_bl_act">
			<div class="pop_bl_a user_name_edit_back"></div>
			<div class="pop_bl_c">
				<div class="head_c txt_c">
					<h5>Есіміңізді жазыңыз</h5>
				</div>
				<div class="form_c">
					<div class="form_im">
						<input type="text" class="form_txt ubd2_user_name" placeholder="Есіміңізді жазыңыз" data-lenght="2" />
						<i class="fal fa-text form_icon"></i>
					</div>
					<div class="form_im form_im_bn">
						<div class="btn btn_user_name_edit">Сақтау</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>