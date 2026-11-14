<?php include "config/core.php";

	// Ескі сілтемелер: ?c=курс → кіру беті
	if (isset($_GET['c'])) go('/education/sign.php?c='.(int)$_GET['c']);

	// Өнімдер мен санаттар
	$products = [];
	$q = db::query("select * from cours where offer = 1 order by number asc, id asc");
	while ($p = mysqli_fetch_assoc($q)) $products[] = $p;
	$cats = [];
	$q = db::query("select * from category order by id asc");
	while ($c = mysqli_fetch_assoc($q)) $cats[$c['id']] = $c;

	// Пікірлер
	$reviews = db::query("select * from review where status = 1 order by id desc limit 9");

	// Айгүлдің суреті (бар болса)
	$photo = file_exists(__DIR__.'/assets/img/aigul/aigul.jpg') ? '/assets/img/aigul/aigul.jpg' : '';

	$wa = 'https://wa.me/'.$site['whatsapp'].'?text='.rawurlencode('Сәлеметсіз бе! Жеке терапияға жазылғым келеді.');

	// site setting
	$menu_name = 'index';
	$site_set['header'] = false;
	$site_set['footer'] = false;
	$site_set['cl_wh'] = false;
	$css = ['aigul_home'];
?>
<?php include "block/header.php"; ?>

	<!-- nav -->
	<header class="hn" id="top">
		<div class="hw hn_c">
			<a class="hn_logo" href="/">AIGUL <span>ASQAR</span></a>
			<nav class="hn_nav">
				<a href="#about">Айгүл туралы</a>
				<a href="#products">Бағдарламалар</a>
				<a href="#therapy">Терапия</a>
				<a href="#reviews">Пікірлер</a>
				<a href="#faq">Сұрақтар</a>
			</nav>
			<div class="hn_r">
				<a class="hbtn hbtn_s" href="/education/"><i class="fal fa-user"></i><span><?=($user_id?'Кабинет':'Кіру')?></span></a>
				<button class="hn_burger" type="button" aria-label="Мәзір" onclick="document.body.classList.toggle('hn_open')"><i></i><i></i></button>
			</div>
		</div>
		<div class="hn_mob">
			<a href="#about">Айгүл туралы</a>
			<a href="#products">Бағдарламалар</a>
			<a href="#quiz">Қайсысы сізге сай?</a>
			<a href="#therapy">Жеке терапия</a>
			<a href="#reviews">Пікірлер</a>
			<a href="#faq">Сұрақтар</a>
			<a class="hbtn" href="/education/"><?=($user_id?'Жеке кабинетке өту':'Жеке кабинетке кіру')?></a>
		</div>
	</header>

	<!-- hero -->
	<section class="hh">
		<div class="hw hh_c">
			<div class="hh_t rv">
				<div class="hh_tag"><span></span> Психосоматолог · Психолог · Шымкент</div>
				<h1>Бейсанадан<br><em>— санаға</em></h1>
				<p>Санаға көтерілгенде барлық нәрсенің шешімі пайда болады. Ақша мен қарыз, дене мен эмоция, өзіңді қабылдау — Айгүл Асқардың онлайн бағдарламалары мен жеке терапиясы.</p>
				<div class="hh_b">
					<a class="hbtn" href="#quiz">Өзіме сай бағдарламаны табу <i class="fal fa-arrow-right"></i></a>
					<a class="hbtn hbtn_o" href="#therapy">Жеке терапия</a>
				</div>
				<div class="hh_stats">
					<div><b>110K+</b><span>Instagram оқырманы</span></div>
					<div><b><?=count($products)?></b><span>онлайн бағдарлама</span></div>
					<div><b>2</b><span>формат: онлайн, оффлайн</span></div>
				</div>
			</div>
			<div class="hh_v rv">
				<div class="hh_arch <?=($photo?'':'hh_arch_e')?>" <?=($photo?'style="background-image:url(\''.$photo.'\')"':'')?>>
					<?php if (!$photo): ?><span>А</span><?php endif ?>
				</div>
				<div class="hh_float hh_f1"><i class="fal fa-leaf"></i><div><b>Жеке терапия</b><small>онлайн · оффлайн</small></div></div>
				<div class="hh_float hh_f2"><i class="fal fa-gem"></i><div><b>«Өзгеріс»</b><small>мастер-классы</small></div></div>
			</div>
		</div>
	</section>

	<!-- marquee -->
	<div class="hm" aria-hidden="true">
		<div class="hm_t">
			<?php for ($i = 0; $i < 2; $i++): ?>
				<span>Ақша</span><i>✦</i><span>Қарыздан арылу</span><i>✦</i><span>Психосоматика</span><i>✦</i><span>Өзіңді қабылдау</span><i>✦</i><span>Ойды өзгерту</span><i>✦</i><span>Ішкі тыныштық</span><i>✦</i>
			<?php endfor ?>
		</div>
	</div>

	<!-- pains -->
	<section class="hs">
		<div class="hw">
			<div class="hs_h rv">
				<div class="hk">Таныс па?</div>
				<h2>Мәселенің шешімі көбіне сыртта емес, ішімізде</h2>
			</div>
			<div class="hp">
				<?php
					$pains = [
						['fa-coins', 'Ақша келеді, бірақ тұрмайды', 'Қарыз бен ақша тапшылығы көбіне балалық шақтағы сенімдерден басталады.', 1],
						['fa-head-side-medical', 'Дене жиі ауырады, себебі белгісіз', 'Айтылмаған эмоция денеде қалады. Психосоматика соны тануға көмектеседі.', 2],
						['fa-heart-broken', 'Өзімді жиі сынаймын', 'Өзіңді бар қалпыңда қабылдау — өзгерістің бірінші қадамы.', 3],
						['fa-redo', 'Бір қатені қайталай беремін', 'Ойлау әдетін өзгертсеңіз, шешім де өзгереді.', 4],
					];
				?>
				<?php foreach ($pains as $n => $pn): ?>
					<a class="hp_i rv" href="#p<?=$pn[3]?>" style="--d:<?=$n*80?>ms">
						<div class="hp_ic"><i class="fal <?=$pn[0]?>"></i></div>
						<h3><?=$pn[1]?></h3>
						<p><?=$pn[2]?></p>
						<span>Бағдарламаны көру <i class="fal fa-arrow-right"></i></span>
					</a>
				<?php endforeach ?>
			</div>
		</div>
	</section>

	<!-- about -->
	<section class="hs" id="about">
		<div class="hw ha">
			<div class="ha_v rv">
				<div class="ha_img <?=($photo?'':'ha_img_e')?>" <?=($photo?'style="background-image:url(\''.$photo.'\')"':'')?>></div>
				<div class="ha_q">«Өміріңіз өзгерсін десеңіз, алдымен ойыңызды өзгертіңіз»</div>
			</div>
			<div class="ha_t rv">
				<div class="hk">Автор туралы</div>
				<h2>Айгүл Асқар</h2>
				<p>Дипломды психосоматолог және психолог. Шымкентте оффлайн, бүкіл Қазақстан бойынша онлайн жұмыс істейді. Ақша мен қарыз, психосоматика, өзіңді қабылдау және ойды өзгерту тақырыптарымен көмектеседі.</p>
				<div class="ha_list">
					<div><i class="fal fa-graduation-cap"></i><span>Дипломды психосоматолог және психолог</span></div>
					<div><i class="fal fa-users"></i><span>Шымкентте «Өзгеріс» мастер-классын өткізген</span></div>
					<div><i class="fal fa-comments"></i><span>Онлайн және оффлайн жеке терапия</span></div>
				</div>
				<a class="ha_ig" href="https://www.instagram.com/<?=$site['instagram']?>" target="_blank"><i class="fab fa-instagram"></i> @<?=$site['instagram']?> · 110 мың оқырман</a>
			</div>
		</div>
	</section>

	<!-- quiz -->
	<section class="hs" id="quiz">
		<div class="hw">
			<div class="hq rv">
				<div class="hq_l">
					<div class="hk hk_l">1 минуттық тест</div>
					<h2>Қай бағдарлама сізге сай?</h2>
					<p>Үш сұраққа жауап беріңіз — сізге ең жақын бағдарламаны ұсынамыз.</p>
					<div class="hq_dots"><i class="act"></i><i></i><i></i></div>
				</div>
				<div class="hq_r">
					<div class="hq_s act" data-step="0">
						<div class="hq_n">1 / 3</div>
						<h4>Қазір сізді көбірек не мазалайды?</h4>
						<button data-p="1">Ақша мен қарыз</button>
						<button data-p="2">Денсаулық, шаршау</button>
						<button data-p="3">Өзіме деген көзқарас</button>
						<button data-p="5">Мазасыздық, ұйқысыздық</button>
					</div>
					<div class="hq_s" data-step="1">
						<div class="hq_n">2 / 3</div>
						<h4>Қай форматта жұмыс істеген ыңғайлы?</h4>
						<button data-f="self">Өз бетімше, өз уақытымда</button>
						<button data-f="group">Топпен, тірі эфирде</button>
						<button data-f="therapy">Маманмен жеке</button>
					</div>
					<div class="hq_s" data-step="2">
						<div class="hq_n">3 / 3</div>
						<h4>Күніне қанша уақыт бөле аласыз?</h4>
						<button data-t="s">10–15 минут</button>
						<button data-t="m">30 минут</button>
						<button data-t="l">1 сағат және одан көп</button>
					</div>
					<div class="hq_s hq_res" data-step="3">
						<div class="hq_n">Сізге ұсынамыз</div>
						<h4 id="hq_name"></h4>
						<p id="hq_txt"></p>
						<div class="hq_rb">
							<a class="hbtn" id="hq_link" href="#">Толығырақ <i class="fal fa-arrow-right"></i></a>
							<button class="hq_again" type="button">Қайта бастау</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- products -->
	<section class="hs" id="products">
		<div class="hw">
			<div class="hs_h hs_hr rv">
				<div>
					<div class="hk">Онлайн бағдарламалар</div>
					<h2>Өзіңізге жол таңдаңыз</h2>
				</div>
				<div class="hf">
					<button class="act" data-cat="all">Барлығы</button>
					<?php foreach ($cats as $c): ?>
						<button data-cat="<?=$c['id']?>"><?=e($c['name_kz'])?></button>
					<?php endforeach ?>
				</div>
			</div>
			<div class="hg">
				<?php foreach ($products as $n => $p): ?>
					<?php $url = '/cours/'.($p['site'] ? $p['site'] : 'item.php?id='.$p['id']); ?>
					<a class="hg_i rv" id="p<?=$p['id']?>" data-cat="<?=$p['category_id']?>" href="<?=$url?>" style="--d:<?=($n%3)*80?>ms">
						<div class="hg_cv" style="background-image:url('/assets/uploads/cours/<?=e($p['img'])?>')">
							<span class="hg_tag"><?=e($cats[$p['category_id']]['name_kz'] ?? '')?></span>
							<?php if ($p['new']): ?><span class="hg_new">Жаңа</span><?php endif ?>
						</div>
						<div class="hg_b">
							<h3><?=e($p['name_kz'])?></h3>
							<p><?=e($p['add_name_kz'])?></p>
							<div class="hg_f">
								<b><?=number_format((int)$p['price'], 0, '.', ' ')?> ₸</b>
								<span class="hg_go"><i class="fal fa-arrow-right"></i></span>
							</div>
						</div>
					</a>
				<?php endforeach ?>
			</div>
		</div>
	</section>

	<!-- therapy -->
	<section class="hs" id="therapy">
		<div class="hw">
			<div class="ht rv">
				<div class="ht_l">
					<div class="hk hk_l">Онлайн · оффлайн</div>
					<h2>Жеке терапия Айгүл Асқармен</h2>
					<p>Сұрауыңызды бірге анықтап, оның бейсаналы себебін тауып, жеке жұмыс жоспарын құрамыз. Оффлайн кездесу Шымкентте, онлайн кез келген қаладан.</p>
					<ol class="ht_steps">
						<li><b>Өтінім</b><span>WhatsApp-қа жазасыз</span></li>
						<li><b>Танысу</b><span>Сұрауды нақтылаймыз</span></li>
						<li><b>Терапия</b><span>Жеке жұмыс жоспары</span></li>
					</ol>
				</div>
				<div class="ht_r">
					<div class="ht_card">
						<small>Жеке терапия</small>
						<div class="ht_price">200 000 ₸</div>
						<a class="hbtn hbtn_w" href="<?=$wa?>" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp арқылы жазылу</a>
						<a class="ht_tel" href="tel:<?=$site['phone']?>"><i class="fal fa-phone"></i> <?=$site['phone_view']?></a>
						<p>Орын саны шектеулі</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- reviews -->
	<?php if (mysqli_num_rows($reviews)): ?>
		<section class="hs" id="reviews">
			<div class="hw">
				<div class="hs_h hs_hr rv">
					<div>
						<div class="hk">Пікірлер</div>
						<h2>Қатысушылар не дейді</h2>
					</div>
					<div class="hr_nav">
						<button type="button" data-dir="-1" aria-label="Артқа"><i class="fal fa-arrow-left"></i></button>
						<button type="button" data-dir="1" aria-label="Алға"><i class="fal fa-arrow-right"></i></button>
					</div>
				</div>
				<div class="hr" id="hr">
					<?php while ($r = mysqli_fetch_assoc($reviews)): ?>
						<?php $rc = fun::cours($r['cours_id']); ?>
						<div class="hr_i">
							<div class="hr_st"><?=str_repeat('★', (int)$r['star'])?><span><?=str_repeat('★', 5 - (int)$r['star'])?></span></div>
							<p>«<?=e($r['txt'])?>»</p>
							<div class="hr_a">
								<div class="hr_av"><?=e(mb_substr($r['name'], 0, 1))?></div>
								<div><b><?=e($r['name'])?></b><small><?=e($rc['name_kz'] ?? '')?></small></div>
							</div>
						</div>
					<?php endwhile ?>
				</div>
			</div>
		</section>
	<?php endif ?>

	<!-- faq -->
	<section class="hs" id="faq">
		<div class="hw hfaq">
			<div class="hs_h rv">
				<div class="hk">Сұрақтар</div>
				<h2>Жиі қойылатын сұрақтар</h2>
				<p class="hfaq_p">Жауап таппасаңыз, WhatsApp-қа жазыңыз.</p>
				<a class="hbtn hbtn_o" href="https://wa.me/<?=$site['whatsapp']?>" target="_blank"><i class="fab fa-whatsapp"></i> Сұрақ қою</a>
			</div>
			<div class="hfaq_l rv">
				<details open><summary>Бағдарламаны сатып алған соң не болады?</summary><p>Телефон нөміріңізге жеке кабинет ашылады. Сабақтар, тапсырмалар мен прогресс сол жерде сақталады.</p></details>
				<details><summary>Сабақтарға қанша уақыт қолжетімді?</summary><p>Әр бағдарламаның қолжетімділік мерзімі бар (60–90 күн). Мерзім өнім бетінде жазылған.</p></details>
				<details><summary>Онлайн терапия қалай өтеді?</summary><p>Бейнебайланыс арқылы, сізге ыңғайлы уақытта. Уақытты WhatsApp арқылы келісеміз.</p></details>
				<details><summary>Практикалар дәрігердің орнын баса ма?</summary><p>Жоқ. Практикалар медициналық немесе психотерапиялық көмектің орнын алмастырмайды. Ауыр жағдайда маманға жүгініңіз.</p></details>
				<details><summary>Төлемді қалай жасаймын?</summary><p>Kaspi арқылы. Өнім бетіндегі «Оқығым келеді» батырмасын басып, нұсқауды орындаңыз.</p></details>
			</div>
		</div>
	</section>

	<!-- lead -->
	<section class="hs hs_last" id="contact">
		<div class="hw">
			<div class="hl rv">
				<div>
					<h2>Қайдан бастарыңызды білмейсіз бе?</h2>
					<p>Атыңыз бен нөміріңізді қалдырыңыз — бірге анықтаймыз.</p>
				</div>
				<form class="hl_f" onsubmit="return ahLead(this)">
					<input name="name" placeholder="Атыңыз" required>
					<input name="phone" type="tel" placeholder="Телефон нөміріңіз" required>
					<button class="hbtn" type="submit">Өтінім қалдыру</button>
				</form>
			</div>
		</div>
	</section>

	<!-- footer -->
	<footer class="hft">
		<div class="hw hft_c">
			<div>
				<a class="hn_logo" href="/">AIGUL <span>ASQAR</span></a>
				<p>Психосоматолог · Психолог · Шымкент</p>
			</div>
			<div class="hft_l">
				<a href="#products">Бағдарламалар</a>
				<a href="#therapy">Жеке терапия</a>
				<a href="/education/">Жеке кабинет</a>
				<a href="/all/about/faq/offer.php">Оферта</a>
				<a href="/all/about/faq/privacy.php">Құпиялылық</a>
			</div>
			<div class="hft_s">
				<a href="https://www.instagram.com/<?=$site['instagram']?>" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
				<a href="https://wa.me/<?=$site['whatsapp']?>" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
				<a href="tel:<?=$site['phone']?>" aria-label="Телефон"><i class="fal fa-phone"></i></a>
			</div>
		</div>
		<div class="hw hft_b">© <?=$site['name']?>, <?=date('Y')?> · Практикалар медициналық көмектің орнын алмастырмайды.</div>
	</footer>

	<!-- mobile bar -->
	<div class="hmb">
		<a href="/education/"><i class="fal fa-user"></i><span>Кабинет</span></a>
		<a href="#products"><i class="fal fa-layer-group"></i><span>Бағдарлама</span></a>
		<a class="hmb_wa" href="<?=$wa?>" target="_blank"><i class="fab fa-whatsapp"></i><span>Жазылу</span></a>
	</div>

	<script>
		var AQ_PRODUCTS = <?=json_encode(array_map(function ($p) { return ['id'=>(int)$p['id'], 'name'=>$p['name_kz'], 'sub'=>$p['add_name_kz'], 'url'=>'/cours/'.($p['site'] ? $p['site'] : 'item.php?id='.$p['id'])]; }, $products), JSON_UNESCAPED_UNICODE)?>;
		var AQ_WA = <?=json_encode($wa)?>;

		// Лид форма
		function ahLead(f) {
			$.post('/send.php?mess2', {name: f.name.value, phone: f.phone.value}, function (d) {
				if (d == 'yes') { mess('Рақмет! Өтініміңіз қабылданды.'); f.reset() } else mess('Форманы толтырыңыз')
			})
			return false
		}

		(function () {
			// Мобильді мәзір: сілтеме басылса жабылады
			document.querySelectorAll('.hn_mob a').forEach(function (a) { a.addEventListener('click', function () { document.body.classList.remove('hn_open') }) })

			// Скролл кезінде nav көлеңкесі
			var hn = document.querySelector('.hn')
			window.addEventListener('scroll', function () { hn.classList.toggle('hn_sc', window.scrollY > 10) }, {passive: true})

			// Пайда болу анимациясы
			if ('IntersectionObserver' in window) {
				var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target) } }) }, {threshold: .12})
				document.querySelectorAll('.rv').forEach(function (el) { io.observe(el) })
			} else document.querySelectorAll('.rv').forEach(function (el) { el.classList.add('in') })

			// Санат сүзгісі
			document.querySelectorAll('.hf button').forEach(function (b) {
				b.addEventListener('click', function () {
					document.querySelectorAll('.hf button').forEach(function (x) { x.classList.remove('act') })
					b.classList.add('act')
					var c = b.dataset.cat
					document.querySelectorAll('.hg_i').forEach(function (i) { i.classList.toggle('hide', c != 'all' && i.dataset.cat != c) })
				})
			})

			// Пікірлер слайдері
			var hr = document.getElementById('hr')
			document.querySelectorAll('.hr_nav button').forEach(function (b) {
				b.addEventListener('click', function () { hr.scrollBy({left: b.dataset.dir * (hr.clientWidth * .8), behavior: 'smooth'}) })
			})

			// Тест
			var ans = {}, steps = document.querySelectorAll('.hq_s'), dots = document.querySelectorAll('.hq_dots i')
			function go(n) {
				steps.forEach(function (s) { s.classList.toggle('act', s.dataset.step == n) })
				dots.forEach(function (d, i) { d.classList.toggle('act', i <= Math.min(n, 2)) })
			}
			document.querySelectorAll('.hq_s button[data-p],.hq_s button[data-f],.hq_s button[data-t]').forEach(function (b) {
				b.addEventListener('click', function () {
					Object.assign(ans, b.dataset)
					var n = +b.closest('.hq_s').dataset.step + 1
					if (n == 3) result()
					go(n)
				})
			})
			document.querySelector('.hq_again').addEventListener('click', function () { ans = {}; go(0) })
			function result() {
				var name, txt, url
				if (ans.f == 'therapy') {
					name = 'Жеке терапия'; txt = 'Сізге маманмен жеке жұмыс сай келеді. Онлайн немесе Шымкентте оффлайн.'; url = AQ_WA
				} else {
					var id = +ans.p
					if (ans.f == 'group' && id == 1) id = 6
					if (ans.t == 's' && id == 3) id = 3
					if (ans.t == 'l' && id == 3) id = 4
					var p = AQ_PRODUCTS.filter(function (x) { return x.id == id })[0] || AQ_PRODUCTS[0]
					name = p.name; txt = p.sub + '. Сіздің жауаптарыңызға ең жақын бағдарлама.'; url = p.url
				}
				document.getElementById('hq_name').textContent = name
				document.getElementById('hq_txt').textContent = txt
				document.getElementById('hq_link').href = url
			}
		})()
	</script>

<?php include "block/footer.php"; ?>
