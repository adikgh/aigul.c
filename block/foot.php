<!-- main js -->
<script src="/assets/js/norm.js?v=<?=$ver?>"></script>
<script src="/assets/js/main.js?v=<?=$ver?>"></script>
<?php foreach ($js as $i): ?>
	<script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script>
<?php endforeach ?>