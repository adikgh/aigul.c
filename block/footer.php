<!-- body end -->
</div>

	<?php if ($site_set['footer']): ?>
		<footer class="footer">
			<div class="bl_c">
				
				<?php if ($site_set['footer_t']): ?>
					<div class="footer_t">
						<div class="foot_c">
							<ul>
								<li><a href="/#products">Өнімдер</a></li>
								<li><a href="/cours/">Барлық бағдарламалар</a></li>
								<li><a href="/education/">Жеке кабинет</a></li>
							</ul>
						</div>
						<div class="foot_c">
							<ul>
								<li><a href="/#about">Айгүл туралы</a></li>
								<li><a href="/all/about/faq/privacy.php">Құпиялылық саясаты</a></li>
								<li><a href="/all/about/faq/offer.php">Ұсыныс шарты (оферта)</a></li>
							</ul>
						</div>
						<div class="footer_tr">
							<a class="footer_tr_phone" href="tel:<?=$site['phone']?>">
								<p><?=$site['phone_view']?></p>
								<div class="footer_tr_phone_act">Қызмет көрсету бөлімі</div>
							</a>
							<div class="footer_tr_s">
								<a href="https://www.instagram.com/<?=$site['instagram']?>" class="footer_tr_si">
									<i class="fab fa-instagram"></i>
								</a>
								<a href="https://wa.me/<?=$site['whatsapp']?>" class="footer_tr_si">
									<i class="fab fa-whatsapp"></i>
								</a>
							</div>
						</div>
					</div>
				<?php endif ?>

				<div class="footer_b">
					<div class="footer_bl">© <?=$site['name']?>, <?=date('Y')?></div>
					<div class="footer_br">
						<a href="https://gprog.kz" target="_blank" class="gprog_bl">
							<span>#gprog-та</span>
							<div class="gprog_heart"><i class="fas fa-heart"></i></div>
							<span>жасалған</span>
							<div class="gprog_ab">
								<div class="gprog_lg"><div class="lazy_img" data-src="https://gprog.kz/assets/img/logo/logo.png"></div></div>
								<div class="gprog_h">G prog</div>
								<div class="gprog_p">Бізбен өз онлайн мектебіңді аш!</div>
							</div>
						</a>
					</div>
				</div>

			</div>
		</footer>
	<?php endif ?>
	
	<!-- main js -->
	<?php foreach ($sjs as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <?php endforeach ?>
	<?php foreach ($js as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <?php endforeach ?>
		
</body>
</html>

	<?php include "modal.php"; ?>