<?php if ($site_set['header']): ?>
	<div class="header <?=($site_set['mheader']?'mheader_none':'')?>">
		<div class="header_c">

			<a class="logo" href="/"><?=$site['name']?></a>
			<div class="menu">
				<div class="menu_bars menu_bars_clc">
					<span>Мәзір</span>
					<div class="menu_bars_i"></div>
				</div>
				<div class="menu_c">
					<a class="menu_ci" href="/education/">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Жеке кабинет</div>
					</a>
					<a class="menu_ci" href="/#products">
						<div class="menu_cin"><i class="fal fa-layer-group"></i></div>
						<div class="menu_cih">Өнімдер</div>
					</a>
					<a class="menu_ci" href="/#about">
						<div class="menu_cin"><i class="fal fa-spa"></i></div>
						<div class="menu_cih">Айгүл туралы</div>
					</a>
					<a class="menu_ci" href="https://www.instagram.com/<?=$site['instagram']?>" target="_blank">
						<div class="menu_cin"><i class="fab fa-instagram"></i></div>
						<div class="menu_cih">Instagram</div>
					</a>
				</div>
			</div>

		</div>
	</div>
<?php endif ?>

<!-- app start -->
<div class="app">