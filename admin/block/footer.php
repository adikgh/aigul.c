	<!-- body end -->
	</div>
	
	<!-- main js -->
	<?php foreach ($sjs as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <?php endforeach ?>
	<?php foreach ($js as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <?php endforeach ?>
		
</body>
</html>

	<?php include "modal.php"; ?>