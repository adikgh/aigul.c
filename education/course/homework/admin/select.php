<?php include "../../../../config/core_edu.php"; ?>

   <!--  -->
   <?php if (isset($_GET['select_work'])): ?>
		<?php $lesson_id = strip_tags($_POST['lesson_id']); ?>

      <?php $work = db::query("select * from home_work where lesson_id = '$lesson_id' order by ins_dt desc limit 25"); ?>
      <?php if (mysqli_num_rows($work)): ?>
         <?php while ($work_d = mysqli_fetch_assoc($work)): ?>
            <?php $w_id = $work_d['id']; ?>
            <?php $user_d = fun::user($work_d['user_id']); ?>
            <?php $pack_d = fun::pack($work_d['pack_id']); ?>
            <?php $lesson_d = fun::lesson($work_d['lesson_id']); ?>
            <div class="uhwa_i">
               <div class="uhwa_itm"><i class="fal fa-user"></i></div>
               <div class="uhwa_ic">
                  <div class="uhwa_it">
                     <div class="uhwa_itcn"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                     <div class="uhwa_itcp"><div><?php //=date("m-d-Y", strtotime($work_d['ins_dt']))?></div><div><?=date("H:i", strtotime($work_d['ins_dt']))?></div></div>
                  </div>
                  <div class="uhwa_iw">
                     <div class="uhwa_iwc"><?=$work_d['txt']?></div>
                  </div>
               </div>
            </div>
         <?php endwhile ?>
      <?php endif ?>

		<?php exit(); ?>
	<?php endif ?>