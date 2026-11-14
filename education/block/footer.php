<!-- body end -->
</div>

	<?php if ($site_set['footer'] == true): ?>
		<footer class="footer">
			<div class="bl_c">
				<div class="footer_b">
					<div class="footer_bl">© <?=date("Y")?> «<?=$site['name']?>»</div>
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