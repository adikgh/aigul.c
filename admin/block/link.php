<!-- css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" />
<link rel="stylesheet" href="/assets/pl/fontawesome/css/all.min.css" />
<?php if ($site_set['swiper']): ?> <link rel="stylesheet" href="/assets/pl/swiper-bundle.min.css" /> <?php endif ?>
<?php if ($site_set['plyr']): ?> <link rel="stylesheet" href="/assets/pl/plyr.css" /> <?php endif ?>

<!-- main css -->
<?php foreach ($scss as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <?php endforeach ?>
<?php foreach ($css as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <?php endforeach ?>

<!-- js -->
<script src="/assets/pl/jquery.min.js"></script>
<script src="/assets/pl/jquery.lazy.min.js"></script>
<script src="/assets/pl/jquery.lazy.plugins.min.js"></script>
<script src="/assets/pl/jquery.mask.min.js"></script>
<script src="/assets/js/fun.js?v=<?=$ver?>"></script>
<?php if ($site_set['swiper']): ?> <script src="/assets/pl/swiper-bundle.min.js"></script> <?php endif ?>
<?php if ($site_set['plyr']): ?> <script src="/assets/pl/plyr.polyfilled.js"></script> <?php endif ?>
<?php if ($site_set['aos']): ?> <script src="/assets/pl/aos.js"></script> <?php endif ?>
<?php if ($site_set['autosize']): ?> <script src="/assets/pl/autosize.min.js"></script> <?php endif ?>