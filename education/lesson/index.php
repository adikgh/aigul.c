<?php include "../../config/core_edu.php";

	if (!$user_id) go('/education/');

	$lesson_id = (int)@$_GET['id'];
	$lesson = db::query("select * from c_lesson where id = '$lesson_id'");
	if (!$lesson_id || !mysqli_num_rows($lesson)) go('/education/my/');

	$lesson_d = mysqli_fetch_assoc($lesson);
	$block_id = $lesson_d['block_id'];
	$pack_id = fun::pack_block($block_id);
	$pack = fun::pack($pack_id);
	$cours_id = fun::cours_pack($pack_id);
	$cours_d = fun::cours($cours_id);

	// Қолжетімділік: тек админ немесе курсты сатып алған клиент
	if (!$user_right && (!$lesson_d['open'] || !fun::user_buy($cours_id, $user_id))) go('/education/course/?id='.$cours_id);
	if ($pack['private_link']) {
		if ($lesson_d['site']) go('/education/course/'.$lesson_d['site'].'?id='.$lesson_id);
		else go('/education/course/'.$pack['private_link'].'/lesson.php?id='.$lesson_id);
	} elseif ($lesson_d['site']) go('/education/course/lesson/all/'.$lesson_d['site'].'?id='.$lesson_id);

	$autor = fun::autor($cours_d['autor_id']);

	// Сабақты көрді деп белгілеу
	$sub_info = db::query("select * from c_buy_lesson where lesson_id = '$lesson_id' and user_id = '$user_id'");
	if (mysqli_num_rows($sub_info)) {
		$sub_info_d = mysqli_fetch_array($sub_info);
		db::query("UPDATE `c_buy_lesson` SET `upd_dt` = '$datetime', `lesson_view` = 1 where lesson_id = '$lesson_id' and user_id = '$user_id'");
		if (!$sub_info_d['lesson_stage']) $sub_info_d['lesson_stage'] = 1;
	} else {
		db::query("INSERT INTO `c_buy_lesson`(`lesson_id`, `user_id`, `lesson_view`) VALUES ('$lesson_id', '$user_id', 1)");
		$sub_info_d = ['lesson_stage' => 1, 'lesson_end' => 0];
	}

	// Курстың барлық сабақтары (модуль → сабақ ретімен)
	$all = [];
	$q = db::query("select l.id, l.name_kz, l.number, l.open, b.number as bnum, b.id as bid
		from c_lesson l join c_block b on b.id = l.block_id
		where b.pack_id = '$pack_id' order by b.number asc, l.number asc");
	while ($r = mysqli_fetch_assoc($q)) $all[] = $r;

	$st = [];
	$q = db::query("select lesson_id, lesson_view, lesson_end from c_buy_lesson where user_id = '$user_id'");
	while ($r = mysqli_fetch_assoc($q)) $st[$r['lesson_id']] = $r;

	// «Сабақты аяқтау»
	$pos = 0; $next_id = 0; $prev_id = 0;
	foreach ($all as $i => $r) if ($r['id'] == $lesson_id) $pos = $i;
	for ($i = $pos + 1; $i < count($all); $i++) if ($all[$i]['open']) { $next_id = $all[$i]['id']; break; }
	for ($i = $pos - 1; $i >= 0; $i--) if ($all[$i]['open']) { $prev_id = $all[$i]['id']; break; }

	if (isset($_POST['lesson_done'])) {
		db::query("UPDATE `c_buy_lesson` SET `lesson_end` = 1, `upd_dt` = '$datetime' where lesson_id = '$lesson_id' and user_id = '$user_id'");
		go($next_id ? '/education/lesson/?id='.$next_id : '/education/course/?id='.$cours_id);
	}

	$done = 0;
	foreach ($all as $r) if (@$st[$r['id']]['lesson_end']) $done++;
	$pct = count($all) ? round($done * 100 / count($all)) : 0;
	$is_done = !empty($st[$lesson_id]['lesson_end']);

	// Модуль нөмірі
	$mod = 0; $mods = [];
	foreach ($all as $r) if (!isset($mods[$r['bid']])) $mods[$r['bid']] = count($mods) + 1;
	$mod = @$mods[$block_id];
	$num = $pos + 1;

	// Сабақ мазмұны
	$items = []; $video = null;
	$q = db::query("select * from c_lesson_item where lesson_id = '$lesson_id' order by number asc");
	while ($r = mysqli_fetch_assoc($q)) {
		if ($r['type'] == 'video' && !$video) $video = $r;
		else $items[] = $r;
	}

	// Беттің баптаулары
	$menu_name = 'lesson';
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = $lesson_d['name_'.$lang];
	$site_set['utop_bk'] = 'course/?id='.$cours_id;
	$site_set['plyr'] = true;
	$css = ['education/lesson', 'aigul_lesson'];
?>
<?php include "../block/header.php"; ?>

	<div class="ls">
		<div class="bl_c">

			<div class="ls_nav">
				<a href="/education/my/">Менің курстарым</a>
				<i class="fal fa-angle-right"></i>
				<a href="/education/course/?id=<?=$cours_id?>"><?=e($cours_d['name_'.$lang])?></a>
			</div>

			<div class="ls_g">
				<div class="ls_main">

					<div class="ls_video">
						<?php if ($video): ?>
							<div class="player_<?=$video['id']?>" data-plyr-provider="<?=e($video['type_video'])?>" data-plyr-embed-id="<?=e($video['txt'])?>"></div>
							<script> new Plyr(".player_<?=$video['id']?>", { fullscreen: {iosNative: true}, controls: ['play-large', 'play', 'current-time', 'progress', 'fullscreen'] }); </script>
						<?php else: ?>
							<div class="ls_ph">
								<i class="fal fa-play"></i>
								<b><?=e($lesson_d['name_'.$lang])?></b>
								<span>Видео жақында қосылады</span>
							</div>
						<?php endif ?>
					</div>

					<div class="ls_card">
						<div class="ls_k">Модуль <?=$mod?> · Сабақ <?=$num?></div>
						<h1><?=e($lesson_d['name_'.$lang])?></h1>
						<?php if ($autor): ?>
							<div class="ls_au">
								<span class="lazy_img" data-src="/assets/uploads/users/<?=e($autor['logo'])?>"><?=mb_substr($autor['name'], 0, 1)?></span>
								<div><b><?=e($autor['name'].' '.$autor['surname'])?></b><small>Психосоматолог, психолог</small></div>
							</div>
						<?php endif ?>

						<?php if ($items): ?>
							<div class="ls_body lsb">
								<div class="lsb_c" data-lesson-id="<?=$lesson_id?>">
									<?php foreach ($items as $sql): ?>
										<?php if ($sql['type'] == 'txt' || $sql['type'] == 'txt_warning'): include "txt.php"; ?>
										<?php elseif ($sql['type'] == 'video'): include "video.php"; ?>
										<?php elseif ($sql['type'] == 'mat'): include "file.php"; ?>
										<?php elseif ($sql['type'] == 'link'): include "link.php"; ?>
										<?php elseif ($sql['type'] == 'test'): include "test.php"; endif ?>
										<?php $data_number = $sql['number']; ?>
									<?php endforeach ?>
								</div>
							</div>
						<?php elseif (!$video): ?>
							<p class="ls_empty">Сабақтың мазмұны әлі қосылмаған.</p>
						<?php endif ?>

						<div class="ls_act">
							<?php if (!$is_done): ?>
								<form method="post"><button class="ls_btn" name="lesson_done" value="1"><i class="fal fa-check"></i> Сабақты аяқтау</button></form>
							<?php elseif ($next_id): ?>
								<a class="ls_btn" href="/education/lesson/?id=<?=$next_id?>">Келесі сабақ <i class="fal fa-long-arrow-right"></i></a>
							<?php else: ?>
								<span class="ls_ok"><i class="fal fa-check-circle"></i> Сабақ аяқталды</span>
							<?php endif ?>
							<?php if ($lesson_d['home_work']): ?><a class="ls_btn2" href="#work">Тапсырмаға өту <i class="fal fa-long-arrow-down"></i></a><?php endif ?>
						</div>
					</div>

					<?php if ($lesson_d['home_work']): ?>
						<div class="ls_card ls_extra" id="work">
							<div class="ls_k">Тапсырма</div>
							<?php include "work.php"; ?>
						</div>
					<?php endif ?>
					<?php if ($lesson_d['ques']): ?>
						<div class="ls_card ls_extra">
							<div class="ls_k">Кері байланыс</div>
							<?php include "ques.php"; ?>
						</div>
					<?php endif ?>

					<div class="ls_pn">
						<?php if ($prev_id): ?><a href="/education/lesson/?id=<?=$prev_id?>"><i class="fal fa-long-arrow-left"></i> Алдыңғы сабақ</a><?php else: ?><span></span><?php endif ?>
						<?php if ($next_id): ?><a href="/education/lesson/?id=<?=$next_id?>">Келесі сабақ <i class="fal fa-long-arrow-right"></i></a><?php endif ?>
					</div>
				</div>

				<aside class="ls_side">
					<div class="ls_k"><?=e($cours_d['name_'.$lang])?></div>
					<h2>Сабақтар жоспары</h2>
					<div class="ls_bar"><i style="width:<?=$pct?>%"></i></div>
					<div class="ls_barn"><?=$pct?>% аяқталды · <?=$done?> / <?=count($all)?> сабақ</div>

					<div class="ls_list">
						<?php foreach ($all as $i => $r): ?>
							<?php
								$s = @$st[$r['id']];
								$cls = $r['id'] == $lesson_id ? 'ls_li_act' : '';
								if (!$r['open']) { $cls .= ' ls_li_lock'; $lbl = '<i class="fal fa-lock"></i> Жабық'; }
								elseif (!empty($s['lesson_end'])) { $cls .= ' ls_li_done'; $lbl = '<i class="fal fa-check"></i> Аяқталған'; }
								elseif (!empty($s['lesson_view'])) $lbl = '<i class="fal fa-eye"></i> Ашылған';
								else $lbl = '<i class="fal fa-circle"></i> Өтілмеген';
							?>
							<a class="ls_li <?=$cls?>" <?=($r['open'] ? 'href="/education/lesson/?id='.$r['id'].'"' : '')?>>
								<em><?=$i + 1?>.</em>
								<div><b><?=e($r['name_kz'])?></b><small><?=$lbl?></small></div>
								<i class="fal fa-angle-right"></i>
							</a>
						<?php endforeach ?>
					</div>
				</aside>
			</div>

		</div>
	</div>

<?php include "../block/footer.php"; ?>
