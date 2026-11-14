<?php include "../../config/core_admin.php";

	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');

	// Өнімдер және олардың көрсеткіштері
	$cours = db::query("select c.*,
		(select count(*) from c_lesson l where l.cours_id = c.id) as ls_cnt,
		(select count(distinct b.user_id) from c_buy b where b.cours_id = c.id) as st_cnt,
		(select count(distinct b.user_id) from c_buy b where b.cours_id = c.id and (b.end_dt is null or b.end_dt > now())) as act_cnt
		from cours c ORDER BY c.ins_dt DESC");
	$items = []; $cats = [];
	while ($r = mysqli_fetch_assoc($cours)) {
		$r['pack'] = fun::pack_one($r['id']);
		$r['cat'] = fun::category_name($r['category_id'], $lang);
		if ($r['cat']) $cats[$r['category_id']] = $r['cat'];
		$items[] = $r;
	}
	$k_students = mysqli_fetch_row(db::query("select count(distinct user_id) from c_buy"))[0];
	$k_lessons = mysqli_fetch_row(db::query("select count(*) from c_lesson"))[0];
	$k_sum = mysqli_fetch_row(db::query("select coalesce(sum(coalesce(nullif(p.price_sole,0), p.price)),0) from c_buy b join c_pack p on p.id = b.pack_id"))[0];

	// Сайттың баптаулары
	$menu_name = 'list';
	$pod_menu_name = 'all';
	$site_set['utop_nm'] = 'Өнімдер';
	$site_set['um_menu'] = true;
	$site_set['utop'] = false;
	$css = ['admin/cours', 'aigul_products'];
	$js = ['admin/cours'];
?>
<?php include "../block/header.php"; ?>

	<div class="ap">
		<div class="bl_c">

			<div class="ap_head">
				<div>
					<div class="ap_k">Әкімші панелі</div>
					<h1>Өнімдер</h1>
					<p><?=count($items)?> өнім · <?=$k_students?> оқушы</p>
				</div>
				<div class="ap_add cours_add_pop"><i class="fal fa-plus"></i> Өнім қосу</div>
			</div>

			<div class="ap_kpi">
				<div><i class="fal fa-layer-group"></i><b><?=count($items)?></b><span>Өнімдер</span></div>
				<div><i class="fal fa-user-friends"></i><b><?=$k_students?></b><span>Оқушылар</span></div>
				<div><i class="fal fa-play-circle"></i><b><?=$k_lessons?></b><span>Сабақтар</span></div>
				<div><i class="fal fa-wallet"></i><b class="fr_price"><?=$k_sum?></b><span>Сатылым сомасы</span></div>
			</div>

			<div class="ap_bar">
				<div class="ap_search"><i class="fal fa-search"></i><input type="text" placeholder="Өнімді іздеу" oninput="apFilter()" id="ap_q"></div>
				<div class="ap_chips">
					<span class="act" data-cat="0" onclick="apCat(this)">Барлығы</span>
					<?php foreach ($cats as $cid => $cn): ?><span data-cat="<?=$cid?>" onclick="apCat(this)"><?=e($cn)?></span><?php endforeach ?>
				</div>
			</div>

			<div class="ap_list">
				<?php foreach ($items as $c): $pk = $c['pack']; ?>
					<div class="ap_i" data-cat="<?=$c['category_id']?>" data-name="<?=e(mb_strtolower($c['name_'.$lang]))?>">
						<a class="ap_im" href="/admin/course/?id=<?=$c['id']?>&cat=<?=$c['category_id']?>" style="background-image:url('/assets/uploads/course/<?=e($c['img'])?>')"></a>
						<div class="ap_in">
							<?php if ($c['cat']): ?><span class="ap_cat"><?=e($c['cat'])?></span><?php endif ?>
							<a href="/admin/course/?id=<?=$c['id']?>&cat=<?=$c['category_id']?>"><h3><?=e($c['name_'.$lang])?></h3></a>
							<div class="ap_meta">
								<span><i class="fal fa-play-circle"></i> <?=$c['ls_cnt']?> сабақ</span>
								<span><i class="fal fa-user"></i> <?=$c['st_cnt']?> оқушы</span>
								<span><i class="fal fa-bolt"></i> <?=$c['act_cnt']?> белсенді</span>
							</div>
						</div>
						<div class="ap_pr">
							<?php if ($pk['price_sole']): ?>
								<s class="fr_price"><?=$pk['price']?></s><b class="fr_price"><?=$pk['price_sole']?></b>
							<?php elseif ($pk['price']): ?>
								<b class="fr_price"><?=$pk['price']?></b>
							<?php else: ?><b>Тегін</b><?php endif ?>
							<small><?=$pk['access'] ? $pk['access'].' күн қолжетімді' : ''?></small>
						</div>
						<div class="ap_ac">
							<a href="/admin/course/?id=<?=$c['id']?>&cat=<?=$c['category_id']?>" class="ap_b1"><i class="fal fa-pen"></i> Басқару</a>
							<a href="/admin/course/lessons.php?id=<?=$c['id']?>" class="ap_b2" title="Сабақтар"><i class="fal fa-list"></i></a>
							<a href="/admin/course/users/?id=<?=$c['id']?>" class="ap_b2" title="Оқушылар"><i class="fal fa-user-friends"></i></a>
							<a href="/cours/item.php?id=<?=$c['id']?>" target="_blank" class="ap_b2" title="Сайтта қарау"><i class="fal fa-external-link"></i></a>
						</div>
					</div>
				<?php endforeach ?>
				<div class="ap_none">Ештеңе табылмады</div>
			</div>

		</div>
	</div>

	<script>
		var apC = '0';
		function apCat(el) { document.querySelectorAll('.ap_chips span').forEach(function (s) { s.classList.remove('act'); }); el.classList.add('act'); apC = el.dataset.cat; apFilter(); }
		function apFilter() {
			var q = document.getElementById('ap_q').value.trim().toLowerCase(), n = 0;
			document.querySelectorAll('.ap_i').forEach(function (i) {
				var ok = (apC == '0' || i.dataset.cat == apC) && (!q || i.dataset.name.indexOf(q) > -1);
				i.style.display = ok ? '' : 'none'; if (ok) n++;
			});
			document.querySelector('.ap_none').style.display = n ? 'none' : 'block';
		}
	</script>

<?php include "../block/footer.php"; ?>

	<!-- cours add -->
	<div class="pop_bl pop_bl2 cours_add_block">
		<div class="pop_bl_a cours_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 cours_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
						<div class="form_imc">
							<input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" />
							<i class="fal fa-text form_icon"></i>
						</div>
					</div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты:</div>
						<div class="form_imc">
							<input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" />
							<i class="fal fa-calendar-alt form_icon"></i>
						</div>
					</div>
					<div class="form_im form_sel">
						<div class="form_span">Доступ түрі:</div>
						<div class="form_txt sel_clc pack" data-val="0">Қарапайым</div>
						<i class="fal fa-calendar-alt form_icon"></i>
						<i class="fal fa-caret-down form_icon_sel"></i>
						<div class="form_im_sel sel_clc_i">
							<div class="form_im_seli pack_each" data-val="0">Қарапайым</div>
							<div class="form_im_seli pack_each" data-val="1">Уақытпен</div>
							<div class="form_im_seli pack_each" data-val="2">Үй жұмысы арқылы</div>
						</div>
					</div>
					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img lazy_img cours_img_add" data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>
				</div>

				<div class="form_c">
					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Бағасын жазу:</div>
							<input type="checkbox" class="price_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Бағасы:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" />
									<i class="fal fa-tenge form_icon"></i>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Жіңілдетілген бағасы:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" />
									<i class="fal fa-tenge form_icon"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Информация жазу:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im form_sel">
								<div class="form_span">Бағыты:</div>
								<div class="form_txt sel_clc pack" data-val="1">Курс</div>
								<i class="fal fa-ballot-check form_icon"></i>
								<i class="fal fa-caret-down form_icon_sel"></i>
								<div class="form_im_sel sel_clc_i">
									<?php $cat = db::query("select * from category"); ?>
									<?php while ($cat_d = mysqli_fetch_assoc($cat)): ?>
										<div class="form_im_seli pack_each" data-val="<?=$cat_d['id']?>"><?=$cat_d['name_'.$lang]?></div>
									<?php endwhile ?>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Автор:</div>
								<div class="form_imc">
									<input type="text" class="form_txt cours_autor" placeholder="Авторды жазыңыз" data-lenght="2" />
									<i class="fal fa-user-graduate form_icon"></i>
								</div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Жаңа белгісін қою:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Жуырда белгісін қою:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Сатылымға шығару:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Сатылым сайты:</div>
								<div class="form_imc">
									<input type="text" class="form_txt cours_name" placeholder="Сілтемесін жазыңыз" data-lenght="2" />
									<i class="fal fa-text form_icon"></i>
								</div>
							</div>
							<div class="form_im form_im_toggle">
								<div class="form_span">Басты бетке шығару:</div>
								<input type="checkbox" class="info_inp" data-val="" />
								<div class="form_im_toggle_btn"></div>
							</div>
						</div>
					</div>

					<div class="prs_block">
						<div class="form_im form_im_toggle">
							<div class="form_span">Басқада:</div>
							<input type="checkbox" class="info_inp" data-val="" />
							<div class="form_im_toggle_btn prs_clc"></div>
						</div>
						<div class="prs_blockc">
							<div class="form_im">
								<div class="form_span">Сабақ саны:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_number cours_item" placeholder="12" data-lenght="1" />
									<i class="fal fa-play form_icon"></i>
								</div>
							</div>
							<div class="form_im">
								<div class="form_span">Тапсырма саны:</div>
								<div class="form_imc">
									<input type="tel" class="form_txt fr_number cours_assig" placeholder="3" data-lenght="1" />
									<i class="fal fa-scroll-old form_icon"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form_c">
					<div class="form_im form_im_bn">
						<div class="btn btn_cm btn_item_add">
							<i class="far fa-check"></i>
							<span>Сақтау</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>