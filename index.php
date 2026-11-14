<?php include "config/core.php";

	// Ескі сілтемелер: ?c=курс → кіру беті
	if (isset($_GET['c'])) go('/education/sign.php?c='.(int)$_GET['c']);

	// Өнімдер (сатылымдағы курстар)
	$products = db::query("select * from cours where offer = 1 order by number asc, id asc");

	// site setting
	$menu_name = 'cours';
	$css = ['aigul_home'];
?>
<?php include "block/header.php"; ?>

	<!-- hero -->
	<section class="ah_hero">
		<div class="bl_c">
			<div class="ah_hero_c">
				<div class="ah_hero_t">
					<div class="ah_eyebrow">Жеке даму кеңістігі</div>
					<h1>Өзіңді түсінуден басталатын өзгеріс</h1>
					<p>Медитациялар, практикалар және құрылымды бағдарламалар — барлығы бір жерде. Асықпай, өз қарқыныңызбен, өзіңізге мейірімділікпен.</p>
					<div class="ah_hero_b">
						<a class="btn" href="#products">Өнімдерді қарау</a>
						<a class="btn btn_cl" href="/education/">Жеке кабинет</a>
					</div>
				</div>
				<div class="ah_orn"><span>A</span></div>
			</div>
		</div>
	</section>

	<!-- products -->
	<section class="ah_sec" id="products">
		<div class="bl_c">
			<div class="ah_head">
				<h2>Өнімдер каталогы</h2>
				<span><?=mysqli_num_rows($products)?> өнім</span>
			</div>
			<div class="ah_grid">
				<?php while ($p = mysqli_fetch_assoc($products)): ?>
					<?php $cat = fun::category_name($p['category_id'], $lang); ?>
					<a class="ah_card" href="/cours/<?=($p['site']?$p['site']:'item.php?id='.$p['id'])?>">
						<div class="ah_cover" style="background-image:url('/assets/uploads/cours/<?=e($p['img'])?>')"></div>
						<div class="ah_card_b">
							<div class="ah_eyebrow"><?=e($cat)?></div>
							<h3><?=e($p['name_kz'])?></h3>
							<p><?=e($p['add_name_kz'])?></p>
							<div class="ah_card_f">
								<strong><?=number_format((int)$p['price'], 0, '.', ' ')?> ₸</strong>
								<span>Толығырақ →</span>
							</div>
						</div>
					</a>
				<?php endwhile ?>
			</div>
		</div>
	</section>

	<!-- about -->
	<section class="ah_sec" id="about">
		<div class="bl_c">
			<div class="ah_about">
				<div class="ah_about_img"><span>Айгүл<br>Асқар</span></div>
				<div class="ah_about_t">
					<div class="ah_eyebrow">Автор туралы</div>
					<h2>Айгүл Асқар — психолог</h2>
					<p>Адамның ішкі сенімдері, қарым-қатынасы және өзін бағалауы туралы бағдарламалар авторы. Практикалар өзіңізді жақынырақ тануға, эмоцияларыңызды байқауға және саналы шешім қабылдауға көмектеседі.</p>
					<ul class="ah_list">
						<li>Аудиопрактикалар мен медитациялар</li>
						<li>Жазбаша тапсырмалар мен рефлексия</li>
						<li>Жеке кабинетте прогресті бақылау</li>
						<li>Қолдау клубы мен кері байланыс</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- steps -->
	<section class="ah_sec">
		<div class="bl_c">
			<div class="ah_head"><h2>Қалай жұмыс істейді</h2></div>
			<div class="ah_steps">
				<div class="ah_step"><b>1</b><h4>Өнімді таңдаңыз</h4><p>Өзіңізге жақын тақырыпты каталогтан табыңыз.</p></div>
				<div class="ah_step"><b>2</b><h4>Кабинетке кіріңіз</h4><p>Бір логин: сатып алған өнімдеріңіз бірден ашылады.</p></div>
				<div class="ah_step"><b>3</b><h4>Өз қарқыныңызбен</h4><p>Сабақтарды тыңдап, тапсырмаларды орындап, прогресті көріңіз.</p></div>
			</div>
		</div>
	</section>

	<!-- lead -->
	<section class="ah_sec" id="contact">
		<div class="bl_c">
			<div class="ah_lead">
				<div>
					<h2>Сұрағыңыз бар ма?</h2>
					<p>Атыңыз бен нөміріңізді қалдырыңыз — қай бағдарлама сізге сай келетінін бірге анықтаймыз.</p>
				</div>
				<form class="ah_form" onsubmit="return ahLead(this)">
					<input class="name" name="name" placeholder="Атыңыз" required>
					<input class="phone" name="phone" placeholder="Телефон нөміріңіз" required>
					<button class="btn" type="submit">Өтінім қалдыру</button>
				</form>
			</div>
			<div class="ag_note ah_disc">Практикалар медициналық немесе психотерапиялық көмектің орнын алмастырмайды. Ауыр жағдайда маманға жүгініңіз.</div>
		</div>
	</section>

	<script>
		function ahLead(f) {
			$.post('/send.php?mess2', {name: f.name.value, phone: f.phone.value}, function (d) {
				if (d == 'yes') { mess('Рақмет! Өтініміңіз қабылданды.'); f.reset() } else mess('Форманы толтырыңыз')
			})
			return false
		}
	</script>

<?php include "block/footer.php"; ?>
